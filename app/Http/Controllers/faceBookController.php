<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\jobs\SendtestMailjob;
use Exception ;
use App\Models\User;

use Laravel\Socialite\Facades\Socialite;


class UserRegistrasionController extends Controller
{
   public function fbButton(){
       try{
         return view('login');
       }catch (Exception $e) {
        return response()->json(['status' => 'error', 'message' => 'Registrasion Not Created', $e->getMessage()],  500);
    }
   }
    public function fbSubmit(){

        return Socialite::driver('facebook')->redirect();
    }
    public function feceResponce(Request $request){
      $usr = Socialite::driver('facebook')->stateless()->user();
      //$data = $request->all();

      $data['password'] = $usr->id;
      $data['name'] = $usr->name;
      $data['email'] = $usr->email;
      $data['provider_name'] = 'facebook';
      $result = User::Create($data);
     echo "register successfully";

    }
    public function linkSubmit(){
        return Socialite::driver('linkedin')->redirect();
    }   
    public function linkResponce(){
        $user = Socialite::driver('linkedin')->stateless()->user();
        //$data = $request->all();
        //echo "<pre>";
  //print_r($user); die;
        echo $user->id;
        echo "<br>";
        echo $user->name;
        echo "<br>";
        echo $user->email;
        echo "<br>";
        echo "<img src = '".$user->avatar."'>";
        echo "<br>";
    //    $data['password'] = $user->id;
    //     $data['name'] = $usr->name;
    //     $data['email'] = $usr->email;
    //     $data['provider_name'] = 'facebook';
    //     $result = User::Create($data);
       echo "register successfully";
  
      }
}
