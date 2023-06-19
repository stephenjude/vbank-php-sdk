<?php

namespace VBank\SDK\Resources;

class Transaction extends AbstractResource
{

    public string $fromAccount;

    public string $fromClientId;

    public string $fromClient;

    public string $fromSavingsId;

    public string $fromBvn;

    public string $toClientId;

    public string $toClient;

    public string $toSavingsId;

    public string $toSession;

    public string $toBvn;

    public string $toAccount;

    public string $toBank;

    public string $signature;

    public string $amount;

    public string $remark;

    public string $transferType;

    public string $reference;

}
