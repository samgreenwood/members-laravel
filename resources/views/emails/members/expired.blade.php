@component('mail::message')
Hi {{$user->firstname}},

Just a friendly reminder to let you know that your Air-Stream Membership has
now lapsed. Membership is still just $50 a year, and you can renew at any time
by following the instructions on our website or by accessing our online portal.

@component('mail::button', ['url' => route('membership.renew.index')])
    Renew Membership
@endcomponent

Remember that Air-Stream is a not-for-profit community group whose members
are individuals committed to the growth of a community owned and operated
broadband network. The Air-stream network is the largest in Australia of it's
kind, and we are continually growing and exploring the latest technologies.

Everything we have achieved has been made possible by members who volunteer
their own time, skills and equipment in order to get fellow members connected
and to generate interesting content for the community. We need your support
to ensure we can continue doing this long into the future!

As described in Section 5.2 of the Air-Stream Wireless Inc. constitution,
our administrative system allows you a 3 month grace period in which to renew,
after which you will forfeit your privileges as a member of the organisation.

Please be aware that some of the benefits you receive as an Air-Stream member
may not be available to you after this three month period. This includes but
is not limited to:

* Access to the Air-Stream network and node database.
* Members discounts at several hardware vendors.
* Network services provided by other Air-Stream members.
* Your Air-Stream email account.

Our members thank you for your support, and hope you can continue to make a
contribution and join in the development of our fantastic network!

Kind Regards,

The Air-Stream Committee
@endcomponent