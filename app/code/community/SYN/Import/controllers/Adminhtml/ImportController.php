<?php

class SYN_Import_Adminhtml_ImportController extends Mage_Adminhtml_Controller_Action
{

	
	public function tagAction() {
	
		$this->_title(Mage::helper('syn_import')->__('Import Profiles'));
		$this->loadLayout()->_setActiveMenu('syn_import/import');
		$this->renderLayout();
	}

	public function savetagAction() {
         try {		  
		    if(isset($_FILES['import_file']['name']) && $_FILES['import_file']['name']!=''){		
						$importDir = Mage::getBaseDir('media') . DS;
						$fileName=$_FILES['import_file']['name'];		
						move_uploaded_file($_FILES['import_file']['tmp_name'],$importDir.$_FILES['import_file']['name']);
						$filePath = $importDir.$fileName;				
					
						if ( file_exists($filePath) ) {
							
							$lines = file($filePath, FILE_IGNORE_NEW_LINES);
							$i=0;
							foreach ($lines as $key => $value)
							{
							    if($i!=0){							
								
								$csv_values=str_getcsv($value);
								  if($csv_values[0]!=''){
								   $tags=explode(",",$csv_values[0]);
								   $sku=$csv_values[1];
								   $product=Mage::getModel('catalog/product')->getIdBySku(trim($sku));
								   $productIds= (array)$product;
                                   if($productIds){ 								   
								    foreach($tags as $tag){
								     if($tag!=''){
									   $data=array();
									   $tagName=trim($tag);									  
								       $model = Mage::getModel('tag/tag');									   
									   $tagTable=Mage::getSingleton('core/resource')->getTableName('tag');
									   $tagProductTable=Mage::getSingleton('core/resource')->getTableName('tag/relation');
									 
									   // magootag tag_id Tag Id	name Name	status Status	first_customer_id First Customer Id	first_store_id First Store Id
									 
									   
									   $tag_query="select * from $tagTable where name='".$tagName."'";		   
									   $tag_result= Mage::getSingleton('core/resource')->getConnection('core_read')->fetchRow($tag_query);
									   
									   
									   if($tag_result){
									    $tag_id=$tag_result['tag_id'];
										 $data['tag_id'] = $tag_id;	
										 $model->load($tag_id);
										 $model->setStoreId(1);
										 
									   $tag_product_query="select product_id from $tagProductTable where tag_id='".$tag_id."'";		   
									   $tag_product_results= Mage::getSingleton('core/resource')->getConnection('core_read')->fetchAll($tag_product_query);
									    if(is_array($tag_product_results)){
									     foreach($tag_product_results as $tag_product_result){
										  $productIds[]=$tag_product_result['product_id'];
										 }
									    }				  
									   
									    
										}
										
											$data['name']               = trim($tagName);
											$data['status']             = 1;
											$data['base_popularity']    =  0;
											$data['store']              = 1;
											$model->addData($data);									
											$model->save();	
									   
									
									
									$tagRelationModel = Mage::getModel('tag/tag_relation');
									$tagRelationModel->addRelations($model, $productIds);
									$model->save();
												
									
									 }								   
								    }						  
								   }
								   //var_dump($csv_values);							   
								   
								  }
								}
								$i++;
							} 

		
		                } 
					   $message = $this->__('Your form has been submitted successfully.');
                       Mage::getSingleton('adminhtml/session')->addSuccess($message);	
	                }
	 

        } catch (Exception $e) {
            Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
        }
        $this->_redirect('*/*/tag');
		
	}	

}