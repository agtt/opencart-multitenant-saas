<?php
class ModelExtensionProductExtra extends Model {
	
	/**
	 * @param $language - used to fetch product related translations
	 */
	public function getProducts($data = array(), $language = null) {
		if($language == null){
			$selected_language = (int)$this->config->get('config_language_id');
		} else {
			$selected_language = (int)$language;
		}
		if ($data) {
			//Used because need a link to another table
			if (isset($data['filter_store']) && !is_null($data['filter_store'])) {
				$sql = "SELECT DISTINCT 
							pd.*, 
							p.* 
							/*model-hook-fields*/
						FROM 
							" . DB_PREFIX . "product p 
								/*mode-hook-left-join-1*/
								LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id AND pd.language_id = " . $selected_language . ") LEFT JOIN " . DB_PREFIX . "product_to_store pts ON (p.product_id = pts.product_id) LEFT JOIN " . DB_PREFIX . "product_to_category ptc ON (p.product_id=ptc.product_id) LEFT JOIN " . DB_PREFIX . "product_filter pf ON (p.product_id=pf.product_id) LEFT JOIN " . DB_PREFIX . "manufacturer m ON (p.manufacturer_id = m.manufacturer_id) LEFT JOIN " . DB_PREFIX . "tax_class tc ON (p.tax_class_id = tc.tax_class_id) WHERE pd.language_id = " . $selected_language . "";
			} else {
				$sql = "SELECT DISTINCT 
							ptc.*, 
							pd.*, 
							p.*
							/*model-hook-fields*/
						FROM 
							" . DB_PREFIX . "product p 
								/*mode-hook-left-join-2*/
								LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id AND pd.language_id = " . $selected_language . ") LEFT JOIN " . DB_PREFIX . "product_to_category ptc ON (p.product_id=ptc.product_id) LEFT JOIN " . DB_PREFIX . "product_filter pf ON (p.product_id=pf.product_id) LEFT JOIN " . DB_PREFIX . "manufacturer m ON (p.manufacturer_id = m.manufacturer_id) LEFT JOIN " . DB_PREFIX . "tax_class tc ON (p.tax_class_id = tc.tax_class_id) WHERE pd.language_id = " . $selected_language . "";
			}
			if (isset($data['filter_name']) && !is_null($data['filter_name'])) {
				$sql .= " AND LCASE(pd.name) LIKE '%" . $this->db->escape(mb_strtolower($data['filter_name'])) . "%'";
			}

			if (isset($data['filter_meta_title']) && !is_null($data['filter_meta_title'])) {
				$sql .= " AND LCASE(pd.meta_title) LIKE '%" . $this->db->escape(mb_strtolower($data['filter_meta_title'])) . "%'";
			}

			if (isset($data['filter_meta_keyword']) && !is_null($data['filter_meta_keyword'])) {
				$sql .= " AND LCASE(pd.meta_keyword) LIKE '%" . $this->db->escape(mb_strtolower($data['filter_meta_keyword'])) . "%'";
			}

			if (isset($data['filter_meta_description']) && !is_null($data['filter_meta_description'])) {
				$sql .= " AND LCASE(pd.meta_description) LIKE '%" . $this->db->escape(mb_strtolower($data['filter_meta_description'])) . "%'";
			}
			
			if (isset($data['filter_sku']) && !is_null($data['filter_sku'])) {
				$sql .= " AND LCASE(p.sku) LIKE '%" . $this->db->escape(mb_strtolower($data['filter_sku'])) . "%'";
			}
			
			if (isset($data['filter_upc']) && !is_null($data['filter_upc'])) {
				$sql .= " AND LCASE(p.upc) LIKE '%" . $this->db->escape(mb_strtolower($data['filter_upc'])) . "%'";
			}
			
			if (isset($data['filter_location']) && !is_null($data['filter_location'])) {
				$sql .= " AND LCASE(p.location) LIKE '%" . $this->db->escape(mb_strtolower($data['filter_location'])) . "%'";
			}
			if (isset($data['filter_date_available']) && !is_null($data['filter_date_available'])) {
				$sql .= " AND LCASE(p.date_available) LIKE '%" . $this->db->escape(mb_strtolower($data['filter_date_available'])) . "%'";
			}

			if (isset($data['filter_model']) && !is_null($data['filter_model'])) {
				$sql .= " AND LCASE(p.model) LIKE '%" . $this->db->escape(mb_strtolower($data['filter_model'])) . "%'";
			}
			if (isset($data['filter_id']) && !is_null($data['filter_id'])) {
				if(count(explode("&gt;", urldecode($data['filter_id']))) > 1){
					$between = explode("&gt;", urldecode($data['filter_id']));
					if(trim($between[1]) == ""){ //case 10>
						$sql .= " AND p.product_id >= " . (float)$this->db->escape($between[0]);
					} else { //case 5>10
						$sql .= " AND p.product_id between " . (float)$this->db->escape($between[0]) . " AND " . (float)$this->db->escape($between[1]) . "";
					}
				} elseif(count(explode("&lt;", urldecode($data['filter_id']))) > 1){
					$between = explode("&lt;", urldecode($data['filter_id']));
					if(trim($between[0]) == ""){ //case <10
						$sql .= " AND p.product_id <= " . (float)$this->db->escape($between[1]);
					} else { //case 5<10
						$sql .= " AND p.product_id between " . (float)$this->db->escape($between[0]) . " AND " . (float)$this->db->escape($between[1]) . "";
					}
				} else {
					$sql .= " AND p.product_id = '" . $this->db->escape($data['filter_id']) . "'";
				}
			}
			if (isset($data['filter_price']) && !is_null($data['filter_price'])) {
				if(count(explode("&gt;", urldecode($data['filter_price']))) > 1){
					$between = explode("&gt;", urldecode($data['filter_price']));
					if(trim($between[1]) == ""){ //case 10>
						$sql .= " AND p.price >= " . (float)$this->db->escape($between[0]);
					} else { //case 5>10
						$sql .= " AND p.price between " . (float)$this->db->escape($between[0]) . " AND " . (float)$this->db->escape($between[1]) . "";
					}
				} elseif(count(explode("&lt;", urldecode($data['filter_price']))) > 1){
					$between = explode("&lt;", urldecode($data['filter_price']));
					if(trim($between[0]) == ""){ //case <10
						$sql .= " AND p.price <= " . (float)$this->db->escape($between[1]);
					} else { //case 5<10
						$sql .= " AND p.price between " . (float)$this->db->escape($between[0]) . " AND " . (float)$this->db->escape($between[1]) . "";
					}
				} else {
					$sql .= " AND p.price = '" . $this->db->escape($data['filter_price']) . "'";
				}
			}
			if (isset($data['filter_sort_order']) && !is_null($data['filter_sort_order'])) {
				if(count(explode("&gt;", urldecode($data['filter_sort_order']))) > 1){
					$between = explode("&gt;", urldecode($data['filter_sort_order']));
					if(trim($between[1]) == ""){ //case 10>
						$sql .= " AND p.sort_order >= " . (float)$this->db->escape($between[0]);
					} else { //case 5>10
						$sql .= " AND p.sort_order between " . (float)$this->db->escape($between[0]) . " AND " . (float)$this->db->escape($between[1]) . "";
					}
				} elseif(count(explode("&lt;", urldecode($data['filter_sort_order']))) > 1){
					$between = explode("&lt;", urldecode($data['filter_sort_order']));
					if(trim($between[0]) == ""){ //case <10
						$sql .= " AND p.sort_order <= " . (float)$this->db->escape($between[1]);
					} else { //case 5<10
						$sql .= " AND p.sort_order between " . (float)$this->db->escape($between[0]) . " AND " . (float)$this->db->escape($between[1]) . "";
					}
				} else {
					$sql .= " AND p.sort_order = '" . $this->db->escape($data['filter_sort_order']) . "'";
				}
			}
			if (isset($data['filter_quantity']) && !is_null($data['filter_quantity'])) {
				if(count(explode("&gt;", urldecode($data['filter_quantity']))) > 1){
					$between = explode("&gt;", urldecode($data['filter_quantity']));
					if(trim($between[1]) == ""){ //case 10>
						$sql .= " AND p.quantity >= " . (int)$this->db->escape($between[0]);
					} else { //case 5>10
						$sql .= " AND p.quantity between " . (int)$this->db->escape($between[0]) . " AND " . (int)$this->db->escape($between[1]) . "";
					}
				} elseif(count(explode("&lt;", urldecode($data['filter_quantity']))) > 1){
					$between = explode("&lt;", urldecode($data['filter_quantity']));
					if(trim($between[0]) == ""){ //case <10
						$sql .= " AND p.quantity <= " . (int)$this->db->escape($between[1]);
					} else { //case 5<10
						$sql .= " AND p.quantity between " . (int)$this->db->escape($between[0]) . " AND " . (int)$this->db->escape($between[1]) . "";
					}
				} else {
					$sql .= " AND p.quantity = '" . $this->db->escape($data['filter_quantity']) . "'";
				}
			}

			if (isset($data['filter_minimum']) && !is_null($data['filter_minimum'])) {
				if(count(explode("&gt;", urldecode($data['filter_minimum']))) > 1){
					$between = explode("&gt;", urldecode($data['filter_minimum']));
					if(trim($between[1]) == ""){ //case 10>
						$sql .= " AND p.minimum >= " . (int)$this->db->escape($between[0]);
					} else { //case 5>10
						$sql .= " AND p.minimum between " . (int)$this->db->escape($between[0]) . " AND " . (int)$this->db->escape($between[1]) . "";
					}
				} elseif(count(explode("&lt;", urldecode($data['filter_minimum']))) > 1){
					$between = explode("&lt;", urldecode($data['filter_minimum']));
					if(trim($between[0]) == ""){ //case <10
						$sql .= " AND p.minimum <= " . (int)$this->db->escape($between[1]);
					} else { //case 5<10
						$sql .= " AND p.minimum between " . (int)$this->db->escape($between[0]) . " AND " . (int)$this->db->escape($between[1]) . "";
					}
				} else {
					$sql .= " AND p.minimum = '" . $this->db->escape($data['filter_minimum']) . "'";
				}
			}
			
			if (isset($data['filter_weight']) && !is_null($data['filter_weight'])) {
				if(count(explode("&gt;", urldecode($data['filter_weight']))) > 1){
					$between = explode("&gt;", urldecode($data['filter_weight']));
					if(trim($between[1]) == ""){ //case 10>
						$sql .= " AND p.weight >= " . (int)$this->db->escape($between[0]);
					} else { //case 5>10
						$sql .= " AND p.weight between " . (int)$this->db->escape($between[0]) . " AND " . (int)$this->db->escape($between[1]) . "";
					}
				} elseif(count(explode("&lt;", urldecode($data['filter_weight']))) > 1){
					$between = explode("&lt;", urldecode($data['filter_weight']));
					if(trim($between[0]) == ""){ //case <10
						$sql .= " AND p.weight <= " . (int)$this->db->escape($between[1]);
					} else { //case 5<10
						$sql .= " AND p.weight between " . (int)$this->db->escape($between[0]) . " AND " . (int)$this->db->escape($between[1]) . "";
					}
				} else {
					$sql .= " AND p.weight = '" . $this->db->escape($data['filter_weight']) . "'";
				}
			}
			
			if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
				$sql .= " AND p.status = '" . (int)$data['filter_status'] . "'";
			}

			if (isset($data['filter_subtract']) && !is_null($data['filter_subtract'])) {
				$sql .= " AND p.subtract = '" . (int)$data['filter_subtract'] . "'";
			}
			if (isset($data['filter_shipping']) && !is_null($data['filter_shipping'])) {
				$sql .= " AND p.shipping = '" . (int)$data['filter_shipping'] . "'";
			}
			
			if (isset($data['filter_store']) && !is_null($data['filter_store'])) {
				$sql .= " AND pts.store_id = '" . (int)$data['filter_store'] . "'";
			}
			
			if (isset($data['filter_category']) && !is_null($data['filter_category'])) {
				$sql .= " AND ptc.category_id = '" . (int)$data['filter_category'] . "'";
			}

			if (isset($data['filter_filter']) && !is_null($data['filter_filter'])) {
				$sql .= " AND pf.filter_id = '" . (int)$data['filter_filter'] . "'";
			}
			
			if (isset($data['filter_manufacturer']) && !is_null($data['filter_manufacturer'])) {
				$sql .= " AND p.manufacturer_id = '" . (int)$data['filter_manufacturer'] . "'";
			}
			
			if (isset($data['filter_weight_class']) && !is_null($data['filter_weight_class'])) {
				$sql .= " AND p.weight_class_id = '" . (int)$data['filter_weight_class'] . "'";
			}
			
			if (isset($data['filter_tax_class']) && !is_null($data['filter_tax_class'])) {
				if ($data['filter_tax_class'] == -1) {
					$sql .= " AND p.tax_class_id = ''";
				} else {
					$sql .= " AND p.tax_class_id = '" . (int)$data['filter_tax_class'] . "'";
				}
			}
			
			if (isset($data['filter_length_class']) && !is_null($data['filter_length_class'])) {
				$sql .= " AND p.length_class_id = '" . (int)$data['filter_length_class'] . "'";
			}
			
			if (isset($data['filter_stock_status']) && !is_null($data['filter_stock_status'])) {
				$sql .= " AND p.stock_status_id = '" . (int)$data['filter_stock_status'] . "'";
			}
			
			if (isset($data['product_id']) && !is_null($data['product_id'])) {
				$sql .= " AND p.product_id = '" . (int)$data['product_id'] . "'";
			}
			if (isset($data['filter_ean']) && !is_null($data['filter_ean'])) {
			    $sql .= " AND LCASE(p.ean) LIKE '%" . $this->db->escape(strtolower($data['filter_ean'])) . "%'";
			}
			if (isset($data['filter_jan']) && !is_null($data['filter_jan'])) {
			    $sql .= " AND LCASE(p.jan) LIKE '%" . $this->db->escape(strtolower($data['filter_jan'])) . "%'";
			}
			if (isset($data['filter_mpn']) && !is_null($data['filter_mpn'])) {
			    $sql .= " AND LCASE(p.mpn) LIKE '%" . $this->db->escape(strtolower($data['filter_mpn'])) . "%'";
			}
			if (isset($data['filter_isbn']) && !is_null($data['filter_isbn'])) {
			    $sql .= " AND LCASE(p.isbn) LIKE '%" . $this->db->escape(strtolower($data['filter_isbn'])) . "%'";
			}
			/*model-hook-1*/

			if (isset($data['filter_points']) && !is_null($data['filter_points'])) {
				if(count(explode("&gt;", urldecode($data['filter_points']))) > 1){
					$between = explode("&gt;", urldecode($data['filter_points']));
					if(trim($between[1]) == ""){ //case 10>
						$sql .= " AND p.points >= " . (int)$this->db->escape($between[0]);
					} else { //case 5>10
						$sql .= " AND p.points between " . (int)$this->db->escape($between[0]) . " AND " . (int)$this->db->escape($between[1]) . "";
					}
				} elseif(count(explode("&lt;", urldecode($data['filter_points']))) > 1){
					$between = explode("&lt;", urldecode($data['filter_points']));
					if(trim($between[0]) == ""){ //case <10
						$sql .= " AND p.points <= " . (int)$this->db->escape($between[1]);
					} else { //case 5<10
						$sql .= " AND p.points between " . (int)$this->db->escape($between[0]) . " AND " . (int)$this->db->escape($between[1]) . "";
					}
				} else {
					$sql .= " AND p.points = '" . $this->db->escape($data['filter_points']) . "'";
				}
			}

			$sql .= " AND p.product_id != -1";

			$sort_data = array(
				'p.product_id',
				'pd.name',
				'pd.meta_title',
				'pd.meta_keyword',
				'pd.meta_description',
				'p.model',
				'p.quantity',
				'p.minimum',
				'p.status',
				'p.subtract',
				'p.shipping',
				'p.sort_order',
				'p.price',
				'm.name',
				'p.weight',
				'p.sku',
				'p.location',
				'p.date_available',
				'p.ean',
				'p.jan',
				'p.mpn',
				'p.isbn',
				/*model-hook-2*/
				'p.points',
				'tc.title'
				
			);
			
			$sql .= " GROUP BY p.product_id";
			
			if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
				$sql .= " ORDER BY " . $data['sort'];	
			} else {
				$sql .= " ORDER BY pd.name";	
			}
			
			if (isset($data['order']) && ($data['order'] == 'DESC')) {
				$sql .= " DESC";
			} else {
				$sql .= " ASC";
			}
		
			if (isset($data['start']) || isset($data['limit'])) {
				if ($data['start'] < 0) {
					$data['start'] = 0;
				}				

				if ($data['limit'] < 1) {
					$data['limit'] = 20;
				}	
			
				$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
			}	
			$query = $this->db->query($sql);
		
			return $query->rows;
		} else {
			$product_data = $this->cache->get('product.' . $selected_language);
		
			if (!$product_data) {
				$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) WHERE pd.language_id = '" . $selected_language . "' AND product_id != -1 ORDER BY pd.name ASC");
	
				$product_data = $query->rows;
			
				$this->cache->set('product.' . $selected_language, $product_data);
			}	
	
			return $product_data;
		}
	}
	
	
	public function getProductStores($product_id) {
		$product_store_data = array();
		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_to_store WHERE product_id = '" . (int)$product_id . "'");

		foreach ($query->rows as $result) {
			$product_store_data[] = $result['store_id'];
		}
		
		return $product_store_data;
	}
	
	public function getProductCategories($product_id) {
		$product_category_data = array();
		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_to_category WHERE product_id = '" . (int)$product_id . "'");

		foreach ($query->rows as $result) {
			$product_category_data[] = $result['category_id'];
		}
		
		return $product_category_data;
	}

	public function getProductFilters($product_id) {
		$product_filter_data = array();
		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_filter WHERE product_id = '" . (int)$product_id . "'");

		foreach ($query->rows as $result) {
			$product_filter_data[] = $result['filter_id'];
		}
		
		return $product_filter_data;
	}
	
	public function getTotalProducts($data = array(), $language = null) {
		if($language == null){
			$selected_language = (int)$this->config->get('config_language_id');
		} else {
			$selected_language = (int)$language;
		}
		//Used because need a link to another table
		if (isset($data['filter_store']) && !is_null($data['filter_store']) || isset($data['filter_category']) && !is_null($data['filter_category']) || isset($data['filter_filter']) && !is_null($data['filter_filter'])) {
			$table = "";
			$where = "";
			if(isset($data['filter_store']) && !is_null($data['filter_store'])){
				$table .= ", " . DB_PREFIX . "product_to_store pts";
				$where .= " AND p.product_id=pts.product_id";
			}
			if(isset($data['filter_category']) && !is_null($data['filter_category'])){
				$table .= ", " . DB_PREFIX . "product_to_category ptc";
				$where .= " AND p.product_id=ptc.product_id";
			}
			if(isset($data['filter_filter']) && !is_null($data['filter_filter'])){
				$table .= ", " . DB_PREFIX . "product_filter pf";
				$where .= " AND p.product_id=pf.product_id";
			}
			$sql = "SELECT COUNT(*) AS total FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id)".$table." WHERE pd.language_id = '" . $selected_language . "'".$where;
		} else {
			$sql = "SELECT COUNT(*) AS total FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) WHERE pd.language_id = '" . $selected_language . "'";
		}
		
		if (isset($data['filter_name']) && !is_null($data['filter_name'])) {
			$sql .= " AND LCASE(pd.name) LIKE '%" . $this->db->escape(mb_strtolower($data['filter_name'])) . "%'";
		}

		if (isset($data['filter_meta_title']) && !is_null($data['filter_meta_title'])) {
			$sql .= " AND LCASE(pd.meta_title) LIKE '%" . $this->db->escape(mb_strtolower($data['filter_meta_title'])) . "%'";
		}

		if (isset($data['filter_meta_keyword']) && !is_null($data['filter_meta_keyword'])) {
			$sql .= " AND LCASE(pd.meta_keyword) LIKE '%" . $this->db->escape(mb_strtolower($data['filter_meta_keyword'])) . "%'";
		}

		if (isset($data['filter_meta_description']) && !is_null($data['filter_meta_description'])) {
			$sql .= " AND LCASE(pd.meta_description) LIKE '%" . $this->db->escape(mb_strtolower($data['filter_meta_description'])) . "%'";
		}

		if (isset($data['filter_model']) && !is_null($data['filter_model'])) {
			$sql .= " AND LCASE(p.model) LIKE '%" . $this->db->escape(mb_strtolower($data['filter_model'])) . "%'";
		}
		if (isset($data['filter_sku']) && !is_null($data['filter_sku'])) {
			$sql .= " AND LCASE(p.sku) LIKE '%" . $this->db->escape(mb_strtolower($data['filter_sku'])) . "%'";
		}

		if (isset($data['filter_upc']) && !is_null($data['filter_upc'])) {
			$sql .= " AND LCASE(p.upc) LIKE '%" . $this->db->escape(mb_strtolower($data['filter_upc'])) . "%'";
		}
		
		if (isset($data['filter_location']) && !is_null($data['filter_location'])) {
			$sql .= " AND LCASE(p.location) LIKE '%" . $this->db->escape(mb_strtolower($data['filter_location'])) . "%'";
		}
		if (isset($data['filter_date_available']) && !is_null($data['filter_date_available'])) {
			$sql .= " AND LCASE(p.date_available) LIKE '%" . $this->db->escape(mb_strtolower($data['filter_date_available'])) . "%'";
		}

		if (isset($data['filter_id']) && !is_null($data['filter_id'])) {
			if(count(explode("&gt;", urldecode($data['filter_id']))) > 1){
				$between = explode("&gt;", urldecode($data['filter_id']));
				if(trim($between[1]) == ""){ //case 10>
					$sql .= " AND p.product_id >= " . (float)$this->db->escape($between[0]);
				} else { //case 5>10
					$sql .= " AND p.product_id between " . (float)$this->db->escape($between[0]) . " AND " . (float)$this->db->escape($between[1]) . "";
				}
			} elseif(count(explode("&lt;", urldecode($data['filter_id']))) > 1){
				$between = explode("&lt;", urldecode($data['filter_id']));
				if(trim($between[0]) == ""){ //case <10
					$sql .= " AND p.product_id <= " . (float)$this->db->escape($between[1]);
				} else { //case 5<10
					$sql .= " AND p.product_id between " . (float)$this->db->escape($between[0]) . " AND " . (float)$this->db->escape($between[1]) . "";
				}
			} else {
				$sql .= " AND p.product_id = '" . $this->db->escape($data['filter_id']) . "'";
			}
		}
		if (isset($data['filter_price']) && !is_null($data['filter_price'])) {
			if(count(explode("&gt;", urldecode($data['filter_price']))) > 1){
				$between = explode("&gt;", urldecode($data['filter_price']));
				if(trim($between[1]) == ""){ //case 10>
					$sql .= " AND p.price >= " . (float)$this->db->escape($between[0]);
				} else { //case 5>10
					$sql .= " AND p.price between " . (float)$this->db->escape($between[0]) . " AND " . (float)$this->db->escape($between[1]) . "";
				}
			} elseif(count(explode("&lt;", urldecode($data['filter_price']))) > 1){
				$between = explode("&lt;", urldecode($data['filter_price']));
				if(trim($between[0]) == ""){ //case <10
					$sql .= " AND p.price <= " . (float)$this->db->escape($between[1]);
				} else { //case 5<10
					$sql .= " AND p.price between " . (float)$this->db->escape($between[0]) . " AND " . (float)$this->db->escape($between[1]) . "";
				}
			} else {
				$sql .= " AND p.price = '" . $this->db->escape($data['filter_price']) . "'";
			}
		}
		if (isset($data['filter_sort_order']) && !is_null($data['filter_sort_order'])) {
				if(count(explode("&gt;", urldecode($data['filter_sort_order']))) > 1){
					$between = explode("&gt;", urldecode($data['filter_sort_order']));
					if(trim($between[1]) == ""){ //case 10>
						$sql .= " AND p.sort_order >= " . (float)$this->db->escape($between[0]);
					} else { //case 5>10
						$sql .= " AND p.sort_order between " . (float)$this->db->escape($between[0]) . " AND " . (float)$this->db->escape($between[1]) . "";
					}
				} elseif(count(explode("&lt;", urldecode($data['filter_sort_order']))) > 1){
					$between = explode("&lt;", urldecode($data['filter_sort_order']));
					if(trim($between[0]) == ""){ //case <10
						$sql .= " AND p.sort_order <= " . (float)$this->db->escape($between[1]);
					} else { //case 5<10
						$sql .= " AND p.sort_order between " . (float)$this->db->escape($between[0]) . " AND " . (float)$this->db->escape($between[1]) . "";
					}
				} else {
					$sql .= " AND p.sort_order = '" . $this->db->escape($data['filter_sort_order']) . "'";
				}
			}
		if (isset($data['filter_quantity']) && !is_null($data['filter_quantity'])) {
			if(count(explode("&gt;", urldecode($data['filter_quantity']))) > 1){
				$between = explode("&gt;", urldecode($data['filter_quantity']));
				if(trim($between[1]) == ""){ //case 10>
					$sql .= " AND p.quantity >= " . (int)$this->db->escape($between[0]);
				} else { //case 5>10
					$sql .= " AND p.quantity between " . (int)$this->db->escape($between[0]) . " AND " . (int)$this->db->escape($between[1]) . "";
				}
			} elseif(count(explode("&lt;", urldecode($data['filter_quantity']))) > 1){
				$between = explode("&lt;", urldecode($data['filter_quantity']));
				if(trim($between[0]) == ""){ //case <10
					$sql .= " AND p.quantity <= " . (int)$this->db->escape($between[1]);
				} else { //case 5<10
					$sql .= " AND p.quantity between " . (int)$this->db->escape($between[0]) . " AND " . (int)$this->db->escape($between[1]) . "";
				}
			} else {
				$sql .= " AND p.quantity = '" . $this->db->escape($data['filter_quantity']) . "'";
			}
		}

		if (isset($data['filter_minimum']) && !is_null($data['filter_minimum'])) {
			if(count(explode("&gt;", urldecode($data['filter_minimum']))) > 1){
				$between = explode("&gt;", urldecode($data['filter_minimum']));
				if(trim($between[1]) == ""){ //case 10>
					$sql .= " AND p.minimum >= " . (int)$this->db->escape($between[0]);
				} else { //case 5>10
					$sql .= " AND p.minimum between " . (int)$this->db->escape($between[0]) . " AND " . (int)$this->db->escape($between[1]) . "";
				}
			} elseif(count(explode("&lt;", urldecode($data['filter_minimum']))) > 1){
				$between = explode("&lt;", urldecode($data['filter_minimum']));
				if(trim($between[0]) == ""){ //case <10
					$sql .= " AND p.minimum <= " . (int)$this->db->escape($between[1]);
				} else { //case 5<10
					$sql .= " AND p.minimum between " . (int)$this->db->escape($between[0]) . " AND " . (int)$this->db->escape($between[1]) . "";
				}
			} else {
				$sql .= " AND p.minimum = '" . $this->db->escape($data['filter_minimum']) . "'";
			}
		}
		
		if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
			$sql .= " AND p.status = '" . (int)$data['filter_status'] . "'";
		}

		if (isset($data['filter_subtract']) && !is_null($data['filter_subtract'])) {
			$sql .= " AND p.subtract = '" . (int)$data['filter_subtract'] . "'";
		}

		if (isset($data['filter_shipping']) && !is_null($data['filter_shipping'])) {
			$sql .= " AND p.shipping = '" . (int)$data['filter_shipping'] . "'";
		}
		
		if (isset($data['filter_category']) && !is_null($data['filter_category'])) {
			$sql .= " AND ptc.category_id = '" . (int)$data['filter_category'] . "'";
		}

		if (isset($data['filter_filter']) && !is_null($data['filter_filter'])) {
			$sql .= " AND pf.filter_id = '" . (int)$data['filter_filter'] . "'";
		}
		
		if (isset($data['filter_manufacturer']) && !is_null($data['filter_manufacturer'])) {
			$sql .= " AND p.manufacturer_id = '" . (int)$data['filter_manufacturer'] . "'";
		}
		
		if (isset($data['filter_tax_class']) && !is_null($data['filter_tax_class'])) {
			if ($data['filter_tax_class'] == -1) {
				$sql .= " AND p.tax_class_id = ''";
			} else {
				$sql .= " AND p.tax_class_id = '" . (int)$data['filter_tax_class'] . "'";
			}
		}
		
		if (isset($data['filter_length_class']) && !is_null($data['filter_length_class'])) {
				$sql .= " AND p.length_class_id = '" . (int)$data['filter_length_class'] . "'";
			}
		
		if (isset($data['filter_stock_status']) && !is_null($data['filter_stock_status'])) {
				$sql .= " AND p.stock_status_id = '" . (int)$data['filter_stock_status'] . "'";
		}
			
		if (isset($data['filter_weight_class']) && !is_null($data['filter_weight_class'])) {
				$sql .= " AND p.weight_class_id = '" . (int)$data['filter_weight_class'] . "'";
		}
		
		if (isset($data['filter_store']) && !is_null($data['filter_store'])) {
			$sql .= " AND pts.store_id = '" . (int)$data['filter_store'] . "'";
		}

		if (isset($data['filter_ean']) && !is_null($data['filter_ean'])) {
		    $sql .= " AND LCASE(p.ean) LIKE '%" . $this->db->escape(strtolower($data['filter_ean'])) . "%'";
		}
		if (isset($data['filter_jan']) && !is_null($data['filter_jan'])) {
		    $sql .= " AND LCASE(p.jan) LIKE '%" . $this->db->escape(strtolower($data['filter_jan'])) . "%'";
		}
		if (isset($data['filter_mpn']) && !is_null($data['filter_mpn'])) {
		    $sql .= " AND LCASE(p.mpn) LIKE '%" . $this->db->escape(strtolower($data['filter_mpn'])) . "%'";
		}
		if (isset($data['filter_isbn']) && !is_null($data['filter_isbn'])) {
		    $sql .= " AND LCASE(p.isbn) LIKE '%" . $this->db->escape(strtolower($data['filter_isbn'])) . "%'";
		}

		/*model-hook-3*/
		if (isset($data['filter_points']) && !is_null($data['filter_points'])) {
			if(count(explode("&gt;", urldecode($data['filter_points']))) > 1){
				$between = explode("&gt;", urldecode($data['filter_points']));
				if(trim($between[1]) == ""){ //case 10>
					$sql .= " AND p.points >= " . (int)$this->db->escape($between[0]);
				} else { //case 5>10
					$sql .= " AND p.points between " . (int)$this->db->escape($between[0]) . " AND " . (int)$this->db->escape($between[1]) . "";
				}
			} elseif(count(explode("&lt;", urldecode($data['filter_points']))) > 1){
				$between = explode("&lt;", urldecode($data['filter_points']));
				if(trim($between[0]) == ""){ //case <10
					$sql .= " AND p.points <= " . (int)$this->db->escape($between[1]);
				} else { //case 5<10
					$sql .= " AND p.points between " . (int)$this->db->escape($between[0]) . " AND " . (int)$this->db->escape($between[1]) . "";
				}
			} else {
				$sql .= " AND p.points = '" . $this->db->escape($data['filter_points']) . "'";
			}
		}

		$sql .= " AND p.product_id != -1";
		
		$query = $this->db->query($sql);
		
		return $query->row['total'];
	}
	
	public function changeProductToStore($product_id, $store_id){
		$query = $this->db->query("SELECT count(*) AS exist FROM " . DB_PREFIX . "product_to_store WHERE product_id = '" . (int)$product_id . "' AND store_id = '" . $store_id . "'");
		if($query->row['exist'] == 0){
			$this->db->query("INSERT INTO " . DB_PREFIX . "product_to_store (product_id, store_id) VALUES ('" . (int)$product_id . "', '" . (int)$store_id . "')");
		} else {
			$this->db->query("DELETE FROM " . DB_PREFIX . "product_to_store WHERE product_id = '" . (int)$product_id . "' AND store_id = '" . (int)$store_id . "'");
		}
		$this->cache->delete('product');
	}
	
	public function changeProductStatus($product_id){
		if($product_id > 0){
			$query = $this->db->query("UPDATE " . DB_PREFIX . "product SET status=ABS(status-1) WHERE product_id = '" . (int)$product_id . "'");
		}
		$this->cache->delete('product');
	}

	public function changeProductSubstract($product_id){
		if($product_id > 0){
			$query = $this->db->query("UPDATE " . DB_PREFIX . "product SET subtract=ABS(subtract-1) WHERE product_id = '" . (int)$product_id . "'");
		}
		$this->cache->delete('product');
	}

	public function changeProductShipping($product_id){
		if($product_id > 0){
			$query = $this->db->query("UPDATE " . DB_PREFIX . "product SET shipping=ABS(shipping-1) WHERE product_id = '" . (int)$product_id . "'");
		}
		$this->cache->delete('product');
	}
	
	public function changeProductQuantity($product_id, $quantity){
		$query = $this->db->query("SELECT quantity FROM " . DB_PREFIX . "product WHERE product_id = '" . (int)$product_id . "'");
		if(isset($query->row['quantity'])){
			$query = $this->db->query("UPDATE " . DB_PREFIX . "product SET quantity = '" . (int)$quantity ."' WHERE product_id = '" . (int)$product_id . "'");
			$this->cache->delete('product');
			
			$query = $this->db->query("SELECT quantity FROM " . DB_PREFIX . "product WHERE product_id = '" . (int)$product_id . "'");
			return $query->row['quantity'];
		} else {
			return "Error";
		}
	}

	public function changeProductMinimum($product_id, $minimum){
		$query = $this->db->query("SELECT minimum FROM " . DB_PREFIX . "product WHERE product_id = '" . (int)$product_id . "'");
		if(isset($query->row['minimum'])){
			$query = $this->db->query("UPDATE " . DB_PREFIX . "product SET minimum = '" . (int)$minimum ."' WHERE product_id = '" . (int)$product_id . "'");
			$this->cache->delete('product');
			
			$query = $this->db->query("SELECT minimum FROM " . DB_PREFIX . "product WHERE product_id = '" . (int)$product_id . "'");
			return $query->row['minimum'];
		} else {
			return "Error";
		}
	}
	
	public function changeProductPrice($product_id, $price){
		$query = $this->db->query("SELECT price FROM " . DB_PREFIX . "product WHERE product_id = '" . (int)$product_id . "'");
		if(isset($query->row['price'])){
			$query = $this->db->query("UPDATE " . DB_PREFIX . "product SET price = '" . (float) $price ."' WHERE product_id = '" . (int)$product_id . "'");
			$this->cache->delete('product');
			
			$query = $this->db->query("SELECT price FROM " . DB_PREFIX . "product WHERE product_id = '" . (int)$product_id . "'");
			return $query->row['price'];
		} else {
			return "Error";
		}
	}
	
	public function changeSpecialPrices($product_id, $data){
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_discount WHERE product_id = '" . (int)$product_id . "'");
 
		if (isset($data['product_discount'])) {
			foreach ($data['product_discount'] as $value) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "product_discount SET product_id = '" . (int)$product_id . "', customer_group_id = '" . (int)$value['customer_group_id'] . "', quantity = '" . (int)$value['quantity'] . "', priority = '" . (int)$value['priority'] . "', price = '" . (float)$value['price'] . "', date_start = '" . $this->db->escape($value['date_start']) . "', date_end = '" . $this->db->escape($value['date_end']) . "'");
			}
		}
		
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_special WHERE product_id = '" . (int)$product_id . "'");
		
		if (isset($data['product_special'])) {
			foreach ($data['product_special'] as $value) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "product_special SET product_id = '" . (int)$product_id . "', customer_group_id = '" . (int)$value['customer_group_id'] . "', priority = '" . (int)$value['priority'] . "', price = '" . (float)$value['price'] . "', date_start = '" . $this->db->escape($value['date_start']) . "', date_end = '" . $this->db->escape($value['date_end']) . "'");
			}
		}
		$this->cache->delete('product');
	}
	
	public function removeProductCategory($product_id, $category_id){
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_to_category WHERE product_id = '" . (int)$product_id . "' AND category_id = '" . (int)$category_id . "'");
		$this->cache->delete('product');
	}

	public function removeProductFilter($product_id, $filter_id){
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_filter WHERE product_id = '" . (int)$product_id . "' AND filter_id = '" . (int)$filter_id . "'");
		$this->cache->delete('product');
	}
	
	public function addProductCategory($product_id, $category_id){
		$categories = explode(',', $category_id);
		foreach($categories as $category){
			$query = $this->db->query("SELECT COUNT(*) AS cnt FROM " . DB_PREFIX . "product_to_category WHERE product_id = '" . (int)$product_id . "' AND category_id = '" . (int)$category. "'");
			if(isset($query->row['cnt']) && $query->row['cnt'] == 0){
				$this->db->query("INSERT INTO " . DB_PREFIX . "product_to_category (product_id, category_id) VALUES ('".(int)$product_id."', '".(int)$category."')");
			}
		}
		$this->cache->delete('product');
	}

	public function addProductFilter($product_id, $filter_id){
		$filters = explode(',', $filter_id);
		foreach($filters as $filter){
			$query = $this->db->query("SELECT COUNT(*) AS cnt FROM " . DB_PREFIX . "product_filter WHERE product_id = '" . (int)$product_id . "' AND filter_id = '" . (int)$filter. "'");
			if(isset($query->row['cnt']) && $query->row['cnt'] == 0){
				$this->db->query("INSERT INTO " . DB_PREFIX . "product_filter (product_id, filter_id) VALUES ('".(int)$product_id."', '".(int)$filter."')");
			}
		}
		$this->cache->delete('product');
	}

	public function changeProductCategory($product_id, $category_id){
		$categories = explode(',', $category_id);
		$query = $this->db->query("DELETE FROM " . DB_PREFIX . "product_to_category WHERE product_id = '" . (int)$product_id . "'");
		foreach($categories as $category){
			$query = $this->db->query("SELECT COUNT(*) AS cnt FROM " . DB_PREFIX . "product_to_category WHERE product_id = '" . (int)$product_id . "' AND category_id = '" . (int)$category. "'");
			if(isset($query->row['cnt']) && $query->row['cnt'] == 0){
				$this->db->query("INSERT INTO " . DB_PREFIX . "product_to_category (product_id, category_id) VALUES ('".(int)$product_id."', '".(int)$category."')");
			}
		}
		$this->cache->delete('product');
	}

	public function changeProductFilter($product_id, $filter_id){
		$filters = explode(',', $filter_id);
		$query = $this->db->query("DELETE FROM " . DB_PREFIX . "product_filter WHERE product_id = '" . (int)$product_id . "'");
		foreach($filters as $filter){
			$query = $this->db->query("SELECT COUNT(*) AS cnt FROM " . DB_PREFIX . "product_filter WHERE product_id = '" . (int)$product_id . "' AND filter_id = '" . (int)$filter. "'");
			if(isset($query->row['cnt']) && $query->row['cnt'] == 0){
				$this->db->query("INSERT INTO " . DB_PREFIX . "product_filter (product_id, filter_id) VALUES ('".(int)$product_id."', '".(int)$filter."')");
			}
		}
		$this->cache->delete('product');
	}
	
	public function changeProductSortOrder($product_id, $sort_order){
		$query = $this->db->query("SELECT sort_order FROM " . DB_PREFIX . "product WHERE product_id = '" . (int)$product_id . "'");
		if(isset($query->row['sort_order'])){
			$query = $this->db->query("UPDATE " . DB_PREFIX . "product SET sort_order = '" . (int) $sort_order ."' WHERE product_id = '" . (int)$product_id . "'");
			$this->cache->delete('product');
			return (int)$sort_order;
		} else {
			return "Error";
		}
	}
	
	public function hasSpecial($product_id){
		$query = $this->db->query("SELECT COUNT(*) cnt FROM " . DB_PREFIX . "product_special WHERE product_id = '" . (int)$product_id . "'");
		if((int)$query->row['cnt'] > 0){
			return true;
		}
		return false;
	}
	
	public function hasDiscount($product_id){
		$query = $this->db->query("SELECT COUNT(*) cnt FROM " . DB_PREFIX . "product_discount WHERE product_id = '" . (int)$product_id . "'");
		if((int)$query->row['cnt'] > 0){
			return true;
		}
		return false;
	}
	
	public function getManufacturers(){
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "manufacturer ORDER BY sort_order, name");
		$manufacturers = array();
		foreach ($query->rows as $result) {
			$manufacturers[$result['manufacturer_id']] = $result['name'];
		}
		return $manufacturers;
	}
	
	public function changeManufacturer($product_id, $manufacturer_id){
		if($product_id > 0){
			$query = $this->db->query("UPDATE " . DB_PREFIX . "product SET manufacturer_id=".(int)$manufacturer_id." WHERE product_id = '" . (int)$product_id . "'");
		}
		$this->cache->delete('product');
	}
	
	public function getAlias($product_id, $language = null) {
		if($language == null || $language==0){
			$selected_language = (int)$this->config->get('config_language_id');
		} else {
			$selected_language = (int)$language;
		}
		$row = $this->db->query("SELECT * FROM " . DB_PREFIX . "seo_url WHERE query = 'product_id=" . (int)$product_id. "' and language_id='".$selected_language."'");
		if(isset($row->row['keyword'])){
			return $row->row['keyword'];
		}
		return '';
	}
	
	public function changeSeo($product_id, $keyword, $language = null) {
		if($language == null || $language==0){
			$selected_language = (int)$this->config->get('config_language_id');
		} else {
			$selected_language = (int)$language;
		}
		$this->db->query("DELETE FROM " . DB_PREFIX . "seo_url WHERE query = 'product_id=" . (int)$product_id. "' and language_id='".$selected_language."'");
		if ($keyword != '') {
			$this->db->query("INSERT INTO " . DB_PREFIX . "seo_url SET query = 'product_id=" . (int)$product_id . "', keyword = '" . $this->db->escape($keyword) . "', language_id='".(int)$selected_language."'");
		}
		$this->cache->delete('product');
		
		$row = $this->db->query("SELECT * FROM " . DB_PREFIX . "seo_url WHERE query = 'product_id=" . (int)$product_id. "' and language_id='".$selected_language."'");
		return $row->row['keyword'];
	}
	
	public function getFinalPrice($product_id, $regular_price, $default_customer_group){
		$price = '';
		$special = $this->db->query("
			SELECT
				price
			FROM
				" . DB_PREFIX . "product_special ps
			WHERE
				ps.product_id = ".(int)$product_id." AND
				ps.customer_group_id = '" . (int)$default_customer_group . "' AND
				(
					(ps.date_start = '0000-00-00' OR ps.date_start < NOW()) AND
					(ps.date_end = '0000-00-00' OR ps.date_end > NOW())
				)
			ORDER BY
				ps.priority ASC,
				ps.price ASC
			LIMIT 1");
		$discount = $this->db->query("
			SELECT
				price
			FROM
				" . DB_PREFIX . "product_discount pd2
			WHERE pd2.product_id = ".(int)$product_id." AND
			pd2.customer_group_id = '" . (int)$default_customer_group . "' AND
			pd2.quantity = '1' AND
			(
				(pd2.date_start = '0000-00-00' OR pd2.date_start < NOW()) AND
				(pd2.date_end = '0000-00-00' OR pd2.date_end > NOW())
			)
			ORDER BY
				pd2.priority ASC,
				pd2.price ASC
			LIMIT 1");
		if(isset($discount->row['price'])){
			$price = $discount->row['price'];
		}
		if(isset($special->row['price'])){
			$price = $special->row['price'];
		}
		return $price;
	}
	
	public function changeModel($product_id, $model){
		if($product_id > 0){
			$query = $this->db->query("UPDATE " . DB_PREFIX . "product SET model='".$this->db->escape($model)."' WHERE product_id = '" . (int)$product_id . "'");
			$query = $this->db->query("SELECT model FROM " . DB_PREFIX . "product WHERE product_id = '" . (int)$product_id . "'");
		}
		$this->cache->delete('product');
		return $query->row['model'];
	}
	public function changeImage($product_id, $image){
		if($product_id > 0){
			$query = $this->db->query("UPDATE " . DB_PREFIX . "product SET image='".$this->db->escape($image)."' WHERE product_id = '" . (int)$product_id . "'");
			$query = $this->db->query("SELECT image FROM " . DB_PREFIX . "product WHERE product_id = '" . (int)$product_id . "'");
		}
		$this->cache->delete('product');
		return $query->row['image'];
	}
	public function changeName($product_id, $name, $language = null){
		if($language == null || $language==0){
			$selected_language = (int)$this->config->get('config_language_id');
		} else {
			$selected_language = (int)$language;
		}
		if($product_id > 0){
			$query = $this->db->query("UPDATE " . DB_PREFIX . "product_description SET name='".$this->db->escape($name)."' WHERE product_id = '" . (int)$product_id . "' AND language_id='".$selected_language."'");
			$query = $this->db->query("SELECT name FROM " . DB_PREFIX . "product_description WHERE product_id = '" . (int)$product_id . "' AND language_id='".$selected_language."'");
		}
		$this->cache->delete('product');
		return $query->row['name'];
	}

	public function changeMetaTitle($product_id, $meta_title, $language = null){
		if($language == null || $language==0){
			$selected_language = (int)$this->config->get('config_language_id');
		} else {
			$selected_language = (int)$language;
		}
		if($product_id > 0){
			$query = $this->db->query("UPDATE " . DB_PREFIX . "product_description SET meta_title='".$this->db->escape($meta_title)."' WHERE product_id = '" . (int)$product_id . "' AND language_id='".$selected_language."'");
			$query = $this->db->query("SELECT meta_title FROM " . DB_PREFIX . "product_description WHERE product_id = '" . (int)$product_id . "' AND language_id='".$selected_language."'");
		}
		$this->cache->delete('product');
		return $query->row['meta_title'];
	}

	public function changeMetaKeyword($product_id, $meta_keyword, $language = null){
		if($language == null || $language==0){
			$selected_language = (int)$this->config->get('config_language_id');
		} else {
			$selected_language = (int)$language;
		}
		if($product_id > 0){
			$query = $this->db->query("UPDATE " . DB_PREFIX . "product_description SET meta_keyword='".$this->db->escape($meta_keyword)."' WHERE product_id = '" . (int)$product_id . "' AND language_id='".$selected_language."'");
			$query = $this->db->query("SELECT meta_keyword FROM " . DB_PREFIX . "product_description WHERE product_id = '" . (int)$product_id . "' AND language_id='".$selected_language."'");
		}
		$this->cache->delete('product');
		return $query->row['meta_keyword'];
	}

	public function changeMetaDescription($product_id, $meta_description, $language = null){
		if($language == null || $language==0){
			$selected_language = (int)$this->config->get('config_language_id');
		} else {
			$selected_language = (int)$language;
		}
		if($product_id > 0){
			$query = $this->db->query("UPDATE " . DB_PREFIX . "product_description SET meta_description='".$this->db->escape($meta_description)."' WHERE product_id = '" . (int)$product_id . "' AND language_id='".$selected_language."'");
			$query = $this->db->query("SELECT meta_description FROM " . DB_PREFIX . "product_description WHERE product_id = '" . (int)$product_id . "' AND language_id='".$selected_language."'");
		}
		$this->cache->delete('product');
		return $query->row['meta_description'];
	}
	
	public function getLanguages(){
		return $this->db->query("SELECT language_id, CONCAT(name, IF(status=1, '', ' *')) AS name, image FROM " . DB_PREFIX . "language");
	}
	
	public function changeProductSku($product_id, $sku){
		$query = $this->db->query("SELECT sku FROM " . DB_PREFIX . "product WHERE product_id = '" . (int)$product_id . "'");
		if(isset($query->row['sku'])){
			$query = $this->db->query("UPDATE " . DB_PREFIX . "product SET sku = '" . $sku ."' WHERE product_id = '" . (int)$product_id . "'");
			$this->cache->delete('product');
			
			$query = $this->db->query("SELECT sku FROM " . DB_PREFIX . "product WHERE product_id = '" . (int)$product_id . "'");
			return $query->row['sku'];
		} else {
			return "Error";
		}
	}

	public function changeUpc($product_id, $upc){
		$query = $this->db->query("SELECT upc FROM " . DB_PREFIX . "product WHERE product_id = '" . (int)$product_id . "'");
		if(isset($query->row['upc'])){
			$query = $this->db->query("UPDATE " . DB_PREFIX . "product SET upc = '" . $upc ."' WHERE product_id = '" . (int)$product_id . "'");
			$this->cache->delete('product');
			
			$query = $this->db->query("SELECT upc FROM " . DB_PREFIX . "product WHERE product_id = '" . (int)$product_id . "'");
			return $query->row['upc'];
		} else {
			return "Error";
		}
	}
	
	public function changeLocation($product_id, $location){
		$query = $this->db->query("SELECT location FROM " . DB_PREFIX . "product WHERE product_id = '" . (int)$product_id . "'");
		if(isset($query->row['location'])){
			$query = $this->db->query("UPDATE " . DB_PREFIX . "product SET location = '" . $location ."' WHERE product_id = '" . (int)$product_id . "'");
			$this->cache->delete('product');
			
			$query = $this->db->query("SELECT location FROM " . DB_PREFIX . "product WHERE product_id = '" . (int)$product_id . "'");
			return $query->row['location'];
		} else {
			return "Error";
		}
	}
	public function changeDateAvailable($product_id, $date_available){
		$query = $this->db->query("SELECT date_available FROM " . DB_PREFIX . "product WHERE product_id = '" . (int)$product_id . "'");
		if(isset($query->row['date_available'])){
			$query = $this->db->query("UPDATE " . DB_PREFIX . "product SET date_available = '" . $date_available ."' WHERE product_id = '" . (int)$product_id . "'");
			$this->cache->delete('product');
			
			$query = $this->db->query("SELECT date_available FROM " . DB_PREFIX . "product WHERE product_id = '" . (int)$product_id . "'");
			return $query->row['date_available'];
		} else {
			return "Error";
		}
	}
	
	public function getDescriptions($product_id){
		$descriptions = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_description WHERE product_id='".(int)$product_id."'");
		return $descriptions->rows;
	}
	public function updateDescriptions($product_id, $data){
		$languages = $this->db->query("SELECT language_id, CONCAT(name, IF(status=1, '', ' *')) AS name, image FROM " . DB_PREFIX . "language");
		foreach($languages->rows as $language){
			$query = $this->db->query("UPDATE " . DB_PREFIX . "product_description SET description = '" . $this->db->escape($data['product_description'][$language['language_id']]['description']) ."' WHERE product_id = '" . (int)$product_id . "' AND language_id='".(int)$language['language_id']."'");
		}
		$this->cache->delete('product');
		return "OK";
	}
	
	/**
	 * Set the default id
	 */
	public function setDefaultProduct(){
		$query = $this->db->query("SELECT COUNT(*) AS cnt FROM " . DB_PREFIX . "product WHERE product_id=-1");
		if($query->row['cnt'] == 0){
			$this->db->query("INSERT INTO  " . DB_PREFIX . "product (product_id, status, model) VALUES (-1, 0, 'Model name')");
			
			$languages = $this->db->query("SELECT language_id FROM " . DB_PREFIX . "language");
			foreach($languages->rows as $language){
				$query = $this->db->query("INSERT INTO " . DB_PREFIX . "product_description (product_id, language_id, name) VALUES (-1, ".(int)$language['language_id'].", 'New product')");
			}
		}
	}
	
	public function changeWeight($product_id, $weight){
		$query = $this->db->query("SELECT weight FROM " . DB_PREFIX . "product WHERE product_id = '" . (int)$product_id . "'");
		if(isset($query->row['weight'])){
			$query = $this->db->query("UPDATE " . DB_PREFIX . "product SET weight = '" . (float)$weight ."' WHERE product_id = '" . (int)$product_id . "'");
			$this->cache->delete('product');
			
			$query = $this->db->query("SELECT weight FROM " . DB_PREFIX . "product WHERE product_id = '" . (int)$product_id . "'");
			return $query->row['weight'];
		} else {
			return "Error";
		}
	}
	
	public function changeWeightClass($product_id, $weight_class_id){
		$query = $this->db->query("SELECT weight_class_id FROM " . DB_PREFIX . "product WHERE product_id = '" . (int)$product_id . "'");
		if(isset($query->row['weight_class_id'])){
			$query = $this->db->query("UPDATE " . DB_PREFIX . "product SET weight_class_id = '" . (int)$weight_class_id ."' WHERE product_id = '" . (int)$product_id . "'");
			$this->cache->delete('product');
			
			$query = $this->db->query("SELECT weight_class_id FROM " . DB_PREFIX . "product WHERE product_id = '" . (int)$product_id . "'");
			return $query->row['weight_class_id'];
		} else {
			return "Error";
		}
	}
	
	public function getWeightClasses($language_id){
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "weight_class wc, " . DB_PREFIX . "weight_class_description wcd WHERE wc.weight_class_id=wcd.weight_class_id AND wcd.language_id=".(int)$language_id." ORDER BY wcd.title");
		$weightClass = array();
		foreach ($query->rows as $result) {
			$weightClass[$result['weight_class_id']] = $result['title'];
		}
		return $weightClass;
	}
	
	public function changeTaxClass($product_id, $tax_class_id){
		$query = $this->db->query("SELECT tax_class_id FROM " . DB_PREFIX . "product WHERE product_id = '" . (int)$product_id . "'");
		if(isset($query->row['tax_class_id'])){
			$query = $this->db->query("UPDATE " . DB_PREFIX . "product SET tax_class_id = '" . (int)$tax_class_id ."' WHERE product_id = '" . (int)$product_id . "'");
			$this->cache->delete('product');
			
			$query = $this->db->query("SELECT tax_class_id FROM " . DB_PREFIX . "product WHERE product_id = '" . (int)$product_id . "'");
			return $query->row['tax_class_id'];
		} else {
			return "Error";
		}
	}
	
	public function getTaxClasses(){
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "tax_class ORDER BY title");
		$taxClass = array();
		foreach ($query->rows as $result) {
			$taxClass[$result['tax_class_id']] = $result['title'];
		}
		return $taxClass;
	}
	
	public function changeStockStatus($product_id, $stock_status_id){
		$query = $this->db->query("SELECT stock_status_id FROM " . DB_PREFIX . "product WHERE product_id = '" . (int)$product_id . "'");
		if(isset($query->row['stock_status_id'])){
			$query = $this->db->query("UPDATE " . DB_PREFIX . "product SET stock_status_id = '" . (int)$stock_status_id ."' WHERE product_id = '" . (int)$product_id . "'");
			$this->cache->delete('product');
			
			$query = $this->db->query("SELECT stock_status_id FROM " . DB_PREFIX . "product WHERE product_id = '" . (int)$product_id . "'");
			return $query->row['stock_status_id'];
		} else {
			return "Error";
		}
	}
	
	public function getStockStatuses($language_id){
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "stock_status WHERE language_id=".(int)$language_id." ORDER BY name");
		$stockStatus = array();
		foreach ($query->rows as $result) {
			$stockStatus[$result['stock_status_id']] = $result['name'];
		}
		return $stockStatus;
	}
	
	public function changeLength($product_id, $length){
		$query = $this->db->query("SELECT length FROM " . DB_PREFIX . "product WHERE product_id = '" . (int)$product_id . "'");
		if(isset($query->row['length'])){
			$query = $this->db->query("UPDATE " . DB_PREFIX . "product SET length = '" . (float)$length ."' WHERE product_id = '" . (int)$product_id . "'");
			$this->cache->delete('product');
			
			$query = $this->db->query("SELECT length FROM " . DB_PREFIX . "product WHERE product_id = '" . (int)$product_id . "'");
			return $query->row['length'];
		} else {
			return "Error";
		}
	}
	
	public function changeWidth($product_id, $width){
		$query = $this->db->query("SELECT width FROM " . DB_PREFIX . "product WHERE product_id = '" . (int)$product_id . "'");
		if(isset($query->row['width'])){
			$query = $this->db->query("UPDATE " . DB_PREFIX . "product SET width = '" . (float)$width ."' WHERE product_id = '" . (int)$product_id . "'");
			$this->cache->delete('product');
			
			$query = $this->db->query("SELECT width FROM " . DB_PREFIX . "product WHERE product_id = '" . (int)$product_id . "'");
			return $query->row['width'];
		} else {
			return "Error";
		}
	}
	
	public function changeHeight($product_id, $height){
		$query = $this->db->query("SELECT height FROM " . DB_PREFIX . "product WHERE product_id = '" . (int)$product_id . "'");
		if(isset($query->row['height'])){
			$query = $this->db->query("UPDATE " . DB_PREFIX . "product SET height = '" . (float)$height ."' WHERE product_id = '" . (int)$product_id . "'");
			$this->cache->delete('product');
			
			$query = $this->db->query("SELECT height FROM " . DB_PREFIX . "product WHERE product_id = '" . (int)$product_id . "'");
			return $query->row['height'];
		} else {
			return "Error";
		}
	}
	
	public function changeLengthClass($product_id, $length_class_id){
		$query = $this->db->query("SELECT length_class_id FROM " . DB_PREFIX . "product WHERE product_id = '" . (int)$product_id . "'");
		if(isset($query->row['length_class_id'])){
			$query = $this->db->query("UPDATE " . DB_PREFIX . "product SET length_class_id = '" . (int)$length_class_id ."' WHERE product_id = '" . (int)$product_id . "'");
			$this->cache->delete('product');
			
			$query = $this->db->query("SELECT length_class_id FROM " . DB_PREFIX . "product WHERE product_id = '" . (int)$product_id . "'");
			return $query->row['length_class_id'];
		} else {
			return "Error";
		}
	}
	
	public function getLengthClasses($language_id){
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "length_class lc, " . DB_PREFIX . "length_class_description lcd WHERE lc.length_class_id=lcd.length_class_id AND lcd.language_id=".(int)$language_id." ORDER BY lcd.title");
		$lengthClass = array();
		foreach ($query->rows as $result) {
			$lengthClass[$result['length_class_id']] = $result['title'];
		}
		return $lengthClass;
	}
	public function changeEan($product_id, $ean){
        $query = $this->db->query("SELECT ean FROM " . DB_PREFIX . "product WHERE product_id = '" . (int)$product_id . "'");
        if(isset($query->row['ean'])){
            $query = $this->db->query("UPDATE " . DB_PREFIX . "product SET ean = '" . $ean ."' WHERE product_id = '" . (int)$product_id . "'");
            $this->cache->delete('product');
            
            $query = $this->db->query("SELECT ean FROM " . DB_PREFIX . "product WHERE product_id = '" . (int)$product_id . "'");
            return $query->row['ean'];
        } else {
                return "Error";
        }
	}
	public function changeJan($product_id, $jan){
        $query = $this->db->query("SELECT jan FROM " . DB_PREFIX . "product WHERE product_id = '" . (int)$product_id . "'");
        if(isset($query->row['jan'])){
            $query = $this->db->query("UPDATE " . DB_PREFIX . "product SET jan = '" . $jan ."' WHERE product_id = '" . (int)$product_id . "'");
            $this->cache->delete('product');
            
            $query = $this->db->query("SELECT jan FROM " . DB_PREFIX . "product WHERE product_id = '" . (int)$product_id . "'");
            return $query->row['jan'];
        } else {
        	return "Error";
        }
	}
	public function changeMpn($product_id, $mpn){
        $query = $this->db->query("SELECT mpn FROM " . DB_PREFIX . "product WHERE product_id = '" . (int)$product_id . "'");
        if(isset($query->row['mpn'])){
            $query = $this->db->query("UPDATE " . DB_PREFIX . "product SET mpn = '" . $mpn ."' WHERE product_id = '" . (int)$product_id . "'");
            $this->cache->delete('product');
            
            $query = $this->db->query("SELECT mpn FROM " . DB_PREFIX . "product WHERE product_id = '" . (int)$product_id . "'");
            return $query->row['mpn'];
        } else {
        	return "Error";
        }
	}
	public function changeIsbn($product_id, $isbn){
        $query = $this->db->query("SELECT isbn FROM " . DB_PREFIX . "product WHERE product_id = '" . (int)$product_id . "'");
        if(isset($query->row['isbn'])){
            $query = $this->db->query("UPDATE " . DB_PREFIX . "product SET isbn = '" . $isbn ."' WHERE product_id = '" . (int)$product_id . "'");
            $this->cache->delete('product');
            
            $query = $this->db->query("SELECT isbn FROM " . DB_PREFIX . "product WHERE product_id = '" . (int)$product_id . "'");
            return $query->row['isbn'];
        } else {
            return "Error";
        }
	}
	/*model-hook-end*/

	public function changePoints($product_id, $points){
		$query = $this->db->query("SELECT points FROM " . DB_PREFIX . "product WHERE product_id = '" . (int)$product_id . "'");
		if(isset($query->row['points'])){
			$query = $this->db->query("UPDATE " . DB_PREFIX . "product SET points = '" . (float)$points ."' WHERE product_id = '" . (int)$product_id . "'");
			$this->cache->delete('product');
			
			$query = $this->db->query("SELECT points FROM " . DB_PREFIX . "product WHERE product_id = '" . (int)$product_id . "'");
			return $query->row['points'];
		} else {
			return "Error";
		}
	}

	public function changeFeaturedProduct($product_id){	
		$this->load->model('setting/module');
		$modules = $this->model_setting_module->getModulesByCode('featured');
		if(isset($modules[0])){
			$module = $modules[0];
			$setting = json_decode($module['setting'], true);
			if(!is_array($setting['product'])){
				$setting['product'] = array();
			}
			if(in_array($product_id, (array)$setting['product'])){
				$key = array_search($product_id, $setting['product']);
				unset($setting['product'][$key]);	
			} else {
				array_push($setting['product'], $product_id);
			}
			$this->model_setting_module->editModule($module['module_id'], $setting);
		}
		return 'done';
	}

	public function getMaxSpecialPrice($product_id){
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_special ps WHERE ps.product_id=".(int)$product_id." ORDER BY ps.priority DESC, ps.product_special_id LIMIT 0, 1");
		if(isset($query->row['price'])){
			return $query->row['price'];
		}
		return null;
	}
	public function getMaxDiscountPrice($product_id){
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_discount pd WHERE pd.product_id=".(int)$product_id." ORDER BY pd.priority DESC, pd.product_discount_id LIMIT 0, 1");
		if(isset($query->row['price'])){
			return $query->row['price'];
		}
		return null;
	}
	public function changeProductSpecialPrice($product_id, $price){
		$group = $this->config->get('config_customer_group_id');
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_special ps WHERE ps.product_id=".(int)$product_id." ORDER BY ps.priority DESC, ps.product_special_id LIMIT 0, 1");
		if(isset($query->row['product_special_id'])){
			$id = $query->row['product_special_id'];
			$query = $this->db->query("UPDATE " . DB_PREFIX . "product_special SET price = '" . (float) $price ."' WHERE product_special_id = '" . (int)$id . "'");
			$this->cache->delete('product');
			$query = $this->db->query("SELECT price FROM " . DB_PREFIX . "product_special WHERE product_special_id = '" . (int)$id . "'");
			return $query->row['price'];
		} else {
			if($price != ''){
				$query = $this->db->query("INSERT INTO " . DB_PREFIX . "product_special (product_id, customer_group_id, price) VALUES('".(int)$product_id."', '".(int)$group."', '".(float)$price."')");
				$query = $this->db->query("SELECT price FROM " . DB_PREFIX . "product_special WHERE product_id = '" . (int)$product_id . "'");
				return $query->row['price'];
			} else {
				return '';
			}
		}
	}
	public function changeProductDiscountPrice($product_id, $price){
		$group = $this->config->get('config_customer_group_id');
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_discount pd WHERE pd.product_id=".(int)$product_id." ORDER BY pd.priority DESC, pd.product_discount_id LIMIT 0, 1");
		if(isset($query->row['product_discount_id'])){
			$id = $query->row['product_discount_id'];
			$query = $this->db->query("UPDATE " . DB_PREFIX . "product_discount SET price = '" . (float) $price ."'WHERE product_discount_id = '" . (int)$id . "'");
			$this->cache->delete('product');
			$query = $this->db->query("SELECT price FROM " . DB_PREFIX . "product_discount WHERE product_discount_id = '" . (int)$id . "'");
			return $query->row['price'];
		} else {
			if($price != ''){
				$query = $this->db->query("INSERT INTO " . DB_PREFIX . "product_discount (product_id, customer_group_id, price) VALUES('".(int)$product_id."', '".(int)$group."', '".(float)$price."')");
				$query = $this->db->query("SELECT price FROM " . DB_PREFIX . "product_discount WHERE product_id = '" . (int)$product_id . "'");
				return $query->row['price'];
			} else {
				return '';
			}
		}
	}

	public function changeTags($product_id, $tags, $language_id){
		$query = $this->db->query("UPDATE " . DB_PREFIX . "product_description SET tag = '" . $this->db->escape($tags) ."' WHERE product_id = '" . (int)$product_id . "' AND language_id='".(int)$language_id."'");
		$this->cache->delete('product');
		$query = $this->db->query("SELECT tag FROM " . DB_PREFIX . "product_description WHERE product_id = '" . (int)$product_id . "' AND language_id='".(int)$language_id."'");
		return $query->row['tag'];
	}
}
?>