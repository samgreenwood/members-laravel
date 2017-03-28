@component('mail::message')
# Your Air-Stream Wireless Membership has been approved!

Hi {{$user->firstname}} {{$user->surname}},

This email is letting you know that your Air-Stream Membership has been approved.

Once payment has been recieved your membership will become active and you will be sent login credentials.

@component('mail::button', ['url' => route('members.payment')])
Pay Membership
@endcomponent

Thanks,
The Air-Stream Committee
@endcomponent
