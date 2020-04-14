<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Redirect;
use App\CdtCourse;
use App\CdtRegion;
use App\CdtLocation;
use App\CdtInstructor;
use App\CdtCadet;

use Carbon\Carbon;

class CoursesController extends Controller
{
    public function index() {
        $courses = CdtCourse::whereIn('location_id', 
                CdtLocation::whereIn('region_id', 
                        CdtInstructor::where('employee_id', UtilsController::getEmployee()->id)
                                ->pluck('region_id')
                                ->toArray()
                        )
                        ->pluck('id')
                        ->toArray()
                )
                ->get();
        return view('courses.index', compact('courses'));
    }
    
    public function create() {
        return view('courses.create');
    }
    
    static function getNextCourseCode(CdtLocation $location, $start_date) {
        $courses = CdtCourse::whereIn('location_id', CdtLocation::where('region_id', $location->region->id)->pluck('id')->toArray())->whereRaw('SUBSTRING(start_date, 1, 4) = '.substr($start_date, 0, 4));
        if ($courses->count() == 0) {
            $new_code = '001';
        } else {
            $last_code = CdtCourse::where('location_id', $location->id)->whereRaw('SUBSTRING(start_date, 1, 4) = '.substr($start_date, 0, 4))->max('code');
            $code = (int) $last_code;
            $code ++;
            $new_code = str_pad($code, 3, '0', STR_PAD_LEFT);
        }
        return $new_code;
    }
    
    public function store(Request $request) {
        $input = $request->input();
        $error = "";
        $existing_courses = CdtCourse::where('start_date', $input['start_date'])->where('end_date', $input['end_date'])->where('location_id', $input['location_id']);
        if ($existing_courses->count() != 0) {
            $error .= "Course already exists under the selected location.<br />";
        }
        if ($error != "") {
            return Redirect::back()
                    ->with('error', UtilsController::response('Oops!', $error))
                    ->withInput();
        } else {
            $input['code'] = $this->getNextCourseCode(CdtLocation::whereId($input['location_id'])->first(), $input['start_date']);
            $course = CdtCourse::create($input);
            if ($course) {
                ActivitiesController::log('Course was created starting '.$course->start_date.' under '.$course->location->name.'.');
                return Redirect::route('courses.index')
                        ->with('success', UtilsController::response('Successful!', 'Course has been created.'));
            } else {
                return Redirect::back()
                        ->with('error', UtilsController::response('Unknown error!', 'Please contact administrator.'))
                        ->withInput();
            }
        }
    }
    
    public function edit(CdtCourse $course) {
        return view('courses.edit', compact('course'));
    }
    
    public function update(CdtCourse $course, Request $request) {
        $input = $request->input();
        $error = "";
        $existing_courses = CdtCourse::where('start_date', $input['start_date'])->where('end_date', $input['end_date'])->where('location_id', $input['location_id'])->where('id', '<>', $course->id);
        if ($existing_courses->count() != 0) {
            $error .= "Course already exists under the selected location.<br />";
        }
        if ($error != "") {
            return Redirect::back()
                    ->with('error', UtilsController::response('Oops!', $error))
                    ->withInput();
        } else {
            if ($course->update($input)) {
                ActivitiesController::log('Course was updated starting '.$course->start_date.' under '.$course->location->name.'.');
                return Redirect::route('courses.index')
                        ->with('success', UtilsController::response('Successful!', 'Course has been updated.'));
            } else {
                return Redirect::back()
                        ->with('error', UtilsController::response('Unknown error!', 'Please contact administrator.'))
                        ->withInput();
            }
        }
    }
    
    public function disable(CdtCourse $course) {
        $input['active'] = false;
        $course->update($input);
        ActivitiesController::log('Course was disabled starting '.$course->start_date.' under '.$course->location->name.'.');
        return Redirect::route('courses.index')
                ->with('success', UtilsController::response('Successful!', 'Course has been disabled.'));
    }
    
    public function enable(CdtCourse $course) {
        $input['active'] = true;
        $course->update($input);
        ActivitiesController::log('Course was enabled starting '.$course->start_date.' under '.$course->location->name.'.');
        return Redirect::route('courses.index')
                ->with('success', UtilsController::response('Successful!', 'Region has been enabled.'));
    }
    
    public function approvals() {
        $courses = CdtCourse::where('approved_by', 0)->get();
        return view('courses.approvals', compact('courses'));
    }
    
    public function cadets(CdtCourse $course) {
        $cadets = CdtCadet::where('course_id', $course->id)->get();
        
        $status_chart = CadetsController::getStatusChart($course);
        $gender_chart = CadetsController::getGenderChart($course);
        
        return view('courses.cadets', compact('cadets', 'course', 'status_chart', 'gender_chart'));
    }
    
    public function approve(CdtCourse $course) {
        $input = ['approved_by' => UtilsController::getEmployee()->id, 'approved_at' => Carbon::now()];
        $course->update($input);
        ActivitiesController::log('Course was approved starting '.$course->start_date.' under '.$course->location->name.'.');
        return Redirect::route('courses.approvals')
                ->with('success', UtilsController::response('Successful!', 'Course has been approved.'));
    }
}
