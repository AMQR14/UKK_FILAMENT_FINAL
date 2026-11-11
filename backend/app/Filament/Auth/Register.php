<?php

namespace App\Filament\Auth;

use Filament\Auth\Pages\Register as BaseRegister;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Component;
use Illuminate\Validation\ValidationException;

class Register extends BaseRegister
{
    public function getEmailFormComponent() : Component {
        return TextInput::make('username')
            ->label('Username')
            ->required()
            ->autofocus();
    }
}
