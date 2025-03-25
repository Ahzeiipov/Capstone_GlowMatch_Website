<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products'; // Ensure table name is correct

    protected $primaryKey = 'ProductID'; // Specify primary key

    public $timestamps = true; 

    protected $fillable = [
        'ProductName',
        'SkinType',
        'ConcernType',
        'ProductType',
        'ProductImage1',
        'ProductImage2',
        'ProductImage3',
        'ProductImage4',
        'ProductImage5',
        'KeyIngredients',
        'ShortDescription',
        'MoreDescription',
        'ProductDetails',
        'TextureImage',
        'ProductBenefits',
    ];

    public $incrementing = true; // Set to false if ProductID is not auto-incrementing
    protected $keyType = 'int'; // Use 'string' if the primary key is a UUID or non-integer
}
