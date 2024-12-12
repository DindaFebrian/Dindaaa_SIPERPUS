<?php

namespace App\Http\Controllers;

use App\Exports\BooksExport;
use App\Models\Book;
use App\Models\Bookshelf;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;


class BookController extends Controller
{
    public function index()
    {
        $books = Book::all();
        return view('books.index', compact('books'));
    }

    public function create()
    {
        $bookshelves = Bookshelf::pluck('name', 'id');
        return view('books.create', compact('bookshelves'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'author' => 'required|max:255',
            'year' => 'required|integer|min:1900|max:2024', 
            'publisher' => 'required|max:255',
            'city' => 'required|max:50',
            'cover' => 'required|image',
            'bookshelf_id' => 'required|exists:bookshelves,id',
        ]);

        if ($request->hasFile('cover')) {
            $path = $request->file('cover')->storeAs(
                'public/cover_buku',
                'cover_buku_' . time() . '.' . $request->file('cover')->extension()
            );
            $validated['cover'] = basename($path);
        }

        $book = Book::create($validated);

        $notification = $book
            ? ['message' => 'Data buku berhasil disimpan', 'alert-type' => 'success']
            : ['message' => 'Data buku gagal disimpan', 'alert-type' => 'error'];

        return redirect()->route('book')->with($notification);
    }

    public function edit($id)
    {
        $book = Book::findOrFail($id);
        $bookshelves = Bookshelf::pluck('name', 'id');
        return view('books.edit', compact('book', 'bookshelves'));
    }

    public function update(Request $request, $id)
    {
        $book = Book::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|max:255',
            'author' => 'required|max:255',
            'year' => 'required|integer|min:1900|max:2024', 
            'publisher' => 'required|max:255',
            'city' => 'required|max:50',
            'cover' => 'nullable|image',
            'bookshelf_id' => 'required|exists:bookshelves,id',
        ]);

        if ($request->hasFile('cover')) {
            if ($book->cover) {
                Storage::delete('public/cover_buku/' . $book->cover);
            }
            $path = $request->file('cover')->storeAs(
                'public/cover_buku',
                'cover_buku_' . time() . '.' . $request->file('cover')->extension()
            );
            $validated['cover'] = basename($path);
        }

        $book->update($validated);

        $notification = $book
            ? ['message' => 'Data buku berhasil diperbarui', 'alert-type' => 'success']
            : ['message' => 'Data buku gagal diperbarui', 'alert-type' => 'error'];

        return redirect()->route('book')->with($notification);
    }

    public function destroy($id)
    {
        $book = Book::findOrFail($id);

        if ($book->cover) {
            Storage::delete('public/cover_buku/' . $book->cover);
        }

        $deleted = $book->delete();

        $notification = $deleted
            ? ['message' => 'Data buku berhasil dihapus', 'alert-type' => 'success']
            : ['message' => 'Data buku gagal dihapus', 'alert-type' => 'error'];

        return redirect()->route('book')->with($notification);
    }

    public function print()
    {
        $books = Book::all();
        $pdf = Pdf::loadView('books.print', compact('books'));
        return $pdf->stream('DaftarBuku.pdf');
    }

    public function export()
    {
        return Excel::download(new BooksExport, 'book.xlsx');
    }
}