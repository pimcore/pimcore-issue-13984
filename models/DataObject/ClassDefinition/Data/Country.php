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

namespace Pimcore\Model\DataObject\ClassDefinition\Data;

use Pimcore\Model;
use Pimcore\Model\DataObject\ClassDefinition\DynamicOptionsProvider\CountryOptionsProvider;
use Pimcore\Model\DataObject\Concrete;

class Country extends Model\DataObject\ClassDefinition\Data\Select
{
    use Model\DataObject\Traits\DataWidthTrait;

    /**
     * Static type of this element
     *
     * @internal
     *
     * @var string
     */
    public string $fieldtype = 'country';

    /**
     * Restrict selection to comma-separated list of countries.
     *
     * @internal
     *
     * @var string|null
     */
    public ?string $restrictTo = null;

    /**
     * {@inheritdoc}
     */
    public function isDiffChangeAllowed(Concrete $object, array $params = []): bool
    {
        return true;
    }

    public function setRestrictTo(array|string|null $restrictTo)
    {
        /**
         * @extjs6
         */
        if (is_array($restrictTo)) {
            $restrictTo = implode(',', $restrictTo);
        }

        $this->restrictTo = $restrictTo;
    }

    public function getRestrictTo(): ?string
    {
        return $this->restrictTo;
    }

    /**
     * {@inheritdoc}
     */
    public function isFilterable(): bool
    {
        return true;
    }

    public function getOptionsProviderClass(): string
    {
        return '@' . CountryOptionsProvider::class;
    }
}
