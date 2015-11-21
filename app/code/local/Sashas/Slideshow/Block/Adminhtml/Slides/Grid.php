<?php
/**
 * @author		Sashas
 * @category    Sashas
 * @package     Sashas_Slideshow
 * @copyright   Copyright (c) 2015 Sashas IT Support Inc. (http://www.sashas.org)
 * @license     http://opensource.org/licenses/GPL-3.0  GNU General Public License, version 3 (GPL-3.0)
 */

class Sashas_Slideshow_Block_Adminhtml_Slides_Grid extends Mage_Adminhtml_Block_Widget_Grid
{

    public function __construct()
    {
        parent::__construct();
        $this->setId('slides_grid');
        $this->setDefaultSort('main_table.slide_id');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('slideshow/slides')->getResourceCollection();
        $collection->getSelect()->joinLeft(array('slideshows_slide' => Mage::getSingleton('core/resource')->getTableName('slideshow/slideshows_slide')),
                'main_table.slide_id = slideshows_slide.slide_id', array());
        $collection->getSelect()->joinLeft(array('slideshows' => Mage::getSingleton('core/resource')->getTableName('slideshow/slideshows')),
                'slideshows_slide.slideshow_id = slideshows.slideshow_id', array('slideshow_name'=> new Zend_Db_Expr('GROUP_CONCAT(slideshows.name)')));        
        $collection->getSelect()->group('main_table.slide_id');
  
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn('slide_id', array(
            'header'    => Mage::helper('slideshow')->__('ID'),
            'align'     =>'right',
            'width'     => '60',
            'index'     => 'slide_id',
        ));

        $this->addColumn('name', array(
            'header'    => Mage::helper('slideshow')->__('Slide Name'),
            'align'     =>'left',
            'index'     => 'name',
        )); 
            
        $this->addColumn('slideshow_id', array(
			'header'    => Mage::helper('slideshow')->__('Slideshow'),
			'align'     =>'left',
            'width'     => '300',               
			'index'     => 'slideshow_name',
			'filter_condition_callback' => array($this, '_SlideshowFilter'),
        ));
        
        return parent::_prepareColumns();
    }

    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/editSlide', array('slide_id' => $row->getSlideId()));
    }

    
    protected function _prepareMassaction()
    {
    	$this->setMassactionIdField('slide_id');
    	$this->getMassactionBlock()->setFormFieldName('slide_id');
    
    	$this->getMassactionBlock()->addItem('delete', array(
    			'label'=> Mage::helper('slideshow')->__('Delete Slides'),
    			'url'  => $this->getUrl('*/*/massSlidesDelete'),
    			'confirm' => Mage::helper('slideshow')->__('Are you sure?')
    	));    
         
    	Mage::dispatchEvent('adminhtml_slideshow_slides_massaction', array('block' => $this));
    	return $this;
    }

    
    protected function _SlideshowFilter($collection, $column)
    {
        if (!$value = $column->getFilter()->getValue()) {
            return $this;
        }
        $this->getCollection()->getSelect()->where("slideshows.name  LIKE (?)" , '%'.$value.'%');        
        return $this;
    }
}
