<?php

declare(strict_types=1);

namespace Mezzio\Helper\BodyParams;

use Psr\Http\Message\ServerRequestInterface;

/**
 * Interface defining a body parameter strategy.
 */
interface StrategyInterface
{
    /**
     * Match the content type to the strategy criteria.
     *
     * @return bool Whether or not the strategy matches.
     * @param string $contentType
     */
    public function match($contentType): bool;

    /**
     * Parse the body content and return a new request.
     * @param \Psr\Http\Message\ServerRequestInterface $request
     */
    public function parse($request): ServerRequestInterface;
}
