<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LeadResource\Pages;
use App\Filament\Resources\LeadResource\RelationManagers;
use App\Models\Lead;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TagsColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LeadResource extends Resource
{
    protected static ?string $model = Lead::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('name')->label('Nombre')->nullable(),
            TextInput::make('lastname')->label('Apellidos')->nullable(),
            TextInput::make('email')->label('Email')->nullable(),
            TextInput::make('source')->label('Origen')->nullable(),
            TextInput::make('status')->label('Estado')->required(),
            Select::make('product_id')->label('Producto')->relationship('product', 'name')->searchable()->nullable(),
            Select::make('promotion_id')->label('Promoción')->relationship('promotion', 'title')->searchable()->nullable(),
            Select::make('tags')
                ->label('Etiquetas')
                ->multiple()
                ->relationship('tags', 'name')
                ->preload(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label('Nombre')->searchable(),
                TextColumn::make('lastname')->label('Apellidos')->searchable(),
                TextColumn::make('email')->label('Email')->searchable(),
                TagsColumn::make('tags.name')->label('Etiquetas')->sortable()->searchable(),
                TextColumn::make('product.name')->label('Producto')->searchable(),
                TextColumn::make('episode.title')->label('Episodio')->searchable(),
                TextColumn::make('promotion.title')->label('Promoción')->searchable(),
                TextColumn::make('source')->label('Origen'),
                BadgeColumn::make('status')->label('Estado'),
                TextColumn::make('created_at')->label('Creado')->dateTime('d/m/Y'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLeads::route('/'),
            'create' => Pages\CreateLead::route('/create'),
            'edit' => Pages\EditLead::route('/{record}/edit'),
        ];
    }
}
