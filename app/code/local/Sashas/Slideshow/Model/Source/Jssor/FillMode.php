<?php
/**
 * @author		Sashas
 * @category    Sashas
 * @package     Sashas_Slideshow
 * @copyright   Copyright (c) 2015 Sashas IT Support Inc. (http://www.sashas.org)
 * @license     http://opensource.org/licenses/GPL-3.0  GNU General Public License, version 3 (GPL-3.0)
 */

class Sashas_Slideshow_Model_Source_Jssor_fillMode {
	
    private $_options=array(
            '0'=> 'Scretch',
            '1'=> 'Contain (keep aspect ratio and put all inside slide)',
            '2'=> 'Cover (keep aspect ratio and cover whole slide)',
            '4'=> 'Actual size',
            '5'=> 'Contain for large image and actual size for small image',
            );
    
 
	public function toOptionArray($withGroup = false)
	{
		$optionArray = array();		 
		$optionArray=$this->_options;		
		return $optionArray;
	}
		
}