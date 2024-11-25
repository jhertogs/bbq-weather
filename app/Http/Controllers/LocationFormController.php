<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class LocationFormController extends Controller
{
    public function getLocation(Request $request){
        if($request->isMethod('post')){
            $location = $request->input('location');

            return view('pages.bbq', ['location' => $location]);
        }
        
        
        return view('pages.bbq');
        
    }
}
