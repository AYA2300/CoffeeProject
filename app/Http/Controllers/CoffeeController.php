<?php

namespace App\Http\Controllers;

use App\Http\Requests\Coffee\Add_Request;
use App\Http\Traits\ApiResponseTrait;
use App\Services\Coffee_Service;
use Illuminate\Http\Request;

class CoffeeController extends Controller
{
    use ApiResponseTrait;


    public function __construct(protected Coffee_Service $coffee_Service)
    {

    }

    public function add_coffee(Add_Request $request){
        $input_data=$request->validated();
        $result=$this->coffee_Service->Add_coffee($input_data);
        $output=[];
        if ($result['status_code'] == 200) {
            $result_data = $result['data'];
            // response data preparation:

            $output['coffee']=$result_data['coffee'];


    }
    return $this->send_response($output, $result['msg'], $result['status_code']);

}

public function get_coffees(){

    $result=$this->coffee_Service->get_coffees();
    $output=[];
    if ($result['status_code'] == 200) {
        $result_data = $result['data'];
        // response data preparation:

        $output['coffees']=$result_data['coffees'];


}
return $this->send_response($output, $result['msg'], $result['status_code']);

}


}
