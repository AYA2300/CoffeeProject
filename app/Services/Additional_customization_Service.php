<?php
namespace App\Services;

use App\Http\Traits\ApiResponseTrait;
use App\Http\Traits\FileStorageTrait;
use App\Models\additional_customizations;
use App\Models\Additives;
use App\Models\Coffee_country;
use App\Models\Coffee_type;
use App\Models\Milk_type;
use App\Models\Syrup;
use Illuminate\Http\ResponseTrait;
use Illuminate\Support\Facades\Auth;

class additional_customization_Service{
    use FileStorageTrait;

    public function add_milk(array $input_data){
        $data=[];
        $status_code=400;
        $msg='';
        $result=[];

        $milk=Milk_type::create([
            'name'=>$input_data['name'],
        ]);


        $msg = 'milk added successfully ';
        $data['milk']=$milk;
        $status_code = 200;

        $result =[
            'data' => $data,
            'status_code' => $status_code,
            'msg' => $msg,

        ];
        return $result;
    }



    public function add_Additives(array $input_data){
        $data=[];
        $status_code=400;
        $msg='';
        $result=[];

        $Additives=Additives::create([
            'name' => $input_data['name'],

        ]);


        $msg = 'Additives added successfully ';
        $data['Additives']=$Additives;
        $status_code = 200;

        $result =[
            'data' => $data,
            'status_code' => $status_code,
            'msg' => $msg,

        ];
        return $result;
    }




    public function add_Syrup(array $input_data){
        $data=[];
        $status_code=400;
        $msg='';
        $result=[];

        $Syrup=Syrup::create([
            'name' => $input_data['name'],

        ]);


        $msg = 'Syrup added successfully ';
        $data['Syrup']=$Syrup;
        $status_code = 200;

        $result =[
            'data' => $data,
            'status_code' => $status_code,
            'msg' => $msg,

        ];
        return $result;
    }








    public function add_Coffee_type(array $input_data){
        $data=[];
        $status_code=400;
        $msg='';
        $result=[];

        $Coffee_type=Coffee_type::create([
            'name' => $input_data['name'],


        ]);
        $Coffee_type->countries()->attach($input_data['coffee_country_id']);

        $msg = 'Coffee_type added successfully ';
        $data['Coffee_type']=$Coffee_type;
        $status_code = 200;

        $result =[
            'data' => $data,
            'status_code' => $status_code,
            'msg' => $msg,

        ];
        return $result;
    }



      public function add_Coffee_country(array $input_data){
        $data=[];
        $status_code=400;
        $msg='';
        $result=[];

        $Coffee_country=Coffee_country::create([
            'name' => $input_data['name'],

        ]);




        $msg = 'Coffee_country added successfully ';
        $data['Coffee_country']=$Coffee_country;
        $status_code = 200;

        $result =[
            'data' => $data,
            'status_code' => $status_code,
            'msg' => $msg,

        ];
        return $result;
    }







    



   }









