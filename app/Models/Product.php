<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;

    const PATH = '/images/products/';

    protected $fillable = [
        'name',
        'description',
        'price',
        'category_id',
        'image',
    ];

    public static function rules (){
        return [
            'description' => 'required|string|max:1000|min:3|regex:/^[a-zA-Z0-9\s]+$/',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
