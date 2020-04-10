<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Redirect;
use App\CdtRegion;
use App\CdtLocation;
use App\CdtCourse;
use App\CdtInstructor;

class LocationsController extends Controller
{
    public function index() {
        $locations = CdtLocation::whereIn('region_id', CdtInstructor::where('employee_id', UtilsController::getEmployee()->id)->pluck('region_id')->toArray())->get();
        return view('locations.index', compact('locations'));
    }
    
    public function create() {
        return view('locations.create');
    }
    
    public function store(Request $request) {
        $input = $request->input();
        $error = "";
        $existing_location_names = CdtLocation::where('name', $input['name']);
        $existing_location_codes = CdtLocation::where('code', $input['code']);
        if ($existing_location_names->count() != 0) {
            $error .= "Location name already exists under the selected region.<br />";
        }
        if ($existing_location_codes->count() != 0) {
            $error .= "Location code already exists under the selected region.<br />";
        }
        if ($error != "") {
            return Redirect::back()
                    ->with('error', UtilsController::response('Oops!', $error))
                    ->withInput();
        } else {
            $input['code'] = strtoupper($input['code']);
            $location = CdtLocation::create($input);
            if ($location) {
                ActivitiesController::log('Location was created - '.$location->name.' under '.$location->region->name.' region.');
                return Redirect::route('locations.index')
                        ->with('success', UtilsController::response('Successful!', 'Location has been created.'));
            } else {
                return Redirect::back()
                        ->with('error', UtilsController::response('Unknown error!', 'Please contact administrator.'))
                        ->withInput();
            }
        }
    }
    
    public function edit(CdtLocation $location) {
        return view('locations.edit', compact('location'));
    }
    
    public function update(CdtLocation $location, Request $request) {
        $input = $request->input();
        $error = "";
        $existing_location_names = CdtLocation::where('name', $input['name'])->where('id', '<>', $location->id);
        $existing_location_codes = CdtLocation::where('code', $input['code'])->where('id', '<>', $location->id);
        if ($existing_location_names->count() != 0) {
            $error .= "Location name already exists under the selected region.<br />";
        }
        if ($existing_location_codes->count() != 0) {
            $error .= "Location code already exists under the selected region.<br />";
        }
        if ($error != "") {
            return Redirect::back()
                    ->with('error', UtilsController::response('Oops!', $error))
                    ->withInput();
        } else {
            if ($location->update($input)) {
                ActivitiesController::log('Location was updated - '.$location->name.' under '.$location->region->name.' region.');
                return Redirect::route('locations.index')
                        ->with('success', UtilsController::response('Successful!', 'Location has been updated.'));
            } else {
                return Redirect::back()
                        ->with('error', UtilsController::response('Unknown error!', 'Please contact administrator.'))
                        ->withInput();
            }
        }
    }
    
    public function disable(CdtLocation $location) {
        $input['active'] = false;
        $location->update($input);
        ActivitiesController::log('Location was disabled - '.$location->name.' under '.$location->region->name.' region.');
        return Redirect::route('locations.index')
                ->with('success', UtilsController::response('Successful!', 'Location has been disabled.'));
    }
    
    public function enable(CdtLocation $location) {
        $input['active'] = true;
        $location->update($input);
        ActivitiesController::log('Location was enabled - '.$location->name.' under '.$location->region->name.' region.');
        return Redirect::route('locations.index')
                ->with('success', UtilsController::response('Successful!', 'Location has been enabled.'));
    }
    
    public function getCoursesDesc(int $location_id) {
        return CdtCourse::select(DB::raw("DATE_FORMAT(start_date, '%b %e, %Y') AS start"), DB::raw("DATE_FORMAT(end_date, '%b %e, %Y') AS end"), 'id')->where('location_id', $location_id)->where('active', true)->orderBy('start_date', 'desc')->get()->toJson();
    }
}
