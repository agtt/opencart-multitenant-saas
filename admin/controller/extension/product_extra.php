<?php
include_once(DIR_APPLICATION.'controller/catalog/product.php');
//require_once(DIR_SYSTEM . 'library/cart/customer.php');
//require_once(DIR_SYSTEM . 'library/cart/tax.php');
if(!function_exists('utf8_strlen')){
	function utf8_strlen($string) {
		return strlen(utf8_decode($string));
	}
}
class ControllerExtensionProductExtra extends ControllerCatalogProduct {
	private $error = array(); 
	
	public function __construct($arg){
		//@session_start();
		parent::__construct($arg);
		$this->registry->set('customer', new CustomCustomer($this->registry));
		$this->registry->set('tax', new Cart\Tax($this->registry));
		$this->tax->setShippingAddress(
			$this->config->get('config_country_id'), 
			$this->config->get('config_zone_id')
		);
	}
	
  	public function index() {
		$this->load->model('extension/product_extra');
		
		if(isset($this->request->get['type']) && $this->request->get['type'] == "change_store"){
			$this->model_extension_product_extra->changeProductToStore((int)$this->request->get['product_id'], (int)$this->request->get['store_id']);
			echo "done";
			die();
		}
		
		if(isset($this->request->get['type']) && $this->request->get['type'] == "change_manufacturer"){
			$this->model_extension_product_extra->changeManufacturer((int)$this->request->get['product_id'], (int)$this->request->get['manufacturer_id']);
			echo "done";
			die();
		}
		
		if(isset($this->request->get['type']) && $this->request->get['type'] == "change_tax_class"){
			$this->model_extension_product_extra->changeTaxClass((int)$this->request->get['product_id'], (int)$this->request->get['tax_class_id']);
			echo "done";
			die();
		}
		
		if(isset($this->request->get['type']) && $this->request->get['type'] == "change_length_class"){
			$this->model_extension_product_extra->changeLengthClass((int)$this->request->get['product_id'], (int)$this->request->get['length_class_id']);
			echo "done";
			die();
		}
		
		if(isset($this->request->get['type']) && $this->request->get['type'] == "change_stock_status"){
			$this->model_extension_product_extra->changeStockStatus((int)$this->request->get['product_id'], (int)$this->request->get['stock_status_id']);
			echo "done";
			die();
		}
		
		if(isset($this->request->get['type']) && $this->request->get['type'] == "change_status"){
			$this->model_extension_product_extra->changeProductStatus((int)$this->request->get['product_id']);
			echo "done";
			die();
		}
		if(isset($this->request->get['type']) && $this->request->get['type'] == "change_subtract"){
			$this->model_extension_product_extra->changeProductSubstract((int)$this->request->get['product_id']);
			echo "done";
			die();
		}
		if(isset($this->request->get['type']) && $this->request->get['type'] == "change_shipping"){
			$this->model_extension_product_extra->changeProductShipping((int)$this->request->get['product_id']);
			echo "done";
			die();
		}
		if(isset($this->request->get['type']) && $this->request->get['type'] == "change_quantity"){
			echo $this->model_extension_product_extra->changeProductQuantity((int)$this->request->get['product_id'], (int)$this->request->get['quantity']);
			die();
		}
		if(isset($this->request->get['type']) && $this->request->get['type'] == "change_minimum"){
			echo $this->model_extension_product_extra->changeProductMinimum((int)$this->request->get['product_id'], (int)$this->request->get['minimum']);
			die();
		}
		if(isset($this->request->get['type']) && $this->request->get['type'] == "change_sku"){
			echo $this->model_extension_product_extra->changeProductSku((int)$this->request->get['product_id'], $this->request->get['sku']);
			die();
		}
		if(isset($this->request->get['type']) && $this->request->get['type'] == "change_upc"){
			echo $this->model_extension_product_extra->changeUpc((int)$this->request->get['product_id'], $this->request->get['upc']);
			die();
		}
		if(isset($this->request->get['type']) && $this->request->get['type'] == "change_location"){
			echo $this->model_extension_product_extra->changeLocation((int)$this->request->get['product_id'], $this->request->get['location']);
			die();
		}
		if(isset($this->request->get['type']) && $this->request->get['type'] == "change_date_available"){
			echo $this->model_extension_product_extra->changeDateAvailable((int)$this->request->get['product_id'], $this->request->get['date_available']);
			die();
		}
		if(isset($this->request->get['type']) && $this->request->get['type'] == "change_seo"){
			echo $this->model_extension_product_extra->changeSeo(
				(int)$this->request->get['product_id'], 
				$this->request->get['seo'],
				$this->request->get['language']
			);
			die();
		}
		if(isset($this->request->get['type']) && $this->request->get['type'] == "update_description"){
			echo $this->model_extension_product_extra->updateDescriptions((int)$this->request->get['product_id'], $this->request->post);
			die();
		}
		if(isset($this->request->get['type']) && $this->request->get['type'] == "change_price"){
			echo $this->model_extension_product_extra->changeProductPrice((int)$this->request->get['product_id'], (float)$this->request->get['price']);
			die();
		}
		if(isset($this->request->get['type']) && $this->request->get['type'] == "change_sort_order"){
			echo $this->model_extension_product_extra->changeProductSortOrder((int)$this->request->get['product_id'], (float)$this->request->get['sort_order']);
			die();
		}
		
		if(isset($this->request->get['type']) && $this->request->get['type'] == "special_prices"){
			//$this->model_extension_product_extra->changeSpecialPrices((int)$this->request->get['product_id'], (float)$this->request->post);
			
			return $this->SpecialPrices((int)$this->request->get['product_id']);
		}
		
		if(isset($this->request->get['type']) && $this->request->get['type'] == "change_category"){
			$this->model_extension_product_extra->changeProductCategory((int)$this->request->get['product_id'], $this->request->get['category_id']);
			echo "done";
			die();
		}
		
		if(isset($this->request->get['type']) && $this->request->get['type'] == "remove_category"){
			$this->model_extension_product_extra->removeProductCategory((int)$this->request->get['product_id'], (int)$this->request->get['category_id']);
			echo "done";
			die();
		}

		if(isset($this->request->get['type']) && $this->request->get['type'] == "change_filter"){
			$this->model_extension_product_extra->changeProductFilter((int)$this->request->get['product_id'], $this->request->get['filter_id']);
			echo "done";
			die();
		}

		if(isset($this->request->get['type']) && $this->request->get['type'] == "remove_filter"){
			$this->model_extension_product_extra->removeProductFilter((int)$this->request->get['product_id'], (int)$this->request->get['filter_id']);
			echo "done";
			die();
		}
		
		if(isset($this->request->get['type']) && $this->request->get['type'] == "change_model"){
			echo $this->model_extension_product_extra->changeModel((int)$this->request->get['product_id'], $this->request->get['model']);
			die();
		}
		if(isset($this->request->get['type']) && $this->request->get['type'] == "change_name"){
			echo $this->model_extension_product_extra->changeName((int)$this->request->get['product_id'], $this->request->get['name'], $this->request->get['language']);
			die();
		}
		if(isset($this->request->get['type']) && $this->request->get['type'] == "change_meta_title"){
			echo $this->model_extension_product_extra->changeMetaTitle((int)$this->request->get['product_id'], $this->request->get['meta_title'], $this->request->get['language']);
			die();
		}

		if(isset($this->request->get['type']) && $this->request->get['type'] == "change_meta_keyword"){
			echo $this->model_extension_product_extra->changeMetaKeyword((int)$this->request->get['product_id'], $this->request->get['meta_keyword'], $this->request->get['language']);
			die();
		}
		if(isset($this->request->get['type']) && $this->request->get['type'] == "change_meta_description"){
			echo $this->model_extension_product_extra->changeMetaDescription((int)$this->request->get['product_id'], $this->request->get['meta_description'], $this->request->get['language']);
			die();
		}
		if(isset($this->request->get['type']) && $this->request->get['type'] == "change_weight"){
			echo $this->model_extension_product_extra->changeWeight((int)$this->request->get['product_id'], (float)$this->request->get['weight']);
			die();
		}
		if(isset($this->request->get['type']) && $this->request->get['type'] == "change_weight_class"){
			echo $this->model_extension_product_extra->changeWeightClass((int)$this->request->get['product_id'], (int)$this->request->get['weight_class_id']);
			die();
		}
		if(isset($this->request->get['type']) && $this->request->get['type'] == "change_image"){
			$this->model_extension_product_extra->changeImage((int)$this->request->get['product_id'], $this->request->get['image']);
			echo "done";
			die();
		}
		if(isset($this->request->get['type']) && $this->request->get['type'] == "change_length"){
			echo $this->model_extension_product_extra->changeLength((int)$this->request->get['product_id'], (float)$this->request->get['length']);
			die();
		}
		if(isset($this->request->get['type']) && $this->request->get['type'] == "change_width"){
			echo $this->model_extension_product_extra->changeWidth((int)$this->request->get['product_id'], (float)$this->request->get['width']);
			die();
		}
		if(isset($this->request->get['type']) && $this->request->get['type'] == "change_height"){
			echo $this->model_extension_product_extra->changeHeight((int)$this->request->get['product_id'], (float)$this->request->get['height']);
			die();
		}

		if(isset($this->request->get['type']) && $this->request->get['type'] == "change_ean"){
	        echo $this->model_extension_product_extra->changeEan((int)$this->request->get['product_id'], $this->request->get['ean']);
	        die();
		}
		if(isset($this->request->get['type']) && $this->request->get['type'] == "change_jan"){
	        echo $this->model_extension_product_extra->changeJan((int)$this->request->get['product_id'], $this->request->get['jan']);
	        die();
		}
		if(isset($this->request->get['type']) && $this->request->get['type'] == "change_mpn"){
	        echo $this->model_extension_product_extra->changeMpn((int)$this->request->get['product_id'], $this->request->get['mpn']);
	        die();
		}
		if(isset($this->request->get['type']) && $this->request->get['type'] == "change_isbn"){
	        echo $this->model_extension_product_extra->changeIsbn((int)$this->request->get['product_id'], $this->request->get['isbn']);
	        die();
		}
		
		if(!isset($this->session->data['product_language'])){
			$this->session->data['product_language'] = (int)$this->config->get('config_language_id');
		}
		if(isset($this->request->get['type']) && $this->request->get['type'] == "change_language"){
			if(isset($this->request->get['language'])){
				$this->session->data['product_language'] = (int)$this->request->get['language'];
			} else {
				$this->session->data['product_language'] = (int)$this->config->get('config_language_id');
			}
			//header('Location: '.str_replace("&amp;", "&", $_SERVER['HTTP_REFERER']));
			//die();
		}
		/*controller-hook-index*/

		if(isset($this->request->get['type']) && $this->request->get['type'] == "change_tags"){
			echo $this->model_extension_product_extra->changeTags((int)$this->request->get['product_id'], $this->request->get['tags'], $this->request->get['language']);
			die();
		}
		
		if(isset($this->request->get['type']) && $this->request->get['type'] == "featured_product"){
			echo $this->model_extension_product_extra->changeFeaturedProduct((int)$this->request->get['product_id']);
			die();
		}
		if(isset($this->request->get['type']) && $this->request->get['type'] == "change_special"){
			echo $this->model_extension_product_extra->changeProductSpecialPrice((int)$this->request->get['product_id'], (float)$this->request->get['price']);
			die();
		}
		if(isset($this->request->get['type']) && $this->request->get['type'] == "change_discount"){
			echo $this->model_extension_product_extra->changeProductDiscountPrice((int)$this->request->get['product_id'], (float)$this->request->get['price']);
			die();
		}

		if(isset($this->request->get['type']) && $this->request->get['type'] == "change_points"){
			echo $this->model_extension_product_extra->changePoints(
				(int)$this->request->get['product_id'], 
				$this->request->get['points']
			);
			die();
		}

		$this->load->language('catalog/product');
		$this->load->language('extension/product_extra');
    	
		$this->document->setTitle($this->language->get('heading_title')); 
		
		$this->getList();
  	}
	
	public function edit() {
		$this->load->language('catalog/product');
		$this->load->model('catalog/product');
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			if($this->request->get['product_id'] == -1){
				$this->default_product();
			}
			$this->model_catalog_product->editProduct($this->request->get['product_id'], $this->request->post);
			echo "OK";
		} else {
			echo "ERROR";
		}
	}
	
	public function add() {
		$this->load->language('catalog/product');
		$this->load->model('catalog/product');
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_catalog_product->addProduct($this->request->post);
			echo "OK";
		} else {
			echo "ERROR";
		}
	}
	
	public function default_product(){
		$this->load->model('extension/product_extra');
		$this->model_extension_product_extra->setDefaultProduct();
		//echo "DONE";
	}
	
	protected function validateForm() { 
		if (!$this->user->hasPermission('modify', 'catalog/product')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
	
		foreach ($this->request->post['product_description'] as $language_id => $value) {
			if ((utf8_strlen($value['name']) < 1) || (utf8_strlen($value['name']) > 255)) {
				$this->error['name'][$language_id] = $this->language->get('error_name');
			}
		}
			
		if ((utf8_strlen($this->request->post['model']) < 1) || (utf8_strlen($this->request->post['model']) > 64)) {
			$this->error['model'] = $this->language->get('error_model');
		}
			
		if ($this->error && !isset($this->error['warning'])) {
			$this->error['warning'] = $this->language->get('error_warning');
		}
						
		if (!$this->error) {
				return true;
		} else {
			return false;
		}
  	}
	
	private function specialPrices($product_id){
		$this->load->model('catalog/product');
		$this->load->model('extension/product_extra');
		$this->load->language('catalog/product');
		$this->load->language('extension/product_extra');
		$data['entry_customer_group'] = $this->language->get('entry_customer_group');
		$data['entry_quantity'] = $this->language->get('entry_quantity');
		$data['entry_minimum'] = $this->language->get('entry_minimum');
		$data['entry_priority'] = $this->language->get('entry_priority');
		$data['entry_price'] = $this->language->get('entry_price');
		$data['entry_date_start'] = $this->language->get('entry_date_start');
		$data['entry_date_end'] = $this->language->get('entry_date_end');
		$data['button_remove'] = $this->language->get('button_remove');
		$data['button_add_discount'] = $this->language->get('button_add_discount');
		$data['button_add_special'] = $this->language->get('button_add_special');
		$data['special_prices_dialog'] = $this->language->get('special_prices_dialog');
		$data['discounts_title'] = $this->language->get('discounts_title');
		$data['special_title'] = $this->language->get('special_title');
		
		$data['ad_button'] = $this->language->get('ad_button');
		
		if(isset($this->request->get['t'])){
			$data['t'] = $this->request->get['t'];
		} else {
			$data['t'] = 'discount';
		}
		//Fix for 2.0 and 2.1 where customer group has been moved to another directory
		if(is_file(DIR_APPLICATION.'/model/customer/customer_group.php')){ //v2.1+
			$this->load->model('customer/customer_group');
			$data['customer_groups'] = $this->model_customer_customer_group->getCustomerGroups();
		} else { //v2.0
			$this->load->model('sale/customer_group');
			$data['customer_groups'] = $this->model_sale_customer_group->getCustomerGroups();	
		}

		if (($this->request->server['REQUEST_METHOD'] == 'POST')) {
			$this->model_extension_product_extra->changeSpecialPrices((int)$product_id, $this->request->post);
		}
		if (isset($this->request->post['product_discount'])) {
			$data['product_discounts'] = $this->request->post['product_discount'];
		} elseif ((int)$product_id > 0) {
			$data['product_discounts'] = $this->model_catalog_product->getProductDiscounts((int)$product_id);
		} else {
			$data['product_discounts'] = array();
		}

		if (isset($this->request->post['product_special'])) {
			$data['product_specials'] = $this->request->post['product_special'];
		} elseif ((int)$product_id > 0) {
			$data['product_specials'] = $this->model_catalog_product->getProductSpecials((int)$product_id);
		} else {
			$data['product_specials'] = array();
		}
		
		$data['product_id'] = $product_id;

		$this->response->setOutput($this->load->view('extension/product_special_prices', $data));
	}
	
	protected function validateSpecialForm(){
		if (!$this->user->hasPermission('modify', 'extension/product_extra')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
	}
	
  	protected function getList() {

  		$image_width = 40;
  		$image_height = 40;

		$data['cookies'] = $_COOKIE;
		
		/*controller-hook-getList-start*/
		
		$this->load->model('setting/module');
		$modules = $this->model_setting_module->getModulesByCode('featured');
		$data['featured'] = [];
		if(isset($modules[0])){
			$module = $modules[0];
			$setting = json_decode($module['setting'], true);
			if (isset($setting['product'])) {
				$data['featured'] = (array)$setting['product'];
			}
		}

		$data['selected_language'] = isset($this->session->data['product_language'])?(int)$this->session->data['product_language']:(int)$this->config->get('config_language_id');
		if(isset($this->request->get['rows'])){
			$this->session->data['current_rows'] = (int)$this->request->get['rows'];
		}

		if(!isset($this->session->data['current_rows'])){
			$this->session->data['current_rows'] = $this->config->get('config_limit_admin');
		}
		
		if(isset($this->request->get['ajaxed'])){
			$data['ajaxed'] = true;
		}
		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}
		
		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'pd.name';
		}
		
		if (isset($this->request->get['order'])) {
			$order = $this->request->get['order'];
		} else {
			$order = 'ASC';
		}
		
		if (isset($this->request->get['filter_id'])) {
			$filter_id = $this->request->get['filter_id'];
		} else {
			$filter_id = NULL;
		}

		if (isset($this->request->get['filter_name'])) {
			$filter_name = $this->request->get['filter_name'];
		} else {
			$filter_name = NULL;
		}

		if (isset($this->request->get['filter_meta_title'])) {
			$filter_meta_title = $this->request->get['filter_meta_title'];
		} else {
			$filter_meta_title = NULL;
		}

		if (isset($this->request->get['filter_meta_keyword'])) {
			$filter_meta_keyword = $this->request->get['filter_meta_keyword'];
		} else {
			$filter_meta_keyword = NULL;
		}

		if (isset($this->request->get['filter_meta_description'])) {
			$filter_meta_description = $this->request->get['filter_meta_description'];
		} else {
			$filter_meta_description = NULL;
		}

		if (isset($this->request->get['filter_model'])) {
			$filter_model = $this->request->get['filter_model'];
		} else {
			$filter_model = NULL;
		}

		if (isset($this->request->get['filter_ean'])) {
		    $filter_ean = $this->request->get['filter_ean'];
		} else {
		    $filter_ean = NULL;
		}
		if (isset($this->request->get['filter_jan'])) {
		    $filter_jan = $this->request->get['filter_jan'];
		} else {
		    $filter_jan = NULL;
		}
		if (isset($this->request->get['filter_mpn'])) {
		    $filter_mpn = $this->request->get['filter_mpn'];
		} else {
		    $filter_mpn = NULL;
		}
		if (isset($this->request->get['filter_isbn'])) {
		    $filter_isbn = $this->request->get['filter_isbn'];
		} else {
		    $filter_isbn = NULL;
		}
		
		/*controller-hook-1*/

		if (isset($this->request->get['filter_points'])) {
			$filter_points = $this->request->get['filter_points'];
		} else {
			$filter_points = NULL;
		}

		if (isset($this->request->get['filter_quantity'])) {
			$filter_quantity = $this->request->get['filter_quantity'];
		} else {
			$filter_quantity = NULL;
		}

		if (isset($this->request->get['filter_minimum'])) {
			$filter_minimum = $this->request->get['filter_minimum'];
		} else {
			$filter_minimum = NULL;
		}
		
		if (isset($this->request->get['filter_weight'])) {
			$filter_weight = $this->request->get['filter_weight'];
		} else {
			$filter_weight = NULL;
		}
		
		if (isset($this->request->get['filter_sku'])) {
			$filter_sku = $this->request->get['filter_sku'];
		} else {
			$filter_sku = NULL;
		}
		if (isset($this->request->get['filter_upc'])) {
			$filter_upc = $this->request->get['filter_upc'];
		} else {
			$filter_upc = NULL;
		}
		
		if (isset($this->request->get['filter_location'])) {
			$filter_location = $this->request->get['filter_location'];
		} else {
			$filter_location = NULL;
		}
		if (isset($this->request->get['filter_date_available'])) {
			$filter_date_available = $this->request->get['filter_date_available'];
		} else {
			$filter_date_available = NULL;
		}

		if (isset($this->request->get['filter_status'])) {
			$filter_status = $this->request->get['filter_status'];
		} else {
			$filter_status = NULL;
		}

		if (isset($this->request->get['filter_subtract'])) {
			$filter_subtract = $this->request->get['filter_subtract'];
		} else {
			$filter_subtract = NULL;
		}

		if (isset($this->request->get['filter_shipping'])) {
			$filter_shipping = $this->request->get['filter_shipping'];
		} else {
			$filter_shipping = NULL;
		}
		
		if (isset($this->request->get['filter_category'])) {
			$filter_category = $this->request->get['filter_category'];
		} else {
			$filter_category = NULL;
		}

		if (isset($this->request->get['filter_filter'])) {
			$filter_filter = $this->request->get['filter_filter'];
		} else {
			$filter_filter = NULL;
		}
		
		if (isset($this->request->get['filter_manufacturer'])) {
			$filter_manufacturer = $this->request->get['filter_manufacturer'];
		} else {
			$filter_manufacturer = NULL;
		}
		
		if (isset($this->request->get['filter_stock_status'])) {
			$filter_stock_status = $this->request->get['filter_stock_status'];
		} else {
			$filter_stock_status = NULL;
		}
		
		if (isset($this->request->get['filter_tax_class'])) {
			$filter_tax_class = $this->request->get['filter_tax_class'];
		} else {
			$filter_tax_class = NULL;
		}
		
		if (isset($this->request->get['filter_length_class'])) {
			$filter_length_class = $this->request->get['filter_length_class'];
		} else {
			$filter_length_class = NULL;
		}
		
		if (isset($this->request->get['filter_weight_class'])) {
			$filter_weight_class = $this->request->get['filter_weight_class'];
		} else {
			$filter_weight_class = NULL;
		}
		
		if (isset($this->request->get['filter_store'])) {
			$filter_store = $this->request->get['filter_store'];
		} else {
			$filter_store = NULL;
		}
		
		if (isset($this->request->get['filter_price'])) {
			$filter_price = $this->request->get['filter_price'];
		} else {
			$filter_price = NULL;
		}
		if (isset($this->request->get['filter_sort_order'])) {
			$filter_sort_order = $this->request->get['filter_sort_order'];
		} else {
			$filter_sort_order = NULL;
		}
		
		$url = '';
						
		if (isset($this->request->get['filter_id'])) {
			$url .= '&filter_id=' . urlencode($this->request->get['filter_id']);
		}
		
		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . urlencode($this->request->get['filter_name']);
		}

		if (isset($this->request->get['filter_meta_title'])) {
			$url .= '&filter_meta_title=' . urlencode($this->request->get['filter_meta_title']);
		}

		if (isset($this->request->get['filter_meta_keyword'])) {
			$url .= '&filter_meta_keyword=' . urlencode($this->request->get['filter_meta_keyword']);
		}

		if (isset($this->request->get['filter_meta_description'])) {
			$url .= '&filter_meta_description=' . urlencode($this->request->get['filter_meta_description']);
		}
		
		if (isset($this->request->get['filter_model'])) {
			$url .= '&filter_model=' . urlencode($this->request->get['filter_model']);
		}

		if (isset($this->request->get['filter_ean'])) {
		    $url .= '&filter_ean=' . urlencode($this->request->get['filter_ean']);
		}
		if (isset($this->request->get['filter_jan'])) {
		    $url .= '&filter_jan=' . urlencode($this->request->get['filter_jan']);
		}
		if (isset($this->request->get['filter_mpn'])) {
		    $url .= '&filter_mpn=' . urlencode($this->request->get['filter_mpn']);
		}
		if (isset($this->request->get['filter_isbn'])) {
		    $url .= '&filter_isbn=' . urlencode($this->request->get['filter_isbn']);
		}

		/*controller-hook-2*/

		if (isset($this->request->get['filter_points'])) {
			$url .= '&filter_points=' . $this->request->get['filter_points'];
		}

		if (isset($this->request->get['filter_quantity'])) {
			$url .= '&filter_quantity=' . urlencode($this->request->get['filter_quantity']);
		}
		if (isset($this->request->get['filter_minimum'])) {
			$url .= '&filter_minimum=' . urlencode($this->request->get['filter_minimum']);
		}
		
		if (isset($this->request->get['filter_weight'])) {
			$url .= '&filter_weight=' . urlencode($this->request->get['filter_weight']);
		}
		
		if (isset($this->request->get['filter_sku'])) {
			$url .= '&filter_sku=' . urlencode($this->request->get['filter_sku']);
		}
		if (isset($this->request->get['filter_upc'])) {
			$url .= '&filter_upc=' . urlencode($this->request->get['filter_upc']);
		}
		
		if (isset($this->request->get['filter_location'])) {
			$url .= '&filter_location=' . urlencode($this->request->get['filter_location']);
		}
		if (isset($this->request->get['filter_date_available'])) {
			$url .= '&filter_date_available=' . urlencode($this->request->get['filter_date_available']);
		}
		
		if (isset($this->request->get['filter_price'])) {
			$url .= '&filter_price=' . urlencode($this->request->get['filter_price']);
		}
		if (isset($this->request->get['filter_sort_order'])) {
			$url .= '&filter_sort_order=' . urlencode($this->request->get['filter_sort_order']);
		}
		if (isset($this->request->get['filter_category'])) {
			$url .= '&filter_category=' . urlencode($this->request->get['filter_category']);
		}

		if (isset($this->request->get['filter_filter'])) {
			$url .= '&filter_filter=' . urlencode($this->request->get['filter_filter']);
		}
		
		if (isset($this->request->get['filter_manufacturer'])) {
			$url .= '&filter_manufacturer=' . urlencode($this->request->get['filter_manufacturer']);
		}
		
		if (isset($this->request->get['filter_stock_status'])) {
			$url .= '&filter_stock_status=' . urlencode($this->request->get['filter_stock_status']);
		}
		
		if (isset($this->request->get['filter_tax_class'])) {
			$url .= '&filter_tax_class=' . urlencode($this->request->get['filter_tax_class']);
		}
		
		if (isset($this->request->get['filter_length_class'])) {
			$url .= '&filter_length_class=' . urlencode($this->request->get['filter_length_class']);
		}
		
		if (isset($this->request->get['filter_weight_class'])) {
			$url .= '&filter_weight_class=' . urlencode($this->request->get['filter_weight_class']);
		}
		
		if (isset($this->request->get['filter_store'])) {
			$url .= '&filter_store=' . urlencode($this->request->get['filter_store']);
		}

		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status=' . urlencode($this->request->get['filter_status']);
		}
		
		if (isset($this->request->get['filter_subtract'])) {
			$url .= '&filter_subtract=' . urlencode($this->request->get['filter_subtract']);
		}

		if (isset($this->request->get['filter_shipping'])) {
			$url .= '&filter_shipping=' . urlencode($this->request->get['filter_shipping']);
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . urlencode($this->request->get['page']);
		}
		
		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . urlencode($this->request->get['sort']);
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . urlencode($this->request->get['order']);
		}

  		$data['breadcrumbs'] = array();

   		$data['breadcrumbs'][] = array(
			'href'      => 'index.php?route=common/home&user_token=' . $this->session->data['user_token'],
			'text'      => $this->language->get('text_home'),
			'separator' => FALSE
   		);

   		$data['breadcrumbs'][] = array(
			'href'      => 'index.php?route=catalog/product&user_token=' . $this->session->data['user_token'] . $url,
			'text'      => $this->language->get('heading_title'),
			'separator' => ' :: '
   		);
		
		$data['insert'] = 'index.php?route=catalog/product/add&user_token=' . $this->session->data['user_token'] . $url;
		$data['copy'] = 'index.php?route=catalog/product/copy&user_token=' . $this->session->data['user_token'] . $url;	
		$data['delete'] = 'index.php?route=catalog/product/delete&user_token=' . $this->session->data['user_token'] . $url;
    	
		$data['products'] = array();

		$filter_data = array(
			'filter_id'	  	=> $filter_id,
			'filter_name'	  	=> $filter_name, 
			'filter_meta_title'	=> $filter_meta_title, 
			'filter_meta_keyword'	=> $filter_meta_keyword, 
			'filter_meta_description'	=> $filter_meta_description, 
			'filter_model'	  	=> $filter_model,
			'filter_ean'        => $filter_ean,
			'filter_jan'        => $filter_jan,
			'filter_mpn'        => $filter_mpn,
			'filter_isbn'       => $filter_isbn,
			/*controller-hook-3*/
			'filter_points'     => $filter_points,
			'filter_quantity' 	=> $filter_quantity,
			'filter_minimum' 	=> $filter_minimum,
			'filter_weight' 	=> $filter_weight,
			'filter_sku' 		=> $filter_sku,
			'filter_upc'        => $filter_upc,
			
			'filter_location'   => $filter_location,
			'filter_date_available'    => $filter_date_available,
			'filter_status'   	=> $filter_status,
			'filter_subtract'   	=> $filter_subtract,
			'filter_shipping'   	=> $filter_shipping,
			'filter_category' 	=> $filter_category,
			'filter_filter' 	=> $filter_filter,
			'filter_manufacturer' 	=> $filter_manufacturer,
			'filter_stock_status' 	=> $filter_stock_status,
			'filter_tax_class' 	=> $filter_tax_class,
			'filter_length_class' 	=> $filter_length_class,
			'filter_weight_class' 	=> $filter_weight_class,
			'filter_store'    	=> $filter_store,
			'filter_price'    	=> $filter_price,
			'filter_sort_order'    	=> $filter_sort_order,

			'sort'            	=> $sort,
			'order'           	=> $order,
			'start'           	=> ($page - 1) * $this->session->data['current_rows'],//$this->config->get('config_admin_limit'),
			'limit'           	=> $this->session->data['current_rows']//$this->config->get('config_admin_limit')
		);
		
		$this->load->model('tool/image');

		$product_total = $this->model_extension_product_extra->getTotalProducts($filter_data);
		
		$results = $this->model_extension_product_extra->getProducts($filter_data, (isset($this->session->data['product_language'])?$this->session->data['product_language']:$this->config->get('config_language_id')));
		//Get categories
		$this->load->model('catalog/category');
		$list_categories = array();
		$categories = $this->model_catalog_category->getCategories(0);
		foreach($categories as $category){
			$list_categories[$category['category_id']] = $category['name'];
		}
		asort($list_categories);
		$data['categories'] = $list_categories;

		//Get filters
		$this->load->model('catalog/filter');
		$list_filters = array();
		$filters = $this->model_catalog_filter->getFilters(0);
		foreach($filters as $filter){
			$list_filters[$filter['filter_id']] = $filter['group'] . ' > ' . $filter['name'];
		}
		asort($list_filters);
		$data['filters'] = $list_filters;
		
		$list_manufacturers = $this->model_extension_product_extra->getManufacturers();
		$data['manufacturers'] = $list_manufacturers;
		
		/*controller-hook-9*/
		$data['discount_price_column_switch'] = $this->language->get('discount_price_column_switch');
		$data['special_price_column_switch'] = $this->language->get('special_price_column_switch');
		$data['max_priority'] = $this->language->get('max_priority');
		
		$list_stock_statuses = $this->model_extension_product_extra->getStockStatuses($data['selected_language']);
		$data['stock_statuses'] = $list_stock_statuses;
		
		$list_weight_classes = $this->model_extension_product_extra->getWeightClasses($data['selected_language']);
		$data['weight_classes'] = $list_weight_classes;
		
		$list_tax_classes = $this->model_extension_product_extra->getTaxClasses();
		$data['tax_classes'] = $list_tax_classes;
		
		$list_length_classes = $this->model_extension_product_extra->getLengthClasses($data['selected_language']);
		$data['length_classes'] = $list_length_classes;
			
		//Get stores
		$data['text_default'] = $this->language->get('text_default');
		$this->load->model('setting/store');
		$data['stores'] = $this->model_setting_store->getStores();
		$data['url'] = HTTP_SERVER;
		$data['admin_root_url'] = HTTP_SERVER;
		
		$data['edit_link'] = $this->language->get('text_edit');
		$data['edit_desc'] = $this->language->get('text_edit_desctiption');
		$data['link'] = 'index.php?route=extension/product_extra&user_token=' . $this->session->data['user_token'];
		
		$default_customer_group = $this->config->get('config_customer_group_id');
		
		$data['no_image'] = $this->model_tool_image->resize('no_image.jpg', $image_width, $image_height);
		$data['placeholder'] = $this->model_tool_image->resize('no_image.png', $image_width, $image_height);
		foreach ($results as $result) {
			$action = array();
			
			$action[] = array(
				'text' => $this->language->get('text_edit'),
				'href' => 'index.php?route=catalog/product/edit&user_token=' . $this->session->data['user_token'] . '&product_id=' . $result['product_id'] . $url
			);
			
			if ($result['image'] && file_exists(DIR_IMAGE . $result['image'])) {
				$image = $this->model_tool_image->resize($result['image'], $image_width, $image_height);
			} else {
				$image = $data['placeholder'];
			}
			
			$final_price = $this->model_extension_product_extra->getFinalPrice($result['product_id'], $result['price'], $default_customer_group);
			if($final_price != ''){
				$final_price = array($final_price, $this->tax->calculate($final_price, $result['tax_class_id'], $this->config->get('config_tax')));
			} else {
				$final_price = array($result['price'], $this->tax->calculate($result['price'], $result['tax_class_id'], $this->config->get('config_tax')));
			}
			$data['products'][] = array(
				'product_id' => $result['product_id'],
				'name'       => $result['name'],
				'meta_title' => $result['meta_title'],
				'meta_keyword' => $result['meta_keyword'],
				'meta_description' => $result['meta_description'],
				'model'      => $result['model'],
				'ean'        => $result['ean'],
				'jan'        => $result['jan'],
				'mpn'        => $result['mpn'],
				'isbn'       => $result['isbn'],
				/*controller-hook-4*/
				'points'     => $result['points'],
				'special_price'=>$this->model_extension_product_extra->getMaxSpecialPrice($result['product_id']),
				'discount_price'=>$this->model_extension_product_extra->getMaxDiscountPrice($result['product_id']),
				'tags'	     => $result['tag'],
				'image'      => $image,
				'quantity'   => $result['quantity'],
				'minimum'    => $result['minimum'],
				'sku' 	     => $result['sku'],
				'upc' 	     => $result['upc'],
				
				'location' 	     => $result['location'],
				'date_available' 	     => $result['date_available'],
				'keyword'    => $this->model_extension_product_extra->getAlias($result['product_id'], (isset($this->session->data['product_language'])?$this->session->data['product_language']:$this->config->get('config_language_id'))),
				'status'     => ($result['status'] ? $this->language->get('text_enabled') : $this->language->get('text_disabled')),
				'status_int' => $result['status'],
				'subtract'     => ($result['subtract'] ? $this->language->get('text_yes') : $this->language->get('text_no')),
				'subtract_int' => $result['subtract'],
				'shipping'     => ($result['shipping'] ? $this->language->get('text_yes') : $this->language->get('text_no')),
				'shipping_int' => $result['shipping'],
				'selected'   => isset($this->request->post['selected']) && in_array($result['product_id'], $this->request->post['selected']),
				'action'     => 'index.php?route=catalog/product/edit&user_token=' . $this->session->data['user_token'] . '&product_id=' . $result['product_id'] . $url,
				'stores'     => $this->model_extension_product_extra->getProductStores($result['product_id']),
				'categories' => $this->model_extension_product_extra->getProductCategories($result['product_id']),
				'filters' => $this->model_extension_product_extra->getProductFilters($result['product_id']),
				'hasSpecial' => $this->model_extension_product_extra->hasSpecial($result['product_id']),
				'hasDiscount' => $this->model_extension_product_extra->hasDiscount($result['product_id']),
				'price'      => $result['price'],
				'frontend_price'      => $final_price,
				'sort_order'      => $result['sort_order'],
				'manufacturer_id'      => $result['manufacturer_id'],
				'descriptions'=>$this->model_extension_product_extra->getDescriptions($result['product_id']),
				'weight'   => $result['weight'],
				'weight_class_id'   => $result['weight_class_id'],
				'tax_class_id'   => $result['tax_class_id'],
				'stock_status_id'   => $result['stock_status_id'],
				'length'   => $result['length'],
				'width'   => $result['width'],
				'height'   => $result['height'],
				'length_class_id'   => $result['length_class_id'],
			);
		}
		
		$data['heading_title'] = $this->language->get('heading_title');
		
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_yes'] = $this->language->get('text_yes');
		$data['text_no'] = $this->language->get('text_no');
		$data['text_no_results'] = $this->language->get('text_no_results');
		$data['text_image_manager'] = $this->language->get('text_image_manager');
		$data['extra_warning'] = $this->language->get('extra_warning');
		$data['special_link'] = $this->language->get('special_link');
		$data['copy_default_product'] = $this->language->get('copy_default_product');
		$data['copy_default_product_title'] = $this->language->get('copy_default_product_title');
		$data['edit_default_product'] = $this->language->get('edit_default_product');
		$data['edit_default_product_title'] = $this->language->get('edit_default_product_title');
		$data['column_meta_title'] = $this->language->get('column_meta_title');
		$data['column_meta_keyword'] = $this->language->get('column_meta_keyword');
		$data['column_meta_description'] = $this->language->get('column_meta_description');

		$data['column_image'] = $this->language->get('column_image');
		$data['column_name'] = $this->language->get('column_name');
		$data['column_model'] = $this->language->get('column_model');
		$data['column_quantity'] = $this->language->get('column_quantity');
		$data['column_minimum'] = $this->language->get('column_minimum');
		$data['column_sku'] = $this->language->get('column_sku');
		$data['column_upc'] = $this->language->get('column_upc');
		$data['column_points'] = $this->language->get('column_points');
		$data['column_ean'] = $this->language->get('column_ean');
		$data['column_jan'] = $this->language->get('column_jan');
		$data['column_mpn'] = $this->language->get('column_mpn');
		$data['column_isbn'] = $this->language->get('column_isbn');
		$data['column_location'] = $this->language->get('column_location');
		$data['column_date_available'] = $this->language->get('column_date_available');
		
		$data['column_status'] = $this->language->get('column_status');
		$data['column_subtract'] = $this->language->get('column_subtract');
		$data['column_shipping'] = $this->language->get('column_shipping');
		$data['column_action'] = $this->language->get('column_action');
		$data['column_store'] = $this->language->get('column_store');
		$data['column_category'] = $this->language->get('column_category');
		$data['column_filter'] = $this->language->get('column_filter');
		$data['column_price'] = $this->language->get('column_price');
		$data['column_sort_order'] = $this->language->get('column_sort_order');
		$data['column_manufacturer'] = $this->language->get('column_manufacturer');
		$data['frontend_price_gross'] = $this->language->get('frontend_price_gross');
		$data['frontend_price_net'] = $this->language->get('frontend_price_net');
		$data['rows_in_table'] = $this->language->get('rows_in_table');
		
		$data['button_copy'] = $this->language->get('button_copy');
		$data['button_insert'] = $this->language->get('button_insert');
		$data['select_no_tax'] = $this->language->get('select_no_tax');
		$data['button_delete'] = $this->language->get('button_delete');
		$data['button_filter'] = $this->language->get('button_filter');
		$data['s_button'] = $this->language->get('s_button');
		$data['c_button'] = $this->language->get('c_button');
		$data['saved'] =  $this->language->get('saved');
		$data['discount_link'] =  $this->language->get('discount_link');
		$data['frontend_price'] =  $this->language->get('frontend_price');
		
		$data['image_column_switch'] = $this->language->get('image_column_switch');
		$data['product_column_switch'] = $this->language->get('product_column_switch');
		$data['model_column_switch'] = $this->language->get('model_column_switch');
		$data['category_column_switch'] = $this->language->get('category_column_switch');
		$data['filter_column_switch'] = $this->language->get('filter_column_switch');
		$data['manufacturer_column_switch'] = $this->language->get('manufacturer_column_switch');
		$data['stores_column_switch'] = $this->language->get('stores_column_switch');
		$data['price_column_switch'] = $this->language->get('price_column_switch');
		$data['qty_column_switch'] = $this->language->get('qty_column_switch');
		$data['minimum_column_switch'] = $this->language->get('minimum_column_switch');
		$data['status_column_switch'] = $this->language->get('status_column_switch');
		$data['subtract_column_switch'] = $this->language->get('subtract_column_switch');
		$data['shipping_column_switch'] = $this->language->get('shipping_column_switch');
		$data['order_column_switch'] = $this->language->get('order_column_switch');
		$data['frontend_price_column_switch'] = $this->language->get('frontend_price_column_switch');
		$data['discounts_column_switch'] = $this->language->get('discounts_column_switch');
		$data['specials_column_switch'] = $this->language->get('specials_column_switch');
		$data['sku_column_switch'] = $this->language->get('sku_column_switch');
		$data['upc_column_switch'] = $this->language->get('upc_column_switch');
		$data['featured_column_switch'] = $this->language->get('featured_column_switch');
		$data['tags_column_switch'] = $this->language->get('tags_column_switch');
		$data['ean_column_switch'] = $this->language->get('ean_column_switch');
		$data['jan_column_switch'] = $this->language->get('jan_column_switch');
		$data['mpn_column_switch'] = $this->language->get('mpn_column_switch');
		$data['isbn_column_switch'] = $this->language->get('isbn_column_switch');
		$data['location_column_switch'] = $this->language->get('location_column_switch');
		$data['date_available_column_switch'] = $this->language->get('date_available_column_switch');
		$data['seo_column_switch'] = $this->language->get('seo_column_switch');
		$data['seo_column'] = $this->language->get('seo_column');
		$data['edit_column_switch'] = $this->language->get('edit_column_switch');
		$data['column_switch'] = $this->language->get('column_switch');
		$data['text_product_manager'] = $this->language->get('text_product_manager');
		$data['edit_column_popup_switch'] = $this->language->get('edit_column_popup_switch');
		$data['edit_desc_column_switch'] = $this->language->get('edit_desc_column_switch');
		$data['view_column_switch'] = $this->language->get('view_column_switch');
		$data['settings_switch'] = $this->language->get('settings_switch');
		$data['remove_auto_redirect'] = $this->language->get('remove_auto_redirect');
		$data['remove_delete_confirm'] = $this->language->get('remove_delete_confirm');
		$data['product_meta_title_switch'] = $this->language->get('product_meta_title_switch');
		$data['product_meta_keyword_switch'] = $this->language->get('product_meta_keyword_switch');
		$data['product_meta_description_switch'] = $this->language->get('product_meta_description_switch');
		
		$data['weight_column_switch'] = $this->language->get('weight_column_switch');
		$data['weight_class_column_switch'] = $this->language->get('weight_class_column_switch');
		$data['tax_class_column_switch'] = $this->language->get('tax_class_column_switch');
		$data['out_of_stock_column_switch'] = $this->language->get('out_of_stock_column_switch');
		$data['out_of_stock_column'] = $this->language->get('out_of_stock_column');
		$data['dimensions_column_switch'] = $this->language->get('dimensions_column_switch');
		$data['length_class_column_switch'] = $this->language->get('length_class_column_switch');
		
		$data['width_text'] = $this->language->get('width_text');
		$data['height_text'] = $this->language->get('height_text');
		$data['length_text'] = $this->language->get('length_text');
		$data['id_text'] = $this->language->get('id_text');
		$data['all_text'] = $this->language->get('all_text');
		$data['store_frontend_text'] = $this->language->get('store_frontend_text');
 
 		$data['user_token'] = $this->session->data['user_token'];
		
 		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];
		
			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}

		$url = '';

		if (isset($this->request->get['filter_id'])) {
			$url .= '&filter_id=' . $this->request->get['filter_id'];
		}
		
		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . urlencode($this->request->get['filter_name']);
		}

		if (isset($this->request->get['filter_meta_title'])) {
			$url .= '&filter_meta_title=' . urlencode($this->request->get['filter_meta_title']);
		}

		if (isset($this->request->get['filter_meta_keyword'])) {
			$url .= '&filter_meta_keyword=' . urlencode($this->request->get['filter_meta_keyword']);
		}

		if (isset($this->request->get['filter_meta_description'])) {
			$url .= '&filter_meta_description=' . urlencode($this->request->get['filter_meta_description']);
		}
		
		if (isset($this->request->get['filter_model'])) {
			$url .= '&filter_model=' . $this->request->get['filter_model'];
		}

		if (isset($this->request->get['filter_ean'])) {
		    $url .= '&filter_ean=' . $this->request->get['filter_ean'];
		}
		if (isset($this->request->get['filter_jan'])) {
		    $url .= '&filter_jan=' . $this->request->get['filter_jan'];
		}
		if (isset($this->request->get['filter_mpn'])) {
		    $url .= '&filter_mpn=' . $this->request->get['filter_mpn'];
		}
		if (isset($this->request->get['filter_isbn'])) {
		    $url .= '&filter_isbn=' . $this->request->get['filter_isbn'];
		}

		/*controller-hook-5*/

		if (isset($this->request->get['filter_points'])) {
			$url .= '&filter_points=' . $this->request->get['filter_points'];
		}

		if (isset($this->request->get['filter_quantity'])) {
			$url .= '&filter_quantity=' . $this->request->get['filter_quantity'];
		}

		if (isset($this->request->get['filter_minimum'])) {
			$url .= '&filter_minimum=' . $this->request->get['filter_minimum'];
		}
		
		if (isset($this->request->get['filter_weight'])) {
			$url .= '&filter_weight=' . $this->request->get['filter_weight'];
		}
		
		if (isset($this->request->get['filter_sku'])) {
			$url .= '&filter_sku=' . $this->request->get['filter_sku'];
		}
		if (isset($this->request->get['filter_upc'])) {
			$url .= '&filter_upc=' . $this->request->get['filter_upc'];
		}
		
		if (isset($this->request->get['filter_location'])) {
			$url .= '&filter_location=' . $this->request->get['filter_location'];
		}
		if (isset($this->request->get['filter_date_available'])) {
			$url .= '&filter_date_available=' . $this->request->get['filter_date_available'];
		}
		
		if (isset($this->request->get['filter_category'])) {
			$url .= '&filter_category=' . $this->request->get['filter_category'];
		}

		if (isset($this->request->get['filter_filter'])) {
			$url .= '&filter_filter=' . $this->request->get['filter_filter'];
		}
		
		if (isset($this->request->get['filter_manufacturer'])) {
			$url .= '&filter_manufacturer=' . $this->request->get['filter_manufacturer'];
		}
		
		if (isset($this->request->get['filter_stock_status'])) {
			$url .= '&filter_stock_status=' . $this->request->get['filter_stock_status'];
		}
		
		if (isset($this->request->get['filter_weight_class'])) {
			$url .= '&filter_weight_class=' . $this->request->get['filter_weight_class'];
		}
		
		if (isset($this->request->get['filter_tax_class'])) {
			$url .= '&filter_tax_class=' . $this->request->get['filter_tax_class'];
		}
		
		if (isset($this->request->get['filter_length_class'])) {
			$url .= '&filter_length_class=' . $this->request->get['filter_length_class'];
		}
		
		if (isset($this->request->get['filter_store'])) {
			$url .= '&filter_store=' . $this->request->get['filter_store'];
		}
		
		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status=' . $this->request->get['filter_status'];
		}
		if (isset($this->request->get['filter_subtract'])) {
			$url .= '&filter_subtract=' . $this->request->get['filter_subtract'];
		}
		if (isset($this->request->get['filter_shipping'])) {
			$url .= '&filter_shipping=' . $this->request->get['filter_shipping'];
		}
		if (isset($this->request->get['filter_price'])) {
			$url .= '&filter_price=' . $this->request->get['filter_price'];
		}
		if (isset($this->request->get['filter_sort_order'])) {
			$url .= '&filter_sort_order=' . $this->request->get['filter_sort_order'];
		}						
		if ($order == 'ASC') {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}
					
		$data['sort_id'] = 'index.php?route=extension/product_extra&user_token=' . $this->session->data['user_token'] . '&sort=p.product_id' . $url;
		$data['sort_name'] = 'index.php?route=extension/product_extra&user_token=' . $this->session->data['user_token'] . '&sort=pd.name' . $url;
		$data['sort_meta_title'] = 'index.php?route=extension/product_extra&user_token=' . $this->session->data['user_token'] . '&sort=pd.meta_title' . $url;
		$data['sort_meta_keyword'] = 'index.php?route=extension/product_extra&user_token=' . $this->session->data['user_token'] . '&sort=pd.meta_keyword' . $url;
		$data['sort_meta_description'] = 'index.php?route=extension/product_extra&user_token=' . $this->session->data['user_token'] . '&sort=pd.sort_meta_description' . $url;
		$data['sort_model'] = 'index.php?route=extension/product_extra&user_token=' . $this->session->data['user_token'] . '&sort=p.model' . $url;
		$data['sort_ean'] = 'index.php?route=extension/product_extra&user_token=' . $this->session->data['user_token'] . '&sort=p.ean' . $url;
		$data['sort_jan'] = 'index.php?route=extension/product_extra&user_token=' . $this->session->data['user_token'] . '&sort=p.jan' . $url;
		$data['sort_mpn'] = 'index.php?route=extension/product_extra&user_token=' . $this->session->data['user_token'] . '&sort=p.mpn' . $url;
		$data['sort_isbn'] = 'index.php?route=extension/product_extra&user_token=' . $this->session->data['user_token'] . '&sort=p.isbn' . $url;
		/*controller-hook-6*/
		$data['sort_points'] = 'index.php?route=extension/product_extra&user_token=' . $this->session->data['user_token'] . '&sort=p.points' . $url;
		$data['sort_quantity'] = 'index.php?route=extension/product_extra&user_token=' . $this->session->data['user_token'] . '&sort=p.quantity' . $url;
		$data['sort_minimum'] = 'index.php?route=extension/product_extra&user_token=' . $this->session->data['user_token'] . '&sort=p.minimum' . $url;
		$data['sort_weight'] = 'index.php?route=extension/product_extra&user_token=' . $this->session->data['user_token'] . '&sort=p.weight' . $url;
		$data['sort_status'] = 'index.php?route=extension/product_extra&user_token=' . $this->session->data['user_token'] . '&sort=p.status' . $url;
		$data['sort_subtract'] = 'index.php?route=extension/product_extra&user_token=' . $this->session->data['user_token'] . '&sort=p.subtract' . $url;
		$data['sort_shipping'] = 'index.php?route=extension/product_extra&user_token=' . $this->session->data['user_token'] . '&sort=p.shipping' . $url;
		$data['sort_sku'] = 'index.php?route=extension/product_extra&user_token=' . $this->session->data['user_token'] . '&sort=p.sku' . $url;
		$data['sort_upc'] = 'index.php?route=extension/product_extra&user_token=' . $this->session->data['user_token'] . '&sort=p.upc' . $url;
		
		$data['sort_location'] = 'index.php?route=extension/product_extra&user_token=' . $this->session->data['user_token'] . '&sort=p.location' . $url;
		$data['sort_date_available'] = 'index.php?route=extension/product_extra&user_token=' . $this->session->data['user_token'] . '&sort=p.date_available' . $url;
		$data['sort_order'] = 'index.php?route=extension/product_extra&user_token=' . $this->session->data['user_token'] . '&sort=p.sort_order' . $url;
		$data['sort_price'] = 'index.php?route=extension/product_extra&user_token=' . $this->session->data['user_token'] . '&sort=p.price' . $url;
		$data['sort_sort_order'] = 'index.php?route=extension/product_extra&user_token=' . $this->session->data['user_token'] . '&sort=p.sort_order' . $url;
		$data['sort_manufacturer'] = 'index.php?route=extension/product_extra&user_token=' . $this->session->data['user_token'] . '&sort=m.name' . $url;
		$data['sort_tax_class'] = 'index.php?route=extension/product_extra&user_token=' . $this->session->data['user_token'] . '&sort=tc.title' . $url;
		
		$url = '';
		
		if (isset($this->request->get['filter_id'])) {
			$url .= '&filter_id=' . $this->request->get['filter_id'];
		}

		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . urlencode($this->request->get['filter_name']);
		}

		if (isset($this->request->get['filter_meta_title'])) {
			$url .= '&filter_meta_title=' . urlencode($this->request->get['filter_meta_title']);
		}

		if (isset($this->request->get['filter_meta_keyword'])) {
			$url .= '&filter_meta_keyword=' . urlencode($this->request->get['filter_meta_keyword']);
		}

		if (isset($this->request->get['filter_meta_description'])) {
			$url .= '&filter_meta_description=' . urlencode($this->request->get['filter_meta_description']);
		}
		
		if (isset($this->request->get['filter_model'])) {
			$url .= '&filter_model=' . urlencode($this->request->get['filter_model']);
		}

		if (isset($this->request->get['filter_ean'])) {
		    $url .= '&filter_ean=' . urlencode($this->request->get['filter_ean']);
		}
		if (isset($this->request->get['filter_jan'])) {
		    $url .= '&filter_jan=' . urlencode($this->request->get['filter_jan']);
		}
		if (isset($this->request->get['filter_mpn'])) {
		    $url .= '&filter_mpn=' . urlencode($this->request->get['filter_mpn']);
		}
		if (isset($this->request->get['filter_isbn'])) {
		    $url .= '&filter_isbn=' . urlencode($this->request->get['filter_isbn']);
		}

		/*controller-hook-7*/

		if (isset($this->request->get['filter_points'])) {
			$url .= '&filter_points=' . $this->request->get['filter_points'];
		}

		if (isset($this->request->get['filter_quantity'])) {
			$url .= '&filter_quantity=' . urlencode($this->request->get['filter_quantity']);
		}

		if (isset($this->request->get['filter_minimum'])) {
			$url .= '&filter_minimum=' . urlencode($this->request->get['filter_minimum']);
		}
		
		if (isset($this->request->get['filter_weight'])) {
			$url .= '&filter_weight=' . urlencode($this->request->get['filter_weight']);
		}
		
		if (isset($this->request->get['filter_sku'])) {
			$url .= '&filter_sku=' . urlencode($this->request->get['filter_sku']);
		}
		if (isset($this->request->get['filter_upc'])) {
			$url .= '&filter_upc=' . urlencode($this->request->get['filter_upc']);
		}
		
		if (isset($this->request->get['filter_location'])) {
			$url .= '&filter_location=' . urlencode($this->request->get['filter_location']);
		}
		if (isset($this->request->get['filter_date_available'])) {
			$url .= '&filter_date_available=' . urlencode($this->request->get['filter_date_available']);
		}
		
		if (isset($this->request->get['filter_price'])) {
			$url .= '&filter_price=' . urlencode($this->request->get['filter_price']);
		}
		
		if (isset($this->request->get['filter_sort_order'])) {
			$url .= '&filter_sort_order=' . urlencode($this->request->get['filter_sort_order']);
		}
		
		if (isset($this->request->get['filter_category'])) {
			$url .= '&filter_category=' . urlencode($this->request->get['filter_category']);
		}

		if (isset($this->request->get['filter_filter'])) {
			$url .= '&filter_filter=' . urlencode($this->request->get['filter_filter']);
		}
		
		if (isset($this->request->get['filter_manufacturer'])) {
			$url .= '&filter_manufacturer=' . urlencode($this->request->get['filter_manufacturer']);
		}
		
		if (isset($this->request->get['filter_stock_status'])) {
			$url .= '&filter_stock_status=' . urlencode($this->request->get['filter_stock_status']);
		}
		
		if (isset($this->request->get['filter_tax_class'])) {
			$url .= '&filter_tax_class=' . urlencode($this->request->get['filter_tax_class']);
		}
		
		if (isset($this->request->get['filter_length_class'])) {
			$url .= '&filter_length_class=' . urlencode($this->request->get['filter_length_class']);
		}
		
		if (isset($this->request->get['filter_weight_class'])) {
			$url .= '&filter_weight_class=' . urlencode($this->request->get['filter_weight_class']);
		}
		
		if (isset($this->request->get['filter_store'])) {
			$url .= '&filter_store=' . urlencode($this->request->get['filter_store']);
		}
		
		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status=' . urlencode($this->request->get['filter_status']);
		}
		if (isset($this->request->get['filter_subtract'])) {
			$url .= '&filter_subtract=' . urlencode($this->request->get['filter_subtract']);
		}
		if (isset($this->request->get['filter_shipping'])) {
			$url .= '&filter_shipping=' . urlencode($this->request->get['filter_shipping']);
		}

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . urlencode($this->request->get['sort']);
		}
												
		if (isset($this->request->get['order'])) {
			$url .= '&order=' . urlencode($this->request->get['order']);
		}
				
		$pagination = new Pagination();
		$pagination->total = $product_total;
		$pagination->limit = $this->session->data['current_rows'];//$this->config->get('config_limit_admin');
		$pagination->page = $page;
		//$pagination->url = $this->url->link('extension/product_extra', 'token=' . $this->session->data['user_token'] . $url . '&page={page}', 'SSL');
		$pagination->url = 'index.php?route=extension/product_extra&user_token=' . $this->session->data['user_token'] . $url . '&page={page}';

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf(
			$this->language->get('text_pagination'), 
			($product_total) ? 
				(($page - 1) * $pagination->limit) + 1 : 0, 
				((($page - 1) * $pagination->limit) > ($product_total - $pagination->limit)) ? 
					$product_total : 
					((($page - 1) * $pagination->limit) + $pagination->limit), 
				$product_total, 
				ceil($product_total / $pagination->limit)
		);
		$data['current_rows'] = $this->session->data['current_rows'];
		
		$data['filter_id'] = $filter_id;
		$data['filter_name'] = $filter_name;
		$data['filter_meta_title'] = $filter_meta_title;
		$data['filter_meta_keyword'] = $filter_meta_keyword;
		$data['filter_meta_description'] = $filter_meta_description;
		$data['filter_model'] = $filter_model;
		$data['filter_ean'] = $filter_ean;
		$data['filter_jan'] = $filter_jan;
		$data['filter_mpn'] = $filter_mpn;
		$data['filter_isbn'] = $filter_isbn;
		/*controller-hook-8*/
		$data['filter_points'] = $filter_points;
		$data['filter_quantity'] = $filter_quantity;
		$data['filter_minimum'] = $filter_minimum;
		$data['filter_weight'] = $filter_weight;
		$data['filter_sku'] = $filter_sku;
		$data['filter_upc'] = $filter_upc;
		
		$data['filter_location'] = $filter_location;
		$data['filter_date_available'] = $filter_date_available;
		$data['filter_status'] = $filter_status;
		$data['filter_subtract'] = $filter_subtract;
		$data['filter_shipping'] = $filter_shipping;
		$data['filter_category'] = $filter_category;
		$data['filter_filter'] = $filter_filter;
		$data['filter_manufacturer'] = $filter_manufacturer;
		$data['filter_stock_status'] = $filter_stock_status;
		$data['filter_tax_class'] = $filter_tax_class;
		$data['filter_length_class'] = $filter_length_class;
		$data['filter_weight_class'] = $filter_weight_class;
		$data['filter_store'] = $filter_store;
		$data['filter_price'] = $filter_price;
		$data['filter_sort_order'] = $filter_sort_order;
		
		$data['sort'] = $sort;
		$data['order'] = $order;

		//Add module style
		$this->document->addStyle('view/stylesheet/ipe.css');
		$this->document->addScript('view/javascript/ipe.gross.js');
		
		$this->template = 'catalog/product_list_extra';
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');
		
		$this->load->model('localisation/language');
		$data['languages'] = $this->model_localisation_language->getLanguages();

		//selected language
		foreach ($data['languages'] as $language) {
			if ($language['language_id'] == $data['selected_language']) {
				$data['selected_lang'] = $language['name'];
			}
		}

		$this->response->setOutput($this->load->view('extension/product_list_extra', $data));
  	}
}

class CustomCustomer{
	public function isLogged(){
		return false;
	}
	
	public function getAddressId(){
		return 0;
	}
	
	public function getId(){
		return 0;
	}
}