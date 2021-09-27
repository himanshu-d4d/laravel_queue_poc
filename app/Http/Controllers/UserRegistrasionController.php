<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\jobs\SendtestMailjob;
use Exception ;
use Auth ;
use App\Models\User;
use App\Models\socialRegister;
use Laravel\Socialite\Facades\Socialite;


class UserRegistrasionController extends Controller
{
   public function fbButton(){
       try{
         return view('ragister');
       }catch (Exception $e) {
        return response()->json(['status' => 'error', 'message' => 'Registrasion Not Created', $e->getMessage()],  500);
    }
   }
   //////////FACEBOOK SOCIAL LINK SUBMIT AND LOGIN USER//////////////////
    public function fbSubmit(){

        return Socialite::driver('facebook')->redirect();
    }
    public function feceResponce(Request $request){
      $usr = Socialite::driver('facebook')->stateless()->user();
      // print_r($usr); die;
        $data['provider_id'] = $usr->id;
        $data['name'] = $usr->name;
        $data['email'] = $usr->email;
        $data['provider_name'] = 'facebook';
        $isUser = User::where('provider_id', $usr->id)->first();
        if($isUser){
            Auth::login($isUser);
            return redirect('/deshboard');
        }
        if($userId = User::where('email', $usr->email)->first()){
            //dd();
            User::where('id',$userId['id'])
            ->update(['provider_id' => $usr->id,
                   'name' => $usr->name,
            'email' => $usr->email,
            'provider_name' => 'facebook']);
            return redirect('/deshboard');
        }else{
            $result = User::Create($data);
            Auth::login($result);
            return redirect('/deshboard');
        }
       

      }

     //////////LINKEDIN SOCIAL LINK SUBMIT AND LOGIN USER//////////////////
     //////////////////////////////////////////////////////////////////////

    public function linkSubmit(){
        return Socialite::driver('linkedin')->redirect();
    }   
    public function linkResponce(){
        $user = Socialite::driver('linkedin')->stateless()->user();
        //$data = $request->all();
        //echo "<pre>";
  //print_r($user); die;
        $data['provider_id'] = $user->id;
        $data['name'] = $user->name;
        $data['email'] = $user->email;
        $data['provider_name'] = 'linkedin';
        $data['password'] = encrypt('admin@123');
        $isUser = User::where('provider_id', $user->id)->first();
        if($isUser){
            Auth::login($isUser);
            return redirect('/deshboard');
        }
            if($userId = User::where('email', $user->email)->first()){
                //dd();
                User::where('id',$userId['id'])
                ->update(['provider_id' => $user->id,
                       'name' => $user->name,
                'email' => $user->email,
                'provider_name' => 'linkedin']);
                return redirect('/deshboard');
        } else {
            $result = User::Create($data);
            Auth::login($result);
            return redirect('/deshboard');
        }
       
      }
////////////GOOGLE SOCIAL LINK SUBMIT AND LOGIN USER///////////////////////
//////////////////////////////////////////////////////////////////////////

      public function googleSubmit(){
        return Socialite::driver('google')->redirect();
    }   
    public function googleResponse(){
        $user = Socialite::driver('google')->stateless()->user();
        //print_r($user);
        $data['provider_id'] = $user->id;
        $data['name'] = $user->name;
        $data['email'] = $user->email;
        $data['provider_name'] = 'Google';
        $data['password'] = encrypt('admin@123');
        $isUser = User::where('provider_id', $user->id)->first();
        if($isUser){
            Auth::login($isUser);
            return redirect('/deshboard');
        }
            if($userId = User::where('email', $user->email)->first()){
                //dd();
                User::where('id',$userId['id'])
                ->update(['provider_id' => $user->id,
                       'name' => $user->name,
                'email' => $user->email,
                'provider_name' => 'Google']);
                return redirect('/deshboard');
        } else {
            $result = User::Create($data);
            Auth::login($result);
            return redirect('/deshboard');
        }
    }
      
      public function Login(){
          return view('login');
      }
      public function ragister(){
        return view('ragister');
    }
    public function deshboard(){
        if(Auth::check()){
            
            return view('dashboard');
        }
        return redirect('login');
    }
    
}
