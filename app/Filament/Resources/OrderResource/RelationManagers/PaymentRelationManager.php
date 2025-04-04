<?php

namespace App\Filament\Resources\OrderResource\RelationManagers;

use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Forms\Components\{Select, TextInput};
use Filament\Tables\Columns\TextColumn;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
class PaymentRelationManager extends RelationManager
{
    protected static string $relationship = 'payment';
    protected static ?string $recordTitleAttribute = 'id';

    public function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('amount')->label('Monto')->numeric()->required(),
            Select::make('method')->label('Método')->options([
                'paypal' => 'PayPal',
                'stripe' => 'Stripe',
            ])->required(),
            TextInput::make('status')->label('Estado')->required(),
            TextInput::make('transaction_id')->label('ID de Transacción')->nullable(),
        ]);
    }

    public function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('amount')->label('Importe')->money('EUR'),
            TextColumn::make('method')->label('Método'),
            BadgeColumn::make('status')->label('Estado'),
            TextColumn::make('transaction_id')->label('ID Transacción'),
            TextColumn::make('created_at')->label('Fecha')->dateTime('d/m/Y H:i'),
        ])->actions([
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
        ])->bulkActions([]);
    }
}
