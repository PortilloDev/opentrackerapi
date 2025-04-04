<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

/**
 * @OA\Info(
 *     title="TrackAPI - Activity Tracking API",
 *     version="1.0.0",
 *     description="Open Source Activity Tracking API - A powerful alternative to Strava and Garmin Connect",
 *     @OA\Contact(
 *         email="contact@trackapi.com",
 *         name="TrackAPI Support"
 *     ),
 *     @OA\License(
 *         name="MIT",
 *         url="https://opensource.org/licenses/MIT"
 *     )
 * )
 * 
 * @OA\Server(
 *     url="/api/v1",
 *     description="API Server"
 * )
 * 
 * @OA\SecurityScheme(
 *     securityScheme="bearerAuth",
 *     type="http",
 *     scheme="bearer",
 *     bearerFormat="JWT"
 * )
 */
class ApiDocController extends Controller
{
    // Este controlador no necesita métodos, solo anotaciones
}
