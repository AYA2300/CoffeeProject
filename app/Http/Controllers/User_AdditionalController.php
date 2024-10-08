<?php

namespace App\Http\Controllers;

use App\Http\Requests\additional_customizations\additional_customizationsRequest;
use App\Http\Traits\ApiResponseTrait;
use App\Models\User;
use App\Services\additional_customization_Service;
use App\Services\User_additionalService;

class User_AdditionalController extends Controller{

    use ApiResponseTrait;


    public function __construct(protected User_additionalService $customizations_Service)
    {

    }


public function add_additional_customizations(additional_customizationsRequest $request){
    $input_data=$request->validated();
    $result=$this->customizations_Service->add_additional_customizationse($input_data);
    $output=[];
    if ($result['status_code'] == 200) {
        $result_data = $result['data'];
        // response data preparation:

        $output['additional_customizations']=$result_data['additional_customizations'];


}
return $this->send_response($output, $result['msg'], $result['status_code']);

}


public function get_milk(){

    $result=$this->customizations_Service->get_milk();
    $output=[];
    if ($result['status_code'] == 200) {
        $result_data = $result['data'];
        // response data preparation:

        $output['milks']=$result_data['milks'];


}
return $this->send_response($output, $result['msg'], $result['status_code']);

}

public function get_Additives(){

    $result=$this->customizations_Service->get_Additives();
    $output=[];
    if ($result['status_code'] == 200) {
        $result_data = $result['data'];
        // response data preparation:

        $output['Additives']=$result_data['Additives'];


}
return $this->send_response($output, $result['msg'], $result['status_code']);

}

public function get_Syrup(){

    $result=$this->customizations_Service->get_Syrup();
    $output=[];
    if ($result['status_code'] == 200) {
        $result_data = $result['data'];
        // response data preparation:

        $output['Syrups']=$result_data['Syrups'];


}
return $this->send_response($output, $result['msg'], $result['status_code']);

}



public function get_Coffee_type(){

    $result=$this->customizations_Service->get_Coffee_type();
    $output=[];
    if ($result['status_code'] == 200) {
        $result_data = $result['data'];
        // response data preparation:

        $output['Coffee_types']=$result_data['Coffee_types'];


}
return $this->send_response($output, $result['msg'], $result['status_code']);

}

public function get_Coffee_country(){

    $result=$this->customizations_Service->get_Coffee_country();
    $output=[];
    if ($result['status_code'] == 200) {
        $result_data = $result['data'];
        // response data preparation:

        $output['Coffee_country']=$result_data['Coffee_country'];


}
return $this->send_response($output, $result['msg'], $result['status_code']);

}





}






