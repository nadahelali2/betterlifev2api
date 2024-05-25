<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
    protected function success($data, $message, $status)
    {
        return response()->json([
            'data' => $data,
            'message' => $message,
            'status' => $status
        ], $status);
    }
    
    public function login(Request $request) {
        $requestData = $request->all();

        if (!isset($requestData['email']) || !isset($requestData['password'])) {
            // Return an error response
            return response()->json(['error' => 'Missing email or password'], 400);
        }

        $credentials = ["password" => $requestData['password'], "email" => $requestData['email']];

        if (Auth::attempt($credentials)) {
            $user = User::where('email', $requestData['email'])->first();
            $token = $user->createToken("API token for " . $user->name)->plainTextToken;

            return $this->success(
                [
                    "user" => Auth::user(),
                    'token' => $token
                ],
                "user logged in",
                200
            );
        }
    }
}