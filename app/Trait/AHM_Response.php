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
            'message' => __('responses.user_created'),
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
            'message' => __('responses.user_login'),
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
            'message' => __('responses.invalid_credentials'),
            'data' => [],
            'status' => false,
            'code' => 400,
        ], 400);
    }

    public function PasswordNotValidResponse()
    {
        return response()->json([
            'message' => __('responses.password_not_valid'),
            'data' => [],
            'status' => false,
            'code' => Response::HTTP_NOT_FOUND,
        ], Response::HTTP_NOT_FOUND);
    }

    public function logoutResponse()
    {
        return response()->json([
            'message' => __('responses.logged_out'),
            'data' => [],
            'status' => true,
            'code' => Response::HTTP_OK,
        ], Response::HTTP_OK);
    }

    public function ResetPasswordResponse()
    {
        return response()->json([
            'message' => __('responses.password_reset'),
            'data' => [],
            'status' => true,
            'code' => Response::HTTP_OK,
        ], Response::HTTP_OK);
    }

    public function ChangePasswordResponse()
    {
        return response()->json([
            'message' => __('responses.password_changed'),
            'data' => [],
            'status' => true,
            'code' => Response::HTTP_OK,
        ], Response::HTTP_OK);
    }

    public function OTPSendResponse()
    {
        return response()->json([
            'message' => __('responses.otp_sent'),
            'data' => [],
            'status' => true,
            'code' => Response::HTTP_OK,
        ], Response::HTTP_OK);
    }

    public function OTPResendResponse()
    {
        return response()->json([
            'message' => __('responses.otp_resend'),
            'data' => [],
            'status' => true,
            'code' => Response::HTTP_OK,
        ], Response::HTTP_OK);
    }

    public function OTPValidResponse()
    {
        return response()->json([
            'message' => __('responses.otp_valid'),
            'data' => [],
            'status' => true,
            'code' => Response::HTTP_OK,
        ], Response::HTTP_OK);
    }

    public function OTPNotValidResponse()
    {
        return response()->json([
            'message' => __('responses.otp_not_valid'),
            'data' => [],
            'status' => false,
            'code' => Response::HTTP_NOT_FOUND,
        ], Response::HTTP_NOT_FOUND);
    }

    public function ProfileResponse($data)
    {
        return response()->json([
            'message' => __('responses.profile_get'),
            'data' => $data,
            'status' => true,
            'code' => Response::HTTP_OK,
        ], Response::HTTP_OK);
    }

    public function UpdateProfileResponse($data)
    {
        return response()->json([
            'message' => __('responses.profile_updated'),
            'data' => $data,
            'status' => true,
            'code' => Response::HTTP_OK,
        ], Response::HTTP_OK);
    }

    public function DeleteProfileResponse()
    {
        return response()->json([
            'message' => __('responses.account_deleted'),
            'data' => [],
            'status' => true,
            'code' => Response::HTTP_OK,
        ], Response::HTTP_OK);
    }

    public function InvalidPasswordResponse()
    {
        return response()->json([
            'message' => __('responses.invalid_password'),
            'data' => [],
            'status' => true,
            'code' => Response::HTTP_NOT_FOUND,
        ], Response::HTTP_NOT_FOUND);
    }

    public function SocialiteResponse($type, $id, $name, $email, $image, $token)
    {
        return response()->json([
            'message' => __('responses.socialite_login', ['type' => $type]),
            'data' => [
                'id' => $id,
                'name' => $name,
                'email' => $email,
                'image' => $image,
                'token' => $token,
            ],
            'status' => true,
            'code' => Response::HTTP_OK,
        ], Response::HTTP_OK);
    }

    #######################################################
    ################### Data Handling ####################
    #######################################################

    public function CreateResponse($data)
    {
        return response()->json([
            'message' => __('responses.record_created'),
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
            'message' => __('responses.data_fetched'),
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
            'message' => __('responses.data_fetched'),
            'data' => $data,
            'status' => true,
            'code' => Response::HTTP_OK,
        ], Response::HTTP_OK);
    }

    public function NotFoundResponse()
    {
        return response()->json([
            'message' => __('responses.not_found'),
            'data' => [],
            'status' => false,
            'code' => Response::HTTP_NOT_FOUND,
        ], Response::HTTP_NOT_FOUND);
    }

    public function UpdateResponse($data)
    {
        return response()->json([
            'message' => __('responses.record_updated'),
            'data' => $data,
            'status' => true,
            'code' => Response::HTTP_OK,
        ], Response::HTTP_OK);
    }

    public function DeleteResponse()
    {
        return response()->json([
            'message' => __('responses.record_deleted'),
            'data' => [],
            'status' => true,
            'code' => Response::HTTP_OK,
        ], Response::HTTP_OK);
    }

    public function okResponse($msg, $data)
    {
        /*
            $msg  => text when operation done
            $data => return data if you want to return it, if not return []
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
            'status' => false,
            'code' => 404,
        ], 404);
    }
}
