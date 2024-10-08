<?php
namespace App\Services;

use App\Http\Traits\ApiResponseTrait;
use App\Models\additional_customizations;
use App\Models\Additives;
use App\Models\Coffee_country;
use App\Models\Coffee_type;
use App\Models\Milk_type;
use App\Models\Syrup;
use Auth;

class User_additionalService{

    public function get_milk(){
        $milk=Milk_type::get();

        $msg = 'انواع الحليب';
        $data['milks']=$milk;
        $status_code = 200;

        $result =[
            'data' => $data,
            'status_code' => $status_code,
            'msg' => $msg,

        ];
        return $result;

      }

      public function get_Additives(){
        $Additives=Additives::get();

        $msg = 'الاضافات';
        $data['Additives']=$Additives;
        $status_code = 200;

        $result =[
            'data' => $data,
            'status_code' => $status_code,
            'msg' => $msg,

        ];
        return $result;

      }

      public function get_Syrup(){
        $Syrup=Syrup::get();

        $msg = 'الشراب';
        $data['Syrups']=$Syrup;
        $status_code = 200;

        $result =[
            'data' => $data,
            'status_code' => $status_code,
            'msg' => $msg,

        ];
        return $result;

      }


      public function get_Coffee_type(){
        $Coffee_type=Coffee_type::get();

        $msg = 'انواع القهوة';
        $data['Coffee_types']=$Coffee_type;
        $status_code = 200;

        $result =[
            'data' => $data,
            'status_code' => $status_code,
            'msg' => $msg,

        ];
        return $result;

      }



      public function get_Coffee_country(){
        $Coffee_country=Coffee_country::get();

        $msg = 'بلد القهوة';
        $data['Coffee_country']=$Coffee_country;
        $status_code = 200;

        $result =[
            'data' => $data,
            'status_code' => $status_code,
            'msg' => $msg,

        ];
        return $result;

      }



    public function add_additional_customizationse(array $input_data){
        $data=[];
        $status_code=400;
        $msg='';
        $result=[];
        $user=Auth::user();

        $order = $user->order()->latest()->first();
        if ($order){
        $additional_customizationse=additional_customizations::create([
            'milk_type_id' => $input_data['milk_type_id'],
            'coffee_type_id' => $input_data['coffee_type_id'],
            'coffee_sort_id'=>$input_data['coffee_sort_id'],
            'additive_id' => $input_data['additive_id'],
            'syrup_id' => $input_data['syrup_id'],
            'Roasting' => $input_data['Roasting'],
            'Grinding' => $input_data['Grinding'],
            'order_id' => $order->id,
        ]);}
        else {
            $msg = 'Order not found for user';
        }


        $msg = 'additional_customizationse added successfully ';
        $data['additional_customizationse']=$additional_customizationse;
        $status_code = 200;


        $result =[
            'data' => $data,
            'status_code' => $status_code,
            'msg' => $msg,

        ];
        return $result;
    }



    public function get_additional_customizationse(){
        $additional_customizations = additional_customizations::with(['milkType', 'coffeeType', 'additive', 'syrup','Roasting','Grinding'])->get();

        $msg = 'تخصيصات إضافية';
        $data['additional_customizations']=$additional_customizations;
        $status_code = 200;

        $result =[
            'data' => $data,
            'status_code' => $status_code,
            'msg' => $msg,

        ];
        return $result;

      }






}
