<?php

namespace App\Filament\Auth;

use Filament\Auth\Pages\Login as BaseLogin;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Component;
use Illuminate\Validation\ValidationException;

class Login extends BaseLogin
{
    public function getEmailFormComponent() : Component {
        return TextInput::make('username')
            ->label('Username')
            ->required()
            ->autofocus();
    }

    public function getCredentialsFromFormData(array $data) : array {
        return [
            'username'=> $data['username'],
            'password'=> $data['password'],
        ];
    }

    public function throwFailureValidationException() : never {
        throw ValidationException::withMessages([
            'data.username'=> 'Username or Password is Incorrect',
            'data.password'=> 'Username or Password is Incorrect',
        ]);
    }
}
