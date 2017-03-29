<?php

namespace App;

use Carbon\Carbon;
use Dyrynda\Database\Support\GeneratesUuid;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable, GeneratesUuid;

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
        'joined_at' => 'date',
        'expires_at' => 'date',
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
     *
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
     *
     * @return mixed
     */
    public function inGroup($name)
    {
        return $this->groups()->where('name', $name)->count();
    }

    /**
     * @return bool
     */
    public function isExpired()
    {
        return $this->expires_at < Carbon::now();
    }

    /**
     * @param $amount
     * @param $reference
     * @param Carbon|null $startDate
     *
     * @return Membership
     */
    public function renewMembership($amount, $reference)
    {
        $payment = Payment::create([
            'user_id' => $this->id,
            'type' => 'Credit Card',
            'amount' => $amount,
            'reference' => $reference,
            'date' => Carbon::now(),
        ]);

        $membership = Membership::create([
            'user_id' => $this->id,
            'payment_id' => $payment->id,
            'start' => $this->renewal_start_date,
            'end' => $this->renewal_start_date->copy()->addYear(),
        ]);

        $this->update([
            'expires_at' => $membership->end,
        ]);

        return $membership;
    }

    /**
     * @return mixed
     */
    public function getRenewalAmountAttribute()
    {
        $amount = $this->isExpired() ? config('membership.rate') : config('membership.discount_rate');

        return number_format($amount, 2);
    }

    /**
     * @return Carbon
     */
    public function getRenewalStartDateAttribute()
    {
        return $this->expires_at < Carbon::now() ? Carbon::now() : $this->expires_at;
    }

    /**
     * @param $value
     */
    public function setPasswordAttribute($value)
    {
        $encoded = crypt($value, null);
        $salt = substr($encoded, 0, 12);
        $cryptPassword = crypt($value, $salt);

        $this->attributes['password'] = bcrypt($value);
        $this->attributes['crypt_password'] = $cryptPassword;
    }
}
