@component('mail::message')
Hi {{$user->firstname}},

Sorry to see you go!

Unfortunately your Air-Stream membership has been lapsed for over 3 months.

Please be aware that some of the benefits you have received as an Air-Stream
member may now be unavailable. This includes but is not limited to:

* Access to the Air-Stream network and node database.
* Members discounts at several hardware vendors.
* Network services provided by other Air-Stream members.
* Your Air-Stream email account.

Of course we would still love to have you back! You can renew at any time by
following the instructions on our website or through our online portal.

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

Your commitment and involvement to date has been greatly appreciated and we'd
love to keep you involved in this great network of ours. Feel free to contact
us at any time.

Kind Regards,

The Air-Stream Committee
@endcomponent