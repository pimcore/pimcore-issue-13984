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

namespace Pimcore\Event\Ecommerce;

final class AdminEvents
{
    /**
     * Fired when values in filter definition get fetched
     *
     * @Event("Symfony\Component\EventDispatcher\GenericEvent")
     *
     * @var string
     */
    const GET_VALUES_FOR_FILTER_FIELD_PRE_SEND_DATA = 'pimcore.admin.ecommerce.getValuesForFilterFieldPreSendData';

    /**
     * Fired when filter fields get fetched
     *
     * @Event("Symfony\Component\EventDispatcher\GenericEvent")
     *
     * @var string
     */
    const GET_INDEX_FIELD_NAMES_PRE_SEND_DATA = 'pimcore.admin.ecommerce.getIndexFieldNamesPreSendData';
}
