<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'patients';
    public $timestamps = true;


    public function treatments()
    {
        return $this->hasMany(Treatment::class, 'id_patient', 'id');
    }

}
