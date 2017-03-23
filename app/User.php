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
        'birthday' => 'date',
        'approved_at' => 'date',
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
     * @param $token
     * @return mixed
     */
    public static function findByApprovalToken($token)
    {
        return static::where('approval_token', $token)->firstOrFail();
    }

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
        return $this->hasMany(Membership::class)->orderBy('end', 'desc');
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
        return $this->hasMany(Note::class)->orderBy('created_at', 'desc');
    }

    /**
     * @return bool
     */
    public function isCommittee()
    {
        return $this->inGroup('Committee');
    }

    /**
     * @return mixed
     */
    public function isNetworkTeam()
    {
        return $this->inGroup('Net Admins');
    }

    /**
     * @param $name
     * @return mixed
     */
    public function inGroup($name)
    {
        return $this->groups()->where('name', $name)->count();
    }

    /**
     * @return Carbon
     */
    public function joinedAt()
    {
        $membership = $this->memberships()->orderBy('start')->first();
        return $membership ? $membership->start : Carbon::now();
    }

    /**
     * @return Carbon
     */
    public function expiresAt()
    {
        $membership = $this->memberships()->orderBy('end', 'desc')->first();
        return $membership ? $membership->end : Carbon::now();
    }

    /**
     * @return bool
     */
    public function isExpired()
    {
        return $this->expiresAt() < Carbon::now();
    }
}
