<?php
/**
 * @author		Sashas
 * @category    Sashas
 * @package     Sashas_Slideshow
 * @copyright   Copyright (c) 2015 Sashas IT Support Inc. (http://www.sashas.org)
 * @license     http://opensource.org/licenses/GPL-3.0  GNU General Public License, version 3 (GPL-3.0)
 */

class Sashas_Slideshow_Block_Adminhtml_Slides_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{
	
	/**
	 * Init form
	 */
	public function __construct()
	{
		parent::__construct();
		$this->setId('slide_form');
		$this->setTitle(Mage::helper('slideshow')->__('Slide Information'));
		 
	}
  
	protected function _prepareForm()
	{	   
	    $form = new Varien_Data_Form(array('id' => 'edit_form', 'action' =>  $this->getUrl('*/*/saveSlide'), 'method' => 'post', 'enctype' => 'multipart/form-data'));
	    $form->setUseContainer(true);
	    $this->setForm($form);
	    return parent::_prepareForm();
	}
	
	
}