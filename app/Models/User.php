<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

use Illuminate\Notifications\Notifiable;

use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements FilamentUser
{
    
    use HasFactory, Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */



   
     
    protected $fillable = [
        'name',
        'email',
        'career',
        'studentID',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function loan():HasMany{
        return $this->hasMany(Loan::class);
    }

    public function teacher():HasOne{
        return $this->hasOne(Teacher::class);
    }

    public function student():HasOne{
        return $this->hasOne(Student::class);
    }


    

    private function authoritationUser($roles, $panel):bool{
        $auth = false;
        foreach($roles as $role){

            if($panel == 'admin'){
                if($role == 'admin'){
                    $auth = true;
                    break;
                }
            }elseif($panel == 'teachers'){
                if($role == 'teacher'){
                    $auth = true;
                    break;
                }
            }else{
                if($role == 'student'){
                    $auth = true;
                    break;
                }
            }
            
        }

        return $auth;
    }

    public function canAccessPanel(Panel $panel): bool
    {
        $authoritation = false;
        
        $roles = Auth::user()->getRoleNames();
        
        if ($panel->getId() === 'admin') {

            $authoritation = $this->authoritationUser($roles, 'admin');

        } elseif ($panel->getId() === 'teachers') {

            $authoritation = $this->authoritationUser($roles, 'teachers');

        } else {

            $authoritation = $this->authoritationUser($roles, 'student');
        }

        return $authoritation;
    }
}