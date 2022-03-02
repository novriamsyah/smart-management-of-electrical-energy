<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ytbs1 extends Model
{
    use HasFactory;
    protected $table = 'ytbs1';
    protected $fillabel = ['tegangan', 'arus', 'dy_aktif', 'energi'];
}
