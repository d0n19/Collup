<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    protected $fillable = ['user_id', 'category_id', 'title', 'description', 'tech_stack', 'status', 'is_featured'];

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function roles(): HasMany
    {
        return $this->hasMany(ProjectRole::class);
    }

    public function applications(): HasMany
    {
        return $this->hasMany(Application::class);
    }

    public function team()
    {
        return $this->applications()->where('status', 'accepted')->with('user');
    }
}
