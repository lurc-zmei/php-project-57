<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

#[Fillable(['name'])]
class TaskStatus extends Model
{
    use HasFactory;

    public function tasks()
    {
        return $this->hasMany(Task::class, 'status_id');
    }
}
