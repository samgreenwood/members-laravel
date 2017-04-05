<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $groups = [
            'Members',
            'Committee',
            'Network',
            'LCC'
        ];

        foreach($groups as $group) {
            \App\Group::create(['name' => $group]);
        }

        $user = \App\User::create([
            'firstname' => 'Sam',
            'surname' => 'Greenwood',
            'username' => 'dragoon',
            'password' => 'password',
            'email' => 'sam@samgreenwood.me',
            'birthday' => \Carbon\Carbon::createFromFormat('Y-m-d', '1990-10-30')
        ]);

        $payment = \App\Payment::create([
            'reference' => 'abc123',
            'date' => \Carbon\Carbon::now(),
            'type' => 'PayPal',
            'user_id' => $user->id,
            'amount' => 50,
        ]);

        $membership = \App\Membership::create([
            'start' => \Carbon\Carbon::now(),
            'end' => \Carbon\Carbon::now()->addYear(),
            'payment_id' => $payment->id,
            'user_id' => $user->id,
        ]);

        $user->groups()->sync([1,2]);
    }
}
