<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Redirect;
use App\CdtMeasure;

class MeasuresController extends Controller
{
    public function index() {
        $measures = CdtMeasure::all();
        $percentage_sum = CdtMeasure::where('active', true)->sum('percentage');
        return view('measures.index', compact('measures', 'percentage_sum'));
    }
    
    public function create() {
        return view('measures.create');
    }
    
    public function store(Request $request) {
        $input = $request->input();
        $error = "";
        $existing_measures = CdtMeasure::where('description', $input['description']);
        if ($existing_measures->count() != 0) {
            $error .= "Quality measure already exists.<br />";
        }
        if ($error != "") {
            return Redirect::back()
                    ->with('error', UtilsController::response('Oops!', $error))
                    ->withInput();
        } else {
            $measure = CdtMeasure::create($input);
            if ($measure) {
                ActivitiesController::log('Quality measure was created - '.$measure->description.'.');
                return Redirect::route('measures.index')
                        ->with('success', UtilsController::response('Successful!', 'Quality measure has been created.'));
            } else {
                return Redirect::back()
                        ->with('error', UtilsController::response('Unknown error!', 'Please contact administrator.'))
                        ->withInput();
            }
        }
    }
    
    public function edit(CdtMeasure $measure) {
        return view('measures.edit', compact('measure'));
    }
    
    public function update(CdtMeasure $measure, Request $request) {
        $input = $request->input();
        $error = "";
        $existing_measures = CdtMeasure::where('description', $input['description'])->where('id', '<>', $measure->id);
        if ($existing_measures->count() != 0) {
            $error .= "Quality measure already exists.<br />";
        }
        if ($error != "") {
            return Redirect::back()
                    ->with('error', UtilsController::response('Oops!', $error))
                    ->withInput();
        } else {
            if ($measure->update($input)) {
                ActivitiesController::log('Quality measure was updated - '.$measure->description.'.');
                return Redirect::route('measures.index')
                        ->with('success', UtilsController::response('Successful!', 'Quality measure has been updated.'));
            } else {
                return Redirect::back()
                        ->with('error', UtilsController::response('Unknown error!', 'Please contact administrator.'))
                        ->withInput();
            }
        }
    }
    
    public function disable(CdtMeasure $measure) {
        $input['active'] = false;
        $measure->update($input);
        ActivitiesController::log('Quality measure was disabled - '.$measure->description.'.');
        return Redirect::route('measures.index')
                ->with('success', UtilsController::response('Successful!', 'Measure has been disabled.'));
    }
    
    public function enable(CdtMeasure $measure) {
        $input['active'] = true;
        $measure->update($input);
        ActivitiesController::log('Quality measure was enabled - '.$measure->description.'.');
        return Redirect::route('measures.index')
                ->with('success', UtilsController::response('Successful!', 'Measure has been enabled.'));
    }
}
