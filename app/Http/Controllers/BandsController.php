<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Redirect;
use App\CdtBand;

class BandsController extends Controller
{
    public function index() {
        $bands = CdtBand::all();
        return view('bands.index', compact('bands'));
    }
    
    public function create() {
        return view('bands.create');
    }
    
    public function store(Request $request) {
        $input = $request->input();
        $error = "";
        $existing_band_lower = CdtBand::where('lower', '<=', $input['lower'])->where('upper', '>=', $input['lower']);
        $existing_band_upper = CdtBand::where('lower', '<=', $input['upper'])->where('upper', '>=', $input['upper']);
        if ($existing_band_lower->count() != 0) {
            $error .= "Lower limit falls within an existing band.<br />";
        }
        if ($existing_band_upper->count() != 0) {
            $error .= "Upper limit falls within an existing band.<br />";
        }
        if ($error != "") {
            return Redirect::back()
                    ->with('error', UtilsController::response('Oops!', $error))
                    ->withInput();
        } else {
            $band = CdtBand::create($input);
            if ($band) {
                ActivitiesController::log('Band was created - '.$band->quality.'.');
                return Redirect::route('bands.index')
                        ->with('success', UtilsController::response('Successful!', 'Band has been created.'));
            } else {
                return Redirect::back()
                        ->with('error', UtilsController::response('Unknown error!', 'Please contact administrator.'))
                        ->withInput();
            }
        }
    }
    
    public function destroy(CdtBand $band) {
        $band_quality = $band->quality;
        $band->delete();
        ActivitiesController::log('Band was deleted - '.$band_quality.'.');
        return Redirect::route('bands.index')
                ->with('success', UtilsController::response('Successful!', 'Band has been deleted.'));
    }
}
