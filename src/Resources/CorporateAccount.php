<?php

namespace VBank\SDK\Resources;

class CorporateAccount extends AbstractResource
{
    public string $accountNo;

    public string $accountBalance;

    public string $accountId;

    public string $client;

    public string $clientId;

    public string $savingsProductName;

    public function balance()
    {
        return (float)$this->accountBalance;
    }

    public function companyName()
    {
        return $this->client;
    }

    public function companyID()
    {
        return $this->clientId;
    }

    public function companyAccountNumber()
    {
        return $this->accountNo;
    }
    
    public function companyAccountID()
    {
        return $this->accountId;
    }
}
