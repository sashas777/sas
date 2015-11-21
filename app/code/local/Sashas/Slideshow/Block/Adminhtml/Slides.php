<?php
/**
 * @author		Sashas
 * @category    Sashas
 * @package     Sashas_Slideshow
 * @copyright   Copyright (c) 2015 Sashas IT Support Inc. (http://www.sashas.org)
 * @license     http://opensource.org/licenses/GPL-3.0  GNU General Public License, version 3 (GPL-3.0)
 */

class Sashas_Slideshow_Block_Adminhtml_Slides extends Mage_Adminhtml_Block_Widget_Grid_Container
{
	public function __construct()
	{ 
		$this->_controller = 'adminhtml_slides';
		$this->_blockGroup = 'slideshow';
		$this->_headerText = Mage::helper('slideshow')->__('Manage Slides');		 
		parent::__construct();
		$this->_updateButton('add', 'onclick', 'setLocation(\'' . $this->getUrl('*/*/newSlide') . '\')');
	}
}
