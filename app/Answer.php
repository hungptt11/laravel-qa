<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Parsedown;

class Answer extends Model
{
    protected $fillable = ['body', 'user_id'];
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

    public function getCreatedDateAttribute()
    {
        //display easly for human to read
        return $this->created_at->diffForHumans();
    }

    public function getStatusAttribute()
    {
        //display easly for human to read
        return $this->id === $this->Question->best_answer_id ? 'vote-accepted' : '';
    }

    public function getIsBestAttribute()
    {
        return $this->id === $this->Question->best_answer_id;
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
