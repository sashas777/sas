<?php 
/**
 * @author		Sashas
 * @category    Sashas
 * @package     Sashas_Slideshow
 * @copyright   Copyright (c) 2015 Sashas IT Support Inc. (http://www.sashas.org)
 * @license     http://opensource.org/licenses/GPL-3.0 GNU License, version 3 (GPL-3.0)
 */

class Sashas_Slideshow_Block_Adminhtml_Slideshows_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

    public function __construct()
    {
        parent::__construct();
        $this->setId('slideshows_edit_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('slideshow')->__('Slideshow'));      
    }
    
   
    protected function _prepareLayout()
    {        
        $this->addTab('main', array(
                'label'     => Mage::helper('slideshow')->__('Slideshow Information'),
                'title'     => Mage::helper('slideshow')->__('Slideshow Information'),
                'content'   => $this->getLayout()->createBlock(
                        'slideshow/adminhtml_slideshows_edit_tab_main',
                        'adminhtml_slideshows_edit_tab_main'
                		)->toHtml(),
        )); 
        
        $this->addTab('slides', array(
                'label'     => Mage::helper('slideshow')->__('Slideshow Slides'),
                'title'     => Mage::helper('slideshow')->__('Slideshow Slides'), 
                'class'     => 'ajax',
                'url'       => $this->getUrl('*/*/slideshowSlides', array('_current' => true))                                 
        ));
        
        $model = Mage::registry('slideshow_slideshow');
        if ($model && $model->getSlideshowId()) {
            $slideShowType=$model->getType();
	        $this->addTab('sliders_'.$slideShowType, array(
	                'label'     => Mage::helper('slideshow')->__('Slideshow Options'),
	                'title'     => Mage::helper('slideshow')->__('Slideshow Options'),
	                'class'     => 'ajax',
	                'url'       => $this->getUrl('*/*/slideshowSlidesOptions', array('_current' => true, 'choosed_type'=>$slideShowType)),
	                'content'   => $this->getLayout()->createBlock(
	                        'slideshow/adminhtml_slideshows_edit_tab_sliders_'.$slideShowType,
	                        'adminhtml_slideshows_edit_tab_sliders_'.$slideShowType
	                )->toHtml(),
	        ));
        }
        return parent::_prepareLayout();
    }
}
