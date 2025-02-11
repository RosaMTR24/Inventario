<?php

namespace App\Filament\Teachers\Resources\LoanResource\RelationManagers;

use App\Models\Store;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class ComponentRelationManager extends RelationManager
{
    protected static string $relationship = 'component';
    protected static ?string $title = 'Material';

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
        $visible=true;
        if($this->getOwnerRecord()->state_loan == 'delivered'){
            $visible = false;
        }
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('store.name_component')
                    ->label('Componente'),
                Tables\Columns\TextColumn::make('number')
                    ->label('Cantidad'),
            ])
            ->filters([
                // Define filters if needed
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()->label('Añadir componente')
                    ->mutateFormDataUsing(function (array $data): array {
                        unset($data['component_id']);
                        return $data;
                    })->visible($visible),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->mutateFormDataUsing(function (array $data): array {
                        unset($data['component_id']);
                        return $data;
                    }) ->visible(function () {
                        $parentRecord = $this->getOwnerRecord();
                        return $parentRecord && $parentRecord->state_loan === 'on_loan';
                    }),
                Tables\Actions\DeleteAction::make()->visible(function () {
                    $parentRecord = $this->getOwnerRecord();
                    return $parentRecord && $parentRecord->state_loan === 'on_loan';
                }),
            ])
            
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}