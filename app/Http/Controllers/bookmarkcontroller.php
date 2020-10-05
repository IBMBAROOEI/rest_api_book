<?php

namespace App\Http\Controllers;

use App\Book;
use App\book_user;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class bookmarkcontroller extends Controller
{


    public function store(Request $request, $user_id, $book_id)
    {
        if( DB::table('book_user')->where([['user_id', $user_id], ['book_id', $book_id]])->exists()){
            return" dose not selected";
        }

        else{
            $user = User::find($user_id);
            $user->bookmarks()->attach($book_id);
            return response()->json('saved', 200);
        }

    }

    public function delete(Request $request, $user_id, $book_id)
    {
        $user = User::find($user_id);
        $user->bookmarks()->detach($book_id);
        return response()->json('not bookmark', 200);
    }

}
