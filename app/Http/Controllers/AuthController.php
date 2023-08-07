<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Validator;
use Log;
use Swagger\Annotations as SWG;
use OpenApi\Annotations as OA;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }
    /**
     * @OA\Post(
     *     path="/api/v1/login",
     *     summary="User login",
     *     tags={"Authentication"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="email", type="string", example="user@example.com"),
     *             @OA\Property(property="password", type="string", example="password123"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Login successful",
     *         @OA\JsonContent(
     *             @OA\Property(property="access_token", type="string"),
     *             @OA\Property(property="token_type", type="string", example="Bearer"),
     *             @OA\Property(property="expires_in", type="integer"),
     *             @OA\Property(property="user", type="object"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal Server Error"
     *     )
     * )
     */
    public function login(Request $request)
    {

       

        $validator = Validator::make($request->all() , ['email' => 'required|email', 'password' => 'required|string|min:6', ]);

        if ($validator->fails())
        {
            return response()
                ->json($validator->errors() , 422);
        }
       
        if (!$token = auth()->attempt($validator->validated()))
        {
         
            return response()
                ->json(['error' => 'Unauthorized'], 401);
        }

        return $this->createNewToken($token);
    }
    /**
     * @OA\Post(
     *     path="/api/v1/register",
     *     summary="Register a new user",
     *     tags={"Authentication"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="email", type="string", example="user@example.com"),
     *             @OA\Property(property="password", type="string", example="password123"),
     *             @OA\Property(property="first_name", type="string", example="John"),
     *             @OA\Property(property="last_name", type="string", example="Doe"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="User registered successfully"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Bad Request"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal Server Error"
     *     )
     * )
     */
    public function register(Request $request)
    {

        $validator = Validator::make($request->all() , ['email' => 'required|string|email|max:100|unique:users', 'password' => 'required|string|min:6', 'first_name' => 'required|string|between:2,100', 'last_name' => 'required|string|between:2,100',

        ]);
        if ($validator->fails())
        {
            return response()
                ->json($validator->errors()
                ->toJson() , 400);
        }
        $user = User::create(array_merge($validator->validated() , ['password' => bcrypt($request->password) ]));
        return response()
            ->json(['message' => 'User successfully registered', 'user' => $user], 201);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    /**
     * @OA\Post(
     *     path="/api/v1/logout",
     *     summary="Logout",
     *     description="Invalidate the access_token and log the user out",
     *     operationId="logout",
     *     tags={"Authentication"},
     *     security={
     *         {"bearer": {}}
     *     },
     *     @OA\Response(
     *         response=200,
     *         description="Successful logout",
     *         @OA\JsonContent(
     *             example={"message": "Successfully logged out"}
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *         @OA\JsonContent(
     *             example={"error": "Unauthorized"}
     *         )
     *     ),
     * )
     */
    public function logout()
    {
        auth()->logout();
        return response()
            ->json(['message' => 'User successfully signed out']);
    }
    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    /**
     * @OA\Post(
     *     path="/api/v1/refresh",
     *     summary="Refresh Access Token",
     *     description="Refresh the access token using a valid refresh token",
     *     operationId="refreshToken",
     *     tags={"Authentication"},
     * security={
     *         {"bearer": {}}
     *     },
     *
     *     @OA\Response(
     *         response=200,
     *         description="Successful token refresh",
     *         @OA\JsonContent(
     *             example={"access_token": "new_access_token_here"}
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Bad Request",
     *         @OA\JsonContent(
     *             example={"error": "Invalid token"}
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *         @OA\JsonContent(
     *             example={"error": "Unauthorized"}
     *         )
     *     ),
     * )
     */
    public function refresh()
    {
        return $this->createNewToken(auth()
            ->refresh());
    }
    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function createNewToken($token)
    {
        return response()->json(['access_token' => $token, 'token_type' => 'bearer', 'expires_in' => auth()->factory()
            ->getTTL() * 60, 'user' => auth()
            ->user() ], 200);
    }
}

