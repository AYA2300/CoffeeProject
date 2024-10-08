<?php

namespace App\Http\Controllers;

use App\Http\Requests\Order\Order_Request;
use App\Http\Traits\ApiResponseTrait;
use App\Services\Order_Service;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    use ApiResponseTrait;


    public function __construct(protected Order_Service $order_Service)
    {

    }
    public function add_order(Order_Request $request){

    $input_data=$request->validated();
    $result=$this->order_Service->add_order($input_data);

    $output=[];
    if ($result['status_code'] == 200) {
        $result_data = $result['data'];
        // response data preparation:

        $output['order']=$result_data['order'];
        $output['items']=$result_data['items'];




}
return $this->send_response($output, $result['msg'], $result['status_code']);

}

public function get_orders(){

    $result=$this->order_Service->get_Orders();
    $output=[];
    if ($result['status_code'] == 200) {
        $result_data = $result['data'];
        // response data preparation:

        $output['data']=$result_data['data'];


}
return $this->send_response($output, $result['msg'], $result['status_code']);

}

}
