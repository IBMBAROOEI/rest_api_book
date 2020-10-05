<?php
namespace App\Http\Controllers;
use App\Book;
use App\Categore;

use App\Http\Controllers\Traits\fileupload;
use App\Models\user;
use http\Env\Response;
use Illuminate\Http\Request;
use function Sodium\increment;

//use function Sodium\increment;


class bookcontroller extends Controller
{
    use fileupload;
    public function index()
    {

        return response()->json(Book::all(), 200);
    }

    public function store(Request $request, $user_id,$category_id)
    {

        $this->validate($request, [
            'name_writer' => 'required|string',
            'name_book' => 'required|string',
            'year_printbook' => 'required|required|date',
            'price_book'=>'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $user = user::find($user_id);
        $category=Categore::find($category_id);
        $education = book::create([
            'name_book' => $request->name_book,
            'user_id' => $user->id,
            'categore_id'=> $category->id,
            'year_printbook'=>$request->year_printbook,
            'price_book'=>$request->price_book,
            'name_writer'=>$request->name_writer,
            'image'=>  $this->uploadImage($request, 'image'),
        ]);
        return response()->json($education, 201);
    }

    public function update($user_id, $education_id, Request $request)
    {
        try {
            $user = user::find($user_id);
            $education = $user->education->where('id', '=', $education_id)->first()->update($request->all());
            return response()->json($education, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'useremail not found!'], 404);
        }
    }
    public function destroy($user_id,$education_id)
    {
        $user = user::findorfail($user_id);
        $education = $user->education
            ->where('id', '=', $education_id)
            ->first();
        $education->delete();
        return response(' Deleted Successfully', 200);
    }
    public function show($book_id)
    {

        $book = book::findorfail($book_id)->where('id', '=', $book_id)->first();
        $book->increment('view_book');
        return response()->json($book, 200);
    }
}

