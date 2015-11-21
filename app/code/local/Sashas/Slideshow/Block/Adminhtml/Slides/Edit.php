<?php
/**
 * @author		Sashas
 * @category    Sashas
 * @package     Sashas_Slideshow
 * @copyright   Copyright (c) 2015 Sashas IT Support Inc. (http://www.sashas.org)
 * @license     http://opensource.org/licenses/GPL-3.0  GNU General Public License, version 3 (GPL-3.0)
 */

class Sashas_Slideshow_Block_Adminhtml_Slides_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
	public function __construct()
	{
		$this->_objectId = 'slide_id';
		$this->_blockGroup='slideshow';
		$this->_controller = 'adminhtml_slides';
	
		parent::__construct();
	
		$this->_updateButton('save', 'label', Mage::helper('slideshow')->__('Save Slide'));
		$this->_updateButton('delete', 'label', Mage::helper('slideshow')->__('Delete Slide'));
		 
		$this->_addButton('saveandcontinue', array(
				'label'     => Mage::helper('adminhtml')->__('Save and Continue Edit'),
				'onclick'   => 'saveAndContinueEdit()',
				'class'     => 'save',
		), -100);
		
		$this->_formScripts[] = " 		
			function saveAndContinueEdit(){
				editForm.submit($('edit_form').action+'back/editSlide/');
			}
		";		
		$this->_removeButton('reset');
	}
	
	
	/**
	 * Get URL for back (reset) button
	 *
	 * @return string
	 */
	public function getBackUrl()
	{
	    return $this->getUrl('*/*/slides');
	}
	
	public function getDeleteUrl()
	{
	    return $this->getUrl('*/*/deleteSlide', array($this->_objectId => $this->getRequest()->getParam($this->_objectId)));
	}
	
	/**
	 * Get edit form container header text
	 *
	 * @return string
	 */
	public function getHeaderText()
	{
		if (Mage::registry('slideshow_slide')->getId()) {
			return Mage::helper('slideshow')->__("Edit Slide '%s'", $this->escapeHtml(Mage::registry('slideshow_slide')->getName()));
		}
		else {
			return Mage::helper('slideshow')->__('New Slide');
		}
	}
}
