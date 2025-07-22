<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\TransactionResource\Pages;
use App\Filament\Admin\Resources\TransactionResource\RelationManagers;
use App\Models\Transaction;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TransactionResource extends Resource
{
    protected static ?string $model = Transaction::class;

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';
    protected static ?string $navigationLabel = 'Transactions';
    protected static ?string $modelLabel = 'Transaction';
    protected static ?string $pluralModelLabel = 'Transactions';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('buyer_id')
                ->relationship('buyer', 'name')
                ->label('Buyer')
                ->searchable()
                ->required(),

            Forms\Components\Select::make('house_id')
                ->relationship('house', 'title')
                ->label('House')
                ->searchable()
                ->required(),

            Forms\Components\DatePicker::make('date')
                ->label('Transaction Date')
                ->required(),

            Forms\Components\TextInput::make('total_price')
                ->numeric()
                ->prefix('Rp')
                ->label('Total Price')
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('buyer.name')->label('Buyer')->searchable(),
                Tables\Columns\TextColumn::make('house.title')->label('House')->searchable(),
                Tables\Columns\TextColumn::make('date')->date(),
                Tables\Columns\TextColumn::make('total_price')->money('IDR', true),
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
            'index' => Pages\ListTransactions::route('/'),
            'create' => Pages\CreateTransaction::route('/create'),
            'edit' => Pages\EditTransaction::route('/{record}/edit'),
        ];
    }
}