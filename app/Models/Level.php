<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Level extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'program_id',
        'name',
        'slug',
        'avatar',
        'description',
        'status',
        'order',
        'meta_keyword',
        'meta_title',
        'meta_description',
    ];


    public function program(){
        return $this->belongsTo(Program::class,'program_id','id');
    }

    public function lessons(){
        return $this->hasMany(Lesson::class,'level_id');
    }
}
