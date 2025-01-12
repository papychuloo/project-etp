<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LearnedQuestion extends Model
{
    use HasFactory;

    protected $fillable = ['question', 'answer', 'created_by'];
}
