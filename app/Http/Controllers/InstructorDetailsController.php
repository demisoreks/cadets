<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Image;
use Storage;
use Redirect;
use App\AccEmployee;
use App\AccEmployeeRole;
use App\AccRole;
use App\CdtInstructorDetail;

class InstructorDetailsController extends Controller
{
    public function index() {
        $instructors = AccEmployee::where('active', true)->whereIn('id', AccEmployeeRole::where('role_id', AccRole::where('privileged_link_id', config('var.link_id'))->where('title', 'Instructor')->where('active', true)->first()->id)->pluck('employee_id')->toArray())->get();
        return view('instructor_details.index', compact('instructors'));
    }
    
    public function edit($employee_slug) {
        $employee = AccEmployee::findBySlug($employee_slug);
        return view('instructor_details.edit', compact('employee'));
    }
    
    public function store(Request $request) {
        $input = $request->input();
        $error = "";
        if ($request->hasFile('picture')) {
            if (!in_array($request->file('picture')->getClientOriginalExtension(), ['jpg'])) {
                $error .= "Invalid file type. Only jpg is allowed.<br />";
            }
            if ($request->file('picture')->getSize() > 1048576) {
                $error .= "File too large. File must be less than 1MB.<br />";
            }
        }
        if ($error != "") {
            return Redirect::back()
                    ->with('error', UtilsController::response('Oops!', $error))
                    ->withInput();
        } else {
            unset($input['picture']);
            $employee = AccEmployee::where('username', $input['username'])->first();
            $instructor_details = CdtInstructorDetail::where('employee_id', $employee->id);
            unset($input['username']);
            if ($instructor_details->count() == 0) {
                $input['employee_id'] = $employee->id;
                $instructor_detail = CdtInstructorDetail::create($input);
                if (!$instructor_detail) {
                    return Redirect::route('instructor_details.index')
                            ->with('error', UtilsController::response('Cannot create user!', 'Please contact administrator.'));
                }
            } else {
                $instructor_detail = $instructor_details->first();
                if (!$instructor_detail->update($input)) {
                    return Redirect::route('instructor_details.index')
                            ->with('error', UtilsController::response('Cannot update user!', 'Please contact administrator.'));
                }
            }
            if ($request->hasFile('picture')) {
                $img = Image::make($request->file('picture')->getRealPath());
                if ($img->width() > $img->height()) {
                    $img->resize(null, 300, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                } else {
                    $img->resize(300, null, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                }
                $img->crop(300, 300);
                Storage::put('public/pictures/'.$instructor_detail->id.'.jpg', $img->encode());
            }
            return Redirect::route('instructor_details.index')
                    ->with('success', UtilsController::response('Successful!', 'User has been updated.'));
        }
    }
}