<?php

namespace App\Filament\Student\Resources\LoanResource\RelationManagers;

use App\Models\Store;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ComponentRelationManager extends RelationManager
{
    protected static string $relationship = 'component';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('component_id')->label('Categoría')
                    ->relationship('category', 'name')
                    ->default('Electronica')
                    ->columnSpanFull()
                    ->live(),
                Forms\Components\Select::make('store_id')
                    ->label('Componente')
                    ->options(function (callable $get) {
                        $components = Store::where('category_id', $get('component_id'))->pluck('name_component', 'id');
                        return $components;
                    })
                    ->required(),
                Forms\Components\TextInput::make('number')
                    ->label('Cantidad')
                    ->required()
                    ->numeric()
            ]);
    }

    public function table(Table $table): Table
    {
        
        $estado = $this->getOwnerRecord()->state_loan;


        return $table
            ->emptyStateHeading('Sin componentes')
            ->emptyStateDescription('Añade componentes a tu prestamo')
            ->recordTitleAttribute('store_id')
            ->columns([
                Tables\Columns\TextColumn::make('store.name_component')
                    ->label('Componente'),
                Tables\Columns\TextColumn::make('number')
                    ->label('Cantidad')
            ])
            ->filters([
                //
            ])
            ->headerActions([

                Tables\Actions\CreateAction::make()
                    ->mutateFormDataUsing(function (array $data): array {
                        unset($data['component_id']);
                        return $data;
                    })
                    ->label('Añadir componente')
                    ->visible(function(){
                        return $this->getOwnerRecord()->state_loan == 'waiting' ? true : false;
                    }),
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
                // Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}