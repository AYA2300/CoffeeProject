<?php
namespace App\Services;

use App\Http\Traits\ApiResponseTrait;
use App\Http\Traits\FileStorageTrait;
use App\Models\barista;
use Illuminate\Http\ResponseTrait;
use Illuminate\Support\Facades\Auth;

class Barista_Service{
    use FileStorageTrait;

    public function add_barista(array $input_data){
        $data=[];
        $status_code=400;
        $msg='';
        $result=[];

        $barista=Barista::create([
            'name' => $input_data['name'],
            'experience_level' => $input_data['experience_level'],
            'store_id'=>$input_data['store_id'],


        ]);
        if(isset($input_data['status'])){
            $barista->status=$input_data['status'];
        }
        $barista->save();

        $msg = 'barista added successfully ';
        $data['barista']=$barista;
        $status_code = 200;

        $result =[
            'data' => $data,
            'status_code' => $status_code,
            'msg' => $msg,

        ];
        return $result;
    }

    public function get_baristas(){

      $user=Auth::user();
      $stores= $user->store;
      //dd($stores);

      $baristas=$stores->baristas;

      $msg = 'الباريستا الموجود ضمن المتجر الذي اختاره المستخدم ';
      $data['baristas']=$baristas;
      $status_code = 200;

      $result =[
          'data' => $data,
          'status_code' => $status_code,
          'msg' => $msg,

      ];
      return $result;

    }



}

