@component('mail::message')
# {{$user->firstname}} {{$user->surname}} has signed up online.

@if($user->referred_by)
They have been referred by {{$user->referred_by}}
@else
They have no referral.
@endif

@component('mail::button', ['url' => route('membership.application', $user->id)])
View Application
@endcomponent

@endcomponent
