<?php

namespace App\Filament\Resources\Loans\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

use Filament\Tables\Filters\SelectFilter;
use Filament\Actions\Action;
use Filament\Notifications\Notification;

use App\Models\Loan;

class LoansTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('book.title')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('loan_date')
                    ->searchable(),
                TextColumn::make('due_date')
                    ->searchable(),
                TextColumn::make('return_at')
                    ->searchable(),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn ($state) => $state === 'dipinjam' ? 'warning' : 'success')
                    ->searchable(),
                TextColumn::make('fine')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('status')->options([
                    'dipinjam'=> 'Dipinjam',
                    'dikembalikan'=> 'Dikembalikan',
                ])
            ])
            ->recordActions([
                Action::make('kembalikan')
                    ->label('Kembalikan')
                    ->icon('heroicon-o-arrow-uturn-left')
                    ->requiresConfirmation()
                    ->visible(fn (Loan $record) => $record->status === 'dipinjam')
                    ->action(function (Loan $record) {
                        $telat = (int) $record->due_date->diffInDays(now()->startOfDay(), false);

                        $record->update([
                            'return_at'=> now(),
                            'status'=> 'dikembalikan',
                            'fine'=> max(0, $telat) * 1000,
                        ]);

                        $record->book->increment('stock');
                        Notification::make()->title('Buku Berhasil Dikembalikan')->success()->send();
                    }),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
