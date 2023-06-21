<?php

namespace VBank\SDK\Actions;

use VBank\SDK\Enums\Method;
use VBank\SDK\Enums\TransferType;
use VBank\SDK\Resources\Bank;
use VBank\SDK\Resources\Beneficiary;

trait ManagesBanks
{
    public function bankList(): array
    {
        $response = $this->send(
            method: Method::GET,
            uri: 'wallet2/bank'
        );

        return $this->transformCollection($response['bank'], Bank::class);
    }

    public function validateBankAccount(
        string $accountNumber,
        string $bankCode,
        TransferType $type = TransferType::INTER
    ): Beneficiary {
        $response = $this->send(
            method: Method::GET,
            uri: 'wallet2/transfer/recipient',
            payload: [
                'accountNo' => $accountNumber,
                'bank' => $bankCode,
                'transfer_type' => $type->value,
            ]
        );

        $response['bankCode'] = $bankCode;

        $response['transferType'] = $type->value;

        return new Beneficiary($response, $this);
    }

    public function bvnEnquiry(string $bvn): CustomerBVN
    {
        $response = $this->send(
            method: Method::GET,
            uri: 'wallet2/transfer/recipient',
            payload: [
                'accountNo' => $accountNumber,
                'bank' => $bankCode,
                'transfer_type' => $type->value,
            ]
        );

        $response['bankCode'] = $bankCode;

        $response['transferType'] = $type->value;

        return new Beneficiary($response, $this);
    }
}
