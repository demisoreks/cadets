<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Redirect;
use App\CdtMetric;

class MetricsController extends Controller
{
    public function index() {
        $metrics = CdtMetric::all();
        $percentage_sum = CdtMetric::where('active', true)->sum('percentage');
        return view('metrics.index', compact('metrics', 'percentage_sum'));
    }
    
    public function create() {
        return view('metrics.create');
    }
    
    public function store(Request $request) {
        $input = $request->input();
        $error = "";
        $existing_metrics = CdtMetric::where('description', $input['description']);
        if ($existing_metrics->count() != 0) {
            $error .= "Exam metric already exists.<br />";
        }
        if ($error != "") {
            return Redirect::back()
                    ->with('error', UtilsController::response('Oops!', $error))
                    ->withInput();
        } else {
            $metric = CdtMetric::create($input);
            if ($metric) {
                ActivitiesController::log('Exam metric was created - '.$metric->description.'.');
                return Redirect::route('metrics.index')
                        ->with('success', UtilsController::response('Successful!', 'Exam metric has been created.'));
            } else {
                return Redirect::back()
                        ->with('error', UtilsController::response('Unknown error!', 'Please contact administrator.'))
                        ->withInput();
            }
        }
    }
    
    public function edit(CdtMetric $metric) {
        return view('metrics.edit', compact('metric'));
    }
    
    public function update(CdtMetric $metric, Request $request) {
        $input = $request->input();
        $error = "";
        $existing_metrics = CdtMetric::where('description', $input['description'])->where('id', '<>', $metric->id);
        if ($existing_metrics->count() != 0) {
            $error .= "Exam metric already exists.<br />";
        }
        if ($error != "") {
            return Redirect::back()
                    ->with('error', UtilsController::response('Oops!', $error))
                    ->withInput();
        } else {
            if ($metric->update($input)) {
                ActivitiesController::log('Exam metric was updated - '.$metric->description.'.');
                return Redirect::route('metrics.index')
                        ->with('success', UtilsController::response('Successful!', 'Exam metric has been updated.'));
            } else {
                return Redirect::back()
                        ->with('error', UtilsController::response('Unknown error!', 'Please contact administrator.'))
                        ->withInput();
            }
        }
    }
    
    public function disable(CdtMetric $metric) {
        $input['active'] = false;
        $metric->update($input);
        ActivitiesController::log('Exam metric was disabled - '.$metric->description.'.');
        return Redirect::route('metrics.index')
                ->with('success', UtilsController::response('Successful!', 'Metric has been disabled.'));
    }
    
    public function enable(CdtMetric $metric) {
        $input['active'] = true;
        $metric->update($input);
        ActivitiesController::log('Exam metric was enabled - '.$metric->description.'.');
        return Redirect::route('metrics.index')
                ->with('success', UtilsController::response('Successful!', 'Metric has been enabled.'));
    }
}
