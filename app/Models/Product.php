<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Product extends Model
{
    protected $fillable = [
        'category_id','name','slug','description','price','stock','is_active',
    ];

    /** 画像（複数） */
    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class);
    }

    /** メイン画像（1枚） */
    public function mainImage(): HasOne
    {
        return $this->hasOne(ProductImage::class)->where('is_main', true);
    }
}