<?php
//Define el espacio de nombres para esta clase.
namespace App\Filament\Pages\Customizations;
//Importa las clases necesarias que se utilizarán en esta clase.
use App\Models\Team;
use App\Models\User;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\Auth\Register;
//Define una clase llamada RegisterUser que extiende la clase Register del paquete Filament. Esto significa que RegisterUser hereda todos los métodos y propiedades de Register.
class RegisterUser extends Register
{
    public static function getLabel(): string
    {
        //Este método devuelve una cadena de texto que será usada como la etiqueta del formulario de registro. 
        return 'Register team';
    }
     //Este método define el formulario que se mostrará en la página de registro
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                
                $this->getNameFormComponent(),
                $this->getEmailFormComponent(),
                TextInput::make('studetID')
                ->label('Matrícula')
                ->required(),
                Select::make('career')
                ->required()
                ->label('Carrera')
                ->options([
                    'Ing_computation' => 'Ingenieria en Computacion',
                    'Ing_electronics' => 'Ingenieria en Electrónica',
                    'Ing_electric' => 'Ingenieria en Eléctrica'
                ]),
                $this->getPasswordFormComponent(),
                $this->getPasswordConfirmationFormComponent(),


            ]);
    }
    //Este método maneja el proceso de registro. Crea un nuevo usuario con los datos proporcionados en el formulario:
    protected function handleRegistration(array $data): User
    {
        $team = User::create($data);

        //$team->members()->attach(auth()->user());

        return $team;
    }
}
