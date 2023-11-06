<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use ReflectionClass;

/**
 * @property int $id
 * @property int $document_id
 * @property int $product_id
 * @property int $product_quantity
 *
 * @property ?string $created_at
 * @property ?string $updated_at
 * @property ?string $deleted_at
 */
class DocumentProduct extends Model
{
    use SoftDeletes;

    /**
     * @var string[]
     */
    public array $sortable = [
    ];

    /** @inheritDoc */
    protected $fillable = [
    ];

    /**
     * @var array<string, string>
     */
    protected $casts = [
    ];

    /**
     * @return string
     */
    public function formName(): string
    {
        $reflector = new ReflectionClass(static::class);
        return $reflector->getShortName();
    }
}
