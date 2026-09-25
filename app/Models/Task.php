<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

#[Fillable([
    'name',
    'description',
    'status_id',
    'created_by_id',
    'assigned_to_id'
])]
class Task extends Model
{
    use HasFactory;

    public function status()
    {
        return $this->belongsTo(TaskStatus::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }

    public function assignedTo()
    {
        return $this->belongsTo(User::class, 'assigned_to_id')->withDefault(['name' => '',]);
    }

    public function labels()
    {
        return $this->belongsToMany(Label::class);
    }
}
