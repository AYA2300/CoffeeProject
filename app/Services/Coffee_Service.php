<?php
namespace App\Services;

use App\Http\Traits\FileStorageTrait;
use App\Models\Coffee;
use Illuminate\Support\Facades\Auth;

class Coffee_Service{
    use FileStorageTrait;

    public function add_coffee(array $input_data){
        $data=[];
        $status_code=400;
        $msg='';
        $result=[];

        $coffee=Coffee::create([
            'name' => $input_data['name'],
            'base_price' => $input_data['base_price'],
            'image_url' =>$this->storeFile( $input_data['image_url'],'coffee'),


        ]);
        $coffee->stores()->attach($input_data['store_ids']);


        $msg = 'coffee added successfully ';
        $data['coffee']=$coffee;
        $status_code = 200;

        $result =[
            'data' => $data,
            'status_code' => $status_code,
            'msg' => $msg,

        ];
        return $result;
    }

    public function get_coffees(){

        $user=Auth::user();
      $stores= $user->store;
      //dd($stores);

      $coffees=$stores->coffees;

      $msg = 'القهوة الموجودة ضمن المتجر الذي اختاره المستخدم ';
      $data['coffees']=$coffees;
      $status_code = 200;

      $result =[
          'data' => $data,
          'status_code' => $status_code,
          'msg' => $msg,

      ];
      return $result;




    }




}
