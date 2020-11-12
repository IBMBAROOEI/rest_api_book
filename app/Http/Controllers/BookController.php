<?php
namespace App\Http\Controllers;
use App\Book;
use App\Categore;
use Illuminate\Auth\Access\Gate;
use App\Http\Controllers\Traits\fileupload;
use App\Models\user;
use http\Env\Response;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use function Sodium\increment;


//use function Sodium\increment;


class bookController extends Controller
{

    use fileupload;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $booK = Book::where('status', 1)->latest()->get();/* show book status  active*/
        return response()->json($booK, 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name_writer' => 'required|string',
            'name_book' => 'required|string',
            'categore_id'=>'required',
            'year_printbook' => 'required|date',
            'price_book' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $data = $validator->validated();
        try {
            $data['user_id'] = Auth::user()->id;
            $book = Book::create($data);
            $book->image = $this->uploadImage($request, 'image');
            $book->save();
            return response()->json(['message' => 'CREATED'], 200);
        } catch
        (\Exception $e) {
            return response()->json(['message' => 'this faild!'], 409);

        }
    }

    public function update($book_id, Request $request)
    {
        $book = Book::find($book_id);
        $validator = Validator::make($request->all(), [
            'name_writer' => 'required|string',
            'name_book' => 'required|string',
            'categore_id' => 'required',
            'year_printbook' => 'required|required|date',
            'price_book' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $data = $validator->validated();
        try {
            $data['user_id'] = Auth::user()->id;
            if ($request->File('image')) {
                $book->image = $this->uploadImage($request, 'image');
                $book->save();
            }
            return response()->json(['message' => 'update'], 200);
        } catch
        (\Exception $e) {
        }
        return response()->json(['message' => 'create book Failed!'], 409);
    }



    public function destroy($book_id)
    {
        $book = Book::findOrFail($book_id);
        $book->delete();
        return response()->json(['message' => 'delete'], 200);

    }


}




























//
//    public function destroy($book_id)
//    {
//        $book =book::findorfail($book_id);
//        $education =  $book->education
//            ->where('id', '=', $education_id)
//            ->first();
//        $education->delete();
//        return response(' Deleted Successfully', 200);
//    }
//    public function show($book_id)
//    {
//
//        $book = book::findorfail($book_id)->where('id', '=', $book_id)->first();
//        $book->increment('view_book');
//        return response()->json($book, 200);
//    }
//}
//
