<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

class GotenbergService
{
    public function __construct(protected HttpClientInterface $client)
    {
    }

    public function convert(string $url): ResponseInterface
    {
        $response = $this->client->request(
            'POST',
            'http://localhost:3000/forms/chromium/convert/url',
            [
                'headers' => [
                    'Content-Type' => 'multipart/form-data',
                ],
                'body' => [
                    'url' => $url,
                ]
            ]
        );

        if ($response->getStatusCode() !== 200) {
            throw new \Exception('Failed to generate PDF from URL.');
        }

        return $response;
    }
}
