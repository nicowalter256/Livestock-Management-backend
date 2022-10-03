<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Exception;
use Illuminate\Support\Facades\Validator;
use GuzzleHttp\Exception\GuzzleException;

class AuthController extends Controller
{
    public function loginManager(Request $request)
    {
        return $this->login($request, "MANAGER");
    }

    public function loginAdmin(Request $request)
    {
        return $this->login($request, "ADMIN");
    }

    /**
     * Get currently logged in user profile
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function profile(Request $request)
    {
        $customer_profile = $request->user();
        return response()->json($customer_profile);
    }

    private function login(Request $request, string $userType)
    {

        $validator = Validator::make($request->all(), [
            'username' => "required|string|min:3|max:250",
            "password" => "required|string|min:3|max:250"
        ]);
        if (!$validator->fails()) {
            $form_params = [
                'grant_type' => 'password',
                'client_id' => env($userType . "_USER_ID"),
                'client_secret' => env($userType . "_USER_SECRET"),
                'username' => $request->username,
                'password' => $request->password,
            ];

            try {
                $http = new Client(['base_uri' => env('APP_URL')]);
                $response = $http->post("oauth/token", [
                    'form_params' => $form_params,
                ]);
                $login_response = json_decode((string) $response->getBody());
                if ($response->getStatusCode() === 200) {
                    $result = $http->get('api/profile', [
                        'headers' => [
                            'Accept' => 'application/json',
                            'Authorization' => 'Bearer ' . $login_response->access_token,
                        ],
                    ]);
                    $data = [
                        'token' => $login_response,
                        'user' => json_decode($result->getBody())
                    ];
                    return response()->json($data);
                } else {
                    return response()->json(['message' => 'Incorrect email/password.'], 401);
                }
            } catch (GuzzleException $ex) {
                return response()->json(['message' => $ex->getMessage()], 401);
            } catch (Exception $ex) {
                return response()->json(['message' => "Server Error"], 500);
            }
        } else {
            return $validator->errors();
        }
    }

    public function refreshCustomerToken(Request $request)
    {
        return $this->refreshToken($request, 'CUSTOMER');
    }

    private function refreshToken(Request $request, $userType = 'BAKER')
    {
        $validated = $request->validate(['refresh_token' => 'required|string']);
        $http = new Client(['base_uri' => env('APP_URL')]);
        $response = $http->post('/oauth/token', [
            'form_params' => [
                'grant_type' => 'refresh_token',
                'refresh_token' => $validated['refresh_token'],
                'client_id' => env($userType . "_USER_ID"),
                'client_secret' => env($userType . "_USER_SECRET")
            ],
        ]);

        return response()->json(json_decode((string) $response->getBody(), true));
    }
}
