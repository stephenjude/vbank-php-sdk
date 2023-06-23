<?php

namespace VBank\SDK\Resources;

class Transaction extends AbstractResource
{
    public string $TxnId;

    public string $amount;

    public string $accountNo;

    public string $fromAccountNo;

    public string $transactionStatus;

    public string $transactionDate;

    public string $toBank;

    public string $fromBank;

    public string $sessionId;

    public string $bankTransactionId;

    public string $transactionType;

    public function reference(): string
    {
        return $this->TxnId;
    }
    public function status(): string
    {
        return $this->transactionStatus === '00' ? 'successful' : 'failed';
    }
}
