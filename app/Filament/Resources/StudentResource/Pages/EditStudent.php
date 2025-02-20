<?php

namespace App\Filament\Resources\StudentResource\Pages;
use App\Models\User;
use App\Filament\Resources\StudentResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\EditRecord;

class EditStudent extends EditRecord
{
    protected static string $resource = StudentResource::class;
    protected static ?string $title = 'Editar estudiante'; // Atributo para el título

    public function getHeading(): string
    {
        return static::$title; // Devolver el título p
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('delate')->label('Borrar') // Cambia el texto del botón
            ->requiresConfirmation()
            ->modalHeading('Borrar estudiante') // Cambia el título del modal de confirmación
            ->modalSubheading('¿Estás seguro de borrar a este estudiante?') // Cambia el mensaje de confirmación,
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

