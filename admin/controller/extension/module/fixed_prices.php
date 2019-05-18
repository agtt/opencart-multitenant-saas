<?php
#############################################################################
   #
#############################################################################
class ControllerExtensionModuleFixedPrices extends Controller {
	private $error = array();

	public function index() {
	
	
	$this->template = 'extension/module/fixed_prices.tpl';
	if(isset($this->session->data['user_token']) ){
	$this->session->data['token']=$this->session->data['user_token'];
	$this->template='extension/module/fixed_prices';
	}
		$this->load->language('extension/module/fixed_prices');

		$this->document->setTitle( $this->language->get('heading_title'));

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && ($this->validate())) {
			$this->model_setting_setting->editSetting('module_fixed_prices', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

		
			$this->response->redirect($this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true));
		}
		
	
	$this->db->query("CREATE  TABLE IF NOT EXISTS `" . DB_PREFIX . "product_fixed_prices` ( 
  				`fixed_prices_id` int(11) NOT NULL auto_increment, 
  				`product_id` int( 11  )  NOT  NULL default  '0',
 				`code` char( 3  )  NOT  NULL default  '',
 				`products_price` decimal( 15, 4  )  NOT  NULL default  '0.0000' ,
 				PRIMARY KEY  (`fixed_prices_id`)
 	)");
	
	$this->db->query("CREATE  TABLE IF NOT EXISTS `" . DB_PREFIX . "product_option_fixed_prices` ( 
  				`fixed_option_prices_id` int(11) NOT NULL auto_increment, 
 				`product_option_value_id` int( 11  )  NOT  NULL default  '0',
 				`code` char( 3  )  NOT  NULL default  '',
 				`option_price` decimal( 15, 4  )  NOT  NULL default  '0.0000' ,
 				PRIMARY KEY  (`fixed_option_prices_id`)
 	)");
	
	$this->db->query("CREATE  TABLE IF NOT EXISTS `" . DB_PREFIX . "product_special_prices` ( 
  				`fixed_special_prices_id` int(11) NOT NULL auto_increment, 
 				`product_special_id` int( 11  )  NOT  NULL default  '0',
 				`code` char( 3  )  NOT  NULL default  '',
 				`price` decimal( 15, 4  )  NOT  NULL default  '0.0000' ,
 				PRIMARY KEY  (`fixed_special_prices_id`)
 	)");
	$this->db->query("CREATE  TABLE IF NOT EXISTS `" . DB_PREFIX . "product_discount_prices` ( 
  				`fixed_discount_prices_id` int(11) NOT NULL auto_increment, 
 				`product_discount_id` int( 11  )  NOT  NULL default  '0',
 				`code` char( 3  )  NOT  NULL default  '',
 				`price` decimal( 15, 4  )  NOT  NULL default  '0.0000' ,
 				PRIMARY KEY  (`fixed_discount_prices_id`)
 	)");
	
		$data['heading_title'] = $this->language->get('heading_title');
		$data['enable_fixed_prices'] = $this->language->get('enable_fixed_prices');

  	
		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');

		if (isset($this->error['warning']))
		{
			$data['error_warning'] = $this->error['warning'];
		}
		else
		{
			$data['error_warning'] = '';
		}
		if (isset($this->error['error_sort_order']))
		{
			$data['error_sort_order'] = $this->error['error_sort_order'];
		}
		else
		{
			$data['error_sort_order'] = '';
		}
		if (isset($this->error['error_limit']))
		{
			$data['error_limit'] = $this->error['error_limit'];
		}
		else
		{
			$data['error_limit'] = '';
		}

  		$this->document->breadcrumbs = array();

   		$this->document->breadcrumbs[] = array(
       		'href'      => (HTTPS_SERVER . 'index.php?route=common/home&token=' . $this->session->data['token']),
       		'text'      => $this->language->get('text_home'),
      		'separator' => FALSE
   		);

   		$this->document->breadcrumbs[] = array(
       		'href'      => (HTTPS_SERVER . 'index.php?route=extension/extension&token=' . $this->session->data['token']),
       		'text'      => $this->language->get('text_module'),
      		'separator' => ' :: '
   		);

   		$this->document->breadcrumbs[] = array(
       		'href'      => (HTTPS_SERVER . 'index.php?route=extension/module/fixed_prices&token=' . $this->session->data['token']),
       		'text'      => $this->language->get('heading_title'),
      		'separator' => ' :: '
   		);

$data['action'] = $this->url->link('extension/module/fixed_prices', 'user_token=' . $this->session->data['user_token'], true);

		$data['cancel'] = $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true);
		
		if (isset($this->request->post['fixed_prices'])) {
			$data['fixed_prices'] = $this->request->post['module_fixed_prices_status'];
		} else {
			$data['fixed_prices'] = $this->config->get('module_fixed_prices_status');
		}
		$this->id       = 'fixed_prices';
		$this->children = array(
			'common/header',	
			'common/footer'	
		);
		
		
			
			$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_module'),
			'href' => $this->url->link('extension/extension', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $data['heading_title'] ,
			'href' => $this->url->link('module/product_shipping_limit', 'token=' . $this->session->data['token'], 'SSL')
		);


		$data['text_edit'] = $this->language->get('text_edit');
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');
		
		$this->response->setOutput($this->load->view($this->template, $data));
	}

	private function validate() {
		if (!$this->user->hasPermission('modify', 'extension/module/fixed_prices')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
	
		if (!$this->error) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
}
?>