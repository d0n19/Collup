<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectRole extends Model
{
    protected $fillable = ['name', 'required_count', 'project_id'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}