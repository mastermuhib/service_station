<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
//use Illuminate\Database\Eloquent\Relations\HasMany;


class Cart extends BaseModel
{

    protected $table = 'carts';
    public $timestamps = true;
    public $incrementing = true;

    // public function items(): HasMany
    // {
    //     return $this->hasMany(EstimateTemplateItem::class, 'estimate_template_id');
    // }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

}
