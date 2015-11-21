<?php
/**
 * @author		Sashas
 * @category    Sashas
 * @package     Sashas_Slideshow
 * @copyright   Copyright (c) 2015 Sashas IT Support Inc. (http://www.sashas.org)
 * @license     http://opensource.org/licenses/GPL-3.0  GNU General Public License, version 3 (GPL-3.0)
 */

class Sashas_Slideshow_Block_Adminhtml_Slideshows_Grid extends Mage_Adminhtml_Block_Widget_Grid
{

    public function __construct()
    {
        parent::__construct();
        $this->setId('slideshows_grid');
        $this->setDefaultSort('slideshow_id');
        $this->setDefaultDir('ASC');     
        $this->setSaveParametersInSession(true);
           
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('slideshow/slideshows') ->getResourceCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn('slideshow_id', array(
            'header'    => Mage::helper('slideshow')->__('ID'),
            'align'     =>'right',
            'width'     => '60',
            'index'     => 'slideshow_id',
        ));

        $this->addColumn('name', array(
            'header'    => Mage::helper('slideshow')->__('Slideshow Name'),
            'align'     =>'left',
            'index'     => 'name',
        ));
        
        $this->addColumn('type', array(
        	'header'    => Mage::helper('slideshow')->__('Slideshow Type'),
        	'align'     =>'left',
            'width'     => '150',
            'type'		=>'options',
            'options'	=> Mage::getSingleton('slideshow/source_slideshowType')->toOptionArray(),
        	'index'     => 'type',
        ));
 
        return parent::_prepareColumns();
    }

    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/editSlideshow', array('slideshow_id' => $row->getSlideshowId()));
    }

    
    protected function _prepareMassaction()
    {
    	$this->setMassactionIdField('slideshow_id');
    	$this->getMassactionBlock()->setFormFieldName('slideshow_id');
    
    	$this->getMassactionBlock()->addItem('delete', array(
    			'label'=> Mage::helper('slideshow')->__('Delete Slideshow'),
    			'url'  => $this->getUrl('*/*/massSlideshowDelete'),
    			'confirm' => Mage::helper('slideshow')->__('Are you sure?')
    	));    
         
    	Mage::dispatchEvent('adminhtml_slideshow_slideshows_massaction', array('block' => $this));
    	return $this;
    }    
}
