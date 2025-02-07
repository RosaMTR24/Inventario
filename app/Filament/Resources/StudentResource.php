<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StudentResource\Pages;
use App\Filament\Resources\StudentResource\RelationManagers;
use App\Models\Student;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class StudentResource extends Resource
{
    protected static ?string $model = Student::class;
    protected static ?string $navigationLabel = 'Estudiantes';

    // protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Usuarios';
    // Para evitar que un recurso aparesca
    // protected static bool $shouldRegisterNavigation = false;


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                ->label('Nombre')             
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('studentID')
                ->label('Matrícula')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('career')
                   ->label('Carrera')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')->email()->label('Correo electronico')->required()->maxLength(255)
                    ->hiddenOn('edit'),
                Forms\Components\TextInput::make('password')->password()->label('Contraseña')->required()->maxLength(255)
                    ->hiddenOn('edit'), 
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->emptyStateHeading('No hay estudiantes')
        ->emptyStateIcon('heroicon-m-no-symbol')
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Nombre')->searchable(),
                Tables\Columns\TextColumn::make('studentID')
                ->label('Matricula')->searchable(),
                Tables\Columns\TextColumn::make('user.career')
                ->label('Carrera')->searchable(),
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
            'index' => Pages\ListStudents::route('/'),
            'create' => Pages\CreateStudent::route('/create'),
            'edit' => Pages\EditStudent::route('/{record}/edit'),
        ];
    }
}