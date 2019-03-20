<?php

declare(strict_types=1);

namespace Koempf\PixiClient\Client;

use Koempf\PixiClient\Response\Exceptions\ErrorResponseException;

class SoapClient
{
    /** @var \SoapClient */
    private $soapClient;

    public function __construct(string $login, string $password, string $uri)
    {
        $this->soapClient = new \SoapClient(
            null,
            [
                'login' => $login,
                'password' => $password,
                'uri' => $uri,
                'location' => $uri,
            ]
        );
    }

    public function getResponse(string $method, array $arguments = [])
    {
        $soapArguments = [];
        foreach ($arguments as $key => $value) {
            if ($value === null) {
                continue;
            }
            $soapArguments[] = new \SoapVar($value, null, '', '', $key);
        }

        return $this->soapClient->__call($method, $soapArguments);
    }

    public function getResultsWithPagination(
        string $method,
        array $arguments = [],
        ?int $pageSize = null,
        ?string $limitKey = null,
        ?string $offsetKey = null
    ): array {
        $limitKey = $limitKey ?? 'Rowcount';
        $offsetKey = $offsetKey ?? 'Start';

        $pageSize = $pageSize ?? 200;
        $limit = $arguments[$limitKey] ?? null;
        $offset = $arguments[$offsetKey] ?? 0;

        $results = [];
        while (true) {
            if ($limit > 0 && $limit < $pageSize) {
                $pageSize = $limit;
            }

            $pageArguments = [
                    $limitKey => $pageSize,
                    $offsetKey => $offset,
                ] + $arguments;

            $pageResults = $this->getResults($method, $pageArguments);

            if (empty($pageResults)) {
                break;
            }
            $results = array_merge($results, $pageResults);

            if ($limit > 0) {
                $limit = $limit - $pageSize;

                if ($limit <= 0) {
                    break;
                }
            }

            $offset += $pageSize;
        }

        return $results;
    }

    public function getResults(string $method, array $arguments = []): array
    {
        $result = $this->getResponse($method, $arguments);
        $rows = $result->SqlRowSet->diffgram->SqlRowSet1->row ?? [];

        if (is_object($rows) && !empty($rows->ReturnCode) && !empty($rows->ErrorMessage)) {
            throw new ErrorResponseException(
                sprintf('[%s] %s', $rows->ReturnCode, $rows->ErrorMessage)
            );
        }

        if (is_object($rows)) {
            $rows = [$rows];
        }

        return $rows;
    }

    public function getResult(string $method, array $arguments = []): ?\stdClass
    {
        return array_slice($this->getResults($method, $arguments), 0, 1)[0] ?? null;
    }
}
