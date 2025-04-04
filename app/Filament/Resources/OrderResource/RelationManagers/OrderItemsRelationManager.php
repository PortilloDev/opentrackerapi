<?php

namespace App\Filament\Resources\OrderResource\RelationManagers;

use Filament\Resources\RelationManagers\RelationManager;
use Filament\Forms\Components\{Select, TextInput};
use Filament\Tables\Columns\TextColumn;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
class OrderItemsRelationManager extends RelationManager
{
    protected static string $relationship = 'items';
    protected static ?string $recordTitleAttribute = 'product.name';

    public function form(Form $form): Form
    {
        return $form->schema([
            Select::make('product_id')->label('Producto')->relationship('product', 'name')->searchable()->required(),
            TextInput::make('quantity')->label('Cantidad')->numeric()->required(),
            TextInput::make('price')->label('Precio')->numeric()->required(),
        ]);
    }

    public function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('product.name')->label('Producto'),
            TextColumn::make('quantity')->label('Cantidad'),
            TextColumn::make('price')->label('Precio')->money('usd'),
        ])->actions([
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
        ])->bulkActions([]);
    }
}
