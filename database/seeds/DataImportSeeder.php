<?php

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class DataImportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $groups = DB::connection('migration')->table('asm_group')->get();

        foreach($groups as $group) {
            \App\Group::create([
                'id' => $group->id,
                'name' => $group->name
            ]);
        }

        $members = DB::connection('migration')->table('asm_member')->get();

        foreach($members as $member) {
            \App\User::create([
                'id' => $member->id,
                'username' => $member->username,
                'password' => bcrypt('a1rs7r34m'),
                'nas_password' => $member->nas_password,
                'firstname' => $member->firstname ?? 'Unknown',
                'surname' => $member->lastname ?? 'Unknown',
                'postal_address_1' => $member->address1,
                'postal_address_2' => $member->address2,
                'postal_address_suburb' => $member->suburb,
                'postal_address_state' => $member->state,
                'postal_address_postcode' => $member->postcode,
                'postal_address_country' => 'Australia',
                'billing_address_1' => $member->address1,
                'billing_address_2' => $member->address2,
                'billing_address_suburb' => $member->suburb,
                'billing_address_state' => $member->state,
                'billing_address_country' => 'Australia',
                'billing_address_postcode' => $member->postcode,
                'phone' => $member->phone,
                'email' => $member->alt_email ?? 'unknown-'.$member->id,
                'forward_email' => $member->alt_fwd ?? false,
                'occupation' => $member->occupation,
                'birthday' => $member->dob,
                'affiliated_club' => $member->ham_club,
                'callsign' => $member->ham_callsign,
                'wia_member' => $member->wia ?? false,
                'referred_by' => $member->referred_by ?? '',
            ]);

            $payments = DB::connection('migration')->table('asm_payment')->where('member_id', $member->id)->get();
            $paymentMethods = DB::connection('migration')->table('asm_payment_map')->get();

            foreach($payments as $payment) {
                $start = Carbon::createFromFormat('Y-m-d h:i:s', $payment->payed_at);

                $paymentMethod = $paymentMethods->filter(function($method) use ($payment) {
                    return $payment->payment_method == $method->id;
                })->first()->payment_description;

                $dbPayment = \App\Payment::create([
                    'user_id' => $payment->member_id,
                    'type' => $paymentMethod,
                    'reference' => $payment->reference ?? 'Unknown',
                    'amount' => $payment->amount,
                    'date' => $start
                ]);

                $memberships = ($payment->amount / 45);

                for($i = 1; $i <= $memberships; $i++) {
                    \App\Membership::create([
                        'start' => $start,
                        'end' => $start->copy()->addYear(),
                        'user_id' => $payment->member_id,
                        'payment_id' => $dbPayment->id
                    ]);

                    $start->addYear();
                }
            }
        }

        $memberGroups = DB::connection('migration')->table('asm_group_map')->get();

        foreach($memberGroups as $memberGroup) {
            DB::table('group_user')->insert([
                'user_id' => $memberGroup->member_id,
                'group_id' => $memberGroup->group_id
            ]);
        }

        $notes = DB::connection('migration')->table('asm_note')->get();

        foreach($notes as $note)
        {
            \App\Note::create([
                'user_id' => $note->member_id,
                'recorded_by' => $note->author,
                'note' => $note->text,
                'created_at' => $note->created_at,
                'updated_at' => $note->updated_at,
            ]);
        }


    }
}