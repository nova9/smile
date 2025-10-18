<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password as FacadesPassword;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;
use Livewire\Component;

class ResetPassword extends Component
{

   public $token;
   public $email = '';
   public $password = '';
   public $password_confirmation = '';

   protected function rules()
   {
      return [
         'password' => ['required', 'confirmed', Password::defaults()],
      
      ];
   }
   public function mount($token)
   {
      $this->token = $token;
      $this->email = request()->query('email', '');
   }
   public function resetPassword()
   {
      $this->validate();
      $status = FacadesPassword::reset([
         'email' => $this->email,
         'password' => $this->password,
         'password_confirmation' => $this->password_confirmation,
         'token' => $this->token
         
         ],
      function($user,$password){
         $user->forceFill(
            [  
               'password' => Hash::make($password),
               'remember_token' => Str::random(60),
            ]
         )->save();
         
         Auth::login($user);//logins the user
      }
      );
      if ($status === FacadesPassword::PASSWORD_RESET) {
          session()->flash('message', 'Your password has been reset successfully!');
          redirect()->route('dashboard');//redirect to the already login page
      } else {
          $this->addError('email', __($status));
      }
   }

   public function render()
   {
      return view('livewire.resetpassword');
   }
}
