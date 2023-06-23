<?php

namespace VBank\SDK;

use Exception;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use VBank\SDK\Actions\ManagesAccount;
use VBank\SDK\Actions\ManagesBanks;
use VBank\SDK\Actions\ManagesOnboarding;
use VBank\SDK\Actions\ManagesTransactions;
use VBank\SDK\Actions\ManagesTransfers;
use VBank\SDK\Actions\ManagesVirtualAccount;
use VBank\SDK\Enums\Method;
use VBank\SDK\Exceptions\BadRequestException;
use VBank\SDK\Exceptions\NotFoundException;

class VBank
{
    use ManagesAccount;
    use ManagesBanks;
    use ManagesOnboarding;
    use ManagesVirtualAccount;
    use ManagesTransfers;
    use ManagesTransactions;

    protected PendingRequest $request;

    public function __construct(
        protected string $accessToken,
        protected ?string $apiKey = null,
        protected ?string $apiSecret = null,
        protected string $baseUrl = 'https://api-devapps.vfdbank.systems/vtech-wallet/api/v1'
    ) {
        $this->request = Http::acceptJson()
            ->baseUrl($this->baseUrl)
            ->withToken($this->accessToken)
            ->contentType('application/json');
    }

    public function send(Method $method, string $uri, $payload = []): array
    {
        $payload['wallet-credentials'] = $this->walletToken();

        $queryString = '?wallet-credentials='.$this->walletToken();

        $response = match ($method) {
            Method::POST => $this->request->post($uri.$queryString, $payload),
            default => $this->request->get($uri, $payload)
        };

        if ($response->ok()) {
            return $response->json('data') ?? $response->json();
        }

        $this->handleRequestError($response);
    }

    protected function walletToken(): string
    {
        return base64_encode("$this->apiKey:$this->apiSecret");
    }

    /**
     * Transform the items of the collection to the given class.
     */
    protected function transformCollection(array $collection, string $class, array $extraData = []): array
    {
        return array_map(function ($data) use ($class, $extraData) {
            return new $class($data + $extraData, $this);
        }, $collection);
    }

    /**
     * Handle the request error.
     *
     * @throws Exception
     * @throws \VBank\SDK\Exceptions\FailedActionException
     * @throws \VBank\SDK\Exceptions\NotFoundException
     */
    protected function handleRequestError(Response $response): void
    {
        $message = $response->json('message') ?? $response->reason();

        if ($response->status() === 404) {
            throw new NotFoundException($message ?? 'The resource you are looking for could not be found.');
        }

        if ($response->status() === 400) {
            throw new BadRequestException($message);
        }

        throw new Exception($message);
    }
}
