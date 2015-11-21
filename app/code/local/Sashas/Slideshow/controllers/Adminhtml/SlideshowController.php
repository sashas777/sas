<?php
/**
 * @author		Sashas
 * @category    Sashas
 * @package     Sashas_Slideshow
 * @copyright   Copyright (c) 2015 Sashas IT Support Inc. (http://www.sashas.org)
 * @license     http://opensource.org/licenses/GPL-3.0  GNU General Public License, version 3 (GPL-3.0)
 */

class Sashas_Slideshow_Adminhtml_SlideshowController extends Mage_Adminhtml_Controller_Action {
	
    /* Default Options not included for searilization*/
    private $_sliderDfaultOptions=array(
            'form_key',
            'slideshow_id',
            'name',
            'type',
            'page',
            'limit',
            'in_slideshow',
            'slide_id',
            'slide_name',
            'position',
            'links',
            'slideshow_slides'
            );
    
	protected function _construct()
	{
		// Define module dependent translate
		$this->setUsedModuleName('Sashas_Slideshow');
	}
	
	protected function _initAction()
	{
		$this->loadLayout()->_setActiveMenu('slideshow') ->_addBreadcrumb(
				Mage::helper('slideshow')->__('Slideshow'),
				Mage::helper('slideshow')->__('Slideshow')
		);
		return $this;
	}
	
	protected function _initSlideshow()
	{
	    $id = $this->getRequest()->getParam('slideshow_id');
		$model = Mage::getModel('slideshow/slideshows');
		if ($id) 
		    $model->load($id);		     
		Mage::register('slideshow_slideshow', $model);		
	}
	
	/**
	 * Check for is allowed
	 *
	 * @return boolean
	 */
	protected function _isAllowed()
	{
	    $action = strtolower($this->getRequest()->getActionName());
	    switch ($action) {
	    	case 'slideshows':
	    	    $aclResource = 'slideshow/slideshows';
	    	    break;
	    	case 'slides':
	    	    $aclResource = 'slideshow/slides';
	    	    break;
	    	default:
	    	    $aclResource = 'slideshow';
	    	    break;
	    }
	    return Mage::getSingleton('admin/session')->isAllowed($aclResource);	     
	}	
	
	public function indexAction()
	{
	    $this->_forward('slideshows');	 
	}	
	
	public function slideshowsAction(){
	    $this->_title($this->__('Slideshow'))->_title($this->__('Manage Slideshows'));
	    $this->_initAction();
	    $content_block=$this->getLayout()->createBlock('slideshow/adminhtml_slideshows');
	    $this->getLayout()->getBlock('content')->append($content_block);
	    $this->renderLayout();
	}
		
	public function massSlideshowDeleteAction()
	{
		$slideshowIds = $this->getRequest()->getParam('slideshow_id');
		if (!is_array($slideshowIds)) {
			$this->_getSession()->addError($this->__('Please select slideshows(s).'));
		} else {
			if (!empty($slideshowIds)) {
				try {
					foreach ($slideshowIds as $slideshowId) {
						$warehouse = Mage::getModel('slideshow/slideshows')->load($slideshowId);						
						$warehouse->delete();
					}
					$this->_getSession()->addSuccess(
							$this->__('Total of %d record(s) have been deleted.', count($slideshowIds))
					);
				} catch (Exception $e) {
					$this->_getSession()->addError($e->getMessage());
				}
			}
		}
		$this->_redirect('*/*/slideshows');
	}	
	
	/**
	 * Create new Warehouse
	 */
	public function newSlideshowAction()
	{		 
		$this->_forward('editSlideshow');
	}
	
	/**
	 * Edit Warehouse
	 */
	public function editSlideshowAction()
	{
		$this->_title($this->__('Slideshows'))->_title($this->__('Manage Slideshows'));

		$id = $this->getRequest()->getParam('slideshow_id');
		$model = Mage::getModel('slideshow/slideshows');
	
		if ($id) {
			$model->load($id);
			if (! $model->getId()) {
				Mage::getSingleton('adminhtml/session')->addError(Mage::helper('slideshow')->__('This slideshow no longer exists.'));
				$this->_redirect('*/*/');
				return;
			}
		}
	
		$this->_title($model->getId() ? $model->getTitle() : $this->__('New Slideshow'));
	 
		$data = Mage::getSingleton('adminhtml/session')->getFormData(true);
		if (! empty($data)) {
			$model->setData($data);
		}

		Mage::register('slideshow_slideshow', $model);
	
		$this->_initAction()
		->_addBreadcrumb($id ? Mage::helper('slideshow')->__('Edit Slideshow') : Mage::helper('slideshow')->__('New Slideshow'), $id ? Mage::helper('slideshow')->__('Edit Slideshow') : Mage::helper('slideshow')->__('New Slideshow'));
		$content_block=$this->getLayout()->createBlock('slideshow/adminhtml_slideshows_edit');		 
		$this->getLayout()->getBlock('content')->append($content_block);		
		
	 	$content_block=$this->getLayout()->createBlock('slideshow/adminhtml_slideshows_edit_tabs');		 
		$this->getLayout()->getBlock('left')->append($content_block);
				
		$this->renderLayout();
	}	
	
	/**
	 * Get slideshow slides grid and serializer block
	 */
	public function slideshowSlidesAction()
	{	 
	    $this->_initSlideshow();
	    $this->loadLayout(); 	  
	    $this->getLayout()->getBlock('adminhtml_slideshows_edit_tab_slides')
	    	->setSlideshowSlides($this->getRequest()->getPost('slideshow_slides', null));
	    $this->renderLayout();
	}
	
	/**
	 * Get slideshow slides grid
	 */
	public function slideshowSlidesGridAction()
	{  
	    $this->_initSlideshow();
	    $this->loadLayout();
	    $this->getLayout()->getBlock('adminhtml_slideshows_edit_tab_slides')
	    	->setSlideshowSlides($this->getRequest()->getPost('slideshow_slides', null));
	    $this->renderLayout();
	}
	
	/**
	 * Get slideshow slide options block
	 */
	public function slideshowSlidesOptionsAction()
	{
	    $this->_initSlideshow();
	    $this->loadLayout();
	    $html="";
	    $model = Mage::registry('slideshow_slideshow');
	    if ($model && $model->getSlideshowId()) {
	        $slideShowType=$this->getRequest()->getParam('choosed_type');
	       /* $slideShowType=$model->getType();*/	    
	            
	        $content_block=$this->getLayout()->createBlock('slideshow/adminhtml_slideshows_edit_tab_sliders_'.$slideShowType);
	        $html=$content_block->toHtml();	            
	    }	     
	    $this->getResponse()->setBody($html);
	}
		
	
	/**
	 * Save action
	 */
	public function saveSlideshowAction()
	{		
		if ($data = $this->getRequest()->getPost()) {
			 
			$id = $this->getRequest()->getParam('slideshow_id');
			$model = Mage::getModel('slideshow/slideshows')->load($id);
			if (!$model->getId() && $id) {
				Mage::getSingleton('adminhtml/session')->addError(Mage::helper('slideshow')->__('This slideshow no longer exists.'));
				$this->_redirect('*/*/');
				return;
			}
				 
			$links = $this->getRequest()->getPost('links');
			 
			if (isset($links['slides'])) {
			   $data['slideshow_slides']=Mage::helper('adminhtml/js')->decodeGridSerializedInput($links['slides']);
			}		
			/*Serialize Slider Options*/
			$slider_options=array();
			foreach ($data as $k=>$v) 
			    if (!in_array($k, $this->_sliderDfaultOptions))
			        $slider_options[$k]=$v;
			 
			$data['slideshow_options']=serialize($slider_options);			 
			 /*Serialize Slider Options*/	
			
			$model->setData($data);
	
			try {							    
				$model->save();				
				Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('slideshow')->__('The slideshow has been saved.'));			
				Mage::getSingleton('adminhtml/session')->setFormData(false);
				
				if ($this->getRequest()->getParam('back')) {
					$this->_redirect('*/*/editSlideshow', array('slideshow_id' => $model->getId()));
					return;
				}			
				$this->_redirect('*/*/');
				return;	
			} catch (Exception $e) {				
				Mage::getSingleton('adminhtml/session')->addError($e->getMessage());				
				Mage::getSingleton('adminhtml/session')->setFormData($data);				
				$this->_redirect('*/*/editSlideshow', array('slideshow_id' => $this->getRequest()->getParam('slideshow_id')));
				return;
			}
		}
		$this->_redirect('*/*/');
	}	
 
	/**
	 * Delete action
	 */
	public function deleteSlideshowAction()
	{		
		if ($id = $this->getRequest()->getParam('slideshow_id')) {
			$title = "";
			try {				
				$model = Mage::getModel('slideshow/slideshows');
				$model->load($id);
				$title = $model->getTitle();
				$model->delete();				
				Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('slideshow')->__('The slideshow has been deleted.'));				
				$this->_redirect('*/*/');
				return;	
			} catch (Exception $e) {				
				Mage::getSingleton('adminhtml/session')->addError($e->getMessage());				
				$this->_redirect('*/*/editSlideshow', array('slideshow_id' => $id));
				return;
			}
		}		
		Mage::getSingleton('adminhtml/session')->addError(Mage::helper('slideshow')->__('Unable to find a slideshow to delete.'));		
		$this->_redirect('*/*/');
	}		
	
	public function slidesAction(){
	    $this->_title($this->__('Slideshow'))->_title($this->__('Manage Slides'));
	    $this->_initAction();
	    $content_block=$this->getLayout()->createBlock('slideshow/adminhtml_slides');
	    $this->getLayout()->getBlock('content')->append($content_block);
	    $this->renderLayout();
	}
	
	public function massSlidesDeleteAction()
	{
	    $slideshowIds = $this->getRequest()->getParam('slide_id');
	    if (!is_array($slideshowIds)) {
	        $this->_getSession()->addError($this->__('Please select slide(s).'));
	    } else {
	        if (!empty($slideshowIds)) {
	            try {
	                foreach ($slideshowIds as $slideshowId) {
	                    $model = Mage::getModel('slideshow/slides')->load($slideshowId);
	                    if ($model->getSlideImage())
	                        @unlink( Mage::getBaseDir('media') . DS.$model->getSlideImage());
	                    $model->delete();
	                }
	                $this->_getSession()->addSuccess(
	                        $this->__('Total of %d record(s) have been deleted.', count($slideshowIds))
	                );
	            } catch (Exception $e) {
	                $this->_getSession()->addError($e->getMessage());
	            }
	        }
	    }
	    $this->_redirect('*/*/slides');
	}
 
	public function newSlideAction()
	{	    
	    $this->_forward('editSlide');
	}
 
	public function editSlideAction()
	{
	    $this->_title($this->__('Slideshows'))->_title($this->__('Manage Slides'));
	
	    $id = $this->getRequest()->getParam('slide_id');
	    $model = Mage::getModel('slideshow/slides');
	 
	    if ($id) {
	        $model->load($id);
	        if (! $model->getId()) {
	            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('slideshow')->__('This slide no longer exists.'));
	            $this->_redirect('*/*/slides');
	            return;
	        }
	    }
	
	    $this->_title($model->getId() ? $model->getTitle() : $this->__('New Slide'));
	 
	    $data = Mage::getSingleton('adminhtml/session')->getFormData(true);
	    if (! empty($data)) {
	        $model->setData($data);
	    }
	 
	    Mage::register('slideshow_slide', $model);
	 
	    $this->_initAction()
	    ->_addBreadcrumb($id ? Mage::helper('slideshow')->__('Edit Slideshow') : Mage::helper('slideshow')->__('New Slide'), $id ? Mage::helper('slideshow')->__('Edit Slide') : Mage::helper('slideshow')->__('New Slide'));
	    $content_block=$this->getLayout()->createBlock('slideshow/adminhtml_slides_edit');
	    $this->getLayout()->getBlock('content')->append($content_block);
	
	    $content_block=$this->getLayout()->createBlock('slideshow/adminhtml_slides_edit_tabs');
	    $mainTab=$this->getLayout()->createBlock('slideshow/adminhtml_slides_edit_tab_main','adminhtml_slides_edit_tab_main');
	    $content_block->append($mainTab);
	    $content_block->addTab('main','adminhtml_slides_edit_tab_main');
 
	    $this->getLayout()->getBlock('left')->append($content_block);
 
	    $this->renderLayout();
	}
	
	
	/**
	 * Save Slide action
	 */
	public function saveSlideAction()
	{	  
	    if ($data = $this->getRequest()->getPost()) {
	 
	        $id = $this->getRequest()->getParam('slide_id');
	        $model = Mage::getModel('slideshow/slides')->load($id);
	        if (!$model->getId() && $id) {
	            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('slideshow')->__('This slide no longer exists.'));
	            $this->_redirect('*/*/slides');
	            return;
	        }
	         
	        try { 
	        	if(isset($_FILES['slide_image']['name']) && $_FILES['slide_image']['name'] != '') {					 				    
				     $uploader = new Varien_File_Uploader('slide_image');
				     $uploader->setAllowedExtensions(array('jpg','jpeg','gif','png'));
				     $uploader->setAllowRenameFiles(true);
				     $uploader->setFilesDispersion(false);
				     $path = Mage::getBaseDir('media') . DS.'sashas_slideshow';
				     $saved_file=$uploader->save($path, $_FILES['slide_image']['name']);
		   			$data['slide_image'] ='sashas_slideshow'.DS.$saved_file['file'];
		   			if ($model->getSlideImage())
		   			    @unlink( Mage::getBaseDir('media') . DS.$model->getSlideImage());
			    } else {  
			       if (isset($data['slide_image']) && isset($data['slide_image']['delete'])) { 
			           @unlink( Mage::getBaseDir('media') . DS.$data['slide_image']['value']);			      
			       		$data['slide_image']="";			       		
			       } else{
			           $data['slide_image']=$model->getSlideImage();
			       }
			    } 
			     
	            $model->setData($data);	       
	            $model->save();
	      
	            Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('slideshow')->__('The slide has been saved.'));	       
	            Mage::getSingleton('adminhtml/session')->setFormData(false);
	 
	            if ($this->getRequest()->getParam('back')) {
	                $this->_redirect('*/*/editSlide', array('slide_id' => $model->getId()));
	                return;
	            }	         
	            $this->_redirect('*/*/slides');
	            return;
	
	        } catch (Exception $e) {	           
	            Mage::getSingleton('adminhtml/session')->addError($e->getMessage());	            
	            Mage::getSingleton('adminhtml/session')->setFormData($data);	             
	            $this->_redirect('*/*/editSlide', array('slide_id' => $this->getRequest()->getParam('slide_id')));
	            return;
	        }
	    }
	    $this->_redirect('*/*/slides');
	}
	
	/**
	 * Delete action
	 */
	public function deleteSlideAction()
	{	    
	    if ($id = $this->getRequest()->getParam('slide_id')) {
	        $title = "";
	        try {	          
	            $model = Mage::getModel('slideshow/slides');
	            $model->load($id);	            
	            $title = $model->getTitle();
	            $model->delete();
	            if ($model->getSlideImage()) 
	                @unlink( Mage::getBaseDir('media') . DS.$model->getSlideImage());	            
	             
	            Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('slideshow')->__('The slide has been deleted.'));	          
	            $this->_redirect('*/*/slides');
	            return;
	
	        } catch (Exception $e) {	            
	            Mage::getSingleton('adminhtml/session')->addError($e->getMessage());	          
	            $this->_redirect('*/*/edit', array('slide_id' => $id));
	            return;
	        }
	    }	   
	    Mage::getSingleton('adminhtml/session')->addError(Mage::helper('slideshow')->__('Unable to find a slide to delete.'));	 
	    $this->_redirect('*/*/slides');
	}
	
}