<?php

namespace App\Services;

use App\Models\Book;

class BookService
{
    public function createBook(array $data)
    {
        return Book::create($data);
    }

    public function updateBook(Book $book, array $data)
    {
        $book->update($data);
        return $book;
    }

    public function deleteBook(Book $book)
    {
        return $book->delete();
    }

    public function getAllBooks()
    {
        return Book::all();
    }

    public function getBookById($id)
    {
        return Book::findOrFail($id);
    }
}

