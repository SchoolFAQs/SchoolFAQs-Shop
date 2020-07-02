<?php

return [

    /*
     * Developer email used in registering account on MTN Developer Website
     */
    'email' => env('MOMO_EMAIL'),

    /*
     * Default Price to all the Site Transactions
     */
    'default_price' => env('MOMO_DEFAULT_PRICE', 100),

    /*
     * To include the Momo\Support\MomoTransaction trait to your model that creates relationship between your model and Momo\Model\Transaction Model.
     * Here you specify the foreign_key as it is found on your model migration.
     */
    'foreign_key' => 'momo_transaction_id',
];
