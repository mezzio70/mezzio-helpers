<?php

declare(strict_types=1);

namespace Mezzio\Helper\BodyParams;

use Psr\Http\Message\ServerRequestInterface;

use function parse_str;
use function preg_match;

class FormUrlEncodedStrategy implements StrategyInterface
{
    /**
     * @param string $contentType
     */
    public function match($contentType): bool
    {
        return 1 === preg_match('#^application/x-www-form-urlencoded($|[ ;])#', $contentType);
    }

    /**
     * @param \Psr\Http\Message\ServerRequestInterface $request
     */
    public function parse($request): ServerRequestInterface
    {
        $parsedBody = $request->getParsedBody();

        if (! empty($parsedBody)) {
            return $request;
        }

        $rawBody = (string) $request->getBody();

        if (empty($rawBody)) {
            return $request;
        }

        parse_str($rawBody, $parsedBody);

        return $request->withParsedBody($parsedBody);
    }
}
