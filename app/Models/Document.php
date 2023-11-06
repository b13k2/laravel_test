<?php

declare(strict_types=1);

namespace App\Models;

use App\Dictionaries\DocumentType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property string $date
 * @property int $type_id
 *
 * @property ?string $created_at
 * @property ?string $updated_at
 * @property ?string $deleted_at
 *
 * @property-read DocumentProduct[] $products
 */
class Document extends Model
{
    use SoftDeletes;

    /**
     * @var string[]
     */
    public array $sortable = [
        'id',
        'date',
        'type_id',
    ];

    /** @inheritDoc */
    protected $fillable = [
        'date',
        'type_id',
    ];

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'date' => 'date',
        'type_id' => DocumentType::class,
    ];

    /**
     * @return HasMany
     */
    public function products(): HasMany
    {
        return $this->hasMany(DocumentProduct::class);
    }
}
