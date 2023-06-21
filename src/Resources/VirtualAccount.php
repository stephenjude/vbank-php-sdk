<?php

namespace VBank\SDK\Resources;

use VBank\SDK\Enums\Method;

class VirtualAccount extends AbstractResource
{
    public string $accountNumber;

    public string $reference;

    public string $amount;

    public function updateTransactionAmount(int|float $amount): self
    {
        $response = $this->vbank->send(
            method: Method::POST,
            uri: 'wallet2/virtualaccount/amountupdate',
            payload: [
                'amount' => $amount,
                'reference' => $this->reference,
            ]
        );

        return $this;
    }
}
