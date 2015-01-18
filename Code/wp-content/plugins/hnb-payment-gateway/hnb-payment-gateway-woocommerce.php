<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
/*
Plugin Name: HNB Bank IPG
Plugin URI: hnbipg.oganro.net
Description: HNB Bank Payment Gateway from Oganro (Pvt)Ltd.
Version: 1.0
Author: Oganro
Author URI: www.oganro.com
*/

add_action('plugins_loaded', 'woocommerce_hnb_gateway', 0);

function woocommerce_hnb_gateway(){
  if(!class_exists('WC_Payment_Gateway')) return;

  class WC_HNB extends WC_Payment_Gateway{
    public function __construct(){
	  $plugin_dir = plugin_dir_url(__FILE__);
      $this->id = 'HNBIPG';	  
	  $this->icon = apply_filters('woocommerce_Paysecure_icon', ''.$plugin_dir.'hnb.jpg');
      $this->medthod_title = 'HNBIPG';
      $this->has_fields = false;
 
      $this->init_form_fields();
      $this->init_settings(); 
	  
      $this->title 				     = $this -> settings['title'];
      $this->description 		     = $this -> settings['description'];      
      $this->Version 			     = $this -> settings['Version'];
      $this->MerID 				     = $this -> settings['MerID'];
      $this->AcqID 				     = $this -> settings['AcqID'];
      $this->pass 				     = $this -> settings['pass'];
      $this->MerRespURL 			 = $this -> settings['MerRespURL'];
      $this->PurchaseCurrency 			= $this -> settings['PurchaseCurrency'];
      $this->PurchaseCurrencyExponent 	= $this -> settings['PurchaseCurrencyExponent'];
      $this->SignatureMethod 			= $this -> settings['SignatureMethod'];
      $this->CaptureFlag 				= $this -> settings['CaptureFlag'];
      $this->TestFlag 				    = $this -> settings['TestFlag'];
      $this->ShipToLastName 			= $this -> settings['ShipToLastName'];      
      $this->ResponseCode 			    = $this -> settings['ResponseCode'];
      $this->pg_domain 			        = $this-> settings['pg_domain'];      	  
	  $this->responce_url_sucess	= $this-> settings['responce_url_sucess'];
	  $this->responce_url_fail		= $this-> settings['responce_url_fail'];	  
      $this->checkout_msg			= $this-> settings['checkout_msg'];
      
      $this->msg['message'] 	= "";
      $this->msg['class'] 		= "";
 
      add_action('init', array(&$this, 'check_HNBIPG_response'));	  
	  	  
		if ( version_compare( WOOCOMMERCE_VERSION, '2.0.0', '>=' ) ) {
        	add_action( 'woocommerce_update_options_payment_gateways_'.$this->id, array( &$this, 'process_admin_options' ) );
		} else {
            add_action( 'woocommerce_update_options_payment_gateways', array( &$this, 'process_admin_options' ) );
        }
      add_action('woocommerce_receipt_HNBIPG', array(&$this, 'receipt_page'));
	 
   }
	
    function init_form_fields(){
 
       $this -> form_fields = array(
                'enabled' => array(
                    'title' => __('Enable/Disable', 'ogn'),
                    'type' => 'checkbox',
                    'label' => __('Enable HNB IPG Module.', 'ognro'),
                    'default' => 'no'),
					
                'title' => array(
                    'title' => __('Title:', 'ognro'),
                    'type'=> 'text',
                    'description' => __('This controls the title which the user sees during checkout.', 'ognro'),
                    'default' => __('HNB IPG', 'ognro')),
				
				'description' => array(
                    'title' => __('Description:', 'ognro'),
                    'type'=> 'textarea',
                    'description' => __('This controls the description which the user sees during checkout.', 'ognro'),
                    'default' => __('HNB IPG', 'ognro')),	
					
				'Version' => array(
                    'title' => __('PG Version:', 'ognro'),
                    'type'=> 'text',
                    'description' => __('', 'ognro'),
                    'default' => __('', 'ognro')),	
					
				'MerID' => array(
                    'title' => __('PG Merchant Id:', 'ognro'),
                    'type'=> 'text',
                    'description' => __('Unique id for the merchant acc, given by bank.', 'ognro'),
                    'default' => __('', 'ognro')),
				
				'AcqID' => array(
                    'title' => __('PG AcqID:', 'ognro'),
                    'type'=> 'text',
                    'description' => __('', 'ognro'),
                    'default' => __('', 'ognro')),
                
                'pass' => array(
                    'title' => __('PG Pass:', 'ognro'),
                    'type'=> 'text',
                    'description' => __('', 'ognro'),
                    'default' => __('', 'ognro')),    
				
				'PurchaseCurrency' => array(
                    'title' => __('PG Purchase Currency:', 'ognro'),
                    'type'=> 'text',
                    'description' => __('You\'r currency type of the account. 144 (LKR) 840 (USD) ...', 'ognro'),
                    'default' => __('144', 'ognro')),
				
				'PurchaseCurrencyExponent' => array(
                    'title' => __('PG Purchase Currency Exponent:', 'ognro'),
                    'type'=> 'text',
                    'description' => __('', 'ognro'),
                    'default' => __('', 'ognro')),				
					
				'SignatureMethod' => array(
                    'title' => __('PG Signature Method:', 'ognro'),
                    'type'=> 'text',
                    'description' => __('', 'ognro'),
                    'default' => __('', 'ognro')),
					
				'CaptureFlag' => array(
                    'title' => __('CaptureFlag:', 'ognro'),
                    'type'=> 'text',
                    'description' => __('', 'ognro'),
                    'default' => __('', 'ognro')),	  
								
				'TestFlag' => array(
                    'title' => __('Test Flag:', 'ognro'),
                    'type'=> 'text',
                    'description' => __('', 'ognro'),
                    'default' => __('False', 'ognro')),		
					
				'ShipToLastName' => array(
                    'title' => __('Ship To Last Name', 'ognro'),
                    'type'=> 'text',
                    'description' => __(''),
                    'default' => __('', 'ognro')),
				
				'ResponseCode' => array(
                    'title' => __('Response Code', 'ognro'),
                    'type'=> 'text',
                    'description' => __('', 'ognro'),
                    'default' => __('', 'ognro')),
                
                'pg_domain' => array(
                    'title' => __('PG Domain:', 'ognro'),
                    'type'=> 'text',
                    'description' => __('IPG data submiting to this URL', 'ognro'),
                    'default' => __('https://www.hnbpg.hnb.lk/SENTRY/PaymentGateway/Application/ReDirectLink.aspx', 'ognro')),    
                 
                 'MerRespURL' => array(
                    'title' => __('PG MerRespURL:', 'ognro'),
                    'type'=> 'text',
                    'description' => __('', 'ognro'),
                    'default' => __('', 'ognro')),
                    
                 'responce_url_sucess' => array(
                    'title' => __('responce_url_sucess', 'ognro'),
                    'type'=> 'text',
                    'description' => __('', 'ognro'),
                    'default' => __('', 'ognro')),
                 
                 'responce_url_fail' => array(
                    'title' => __('responce_url_fail', 'ognro'),
                    'type'=> 'text',
                    'description' => __('', 'ognro'),
                    'default' => __('', 'ognro')),
                    
                 'checkout_msg' => array(
                    'title' => __('checkout_msg', 'ognro'),
                    'type'=> 'text',
                    'description' => __('', 'ognro'),
                    'default' => __('', 'ognro'))
                                           	
            );
    }
 
	public function admin_options(){
    	echo '<h3>'.__('HNB bank online payment gateway', 'ognro').'</h3>';
        echo '<p>'.__('<a target="_blank" href="http://www.oganro.com/">Oganro</a> is a fresh and dynamic web design and custom software development company with offices based in East London, Essex, Brisbane (Queensland, Australia) and in Colombo (Sri Lanka).').'</p>';
        echo '<table class="form-table">';        
        $this->generate_settings_html();
        echo '</table>'; 
    }
	

    function payment_fields(){
        if($this -> description) echo wpautop(wptexturize($this -> description));
    }

    function receipt_page($order){        		
		global $woocommerce;
        $order_details = new WC_Order($order);
        
        echo $this->generate_ipg_form($order);		
		echo '<br>'.$this->checkout_msg.'</b>';        
    }
    	
    public function generate_ipg_form($order_id){
        
        global $wpdb; 
        global $woocommerce;
 
        $order = new WC_Order($order_id);
		$productinfo = "Order $order_id"; 
		
		$currency_code 	= $this->PurchaseCurrency;
		$curr_symbole 	= get_woocommerce_currency();		
								
		$table_name = $wpdb->prefix . 'hnb_ipg';		
		$check_oder = $wpdb->get_var( "SELECT COUNT(*) FROM $table_name WHERE transaction_id = '".$order_id."'" );		
		if($check_oder > 0){
			$wpdb->update( 
				$table_name, 
				array(					
					'response_code' => '',
					'response_code_desc' => '',					
					'reason_code' => '',
                    'amount' => ($order -> order_total),
                    'or_date' => date('Y-m-d'),
					'status' => ''					
				), 
				array( 'transaction_id' => $order_id ));                
		}else{
			
			$wpdb->insert($table_name, array( 'transaction_id'=>$order_id, 'response_code'=>'', 'response_code_desc'=>'', 'reason_code'=>'', 'amount'=>$order -> order_total, 'or_date' => date('Y-m-d'),'status'=>''), array( '%s', '%d' ) );					
		}	
		                
        $order_format_value = str_pad(($order -> order_total * 100), 12, '0', STR_PAD_LEFT);        											
        $pass = $this->pass.$order_id . $order_format_value . $this->PurchaseCurrency;
        $enc = base64_encode(pack('H*', sha1($pass)));        
        
        $form_args = array(
		  'Version' => $this -> Version,
          'MerID'   => $this -> MerID,          
          'AcqID'   => $this -> AcqID,
          'MerRespURL' => $this -> MerRespURL,
          'PurchaseCurrency' => $this -> PurchaseCurrency,
          'PurchaseCurrencyExponent' => $this -> PurchaseCurrencyExponent,
          'OrderID' => $order_id,
          'SignatureMethod' => $this -> SignatureMethod,
          'Signature' => $enc,
          'CaptureFlag' => $this -> CaptureFlag,
          'PurchaseAmt' => $order_format_value,
          'TestFlag' => $this -> TestFlag,
          'ShipToLastName' => $this -> ShipToLastName,
		  );
		  
        $form_args_array = array();
        foreach($form_args as $key => $value){
          $form_args_array[] = "<input type='hidden' name='$key' value='$value'/>";
        }
        return '<p>'.$percentage_msg.'</p>
		<p>Total amount will be <b>'.$curr_symbole.' '.number_format(($order->order_total)).'</b></p>
		<form action="'.$this->pg_domain.'" method="post" id="merchantForm">
            ' . implode('', $form_args_array) . '
            <input type="submit" class="button-alt" id="submit_ipg_payment_form" value="'.__('Pay via Credit Card', 'ognro').'" /> 
			<a class="button cancel" href="'.$order->get_cancel_order_url().'">'.__('Cancel order &amp; restore cart', 'ognro').'</a>            
            </form>'; 
    }
    	
    function process_payment($order_id){
        $order = new WC_Order($order_id);
        return array('result' => 'success', 'redirect' => add_query_arg('order',           
		   $order->id, add_query_arg('key', $order->order_key, get_permalink(woocommerce_get_page_id('pay' ))))
        );
    }
 
   	 
    function check_HNBIPG_response(){				
        global $woocommerce;		
		if(isset($_POST['ResponseCode']) && isset($_POST['OrderID']) && isset($_POST['ReasonCode'])){			
			$order_id = $_POST['OrderID'];
			
			if($order_id != ''){
				$order 	= new WC_Order($order_id);				
				$amount = $_POST['amount'];
				$status = $_POST['status'];
				if($this->sucess_responce_code == $_POST['ResponseCode']){

				global $wpdb;		
				$table_name = $wpdb->prefix . 'hnb_ipg';	
				$wpdb->update( 
				$table_name, 
				array( 
					'response_code' => $_POST['ResponseCode'],
				    'response_code_desc' => '',					
				    'reason_code' => $_POST['ReasonCode'],                
				    'status' => ''
				), 
				array( 'merchant_reference_no' => $_POST["OrderID"] ));             
                                	
                    $order->add_order_note('HNB payment successful<br/>Unnique Id from HNB IPG: '.$_POST['transaction_id']);
                    $order->add_order_note($this->msg['message']);
                    $woocommerce->cart->empty_cart();
					
					$mailer = $woocommerce->mailer();

					$admin_email = get_option( 'admin_email', '' );

$message = $mailer->wrap_message(__( 'Order confirmed','woocommerce'),sprintf(__('Order %s has been marked on-hold due to a reversal - HNB reason code: %s', 'woocommerce' ), $order->get_order_number(), $posted['reason_code']));	
$mailer->send( $admin_email, sprintf( __( 'Payment for order %s confirmed', 'woocommerce' ), $order->get_order_number() ), $message );					
					
					
$message = $mailer->wrap_message(__( 'Order confirmed','woocommerce'),sprintf(__('Order %s has been marked on-hold due to a reversal - HNB reason code: %s', 'woocommerce' ), $order->get_order_number(), $posted['reason_code']));	
$mailer->send( $order->billing_email, sprintf( __( 'Payment for order %s confirmed', 'woocommerce' ), $order->get_order_number() ), $message );

					$order->payment_complete();							

					wp_redirect( $this->responce_url_sucess, 200 ); exit;
					
				}else{
					$order->update_status('failed');
                    $order->add_order_note('Failed - Code'.$_POST['ReasonCodeDesc']);
                    $order->add_order_note($this->msg['message']);
					
					global $wpdb;		
					$table_name = $wpdb->prefix . 'hnb_ipg';	
					$wpdb->update( 
					$table_name, 
					array( 
						'response_code' => $_POST['ResponseCode'],
				        'response_code_desc' => '',					
				        'reason_code' => $_POST['ReasonCode'],                
				        'status' => ''
					), 
					array( 'merchant_reference_no' => $_POST["OrderID"] ));
					
					wp_redirect( $this->responce_url_fail, 200 ); exit;
				}
			}
			
		}
    }
    
    function get_pages($title = false, $indent = true) {
        $wp_pages = get_pages('sort_column=menu_order');
        $page_list = array();
        if ($title) $page_list[] = $title;
        foreach ($wp_pages as $page) {
            $prefix = '';            
            if ($indent) {
                $has_parent = $page->post_parent;
                while($has_parent) {
                    $prefix .=  ' - ';
                    $next_page = get_page($has_parent);
                    $has_parent = $next_page->post_parent;
                }
            }            
            $page_list[$page->ID] = $prefix . $page->post_title;
        }
        return $page_list;
    }
}


if(isset($_POST['ResponseCode']) && isset($_POST['ReasonCode']) && isset($_POST['OrderID'])){
	$WC = new WC_HNB();
}

   
   function woocommerce_add_hnb_gateway($methods) {
       $methods[] = 'WC_HNB';
       return $methods;
   }
	 	
    add_filter('woocommerce_payment_gateways', 'woocommerce_add_hnb_gateway' );
}

	global $jal_db_version;
	$jal_db_version = '1.0';
	
	function jal_install_hnb() {		
		global $wpdb;
		global $jal_db_version;
	
		$table_name = $wpdb->prefix . 'hnb_ipg';
		$charset_collate = '';
	
		if ( ! empty( $wpdb->charset ) ) {
		  $charset_collate = "DEFAULT CHARACTER SET {$wpdb->charset}";
		}
	
		if ( ! empty( $wpdb->collate ) ) {
		  $charset_collate .= " COLLATE {$wpdb->collate}";
		}
	
		$sql = "CREATE TABLE $table_name (
					id int(9) NOT NULL AUTO_INCREMENT,
					transaction_id int(9) NOT NULL,					
					response_code VARCHAR(20) NOT NULL,
					response_code_desc int(6) NOT NULL,										
					reason_code VARCHAR(20) NOT NULL,
                    amount VARCHAR(20) NOT NULL,
                    or_date DATE NOT NULL,                    
                    status int(6) NOT NULL,					
					UNIQUE KEY id (id)
				) $charset_collate;";
				
	
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta( $sql );
	
		add_option( 'jal_db_version', $jal_db_version );
	}
	
	function jal_install_data_hnb() {
		global $wpdb;
		
		$welcome_name = 'HNB IPG';
		$welcome_text = 'Congratulations, you just completed the installation!';
		
		$table_name = $wpdb->prefix . 'hnb_ipg';
		
		$wpdb->insert( 
			$table_name, 
			array( 
				'time' => current_time( 'mysql' ), 
				'name' => $welcome_name, 
				'text' => $welcome_text, 
			) 
		);
	}
	
	register_activation_hook( __FILE__, 'jal_install_hnb' );
	register_activation_hook( __FILE__, 'jal_install_data_hnb' );