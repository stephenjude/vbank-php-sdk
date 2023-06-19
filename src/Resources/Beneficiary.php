<?php

namespace VBank\SDK\Resources;

class Beneficiary extends AbstractResource
{
    public string $name;

    public string $clientId;

    public string $bvn;

    public string $status;

    public string $currency;

    public string $bank;

    public string $bankCode;

    public string $transferType;

    public array $account;

    public function accountNumber()
    {
        return $this->account['number'];
    }

    public function accountName()
    {
        return $this->name;
    }

    public function accountId()
    {
        return $this->account['id'];
    }

    public function bankName()
    {
        return $this->bank;
    }
}
