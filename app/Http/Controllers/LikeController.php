<?php

namespace App\Http\Controllers;

use App\Book;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class likeController extends Controller
{
    public function like(Request $request, $user_id, $book_id)
    {
        if( DB::table('book_user_like')->where([['user_id', $user_id], ['book_id', $book_id]])->exists()){
            return" is___________________________like";
        }
        else{
            $user = User::find($user_id);
            $user->like_books()->attach($book_id);
            return response()->json('is __________________like', 200);
        }

    }

    public function dislike(Request $request, $user_id, $book_id)
    {
        $user = User::find($user_id);
        $user->like_books()->detach($book_id);
        return response()->json('dis_________________like', 200);
    }
    public  function show($book_id){
        $like=DB::table('book_user_like')->where('book_id', '=',$book_id)->count();
        return response()->json($like,200);



    }
}
