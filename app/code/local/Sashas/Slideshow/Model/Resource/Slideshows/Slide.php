<?php
/**
 * @author		Sashas
 * @category    Sashas
 * @package     Sashas_Slideshow
 * @copyright   Copyright (c) 2015 Sashas IT Support Inc. (http://www.sashas.org)
 * @license     http://opensource.org/licenses/GPL-3.0  GNU General Public License, version 3 (GPL-3.0)
 */

class Sashas_Slideshow_Model_Resource_Slideshows_Slide extends Mage_Core_Model_Resource_Db_Abstract
{

	/**
	 * Initialize resource model
	 *
	 */
	protected function _construct()
	{
		$this->_init('slideshow/slideshows_slide', 'slideshows_slide_id');
	}
		
}
