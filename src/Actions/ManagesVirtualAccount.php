<?php

namespace VBank\SDK\Actions;

use VBank\SDK\Enums\Method;
use VBank\SDK\Resources\VirtualAccount;

trait ManagesVirtualAccount
{
    public function createVirtualAccount(
        int|float $amount,
        string $reference,
        int $validityTimeout,
        string $merchantId,
        string $merchantName,
    ): VirtualAccount {
        $response = $this->send(
            method: Method::POST,
            uri: 'wallet2/virtualaccount',
            payload: [
                'merchantName' => $merchantName,
                'merchantId' => $merchantId,
                'amount' => $amount,
                'reference' => $reference,
                'validityTime' => $validityTimeout,
            ]
        );

        $response ['amount'] = $amount;

        return new VirtualAccount(
            attributes: $response,
            vbank: $this,
        );
    }

    public function updateVirtualAccountTransactionAmount(int|float $amount, $accountReference): self
    {
        return $this->send(
            method: Method::POST,
            uri: 'wallet2/virtualaccount/amountupdate',
            payload: [
                "amount" => $amount,
                "reference" => $accountReference,
            ]
        );
    }
}
