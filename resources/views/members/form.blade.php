<div class="row">
    <div class="col-md-6">
        {!! Former::text('member[firstname]', 'First Name')->readonly(isset($readonly) ? in_array('firstname', $readonly) : false) !!}
        {!! Former::text('member[surname]', 'Surname')->readonly(isset($readonly) ? in_array('surname', $readonly) : false) !!}
        {!! Former::text('member[username]', 'Username')->readonly(isset($readonly) ? in_array('username', $readonly) : false) !!}
        @if(isset($registrationForm) && $registrationForm)
            {!! Former::password('member[password]', 'Password') !!}
            {!! Former::password('member[password_confirmation]', 'Confirm Password') !!}
        @endif
        {!! Former::email('member[email]', 'Email') !!}
        {!! Former::date('member[birthday]', 'Birthday') !!}
        {!! Former::text('member[mobile]', 'Mobile') !!}
    </div>
    <div class="col-md-6">
        {!! Former::select('member[wia_member]', 'WIA Member')->options(['No', 'Yes']) !!}
        {!! Former::select('member[affiliated_club]', 'Affiliated Club')->options([
            'None' => 'None',
            'EARC' => 'EARC'
        ]) !!}
        {!! Former::text('member[callsign]', 'Call Sign') !!}
        {!! Former::text('member[occupation]', 'Occupation') !!}
        {!! Former::text('member[referred_by]', 'Referred By')->readonly(isset($readonly) ? in_array('referred_by', $readonly) : false) !!}
        {!! Former::text('member[phone]', 'Phone') !!}
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <h4>Postal Address</h4>
        {!! Former::text('member[postal_address_1]', 'Address 1') !!}
        {!! Former::text('member[postal_address_2]', 'Address 2') !!}
        {!! Former::text('member[postal_address_suburb]', 'Suburb') !!}
        {!! Former::text('member[postal_address_postcode]', 'Postcode') !!}
        {!! Former::text('member[postal_address_state]', 'State') !!}
        {!! Former::text('member[postal_address_country]', 'Country')->value('Australia') !!}
    </div>
    <div class="col-md-6">
        <h4>Billing Address</h4>
        {!! Former::text('member[billing_address_1]', 'Address 1') !!}
        {!! Former::text('member[billing_address_2]', 'Address 2') !!}
        {!! Former::text('member[billing_address_suburb]', 'Suburb') !!}
        {!! Former::text('member[billing_address_postcode]', 'Postcode') !!}
        {!! Former::text('member[billing_address_state]', 'State') !!}
        {!! Former::text('member[billing_address_country]', 'Country')->value('Australia') !!}
    </div>
</div>