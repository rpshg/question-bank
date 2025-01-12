<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ObjectiveQuestion extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'program_id',
        'level_id',
        'lesson_id',
        'name',
        'question',
        'correct_answer',
        'option_1',
        'option_2',
        'option_3',
        'option_4',
        'option_5',
        'option_6',
        'explanation',
        'status'
    ];

    public function program(){
        return $this->belongsTo(Program::class,'program_id','id');
    }

    public function level(){
        return $this->belongsTo(Level::class,'level_id','id');
    }

    public function lesson(){
        return $this->belongsTo(Lesson::class,'lesson_id','id');
    }
}
