<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $casts = [
        'options' => 'array', // Pastikan ini ada
    ];

    public function form()
    {
        return $this->belongsTo(Form::class);
    }

    public function responses()
    {
        return $this->hasMany(Response::class);
    }
}
