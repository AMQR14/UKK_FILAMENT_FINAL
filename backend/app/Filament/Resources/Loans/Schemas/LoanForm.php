<?php

namespace App\Filament\Resources\Loans\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

use Filament\Forms\Components\Select;

class LoanForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->relationship('user', 'name'),
                Select::make('book_id')
                    ->relationship('book', 'title'),
                TextInput::make('loan_date')
                    ->required(),
                TextInput::make('due_date')
                    ->required(),
            ]);
    }
}
