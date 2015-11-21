<?php
/**
 * @author		Sashas
 * @category    Sashas
 * @package     Sashas_Slideshow
 * @copyright   Copyright (c) 2015 Sashas IT Support Inc. (http://www.sashas.org)
 * @license     http://opensource.org/licenses/GPL-3.0  GNU General Public License, version 3 (GPL-3.0)
 */

class Sashas_Slideshow_Model_Source_Jssor_ChanceToShow {
	
    private $_options=array(
            '0'=>'Never',
            '1'=> 'Mouse Over',
            '2'=> 'Always',           
            );
    
	public function toOptionArray($withGroup = false)
	{
		$optionArray = array();		 
		$optionArray=$this->_options;		
		return $optionArray;
	}
		
}