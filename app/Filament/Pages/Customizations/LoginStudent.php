<?php

//Este código personaliza la página de inicio de sesión en una aplicación Filament, 
//añadiendo un campo específico para la matrícula del estudiante (studentID). 
//La clase LoginStudent extiende la funcionalidad básica de inicio de sesión proporcionada por Filament 
//y adapta el formulario para incluir campos adicionales según los requisitos de la aplicación.
//Define el espacio de nombres para organizar la clase dentro de la estructura del proyecto.
namespace App\Filament\Pages\Customizations;
//La clase LoginStudent extiende la clase Login de Filament, permitiendo personalizar el proceso de inicio de sesión.
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\Auth\Login;

class LoginStudent extends Login
{
//define el formulario de incio de sesion personalizado, añadiendo un campo StudentId(matricula) y el campo de contraseña.

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('studentID')
                ->label('Matrícula')
                ->required(),
                $this->getPasswordFormComponent()
            ]);
    }
    //Extrae las credenciales del formulario, asignando los datos del campo studentID y password a un array que será utilizado para la autenticación.

    protected function getCredentialsFromFormData(array $data): array
    {
        return [
            'studentID' => $data['studentID'],
            'password' => $data['password'],
        ];
    }


}

