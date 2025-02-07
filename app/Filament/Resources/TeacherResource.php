<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TeacherResource\Pages;
use App\Filament\Resources\TeacherResource\RelationManagers;
use App\Models\Teacher;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TeacherResource extends Resource
{
    protected static ?string $model = Teacher::class;
    protected static ?string $navigationLabel = 'Profesores';

    // protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Usuarios';



    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Nombre')->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('career')
                ->label('Carrera')->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')->email()->label('Correo Electronico')->required()->maxLength(255)
                ->hiddenOn('edit'),
                Forms\Components\TextInput::make('password')->password()->label('Contraseña')->required()->maxLength(255)
                    ->hiddenOn('edit'),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->emptyStateHeading('No hay profesores')
        ->emptyStateIcon('heroicon-m-no-symbol')
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                ->label('Nombre')->searchable(),
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
            'index' => Pages\ListTeachers::route('/'),
            'create' => Pages\CreateTeacher::route('/create'),
            'edit' => Pages\EditTeacher::route('/{record}/edit'),
        ];
    }
}