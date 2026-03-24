<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ArtworkResource\Pages;
use App\Models\Artwork;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class ArtworkResource extends Resource
{
    protected static ?string $model = Artwork::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo';

    protected static ?string $navigationGroup = 'Content';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Artwork Details')->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255)
                    ->live(onBlur: true)
                    ->afterStateUpdated(function (Forms\Set $set, Forms\Get $get, ?string $state) {
                        $set('slug', Str::slug($state . '-' . ($get('year') ?? now()->year)));
                    }),
                Forms\Components\TextInput::make('slug')
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true),
                Forms\Components\Select::make('artist_id')
                    ->relationship('artist', 'name')
                    ->required()
                    ->searchable()
                    ->preload(),
                Forms\Components\Select::make('exhibition_id')
                    ->relationship('exhibition', 'title')
                    ->searchable()
                    ->preload(),
                Forms\Components\TextInput::make('medium')->maxLength(255),
                Forms\Components\TextInput::make('dimensions')->maxLength(255),
                Forms\Components\TextInput::make('year')->numeric()->minValue(1900)->maxValue(2100),
                Forms\Components\TextInput::make('price')->numeric()->prefix('€'),
                Forms\Components\TextInput::make('sort_order')->numeric()->default(0),
                Forms\Components\Toggle::make('is_available')->default(false),
                Forms\Components\Toggle::make('is_sold')->default(false),
                Forms\Components\RichEditor::make('description')->columnSpanFull(),
            ])->columns(2),

            Forms\Components\Section::make('Image')->schema([
                Forms\Components\FileUpload::make('image')
                    ->image()
                    ->directory('artworks')
                    ->maxSize(20480),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')->square()->size(60),
                Tables\Columns\TextColumn::make('title')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('artist.name')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('medium'),
                Tables\Columns\TextColumn::make('year')->sortable(),
                Tables\Columns\TextColumn::make('price')->money('EUR')->sortable(),
                Tables\Columns\IconColumn::make('is_available')->boolean(),
                Tables\Columns\IconColumn::make('is_sold')->boolean(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('artist_id')
                    ->relationship('artist', 'name')
                    ->label('Artist')
                    ->searchable()
                    ->preload(),
                Tables\Filters\TernaryFilter::make('is_available'),
                Tables\Filters\TernaryFilter::make('is_sold'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListArtworks::route('/'),
            'create' => Pages\CreateArtwork::route('/create'),
            'edit' => Pages\EditArtwork::route('/{record}/edit'),
        ];
    }
}
