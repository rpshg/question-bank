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
