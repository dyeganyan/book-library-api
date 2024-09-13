<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\BookRequest;
use App\Services\BookService;
use Illuminate\Http\JsonResponse;

class BookApiController extends ApiController
{
    protected BookService $bookService;

    public function __construct(BookService $bookService)
    {
        $id = \request()->route('id');
        if ($id) {
            $this->validateExistence($id);
        }
        $this->bookService = $bookService;
    }

    /**
     * @OA\Get(
     *     path="/books",
     *     operationId="getBooksList",
     *     summary="Get list of books",
     *     tags={"Books"},
     *     @OA\Response(
     *         response=200,
     *         description="A list of books",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Book")
     *         )
     *     )
     * )
     */
    public function index(): JsonResponse
    {
        $books = $this->bookService->getAllBooks();

        return response()->json([
            'data' => $books
        ]);
    }

    /**
     * @OA\Post(
     *     path="/books",
     *     operationId="createBook",
     *     summary="Create a new book",
     *     tags={"Books"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/BookRequest")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Book created successfully",
     *         @OA\JsonContent(ref="#/components/schemas/Book")
     *     )
     * )
     */
    public function store(BookRequest $request): JsonResponse
    {
        $book = $this->bookService->createBook($request->all());

        return response()->json([
            'message' => 'Book successfully created',
            'data' => $book
        ], 201);
    }

    /**
     * @OA\Put(
     *     path="/books/{id}",
     *     operationId="updateBook",
     *     summary="Update an existing book",
     *     tags={"Books"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer"),
     *         description="The ID of the book to update"
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/BookRequest")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Book successfully updated",
     *         @OA\JsonContent(ref="#/components/schemas/Book")
     *     )
     * )
     */
    public function update(BookRequest $request, $id): JsonResponse
    {
        $book = $this->bookService->getBookById($id);
        $updatedBook = $this->bookService->updateBook($book, $request->all());

        return response()->json([
            'message' => 'Book successfully updated',
            'data' => $updatedBook
        ]);
    }

    /**
     * @OA\Delete(
     *     path="/books/{id}",
     *     operationId="deleteBook",
     *     summary="Delete a book",
     *     tags={"Books"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer"),
     *         description="The ID of the book to delete"
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Book successfully deleted",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", example="Book successfully deleted")
     *         )
     *     )
     * )
     */
    public function destroy($id): JsonResponse
    {
        $book = $this->bookService->getBookById($id);
        $this->bookService->deleteBook($book);

        return response()->json([
            'message' => 'Book successfully deleted'
        ]);
    }

    /**
     * @OA\Get(
     *     path="/books/{id}",
     *     operationId="getBookById",
     *     summary="Get a single book by ID",
     *     tags={"Books"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer"),
     *         description="The ID of the book to retrieve"
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="The requested book",
     *         @OA\JsonContent(ref="#/components/schemas/Book")
     *     )
     * )
     */
    public function show($id): JsonResponse
    {
        $book = $this->bookService->getBookById($id);

        return response()->json([
            'data' => $book
        ]);
    }
    private function validateExistence($id): void
    {
        validator(
            ['id' => $id],
            ['id' => 'exists:books'],
            ['id.exists' => 'Book Not Found']
        )->validate();
    }
}
