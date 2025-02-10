<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;

    // Define os campos que podem ser preenchidos em massa
    protected $fillable = [
        'name',
        'price',
        'photo',
        'product_type_id',
    ];

    /**
     * Relacionamento de muitos-para-muitos com o modelo Order.
     * Um produto pode estar em muitos pedidos.
     */
    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }

    /**
     * Relacionamento de muitos-para-um com o modelo ProductType.
     * Um produto pertence a um tipo de produto.
     */
    public function productType()
    {
        return $this->belongsTo(ProductType::class);
    }
}
