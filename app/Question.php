<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Parsedown;

class Question extends Model
{
    use VotableTrait;
    protected $fillable = ['title', 'body'];
    protected $appends = ['created_date', 'is_favorited', 'favorites_count', 'body_html'];
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
        if ($this->answers_count > 0) {
            if ($this->best_answer_id) {
                return "answer-accepted";
            }

            return "answered";
        }
        return "unanswered";
    }

    public function getCreatedDateAttribute()
    {
        //display easly for human to read
        return $this->created_at->diffForHumans();
    }

    public function setBodyAttribute($value)
    {
        $this->attributes['body'] = clean($value);
    }

    public function getBodyHtmlAttribute()
    {
        return clean(Parsedown::instance()->text($this->body));
    }

    public function answers()
    {
        return $this->hasMany(Answer::class)->orderBy('votes_count', 'DESC');
    }

    public function acceptBestAnswer(Answer $answer)
    {
        $this->best_answer_id = $answer->id;
        $this->save();
    }

    public function favorites()
    {
        return $this->belongsToMany(User::class, 'favorites', 'question_id', 'user_id')->withTimestamps();
    }

    public function getFavoritesCountAttribute()
    {
        return $this->favorites()->count();
    }

    public function isFavorited()
    {
        return $this->favorites()->where('user_id', auth()->id())->count() > 0;
    }

    public function GetIsFavoritedAttribute()
    {
        return $this->isFavorited();
    }

    public function GetFavoriteCountAttribute()
    {
        return $this->favorites->count();
    }

    public function GetExcerptAttribute()
    {
        return $this->Excerpt(300);
    }

    public function Excerpt($lenght)
    {
        return Str::limit(strip_tags($this->getBodyHtmlAttribute()), $lenght);
    }
}
