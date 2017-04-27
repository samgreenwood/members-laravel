<?php

namespace App\Console\Commands;

use App\User;
use App\Mail\MemberExpired;
use App\Mail\MemberExpiredMonthAgo;
use App\Mail\MemberExpiresInOneMonth;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendExpiredReminderEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'airstream:email:expired';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send expiration emails';

    /**
     * Create a new command instance
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        User::expiringInMonths(1)->get()->each(function(User $user) {
            Mail::to($user)->queue(new MemberExpiresInOneMonth($user));
        });

        User::expiredToday()->get()->each(function(User $user) {
            Mail::to($user)->queue(new MemberExpired($user));
        });

        User::expiredMonthsAgo(1)->get()->each(function(User $user) {
            Mail::to($user)->queue(new MemberExpiredMonthAgo($user, 1));
        });

        User::expiredMonthsAgo(2)->get()->each(function(User $user) {
            Mail::to($user)->queue(new MemberExpiredMonthAgo($user, 2));
        });

        User::expiredMonthsAgo(3)->get()->each(function(User $user) {
            Mail::to($user)->queue(new MemberExpiredMonthAgo($user, 3));
        });
    }
}
