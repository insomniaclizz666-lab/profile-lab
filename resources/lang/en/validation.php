<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    | Baris pesan validasi default untuk bahasa Inggris.
    | Sesuaikan dengan kebutuhan atau tambahkan file lang/id/ untuk Bahasa Indonesia.
    */

    'accepted'             => 'The :attribute field must be accepted.',
    'accepted_if'          => 'The :attribute field must be accepted when :other is :value.',
    'active_url'           => 'The :attribute field must be a valid URL.',
    'after'                => 'The :attribute field must be a date after :date.',
    'after_or_equal'       => 'The :attribute field must be a date after or equal to :date.',
    'alpha'                => 'The :attribute field must only contain letters.',
    'alpha_dash'           => 'The :attribute field must only contain letters, numbers, dashes, and underscores.',
    'alpha_num'            => 'The :attribute field must only contain letters and numbers.',
    'array'                => 'The :attribute field must be an array.',
    'ascii'                => 'The :attribute field must only contain single-byte alphanumeric characters and symbols.',
    'before'               => 'The :attribute field must be a date before :date.',
    'before_or_equal'      => 'The :attribute field must be a date before or equal to :date.',
    'between'              => [
        'array'   => 'The :attribute field must have between :min and :max items.',
        'file'    => 'The :attribute field must be between :min and :max kilobytes.',
        'numeric' => 'The :attribute field must be between :min and :max.',
        'string'  => 'The :attribute field must be between :min and :max characters.',
    ],
    'boolean'              => 'The :attribute field must be true or false.',
    'confirmed'            => 'The :attribute field confirmation does not match.',
    'date'                 => 'The :attribute field must be a valid date.',
    'email'                => 'The :attribute field must be a valid email address.',
    'exists'               => 'The selected :attribute is invalid.',
    'required'             => 'The :attribute field is required.',
    'string'               => 'The :attribute field must be a string.',
    'unique'               => 'The :attribute has already been taken.',
    'max'                  => [
        'array'   => 'The :attribute field must not have more than :max items.',
        'file'    => 'The :attribute field must not be greater than :max kilobytes.',
        'numeric' => 'The :attribute field must not be greater than :max.',
        'string'  => 'The :attribute field must not be greater than :max characters.',
    ],
    'min'                  => [
        'array'   => 'The :attribute field must have at least :min items.',
        'file'    => 'The :attribute field must be at least :min kilobytes.',
        'numeric' => 'The :attribute field must be at least :min.',
        'string'  => 'The :attribute field must be at least :min characters.',
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    */
    'attributes' => [],

];
