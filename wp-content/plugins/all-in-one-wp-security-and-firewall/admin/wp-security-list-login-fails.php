<?php

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

class AIOWPSecurity_List_Login_Failed_Attempts extends AIOWPSecurity_List_Table {
	
	public function __construct(){
		global $status, $page;
		
		//Set parent defaults
		parent::__construct( array(
			'singular'  => 'item',     //singular name of the listed records
			'plural'    => 'items',    //plural name of the listed records
			'ajax'      => false        //does this table support ajax?
		) );
		
	}

	public function column_default($item, $column_name) {
		return $item[$column_name];
	}

	public function column_login_attempt_ip($item) {
		$tab = strip_tags($_REQUEST['tab']);
		$delete_url = sprintf('admin.php?page=%s&tab=%s&action=%s&failed_login_id=%s', AIOWPSEC_USER_LOGIN_MENU_SLUG, $tab, 'delete_failed_login_rec', $item['id']);
		//Add nonce to delete URL
		$delete_url_nonce = wp_nonce_url($delete_url, "delete_failed_login_rec", "aiowps_nonce");
		
		//Build row actions
		$actions = array(
			'delete' => '<a href="'.$delete_url_nonce.'" onclick="return confirm(\'Are you sure you want to delete this item?\')">Delete</a>',
		);
		
		//Return the user_login contents
		return sprintf('%1$s <span style="color:silver"></span>%2$s',
			/*$1%s*/ $item['login_attempt_ip'],
			/*$2%s*/ $this->row_actions($actions)
		);
	}

	public function column_cb($item){
		return sprintf(
			'<input type="checkbox" name="%1$s[]" value="%2$s" />',
			/*$1%s*/ $this->_args['singular'],  //Let's simply repurpose the table's singular label
			/*$2%s*/ $item['id']                //The value of the checkbox should be the record's id
		);
	}

	public function get_columns(){
		$columns = array(
			'cb' => '<input type="checkbox" />', //Render a checkbox
			'login_attempt_ip' => __('Login IP range', 'all-in-one-wp-security-and-firewall'),
			'user_id' => __('User ID', 'all-in-one-wp-security-and-firewall'),
			'user_login' => __('Username', 'all-in-one-wp-security-and-firewall'),
			'failed_login_date' => __('Date', 'all-in-one-wp-security-and-firewall')
		);
		return $columns;
	}
	
	public function get_sortable_columns() {
		$sortable_columns = array(
			'login_attempt_ip' => array('login_attempt_ip',false),
			'user_id' => array('user_id',false),
			'user_login' => array('user_login',false),
			'failed_login_date' => array('failed_login_date',false),
		);
		return $sortable_columns;
	}
	
	public function get_bulk_actions() {
		$actions = array(
			'delete' => __('Delete', 'all-in-one-wp-security-and-firewall')
		);
		return $actions;
	}

	private function process_bulk_action() {
		if (empty($_REQUEST['_wpnonce']) || !wp_verify_nonce($_REQUEST['_wpnonce'], 'bulk-items')) return;
		global $aio_wp_security;
		if ('delete'===$this->current_action()) { // Process delete bulk actions
			if(!isset($_REQUEST['item'])) {
				$error_msg = '<div id="message" class="error"><p><strong>';
				$error_msg .= __('Please select some records using the checkboxes','all-in-one-wp-security-and-firewall');
				$error_msg .= '</strong></p></div>';
				_e($error_msg);
			} else {
				$this->delete_login_failed_records(($_REQUEST['item']));

			}
		}
	}

	/**
	 * Deletes one or more records from the AIOWPSEC_TBL_FAILED_LOGINS table.
	 *
	 * @param Array|String|Integer - ids or a single id
	 *
	 * @return Void
	 */
	public function delete_login_failed_records($entries) {
		global $wpdb, $aio_wp_security;
		$failed_login_table = AIOWPSEC_TBL_FAILED_LOGINS;
		if (is_array($entries)) {
			if (isset($_REQUEST['_wp_http_referer'])) {
				// Delete multiple records
				$tab = strip_tags($_REQUEST['tab']);
				$entries = array_filter($entries, 'is_numeric'); // discard non-numeric ID values
				$id_list = "(" .implode(",",$entries) .")"; // Create comma separate list for DB operation
				$delete_command = "DELETE FROM ".$failed_login_table." WHERE ID IN ".$id_list;
				$result = $wpdb->query($delete_command);
				if ($result) {
					AIOWPSecurity_Admin_Menu::show_msg_record_deleted_st();
				} else {
					// Error on bulk delete
					$aio_wp_security->debug_logger->log_debug('Database error occurred when deleting rows from Failed Logins table. Database error: '.$wpdb->last_error, 4);
					AIOWPSecurity_Admin_Menu::show_msg_record_not_deleted_st();
				}
			}
			
		} elseif ($entries != NULL) {
			// Delete single record
			$delete_command = "DELETE FROM ".$failed_login_table." WHERE ID = '".absint($entries)."'";
			$result = $wpdb->query($delete_command);
			if ($result) {
				AIOWPSecurity_Admin_Menu::show_msg_record_deleted_st();
			} elseif ($result === false) {
				// Error on single delete
				$aio_wp_security->debug_logger->log_debug('Database error occurred when deleting rows from Failed Logins table. Database error: '.$wpdb->last_error, 4);
				AIOWPSecurity_Admin_Menu::show_msg_record_not_deleted_st();
			}
		}
	}

	/**
	 * Retrieves all items from AIOWPSEC_TBL_FAILED_LOGINS according to a search term inside $_REQUEST['s']. It then assigns to $this->items.
	 *
	 * @param Boolean $ignore_pagination - whether to not paginate
	 *
	 * @return Void
	 */
	public function prepare_items($ignore_pagination = false) {
		/**
		 * First, lets decide how many records per page to show
		 */
		$per_page = 100;
		$columns = $this->get_columns();
		$hidden = array();
		$sortable = $this->get_sortable_columns();
		$search_term = isset($_REQUEST['s']) ? sanitize_text_field(stripslashes($_REQUEST['s'])) : '';

		$this->_column_headers = array($columns, $hidden, $sortable);

		$this->process_bulk_action();

		global $wpdb;
		$failed_logins_table_name = AIOWPSEC_TBL_FAILED_LOGINS;

		/* -- Ordering parameters -- */
		//Parameters that are going to be used to order the result
		isset($_GET['orderby']) ? $orderby = strip_tags($_GET['orderby']) : $orderby = '';
		isset($_GET['order']) ? $order = strip_tags($_GET['order']) : $order = '';

		$orderby = !empty($orderby) ? esc_sql($orderby) : 'failed_login_date';
		$order = !empty($order) ? esc_sql($order) : 'DESC';

		$orderby = AIOWPSecurity_Utility::sanitize_value_by_array($orderby, $sortable);
		$order = AIOWPSecurity_Utility::sanitize_value_by_array($order, array('DESC' => '1', 'ASC' => '1'));
		if (empty($search_term)) {
			$data = $wpdb->get_results("SELECT * FROM $failed_logins_table_name ORDER BY $orderby $order", ARRAY_A);
		} else {
			$data = $wpdb->get_results($wpdb->prepare("SELECT * FROM $failed_logins_table_name WHERE `user_login` LIKE '%%%s%%' OR `login_attempt_ip` LIKE '%%%s%%' ORDER BY $orderby $order", $search_term, $search_term), ARRAY_A);
		}

		if (!$ignore_pagination) {
			$current_page = $this->get_pagenum();
			$total_items = count($data);
			$data = array_slice($data, (($current_page - 1) * $per_page), $per_page);
			$this->set_pagination_args(array(
				'total_items' => $total_items, //WE have to calculate the total number of items
				'per_page' => $per_page, //WE have to determine how many items to show on a page
				'total_pages' => ceil($total_items / $per_page)   //WE have to calculate the total number of pages
			));
		}

		foreach ($data as $index => $row) {
			$data[$index]['failed_login_date'] = get_date_from_gmt(mysql2date('Y-m-d H:i:s', $row['failed_login_date']), $this->get_wp_date_time_format());
		}

		$this->items = $data;
	}

}
