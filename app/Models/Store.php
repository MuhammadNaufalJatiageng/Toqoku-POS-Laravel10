<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Store extends Model
{
    use HasFactory;
    
    protected $guarded = ['id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // public function products(): HasMany
    // {
    //     return $this->hasMany(Product::class);
    // }
    
    // public function receipts(): HasMany
    // {
    //     return $this->hasMany(Receipt::class);
    // }
}
