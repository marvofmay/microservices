<?php

/*
 * This file is part of the Doctrine Behavioral Extensions package.
 * (c) Gediminas Morkevicius <gediminas.morkevicius@gmail.com> http://www.gediminasm.org
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gedmo\Tree\Mapping\Event\Adapter;

use Gedmo\Mapping\Event\Adapter\ODM as BaseAdapterODM;
use Gedmo\Tree\Mapping\Event\TreeAdapter;

/**
 * Doctrine event adapter for ODM adapted
 * for Tree behavior
 *
 * @author Gediminas Morkevicius <gediminas.morkevicius@gmail.com>
 */
final class ODM extends BaseAdapterODM implements TreeAdapter
{
    // Nothing specific yet
}
