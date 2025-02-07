<?php
//Este RelationManager proporciona una interfaz para gestionar la relación component en el contexto de un LoanResource. Define tanto la estructura del formulario como la tabla, permitiendo crear, editar y eliminar registros relacionados solo cuando el estado del préstamo es on_loan.

namespace App\Filament\Resources\LoanResource\RelationManagers;

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
    protected static ?string $title = 'Material';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('component_id')
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
        return $table
            ->recordTitleAttribute('store_id')
            ->columns([
                Tables\Columns\TextColumn::make('store.name_component'),
                Tables\Columns\TextColumn::make('number'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->visible(function () {
                        $parentRecord = $this->getOwnerRecord();
                        return $parentRecord && ($parentRecord->state_loan === 'on_loan' || $parentRecord->state_loan === 'waiting' );
                    })
                    ->mutateFormDataUsing(function (array $data): array { 
                        unset($data['component_id']);
                        return $data;
                    })
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->visible(function () {
                        $parentRecord = $this->getOwnerRecord();
                        return $parentRecord && $parentRecord->state_loan === 'on_loan';
                    }),
                Tables\Actions\DeleteAction::make()
                    ->visible(function () {
                        $parentRecord = $this->getOwnerRecord();
                        return $parentRecord && $parentRecord->state_loan === 'on_loan';
                    })
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}