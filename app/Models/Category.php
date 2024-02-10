<?php

namespace App\Models;

use App\Http\Controllers\admin\ShopKeeper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'category'
    ];

    public function shopKeeper(): HasMany
    {
        return $this->hasMany(ShopKeeper::class);
    }
}
