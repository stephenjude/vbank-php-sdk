# VBank Laravel SDK

[![Latest Version on Packagist](https://img.shields.io/packagist/v/vbanksdk/vbank-php-sdk.svg?style=flat-square)](https://packagist.org/packages/vbanksdk/vbank-php-sdk)
[![Tests](https://img.shields.io/github/actions/workflow/status/vbanksdk/vbank-php-sdk/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/vbanksdk/vbank-php-sdk/actions/workflows/run-tests.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/vbanksdk/vbank-php-sdk.svg?style=flat-square)](https://packagist.org/packages/vbanksdk/vbank-php-sdk)

Laravel PHP SDK to easily work with the VDF Microfinance Bank APIs.

## Support us

[<img src="https://github-ads.s3.eu-central-1.amazonaws.com/vbank-php-sdk.jpg?t=1" width="419px" />](https://spatie.be/github-ad-click/vbank-php-sdk)

We invest a lot of resources into creating [best in class open source packages](https://spatie.be/open-source). You can support us by [buying one of our paid products](https://spatie.be/open-source/support-us).

We highly appreciate you sending us a postcard from your hometown, mentioning which of our package(s) you are using. You'll find our address on [our contact page](https://spatie.be/about-us). We publish all received postcards on [our virtual postcard wall](https://spatie.be/open-source/postcards).

## Installation

You can install the package via composer:

```bash
composer require vbanksdk/vbank-php-sdk
```

## Usage

```php
$vdf = new VBank\SDK\VBank(ACCESSTOKEN, APIKEY, APISECRET);

$vdf->onboard(USERNAME, WALLETNAME, SHORTNAME, WEBHOOKURL,IMPLEMENTATION); // Returns array

// Get your coporate acount details
$vdf->corporateAccount(); // Returns instance of CorporateAccount  resource class

// Create fixed bank account with customer's full details
$vdf->createFixedAccount(firstname, lastname, middlename, dateOfBirth, address, gender, phone, bvn); // Returns instance of FixedAccount  resource class

// Create fixed bank account with customer's BVN and date of birth.
$vdf->createFixedAccountWithBVN(bvn, dateOfBirth); // Returns instance of FixedAccount  resource class

// Create fixed corporate bank account.
$vdf->createFixedCorporateAccount(rcNumber, companyName, incorporationDate, bvn); // Returns instance of FixedCorporateAccount  resource class

// Create virtual account with expiry time.
$vdf->createVirtualAccount(amount, reference, validityTimeout, merchantId, merchantName); // Returns instance of VirtualAccount  resource class

// Update valid amount for virtual account transaction.
$vdf->updateVirtualAccountTransactionAmount(amount, accountReference); // Returns instance of VirtualAccount  resource class

// List banks 
$vdf->bankList();

// Resolve bank account
$vdf->validateBankAccount(accountNumber, bankCode, TransferType::INTER); // Returns instance of Beneficiary resource class

// Intiate bank transfer
$vdf->initiateTransfer(corporateAccount, beneficiary, amount, reference, narration); // Returns instance of Transfer resource class

// Get transaction details 
$vdf->transactionDetails(transactionId): // Returns instance of Transaction resource class
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](https://github.com/spatie/.github/blob/main/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [stephenjude](https://github.com/stephenjude)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
