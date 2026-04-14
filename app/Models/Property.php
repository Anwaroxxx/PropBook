<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Property extends Model
{
    /** @use HasFactory */
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'address',
        'price_per_visit',
        'image',
    ];

    /**
     * Return an accessible URL for the property's image when available.
     * Falls back to null if there is no image stored.
     */
    public function getImageUrlAttribute(): ?string
    {
        if (empty($this->image)) {
            return null;
        }

        return asset('storage/' . $this->image);
    }

    protected function casts(): array
    {
        return [
            'price_per_visit' => 'decimal:2',
        ];
    }

    public function visits(): HasMany
    {
        return $this->hasMany(Visit::class);
    }
}
