@component('mail::message')
Hi {{$user->firstname}},

Just a friendly reminder to let you know that your Air-Stream Membership
is due to expire soon, on {{$user->expires_at}}.

As a valued member of our organisation we would like to offer you a 10%
discount off the normal membership fee, if you renew before this date!

You can renew for this reduced price of $45 at any time before the above date,
simply follow the instructions on our website or through our online portal.

@component('mail::button', ['url' => route('membership.renew.index')])
    Renew Membership
@endcomponent

Our members thank you for your support, and hope you can continue to make a
contribution and join in the development of our fantastic network!

Kind Regards,

The Air-Stream Committee
@endcomponent