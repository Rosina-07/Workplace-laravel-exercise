<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certification extends Model
{
    use HasFactory;

    public $hidden = ['pivot', 'created_at', 'updated_at'];

    public function employees(): mixed
    {
        return $this->belongsToMany(Employee::class);
    }
}
