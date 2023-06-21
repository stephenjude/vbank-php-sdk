<?php

it('can test make onboard request', function () {
    Mockery::mock(\VBank\SDK\VBank::class)->shouldReceive('onboard');

    $key = \Illuminate\Support\Str::random();

    $vdf = new \VBank\SDK\VBank($key, $key, $key);

    $data = $vdf->onboard('Pay4MeUsername', 'Pay4MeWallet', 'P4M', 'https://wehbook.url');

    expect($data)->toBeArray();
});
