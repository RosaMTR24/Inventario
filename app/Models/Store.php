<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Store extends Model
{
    use HasFactory;

    protected $fillable = ['name_component',
    'model',
    'serial_number',
    'trademark',
   'description',
    'number_componet','category_id'];


    public function component():HasMany{
        return $this->hasMany(Component::class);
    
    }

    public function category():BelongsTo{
        return $this->belongsTo(Category::class);
    }
}
