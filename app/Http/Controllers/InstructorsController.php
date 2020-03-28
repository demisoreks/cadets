<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Redirect;
use App\CdtRegion;
use App\CdtInstructor;

class InstructorsController extends Controller
{
    public function index(CdtRegion $region) {
        $instructors = CdtInstructor::where('region_id', $region->id)->get();
        return view('instructors.index', compact('region', 'instructors'));
    }
    
    public function create(CdtRegion $region) {
        return view('instructors.create', compact('region'));
    }
    
    public function store(CdtRegion $region, Request $request) {
        $input = $request->input();
        $error = "";
        $existing_instructors = CdtInstructor::where('employee_id', $input['employee_id'])->where('region_id', $region->id);
        if ($existing_instructors->count() != 0) {
            $error .= "Instructor already exists under the selected region.<br />";
        }
        if ($error != "") {
            return Redirect::back()
                    ->with('error', UtilsController::response('Oops!', $error))
                    ->withInput();
        } else {
            $input['region_id'] = $region->id;
            $instructor = CdtInstructor::create($input);
            if ($instructor) {
                ActivitiesController::log('Instructor was created - '.$instructor->employee->username.' under '.$instructor->region->name.' region.');
                return Redirect::route('regions.instructors.index', [$region->slug()])
                        ->with('success', UtilsController::response('Successful!', 'Instructor has been created.'));
            } else {
                return Redirect::back()
                        ->with('error', UtilsController::response('Unknown error!', 'Please contact administrator.'))
                        ->withInput();
            }
        }
    }
    
    public function destroy(CdtRegion $region, CdtInstructor $instructor) {
        $employee_username = $instructor->employee->username;
        $region_name = $instructor->region->name;
        $instructor->delete();
        ActivitiesController::log('Instructor was deleted - '.$employee_username.' under '.$region_name.' region.');
        return Redirect::route('regions.instructors.index', [$region->slug()])
                ->with('success', UtilsController::response('Successful!', 'Instructor has been deleted.'));
    }
}
