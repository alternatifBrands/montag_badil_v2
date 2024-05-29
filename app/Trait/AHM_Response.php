<?php

namespace App\Trait;

use Illuminate\Http\Response;



trait AHM_Response
{
    #######################################################
    ################### Authentication ####################
    #######################################################
    public function signupResponse($user, $token)
    {
        return response()->json([
            'message' => 'user created',
            // 'data' => [
                'user' => $user,
                'token' => $token,
                'token_type' => 'Bearer',
            // ],
            'status' => true,
            'code' => Response::HTTP_CREATED,
        ], Response::HTTP_CREATED);
    }

    public function signinResponse($user, $token)
    {
        return response()->json([
            'message' => 'user login',
            // 'data' => [
                'user' => $user,
                'token' => $token,
                'token_type' => 'Bearer',
            // ],
            'status' => true,
            'code' => Response::HTTP_OK,
        ], Response::HTTP_OK);
    }
    public function invalidCredentialsResponse()
    {
        return response()->json([
            'message' => 'Invalid email or password',
            'data' => [],
            'status' => false,
        ]);
    }
    public function PasswordNotValidResponse()
    {
        return response()->json([
            'message' => 'Password Not Valid',
            'data' => [],
            'status' => false,
            'code' => Response::HTTP_NOT_FOUND,
        ], Response::HTTP_NOT_FOUND);
    }
    public function logoutResponse()
    {
        return response()->json([
            'message' => 'Logged Out',
            'data' => [],
            'status' => true,
            'code' => Response::HTTP_OK,
        ], Response::HTTP_OK);
    }
    public function ResetPasswordResponse()
    {
        return response()->json([
            'message' => 'Password Reset Successfully',
            'data' => [],
            'status' => true,
            'code' => Response::HTTP_OK,
        ], Response::HTTP_OK);
    }
    public function ChangePasswordResponse()
    {
        return response()->json([
            'message' => 'Password Changed Successfully',
            'data' => [],
            'status' => true,
            'code' => Response::HTTP_OK,
        ], Response::HTTP_OK);
    }
    public function OTPSendResponse()
    {
        return response()->json([
            'message' => 'OTP Sent successfully',
            'data' => [],
            'status' => true,
            'code' => Response::HTTP_OK,
        ], Response::HTTP_OK);
    }
    public function OTPResendResponse()
    {
        return response()->json([
            'message' => 'Resend OTP successfully',
            'data' => [],
            'status' => true,
            'code' => Response::HTTP_OK,
        ], Response::HTTP_OK);
    }
    public function OTPValidResponse()
    {
        return response()->json([
            'message' => 'OTP Valid',
            'data' => [],
            'status' => true,
            'code' => Response::HTTP_OK,
        ], Response::HTTP_OK);
    }
    public function OTPNotValidResponse()
    {
        return response()->json([
            'message' => 'OTP Not Valid',
            'data' => [],
            'status' => false,
            'code' => Response::HTTP_NOT_FOUND,
        ], Response::HTTP_NOT_FOUND);
    }
    public function ProfileResponse($data)
    {
        return response()->json([
            'message' => 'Profile Get successfully',
            'data' => $data,
            'status' => true,
            'code' => Response::HTTP_OK,
        ], Response::HTTP_OK);
    }
    public function UpdateProfileResponse($data)
    {
        return response()->json([
            'message' => 'profile updated',
            'data' => $data,
            'status' => true,
            'code' => Response::HTTP_OK,
        ], Response::HTTP_OK);
    }
    public function DeleteProfileResponse()
    {
        return response()->json([
            'message' => 'Account deleted successfully',
            'data' => [],
            'status' => true,
            'code' => Response::HTTP_OK,
        ], Response::HTTP_OK);
    }
    public function InvalidPasswordResponse()
    {
        return response()->json([
            'message' => 'Invalid password',
            'data' => [],
            'status' => true,
            'code' => Response::HTTP_NOT_FOUND,
        ], Response::HTTP_NOT_FOUND);
    }
    public function SocialiteResponse($type, $id, $name, $email, $image, $token)
    {
        return response()->json([
            'message' => 'successfully login with ' . $type,
            'data' => [
                'id' => $id,
                'name' => $name,
                'email' => $email,
                'image' => $image,
                'token' => $token,
            ],
            'status' => true,
            'code' => Response::HTTP_OK
        ], Response::HTTP_OK);
    }

    #######################################################
    ################### Authentication ####################
    #######################################################

    public function CreateResponse($data)
    {
        return response()->json([
            'message' => 'record created',
            'data' => $data,
            'status' => true,
            'code' => Response::HTTP_CREATED,
        ], Response::HTTP_CREATED);
    }
    public function paginateResponse($data)
    {
        $dataFetched = $data->items();

        $links = [
            'first' => $data->url(1),
            'last' => $data->url($data->lastPage()),
            'next' => $data->nextPageUrl(),
            'prev' => $data->previousPageUrl(),
        ];

        $meta = [
            'current_page' => $data->currentPage(),
            'last_page' => $data->lastPage(),
            'from' => $data->firstItem(),
            'to' => $data->lastItem(),
        ];

        return response()->json([
            'message' => 'data fetched successfully',
            'data' => $dataFetched,
            'links' => $links,
            'meta' => $meta,
            'status' => true,
            'code' => Response::HTTP_OK,
        ], Response::HTTP_OK);
    }
    public function GetDataResponse($data)
    {
        return response()->json([
            'message' => 'data fetched successfully',
            'data' => $data,
            'status' => true,
            'code' => Response::HTTP_OK,
        ], Response::HTTP_OK);
    }
    public function NotFoundResponse()
    {
        return response()->json([
            'message' => 'not found',
            'data' => [],
            'status' => false,
            'code' => Response::HTTP_NOT_FOUND,
        ], Response::HTTP_NOT_FOUND);
    }
    public function UpdateResponse($data)
    {
        return response()->json([
            'message' => 'record updated successfully',
            'data' => $data,
            'status' => true,
            'code' => Response::HTTP_OK,
        ], Response::HTTP_OK);
    }
    public function DeleteResponse()
    {
        return response()->json([
            'message' => 'record deleted successfully',
            'data' => [],
            'status' => true,
            'code' => Response::HTTP_OK,
        ], Response::HTTP_OK);
    }






    public function okResponse($msg, $data)
    {
        /*
            $msg  => text when operation done
            $data => return data if you want to return it , if not return []
        */
        return response()->json([
            'message' => $msg,
            'data' => $data,
            'status' => true,
            'code' => Response::HTTP_OK,
        ], Response::HTTP_OK);
    }

    public function errorResponse($msg)
    {
        return response()->json([
            'message' => $msg,
            'data' => [],
            'status' => true,
            'code' => 404,
        ], 404);
    }
}