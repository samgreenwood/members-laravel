<div class="row">
    <div class="col-md-6">
        <h4>Payment Information</h4>
        {!! Former::select('payment[type]', 'Method')->options([
            'PayPal' => 'PayPal',
            'Direct Deposit' => 'Direct Deposit',
            'Credit Card' => 'Credit Card',
            'Cash' => 'Cash'
        ]) !!}
        {!! Former::text('payment[reference]', 'Reference') !!}
        {!! Former::number('payment[amount]', 'Amount')->step(0.1)->value(50)->prepend('$') !!}
        {!! Former::date('payment[date]', 'Payment Date')->value(date('Y-m-d')) !!}
    </div>
    <div class="col-md-6">
        <h4>Membership Duration</h4>
        {!! Former::date('membership[start]', 'Start Date')->value(date('Y-m-d')) !!}
        {!! Former::select('membership[duration]', 'Duration')->options(['1 Year']) !!}
    </div>
</div>
