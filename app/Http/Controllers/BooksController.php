<?php

namespace App\Http\Controllers;
use App\Models\Book;
use \Illuminate\Http\Request;
use \Illuminate\Http\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class BooksController extends Controller
{
public function index()
{
    return Book::all();
}

public function Kategori($kategori){
    $book = Book::where('kategori', $kategori)->first();
        if ($book) {
            return 
            response()->json([
                'message' => 'show book by kategori',
                'data' => $book ], 201);
            
        } else {
            return response()->link([
                'message' => 'Book Not Found',
            ], 404);
        }
    }

public function post (Request $request){
    $this->validate($request, [ 
        'judul' => 'required',
        'penulis' => 'required',
        'kategori' => 'required',
        'stock' => 'required'
    ]);

    $book = Book::create(
        $request->only(['judul', 'penulis', 'kategori', 'stock'])
    );

    return response()->json([
       'updated'=>true,
       'data'=>$book
   ], 200);
    }

    public function put(Request $request, $id){
        try {
            $book = Book::findOrFail ($id);
        } catch (ModelNotFoundException $e){
            return response()->json([
                'message' => 'book not found'
            ], 404);
        }
    

    $book->fill (
        $request->only(['judul', 'penulis', 'kategori', 'stock'])
    );

    $book->save();

    return response()->json([
        'created' => true,
        'data' => $book
    ], 200);
    }

    public function destroy($id){
        try{
            $book = Book::findOrFail($id);
        } catch (ModelNotFoundException $e){
            return response()->json([
                'error' => [
                    'message' => 'book not found'
                ]
                ], 404);
        }

        $book->delete();

        return response()->json([
            'deleted' => true
        ], 200);
    }
}