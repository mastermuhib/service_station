<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
//use Illuminate\Database\Eloquent\Relations\HasMany;


class ImageProduct extends BaseModel
{

    protected $table = 'product_images';
    public $timestamps = true;
    public $incrementing = true;

    public function items(): HasMany
    {
        return $this->hasMany(Product::class, 'product_id');
    }

}
