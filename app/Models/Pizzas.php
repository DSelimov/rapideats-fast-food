<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pizzas extends Model
{
    /** @use HasFactory<\Database\Factories\PizzasFactory> */
    use HasFactory;
    protected $fillable = ['name', 'description', 'price', 'image'];
}
