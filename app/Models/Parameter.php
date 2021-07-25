<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parameter extends Model
{
    use HasFactory;

    protected $table = 'parameter';

    protected $fillable = [
        'param_one',
        'param_two',
        'param_three',
        'param_four',
        'param_five',
        'shortdesc',
        'description',
    ];

}
