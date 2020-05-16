<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{

    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function Question()
    {
        return $this->belongsTo(Question::class);
    }

    public function getBodyHtmlAttribute()
    {
        return Parsedown::instance()->text($this->body);
    }

    public static function boot()
    {
        parent::boot();
        static::created(function ($answer) {
            $answer->Question->increment('answers_count');
        });
        static::deleted(function ($answer) {
            $answer->Question->decrement('answers_count');
        });
        /* static::saved(function ($answer) {
            $answer->Question->increment('answers_count');
        }); */
    }
}
