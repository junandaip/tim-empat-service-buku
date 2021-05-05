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

public function getId($id){
    $book = Book::where('id', $id)->first();
        if ($book) {
            return 
            response()->json([
                'message' => 'show book by id',
                'data' => $book ], 201);
            
        } else {
            return response()->json([
                'message' => 'Book Not Found',
            ], 404);
        }
    }
    
public function getJudul($judul){
    $buku = Book::where('judul', $judul)->first();
        if ($buku) {
            return 
            response()->json([
                'message' => 'tampil buku by judul',
                'data' => $buku ], 201);
            
        } else {
            return response()->json([
                'message' => 'buku tidak ada',
            ], 404);
        }
    }

public function createBuku (Request $request){
    $this->validate($request, [ 
        'judul' => 'required',
        'penulis' => 'required',
        'kategori' => 'required',
        'stock' => 'required'
    ]);

    $buku = Book::create(
        $request->only(['judul', 'penulis', 'kategori', 'stock'])
    );

    return response()->json([
       'updated'=>true,
       'data'=>$buku
   ], 200);
    }

    public function updateBuku(Request $request, $id){
        try {
            $buku = Book::findOrFail ($id);
        } catch (ModelNotFoundException $e){
            return response()->json([
                'message' => 'buku tidak ada'
            ], 404);
        }
    

    $buku->fill (
        $request->only(['judul', 'penulis', 'kategori', 'stock'])
    );

    $buku->save();

    return response()->json([
        'created' => true,
        'data' => $buku
    ], 200);
    }

    public function deletebyId($id){
        try{
            $buku = Book::findOrFail($id);
        } catch (ModelNotFoundException $e){
            return response()->json([
                'error' => [
                    'message' => 'buku gagal dihapus'
                ]
                ], 404);
        }

        $buku->delete();

        return response()->json([
            'buku berhasil di hapus' => true
        ], 200);
    }
}
