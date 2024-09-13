<?php

namespace App\Http\Requests;

use App\Models\Book;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="BookRequest",
 *     type="object",
 *     required={"title", "author", "year_published", "isbn"},
 *     @OA\Property(
 *         property="title",
 *         type="string",
 *         description="The title of the book",
 *         example="The Great Gatsby"
 *     ),
 *     @OA\Property(
 *         property="author",
 *         type="string",
 *         description="The author of the book",
 *         example="F. Scott Fitzgerald"
 *     ),
 *     @OA\Property(
 *         property="year_published",
 *         type="integer",
 *         description="The year the book was published",
 *         example=1925
 *     ),
 *     @OA\Property(
 *         property="isbn",
 *         type="string",
 *         description="The ISBN-13 of the book",
 *         example="9781234567897"
 *     )
 * )
 */
class BookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $bookId = $this->route('book');
        $updatingBook = $bookId ? Book::find($this->route('id')) : null;

        return [
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'year_published' => 'required|integer|min:1800',
            'isbn' => ['required', 'string', 'size:13',
                Rule::unique('books', 'isbn')->ignore(
                    $bookId && $updatingBook->isbn === $this->input('isbn')
                ),
            ],
        ];
    }
}
