<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="Book",
 *     type="object",
 *     title="Book",
 *     description="A book in the library",
 *     @OA\Property(
 *         property="id",
 *         type="integer",
 *         description="The unique identifier of the book",
 *         example=1
 *     ),
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
class Book extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'author', 'year_published', 'isbn'];
}
