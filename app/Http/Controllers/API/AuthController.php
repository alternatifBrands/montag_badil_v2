<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Ichtrojan\Otp\Otp;
use App\Trait\AHM_Response;
use App\Mail\API\ResendOTPMail;
use Illuminate\Support\Facades\DB;
use Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Mail\API\ForgetPasswordMail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\API\loginRequest;
use App\Http\Resources\API\UserResource;
use App\Http\Requests\API\checkOTPRequest;
use App\Http\Requests\API\registerRequest;
use App\Http\Requests\API\deleteProfileRequest;
use App\Http\Requests\API\resetPasswordRequest;
use App\Http\Requests\API\updateProfileRequest;
use App\Http\Requests\API\changePasswordRequest;
use App\Http\Requests\API\forgetPasswordRequest;

class AuthController extends Controller
{
    use AHM_Response;
    public function register(registerRequest $request)
    {
        //get validated data
        $data = $request->validated();
        // create user
        $user = User::create($data); 
        $user->update([
            'type'=>$request->type
        ]);
        $user_role = Role::where('name', 'user_role_api')->first();
        if ($user_role) {
            $user->assignRole($user_role);
        }
        $token = $user->createToken("token")->plainTextToken;
        return $this->signupResponse(UserResource::make($user), $token);
    }
    public function login(loginRequest $request)
    {
        $data = $request->validated();
        $user = User::where('email', $data['email'])->first();

        if ($user && Hash::check($data['password'], $user->password)) {
            $user->tokens()->delete();
            $token = $user->createToken("token")->plainTextToken;
            return $this->signinResponse(UserResource::make($user), $token);
        }
        return $this->invalidCredentialsResponse();
    }
    public function logout()
    {
        $user = auth('api')->user();
        $user = User::find($user->id);
        if ($user) {
            $user->tokens()->delete();
            return $this->logoutResponse();
        }
    }
    public function forgetPassword(forgetPasswordRequest $request)
    {
        $data = $request->validated();
        $user = User::where('email', $data['email'])->first();
        $otp = (new Otp)->generate($user->email, config('montag_constant.NUMERIC'), config('montag_constant.LENGTH'), config('montag_constant.VALIDITY'))->token;
        Mail::to($user->email)->send(new ForgetPasswordMail($user, $otp));
        return $this->OTPSendResponse();
    }
    public function resetPassword(resetPasswordRequest $request)
    {
        $data = $request->validated();
        $user = User::where('email', $data['email'])->first();
        $otp = (new Otp)->validate($user->email, $data['otp']);
        if (!$otp->status) {
            return $this->OTPNotValidResponse();
        }
        $user->update([
            'password' => Hash::make($data['password'])
        ]);
        $user->tokens()->delete();
        return $this->ResetPasswordResponse();
    }
    public function resendOTP(forgetPasswordRequest $request)
    {
        $data = $request->validated();
        $user = User::where('email', $data['email'])->first();
        $otp = (new Otp)->generate($user->email, config('montag_constant.NUMERIC'), config('montag_constant.LENGTH'), config('montag_constant.VALIDITY'))->token;
        Mail::to($user->email)->send(new ResendOTPMail($user, $otp));
        return $this->OTPResendResponse();
    }
    public function checkOTP(checkOTPRequest $request)
    {
        $data = $request->validated();
        $otp_check = (new Otp)->validate($data['email'], $data['otp']);
        $otp = DB::table('otps')
            ->where('identifier', $data['email'])
            ->latest()
            ->first();
        if ($otp) {
            DB::table('otps')
                ->where('id', $otp->id)
                ->update(['valid' => 1]);
        }
        if ($otp_check->status) {
            return $this->OTPValidResponse();
        }
        return $this->OTPNotValidResponse();
    }
    public function changePassword(changePasswordRequest $request)
    {
        $data = $request->validated();
        $user = auth('api')->user();
        $user = User::find($user->id);
        if (!Hash::check($data['current_password'], $user->password)) {
            return $this->PasswordNotValidResponse();
        }
        $user->update([
            'password' => Hash::make($data['new_password']),
        ]);
        return $this->ChangePasswordResponse();
    }
    public function profile()
    {
        $user = auth('api')->user();
        $user = User::with('country')
            ->where('id', '=', $user->id)
            ->first();
        return $this->ProfileResponse(UserResource::make($user));
    }
    public function updateProfile(updateProfileRequest $request)
    {
        $data = $request->validated();
        $user = auth('api')->user();
        $user = User::with('country')
            ->where('id', '=', $user->id)
            ->first();
        if ($user) {
            if ($request->hasFile('image')) {
                $user->clearMediaCollection('profile');
                $user->addMediaFromRequest('image')->toMediaCollection('profile');
            }
            $user->update($data);
        }
        return $this->UpdateProfileResponse(UserResource::make($user));
    }
    public function deleteProfile(deleteProfileRequest $request)
    {
        $data = $request->validated();
        $user = auth('api')->user();
        $user = User::find($user->id);
        if (!Hash::check($data['password'], $user->password)) {
            return $this->InvalidPasswordResponse();
        }
        $user->tokens()->delete();
        $user->delete();
        return $this->DeleteProfileResponse();
    }
}
