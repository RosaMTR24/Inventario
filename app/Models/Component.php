<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Component extends Model
{
    use HasFactory;

    protected $guarded = [];


    protected static function booted()
    {
        static::updating(function ($component) {
            // Eliminar el campo category_id si se está actualizando
            if ($component->isDirty('category_id')) {
                unset($component->category_id);
            }
        });
    }


    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class);
    }
    public function loan(): BelongsTo
    {
        return $this->belongsTo(Loan::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
