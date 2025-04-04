<?php 

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Track;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Track\TrackCreateRequest;

/**
 * @OA\Schema(
 *     schema="Track",
 *     required={"name", "type", "start_time", "duration"},
 *     @OA\Property(property="id", type="integer", format="int64", example=1),
 *     @OA\Property(property="name", type="string", example="Morning Run"),
 *     @OA\Property(property="type", type="string", example="running"),
 *     @OA\Property(property="start_time", type="string", format="date-time", example="2023-06-15T06:30:00Z"),
 *     @OA\Property(property="duration", type="integer", example=3600),
 *     @OA\Property(property="distance", type="integer", example=10000),
 *     @OA\Property(property="created_at", type="string", format="date-time"),
 *     @OA\Property(property="updated_at", type="string", format="date-time")
 * )
 */
class CreateTrackController extends Controller
{
    /**
     * @OA\Post(
     *     path="/tracks",
     *     summary="Create a new track",
     *     description="Creates a new activity track for the authenticated user",
     *     operationId="createTrack",
     *     tags={"Tracks"},
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name", "type", "start_time", "duration"},
     *             @OA\Property(property="name", type="string", example="Morning Run"),
     *             @OA\Property(property="type", type="string", example="running"),
     *             @OA\Property(property="start_time", type="string", format="date-time", example="2023-06-15T06:30:00Z"),
     *             @OA\Property(property="duration", type="integer", example=3600),
     *             @OA\Property(property="distance", type="integer", example=10000)
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Track created successfully",
     *         @OA\JsonContent(ref="#/components/schemas/Track")
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid input"
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated"
     *     )
     * )
     */
    public function create(TrackCreateRequest $request)
    {
        if (!Auth::check()) {
            return response()->json([
                'message' => 'Unauthenticated',
            ], Response::HTTP_UNAUTHORIZED);
        }
        
        $user = Auth::user();
        if (!$user) {
            return response()->json([
                'message' => 'User not found',
            ], Response::HTTP_UNAUTHORIZED);
        }

        try {
            $track = Track::create([
                'user_id' => $user->id,
                'distance' => $request->distance,
                'time' => $request->time,
                'description' => $request->description
            ]);

            return response()->json([
                'message' => 'Track created successfully',
                'data' => $track
            ], Response::HTTP_CREATED);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error creating track',
                'error' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
