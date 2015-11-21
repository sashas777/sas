<?php
/**
 * @author		Sashas
 * @category    Sashas
 * @package     Sashas_Slideshow
 * @copyright   Copyright (c) 2015 Sashas IT Support Inc. (http://www.sashas.org)
 * @license     http://opensource.org/licenses/GPL-3.0  GNU General Public License, version 3 (GPL-3.0)
 */

class Sashas_Slideshow_Block_Adminhtml_Slideshows_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{
	
	/**
	 * Init form
	 */
	public function __construct()
	{
		parent::__construct();
		$this->setId('slideshow_form');
		$this->setTitle(Mage::helper('slideshow')->__('Slideshow Information'));
	}
  
	protected function _prepareForm()
	{
	    $form = new Varien_Data_Form(array('id' => 'edit_form', 'action' => $this->getUrl('*/*/saveSlideshow'), 'method' => 'post'));
	    $form->setUseContainer(true);
	    $this->setForm($form);
	    return parent::_prepareForm();
	}
	
	public function getSlidesJson()
	{
	    $slides = $this->getSlideshow()->getSlideshowSlides();
	    if (!empty($slides)) {
	        return Mage::helper('core')->jsonEncode($slides);
	    }
	    return '{}';
	}
	
	public function isAjax()
	{
	    return Mage::app()->getRequest()->isXmlHttpRequest() || Mage::app()->getRequest()->getParam('isAjax');
	}
	
	public function getSlideshow()
	{
	    return Mage::registry('slideshow_slideshow');
	}
	
}