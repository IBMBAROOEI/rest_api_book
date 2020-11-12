<?php
namespace App\Http\Controllers\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;


trait fileupload
{
    public function uploadImage(Request $request, $fieldname = 'image')
    {
        try{
            if (!$request->file($fieldname)) {
                return null;
            }
            $file = $request->file($fieldname)->getClientOriginalName();
            $name = time() . $file;
            $destinationPath = "images/";
            $request->file($fieldname)->move($destinationPath, $name);
            return $name;
        }
        catch (\Exception $e) {
            return response()->json(['message' => ' do not upload !'], 409);
        }

    }

}