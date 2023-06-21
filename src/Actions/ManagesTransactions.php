<?php

namespace VBank\SDK\Actions;

use VBank\SDK\Enums\Method;
use VBank\SDK\Resources\Transaction;

trait ManagesTransactions
{
    public function transactionDetails(string $transactionId): Transaction
    {
        $response = $this->send(
            method: Method::GET,
            uri: 'wallet2/transactions',
            payload: ['reference' => $transactionId]
        );

        return new Transaction($response, $this);
    }
}
