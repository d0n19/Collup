<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $fillable = ['project_id', 'user_id', 'project_role_id', 'message', 'experience_links', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function role()
    {
        return $this->belongsTo(ProjectRole::class, 'project_role_id');
    }
}
