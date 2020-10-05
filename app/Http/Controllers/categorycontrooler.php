<?php

namespace App\Http\Controllers;

use App\Categore;
use Illuminate\Http\Request;


class categorycontrooler extends Controller
{

    public  function index(){

        return response()->json(Categore::all(), 200);
    }
    public function store(Request $request){
        return response()->json(Categore::create($request->all()),201);
    }

    public  function update(Request $request,$id)
    {
        try {
            $Categore = Categore::find($id);
            return response()->json($Categore->update($request->all()), 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'useremail not found!'], 404);
        }
    }
    public function destroy($id)
    {
        $Categore=Categore::findOrfail($id);
        return response()->json($Categore->delete(),204);
    }
}
