<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    protected static function boot()
    {
        parent::boot();

        static::creating(function($reply) {
            $reply->user_id = auth()->id();
        });
    }

    protected $fillable = [
        'body',
        'question_id',
        'user_id'
    ];


    /**
     * @param Carbon $value
     * @return string
     */
    public function getCreatedAttribute(Carbon $value)
    {
        return $value->diffForHumans();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function like()
    {
        return $this->hasMany(Like::class);
    }
}
