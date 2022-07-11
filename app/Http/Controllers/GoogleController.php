<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
    public function handle()
    {
        try{
            $user = Socialite::driver('google')->user();
            $find = User::query()->where('google_id', $user->id)->first();
            if($find){
                Auth::login($find);
                return redirect('/home');
            }
            else{
                $new = User::query()->create([
                    'name'=>$user->name,
                    'email'=>$user->email,
                    'google_id'=>$user->id,
                    'token'=>$user->token,
                    'password'=>encrypt('1234567du')
                ]);

                return redirect('/home');
            }
        }
        catch(\Exception $e){
            dd($e->getMessage());
        }
    }
}
