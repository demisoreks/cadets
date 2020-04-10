<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Redirect;
use App\CdtCadet;
use App\CdtCourse;
use App\CdtConfig;
use App\CdtInstructor;
use App\CdtMetric;
use App\CdtMeasure;
use App\CdtExam;
use App\CdtQuality;
use App\CdtAssessment;
use App\CdtCheck;

use App\Charts\DistributionChart;

class CadetsController extends Controller
{
    public function index() {
        return view('cadets.index');
    }
    
    public function search() {
        return view('cadets.search');
    }
    
    public function getNextCadetCode(CdtCourse $course) {
        $cadets = CdtCadet::where('course_id', $course->id);
        if ($cadets->count() == 0) {
            $new_code = '001';
        } else {
            $last_index = CdtCadet::where('course_id', $course->id)->max('index');
            $last_index_array = explode("/", $last_index);
            $last_code = array_pop($last_index_array);
            $code = (int) $last_code;
            $code ++;
            $new_code = str_pad($code, 3, '0', STR_PAD_LEFT);
        }
        return $new_code;
    }

    public function store(Request $request) {
        $input = $request->input();
        $input['first_name'] = strtoupper($input['first_name']);
        if (isset($input['middle_name'])) {
            $input['middle_name'] = strtoupper($input['middle_name']);
        }
        $input['surname'] = strtoupper($input['surname']);
        $input['entrance_pass_mark'] = CdtConfig::whereId(1)->first()->entrance_pass_mark;
        if ($input['entrance_score'] >= $input['entrance_pass_mark']) {
            $input['admission_status'] = "P";
        } else {
            $input['admission_status'] = "F";
        }
        $course = CdtCourse::whereId($input['course_id'])->first();
        $input['index'] = implode("/", [$course->location->code.substr($course->start_date, 0, 2), $course->code, $this->getNextCadetCode($course)]);
        unset($input['location_id']);
        $input['created_by'] = UtilsController::getEmployee()->id;
        $cadet = CdtCadet::create($input);
        if ($cadet) {
            ActivitiesController::log('Cadet was created - '.$cadet->first_name.' '.$cadet->surname.'.');
            return Redirect::route('cadets.index')
                    ->with('success', UtilsController::response('Successful!', 'Cadet has been created.'));
        } else {
            return Redirect::back()
                    ->with('error', UtilsController::response('Unknown error!', 'Please contact administrator.'))
                    ->withInput();
        }
    }
    
    public function fetch(Request $request) {
        $input = $request->input();
        $cadets = CdtCadet::where('id', '>', 0);
        if (isset($input['gender'])) {
            $cadets = $cadets->where('gender', $input['gender']);
        }
        $cadets = $cadets->get();
        return view('cadets.fetch', compact('cadets'));
    }
    
    public function view(CdtCadet $cadet) {
        return view('cadets.view', compact('cadet'));
    }
    
    public function manage(CdtCadet $cadet) {
        $employee = UtilsController::getEmployee();
        $instructor = CdtInstructor::where('employee_id', $employee->id)->where('region_id', $cadet->course->location->region->id);
        if ($instructor->count() == 0) {
            return Redirect::route('cadets.view', [$cadet->slug()])
                    ->with('error', UtilsController::response('Oops!', 'The selected cadet does not fall under any of your regions. Please contact your administrator.'))
                    ->withInput();
        }
        return view('cadets.manage', compact('cadet'));
    }
    
    public function update_exam(CdtCadet $cadet, Request $request) {
        $input = $request->input();
        $metrics = CdtMetric::where('active', true)->get();
        foreach ($metrics as $metric) {
            $data = [
                'cadet_id' => $cadet->id,
                'metric_id' => $metric->id,
                'score' => $input[$metric->id],
                'percentage' => $metric->percentage
            ];
            $exams = CdtExam::where('metric_id', $metric->id)->where('cadet_id', $cadet->id);
            if ($exams->count() > 0) {
                $exam = $exams->first();
                $exam->update($data);
            } else {
                CdtExam::create($data);
            }
        }
        ActivitiesController::log('Exam scores were updated - '.$cadet->first_name.' '.$cadet->surname.'.');
        return Redirect::route('cadets.manage', $cadet->slug())
                ->with('success', UtilsController::response('Successful!', 'Exam scores have been updated.'));
    }
    
    public function update_quality(CdtCadet $cadet, Request $request) {
        $input = $request->input();
        $measures = CdtMeasure::where('active', true)->get();
        foreach ($measures as $measure) {
            $data = [
                'cadet_id' => $cadet->id,
                'measure_id' => $measure->id,
                'score' => $input[$measure->id],
                'percentage' => $measure->percentage
            ];
            $qualities = CdtQuality::where('measure_id', $measure->id)->where('cadet_id', $cadet->id);
            if ($qualities->count() > 0) {
                $quality = $qualities->first();
                $quality->update($data);
            } else {
                CdtQuality::create($data);
            }
        }
        ActivitiesController::log('Quality scores were updated - '.$cadet->first_name.' '.$cadet->surname.'.');
        return Redirect::route('cadets.manage', $cadet->slug())
                ->with('success', UtilsController::response('Successful!', 'Quality scores have been updated.'));
    }
    
    public function streams() {
        $courses = CdtCourse::where('active', true)->orderBy('start_date', 'desc')->get();
        return view('general.streams', compact('courses'));
    }
    
    public function register(CdtCourse $course) {
        if (!$course->active) {
            return Redirect::route('streams')
                    ->with('error', UtilsController::response('Oops!', 'The selected stream is no longer available for applications.'));
        }
        return view('general.register', compact('course'));
    }
    
    public function submit(CdtCourse $course, Request $request) {
        $input = $request->input();
        $input['first_name'] = strtoupper($input['first_name']);
        if (isset($input['middle_name'])) {
            $input['middle_name'] = strtoupper($input['middle_name']);
        }
        $input['surname'] = strtoupper($input['surname']);
        $input['course_id'] = $course->id;
        $input['index'] = implode("/", [$course->location->code.substr($course->start_date, 0, 2), $course->code, $this->getNextCadetCode($course)]);
        $input['status'] = "Applicant";
        $input['treated_by'] = 0;
        $cadet = CdtCadet::create($input);
        if ($cadet) {
            return Redirect::route('streams')
                    ->with('success', UtilsController::response('Completed!', 'You have successfully registered.'));
        } else {
            return Redirect::back()
                    ->with('error', UtilsController::response('Unknown error!', 'Please contact administrator.'))
                    ->withInput();
        }
    }
    
    public function applicants(CdtCourse $course) {
        if (CdtInstructor::where('region_id', $course->location->region->id)->where('employee_id', UtilsController::getEmployee()->id)->count() == 0) {
            return Redirect::back()
                    ->with('error', UtilsController::response('Oops!', 'You have not been mapped for this region.'))
                    ->withInput();
        }
        
        $status_chart = new DistributionChart();
        $status_labels = ['Applicant', 'Cadet', 'Trained', 'Rejected'];
        $status_counts = [
            CdtCadet::where('course_id', $course->id)->where('status', 'Applicant')->count(), 
            CdtCadet::where('course_id', $course->id)->where('status', 'Cadet')->count(), 
            CdtCadet::where('course_id', $course->id)->where('status', 'Trained')->count(), 
            CdtCadet::where('course_id', $course->id)->where('status', 'Rejected')->count()
        ];
        $status_colors = ['#ccc', '#999', '#666', '#f00'];
        $status_chart->labels($status_labels)->dataset('Status Distribution', 'doughnut', $status_counts)->backgroundColor($status_colors);
        
        $gender_chart = new DistributionChart();
        $gender_labels = ['M', 'F'];
        $gender_counts = [CdtCadet::where('course_id', $course->id)->where('gender', 'M')->count(), CdtCadet::where('course_id', $course->id)->where('gender', 'F')->count()];
        $gender_colors = ['#555', '#ddd'];
        $gender_chart->labels($gender_labels)->dataset('Gender Distribution', 'pie', $gender_counts)->backgroundColor($gender_colors);
        
        $cadets = CdtCadet::where('course_id', $course->id)->get();
        return view('cadets.applicants', compact('cadets', 'course', 'status_chart', 'gender_chart'));
    }
    
    public function treat(CdtCadet $cadet) {
        if (CdtInstructor::where('region_id', $cadet->course->location->region->id)->where('employee_id', UtilsController::getEmployee()->id)->count() == 0) {
            return Redirect::back()
                    ->with('error', UtilsController::response('Oops!', 'You have not been mapped for the applicant\'s region.'))
                    ->withInput();
        }
        return view('cadets.treat', compact('cadet'));
    }
    
    public function admit(CdtCadet $cadet, Request $request) {
        $input = $request->input();
        foreach (CdtAssessment::where('when', 'B')->where('active', true)->get() as $assessment) {
            $data = [
                'cadet_id' => $cadet->id,
                'assessment_id' => $assessment->id,
                'checked' => false
            ];
            if (isset($input['ass'.$assessment->id])) {
                $data['checked'] = true;
                unset($input['ass'.$assessment->id]);
            }
            $checks = CdtCheck::where('cadet_id', $cadet->id)->where('assessment_id', $assessment->id);
            if ($checks->count() == 0) {
                CdtCheck::create($data);
            } else {
                $checks->first()->update($data);
            }
        }
        $input['treated_by'] = UtilsController::getEmployee()->id;
        $input['entrance_pass_mark'] = CdtConfig::whereId(1)->first()->entrance_pass_mark;
        $cadet->update($input);
        return Redirect::route('courses.applicants', [$cadet->course->slug()])
                ->with('success', UtilsController::response('Completed!', 'Applicant treated.'));
    }
    
    public function complete(CdtCadet $cadet, Request $request) {
        $input = $request->input();
        foreach (CdtAssessment::where('when', 'A')->where('active', true)->get() as $assessment) {
            $data = [
                'cadet_id' => $cadet->id,
                'assessment_id' => $assessment->id,
                'checked' => false
            ];
            if (isset($input['ass'.$assessment->id])) {
                $data['checked'] = true;
                unset($input['ass'.$assessment->id]);
            }
            $checks = CdtCheck::where('cadet_id', $cadet->id)->where('assessment_id', $assessment->id);
            if ($checks->count() == 0) {
                CdtCheck::create($data);
            } else {
                $checks->first()->update($data);
            }
        }
        $input['status'] = "Trained";
        $cadet->update($input);
        return Redirect::route('cadets.manage', [$cadet->slug()])
                ->with('success', UtilsController::response('Completed!', 'Cadet has been marked as trained.'));
    }
    
    public function update(CdtCadet $cadet, Request $request) {
        $input = $request->input();
        $input['first_name'] = strtoupper($input['first_name']);
        if (isset($input['middle_name'])) {
            $input['middle_name'] = strtoupper($input['middle_name']);
        }
        $input['surname'] = strtoupper($input['surname']);
        $cadet->update($input);
        return Redirect::route('cadets.manage', [$cadet->slug()])
                ->with('success', UtilsController::response('Completed!', 'Cadet biodata has been updated.'));
    }
}
