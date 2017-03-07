<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * @var array
     */
    protected $casts = [
        'birthday' => 'date'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function groups()
    {
        return $this->belongsToMany(Group::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function memberships()
    {
        return $this->hasMany(Membership::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function payments()
    {
        return $this->hasManyThrough(Payment::class, Membership::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function notes()
    {
        return $this->hasMany(Note::class);
    }

    /**
     * @return bool
     */
    public function isCommittee()
    {
        return $this->whereHas('groups', function($query) {
            $query->where('name', 'Committee');
        })->exists();
    }

    /**
     * @return Carbon
     */
    public function joinedAt()
    {
        return $this->memberships()->orderBy('start')->first()->start;
    }

    /**
     * @return Carbon
     */
    public function expiresAt()
    {
        return $this->memberships()->orderBy('end', 'desc')->first()->end;
    }

    /**
     * @return bool
     */
    public function isExpired()
    {
        return $this->expiresAt() < Carbon::now();
    }
}
