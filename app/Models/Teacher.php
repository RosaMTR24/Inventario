<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = ['name','career'];
    

    public function loan():HasMany{
        return $this->hasMany(Loan::class);
    }

    public function user():BelongsTo{
        return $this->belongsTo(User::class);
    }
}
