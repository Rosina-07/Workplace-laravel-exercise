<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;

    public $hidden = ['id', 'updated_at', 'created_at'];

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
}
