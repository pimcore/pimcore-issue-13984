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

namespace Pimcore\Bundle\CoreBundle\EventListener\Traits;

use Pimcore\Http\ResponseHelper;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\Service\Attribute\Required;

/**
 * @internal
 */
trait ResponseInjectionTrait
{
    private ResponseHelper $responseHelper;

    #[Required]
    public function setResponseHelper(ResponseHelper $responseHelper): void
    {
        $this->responseHelper = $responseHelper;
    }

    protected function isHtmlResponse(Response $response): bool
    {
        return $this->responseHelper->isHtmlResponse($response);
    }

    protected function injectBeforeHeadEnd(Response $response, $code): void
    {
        $content = $response->getContent();

        // search for the end <head> tag, and insert the code before
        // this method is much faster than using simple_html_dom and uses less memory
        $headEndPosition = strripos($content, '</head>');

        if (false !== $headEndPosition) {
            $content = substr_replace($content, $code . '</head>', $headEndPosition, 7);
        }

        $response->setContent($content);
    }
}
