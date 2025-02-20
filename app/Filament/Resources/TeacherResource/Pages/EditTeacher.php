<?php

namespace App\Filament\Resources\TeacherResource\Pages;

use App\Filament\Resources\TeacherResource;
use App\Models\User;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Actions\Action;

class EditTeacher extends EditRecord
{
    protected static string $resource = TeacherResource::class;
    protected static ?string $title = 'Editar profesor'; // Atributo para el título

    public function getHeading(): string
    {
        return static::$title; // Devolver el título p
    }


    protected function getHeaderActions(): array
    {
        return [
            //Actions\DeleteAction::make()->label('Borrar') // Cambia el texto del botón
            //->modalHeading('Borrar profesor') // Cambia el título del modal de confirmación
            //->modalSubheading('¿Estás seguro de borrar a este profesor?'),

            Action::make('delate')->label('Borrar') // Cambia el texto del botón
            ->requiresConfirmation()
            ->modalHeading('Borrar profesor') // Cambia el título del modal de confirmación
            ->modalSubheading('¿Estás seguro de borrar a este profesor?')
            ->button()
            ->color('danger')
            ->action(function(){
                //dd($this->getResource()::getRoute('index'));
                User::where('id',$this->getRecord()->user_id)->delete();
                return redirect($this->getResource()::getUrl('index'));

            })
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['name'] = $this->record->user->name;
        $data['career'] = $this->record->user->career;
        $data['email'] = $this->record->user->email;
        // dd($data);


        return $data;
    }
}