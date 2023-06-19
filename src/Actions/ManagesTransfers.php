<?php

namespace VBank\SDK\Actions;

use VBank\SDK\Enums\Method;
use VBank\SDK\Resources\Beneficiary;
use VBank\SDK\Resources\CorporateAccount;
use VBank\SDK\Resources\Transfer;

trait ManagesTransfers
{
    public function initiateTransfer(
        CorporateAccount $corporateAccount,
        Beneficiary $beneficiary,
        int|float $amount,
        string $reference,
        string $narration = 'TRF',
    ): Transfer {
        $response = $this->send(
            method: Method::POST,
            uri: 'wallet2/transfer',
            payload: [
                "fromClientId" => $corporateAccount->clientId,
                "fromSavingsId" => $corporateAccount->accountId,
                "fromBvn" => null,
                "toClient" => $beneficiary->clientId,
                "toSavingsId" => $beneficiary->accountId(),
                "toSession" => $beneficiary->accountId(),
                "toBvn" => $beneficiary->bvn,
                "fromAccount" => $corporateAccount->companyAccountNumber(),
                "toAccount" => $beneficiary->accountNumber(),
                "toBank" => $beneficiary->bankCode,
                "signature" => hash('sha512', $corporateAccount->companyAccountNumber().$beneficiary->accountNumber()),
                "amount" => $amount,
                "remark" => $narration,
                "transferType" => $beneficiary->transferType,
                "reference" => $reference,
            ]
        );

        return new Transfer($response, $this);
    }
}
