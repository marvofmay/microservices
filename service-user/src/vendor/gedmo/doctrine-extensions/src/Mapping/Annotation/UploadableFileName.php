<?php

/*
 * This file is part of the Doctrine Behavioral Extensions package.
 * (c) Gediminas Morkevicius <gediminas.morkevicius@gmail.com> http://www.gediminasm.org
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gedmo\Mapping\Annotation;

use Doctrine\Common\Annotations\Annotation;
use Gedmo\Mapping\Annotation\Annotation as GedmoAnnotation;

/**
 * UploadableFileName Annotation for Uploadable behavioral extension
 *
 * @Annotation
 * @Target("PROPERTY")
 *
 * @author tiger-seo <tiger.seo@gmail.com>
 */
#[\Attribute(\Attribute::TARGET_PROPERTY)]
final class UploadableFileName implements GedmoAnnotation
{
}
