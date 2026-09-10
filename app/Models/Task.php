<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'name',
        'description',
        'status_id',
        'created_by_id',
        'assigned_to_id'
    ];
}
