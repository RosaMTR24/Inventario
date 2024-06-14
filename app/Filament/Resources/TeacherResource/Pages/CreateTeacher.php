<?php

namespace App\Filament\Resources\TeacherResource\Pages;

use App\Filament\Resources\TeacherResource;
use App\Models\User;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTeacher extends CreateRecord
{
    protected static string $resource = TeacherResource::class;
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        User::created(['name'=>$data['name'],'career'=>$data['career'],'email'=>$data['email'],'password'=>$data['password']]);
        $user_id = User::where('email', $data['email'])->value('id');
        unset($data['email']);
        unset($data['password']);
        $data['user_id'] = $user_id;
        
        return $data;

    }
}
