<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EpisodeResource\Pages;
use App\Filament\Resources\EpisodeResource\RelationManagers;
use App\Models\Episode;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TimePicker;
use Str;
use TomatoPHP\FilamentDocs\Filament\Actions\DocumentAction;
class EpisodeResource extends Resource
{
    protected static ?string $model = Episode::class;
    protected static ?string $navigationLabel = 'Episodios';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                    Forms\Components\TextInput::make('title')->reactive()
                        ->afterStateUpdated(function ($set, $state) {
                            $set('slug', \Illuminate\Support\Str::slug($state));
                        })->required(),
                    Forms\Components\TextInput::make('slug')->required(),
                    Forms\Components\TextInput::make('url')->label('URL')->url()->required(),
                    Forms\Components\TextInput::make('embedded')->label('Código embebido')->required(),
                    Forms\Components\RichEditor::make('description')->required(),
                    Forms\Components\FileUpload::make('image')->label('Imagen episodio')->required(),
                    DateTimePicker::make('release_date')->label('Fecha de publicación')->required(),
                    Select::make('tags')->label('Etiquetas')->multiple()->relationship('tags', 'name')->preload(),
                ]),
            ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')->label('Título')->sortable()->searchable(),
                TextColumn::make('release_date')->label('Publicado')->dateTime('d/m/Y'),
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
            'index' => Pages\ListEpisodes::route('/'),
            'create' => Pages\CreateEpisode::route('/create'),
            'edit' => Pages\EditEpisode::route('/{record}/edit'),
        ];
    }
}
