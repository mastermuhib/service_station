<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
//use Illuminate\Database\Eloquent\Relations\HasMany;


class Transaction extends BaseModel
{

    protected $table = 'transactions';
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

    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class, 'address_id');
    }

}
