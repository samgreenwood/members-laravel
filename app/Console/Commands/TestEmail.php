<?php

namespace App\Console\Commands;

use App\Mail\MemberExpired;
use App\Mail\MemberWelcome;
use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class TestEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'airstream:email:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send a test email';

    /**
     * Create a new command instance.
     *
     * @return void
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
        $user = User::where('username', 'dragoon')->first();

        Mail::to($user)->queue(new MemberWelcome($user, uniqid()));
    }
}
