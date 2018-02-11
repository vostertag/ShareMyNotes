<?php

namespace ShareMyNotes\Http\Controllers;

use Illuminate\Http\Request;
use File;
use Response;

class StorageController extends Controller
{
    
	public function image(string $name){

		$path = storage_path('app/public/avatars/' . $name);

	    if (!File::exists($path)) {
	        abort(404);
	    }

	    $file = File::get($path);
	    $type = File::mimeType($path);

	    $response = Response::make($file, 200);
	    $response->header("Content-Type", $type);
	    return $response;
	}

	public function file(string $name){
		$path = storage_path('app/public/files/' . $name);

	    if (!File::exists($path)) {
	        abort(404);
	    }

	    $file = File::get($path);
	    $type = File::mimeType($path);

	    $response = Response::make($file, 200);
	    $response->header("Content-Type", $type);
	    return $response;
	}
    
}
