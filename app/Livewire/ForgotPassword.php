<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Notification;
use App\Services\Notifications\ResetPassword;
use Illuminate\Support\Facades\Password;
use Livewire\Component;

class ForgotPassword extends Component
{
   public $email = '';
      
   protected $rules = [
        'email' => 'required|email|exists:users,email',
    ];

   public function sendEmail()
   {
      $this->validate();
      $status = Password::sendResetLink(['email' => $this->email]);
      
      if($status === Password::RESET_LINK_SENT){
         session()->flash('message', __('We have emailed your password reset link!'));
         $this->reset('email');
      }else{
            $this->addError('email', __($status));
      }
   }

   public function render()
   {
      return view('livewire.forgotpassword');
   }
}
