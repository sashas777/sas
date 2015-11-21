<?php
/**
 * @author		Sashas
 * @category    Sashas
 * @package     Sashas_Slideshow
 * @copyright   Copyright (c) 2015 Sashas IT Support Inc. (http://www.sashas.org)
 * @license     http://opensource.org/licenses/GPL-3.0  GNU General Public License, version 3 (GPL-3.0)
 */

class Sashas_Slideshow_Block_Widget extends Mage_Core_Block_Template implements Mage_Widget_Block_Interface {
 
	/*
	 * @see Mage_Core_Block_Template::_toHtml()
	*/
	protected function _toHtml()
	{
 
		$slideshow_id=$this->_getData('slideshow_id');
		$slideshow=Mage::getModel('slideshow/slideshows')->load($slideshow_id);
		$slideshowType=$slideshow->getType();
		
		/* Based on Slider Type*/
		if ($slideshowType=='jssor') {
		    
		}		 
		/* Based on Slider Type*/
		 
	 	$slideshowOptions=$slideshow->getSlideshowOptions();
	 	$slideshowOptions=unserialize($slideshowOptions);
	 	/*phtml file rewrite */
	 	if (isset($slideshowOptions['template']))
	 	        $slideshowType=$slideshowOptions['template'];
	 	
		$block=$this->getLayout()->createBlock('page/html')
			->setTemplate('slideshow/'.$slideshowType.'.phtml')
			->setSlideshowOptions($slideshowOptions)
			->setSlideshow($slideshow)
			->setSlidesCollection($slideshow->getSlidesCollection());
	
		return $block->toHtml();
	}	
	
}