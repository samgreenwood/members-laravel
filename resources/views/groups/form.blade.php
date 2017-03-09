{!! Former::text('name') !!}
{!! Former::select('users[]', 'Users')->multiple()->options($users)->value(isset($selected) ? $selected : [])->addClass('select2') !!}