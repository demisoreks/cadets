<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Redirect;
use App\CdtAssessment;

class AssessmentsController extends Controller
{
    public function index() {
        $assessments = CdtAssessment::all();
        return view('assessments.index', compact('assessments'));
    }
    
    public function create() {
        return view('assessments.create');
    }
    
    public function store(Request $request) {
        $input = $request->input();
        $error = "";
        $existing_assessments = CdtAssessment::where('description', $input['description']);
        if ($existing_assessments->count() != 0) {
            $error .= "Assessment already exists.<br />";
        }
        if ($error != "") {
            return Redirect::back()
                    ->with('error', UtilsController::response('Oops!', $error))
                    ->withInput();
        } else {
            $assessment = CdtAssessment::create($input);
            if ($assessment) {
                ActivitiesController::log('Assessment was created - '.$assessment->description.'.');
                return Redirect::route('assessments.index')
                        ->with('success', UtilsController::response('Successful!', 'Assessment has been created.'));
            } else {
                return Redirect::back()
                        ->with('error', UtilsController::response('Unknown error!', 'Please contact administrator.'))
                        ->withInput();
            }
        }
    }
    
    public function edit(CdtAssessment $assessment) {
        return view('assessments.edit', compact('assessment'));
    }
    
    public function update(CdtAssessment $assessment, Request $request) {
        $input = $request->input();
        $error = "";
        $existing_assessments = CdtAssessment::where('description', $input['description'])->where('id', '<>', $assessment->id);
        if ($existing_assessments->count() != 0) {
            $error .= "Assessment already exists.<br />";
        }
        if ($error != "") {
            return Redirect::back()
                    ->with('error', UtilsController::response('Oops!', $error))
                    ->withInput();
        } else {
            if ($assessment->update($input)) {
                ActivitiesController::log('Assessment was updated - '.$assessment->description.'.');
                return Redirect::route('assessments.index')
                        ->with('success', UtilsController::response('Successful!', 'Assessment has been updated.'));
            } else {
                return Redirect::back()
                        ->with('error', UtilsController::response('Unknown error!', 'Please contact administrator.'))
                        ->withInput();
            }
        }
    }
    
    public function disable(CdtAssessment $assessment) {
        $input['active'] = false;
        $assessment->update($input);
        ActivitiesController::log('Assessment was disabled - '.$assessment->description.'.');
        return Redirect::route('assessments.index')
                ->with('success', UtilsController::response('Successful!', 'Assessment has been disabled.'));
    }
    
    public function enable(CdtAssessment $assessment) {
        $input['active'] = true;
        $assessment->update($input);
        ActivitiesController::log('Assessment was enabled - '.$assessment->description.'.');
        return Redirect::route('assessments.index')
                ->with('success', UtilsController::response('Successful!', 'Assessment has been enabled.'));
    }
}
