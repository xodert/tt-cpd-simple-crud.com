<?php

namespace App\Models;

use App\Scopes\ProductScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes, HasFactory;

    use ProductScope;

    /**
     * @var string[]
     */
    protected $fillable = [
        'article',
        'name',
        'status',
        'data'
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'data' => 'array'
    ];
}
