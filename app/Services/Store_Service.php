<?php
namespace App\Services;

use App\Models\Store;

class Store_Service{

    public function Add_Store(array $input_data){
        $data=[];
        $status_code=400;
        $msg='';
        $result=[];

        $store=Store::create([
            'name' => $input_data['name'],
            'address' => $input_data['address'],
            'latitude' =>$input_data['latitude'],
            'longitude' =>$input_data['longitude'],


        ]);

        $msg = 'Store added successfully ';
        $data['store']=$store;
        $status_code = 200;

        $result =[
            'data' => $data,
            'status_code' => $status_code,
            'msg' => $msg,

        ];
        return $result;







    }

    public function select($id){

        $user = auth()->user();
        $user->store_id = $id->id;
        $user->save();
        $store=$user->store()->get();


        $msg = 'Done';
        $data['user']=$user;
        $data['store']=$store;
        $status_code = 200;

        $result =[
            'data' => $data,
            'status_code' => $status_code,
            'msg' => $msg,

        ];
        return $result;
    }



}

?>
