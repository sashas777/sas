<?php
/**
 * @author		Sashas
 * @category    Sashas
 * @package     Sashas_Slideshow
 * @copyright   Copyright (c) 2015 Sashas IT Support Inc. (http://www.sashas.org)
 * @license     http://opensource.org/licenses/GPL-3.0  GNU General Public License, version 3 (GPL-3.0)
 */

class Sashas_Slideshow_Model_Source_Slideshows{
	
    private $_options=array();
    
    /**
     * Set Slideshow values 
     */
    public function __construct (){
        $slideshows=Mage::getModel('slideshow/slideshows')->getCollection();
        foreach ($slideshows as $slideshow) 
        	$this->_options[$slideshow->getId()]=$slideshow->getName();
        
    }
    
	/**
	 * Retrieve option array of slideshows
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