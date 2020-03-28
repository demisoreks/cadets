<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Redirect;
use App\CdtRegion;
use App\CdtLocation;

class LocationsController extends Controller
{
    public function index(CdtRegion $region) {
        $locations = CdtLocation::where('region_id', $region->id)->get();
        return view('locations.index', compact('locations', 'region'));
    }
    
    public function create(CdtRegion $region) {
        return view('locations.create', compact('region'));
    }
    
    public function store(CdtRegion $region, Request $request) {
        $input = $request->input();
        $error = "";
        $existing_location_names = CdtLocation::where('name', $input['name'])->where('region_id', $region->id);
        $existing_location_codes = CdtLocation::where('code', $input['code'])->where('region_id', $region->id);
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
            $input['region_id'] = $region->id;
            $input['code'] = strtoupper($input['code']);
            $location = CdtLocation::create($input);
            if ($location) {
                ActivitiesController::log('Location was created - '.$location->name.' under '.$location->region->name.' region.');
                return Redirect::route('regions.locations.index', [$region->slug()])
                        ->with('success', UtilsController::response('Successful!', 'Location has been created.'));
            } else {
                return Redirect::back()
                        ->with('error', UtilsController::response('Unknown error!', 'Please contact administrator.'))
                        ->withInput();
            }
        }
    }
    
    public function edit(CdtRegion $region, CdtLocation $location) {
        return view('locations.edit', compact('region', 'location'));
    }
    
    public function update(CdtRegion $region, CdtLocation $location, Request $request) {
        $input = $request->input();
        $error = "";
        $existing_location_names = CdtLocation::where('name', $input['name'])->where('region_id', $region->id)->where('id', '<>', $location->id);
        $existing_location_codes = CdtLocation::where('code', $input['code'])->where('region_id', $region->id)->where('id', '<>', $location->id);
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
                return Redirect::route('regions.locations.index', [$region->slug()])
                        ->with('success', UtilsController::response('Successful!', 'Location has been updated.'));
            } else {
                return Redirect::back()
                        ->with('error', UtilsController::response('Unknown error!', 'Please contact administrator.'))
                        ->withInput();
            }
        }
    }
    
    public function disable(CdtRegion $region, CdtLocation $location) {
        $input['active'] = false;
        $location->update($input);
        ActivitiesController::log('Location was disabled - '.$location->name.' under '.$location->region->name.' region.');
        return Redirect::route('regions.locations.index', [$region->slug()])
                ->with('success', UtilsController::response('Successful!', 'Location has been disabled.'));
    }
    
    public function enable(CdtRegion $region, CdtLocation $location) {
        $input['active'] = true;
        $location->update($input);
        ActivitiesController::log('Location was enabled - '.$location->name.' under '.$location->region->name.' region.');
        return Redirect::route('regions.locations.index', [$region->slug()])
                ->with('success', UtilsController::response('Successful!', 'Location has been enabled.'));
    }
}
