<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lesson extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'program_id',
        'level_id',
        'name',
        'no_of_mcqs'
    ];


    public function program(){
        return $this->belongsTo(Program::class,'program_id','id');
    }

    public function level(){
        return $this->belongsTo(Level::class,'level_id','id');
    }
}
