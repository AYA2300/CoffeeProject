<?php
 namespace App\Services;



use App\Http\Requests\Auth\RegisterRequest;
use App\Jobs\ExpireVerificationCode;
use App\Models\User;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Console\Input\Input;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

use Spatie\Permission\Models\Role;
use Throwable;

class Auth_Service{
    use HasApiTokens;


    public function Register(array $input_data){
        $data=[];
        $status_code=400;
        $msg='';
        $result=[];

        //  try{
        //         DB::beginTransaction();


        $user=User::create([

            'name'=>$input_data['name'],
            'email'=>$input_data['email'],
            'phone_number'=>$input_data['phone_number'],
            'password'=>Hash::make($input_data['password']),




        ]);
        $user->assignRole(Role::where('name','user')->first());
        $auth_token=JWTAuth::fromUser($user);

        $msg = 'registered successfully ';


        // $qrCodeData = $user->email; // أو أي بيانات ترغب في تضمينها
        // $qrCodePath = 'qrcodes/' . $user->id . '.png';

        // // حفظ QR كصورة
        // $qr_imag=Storage::disk('public')->put($qrCodePath, QrCode::format('png')->size(300)->generate($qrCodeData));

        // // تحديث حقل qr_code في قاعدة البيانات
        // $user->update(['qr_code' => $qrCodePath]);

        $data['User']=$user;
        // $data['qr_imag']=$qr_imag;
        $data['auth_token']=$auth_token;
        $status_code = 200;






        // }catch(Throwable $th){
        //     DB::roleBack();
        //     Log::debug($th);
        //     $status_code = 500;;
        //     $data = $th;
        //     $msg = 'error ' . $th->getMessage();

        // }
        $result =[
            'data' => $data,

            'status_code' => $status_code,
            'msg' => $msg,

        ];
        return $result;




    }




    public function login(array $input_data){

        $data = [];
        $status_code = 400;
        $msg = '';
        $result = [];

        $credentials=[
            'email'=>$input_data['email'],
            'password'=>$input_data['password']
        ];

        if(!$auth_token =Auth::attempt($credentials)){
            $status_code=404;
            $msg ='Please Check your number and password';

        }
        else{
            $user=Auth::user();

            $data=[
                'user'=>$user,
                'auth_token'=>$auth_token
            ];

            $status_code=200;
            $msg="logged in";

            $result=[
                'data'=>$data,
                'status_code'=>$status_code,
                'msg'=>$msg
            ];
            return $result;

        }


    }




    public function logout(){


        $status_code = 400;
        $msg = '';
        $result = [];


        Auth::logout();

        $msg='logged out';
        $status_code=200;
        $result=[
            'status_code'=>$status_code,
            'msg'=>$msg




        ];

        return $result;



}

public function get_profile(){

    $status_code = 200;
    $user=Auth::user();
    $data['user']=$user;
    $data['store']=$user->store()->get();
    $msg='user profile';

    $result=[
        'data'=>$data,
        'status_code'=>$status_code,
        'msg'=>$msg
    ];
    return $result;




}


public function rest_pass(array $input_data){
    $user=auth()->user();
    if(!$user->email==$input_data['email']){
        $status_code=400;
        $msg='email not found';
    }


    $verification_code=Str::random(4);
    $user->verification_code=$verification_code;
    // @intelephense-ignore
    $user->save();

    ExpireVerificationCode::dispatch($user)->delay(now()->addSeconds(60));
    $this->sendVerificationEmail($input_data['email'], $verification_code);



    $status_code=200;
    $msg=' please check your email for the verification code.';
    $data=$user->email;

    $result=[
        'data'=>$data,
        'status_code'=>$status_code,
        'msg'=>$msg
    ];
    return $result;


}

private function sendVerificationEmail($email, $verification_code)
{
    Mail::raw("Your verification code is: $verification_code", function ($message) use ($email) {
        $message->to($email)
                ->subject('Email Verification');
    });


}

public function changePassword(array $input_data)
{
    $user = auth()->user();

    // تحقق من تسجيل الدخول
    if (!$user) {
        return [
            'status_code' => 401,
            'msg' => 'You must be login',
        ];
    }

    // تحقق من صحة رمز التحقق
    if ($user->verification_code !== $input_data['verification_code']) {
        return [
            'status_code' => 400,
            'msg' => 'Invalid verification code',
        ];
    }

    // تحديث كلمة المرور
    if (isset($input_data['new_password'])) {
        $user->password = Hash::make($input_data['new_password']);
    }

    // إلغاء رمز التحقق وحفظ التحديثات
    $user->verification_code = null;
    $user->save();

    return [
        'data' => ['user' => $user],
        'status_code' => 200,
        'msg' => 'Your password has been changed successfully',
    ];
}







    }
















?>

