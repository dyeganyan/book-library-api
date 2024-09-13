<?php

namespace App\Http\Controllers\Api;

use Illuminate\Routing\Controller;
use OpenApi\Annotations as OA;

/**
 * @OA\OpenApi(
 *     @OA\Info(
 *         title="Library API",
 *         version="1.0.0",
 *         description="API documentation for the Library system"
 *     ),
 *     @OA\Server(
 *         url="http://127.0.0.1:8000/api/v1",
 *         description="Development server"
 *     ),
 * )
 */
class ApiController extends Controller
{
    //
}
