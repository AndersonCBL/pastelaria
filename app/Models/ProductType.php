<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    use HasFactory;

    // Define os campos que podem ser preenchidos em massa
    protected $fillable = ['name'];

    /**
     * Relacionamento de um-para-muitos com o modelo Product.
     * Um tipo de produto pode ter muitos produtos.
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
