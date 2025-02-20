<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use App\Models\User;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Actions\Action;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;
    protected static ?string $title = 'Editar administrador'; // Atributo para el título

    public function getHeading(): string
    {
        return static::$title; // Devolver el título p
    }

    protected function getHeaderActions(): array
    {
        return [
       Actions\DeleteAction::make()->label('Borrar') // Cambia el texto del botón
       ->modalHeading('Borrar administrador') // Cambia el título del modal de confirmación
       ->modalSubheading('¿Estás seguro de borrar a este administrador?') // Cambia el mensaje de confirmación,,
            
            //Action::make('delate')->label('Borrar') // Cambia el texto del botón
            //->requiresConfirmation()
            //->modalHeading('Borrar administrador') // Cambia el título del modal de confirmación
            //->modalSubheading('¿Estás seguro de borrar a este administrador?') 
            //->button()
            //->color('danger')
            //->action(function(){
            //    //dd($this->getResource()::getRoute('index'));
            //    User::where('id',$this->getRecord()->user_id)->delete();
            //    return redirect($this->getResource()::getUrl('index'));
//
            //})

        ];
    }
}