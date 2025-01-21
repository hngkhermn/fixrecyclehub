<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = ['id_products'];
    protected $primaryKey = 'id_products';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'name',
        'images',
        'description',
        'price',
        'stock',
        'categories',
    ];
}
