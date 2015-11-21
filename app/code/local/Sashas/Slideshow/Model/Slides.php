<?php
/**
 * @author		Sashas
 * @category    Sashas
 * @package     Sashas_Slideshow
 * @copyright   Copyright (c) 2015 Sashas IT Support Inc. (http://www.sashas.org)
 * @license     http://opensource.org/licenses/GPL-3.0  GNU General Public License, version 3 (GPL-3.0)
 */

class Sashas_Slideshow_Model_Slides extends Mage_Core_Model_Abstract
{
    const CACHE_TAG     = 'slideshow_slides';
    protected $_cacheTag= 'slideshow_slides';

    protected function _construct()
    {
        $this->_init('slideshow/slides');
    }

 
}
