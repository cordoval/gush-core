<?php

/**
 * This file is part of Gush package.
 *
 * (c) 2013-2014 Luis Cordova <cordoval@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Gush\Meta;

/**
 * @author Pierre du Plessis <pdples@gmail.com>
 */
interface Meta
{
    /**
     * @return string
     */
    public function getStartDelimiter();

    /**
     * @return string
     */
    public function getDelimiter();

    /**
     * @return string
     */
    public function getEndDelimiter();
}
