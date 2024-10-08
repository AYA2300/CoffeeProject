<?php

namespace App\Http\Controllers;

use App\Http\Requests\additional_customizations\add_additional_customizationsRequest;
use App\Http\Requests\additional_customizations\add_Coffee_typeRequest;
use App\Http\Requests\additional_customizations\additional_customizationsRequest;
use App\Http\Traits\ApiResponseTrait;
use App\Services\additional_customization_Service;

use Illuminate\Http\Request;

class Additional_customizationsController extends Controller
{
    use ApiResponseTrait;


    public function __construct(protected additional_customization_Service $customizations_Service)
    {

    }

    public function add_milk(add_additional_customizationsRequest $request){
        $input_data=$request->validated();
        $result=$this->customizations_Service->add_milk($input_data);
        $output=[];
        if ($result['status_code'] == 200) {
            $result_data = $result['data'];
            // response data preparation:

            $output['milk']=$result_data['milk'];


    }
    return $this->send_response($output, $result['msg'], $result['status_code']);

}



public function add_additvies(add_additional_customizationsRequest $request){
    $input_data=$request->validated();
    $result=$this->customizations_Service->add_Additives($input_data);
    $output=[];
    if ($result['status_code'] == 200) {
        $result_data = $result['data'];
        // response data preparation:

        $output['Additives']=$result_data['Additives'];


}
return $this->send_response($output, $result['msg'], $result['status_code']);

}


public function add_Syrup(add_additional_customizationsRequest $request){
    $input_data=$request->validated();
    $result=$this->customizations_Service->add_Syrup($input_data);
    $output=[];
    if ($result['status_code'] == 200) {
        $result_data = $result['data'];
        // response data preparation:

        $output['Syrup']=$result_data['Syrup'];


}
return $this->send_response($output, $result['msg'], $result['status_code']);

}


public function add_Coffee_type(add_Coffee_typeRequest $request){
    $input_data=$request->validated();
    $result=$this->customizations_Service->add_Coffee_type($input_data);
    $output=[];
    if ($result['status_code'] == 200) {
        $result_data = $result['data'];
        // response data preparation:

        $output['Coffee_type']=$result_data['Coffee_type'];


}
return $this->send_response($output, $result['msg'], $result['status_code']);

}

public function add_Coffee_country(add_additional_customizationsRequest $request){
    $input_data=$request->validated();
    $result=$this->customizations_Service->add_Coffee_country($input_data);
    $output=[];
    if ($result['status_code'] == 200) {
        $result_data = $result['data'];
        // response data preparation:

        $output['Coffee_country']=$result_data['Coffee_country'];


}
return $this->send_response($output, $result['msg'], $result['status_code']);

}
}
