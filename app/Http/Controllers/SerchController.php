<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class SerchController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index( Request $request)
    {
        $data = $request->get('data');
        $search =DB::table('Books')

            ->orderBy('price_book','DESC')
            ->where('name_book', 'like',"%{$data}%")
            ->orwhere('name_writer','like',"%{$data}%")
            ->orwhere('year_printbook','like',"%{$data}%")
            ->orwhere('categore_id','like',"%{$data}%")
            ->first();
        return  \response()->json([
            'data' => $search
        ]);

    }
}

