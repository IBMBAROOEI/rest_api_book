<?php

namespace App\Http\Controllers\Admin;
use App\Categore;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

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
            return response()->json(['message' => ' not found!'], 404);
        }
    }
    public function destroy($id)
    {
        $Categore=Categore::findOrfail($id);
        return response()->json($Categore->delete(),202);
    }

}
