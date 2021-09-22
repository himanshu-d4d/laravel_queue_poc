<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\jobs\SendtestMailjob;

class UserRegistrasionController extends Controller
{
   public function NewUser(Request $request){
            $UserData = $request->all();
            $user['name'] = $UserData['name'];
            $user['email'] = $UserData['email'];
        //dd($user);
            $result = Event::Create($user);
            //return response()->json(['status' => 'success', 'message' => 'Event Created Successfully','data'=>$result],  200);
             //$user = Event::findorFail($result->id);
            // $msg = "created successfully";
             dispatch(new SendtestMailjob($result))->delay(now()->addSeconds(10));
             return response()->json(['status' => 'success', 'message' => 'Registrasion Created Successfully','data'=>$result],  200);
            //dd( $user);

   }
        
}
