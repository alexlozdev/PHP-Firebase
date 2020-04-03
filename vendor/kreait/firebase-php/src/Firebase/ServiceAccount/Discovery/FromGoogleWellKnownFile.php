<?php

declare(strict_types=1);

namespace Kreait\Firebase\ServiceAccount\Discovery;

use Google\Auth\Credentials\ServiceAccountCredentials;
use Kreait\Firebase\Exception\ServiceAccountDiscoveryFailed;
use Kreait\Firebase\ServiceAccount;

/**
 * @internal
 */
class FromGoogleWellKnownFile
{
    /**
     * @internal
     */
    public function __construct()
    {
    }

    /**
     * @throws ServiceAccountDiscoveryFailed
     */
    public function __invoke(): ServiceAccount
    {
        $msg = \sprintf('%s: The well known file', static::class);

        if (!($credentials = @ServiceAccountCredentials::fromWellKnownFile())) {
            throw new ServiceAccountDiscoveryFailed($msg.' is not readable or invalid');
        }

        // @codeCoverageIgnoreStart
        // We can't really test this because of too many unknowns in the Google library
        return ServiceAccount::fromValue($credentials);
        // @codeCoverageIgnoreEnd
    }
}
