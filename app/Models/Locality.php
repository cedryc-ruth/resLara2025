<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Locality extends Model
{
    use HasFactory;

    protected $fillable = [
        'postalCode',
        'locality',
    ];

    protected $table = 'localities';

    protected $primaryKey = 'postal_code';

    public $timestamps = false;
}
