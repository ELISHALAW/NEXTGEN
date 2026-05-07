<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     * These must match your database columns.
     */
    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'image',
        'stock',
        'is_active',
    ];

    /**
     * The attributes that should be cast to native types.
     * This ensures 'is_active' behaves like a true/false boolean.
     */
    protected $casts = [
        'price' => 'decimal:2',
        'is_active' => 'boolean',
    ];
}
