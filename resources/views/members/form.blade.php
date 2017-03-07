<div class="row">
    <div class="col-md-6">
        {!! Former::text('member[firstname]', 'First Name') !!}
        {!! Former::text('member[surname]', 'Surname') !!}
        {!! Former::text('member[username]', 'Username')->readonly(isset($readonly) ? in_array('username', $readonly) : false) !!}
        {!! Former::email('member[email]', 'Email') !!}
        {!! Former::date('member[birthday]', 'Birthday') !!}
    </div>
    <div class="col-md-6">
        {!! Former::select('member[wia_member]', 'WIA Member')->options(['No', 'Yes']) !!}
        {!! Former::select('member[affiliated_club]', 'Affiliated Club')->options([
            'None' => 'None',
            'EARC' => 'EARC'
        ]) !!}
        {!! Former::text('member[callsign]', 'Call Sign') !!}
        {!! Former::select('member[forward_email]', 'Forward Email')->options(['No', 'Yes']) !!}
        {!! Former::text('member[occupation]', 'Occupation') !!}
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