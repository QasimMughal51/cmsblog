<?php

namespace App\Http\Controllers;

use App\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function edit(){

        return view('admin.settings')->with('settings',Setting::all()->first());

    }
}
