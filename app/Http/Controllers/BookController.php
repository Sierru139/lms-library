<?php

namespace App\Http\Controllers;

use App\Http\Resources\BookResource;
use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BookController extends Controller
{
    public function index()
    {
        $books = BookResource::collection(Book::orderBy('id','desc')->with('category','author','location')->paginate(6));
        return Inertia::render('Book/Index', compact('books'));
    }

    public function create()
    {
        $categories = Category::all();
        $authors = Author::where('status',1)->get();
        return Inertia::render('Book/Create', compact('categories','authors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal_buat' => 'required|date',
            'no_induk' => 'required',
            'no_judul' => 'required',
            'judul_buku' => 'required|min:3',
            // 'author' => 'required',
            'penerbit' => 'required',
            'cet_ed' => 'nullable|string',
            'jilid' => 'nullable|string',
            'kota_terbit' => 'nullable|string',
            'tahun_terbit' => 'nullable|string',
            'asal' => 'required|in:Beli,Hadiah',
            'harga' => 'nullable|numeric',
            'jum' => 'nullable|string',
            'no_class' => 'nullable|string',
            'ket' => 'nullable|string',
            'no_of_copy' => 'required|numeric',
            'status' => 'required|in:0,1',
            'category' => 'required|exists:categories,id',
            'author' => 'required|exists:authors,id',
        ]);

        Book::create([
            'tanggal_buat' => $request->tanggal_buat,
            'no_induk' => $request->no_induk,
            'no_judul' => $request->no_judul,
            'name' => $request->judul_buku,
            // 'author' => $request->author,
            'penerbit' => $request->penerbit,
            'cet_ed' => $request->cet_ed,
            'jilid' => $request->jilid,
            'kota_terbit' => $request->kota_terbit,
            'tahun_terbit' => $request->tahun_terbit,
            'buy_from' => $request->asal,
            'harga' => $request->harga,
            'jumlah' => $request->jum,
            'no_class' => $request->no_class,
            'keterangan' => $request->ket,
            'no_of_copy' => $request->no_of_copy,
            'status' => $request->status,
            'category_id' => $request->category,
            'author_id' => $request->author,
        ]);

        return redirect()->route('book.index')->with('message','Book Created Successfully!');
    }

    public function show(Book $book)
    {
        //
    }

    public function edit(Book $book)
    {
        $categories = Category::all();
        $authors = Author::where('status',1)->get();
        // $locations = LocationRack::where('status',1)->get();
        return Inertia::render('Book/Edit', compact('book','categories','authors'));
    }

    public function update(Request $request, Book $book)
    {
        $request->validate([
            'tanggal_buat' => 'required|date',
            'name' => 'required',
            'no_induk' => 'required',
            'no_judul' => 'required',
            // 'judul_buku' => 'required|min:3',
            'author' => 'required',
            'penerbit' => 'required',
            'cet_ed' => 'nullable|string',
            'jilid' => 'nullable|string',
            'kota_terbit' => 'nullable|string',
            'tahun_terbit' => 'nullable|string',
            'asal' => 'required|in:Beli,Hadiah',
            'harga' => 'nullable|numeric',
            'jum' => 'nullable|string',
            'no_class' => 'nullable|string',
            'ket' => 'nullable|string',
            'no_of_copy' => 'required|numeric',
            'status' => 'required|in:0,1',
            'category' => 'required|exists:categories,id',
        ]);

        $book->update([
            'tanggal_buat' => $request->tanggal_buat,
            'no_induk' => $request->no_induk,
            'no_judul' => $request->no_judul,
            'name' => $request->name,
            'author_id' => $request->author,
            'penerbit' => $request->penerbit,
            'cet_ed' => $request->cet_ed,
            'jilid' => $request->jilid,
            'kota_terbit' => $request->kota_terbit,
            'tahun_terbit' => $request->tahun_terbit,
            'buy_from' => $request->asal,
            'harga' => $request->harga,
            'jumlah' => $request->jum,
            'no_class' => $request->no_class,
            'keterangan' => $request->ket,
            'no_of_copy' => $request->no_of_copy,
            'status' => $request->status,
            'category_id' => $request->category,
        ]);

        return redirect()->route('book.index')->with('message','Book Updated Successfully!');
    }

    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->back()->with('message','Book Deleted Successfully!');
    }

    public function search(Request $request)
    {
        $request->validate([
            'search' => 'nullable|string|max:255',
        ]);

        $books = Book::with(['category', 'author'])
            ->when($request->search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('no_induk', 'like', "%{$search}%")
                      ->orWhereHas('author', function($query) use ($search) {
                          $query->where('name', 'like', "%{$search}%");
                      });
                });
            })
            ->orderByDesc('id')
            ->paginate(25)
            ->withQueryString();

        return Inertia::render('Book/Index', [
            'books' => BookResource::collection($books),
            'filters' => [
                'search' => $request->search,
            ],
        ]);
    }
}
