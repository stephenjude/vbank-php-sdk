<?php

namespace VBank\SDK\Actions;

use VBank\SDK\Enums\Method;
use VBank\SDK\Resources\CorporateAccount;
use VBank\SDK\Resources\FixedAccount;
use VBank\SDK\Resources\FixedCorporateAccount;

trait ManagesAccount
{
    public function corporateAccount(): CorporateAccount
    {
        $response = $this->send(
            method: Method::GET,
            uri: 'wallet2/account/enquiry',
        );

        return new CorporateAccount($response, $this);
    }

    public function createFixedAccount(
        string $firstname,
        string $lastname,
        ?string $middlename,
        string $dateOfBirth,
        ?string $address,
        ?string $gender,
        string $phone,
        string $bvn,
    ): FixedAccount {
        $response = $this->send(
            method: Method::POST,
            uri: 'wallet2/client/create',
            payload: array_filter([
                'firstname' => $firstname,
                'lastname' => $lastname,
                'middlename' => $middlename,
                'dob' => $dateOfBirth,
                'address' => $address,
                'gender' => $gender,
                'phone' => $phone,
                'bvn' => $bvn,
            ])
        );

        return new FixedAccount($response);
    }

    public function createFixedAccountWithBVN(string $bvn, string $dateOfBirth): FixedAccount
    {
        $response = $this->send(
            method: Method::POST,
            uri: 'wallet2/client/create',
            payload: [
                'bvn' => $bvn,
                'dateOfBirth' => $dateOfBirth,
            ]
        );

        return new FixedAccount($response);
    }

    public function createFixedCorporateAccount(
        string $rcNumber,
        string $companyName,
        string $incorporationDate,
        ?string $bvn
    ): FixedCorporateAccount {
        $response = $this->send(
            method: Method::POST,
            uri: 'wallet2/corporateclient/create',
            payload: array_filter([
                'rcNumber' => $rcNumber,
                'companyName' => $companyName,
                'incorporationDate' => $incorporationDate,
                'bvn' => $bvn,
            ])
        );

        return new FixedCorporateAccount($response, $this);
    }
}
