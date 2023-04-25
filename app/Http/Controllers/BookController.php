<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $search = $request['search'] ?? "";
        if ($search) {
            $books = Book::where('title', 'LIKE', "%$search%")->orWhere('author', 'LIKE', "%$search%")->orWhere('description', 'LIKE', "%$search%")->orWhere('publication_date', 'LIKE', "%$search%")->simplePaginate(4);
        } else {
            $books = Book::simplePaginate(4);
        }
        $data = compact('books', 'search');
        return view('index')->with($data);
    }

    public function create()
    {

        return view('create');
    }

    public function store(Request $request)
    {
        // Validate input
        $request->validate([
            'title' => 'required|max:255',
            'author' => 'required|regex:/^[a-zA-Z\s]+$/|max:255',
            'publication_date' => 'before_or_equal:today|required|date',
            'description' => 'required|max:400',
        ], [
            'title.required' => 'Title is required.',
            'title.max' => 'Title cannot be longer than 255 characters.',
            'author.required' => 'Author name is required.',
            'author.regex' => 'Author name should contain only letters and spaces.',
            'author.max' => 'Author name cannot be longer than 255 characters.',
            'publication_date.required' => 'Publication date is required.',
            'publication_date.date' => 'Publication date should be a valid date.',
            'publication_date.before_or_equal' => 'Publication date cannot be a future date.',
            'description.required' => 'Description is required.',
            'description.max' => 'Description cannot be longer than 5000 characters.'
        ]);

        $book = new Book;
        $book->title = $request->input('title');
        $book->author = $request->input('author');
        $book->publication_date = $request->input('publication_date');
        $book->description = $request->input('description');
        $book->save();

        return redirect(route('books.index'))->with('success', 'Record created successfully!');
    }

    public function edit(Book $book)
    {
        return view('edit', compact('book'));
    }

    public function update(Request $request, Book $book)
    {
        // Validate input
        $request->validate([
            'title' => 'required|max:255',
            'author' => 'required|regex:/^[a-zA-Z\s]+$/|max:255',
            'publication_date' => 'required|date|before_or_equal:today',
            'description' => 'required|max:400',
        ], [
            'title.required' => 'Title is required.',
            'title.max' => 'Title cannot be longer than 255 characters.',
            'author.required' => 'Author name is required.',
            'author.regex' => 'Author name should contain only letters and spaces.',
            'author.max' => 'Author name cannot be longer than 255 characters.',
            'publication_date.required' => 'Publication date is required.',
            'publication_date.date' => 'Publication date should be a valid date.',
            'publication_date.before_or_equal' => 'Publication date cannot be a future date.',
            'description.required' => 'Description is required.',
            'description.max' => 'Description cannot be longer than 5000 characters.'
        ]);

        // Update book model with new data
        $book->title = $request->input('title');
        $book->author = $request->input('author');
        $book->publication_date = $request->input('publication_date');
        $book->description = $request->input('description');

        // Save changes to the database
        $book->save();

        // Redirect back to index page with success message
        return redirect()->route('books.index')->with('success', 'Book updated successfully.');
    }


    public function destroy(Book $book)
    {
        $book->delete();

        return redirect()->route('books.index')->with('success', 'Book deleted successfully.');
    }
}
