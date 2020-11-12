<?php

namespace App\Http\Controllers;
use App\Education;
use App\Model;
use App\Models\user;
use http\Env\Response;

use Illuminate\Http\Request;



class EchcationController extends Controller
{
    public function index()
    {
        return response()->json(Education::all() ,200);
    }

    public function store(Request $request)
    {
        $education = Education::create([
            'name' => $request->name,
        ]);
        return response()->json($education, 201);
    }

    public function update($id, Request $request)
    {
        try {
            $Education =Education::find($id);
            return response()->json($Education->update($request->all()), 200);
        } catch (\Exception $e) {
            return response()->json(['message' => ' not found!'], 404);
        }

    }
    public function destroy($id)
    {
        $Education=Education::findOrfail($id);
        return response()->json($Education->delete(),204);
    }
}

