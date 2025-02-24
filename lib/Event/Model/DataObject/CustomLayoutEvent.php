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

namespace Pimcore\Event\Model\DataObject;

use Pimcore\Model\DataObject\ClassDefinition;
use Symfony\Contracts\EventDispatcher\Event;

class CustomLayoutEvent extends Event
{
    protected ClassDefinition\CustomLayout $customLayout;

    /**
     * DocumentEvent constructor.
     *
     * @param ClassDefinition\CustomLayout $customLayout
     */
    public function __construct(ClassDefinition\CustomLayout $customLayout)
    {
        $this->customLayout = $customLayout;
    }

    public function getCustomLayout(): ClassDefinition\CustomLayout
    {
        return $this->customLayout;
    }

    public function setCustomLayout(ClassDefinition\CustomLayout $customLayout)
    {
        $this->customLayout = $customLayout;
    }
}
