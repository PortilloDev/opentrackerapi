<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Tables\Columns\TagsColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;
    protected static ?string $navigationLabel = 'Productos';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('name')->reactive()
                ->afterStateUpdated(function ($set, $state) {
                    $set('slug', Str::slug($state));
                })->required(),
            TextInput::make('slug')->label('Slug')->required()->unique(ignoreRecord: true),
            Forms\Components\RichEditor::make('summary')->label('Resumen')->required(),
            Forms\Components\RichEditor::make('description')->label('Descripción')->required(),
            Forms\Components\RichEditor::make('themes')->label('Puntos Relevantes')->required(),
            TextInput::make('price')->label('Precio')->numeric()->minValue(0)->required(),
            Forms\Components\Toggle::make('is_free')->label('Es gratuito'),
            Forms\Components\Toggle::make('is_published')->label('Activo'),
            FileUpload::make('image')->label('Imagen')->required(),
            TextInput::make('external_url')->label('Url externa')->required(),
            Select::make('categories')->label('Categorías')->multiple()->relationship('categories', 'name')->preload(),
            Select::make('tags')->label('Etiquetas')->multiple()->relationship('tags', 'name')->preload(),
            Select::make('product_type_id')
                ->label('Tipo de Producto')
                ->relationship('productType', 'name')
                ->required(),
        ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                TagsColumn::make('productType.name')->label('Tipo de Producto'),
                Tables\Columns\TextColumn::make('price')
                ->money('EUR')
                ->sortable(),
                BooleanColumn::make('is_free')->label('Gratuito'),
                BooleanColumn::make('is_published')->label('Activo'),
                TextColumn::make('created_at')->label('Creado')->dateTime('d/m/Y'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->slideOver(),
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
