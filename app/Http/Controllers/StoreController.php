<?php

namespace App\Http\Controllers;

use App\Http\Requests\Store\Add_Request;
use App\Http\Traits\ApiResponseTrait;
use App\Models\Store;
use App\Models\User;
use App\Services\Store_Service;
use Dotenv\Store\StoreInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StoreController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected Store_Service $store_Service)
    {

    }

    public function add_store(Add_Request $request){
        $input_data=$request->validated();
        $result=$this->store_Service->Add_Store($input_data);
        $output=[];
        if ($result['status_code'] == 200) {
            $result_data = $result['data'];
            // response data preparation:

            $output['store']=$result_data['store'];


    }
    return $this->send_response($output, $result['msg'], $result['status_code']);

}


public function select(Store $id){

    $result=$this->store_Service->select($id);


    return $this->send_response($result, $result['msg'], $result['status_code']);









}
}
