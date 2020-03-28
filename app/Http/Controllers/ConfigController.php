<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Input;
use Redirect;
use App\CdtConfig;

class ConfigController extends Controller
{
    public function index() {
        $config = CdtConfig::whereId(1)->first();
        return view('config', compact('config'));
    }
    
    public function update(Request $request) {
        $input = $request->all();
        $config = CdtConfig::whereId(1)->first();
        if ($config->update($input)) {
            ActivitiesController::log('Configuration was updated.');
            return Redirect::route('config')
                    ->with('success', UtilsController::response('Successful!', 'Configuration has been updated.'));
        } else {
            return Redirect::back()
                    ->with('error', UtilsController::response('Unknown error!', 'Please contact administrator.'))
                    ->withInput();
        }
    }
}
