<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Feedetail extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'feetdetails';
    protected $fillable = [
        'date', 'received_from', 'received_amount', 'description', 'mode', 'remark',
    ];
}
