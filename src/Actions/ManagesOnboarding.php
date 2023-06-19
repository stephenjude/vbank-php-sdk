<?php

namespace VBank\SDK\Actions;

use VBank\SDK\Enums\Method;

trait ManagesOnboarding
{
    public function onboard(
        string $username,
        string $walletName,
        string $shortName,
        string $webhookUrl,
        string $impelmentation = 'pool'
    ): array {
        return $this->send(
            method: Method::POST,
            uri: 'wallet2/onboarding',
            payload: [
                'username' => $username,
                'walletName' => $walletName,
                'webhookUrl' => $webhookUrl,
                'shortName' => $shortName,
                'implementation' => $impelmentation,
            ]
        );
    }
}
