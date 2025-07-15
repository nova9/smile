<?php

namespace App\Livewire;

use Illuminate\Validation\Rules\Password;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Signup extends Component
{
    #[Validate]
    public $role = '';

    #[Validate]
    public $name = '';

    #[Validate]
    public $password = '';

    #[Validate]
    public $password_confirmation = '';

    #[Validate]
    public $email = '';

    #[Validate]
    public $tos = false;

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', Password::default()],
            'password_confirmation' => 'same:password',
            'tos' => 'accepted',
            'role' => 'required|in:volunteer,requester'
        ];
    }

    protected function messages()
    {
        return [
            'tos.accepted' => 'You must accept the terms of service to signup.',
            'role.required' => 'What would you like to do?',
        ];
    }

    public function save()
    {
        $validated = $this->validate();

        $role = \App\Models\Role::where('name', $validated['role'])->firstOrFail();
        $user = \App\Models\User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'],
            'role_id' => $role->id,
        ]);

        auth()->login($user);

        return redirect()->route('dashboard')->with('success', 'Account created successfully!');
    }

    public function render()
    {
        return view('livewire.signup');
    }
}
