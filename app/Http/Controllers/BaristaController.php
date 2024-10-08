<?php

namespace App\Http\Controllers;

use App\Http\Requests\Barista\add_BaristaRequest;
use App\Http\Traits\ApiResponseTrait;
use App\Services\Barista_Service;
use Illuminate\Http\Request;

class BaristaController extends Controller
{
    use ApiResponseTrait;
    public function __construct(protected Barista_Service $barista_Service)
    {

    }

    public function add_barista(add_BaristaRequest $request){
        $input_data=$request->validated();
        $result=$this->barista_Service->Add_barista($input_data);
        $output=[];
        if ($result['status_code'] == 200) {
            $result_data = $result['data'];
            // response data preparation:

            $output['barista']=$result_data['barista'];


    }
    return $this->send_response($output, $result['msg'], $result['status_code']);

}

public function get_Barista(){

    $result=$this->barista_Service->get_baristas();
    $output=[];
    if ($result['status_code'] == 200) {
        $result_data = $result['data'];
        // response data preparation:

        $output['baristas']=$result_data['baristas'];


}
return $this->send_response($output, $result['msg'], $result['status_code']);

}



}
