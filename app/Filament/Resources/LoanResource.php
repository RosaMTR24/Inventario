<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LoanResource\Pages;
use App\Filament\Resources\LoanResource\RelationManagers;
use App\Models\Loan;
use App\Models\Teacher;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LoanResource extends Resource
{
    protected static ?string $model = Loan::class;

    protected static ?string $navigationIcon = 'heroicon-o-ticket';
    protected static ?string $navigationLabel = 'Tikets';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                ->label('Usuario')    
                ->relationship('user', 'name')
                    ->hiddenOn('edit')
                    ->required()
                    ->searchable(),
                // Forms\Components\Select::make('teacher_id')
                //     ->relationship('teacher.user', 'id')
                //     ->disabledOn('edit')
                //     ->required(),
                Forms\Components\Select::make('teacher_id')
                    ->label('Profesor')
                    ->options(function () {
                        $teachers = Teacher::whereHas('user', function (Builder $query) {
                        })->with('user:id,name')->get();
                        return $teachers->pluck('user.name', 'id')->toArray();
                    })
                    ->required(),
                Forms\Components\Select::make('laboratory_id')
                ->label('Laboratorio') ->relationship('laboratory', 'name')
                    ->disabledOn('edit')
                    ->required(),
                Forms\Components\TextInput::make('materia')
                ->label('Materia') ->required()
                    ->disabledOn('edit')
                    ->maxLength(255),
                Forms\Components\Select::make('state_loan')
                    ->label('Estado')->options([
                        'waiting' => 'En espera',
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
            ->emptyStateHeading('No hay tickets')
            ->emptyStateIcon('heroicon-m-no-symbol')
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                ->label('Usuario')  ->numeric()
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('teacher.user.name')
                ->label('Profesor') ->numeric(),
                Tables\Columns\TextColumn::make('laboratory.name')
                ->label('Laboratorio') ->numeric(),
                Tables\Columns\TextColumn::make('materia')
                ->label('Materia') ->searchable(),
                Tables\Columns\TextColumn::make('state_loan')
                ->label('Estado') ->badge()
                    ->color(function ($state) {
                        return $state === 'on_loan' ? 'warning' : 'success';
                    })
                    ->formatStateUsing(function ($state) {
                        return $state === 'on_loan' ? 'En prestamo' : ($state == 'waiting' ? 'En espera' : 'Entregado');
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