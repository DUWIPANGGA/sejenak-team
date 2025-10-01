<?php

namespace App\Models;

use App\Models\UserSession;
use Illuminate\Support\Facades\Cache;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
        'avatar',
        'bio',
        'role_id',
        'tokens_balance',
        'two_factor_recovery_codes',
        'two_factor_secret',
        'is_suspended',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Relationships
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function proposals()
    {
        return $this->hasMany(Proposal::class);
    }

    public function sessions()
    {
        return $this->hasMany(Session::class, 'user_id');
    }

    public function counselorSessions()
    {
        return $this->hasMany(Session::class, 'konselor_id');
    }

    public function messages()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function moods()
    {
        return $this->hasMany(Mood::class);
    }

    public function journals()
    {
        return $this->hasMany(Journal::class);
    }

    public function challenges()
    {
        return $this->belongsToMany(Challenge::class, 'challenge_user')
                    ->withPivot('status')
                    ->withTimestamps();
    }

    public function circles()
    {
        return $this->belongsToMany(Circle::class, 'circle_user')
                    ->withPivot('role')
                    ->withTimestamps();
    }

    public function exercises()
    {
        return $this->belongsToMany(Exercise::class, 'exercise_user')
                    ->withPivot('status')
                    ->withTimestamps();
    }
    public function isOnline()
    {
        return Cache::has('user-is-online-' . $this->id);
    }
    public function getAvatar()
    {
        return $this->avatar ? asset('storage/' . $this->avatar) : asset('images/user-avatar.png');
    }
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
    public function getJWTSession()
    {
        return $this->hasMany(UserSession::class);
    }
}