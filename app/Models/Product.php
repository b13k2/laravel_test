<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property string $name
 * @property string $vendor_code
 * @property int $quantity
 * @property string $price
 *
 * @property ?string $created_at
 * @property ?string $updated_at
 * @property ?string $deleted_at
 */
class Product extends Model
{
    use SoftDeletes;

    /**
     * @var string[]
     */
    public array $sortable = [
        'id',
        'name',
        'vendor_code',
        'quantity',
        'price',
    ];

    /** @inheritDoc */
    protected $fillable = [
        'name',
        'vendor_code',
        'quantity',
        'price',
    ];

    /**
     * @var array<string, string>
     */
    protected $casts = [
    ];
}
