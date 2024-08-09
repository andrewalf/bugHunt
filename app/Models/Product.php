<?php

namespace App\Models;

use App\Service\ProductImageService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'price',
        'stock',
        'is_visible',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'is_visible' => 'boolean',
            'price' => 'decimal:2',
        ];
    }

    public function getIsVisibleAttribute($value): string
    {
        return $value ? 'Да' : 'Нет';
    }

    /**
     * Реальные картинки не храним, лениво.
     * Поэтому используем заглушку.
     *
     * @return string
     */
    public function getImageUrl()
    {
        return app(ProductImageService::class)->getRandomImageUrl();
    }
}
