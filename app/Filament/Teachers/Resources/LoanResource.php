<?php

namespace App\Filament\Teachers\Resources;

use App\Filament\Teachers\Resources\LoanResource\Pages;
use App\Filament\Teachers\Resources\LoanResource\RelationManagers;
use App\Models\Loan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class LoanResource extends Resource
{
    protected static ?string $model = Loan::class;

    protected static ?string $navigationIcon = 'heroicon-s-ticket';
    protected static ?string $navigationLabel = 'Tikets';

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->whereHas('teacher', function (Builder $query) {
                $query->where('id', Auth::user()->teacher->id);
            });
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([


                Forms\Components\Select::make('laboratory_id')
                    ->label('Laboratorio')->relationship('laboratory', 'name')
                    ->disabledOn('edit')
                    ->required(),
                Forms\Components\TextInput::make('materia')
                ->label('Materia')->required()
                    ->disabledOn('edit')
                    ->maxLength(255),

                Forms\Components\Select::make('state_loan')
                ->label('Estado')->options([
                        'on_loan' => 'en prestamo',
                        'delivered' => 'entregado'
                    ])
                    ->hiddenOn('create')
                    ->required(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->emptyStateHeading('No hay prestamos')
            ->emptyStateIcon('heroicon-m-no-symbol')
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                ->label('Usuario')->numeric()
                    ->sortable(),
                // Tables\Columns\TextColumn::make('teacher.name')
                //     ->numeric()
                //     ->sortable(),
                Tables\Columns\TextColumn::make('laboratory.name')
                ->label('Laboratorio')->numeric(),
                Tables\Columns\TextColumn::make('materia')
                ->label('Materia')->searchable(),
                Tables\Columns\TextColumn::make('state_loan')
                ->label('Estado')->badge()
                    ->color(function ($state) {
                        return $state === 'on_loan' ? 'warning' : 'success';
                    })
                    ->formatStateUsing(function ($state) {
                        return $state === 'on_loan' ? 'En prestamo' : 'Entregado';
                    }),
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
                Tables\Actions\EditAction::make()
                    ->label('Ver tiket')
                    ->icon('heroicon-s-eye'),
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
            RelationManagers\ComponentRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLoans::route('/'),
            'create' => Pages\CreateLoan::route('/create'),
            'edit' => Pages\EditLoan::route('/{record}/edit'),
        ];
    }
}