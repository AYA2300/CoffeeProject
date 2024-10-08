<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReviewRequest;
use App\Models\Order;
use App\Models\Review;
use Auth;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function add_review(ReviewRequest $request,Order $order_id){

        $user=Auth::user();
        if(!$user){
            return response()->json([
                'status_code'=>400,
                'msg'=>'المستخدم غير مسجل دخول'
            ]);
        }

        $review=Review::create([
            'order_id'=>$order_id->id,
            'user_id'=>$user->id,
            'rating'=>$request->rating,
            'comment'=>$request->comment
        ]);

        return response()->json([
            'status_code'=>200,
            'msg'=>'تم تسجيل مراجعتك بنجاح',
            'data'=>$review
        ]);



    }


}
