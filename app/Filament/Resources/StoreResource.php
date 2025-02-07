<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StoreResource\Pages;
use App\Filament\Resources\StoreResource\RelationManagers;
use App\Models\Store;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn\TextColumnSize;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class StoreResource extends Resource
{
    protected static ?string $model = Store::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-storefront';
    protected static ?string $navigationLabel = 'Inventario';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name_component')
                    ->label('Nombre del componente')->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('model')
                    ->label('Modelo')->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('serial_number')
                ->label('Numero de serie')->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('trademark')
                ->label('Marca')->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('description')
                ->label('Descripcion')->required()
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('number_componet')
                ->label('Cantidad ')->required()
                    ->numeric(),
                Forms\Components\Select::make('category_id')
                ->label('categoria')    
                ->relationship('category', 'name')
                    ->createOptionForm([
                        Forms\Components\TextInput::make('name')
                            ->label('Nombre de la categoria')
                            ->required(),
                    ])
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->emptyStateHeading('No hay inventario')
        ->emptyStateIcon('heroicon-m-no-symbol')
            ->columns([
                Tables\Columns\TextColumn::make('name_component')
                    ->label('Componente')
                    ->searchable(),
                Tables\Columns\TextColumn::make('model')
                    ->label('Modelo')
                    ->searchable(),
                Tables\Columns\TextColumn::make('serial_number')
                ->label('Serie')->searchable(),
                Tables\Columns\TextColumn::make('trademark')
                ->label('Marca')->searchable(),
                Tables\Columns\TextColumn::make('number_componet')
                ->label('Cantidad')->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('category.name')
                ->label('Categoria')->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            'index' => Pages\ListStores::route('/'),
            'create' => Pages\CreateStore::route('/create'),
            'edit' => Pages\EditStore::route('/{record}/edit'),
        ];
    }
}