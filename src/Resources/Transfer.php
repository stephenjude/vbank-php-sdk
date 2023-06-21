<?php

namespace VBank\SDK\Resources;

use VBank\SDK\Enums\Method;

class Transfer extends AbstractResource
{
    public string $sessionId;

    public string $txnId;

    public string $reference;

    public function verify(): Transaction
    {
        $response = $this->vbank->send(
            method: Method::GET,
            uri: 'wallet2/transactions',
            payload: ['reference' => $this->txnId]
        );

        return new Transaction($response);
    }
}
