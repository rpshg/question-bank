<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Program extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
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
    

    public function levels(){
        return $this->hasMany(Level::class,'program_id');
    }

    public function lessons(){
        return $this->hasMany(Lesson::class,'program_id');
    }

    public function objective_questions(){
        return $this->hasMany(ObjectiveQuestion::class,'program_id');
    }

}
