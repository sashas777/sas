<?php
/**
 * @author		Sashas
 * @category    Sashas
 * @package     Sashas_Slideshow
 * @copyright   Copyright (c) 2015 Sashas IT Support Inc. (http://www.sashas.org)
 * @license     http://opensource.org/licenses/GPL-3.0  GNU General Public License, version 3 (GPL-3.0)
 */

class Sashas_Slideshow_Model_Source_Jssor_PauseOnHover {
	
    private $_options=array(
            '0'=> 'No pause',
            '1'=> 'Pause for desktop',
            '2'=> 'Pause for touch device',
            '3'=> 'Pause for desktop and touch device',
            '4'=> 'Freeze for desktop',
            '8'=> 'Freeze for touch device',
            '12'=> 'Freeze for desktop and touch device',
            );
    

	public function toOptionArray($withGroup = false)
	{
		$optionArray = array();		 
		$optionArray=$this->_options;		
		return $optionArray;
	}
		
}