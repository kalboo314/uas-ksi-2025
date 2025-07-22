<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\ReviewResource\Pages;
use App\Filament\Admin\Resources\ReviewResource\RelationManagers;
use App\Models\Review;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ReviewResource extends Resource
{
    protected static ?string $model = Review::class;

    protected static ?string $navigationIcon = 'heroicon-o-star';
    protected static ?string $navigationLabel = 'Reviews';
    protected static ?string $modelLabel = 'Review';
    protected static ?string $pluralModelLabel = 'Reviews';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('house_id')
                ->relationship('house', 'title')
                ->label('House')
                ->searchable()
                ->required(),

            Forms\Components\Select::make('buyer_id')
                ->relationship('buyer', 'name')
                ->label('Buyer')
                ->searchable()
                ->required(),

            Forms\Components\Textarea::make('comment')
                ->required()
                ->maxLength(500),

            Forms\Components\Select::make('rating')
                ->options([
                    1 => '1 - Very Poor',
                    2 => '2 - Poor',
                    3 => '3 - Average',
                    4 => '4 - Good',
                    5 => '5 - Excellent',
                ])
                ->required()
                ->label('Rating'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('house.title')->label('House'),
                Tables\Columns\TextColumn::make('buyer.name')->label('Buyer'),
                Tables\Columns\TextColumn::make('rating')->sortable(),
                Tables\Columns\TextColumn::make('comment')->limit(50),
                Tables\Columns\TextColumn::make('created_at')->dateTime(),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListReviews::route('/'),
            'create' => Pages\CreateReview::route('/create'),
            'edit' => Pages\EditReview::route('/{record}/edit'),
        ];
    }
}