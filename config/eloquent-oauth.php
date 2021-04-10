<?php

use App\User;

return [
    'model' => User::class,
    'table' => 'oauth_identities',
    'providers' => [
        'google' => [
            'client_id' => '1020117808921-2fb75dqk9c6apknpf44futp1cv0p71ev.apps.googleusercontent.com',
            'client_secret' => 'XXW5xjR1DwqOvdn9dAJU5ZnG',
            'redirect_uri' => 'http://mattskelton.ca/handle-authentication-response',
            'scope' => [],
        ]
    ],
];
