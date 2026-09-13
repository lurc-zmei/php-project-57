<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['name', 'description'])]
class Label extends Model
{
    public function tasks()
    {
        return $this->belongsToMany(Task::class);
    }
}
