<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;

    protected $fillable = [
        'bank_code',
        'bank_code_branch',
        'bank_name',
        'bank_sdiv_code',
        'bank_sdiv_name',
        'bank_div_code',
        'bank_div_name',
        'circle',
    ];

}
