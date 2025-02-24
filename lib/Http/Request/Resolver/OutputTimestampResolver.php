<?php
declare(strict_types=1);

/**
 * Pimcore
 *
 * This source file is available under two different licenses:
 * - GNU General Public License version 3 (GPLv3)
 * - Pimcore Commercial License (PCL)
 * Full copyright and license information is available in
 * LICENSE.md which is distributed with this source code.
 *
 *  @copyright  Copyright (c) Pimcore GmbH (http://www.pimcore.org)
 *  @license    http://www.pimcore.org/license     GPLv3 and PCL
 */

namespace Pimcore\Http\Request\Resolver;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * @internal
 *
 * Gets/sets the timestamp for which output should be delivered. Default is current timestamp, but timestamp
 * might be set to a date in future for preview purposes
 */
class OutputTimestampResolver extends AbstractRequestResolver
{
    const ATTRIBUTE_PIMCORE_OUTPUT_TIMESTAMP = '_pimcore_output_timestamp';

    protected bool $timestampWasQueried = false;

    public function __construct(RequestStack $requestStack)
    {
        parent::__construct($requestStack);
    }

    /**
     * Gets timestamp for with the output should be rendered to
     *
     * @return int
     */
    public function getOutputTimestamp(): int
    {
        $request = $this->getMainRequest();
        $timestamp = $request->attributes->get(self::ATTRIBUTE_PIMCORE_OUTPUT_TIMESTAMP);

        if (!$timestamp) {
            $timestamp = time();
            $this->setOutputTimestamp($timestamp);
        }

        //flag to store if timestamp was queried during request
        $this->timestampWasQueried = true;

        return $timestamp;
    }

    /**
     * Sets output timestamp to given value
     *
     * @param int $timestamp
     */
    public function setOutputTimestamp(int $timestamp)
    {
        $this->getMainRequest()->attributes->set(self::ATTRIBUTE_PIMCORE_OUTPUT_TIMESTAMP, $timestamp);
    }

    /**
     * Returns if timestamp was queried during request at least once
     *
     * @return bool
     */
    public function timestampWasQueried(): bool
    {
        return $this->timestampWasQueried;
    }
}
