@component('mail::message')
Hi {{$user->firstname}},

This email confirms that your membership has now been processed.

Please log onto the Air-Stream Members Administration Panel at
https://members.air-stream.org to view your account.

Use the following details for your initial logon:

username:   {{$user->username}}
password:   {{$temporaryPassword}}

Now would be a good time to set your password to something more
secure, and check your personal information for correctness and
completeness.

Once you have updated your password, you can use it to access all
Air-Stream services via the Internet or Wireless network, including
the http://www.air-stream.org website.

Please see the following pages for more important information:

Membership:       http://www.air-stream.org/membership
Email:            http://www.air-stream.org/technical-references/email
Wiki:             https://wiki.air-stream.org
Issue Tracker:    https://tracker.air-stream.org
IRC:              irc.air-stream.org:+7000
More information: https://wiki.air-stream.org/irc/.
Also available on the Web via https://webchat.air-stream.org
Member Discounts: http://www.air-stream.org/membership/member-discounts
FAQ's:            http://www.air-stream.org/faqs

There is also a great, constantly evolving resource for new members
on the Wiki here: https://wiki.air-stream.org/

Your Air-Stream email address is: sp0tteh@air-stream.org, this
address will be used for all Air-Stream related correspondence.
If you would prefer to have your Air-Stream correspondence directed
to a different email address, please log into the Members
Administration panel, click edit profile and enable the 'Forward
email' option.

If you have any problems or inquiries please contact the Air-Stream
Committee at committee@air-stream.org

Thanks,<br>
The Air-Stream Committee.
@endcomponent
