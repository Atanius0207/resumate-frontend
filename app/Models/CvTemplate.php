<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CvTemplate extends Model
{
    protected $guarded = [];

    protected $casts = [
        'tags' => 'array',
        'form_schema' => 'array',
        'is_new' => 'boolean',
        'is_active' => 'boolean',
        'rating' => 'decimal:2',
    ];

    public function resumes(): HasMany
    {
        return $this->hasMany(Resume::class);
    }
}
