<?php

namespace Tests\Unit;

use App\Models\Book;
use App\Services\BookService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class BookServiceTest extends TestCase
{
    use RefreshDatabase;

    protected BookService $bookService;

    public function setUp(): void
    {
        parent::setUp();
        $this->bookService = $this->app->make(BookService::class);
    }

    #[Test]
    public function it_creates_a_book()
    {
        $bookData = [
            'title' => 'Test Book',
            'author' => 'John Doe',
            'year_published' => 2022,
            'isbn' => '9781234567897',
        ];

        $book = $this->bookService->createBook($bookData);

        $this->assertDatabaseHas('books', [
            'title' => 'Test Book',
            'author' => 'John Doe',
            'year_published' => 2022,
            'isbn' => '9781234567897',
        ]);

        $this->assertInstanceOf(Book::class, $book);

    }

    #[Test]
    public function it_updates_a_book()
    {
        $book = Book::factory()->create([
            'title' => 'Old Title',
            'author' => 'Old Author',
            'year_published' => 2000,
            'isbn' => '9781234567897',
        ]);

        $updatedData = [
            'title' => 'Updated Title',
            'author' => 'New Author',
            'year_published' => 2022,
            'isbn' => '9781234567890',
        ];

        $updatedBook = $this->bookService->updateBook($book, $updatedData);

        $this->assertDatabaseHas('books', $updatedData);

        $this->assertEquals('Updated Title', $updatedBook->title);
        $this->assertEquals('New Author', $updatedBook->author);
    }

    #[Test]
    public function it_deletes_a_book()
    {
        $book = Book::factory()->create();

        $this->bookService->deleteBook($book);

        $this->assertDatabaseMissing('books', [
            'id' => $book->id,
        ]);
    }

    #[Test]
    public function it_retrieves_all_books()
    {
        Book::factory()->count(3)->create();

        $books = $this->bookService->getAllBooks();

        $this->assertCount(3, $books);
    }

    #[Test]
    public function it_retrieves_a_book_by_id()
    {
        $book = Book::factory()->create([
            'title' => 'Specific Book',
        ]);

        $retrievedBook = $this->bookService->getBookById($book->id);

        $this->assertEquals($book->id, $retrievedBook->id);
        $this->assertEquals('Specific Book', $retrievedBook->title);
    }
}
