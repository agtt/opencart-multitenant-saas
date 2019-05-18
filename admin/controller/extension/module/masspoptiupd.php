<?php 
class ControllerExtensionModulemasspoptiupd extends Controller { 
	private $error = array();
	
	public function index() {

    		$this->load->language('extension/module/masspoptiupd');

		$this->document->addStyle('view/template/extension/module/masspoptiupd.css');

		$data['heading_title'] = $this->language->get('heading_title');
		
		// Filters
		$data['masstxt_p_filters_h'] = $this->language->get('masstxt_p_filters_h');
		
		$data['masstxt_show_f'] = $this->language->get('masstxt_show_f');
		$data['masstxt_hide_f'] = $this->language->get('masstxt_hide_f');
		$data['masstxt_show_more_r'] = $this->language->get('masstxt_show_more_r');
		$data['masstxt_show_less_r'] = $this->language->get('masstxt_show_less_r');
		$data['masstxt_p_data'] = $this->language->get('masstxt_p_data');
		$data['masstxt_SKU'] = $this->language->get('masstxt_SKU');
		$data['masstxt_UPC'] = $this->language->get('masstxt_UPC');
		$data['masstxt_EAN'] = $this->language->get('masstxt_EAN');
		$data['masstxt_JAN'] = $this->language->get('masstxt_JAN');
		$data['masstxt_ISBN'] = $this->language->get('masstxt_ISBN');
		$data['masstxt_MPN'] = $this->language->get('masstxt_MPN');
		$data['masstxt_location'] = $this->language->get('masstxt_location');
		$data['masstxt_reward_points'] = $this->language->get('masstxt_reward_points');
		$data['masstxt_points_help'] = $this->language->get('masstxt_points_help');
		$data['masstxt_points_from'] = $this->language->get('masstxt_points_from');
		$data['masstxt_points_to'] = $this->language->get('masstxt_points_to');
		$data['masstxt_r_points_from'] = $this->language->get('masstxt_r_points_from');
		$data['masstxt_r_points_to'] = $this->language->get('masstxt_r_points_to');

		$data['masstxt_name'] = $this->language->get('masstxt_name');
		$data['masstxt_name_help'] = $this->language->get('masstxt_name_help');
		$data['masstxt_model'] = $this->language->get('masstxt_model');
		$data['masstxt_model_help'] = $this->language->get('masstxt_model_help');
		$data['masstxt_tag'] = $this->language->get('masstxt_tag');
		$data['masstxt_tag_help'] = $this->language->get('masstxt_tag_help');
		$data['masstxt_categories'] = $this->language->get('masstxt_categories');
		$data['masstxt_manufacturers'] = $this->language->get('masstxt_manufacturers');
		$data['masstxt_price'] = $this->language->get('masstxt_price');
		$data['masstxt_price_help'] = $this->language->get('masstxt_price_help');
		$data['masstxt_discount'] = $this->language->get('masstxt_discount');
		$data['masstxt_customer_group'] = $this->language->get('masstxt_customer_group');
		$data['masstxt_special'] = $this->language->get('masstxt_special');
		$data['masstxt_tax_class'] = $this->language->get('masstxt_tax_class');
		$data['masstxt_quantity'] = $this->language->get('masstxt_quantity');
		$data['masstxt_minimum_quantity'] = $this->language->get('masstxt_minimum_quantity');
		$data['masstxt_subtract_stock'] = $this->language->get('masstxt_subtract_stock');
		$data['masstxt_out_of_stock_status'] = $this->language->get('masstxt_out_of_stock_status');
		$data['masstxt_requires_shipping'] = $this->language->get('masstxt_requires_shipping');
		$data['masstxt_date_available'] = $this->language->get('masstxt_date_available');
		$data['masstxt_date_added'] = $this->language->get('masstxt_date_added');
		$data['masstxt_date_modified'] = $this->language->get('masstxt_date_modified');
		$data['masstxt_date_start'] = $this->language->get('masstxt_date_start');
		$data['masstxt_date_end'] = $this->language->get('masstxt_date_end');
		$data['masstxt_status'] = $this->language->get('masstxt_status');
		$data['masstxt_store'] = $this->language->get('masstxt_store');
		$data['masstxt_with_attribute'] = $this->language->get('masstxt_with_attribute');
		$data['masstxt_with_attribute_value'] = $this->language->get('masstxt_with_attribute_value');
		$data['masstxt_with_attribute_value_help'] = $this->language->get('masstxt_with_attribute_value_help');
		$data['masstxt_with_this_option'] = $this->language->get('masstxt_with_this_option');
		$data['masstxt_with_this_option_value'] = $this->language->get('masstxt_with_this_option_value');
		$data['masstxt_filter_products_button'] = $this->language->get('masstxt_filter_products_button');
		$data['masstxt_table_name'] = $this->language->get('masstxt_table_name');
		$data['masstxt_table_model'] = $this->language->get('masstxt_table_model');
		$data['masstxt_table_price'] = $this->language->get('masstxt_table_price');
		$data['masstxt_table_quantity'] = $this->language->get('masstxt_table_quantity');
		$data['masstxt_table_status'] = $this->language->get('masstxt_table_status');
		$data['masstxt_max_prod_pag1'] = $this->language->get('masstxt_max_prod_pag1');
		$data['masstxt_max_prod_pag2'] = $this->language->get('masstxt_max_prod_pag2');
		$data['masstxt_show_page_of1'] = $this->language->get('masstxt_show_page_of1');
		$data['masstxt_show_page_of2'] = $this->language->get('masstxt_show_page_of2');
		$data['masstxt_total_prod_res'] = $this->language->get('masstxt_total_prod_res');
		$data['masstxt_prod_sel_for_upd'] = $this->language->get('masstxt_prod_sel_for_upd');
		
		$data['masstxt_yes'] = $this->language->get('masstxt_yes');
		$data['masstxt_no'] = $this->language->get('masstxt_no');
		$data['masstxt_enabled'] = $this->language->get('masstxt_enabled');
		$data['masstxt_disabled'] = $this->language->get('masstxt_disabled');
		$data['masstxt_select_all'] = $this->language->get('masstxt_select_all');
		$data['masstxt_unselect_all'] = $this->language->get('masstxt_unselect_all');
		$data['masstxt_none'] = $this->language->get('masstxt_none');
		$data['masstxt_none_cat'] = $this->language->get('masstxt_none_cat');
		$data['masstxt_none_fil'] = $this->language->get('masstxt_none_fil');
		$data['masstxt_all'] = $this->language->get('masstxt_all');
		$data['masstxt_default'] = $this->language->get('masstxt_default');
		$data['masstxt_unselect_all_to_ignore'] = $this->language->get('masstxt_unselect_all_to_ignore');
		$data['masstxt_ignore_this'] = $this->language->get('masstxt_ignore_this');
		$data['masstxt_leave_empty_to_ignore'] = $this->language->get('masstxt_leave_empty_to_ignore');
		$data['masstxt_greater_than_or_equal'] = $this->language->get('masstxt_greater_than_or_equal');
		$data['masstxt_less_than_or_equal'] = $this->language->get('masstxt_less_than_or_equal');
		$data['masstxt_price_from'] = $this->language->get('masstxt_price_from');
		$data['masstxt_price_to'] = $this->language->get('masstxt_price_to');
		
		// updates
		$data['masstxt_p_options_updates'] = $this->language->get('masstxt_p_options_updates');
		$data['masstxt_load_existing_options'] = $this->language->get('masstxt_load_existing_options');
		$data['masstxt_name_autocomplete'] = $this->language->get('masstxt_name_autocomplete');
		$data['masstxt_model_autocomplete'] = $this->language->get('masstxt_model_autocomplete');
		$data['masstxt_new_options'] = $this->language->get('masstxt_new_options');
		$data['masstxt_options_update_mode'] = $this->language->get('masstxt_options_update_mode');
		$data['masstxt_upd_mode_o_upd_add'] = $this->language->get('masstxt_upd_mode_o_upd_add');
		$data['masstxt_upd_mode_o_upd'] = $this->language->get('masstxt_upd_mode_o_upd');
		$data['masstxt_upd_mode_o_add'] = $this->language->get('masstxt_upd_mode_o_add');
		$data['masstxt_upd_mode_o_del_add'] = $this->language->get('masstxt_upd_mode_o_del_add');
		$data['masstxt_upd_mode_o_del_opt_and_val'] = $this->language->get('masstxt_upd_mode_o_del_opt_and_val');
		$data['masstxt_upd_mode_o_del_val'] = $this->language->get('masstxt_upd_mode_o_del_val');
		$data['masstxt_upd_mode_o_del'] = $this->language->get('masstxt_upd_mode_o_del');
		$data['masstxt_upd_mode_o_del_help'] = $this->language->get('masstxt_upd_mode_o_del_help');
		$data['masstxt_options_values_update_mode'] = $this->language->get('masstxt_options_values_update_mode');
		$data['masstxt_upd_mode_v_rep_add'] = $this->language->get('masstxt_upd_mode_v_rep_add');
		$data['masstxt_upd_mode_v_rep'] = $this->language->get('masstxt_upd_mode_v_rep');

		$data['masstxt_options_quantity_update_mode'] = $this->language->get('masstxt_options_quantity_update_mode');
		$data['masstxt_options_price_update_mode'] = $this->language->get('masstxt_options_price_update_mode');
		$data['masstxt_options_points_update_mode'] = $this->language->get('masstxt_options_points_update_mode');
		$data['masstxt_options_wgt_update_mode'] = $this->language->get('masstxt_options_wgt_update_mode');

		$data['masstxt_addition'] = $this->language->get('masstxt_addition');
		$data['masstxt_subtraction'] = $this->language->get('masstxt_subtraction');
		$data['masstxt_multiplication'] = $this->language->get('masstxt_multiplication');
		$data['masstxt_replacement'] = $this->language->get('masstxt_replacement');
		$data['masstxt_replacement_percent_bprice'] = $this->language->get('masstxt_replacement_percent_bprice');
		$data['masstxt_replacement_percent_points'] = $this->language->get('masstxt_replacement_percent_points');
		$data['masstxt_replacement_percent_weight'] = $this->language->get('masstxt_replacement_percent_weight');
		$data['masstxt_no_update'] = $this->language->get('masstxt_no_update');
		
		$data['masstxt_example1'] = $this->language->get('masstxt_example1');
		$data['masstxt_example2'] = $this->language->get('masstxt_example2');
		$data['masstxt_example3'] = $this->language->get('masstxt_example3');
		$data['masstxt_example4'] = $this->language->get('masstxt_example4');

		$data['masstxt_mass_update_button'] = $this->language->get('masstxt_mass_update_button');
		$data['masstxt_mass_update_button_help'] = $this->language->get('masstxt_mass_update_button_help');
		$data['masstxt_mass_update_button_top1'] = $this->language->get('masstxt_mass_update_button_top1');
		$data['masstxt_mass_update_button_top2'] = $this->language->get('masstxt_mass_update_button_top2');
		$data['masstxt_mass_update_button_top3'] = $this->language->get('masstxt_mass_update_button_top3');
		

		if(version_compare(VERSION, '1.5.4.1', '>')) {
		$this->language->load('catalog/product');
		} else {
		$this->load->language('catalog/product');
		}
		
		$data['text_enabled'] = $this->language->get('text_enabled');
    	$data['text_disabled'] = $this->language->get('text_disabled');
    	$data['text_none'] = $this->language->get('text_none');
    	$data['text_yes'] = $this->language->get('text_yes');
    	$data['text_no'] = $this->language->get('text_no');
		$data['text_select_all'] = $this->language->get('text_select_all');
		$data['text_unselect_all'] = $this->language->get('text_unselect_all');
		$data['text_plus'] = $this->language->get('text_plus');
		$data['text_minus'] = $this->language->get('text_minus');
		$data['text_default'] = $this->language->get('text_default');
		$data['text_image_manager'] = $this->language->get('text_image_manager');
		$data['text_browse'] = $this->language->get('text_browse');
		$data['text_clear'] = $this->language->get('text_clear');
		$data['text_option'] = $this->language->get('text_option');
		$data['text_option_value'] = $this->language->get('text_option_value');
		$data['text_select'] = $this->language->get('text_select');
		$data['text_none'] = $this->language->get('text_none');
		$data['text_percent'] = $this->language->get('text_percent');
		$data['text_amount'] = $this->language->get('text_amount');

		$data['entry_name'] = $this->language->get('entry_name');
		$data['entry_meta_description'] = $this->language->get('entry_meta_description');
		$data['entry_meta_keyword'] = $this->language->get('entry_meta_keyword');
		$data['entry_description'] = $this->language->get('entry_description');
		$data['entry_store'] = $this->language->get('entry_store');
		$data['entry_keyword'] = $this->language->get('entry_keyword');
    	$data['entry_model'] = $this->language->get('entry_model');
		$data['entry_sku'] = $this->language->get('entry_sku');
		$data['entry_upc'] = $this->language->get('entry_upc');
		$data['entry_ean'] = $this->language->get('entry_ean');
		$data['entry_jan'] = $this->language->get('entry_jan');
		$data['entry_isbn'] = $this->language->get('entry_isbn');
		$data['entry_mpn'] = $this->language->get('entry_mpn');
		$data['entry_location'] = $this->language->get('entry_location');
		$data['entry_minimum'] = $this->language->get('entry_minimum');
		$data['entry_manufacturer'] = $this->language->get('entry_manufacturer');
    	$data['entry_shipping'] = $this->language->get('entry_shipping');
    	$data['entry_date_available'] = $this->language->get('entry_date_available');
    	$data['entry_quantity'] = $this->language->get('entry_quantity');
		$data['entry_stock_status'] = $this->language->get('entry_stock_status');
    	$data['entry_price'] = $this->language->get('entry_price');
		$data['entry_tax_class'] = $this->language->get('entry_tax_class');
		$data['entry_points'] = $this->language->get('entry_points');
		$data['entry_option_points'] = $this->language->get('entry_option_points');
		$data['entry_subtract'] = $this->language->get('entry_subtract');
    	$data['entry_weight_class'] = $this->language->get('entry_weight_class');
    	$data['entry_weight'] = $this->language->get('entry_weight');
		$data['entry_dimension'] = $this->language->get('entry_dimension');
		$data['entry_length'] = $this->language->get('entry_length');
    	$data['entry_image'] = $this->language->get('entry_image');
    	$data['entry_download'] = $this->language->get('entry_download');
    	$data['entry_category'] = $this->language->get('entry_category');
		$data['entry_related'] = $this->language->get('entry_related');
		$data['entry_attribute'] = $this->language->get('entry_attribute');
		$data['entry_text'] = $this->language->get('entry_text');
		$data['entry_option'] = $this->language->get('entry_option');
		$data['entry_option_value'] = $this->language->get('entry_option_value');
		$data['entry_required'] = $this->language->get('entry_required');
		$data['entry_sort_order'] = $this->language->get('entry_sort_order');
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_customer_group'] = $this->language->get('entry_customer_group');
		$data['entry_date_start'] = $this->language->get('entry_date_start');
		$data['entry_date_end'] = $this->language->get('entry_date_end');
		$data['entry_priority'] = $this->language->get('entry_priority');
		$data['entry_tag'] = $this->language->get('entry_tag');
		$data['entry_customer_group'] = $this->language->get('entry_customer_group');
		$data['entry_reward'] = $this->language->get('entry_reward');
		$data['entry_layout'] = $this->language->get('entry_layout');
				
    	$data['button_save'] = $this->language->get('button_save');
    	$data['button_cancel'] = $this->language->get('button_cancel');
		$data['button_add_attribute'] = $this->language->get('button_add_attribute');
		$data['button_add_option'] = $this->language->get('button_add_option');
		$data['button_add_option_value'] = $this->language->get('button_add_option_value');
		$data['button_add_discount'] = $this->language->get('button_add_discount');
		$data['button_add_special'] = $this->language->get('button_add_special');
		$data['button_add_image'] = $this->language->get('button_add_image');
		$data['button_remove'] = $this->language->get('button_remove');
		
    	$data['tab_general'] = $this->language->get('tab_general');
    	$data['tab_data'] = $this->language->get('tab_data');
		$data['tab_attribute'] = $this->language->get('tab_attribute');
		$data['tab_option'] = $this->language->get('tab_option');		
		$data['tab_discount'] = $this->language->get('tab_discount');
		$data['tab_special'] = $this->language->get('tab_special');
    	$data['tab_image'] = $this->language->get('tab_image');		
		$data['tab_links'] = $this->language->get('tab_links');
		$data['tab_reward'] = $this->language->get('tab_reward');
		$data['tab_design'] = $this->language->get('tab_design');
		
		if(version_compare(VERSION, '1.5.4.1', '>')) {
		$this->language->load('catalog/option');
		} else {
		$this->load->language('catalog/option');
		}
		
		$data['text_choose'] = $this->language->get('text_choose');
		$data['text_select'] = $this->language->get('text_select');
		$data['text_radio'] = $this->language->get('text_radio');
		$data['text_checkbox'] = $this->language->get('text_checkbox');
		$data['text_image'] = $this->language->get('text_image');
		$data['text_input'] = $this->language->get('text_input');
		$data['text_text'] = $this->language->get('text_text');
		$data['text_textarea'] = $this->language->get('text_textarea');
		$data['text_file'] = $this->language->get('text_file');
		$data['text_date'] = $this->language->get('text_date');
		$data['text_datetime'] = $this->language->get('text_datetime');
		$data['text_time'] = $this->language->get('text_time');
		$data['text_image_manager'] = $this->language->get('text_image_manager');
		$data['text_browse'] = $this->language->get('text_browse');
		$data['text_clear'] = $this->language->get('text_clear');	
		
		$data['entry_name'] = $this->language->get('entry_name');
		$data['entry_type'] = $this->language->get('entry_type');
		$data['entry_value'] = $this->language->get('entry_value');
		$data['entry_image'] = $this->language->get('entry_image');
		$data['entry_sort_order'] = $this->language->get('entry_sort_order');

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');
		$data['button_add_option_value'] = $this->language->get('button_add_option_value');
		$data['button_option_value_add'] = $this->language->get('button_option_value_add');
		$data['button_remove'] = $this->language->get('button_remove');

		$data['tab_general'] = $this->language->get('tab_general');
		
				
		
		
		$this->document->setTitle($data['heading_title']);
		
		$this->load->model('catalog/category');
		
		$this->load->model('catalog/manufacturer');
		
		$this->load->model('localisation/tax_class');
		
		$this->load->model('localisation/stock_status');
		
		$this->load->model('localisation/language');
		
		$this->load->model('catalog/attribute');
		
		$this->load->model('setting/store');
		
		if(version_compare(VERSION, '2.0.3.1', '>')) {
		$this->load->model('customer/customer_group');
		} else {
		$this->load->model('sale/customer_group');
		}
		
		if(version_compare(VERSION, '1.5.4.1', '>')) {
		$data['masstxt_p_filters'] = $this->language->get('masstxt_p_filters');
		$data['masstxt_p_filters_none'] = $this->language->get('masstxt_p_filters_none');
		
		$sql = "SELECT f.filter_id AS `filter_id`, fd.name AS `name`, fgd.name AS `group` FROM " . DB_PREFIX . "filter f 
		LEFT JOIN " . DB_PREFIX . "filter_description fd ON (f.filter_id = fd.filter_id) 
		LEFT JOIN " . DB_PREFIX . "filter_group_description fgd ON (f.filter_group_id = fgd.filter_group_id) 
		LEFT JOIN " . DB_PREFIX . "filter_group fg ON (f.filter_group_id = fg.filter_group_id) 
		WHERE fd.language_id = '" . (int)$this->config->get('config_language_id') . "' 
		AND fgd.language_id = '" . (int)$this->config->get('config_language_id') . "'";
		$sql .= " ORDER BY fg.sort_order, fgd.name, f.sort_order, fd.name";
		$query_pf = $this->db->query($sql);
		$data['p_filters'] = $query_pf->rows;

		if (isset($this->request->post['filters_ids'])) {
			$data['filters_ids'] = $this->request->post['filters_ids'];
		} else {
			$data['filters_ids'] = array();
		}
		}
		
		if(version_compare(VERSION, '2.0.3.1', '>')) {
		$data['customer_groups'] = $this->model_customer_customer_group->getCustomerGroups();
		} else {
		$data['customer_groups'] = $this->model_sale_customer_group->getCustomerGroups();
		}
		
		$filter_data_getCategories = array('sort' => 'name');
		$data['categories'] = $this->model_catalog_category->getCategories($filter_data_getCategories);
		if (isset($this->request->post['product_category'])) {
			$data['product_category'] = $this->request->post['product_category'];
		} else {
			$data['product_category'] = array();
		}
		
		$data['manufacturers'] = $this->model_catalog_manufacturer->getManufacturers();
		if (isset($this->request->post['manufacturer_ids'])) {
      			$data['manufacturer_ids'] = $this->request->post['manufacturer_ids'];
		} else {
      			$data['manufacturer_ids'] = array();
    		}
		
		$data['tax_classes'] = $this->model_localisation_tax_class->getTaxClasses();
		
		$data['stock_statuses'] = $this->model_localisation_stock_status->getStockStatuses();
		
		$data['languages'] = $this->model_localisation_language->getLanguages();
		
		$data['all_attributes'] = $this->model_catalog_attribute->getAttributes();
		
		$data['stores'] = $this->model_setting_store->getStores();
		
		// all options names + id-s for filter
		$query_all_options = $this->db->query("SELECT od.option_id, od.name FROM " . DB_PREFIX . "option_description od 
		WHERE od.language_id = '" . (int)$this->config->get('config_language_id') . "'
		ORDER BY od.name");
		$data['all_options'] = $query_all_options->rows;
		
		// all options values + id-s for filter
		$query_all_optval = $this->db->query("SELECT ovd.option_value_id, ovd.name AS ov_name, od.name AS o_name 
		FROM " . DB_PREFIX . "option_value_description ovd 
		LEFT JOIN " . DB_PREFIX . "option_description od ON (ovd.option_id = od.option_id) 
		WHERE ovd.language_id = '" . (int)$this->config->get('config_language_id') . "' GROUP BY ovd.option_value_id ORDER BY od.name, ovd.name");
		$data['all_optval'] = $query_all_optval->rows;
		
		///
		$this->load->model('catalog/option');
		
		if (isset($this->request->post['load_product_options']) AND isset($this->request->post['product_id_to_options'])) { // load options
			//$this->load->model('catalog/product');
			//$product_options = $this->model_catalog_product->getProductOptions($this->request->post['product_id_to_options']);	
		
		$product_option_data = array();
		
		$product_option_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_option po LEFT JOIN `" . DB_PREFIX . "option` o ON (po.option_id = o.option_id) LEFT JOIN " . DB_PREFIX . "option_description od ON (o.option_id = od.option_id) WHERE po.product_id = '" . (int)$this->request->post['product_id_to_options'] . "' AND od.language_id = '" . (int)$this->config->get('config_language_id') . "'");
		
		foreach ($product_option_query->rows as $product_option) {
			if ($product_option['type'] == 'select' || $product_option['type'] == 'radio' || $product_option['type'] == 'checkbox' || $product_option['type'] == 'image') {
				$product_option_value_data = array();	
				
				$product_option_value_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_option_value pov LEFT JOIN " . DB_PREFIX . "option_value ov ON (pov.option_value_id = ov.option_value_id) LEFT JOIN " . DB_PREFIX . "option_value_description ovd ON (ov.option_value_id = ovd.option_value_id) WHERE pov.product_option_id = '" . (int)$product_option['product_option_id'] . "' AND ovd.language_id = '" . (int)$this->config->get('config_language_id') . "'");
				
				foreach ($product_option_value_query->rows as $product_option_value) {
					$product_option_value_data[] = array(
						'product_option_value_id' => '',
						'option_value_id'         => $product_option_value['option_value_id'],
						'name'                    => $product_option_value['name'],
						'image'                   => $product_option_value['image'],
						'quantity'                => $product_option_value['quantity'],
						'subtract'                => $product_option_value['subtract'],
						'price'                   => $product_option_value['price'],
						'price_prefix'            => $product_option_value['price_prefix'],
						'points'                  => $product_option_value['points'],
						'points_prefix'           => $product_option_value['points_prefix'],						
						'weight'                  => $product_option_value['weight'],
						'weight_prefix'           => $product_option_value['weight_prefix']					
					);
				}
				
				$product_option_data[] = array(
					'product_option_id'    => '',
					'option_id'            => $product_option['option_id'],
					'name'                 => $product_option['name'],
					'type'                 => $product_option['type'],
					'product_option_value' => $product_option_value_data,
					'required'             => $product_option['required']
				);				
			} else {
				$product_option_data[] = array(
					'product_option_id' => '',
					'option_id'         => $product_option['option_id'],
					'name'              => $product_option['name'],
					'type'              => $product_option['type'],
					'value'      => $product_option['value'],
					'required'          => $product_option['required']
				);				
			}
		}	
		
		$product_options = $product_option_data;
		
		} elseif (isset($this->request->post['product_option'])) {
			$product_options = $this->request->post['product_option'];
		} else {
			$product_options = array();
		}			
		
		$data['product_options'] = array();
			
		foreach ($product_options as $product_option) {
			if ($product_option['type'] == 'select' || $product_option['type'] == 'radio' || $product_option['type'] == 'checkbox' || $product_option['type'] == 'image') {
				$product_option_value_data = array();
				
				if (isset($product_option['product_option_value'])) {
				foreach ($product_option['product_option_value'] as $product_option_value) {
					$product_option_value_data[] = array(
						'product_option_value_id' => '',
						'option_value_id'         => $product_option_value['option_value_id'],
						'quantity'                => $product_option_value['quantity'],
						'subtract'                => $product_option_value['subtract'],
						'price'                   => $product_option_value['price'],
						'price_prefix'            => $product_option_value['price_prefix'],
						'points'                  => $product_option_value['points'],
						'points_prefix'           => $product_option_value['points_prefix'],						
						'weight'                  => $product_option_value['weight'],
						'weight_prefix'           => $product_option_value['weight_prefix']	
					);						
				}
				}
				
				$data['product_options'][] = array(
					'product_option_id'    => '',
					'product_option_value' => $product_option_value_data,
					'option_id'            => $product_option['option_id'],
					'name'                 => $product_option['name'],
					'type'                 => $product_option['type'],
					'required'             => $product_option['required']
				);				
			} else {
				$data['product_options'][] = array(
					'product_option_id' => '',
					'option_id'         => $product_option['option_id'],
					'name'              => $product_option['name'],
					'type'              => $product_option['type'],
					'value'      => $product_option['value'],
					'required'          => $product_option['required']
				);				
			}
		}
		
		$data['option_values'] = array();
		
		foreach ($product_options as $product_option) {
			if ($product_option['type'] == 'select' || $product_option['type'] == 'radio' || $product_option['type'] == 'checkbox' || $product_option['type'] == 'image') {
				if (!isset($data['option_values'][$product_option['option_id']])) {
					$data['option_values'][$product_option['option_id']] = $this->model_catalog_option->getOptionValues($product_option['option_id']);
				}
			}
		}
		///
		
		////
		
		if (isset($this->request->post['price_mmarese'])) {
      			$data['price_mmarese'] = $this->request->post['price_mmarese'];
		} else {
      			$data['price_mmarese'] = '';
    		}

		if (isset($this->request->post['price_mmicse'])) {
      			$data['price_mmicse'] = $this->request->post['price_mmicse'];
		} else {
      			$data['price_mmicse'] = '';
    		}

		if (isset($this->request->post['d_cust_group_filter'])) {
      			$data['d_cust_group_filter'] = $this->request->post['d_cust_group_filter'];
		} else {
      			$data['d_cust_group_filter'] = 'any';
    		}
		
		if (isset($this->request->post['s_cust_group_filter'])) {
      			$data['s_cust_group_filter'] = $this->request->post['s_cust_group_filter'];
		} else {
      			$data['s_cust_group_filter'] = 'any';
    		}

		if (isset($this->request->post['d_price_mmarese'])) {
      			$data['d_price_mmarese'] = $this->request->post['d_price_mmarese'];
		} else {
      			$data['d_price_mmarese'] = '';
    		}

		if (isset($this->request->post['d_price_mmicse'])) {
      			$data['d_price_mmicse'] = $this->request->post['d_price_mmicse'];
		} else {
      			$data['d_price_mmicse'] = '';
    		}

		if (isset($this->request->post['s_price_mmarese'])) {
      			$data['s_price_mmarese'] = $this->request->post['s_price_mmarese'];
		} else {
      			$data['s_price_mmarese'] = '';
    		}

		if (isset($this->request->post['s_price_mmicse'])) {
      			$data['s_price_mmicse'] = $this->request->post['s_price_mmicse'];
		} else {
      			$data['s_price_mmicse'] = '';
    		}

		if (isset($this->request->post['d_date_start'])) {
      			$data['d_date_start'] = $this->request->post['d_date_start'];
		} else {
      			$data['d_date_start'] = '';
    		}

		if (isset($this->request->post['d_date_end'])) {
      			$data['d_date_end'] = $this->request->post['d_date_end'];
		} else {
      			$data['d_date_end'] = '';
    		}

		if (isset($this->request->post['s_date_start'])) {
      			$data['s_date_start'] = $this->request->post['s_date_start'];
		} else {
      			$data['s_date_start'] = '';
    		}

		if (isset($this->request->post['s_date_end'])) {
      			$data['s_date_end'] = $this->request->post['s_date_end'];
		} else {
      			$data['s_date_end'] = '';
    		}

		if (isset($this->request->post['points_mmarese'])) {
      			$data['points_mmarese'] = $this->request->post['points_mmarese'];
		} else {
      			$data['points_mmarese'] = '';
    		}
		if (isset($this->request->post['points_mmicse'])) {
      			$data['points_mmicse'] = $this->request->post['points_mmicse'];
		} else {
      			$data['points_mmicse'] = '';
    		}
		if (isset($this->request->post['r_p_cust_group_filter'])) {
      			$data['r_p_cust_group_filter'] = $this->request->post['r_p_cust_group_filter'];
		} else {
      			$data['r_p_cust_group_filter'] = 'any';
    		}
		if (isset($this->request->post['r_p_mmarese'])) {
      			$data['r_p_mmarese'] = $this->request->post['r_p_mmarese'];
		} else {
      			$data['r_p_mmarese'] = '';
    		}
		if (isset($this->request->post['r_p_mmicse'])) {
      			$data['r_p_mmicse'] = $this->request->post['r_p_mmicse'];
		} else {
      			$data['r_p_mmicse'] = '';
    		}

		if (isset($this->request->post['tax_class_filter'])) {
      			$data['tax_class_filter'] = $this->request->post['tax_class_filter'];
		} else {
      			$data['tax_class_filter'] = 'any';
    		}

		if (isset($this->request->post['stock_mmarese'])) {
      			$data['stock_mmarese'] = $this->request->post['stock_mmarese'];
		} else {
      			$data['stock_mmarese'] = '';
    		}

		if (isset($this->request->post['stock_mmicse'])) {
      			$data['stock_mmicse'] = $this->request->post['stock_mmicse'];
		} else {
      			$data['stock_mmicse'] = '';
    		}

		if (isset($this->request->post['min_q_mmarese'])) {
      			$data['min_q_mmarese'] = $this->request->post['min_q_mmarese'];
		} else {
      			$data['min_q_mmarese'] = '';
    		}

		if (isset($this->request->post['min_q_mmicse'])) {
      			$data['min_q_mmicse'] = $this->request->post['min_q_mmicse'];
		} else {
      			$data['min_q_mmicse'] = '';
    		}

		if (isset($this->request->post['subtract_filter'])) {
      			$data['subtract_filter'] = $this->request->post['subtract_filter'];
		} else {
      			$data['subtract_filter'] = 'any';
    		}

		if (isset($this->request->post['stock_status_filter'])) {
      			$data['stock_status_filter'] = $this->request->post['stock_status_filter'];
		} else {
      			$data['stock_status_filter'] = 'any';
    		}

		if (isset($this->request->post['shipping_filter'])) {
      			$data['shipping_filter'] = $this->request->post['shipping_filter'];
		} else {
      			$data['shipping_filter'] = 'any';
    		}

		if (isset($this->request->post['date_mmarese'])) {
      			$data['date_mmarese'] = $this->request->post['date_mmarese'];
		} else {
      			$data['date_mmarese'] = '';
    		}

		if (isset($this->request->post['date_mmicse'])) {
      			$data['date_mmicse'] = $this->request->post['date_mmicse'];
		} else {
      			$data['date_mmicse'] = '';
    		}

		if (isset($this->request->post['date_added_mmarese'])) {
      			$data['date_added_mmarese'] = $this->request->post['date_added_mmarese'];
		} else {
      			$data['date_added_mmarese'] = '';
    		}

		if (isset($this->request->post['date_added_mmicse'])) {
      			$data['date_added_mmicse'] = $this->request->post['date_added_mmicse'];
		} else {
      			$data['date_added_mmicse'] = '';
    		}
    		
    		if (isset($this->request->post['date_modified_mmarese'])) {
      			$data['date_modified_mmarese'] = $this->request->post['date_modified_mmarese'];
		} else {
      			$data['date_modified_mmarese'] = '';
    		}

		if (isset($this->request->post['date_modified_mmicse'])) {
      			$data['date_modified_mmicse'] = $this->request->post['date_modified_mmicse'];
		} else {
      			$data['date_modified_mmicse'] = '';
    		}

		if (isset($this->request->post['prod_status'])) {
      			$data['prod_status'] = $this->request->post['prod_status'];
		} else {
      			$data['prod_status'] = 'any';
    		}

    		if (isset($this->request->post['store_filter'])) {
      			$data['store_filter'] = $this->request->post['store_filter'];
		} else {
      			$data['store_filter'] = 'any';
    		}

		if (isset($this->request->post['filter_attr'])) {
      			$data['filter_attr'] = $this->request->post['filter_attr'];
		} else {
      			$data['filter_attr'] = 'any';
    		}
    		
		if (isset($this->request->post['filter_opti'])) {
      			$data['filter_opti'] = $this->request->post['filter_opti'];
		} else {
      			$data['filter_opti'] = 'any';
    		}
    		
    		if (isset($this->request->post['filter_attr_val'])) {
      			$data['filter_attr_val'] = $this->request->post['filter_attr_val'];
		} else {
      			$data['filter_attr_val'] = '';
    		}
    		
    		if (isset($this->request->post['filter_opti_val'])) {
      			$data['filter_opti_val'] = $this->request->post['filter_opti_val'];
		} else {
      			$data['filter_opti_val'] = 'any';
    		}

    		if (isset($this->request->post['filter_name'])) {
      			$data['filter_name'] = $this->request->post['filter_name'];
		} else {
      			$data['filter_name'] = '';
    		}
    		
    		if (isset($this->request->post['filter_namex'])) {
      			$data['filter_namex'] = $this->request->post['filter_namex'];
		} else {
      			$data['filter_namex'] = '';
    		}

    		if (isset($this->request->post['filter_modelx'])) {
      			$data['filter_modelx'] = $this->request->post['filter_modelx'];
		} else {
      			$data['filter_modelx'] = '';
    		}
    		
     		if (isset($this->request->post['product_id_to_options'])) {
      			$data['product_id_to_options'] = $this->request->post['product_id_to_options'];
		} else {
      			$data['product_id_to_options'] = '';
    		}   		
    		
    		if (isset($this->request->post['filter_model'])) {
      			$data['filter_model'] = $this->request->post['filter_model'];
		} else {
      			$data['filter_model'] = '';
    		}
    		
    		if (isset($this->request->post['filter_tag'])) {
      			$data['filter_tag'] = $this->request->post['filter_tag'];
		} else {
      			$data['filter_tag'] = '';
    		}
    		
    		if (isset($this->request->post['filter_sku'])) {
      			$data['filter_sku'] = $this->request->post['filter_sku'];
		} else {
      			$data['filter_sku'] = '';
    		}
    		if (isset($this->request->post['filter_upc'])) {
      			$data['filter_upc'] = $this->request->post['filter_upc'];
		} else {
      			$data['filter_upc'] = '';
    		}
    		if (isset($this->request->post['filter_ean'])) {
      			$data['filter_ean'] = $this->request->post['filter_ean'];
		} else {
      			$data['filter_ean'] = '';
    		}
    		if (isset($this->request->post['filter_jan'])) {
      			$data['filter_jan'] = $this->request->post['filter_jan'];
		} else {
      			$data['filter_jan'] = '';
    		}
    		if (isset($this->request->post['filter_isbn'])) {
      			$data['filter_isbn'] = $this->request->post['filter_isbn'];
		} else {
      			$data['filter_isbn'] = '';
    		}
    		if (isset($this->request->post['filter_mpn'])) {
      			$data['filter_mpn'] = $this->request->post['filter_mpn'];
		} else {
      			$data['filter_mpn'] = '';
    		}
    		if (isset($this->request->post['filter_location'])) {
      			$data['filter_location'] = $this->request->post['filter_location'];
		} else {
      			$data['filter_location'] = '';
    		}
    		
    		////
    		
    		if (isset($this->request->post['opt_upd_mode'])) {
      			$data['opt_upd_mode'] = $this->request->post['opt_upd_mode'];
		} else {
      			$data['opt_upd_mode'] = 'o_upd_add';
    		}

    		if (isset($this->request->post['val_upd_mode'])) {
      			$data['val_upd_mode'] = $this->request->post['val_upd_mode'];
		} else {
      			$data['val_upd_mode'] = 'v_rep_add';
    		}
    		
    		if (isset($this->request->post['qty_upd_mode'])) {
      			$data['qty_upd_mode'] = $this->request->post['qty_upd_mode'];
		} else {
      			$data['qty_upd_mode'] = 're';
    		}
    		
    		if (isset($this->request->post['price_upd_mode'])) {
      			$data['price_upd_mode'] = $this->request->post['price_upd_mode'];
		} else {
      			$data['price_upd_mode'] = 're';
    		}
    		
    		if (isset($this->request->post['points_upd_mode'])) {
      			$data['points_upd_mode'] = $this->request->post['points_upd_mode'];
		} else {
      			$data['points_upd_mode'] = 're';
    		}
    		
    		if (isset($this->request->post['wgt_upd_mode'])) {
      			$data['wgt_upd_mode'] = $this->request->post['wgt_upd_mode'];
		} else {
      			$data['wgt_upd_mode'] = 're';
    		}

    		////


if (isset($this->request->post['load_product_options'])) { /// load product option button

$this->session->data['success'] = $this->language->get('masstxt_succes_options_loaded');

} /// end load product option button


if (isset($this->request->post['mass_update'])) { /// update button

if ($this->user->hasPermission('modify', 'extension/module/masspoptiupd')) { /// modify permision

if (isset($this->request->post['selected'])) { /// avem produse selectate

if ($this->request->post['opt_upd_mode']=='o_del' OR (isset($this->request->post['product_option']))) { /// avem options update

if (isset($this->request->post['product_option'])) { $data['product_option']=$this->request->post['product_option']; }

foreach ($this->request->post['selected'] as $product_id) { /// scanare produse

if ($this->request->post['opt_upd_mode']=="o_upd_add" OR $this->request->post['opt_upd_mode']=="o_upd") { /// update mode (cu replace)

		if (isset($data['product_option'])) {
			
			foreach ($data['product_option'] as $product_option) {

			// find existing option:
			$query = $this->db->query("SELECT product_option_id FROM " . DB_PREFIX . "product_option WHERE product_id = '" . (int)$product_id . "' AND option_id = '" . (int)$product_option['option_id'] . "'");
			$existing_options = array();
			$existing_options = $query->rows;
			
			if (count($existing_options)>0) { // optiune existenta -> update
			
			foreach ($existing_options as $existing_opt) {
			
				if ($product_option['type'] == 'select' || $product_option['type'] == 'radio' || $product_option['type'] == 'checkbox' || $product_option['type'] == 'image') {
					$this->db->query("UPDATE " . DB_PREFIX . "product_option SET required = '" . (int)$product_option['required'] . "' WHERE product_option_id = '" . (int)$existing_opt['product_option_id'] . "'");
				
					$product_option_id = $existing_opt['product_option_id'];
					
				
					if (isset($product_option['product_option_value'])) {
						foreach ($product_option['product_option_value'] as $product_option_value) {
							
							
						// find existing value:
						$query = $this->db->query("SELECT product_option_value_id FROM " . DB_PREFIX . "product_option_value WHERE product_option_id = '" . (int)$product_option_id . "' AND product_id = '" . (int)$product_id . "' AND option_id = '" . (int)$product_option['option_id'] . "' AND option_value_id = '" . (int)$product_option_value['option_value_id'] . "'");
						$existing_values = array();
						$existing_values = $query->rows;
						
						if (count($existing_values)>0) { // valoare existenta -> update


switch ($this->request->post['qty_upd_mode']) {
    case "re":
        $quantity_sql=" quantity = '" . (int)$product_option_value['quantity'] . "',";
        break;
    case "mu":
        $quantity_sql=" quantity = (quantity * '" . (float)$product_option_value['quantity'] . "'),";
        break;
    case "ad":
        $quantity_sql=" quantity = (quantity + '" . (int)$product_option_value['quantity'] . "'),";
        break;
    case "su":
        $quantity_sql=" quantity = (quantity - '" . (int)$product_option_value['quantity'] . "'),";
        break;
    case "no":
        $quantity_sql="";
        break;
}
switch ($this->request->post['price_upd_mode']) {
    case "re":
        $price_sql=" price = '" . (float)$product_option_value['price'] . "',";
        break;
    case "mu":
        $price_sql=" price = (price * '" . (float)$product_option_value['price'] . "'),";
        break;
    case "ad":
        $price_sql=" price = (price + '" . (float)$product_option_value['price'] . "'),";
        break;
    case "su":
        $price_sql=" price = (price - '" . (float)$product_option_value['price'] . "'),";
        break;
    case "re2":
        $query = $this->db->query("SELECT price FROM " . DB_PREFIX . "product WHERE product_id = '" . (int)$product_id . "'");
	$re2_prod_val_tmp = $query->row;
        $re2_opt_val_tmp = $re2_prod_val_tmp['price'] * (float)$product_option_value['price'] / 100;
        $price_sql=" price = '" . (float)$re2_opt_val_tmp . "',";
        break;
    case "no":
        $price_sql="";
        break;
}
switch ($this->request->post['points_upd_mode']) {
    case "re":
        $points_sql=" points = '" . (int)$product_option_value['points'] . "',";
        break;
    case "mu":
        $points_sql=" points = (points * '" . (float)$product_option_value['points'] . "'),";
        break;
    case "ad":
        $points_sql=" points = (points + '" . (int)$product_option_value['points'] . "'),";
        break;
    case "su":
        $points_sql=" points = (points - '" . (int)$product_option_value['points'] . "'),";
        break;
    case "re2":
        $query = $this->db->query("SELECT points FROM " . DB_PREFIX . "product WHERE product_id = '" . (int)$product_id . "'");
	$re2_prod_val_tmp = $query->row;
        $re2_opt_val_tmp = $re2_prod_val_tmp['points'] * $product_option_value['points'] / 100;
        $points_sql=" points = '" . (int)$re2_opt_val_tmp . "',";
        break;
    case "no":
        $points_sql="";
        break;
}
switch ($this->request->post['wgt_upd_mode']) {
    case "re":
        $weight_sql=" weight = '" . (float)$product_option_value['weight'] . "',";
        break;
    case "mu":
        $weight_sql=" weight = (weight * '" . (float)$product_option_value['weight'] . "'),";
        break;
    case "ad":
        $weight_sql=" weight = (weight + '" . (float)$product_option_value['weight'] . "'),";
        break;
    case "su":
        $weight_sql=" weight = (weight - '" . (float)$product_option_value['weight'] . "'),";
        break;
    case "re2":
        $query = $this->db->query("SELECT weight FROM " . DB_PREFIX . "product WHERE product_id = '" . (int)$product_id . "'");
	$re2_prod_val_tmp = $query->row;
        $re2_opt_val_tmp = $re2_prod_val_tmp['weight'] * (float)$product_option_value['weight'] / 100;
        $weight_sql=" weight = '" . (float)$re2_opt_val_tmp . "',";
        break;
    case "no":
        $weight_sql="";
        break;
}

$this->db->query("UPDATE " . DB_PREFIX . "product_option_value SET".$quantity_sql." subtract = '" . (int)$product_option_value['subtract'] . "',".$price_sql." price_prefix = '" . $this->db->escape($product_option_value['price_prefix']) . "',".$points_sql." points_prefix = '" . $this->db->escape($product_option_value['points_prefix']) . "',".$weight_sql." weight_prefix = '" . $this->db->escape($product_option_value['weight_prefix']) . "' WHERE product_option_id = '" . (int)$product_option_id . "' AND product_id = '" . (int)$product_id . "' AND option_id = '" . (int)$product_option['option_id'] . "' AND option_value_id = '" . (int)$product_option_value['option_value_id'] . "'");

						} else { // valoare inexistenta -> insert
						if ($this->request->post['val_upd_mode']=="v_rep_add") { // only if set to add new
						
$this->db->query("INSERT INTO " . DB_PREFIX . "product_option_value SET product_option_value_id = '" . (int)$product_option_value['product_option_value_id'] . "', product_option_id = '" . (int)$product_option_id . "', product_id = '" . (int)$product_id . "', option_id = '" . (int)$product_option['option_id'] . "', option_value_id = '" . (int)$product_option_value['option_value_id'] . "', quantity = '" . (int)$product_option_value['quantity'] . "', subtract = '" . (int)$product_option_value['subtract'] . "', price = '" . (float)$product_option_value['price'] . "', price_prefix = '" . $this->db->escape($product_option_value['price_prefix']) . "', points = '" . (int)$product_option_value['points'] . "', points_prefix = '" . $this->db->escape($product_option_value['points_prefix']) . "', weight = '" . (float)$product_option_value['weight'] . "', weight_prefix = '" . $this->db->escape($product_option_value['weight_prefix']) . "'");
						}
						}
						
						}
					}
					
				} else { 
					$this->db->query("UPDATE " . DB_PREFIX . "product_option SET value = '" . $this->db->escape($product_option['value']) . "', required = '" . (int)$product_option['required'] . "' WHERE product_option_id = '" . (int)$existing_opt['product_option_id'] . "'");
				}

			} // end foreach optiuni existente
			
			
			} elseif ($this->request->post['opt_upd_mode']=="o_upd_add") { // optiune inexistenta -> insert (only if set to add new)
			
				if ($product_option['type'] == 'select' || $product_option['type'] == 'radio' || $product_option['type'] == 'checkbox' || $product_option['type'] == 'image') {

					if (isset($product_option['product_option_value']) AND $this->request->post['val_upd_mode']=="v_rep_add") { // only if set to add new values

					$this->db->query("INSERT INTO " . DB_PREFIX . "product_option SET product_option_id = '" . (int)$product_option['product_option_id'] . "', product_id = '" . (int)$product_id . "', option_id = '" . (int)$product_option['option_id'] . "', required = '" . (int)$product_option['required'] . "'");
					$product_option_id = $this->db->getLastId();
				
						foreach ($product_option['product_option_value'] as $product_option_value) {
$this->db->query("INSERT INTO " . DB_PREFIX . "product_option_value SET product_option_value_id = '" . (int)$product_option_value['product_option_value_id'] . "', product_option_id = '" . (int)$product_option_id . "', product_id = '" . (int)$product_id . "', option_id = '" . (int)$product_option['option_id'] . "', option_value_id = '" . (int)$product_option_value['option_value_id'] . "', quantity = '" . (int)$product_option_value['quantity'] . "', subtract = '" . (int)$product_option_value['subtract'] . "', price = '" . (float)$product_option_value['price'] . "', price_prefix = '" . $this->db->escape($product_option_value['price_prefix']) . "', points = '" . (int)$product_option_value['points'] . "', points_prefix = '" . $this->db->escape($product_option_value['points_prefix']) . "', weight = '" . (float)$product_option_value['weight'] . "', weight_prefix = '" . $this->db->escape($product_option_value['weight_prefix']) . "'");
						}
					}
				} else { 

					$this->db->query("INSERT INTO " . DB_PREFIX . "product_option SET product_option_id = '" . (int)$product_option['product_option_id'] . "', product_id = '" . (int)$product_id . "', option_id = '" . (int)$product_option['option_id'] . "', value = '" . $this->db->escape($product_option['value']) . "', required = '" . (int)$product_option['required'] . "'");
				}
					
			}
			}
		}

} else {

switch ($this->request->post['opt_upd_mode']) { /// update mode (fara replace)

    case "o_add": // keep old options and add new
		if (isset($data['product_option'])) {
			foreach ($data['product_option'] as $product_option) {
				if ($product_option['type'] == 'select' || $product_option['type'] == 'radio' || $product_option['type'] == 'checkbox' || $product_option['type'] == 'image') {

					if (isset($product_option['product_option_value'])) {
					
					$this->db->query("INSERT INTO " . DB_PREFIX . "product_option SET product_option_id = '" . (int)$product_option['product_option_id'] . "', product_id = '" . (int)$product_id . "', option_id = '" . (int)$product_option['option_id'] . "', required = '" . (int)$product_option['required'] . "'");
				
					$product_option_id = $this->db->getLastId();

						foreach ($product_option['product_option_value'] as $product_option_value) {
$this->db->query("INSERT INTO " . DB_PREFIX . "product_option_value SET product_option_value_id = '" . (int)$product_option_value['product_option_value_id'] . "', product_option_id = '" . (int)$product_option_id . "', product_id = '" . (int)$product_id . "', option_id = '" . (int)$product_option['option_id'] . "', option_value_id = '" . (int)$product_option_value['option_value_id'] . "', quantity = '" . (int)$product_option_value['quantity'] . "', subtract = '" . (int)$product_option_value['subtract'] . "', price = '" . (float)$product_option_value['price'] . "', price_prefix = '" . $this->db->escape($product_option_value['price_prefix']) . "', points = '" . (int)$product_option_value['points'] . "', points_prefix = '" . $this->db->escape($product_option_value['points_prefix']) . "', weight = '" . (float)$product_option_value['weight'] . "', weight_prefix = '" . $this->db->escape($product_option_value['weight_prefix']) . "'");
						}
					}
				} else { 
					$this->db->query("INSERT INTO " . DB_PREFIX . "product_option SET product_option_id = '" . (int)$product_option['product_option_id'] . "', product_id = '" . (int)$product_id . "', option_id = '" . (int)$product_option['option_id'] . "', value = '" . $this->db->escape($product_option['value']) . "', required = '" . (int)$product_option['required'] . "'");
				}					
			}
		}
        break;
    
    case "o_del_add": // remove old options and add new
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_option WHERE product_id = '" . (int)$product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_option_value WHERE product_id = '" . (int)$product_id . "'");
		
		if (isset($data['product_option'])) {
			foreach ($data['product_option'] as $product_option) {
				if ($product_option['type'] == 'select' || $product_option['type'] == 'radio' || $product_option['type'] == 'checkbox' || $product_option['type'] == 'image') {

					if (isset($product_option['product_option_value'])) {

					$this->db->query("INSERT INTO " . DB_PREFIX . "product_option SET product_option_id = '" . (int)$product_option['product_option_id'] . "', product_id = '" . (int)$product_id . "', option_id = '" . (int)$product_option['option_id'] . "', required = '" . (int)$product_option['required'] . "'");
				
					$product_option_id = $this->db->getLastId();
				
						foreach ($product_option['product_option_value'] as $product_option_value) {
$this->db->query("INSERT INTO " . DB_PREFIX . "product_option_value SET product_option_value_id = '" . (int)$product_option_value['product_option_value_id'] . "', product_option_id = '" . (int)$product_option_id . "', product_id = '" . (int)$product_id . "', option_id = '" . (int)$product_option['option_id'] . "', option_value_id = '" . (int)$product_option_value['option_value_id'] . "', quantity = '" . (int)$product_option_value['quantity'] . "', subtract = '" . (int)$product_option_value['subtract'] . "', price = '" . (float)$product_option_value['price'] . "', price_prefix = '" . $this->db->escape($product_option_value['price_prefix']) . "', points = '" . (int)$product_option_value['points'] . "', points_prefix = '" . $this->db->escape($product_option_value['points_prefix']) . "', weight = '" . (float)$product_option_value['weight'] . "', weight_prefix = '" . $this->db->escape($product_option_value['weight_prefix']) . "'");
						}
					}
				} else { 
					$this->db->query("INSERT INTO " . DB_PREFIX . "product_option SET product_option_id = '" . (int)$product_option['product_option_id'] . "', product_id = '" . (int)$product_id . "', option_id = '" . (int)$product_option['option_id'] . "', value = '" . $this->db->escape($product_option['value']) . "', required = '" . (int)$product_option['required'] . "'");
				}					
			}
		}
        break;

    case "o_del_opt_and_val": // Remove existing found options and all its values (values for update does not matter)

		if (isset($data['product_option'])) {
			
			foreach ($data['product_option'] as $product_option) {

			// find existing option:
			$query = $this->db->query("SELECT product_option_id FROM " . DB_PREFIX . "product_option WHERE product_id = '" . (int)$product_id . "' AND option_id = '" . (int)$product_option['option_id'] . "'");
			$existing_options = array();
			$existing_options = $query->rows;

			if (count($existing_options)>0) { // avem optiuni existente
			
			// Remove existing option:
			$this->db->query("DELETE FROM " . DB_PREFIX . "product_option WHERE product_id = '" . (int)$product_id . "' AND option_id = '" . (int)$product_option['option_id'] . "'");
			
			foreach ($existing_options as $existing_opt) {
			
				if ($product_option['type'] == 'select' || $product_option['type'] == 'radio' || $product_option['type'] == 'checkbox' || $product_option['type'] == 'image') {
					$product_option_id = $existing_opt['product_option_id'];
					if (isset($product_option['product_option_value'])) {
						foreach ($product_option['product_option_value'] as $product_option_value) {
						// Remove all values for existing option:
						$this->db->query("DELETE FROM " . DB_PREFIX . "product_option_value WHERE product_option_id = '" . (int)$product_option_id . "' AND product_id = '" . (int)$product_id . "' AND option_id = '" . (int)$product_option['option_id'] . "'");
						}
					}
				}
			
			} // end foreach existing options
			
			} // end avem optiuni existente
			
			} // end foreach product_option
			
		}

        break;

    case "o_del_val": // Remove only existing found values (options will not be removed)

		if (isset($data['product_option'])) {
			
			foreach ($data['product_option'] as $product_option) {

			// find existing option:
			$query = $this->db->query("SELECT product_option_id FROM " . DB_PREFIX . "product_option WHERE product_id = '" . (int)$product_id . "' AND option_id = '" . (int)$product_option['option_id'] . "'");
			$existing_options = array();
			$existing_options = $query->rows;
			
			if (count($existing_options)>0) { // avem optiuni existente
			
			foreach ($existing_options as $existing_opt) {
			
				if ($product_option['type'] == 'select' || $product_option['type'] == 'radio' || $product_option['type'] == 'checkbox' || $product_option['type'] == 'image') {
					$product_option_id = $existing_opt['product_option_id'];
					if (isset($product_option['product_option_value'])) {
						foreach ($product_option['product_option_value'] as $product_option_value) {
						// Remove existing values:
						$this->db->query("DELETE FROM " . DB_PREFIX . "product_option_value WHERE product_option_id = '" . (int)$product_option_id . "' AND product_id = '" . (int)$product_id . "' AND option_id = '" . (int)$product_option['option_id'] . "' AND option_value_id = '" . (int)$product_option_value['option_value_id'] . "'");
						}
					}
				}
			
			} // end foreach existing options
			
			} // end avem optiuni existente
			
			} // end foreach product_option
			
		}

        break;

    case "o_del": // Just remove old options.
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_option WHERE product_id = '" . (int)$product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_option_value WHERE product_id = '" . (int)$product_id . "'");
        break;
	
	} /// end switch

} /// end update mode

$this->db->query("UPDATE " . DB_PREFIX . "product p SET date_modified = NOW() WHERE product_id = '" . (int)$product_id . "'");

} /// end scanare produse

$this->cache->delete('product');

$this->session->data['success'] = $this->language->get('masstxt_succes_mass_update').count($this->request->post['selected']).$this->language->get('masstxt_succes_x_products_updated');

} else {  /// nu avem update

$this->session->data['error'] = $this->language->get('masstxt_error_nothing_set_for_update');

} /// end avem options update

} else {  /// nu avem produse selectate

$this->session->data['error'] = $this->language->get('masstxt_error_no_products_selected');

} /// end avem produse selectate

} else {

$this->session->data['error'] = $this->language->get('masstxt_error_permission');

} /// end modify permision

} /// end update button



$data['arr_lista_prod'] = array();

$prfx="";
$plus_join="";
$plus_where="";

if (isset($this->request->post['lista_prod']) OR isset($this->request->post['mass_update']) OR isset($this->request->post['load_product_options'])) { /// data filters

if (isset($this->request->post['product_category'])) { // categories
$plus_join=" LEFT JOIN " . DB_PREFIX . "product_to_category p2c ON (p.product_id = p2c.product_id)";
if ($plus_where=="") { $prfx=" WHERE "; } else { $prfx=" AND "; }
	if (in_array(0,$this->request->post['product_category'])) {
	$plus_join.=" LEFT JOIN " . DB_PREFIX . "product_to_category p2c0x ON (p.product_id = p2c0x.product_id)";
	$plus_where=$prfx."(p2c.category_id IN ('" .implode("', '", $this->request->post['product_category']). "') OR p2c0x.category_id IS NULL)";
	} else {
	$plus_where=$prfx."p2c.category_id IN ('" .implode("', '", $this->request->post['product_category']). "')";
	}
}

if (isset($this->request->post['manufacturer_ids'])) { // manufacturers
if ($plus_where=="") { $prfx=" WHERE "; } else { $prfx=" AND "; }
$plus_where.=$prfx."p.manufacturer_id IN ('" .implode("', '", $this->request->post['manufacturer_ids']). "')";
}

if (isset($this->request->post['filters_ids'])) { // filters
$plus_join.=" LEFT JOIN " . DB_PREFIX . "product_filter prfil ON (p.product_id = prfil.product_id)";
if ($plus_where=="") { $prfx=" WHERE "; } else { $prfx=" AND "; }
	if (in_array(0,$this->request->post['filters_ids'])) {
	$plus_join.=" LEFT JOIN " . DB_PREFIX . "product_filter pf0x ON (p.product_id = pf0x.product_id)";
	$plus_where.=$prfx."(prfil.filter_id IN ('" .implode("', '", $this->request->post['filters_ids']). "') OR pf0x.filter_id IS NULL)";
	} else {
	$plus_where.=$prfx."prfil.filter_id IN ('" .implode("', '", $this->request->post['filters_ids']). "')";
	}
}

if ($this->request->post['price_mmarese']!="") { // price greater than or equal to
if ($plus_where=="") { $prfx=" WHERE "; } else { $prfx=" AND "; }
$plus_where.=$prfx."p.price >= '" . (float)$this->request->post['price_mmarese'] . "'";
}

if ($this->request->post['price_mmicse']!="") { // price less than or equal to
if ($plus_where=="") { $prfx=" WHERE "; } else { $prfx=" AND "; }
$plus_where.=$prfx."p.price <= '" . (float)$this->request->post['price_mmicse'] . "'";
}

// discount price
if ($this->request->post['d_price_mmarese']!="" OR $this->request->post['d_price_mmicse']!="" OR $this->request->post['d_cust_group_filter']!="any" OR $this->request->post['d_date_start']!="" OR $this->request->post['d_date_end']!="") {
$plus_join.=" LEFT JOIN " . DB_PREFIX . "product_discount pdisc ON (p.product_id = pdisc.product_id)";
}
if ($this->request->post['d_cust_group_filter']!="any") { // cusomer group
if ($plus_where=="") { $prfx=" WHERE "; } else { $prfx=" AND "; }
$plus_where.=$prfx."pdisc.customer_group_id = '" . (int)$this->request->post['d_cust_group_filter'] . "'";
}
if ($this->request->post['d_price_mmarese']!="") { // greater than or equal to
if ($plus_where=="") { $prfx=" WHERE "; } else { $prfx=" AND "; }
$plus_where.=$prfx."pdisc.price >= '" . (float)$this->request->post['d_price_mmarese'] . "'";
}
if ($this->request->post['d_price_mmicse']!="") { // less than or equal to
if ($plus_where=="") { $prfx=" WHERE "; } else { $prfx=" AND "; }
$plus_where.=$prfx."pdisc.price <= '" . (float)$this->request->post['d_price_mmicse'] . "'";
}
if ($this->request->post['d_date_start']!="") { // date_start
if ($plus_where=="") { $prfx=" WHERE "; } else { $prfx=" AND "; }
$plus_where.=$prfx."pdisc.date_start >= '" . $this->db->escape($this->request->post['d_date_start']) . "'";
}
if ($this->request->post['d_date_end']!="") { // date_end
if ($plus_where=="") { $prfx=" WHERE "; } else { $prfx=" AND "; }
$plus_where.=$prfx."pdisc.date_end != '0000-00-00' AND pdisc.date_end <= '" . $this->db->escape($this->request->post['d_date_end']) . "'";
}
//

// special price
if ($this->request->post['s_price_mmarese']!="" OR $this->request->post['s_price_mmicse']!="" OR $this->request->post['s_cust_group_filter']!="any" OR $this->request->post['s_date_start']!="" OR $this->request->post['s_date_end']!="") {
$plus_join.=" LEFT JOIN " . DB_PREFIX . "product_special pspec ON (p.product_id = pspec.product_id)";
}
if ($this->request->post['s_cust_group_filter']!="any") { // cusomer group
if ($plus_where=="") { $prfx=" WHERE "; } else { $prfx=" AND "; }
$plus_where.=$prfx."pspec.customer_group_id = '" . (int)$this->request->post['s_cust_group_filter'] . "'";
}
if ($this->request->post['s_price_mmarese']!="") { // greater than or equal to
if ($plus_where=="") { $prfx=" WHERE "; } else { $prfx=" AND "; }
$plus_where.=$prfx."pspec.price >= '" . (float)$this->request->post['s_price_mmarese'] . "'";
}
if ($this->request->post['s_price_mmicse']!="") { // less than or equal to
if ($plus_where=="") { $prfx=" WHERE "; } else { $prfx=" AND "; }
$plus_where.=$prfx."pspec.price <= '" . (float)$this->request->post['s_price_mmicse'] . "'";
}
if ($this->request->post['s_date_start']!="") { // date_start
if ($plus_where=="") { $prfx=" WHERE "; } else { $prfx=" AND "; }
$plus_where.=$prfx."pspec.date_start >= '" . $this->db->escape($this->request->post['s_date_start']) . "'";
}
if ($this->request->post['s_date_end']!="") { // date_end
if ($plus_where=="") { $prfx=" WHERE "; } else { $prfx=" AND "; }
$plus_where.=$prfx."pspec.date_end != '0000-00-00' AND pspec.date_end <= '" . $this->db->escape($this->request->post['s_date_end']) . "'";
}
//

// Reward Points
if ($this->request->post['points_mmarese']!="") { // points greater than or equal to
if ($plus_where=="") { $prfx=" WHERE "; } else { $prfx=" AND "; }
$plus_where.=$prfx."p.points >= '" . (int)$this->request->post['points_mmarese'] . "'";
}
if ($this->request->post['points_mmicse']!="") { // points less than or equal to
if ($plus_where=="") { $prfx=" WHERE "; } else { $prfx=" AND "; }
$plus_where.=$prfx."p.points <= '" . (int)$this->request->post['points_mmicse'] . "'";
}

if ($this->request->post['r_p_mmarese']!="" OR $this->request->post['r_p_mmicse']!="" OR $this->request->post['r_p_cust_group_filter']!="any") {
$plus_join.=" LEFT JOIN " . DB_PREFIX . "product_reward prewp ON (p.product_id = prewp.product_id)";
}
if ($this->request->post['r_p_cust_group_filter']!="any") { // cusomer group
if ($plus_where=="") { $prfx=" WHERE "; } else { $prfx=" AND "; }
$plus_where.=$prfx."prewp.customer_group_id = '" . (int)$this->request->post['r_p_cust_group_filter'] . "'";
}
if ($this->request->post['r_p_mmarese']!="") { // greater than or equal to
if ($plus_where=="") { $prfx=" WHERE "; } else { $prfx=" AND "; }
$plus_where.=$prfx."prewp.points >= '" . (int)$this->request->post['r_p_mmarese'] . "'";
}
if ($this->request->post['r_p_mmicse']!="") { // less than or equal to
if ($plus_where=="") { $prfx=" WHERE "; } else { $prfx=" AND "; }
$plus_where.=$prfx."prewp.points <= '" . (int)$this->request->post['r_p_mmicse'] . "'";
}
//

if ($this->request->post['tax_class_filter']!="any") { // tax class
if ($plus_where=="") { $prfx=" WHERE "; } else { $prfx=" AND "; }
$plus_where.=$prfx."p.tax_class_id = '" . (int)$this->request->post['tax_class_filter'] . "'";
}

if ($this->request->post['stock_mmarese']!="") { // stock greater than or equal to
if ($plus_where=="") { $prfx=" WHERE "; } else { $prfx=" AND "; }
$plus_where.=$prfx."p.quantity >= '" . (int)$this->request->post['stock_mmarese'] . "'";
}

if ($this->request->post['stock_mmicse']!="") { // stock less than or equal to
if ($plus_where=="") { $prfx=" WHERE "; } else { $prfx=" AND "; }
$plus_where.=$prfx."p.quantity <= '" . (int)$this->request->post['stock_mmicse'] . "'";
}

if ($this->request->post['min_q_mmarese']!="") { // Minimum Quantity greater than or equal to
if ($plus_where=="") { $prfx=" WHERE "; } else { $prfx=" AND "; }
$plus_where.=$prfx."p.minimum >= '" . (int)$this->request->post['min_q_mmarese'] . "'";
}

if ($this->request->post['min_q_mmicse']!="") { // Minimum Quantity less than or equal to
if ($plus_where=="") { $prfx=" WHERE "; } else { $prfx=" AND "; }
$plus_where.=$prfx."p.minimum <= '" . (int)$this->request->post['min_q_mmicse'] . "'";
}

if ($this->request->post['stock_status_filter']!="any") { // Subtract Stock
if ($plus_where=="") { $prfx=" WHERE "; } else { $prfx=" AND "; }
$plus_where.=$prfx."p.stock_status_id = '" . (int)$this->request->post['stock_status_filter'] . "'";
}

if ($this->request->post['subtract_filter']!="any") { // Out Of Stock Status
if ($plus_where=="") { $prfx=" WHERE "; } else { $prfx=" AND "; }
$plus_where.=$prfx."p.subtract = '" . (int)$this->request->post['subtract_filter'] . "'";
}

if ($this->request->post['shipping_filter']!="any") { // Requires Shipping
if ($plus_where=="") { $prfx=" WHERE "; } else { $prfx=" AND "; }
$plus_where.=$prfx."p.shipping = '" . (int)$this->request->post['shipping_filter'] . "'";
}

if ($this->request->post['date_mmarese']!="") { // Date Available greater than or equal to
if ($plus_where=="") { $prfx=" WHERE "; } else { $prfx=" AND "; }
$plus_where.=$prfx."p.date_available >= '" . $this->db->escape($this->request->post['date_mmarese']) . "'";
}

if ($this->request->post['date_mmicse']!="") { // Date Available less than or equal to
if ($plus_where=="") { $prfx=" WHERE "; } else { $prfx=" AND "; }
$plus_where.=$prfx."p.date_available != '0000-00-00' AND p.date_available <= '" . $this->db->escape($this->request->post['date_mmicse']) . "'";
}

if ($this->request->post['date_added_mmarese']!="") { // Date added greater than or equal to
if ($plus_where=="") { $prfx=" WHERE "; } else { $prfx=" AND "; }
$plus_where.=$prfx."p.date_added >= '" . $this->db->escape($this->request->post['date_added_mmarese']) . "'";
}

if ($this->request->post['date_added_mmicse']!="") { // Date added less than or equal to
if ($plus_where=="") { $prfx=" WHERE "; } else { $prfx=" AND "; }
$plus_where.=$prfx."p.date_added <= '" . $this->db->escape($this->request->post['date_added_mmicse']) . "'";
}

if ($this->request->post['date_modified_mmarese']!="") { // Date modified greater than or equal to
if ($plus_where=="") { $prfx=" WHERE "; } else { $prfx=" AND "; }
$plus_where.=$prfx."p.date_modified >= '" . $this->db->escape($this->request->post['date_modified_mmarese']) . "'";
}

if ($this->request->post['date_modified_mmicse']!="") { // Date modified less than or equal to
if ($plus_where=="") { $prfx=" WHERE "; } else { $prfx=" AND "; }
$plus_where.=$prfx."p.date_modified <= '" . $this->db->escape($this->request->post['date_modified_mmicse']) . "'";
}

if ($this->request->post['prod_status']!="any") { // status
if ($plus_where=="") { $prfx=" WHERE "; } else { $prfx=" AND "; }
$plus_where.=$prfx."p.status = '" . (int)$this->request->post['prod_status'] . "'";
}

if ($this->request->post['store_filter']!="any") { // store
$plus_join.=" LEFT JOIN " . DB_PREFIX . "product_to_store pts ON (p.product_id = pts.product_id)";
if ($plus_where=="") { $prfx=" WHERE "; } else { $prfx=" AND "; }
$plus_where.=$prfx."pts.store_id = '" . (int)$this->request->post['store_filter'] . "'";
}

if ($this->request->post['filter_attr']!="any") { // attribute
$plus_join.=" LEFT JOIN " . DB_PREFIX . "product_attribute pattr ON (p.product_id = pattr.product_id)";
if ($plus_where=="") { $prfx=" WHERE "; } else { $prfx=" AND "; }
$plus_where.=$prfx."pattr.attribute_id = '" . (int)$this->request->post['filter_attr'] . "'";
}

if ($this->request->post['filter_opti']!="any") { // option
$plus_join.=" LEFT JOIN " . DB_PREFIX . "product_option po ON (p.product_id = po.product_id)";
if ($plus_where=="") { $prfx=" WHERE "; } else { $prfx=" AND "; }
$plus_where.=$prfx."po.option_id = '" . (int)$this->request->post['filter_opti'] . "'";
}

if ($this->request->post['filter_attr_val']!="") { // attribute value (text)
if ($this->request->post['filter_attr']=="any") { $plus_join.=" LEFT JOIN " . DB_PREFIX . "product_attribute pattr ON (p.product_id = pattr.product_id)"; }
if ($plus_where=="") { $prfx=" WHERE "; } else { $prfx=" AND "; }
$plus_where.=$prfx."pattr.text LIKE '%" . $this->db->escape($this->request->post['filter_attr_val']) . "%'";
}

if ($this->request->post['filter_opti_val']!="any") { // option value
$plus_join.=" LEFT JOIN " . DB_PREFIX . "product_option_value pov ON (p.product_id = pov.product_id)";
if ($plus_where=="") { $prfx=" WHERE "; } else { $prfx=" AND "; }
$plus_where.=$prfx."pov.option_value_id = '" . (int)$this->request->post['filter_opti_val'] . "'";
}

if ($this->request->post['filter_name']!="") { // part of name
if ($plus_where=="") { $prfx=" WHERE "; } else { $prfx=" AND "; }
if(version_compare(VERSION, '1.5.4.1', '>')) {
	$plus_where.=$prfx."pd.name LIKE '%" . $this->db->escape($this->request->post['filter_name']) . "%'";
	} elseif (version_compare(VERSION, '1.5.1.2', '>')) {
	$plus_where.=$prfx."LCASE(pd.name) LIKE '%" . $this->db->escape(utf8_strtolower($this->request->post['filter_name'])) . "%'";
	} else {
	$plus_where.=$prfx."LCASE(pd.name) LIKE '%" . $this->db->escape(strtolower($this->request->post['filter_name'])) . "%'";
	}
}

if ($this->request->post['filter_model']!="") { // part of model
if ($plus_where=="") { $prfx=" WHERE "; } else { $prfx=" AND "; }
if(version_compare(VERSION, '1.5.4.1', '>')) {
	$plus_where.=$prfx."p.model LIKE '%" . $this->db->escape($this->request->post['filter_model']) . "%'";
	} elseif (version_compare(VERSION, '1.5.1.2', '>')) {
	$plus_where.=$prfx."LCASE(p.model) LIKE '%" . $this->db->escape(utf8_strtolower($this->request->post['filter_model'])) . "%'";
	} else {
	$plus_where.=$prfx."LCASE(p.model) LIKE '%" . $this->db->escape(strtolower($this->request->post['filter_model'])) . "%'";
	}
}

if ($this->request->post['filter_tag']!="") { // tag
if ($plus_where=="") { $prfx=" WHERE "; } else { $prfx=" AND "; }
if(version_compare(VERSION, '1.5.3.1', '>')) {
	$plus_where.=$prfx."LCASE(pd.tag) LIKE '%" . $this->db->escape(utf8_strtolower($this->request->post['filter_tag'])) . "%'";
	} else {
	$plus_join.=" LEFT JOIN " . DB_PREFIX . "product_tag ptag ON (p.product_id = ptag.product_id)";	
	$plus_where.=$prfx."LCASE(ptag.tag) LIKE '%" . $this->db->escape(utf8_strtolower($this->request->post['filter_tag'])) . "%'";
	}
}

if ($this->request->post['filter_sku']!="") {
if ($plus_where=="") { $prfx=" WHERE "; } else { $prfx=" AND "; }
$plus_where.=$prfx."p.sku LIKE '%" . $this->db->escape($this->request->post['filter_sku']) . "%'";
}
if ($this->request->post['filter_upc']!="") {
if ($plus_where=="") { $prfx=" WHERE "; } else { $prfx=" AND "; }
$plus_where.=$prfx."p.upc LIKE '%" . $this->db->escape($this->request->post['filter_upc']) . "%'";
}
if ($this->request->post['filter_ean']!="") {
if ($plus_where=="") { $prfx=" WHERE "; } else { $prfx=" AND "; }
$plus_where.=$prfx."p.ean LIKE '%" . $this->db->escape($this->request->post['filter_ean']) . "%'";
}
if ($this->request->post['filter_jan']!="") {
if ($plus_where=="") { $prfx=" WHERE "; } else { $prfx=" AND "; }
$plus_where.=$prfx."p.jan LIKE '%" . $this->db->escape($this->request->post['filter_jan']) . "%'";
}
if ($this->request->post['filter_isbn']!="") {
if ($plus_where=="") { $prfx=" WHERE "; } else { $prfx=" AND "; }
$plus_where.=$prfx."p.isbn LIKE '%" . $this->db->escape($this->request->post['filter_isbn']) . "%'";
}
if ($this->request->post['filter_mpn']!="") {
if ($plus_where=="") { $prfx=" WHERE "; } else { $prfx=" AND "; }
$plus_where.=$prfx."p.mpn LIKE '%" . $this->db->escape($this->request->post['filter_mpn']) . "%'";
}
if ($this->request->post['filter_location']!="") {
if ($plus_where=="") { $prfx=" WHERE "; } else { $prfx=" AND "; }
$plus_where.=$prfx."p.location LIKE '%" . $this->db->escape($this->request->post['filter_location']) . "%'";
}

} /// end data filters



if ($plus_where=="") { $prfx=" WHERE "; } else { $prfx=" AND "; }
$plus_where.=$prfx."pd.language_id = '" . (int)$this->config->get('config_language_id') . "'";

$final_query="SELECT p.product_id, p.model, p.price, p.quantity, p.status, pd.name FROM " . DB_PREFIX . "product p 
LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) 
".$plus_join.$plus_where." 
GROUP BY p.product_id 
ORDER BY pd.name ASC";


if (isset($this->request->post['max_prod_pag'])) {
  	$data['max_prod_pag'] = $this->request->post['max_prod_pag'];
	} else {
  	$data['max_prod_pag'] = 500; // defult max prod per pag
}
if (isset($this->request->post['curent_pag'])) {
  	$data['curent_pag'] = $this->request->post['curent_pag'];
	} else {
  	$data['curent_pag'] = 1;
}

$total_prod_query="SELECT COUNT(DISTINCT p.product_id) AS total FROM " . DB_PREFIX . "product p 
LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) 
".$plus_join.$plus_where;
$query = $this->db->query($total_prod_query);

$data['total_prod_filtered'] = $query->row['total'];

$data['total_pag'] = ceil($data['total_prod_filtered'] / $data['max_prod_pag']);

if ($data['curent_pag']>$data['total_pag']) { $data['curent_pag']=$data['total_pag']; }

if ($data['total_pag']>1) {
	$start_rec=($data['curent_pag']-1)*$data['max_prod_pag'];
	$plus_limit=" LIMIT " . (int)$start_rec . "," . (int)$data['max_prod_pag'];
	$final_query.=$plus_limit;
}

$query = $this->db->query($final_query);

$data['arr_lista_prod'] = $query->rows;


if (isset($this->request->post['lista_prod'])) { /// preview button

$this->session->data['success'] = $this->language->get('masstxt_succes_products_filtered');

} /// end preview button



		$data['user_token'] = $this->session->data['user_token']; ////
		
		if (isset($this->session->data['error'])) {
    		$data['error_warning'] = $this->session->data['error'];
    
			unset($this->session->data['error']);
 		} elseif (isset($this->error['warning'])) {
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

  		$data['breadcrumbs'] = array();
 

   		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'], true)
   		);

   		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_extension'),
			'href' => $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true)
   		);
		
   		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('extension/module/masspoptiupd', 'user_token=' . $this->session->data['user_token'], true)
   		);
		
		$data['cancel'] = $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true);
		
		$data['button_cancel'] = $this->language->get('button_cancel');

		
		$data['action'] = $this->url->link('extension/module/masspoptiupd', 'user_token=' . $this->session->data['user_token'], true);

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');
		
		$this->response->setOutput($this->load->view('extension/module/masspoptiupd', $data));
	}

}
?>
