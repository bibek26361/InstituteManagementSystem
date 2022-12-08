<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Noticeboard extends Model
{
    protected $fillable = [
        'title', 'description', 'attachement', 'start', 'end', 'priority', 'status'

    ];
}
