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

namespace Pimcore\Model\Document\Editable\Block;

use Pimcore\Model\Document;

abstract class AbstractBlockItem
{
    /**
     * @internal
     *
     * @var Document\PageSnippet
     */
    protected Document\PageSnippet $document;

    /**
     * @internal
     *
     * @var array
     */
    protected array $parentBlockNames;

    /**
     * @internal
     *
     * @var int
     */
    protected int $index;

    public function __construct(Document\PageSnippet $document, array $parentBlockNames, int $index)
    {
        $this->document = $document;
        $this->parentBlockNames = $parentBlockNames;
        $this->index = $index;
    }

    abstract protected function getItemType(): string;

    public function getEditable(string $name): ?Document\Editable
    {
        $id = Document\Editable::buildChildEditableName($name, $this->getItemType(), $this->parentBlockNames, $this->index);
        $editable = $this->document->getEditable($id);

        if ($editable) {
            $editable->setParentBlockNames($this->parentBlockNames);
        }

        return $editable;
    }

    /**
     * @param string $func
     * @param array $args
     *
     * @return Document\Editable|null
     */
    public function __call(string $func, array $args)
    {
        $element = $this->getEditable($args[0]);
        $class = 'Pimcore\\Model\\Document\\Editable\\' . str_replace('get', '', $func);

        if ($element !== null && !strcasecmp(get_class($element), $class)) {
            return $element;
        }

        return null;
    }
}
