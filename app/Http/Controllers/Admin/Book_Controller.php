<?php

namespace App\Http\Controllers\Admin;

use App\Book;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Book_Controller extends Controller
{

    public function bookstatus($book_id)
    {
        $book=Book::find($book_id);
        if($book->status==1){
            $book->status=0;
        }
        else{
            $book->status=1;
        }
        $book->save();
        return response()->json('susess');
    }
}
