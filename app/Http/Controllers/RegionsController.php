<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Redirect;
use App\CdtRegion;

class RegionsController extends Controller
{
    public function index() {
        $regions = CdtRegion::all();
        return view('regions.index', compact('regions'));
    }
    
    public function create() {
        return view('regions.create');
    }
    
    public function store(Request $request) {
        $input = $request->input();
        $error = "";
        $existing_regions = CdtRegion::where('name', $input['name']);
        if ($existing_regions->count() != 0) {
            $error .= "Region name already exists.<br />";
        }
        if ($error != "") {
            return Redirect::back()
                    ->with('error', UtilsController::response('Oops!', $error))
                    ->withInput();
        } else {
            $region = CdtRegion::create($input);
            if ($region) {
                ActivitiesController::log('Region was created - '.$region->name.'.');
                return Redirect::route('regions.index')
                        ->with('success', UtilsController::response('Successful!', 'Region has been created.'));
            } else {
                return Redirect::back()
                        ->with('error', UtilsController::response('Unknown error!', 'Please contact administrator.'))
                        ->withInput();
            }
        }
    }
    
    public function edit(CdtRegion $region) {
        return view('regions.edit', compact('region'));
    }
    
    public function update(CdtRegion $region, Request $request) {
        $input = $request->input();
        $error = "";
        $existing_regions = CdtRegion::where('name', $input['name'])->where('id', '<>', $region->id);
        if ($existing_regions->count() != 0) {
            $error .= "Region name already exists.<br />";
        }
        if ($error != "") {
            return Redirect::back()
                    ->with('error', UtilsController::response('Oops!', $error))
                    ->withInput();
        } else {
            if ($region->update($input)) {
                ActivitiesController::log('Region was updated - '.$region->name.'.');
                return Redirect::route('regions.index')
                        ->with('success', UtilsController::response('Successful!', 'Region has been updated.'));
            } else {
                return Redirect::back()
                        ->with('error', UtilsController::response('Unknown error!', 'Please contact administrator.'))
                        ->withInput();
            }
        }
    }
    
    public function disable(CdtRegion $region) {
        $input['active'] = false;
        $region->update($input);
        ActivitiesController::log('Region was disabled - '.$region->name.'.');
        return Redirect::route('regions.index')
                ->with('success', UtilsController::response('Successful!', 'Region has been disabled.'));
    }
    
    public function enable(CdtRegion $region) {
        $input['active'] = true;
        $region->update($input);
        ActivitiesController::log('Region was enabled - '.$region->name.'.');
        return Redirect::route('regions.index')
                ->with('success', UtilsController::response('Successful!', 'Region has been enabled.'));
    }
}
