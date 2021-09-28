<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\jobs\SendtestMailjob;
use Exception ;
use Auth ;
use GuzzleHttp\Client;
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
    public function instaSubmit(){
        $appId = config('services.instagram.client_id');
        $redirectUri = urlencode(config('services.instagram.redirect'));
        // dd($appId);
        return redirect()->to("https://api.instagram.com/oauth/authorize?app_id={$appId}&redirect_uri={$redirectUri}&scope=user_profile,user_media&response_type=code");
    }   
    public function instaResponse(Request $request){
         $code = $request->code;
        if (empty($code)) return redirect()->route('login')->with('error', 'Failed to login with Instagram.');
         $appId = config('services.instagram.client_id');
         $secret = config('services.instagram.client_secret');
         $redirectUri = config('services.instagram.redirect');
           $client = new Client();
           $response = $client->request('POST', 'https://api.instagram.com/oauth/access_token', [
                    
            'form_params' => [
                'app_id' => $appId,
                'app_secret' => $secret,
                'grant_type' => 'authorization_code',
                'redirect_uri' => $redirectUri,
                'code' => $code,
            ]
        ]);
        //dd($response);
        if ($response->getStatusCode() != 200) {
            return redirect()->route('home')->with('error', 'Unauthorized login to Instagram.');
        }
    
        $content = $response->getBody()->getContents();
        $content = json_decode($content);
        //dd($content);
        $accessToken = $content->access_token;
        $userId = $content->user_id;
    
        // // Get user info
         $response = $client->request('GET', "https://graph.instagram.com/me?fields=id,username,account_type&access_token={$accessToken}");
         //dd($response);
        $content = $response->getBody()->getContents();
        $user = json_decode($content);
    //dd($user);
        // Get instagram user name 
        // $data = $user->username;
        // dd($data);
        $data['user_name'] = $user->username;
        $data['provider_id'] = $user->id;
        $data['provider_name'] = 'instagram';
        $data['password'] = encrypt('admin@123');
        $isUser = User::where('provider_id', $user->id)->first();
       //echo "data save successfully"; die;
        if($isUser){
            Auth::login($isUser);
            return redirect('/deshboard');
        }
            if($userId = User::where('user_name', $user->username)->first()){
                //dd();
                User::where('id',$userId['id'])
                ->update(['provider_id' => $user->id,
                'provider_id' => $user->id,
                'user_name' => $user->username,
                'provider_name' => 'instagram']);
                return redirect('/deshboard');
        } else {
            $result = User::Create($data);
            Auth::login($result);
            return redirect('/deshboard');
        }
    }
    
}
