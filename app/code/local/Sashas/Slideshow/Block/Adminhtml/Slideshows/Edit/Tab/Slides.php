<?php
/**
 * @author		Sashas
 * @category    Sashas
 * @package     Sashas_Slideshow
 * @copyright   Copyright (c) 2015 Sashas IT Support Inc. (http://www.sashas.org)
 * @license     http://opensource.org/licenses/GPL-3.0 GNU License, version 3 (GPL-3.0)
 */

class Sashas_Slideshow_Block_Adminhtml_Slideshows_Edit_Tab_Slides  extends Mage_Adminhtml_Block_Widget_Grid {
     
    public function __construct()
    {
        parent::__construct();
        $this->setId('slideshow_slideshows_slide');
        $this->setDefaultSort('main_table.slide_id','ASC');
        $this->setDefaultFilter(array('in_slideshow'=>1));
        $this->setSaveParametersInSession(false);
        $this->setUseAjax(true);                             
    }        
    
    public function getSlideshow()
    {
        return Mage::registry('slideshow_slideshow');
    }
    
    protected function _addColumnFilterToCollection($column)
    {        
        if ($column->getId() == 'in_slideshow') {
            $slideIds = $this->_getSelectedSlides();
            if (empty($slideIds)) {
                $slideIds = 0;
            }
            if ($column->getFilter()->getValue()) {
                $this->getCollection()->addFieldToFilter('main_table.slide_id', array('in'=>$slideIds));
            }
            elseif(!empty($slideIds)) {
                $this->getCollection()->addFieldToFilter('main_table.slide_id', array('nin'=>$slideIds));
            }
        }
        else {
            parent::_addColumnFilterToCollection($column);
        }    
        
        Mage::log('_addColumnFilterToCollection -- begin', null, 'slideshow.log');
        Mage::log($this->getCollection()->getSelect()->__toString(), null, 'slideshow.log');
        Mage::log('_addColumnFilterToCollection -- end', null, 'slideshow.log');
         
        return $this;
    }
    
    protected function _prepareCollection()
    {
        if ($this->getSlideshow()->getId()) {
            $this->setDefaultFilter(array('in_slideshow'=>1));
        }
        $prefix=Mage::getConfig()->getTablePrefix();
        
        $collection = Mage::getModel('slideshow/slides')->getCollection();
        	 
        $collection->getSelect()->joinLeft(
                array('sl'=>$prefix.'slideshow_slideshows_slide'),                  
                ' main_table.slide_id=sl.slide_id AND sl.slideshow_id='.(int) $this->getRequest()->getParam('slideshow_id', 0),
                array('position','slideshows_slide_id')            
        	); 
        Mage::log('_prepareCollection -- begin', null, 'slideshow.log');
        Mage::log($collection->getSelect()->__toString(), null, 'slideshow.log');
        Mage::log('_prepareCollection -- end', null, 'slideshow.log');
        
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }
    
    protected function _prepareColumns()
    {
       
		$this->addColumn('in_slideshow', array(
                'header_css_class' => 'a-center',
                'type'      => 'checkbox',
                'name'      => 'in_slideshow',	                 
                'values'    => $this->_getSelectedSlides(),
                'align'     => 'center',
                'index'     => 'slide_id'
		));
       
        
        $this->addColumn('slide_id', array(
                'header'    => Mage::helper('slideshow')->__('Slide ID'),
                'sortable'  => true,
                'width'     => '60',
                'index'     => 'slide_id'
        ));
        $this->addColumn('slide_name', array(
                'header'    => Mage::helper('slideshow')->__('Name'),
                'index'     => 'name',
                'name'      => 'slide_name',
        ));
 
        $this->addColumn('position', array(
                'header'    => Mage::helper('slideshow')->__('Position'),
                'width'     => '1',
                'type'      => 'number',
                'index'     => 'position',
                'name'      => 'position',
                'validate_class'=> 'validate-number',                 
                'editable'          => true,                                           
        ));
    
        return parent::_prepareColumns();
    }
    
    public function getGridUrl()
    {
        return $this->getUrl('*/*/slideshowSlidesGrid', array('_current'=>true));
    }
    
    protected function _getSelectedSlides()
    {
        $slides = $this->getSlideshowSlides();
        
        Mage::log('_getSelectedSlides -- begin', null, 'slideshow.log');
        Mage::log($slides, null, 'slideshow.log');
        Mage::log('_getSelectedSlides -- end', null, 'slideshow.log');
        
        if (!is_array($slides)) {
            $slides = array_keys($this->getSelectedSlides()); 
        }
          
        return $slides;
    }
    
    public function getSelectedSlides()    
    {   
        $slides=array();
        $slides = $this->getSlideshow()->getSlidesPosition();                        
        return $slides;
    }    
 
    
}
