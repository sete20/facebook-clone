<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Scopes\reverseScope;

class post extends Model
{
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new reverseScope());
    }
    // to disable mass assignment
    protected $guarded = [];
    // protected $fillable = ['body','user_id'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function likes()
    {
        return $this->belongsToMany(User::class, 'likes', 'post_id', 'user_id');
    }
}
