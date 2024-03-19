<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    public $hidden = ['contract_id', 'created_at', 'updated_at', 'pivot'];

    public function contract()
    {
        return $this->belongsTo(Contract::class);
    }

    public function certifications(): mixed
    {
        return $this->belongsToMany(Certification::class);
    }
}
