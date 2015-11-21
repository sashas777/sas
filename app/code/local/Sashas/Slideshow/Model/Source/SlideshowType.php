<?php
/**
 * @author		Sashas
 * @category    Sashas
 * @package     Sashas_Slideshow
 * @copyright   Copyright (c) 2015 Sashas IT Support Inc. (http://www.sashas.org)
 * @license     http://opensource.org/licenses/GPL-3.0  GNU General Public License, version 3 (GPL-3.0)
 */

class Sashas_Slideshow_Model_Source_SlideshowType {
	
    private $_options=array(
            'bxslider'=> 'bxSlider',
            'jssor'=> 'Jssor Slider (Beta)',          
            );
    
	/**
	 * Retrieve option array of slideshow types
	 *
	 * @param boolean $withGroup
	 * @return array
	 */
	public function toOptionArray($withGroup = false)
	{
		$optionArray = array();		 
		$optionArray=$this->_options;		
		return $optionArray;
	}
		
}