<?php

namespace App;

use Illuminate\Support\Str;
use Parsedown;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['title', 'body'];
    //
    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function getUrlAttribute()
    {
        //Change the url from id to slug;
        //return route("question.show", $this->id);
        return route("question.show", $this->slug);
    }

    public function getStatusAttribute()
    {
        if ($this->answers > 0) {
            if ($this->best_answer_id)
                return "answer-accepted";

            return "answered";
        }
        return "unanswered";
    }

    public function getCreatedDateAttribute()
    {
        //display easly for human to read
        return $this->created_at->diffForHumans();
    }

    public function getBodyHtmlAttribute()
    {
        return Parsedown::instance()->text($this->body);
    }
}
