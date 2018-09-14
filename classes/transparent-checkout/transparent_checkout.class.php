<?php

require_once ('mercadopago.php');

class TransparentCheckout
{
	/**
	 * Default arguments for request on Mercado Livre
	 * @var object
	 */
	protected $defaultArgs;

	protected $args;
	
	/**
	 * The Public Key for authentication
	 * @var string
	 */
	protected $public_key;

	/**
	 * The Access Token for authentication
	 * @var string
	 */
	protected $access_token;
	
	/**
	 * Mercado Pago class, for more information access "mercadopago.php" file
	 * @var object MP
	 */
	protected $mp;

	protected $last_request;
	
	/**
	 * On create object, pass all arguments to request a payment.
	 * @param object $arguments arguments for MP class
	 */
	public function __construct( $arguments = array() )
	{
		if( !is_array( $arguments ) ) trigger_error($this->errorMessages('VARTYPE'), E_USER_ERROR);

		$this->setDefaultVars();

		$args 				= array_merge($this->defaultArgs, $arguments);
		//$args 				= $arguments;
		$mp 				= $this->mp;

		//...
		
		$this->args = $args;

		return $this;
	}

	/**
	 * Set default values for global variables.
	 */
	private function setDefaultVars()
	{
		$this->public_key 	= $this->getPublicKey();
		$this->access_token	= $this->getAccessToken();
		$this->defaultArgs 	= $this->getDefaultArgs();
		$this->mp 			= $this->getMP();

		return $this;
	}

	public function payment()
	{
		$mp 			= $this->mp;
		$payment_data	= $this->args;
		$payment 		= $mp->post("/v1/payments", $payment_data);

		$this->last_request = $payment;

		return $this;
	}

	public function getLastRequest()
	{
		return $this->last_request;
	}

	public function getStatus()
	{
		return $this->last_request['response']['status'];
	}

	/**
	 * All default parameters for request payment
	 * More details access https://www.mercadopago.com.br/developers/pt/api-docs/custom-checkout/create-payments/
	 * 
	 * @return [type] [description]
	 */
	protected function getDefaultArgs()
	{
		return array(
			//Integer
			//"id" 							=> 0,
			//Date (ISO_8601)
			//"date_created" 					=> "", //1997-07-16T19:20:30.45+01:00 
			//Date (ISO_8601)
			//"date_approved" 				=> "", //1997-07-16T19:20:30.45+01:00
			//Date (ISO_8601)
			//"date_last_updated" 			=> "", //1997-07-16T19:20:30.45+01:00
			//Date (ISO_8601)
			//"money_release_date"			=> "", //1997-07-16T19:20:30.45+01:00
			//Integer
			//"collector_id"					=> 0,
			//String
			//	Values:
			//		"regular_payment"		-> Typification by default of a purchase being paid using MercadoPago
			//		"money_transfer"		-> Funds transfer between two users
			//		"recurring_payment"		-> Automatic recurring payment due to an active user subscription
			//		"account_fund"			-> Money income in the user's account
			//		"payment_addition"		-> Addition of money to an existing payment, done in MercadoPago's site
			//		"cellphone_recharge"	-> Recharge of a user's cellphone account
			//		"pos_payment"			-> Payment done through a Point Of Sale
			//"operation_type"				=> "",
			//Object
			//"payer"							=> (object)array(
				//array(
					//String
					//"type"				=> "",
					//Integer
					//"id"				=> 0,
					//String
					//"email" 			=> "",
					//Object
					//"identification" 	=> (object)array(
						//String
						//"type" 		=> "",
						//String
						//"number" 	=> ""
					//),
					//Object
					//"phone"				=> (object)array(
						//String
						//"area_code" => "",
						//String
						//"number"	=> "",
						//String
						//"extension"	=> "",
					//),
					//String
					//"first_name"		=> "",
					//String
					//"last_name"			=> ""
				//)
			//),
			//Boolean
			//"binary_mode"					=> false,
			//Boolean
			//"live_mode"						=> false,
			//Object
			//"order"							=> (object)array(
				//String
				//	Values:
				//		//"mercadolibre"
				//		//"mercadopago"
				//"type"	=> "mercadopago",
				//Long
				//"id"	=> 0
			//),
			//String
			//"external_reference"			=> "",
			//String
			//"description"					=> "",
			//Object
			//	Custom parameters:
			//		(object)array(
			//			//"key1" 	=> "value1",
			//			//"key2" 	=> "value2"
			//		)
			//"metadata"						=> (object)array(),
			//String
			//	Values:
			//		//"ARS" -> Argentine peso
			//		//"BRL" -> Brazilian real
			//		//"VEF" -> Venezuelan strong bolivar
			//		//"CLP" -> Chilean peso
			//		//"MXN" -> Mexican peso
			//		//"COP" -> Colombian peso
			//		//"PEN" -> Peruvian sol
			//		//"UYU" -> Uruguayan peso
			//"currency_id"					=> "",
			//Float
			//"transaction_amount"			=> 0,
			//Float
			//"transaction_amount_refunded"	=> 0,
			//Float
			//"coupon_amount"					=> 0,
			//Integer
			//"campaign_id"					=> 0,
			//String
			//"coupon_code"					=> "",
			//Object
			//"transaction_details"			=> (object)array(
				//String
				//"financial_institution"			=> "",
				//Floar
				//"net_received_amount"			=> 0,
				//Float
				//"total_paid_amount"				=> 0,
				//Float
				//"installment_amount"			=> 0,
				//Float
				//"overpaid_amount"				=> 0,
				//String
				//"external_resource_url"			=> "",
				//String
				//"payment_method_reference_id"	=> ""
			//),
			//Array (Object)
			//"fee_details"					=> (object)array(
				//String
				//	Values:
				//		mercadopago_fee	-> Cost for using MercadoPago
				//		coupon_fee		-> Discount given by a coupon
				//		financing_fee	-> Cost of financing
				//		shipping_fee	-> Shipping cost
				//		application_fee	-> Marketplace comision for the service
				//		discount_fee	-> Discount given by the seller through cost absorption
				//"type"		=> "",
				//String
				//"fee_payer"	=> "",
				//Float
				//"amount"	=> 0
			//),
			//Integer
			//"differential_pricing_id"		=> 0,
			//Float
			//"application_fee"				=> 0,
			//String
			//	Values:
			//		//"pending" 		-> The user has not yet completed the payment process
			//		//"approved" 		-> The payment has been approved and accredited
			//		//"authorized" 	-> The payment has been authorized but not captured yet
			//		//"in_process" 	-> Payment is being reviewed
			//		//"in_mediation"	-> Users have initiated a dispute
			//		//"rejected"		-> Payment was rejected. The user may retry payment.
			//		//"cancelled"		-> Payment was cancelled by one of the parties or because time for payment has expired
			//		//"refunded" 		-> Payment was refunded to the user
			//		//"charged_back" 	-> Was made a chargeback in the buyer’s credit card
			//"status"						=> "",
			//String
			//"status_detail"					=> "",
			//Boolean
			//"capture"						=> true,
			//Boolean
			//"captured"						=> false,
			//String
			//"call_for_authorize_id"			=> "",
			//String
			//"payment_method_id"				=> "",
			//String
			//"issuer_id"						=> "",
			//String
			//	Value:
			//		//"account_money"	-> Money in the MercadoPago account
			//		//"ticket"		-> Printed ticket
			//		//"bank_transfer"	-> Wire transfer
			//		//"atm" 			-> Payment by ATM
			//		//"credit_card"	-> Payment by credit card
			//		//"debit_card"	-> Payment by debit card
			//		//"prepaid_card"	-> Payment by prepaid card
			//"payment_type_id"				=> "",
			//String
			//"token"							=> "",
			//Object
			//"card"							=> (object)array(
				//Number
				//"id"				=> 0,
				//String
				//"last_four_digits"	=> "",
				//String
				//"first_six_digits"	=> "",
				//Integer
				//"expiration_year"	=> 0,
				//Integer
				//"expiration_month"	=> 0,
				//Date (ISO_8601)
				//"date_created"		=> "", //1997-07-16T19:20:30.45+01:00 
				//Date (ISO_8601)
				//"date_last_updated"	=> "", //1997-07-16T19:20:30.45+01:00
				//Object
				//"cardholder"		=> (object)array(
					//String
					//"name"				=> "",
					//Object
					//"identification"	=> (object)array(
						//Number
						//"number"	=> "",
						//String
						//"type"		=> ""
					//)
				//),
			//),
			//String
			//"statement_descriptor"			=> "",
			//Integer
			//"installments"					=> 0,
			//String
			//"notification_url"				=> "",
			//Array (Object)
			//"refunds"						=> (object)array(
				//array(
					//Number
					//"id"						=> 0,
					//Number
					//"payment_id"				=> 0,
					//Float
					//"amount"					=> 0,
					//Object
					//	Custom parameters:
					//		(object)array(
					//			//"key1" 	=> "value1",
					//			//"key2" 	=> "value2"
					//		)
					//"metadata"					=> (object)array(),
					//String
					//	Values:
					//		//"collector" -> The collector issued the refund
					//		//"admin" 	-> The refund was made by a MercadoPago administrator
					//		//"bpp" 		-> The refund was made by the MercadoPago's Buyer Protection Program
					//"source"					=> "",
					//Date (ISO_8601)
					//"date_created" 				=> "", //1997-07-16T19:20:30.45+01:00 
					//String
					//"unique_sequence_number"	=> ""
				//)
			//),
			//Object
			//"additional_info"				=> (object)array(
				//Array (Object)
				//"items"		=> (object)array(
					//array(
						//String
						//"id"			=> "",
						//String
						//"title"			=> "",
						//String
						//"description"	=> "",
						//String
						//"picture_url"	=> "",
						//String
						//"category_id"	=> "",
						//Integer
						//"quantity"		=> 0,
						//Float
						//"unit_price"	=> 0
					//)
				//),
				//Object
				//"payer"		=> (object)array(
					//String
					//"first_name"		=> "",
					//String
					//"last_name"			=> "",
					//Object
					//"phone"				=> (object)array(
						//String
						//"area_code"	=> "",
						//String
						//"number"	=> ""
					//),
					//Object
					//"address"			=> (object)array(
						//String
						//"zip_code"		=> "",
						//String
						//"street_name"	=> "",
						//Integer
						//"street_number"	=> 0,
					//),
					//Date
					//"registration_date"	=> "1997-07-16",
				//),
				//Object
				//"shipments"	=> (object)array(
					//Object || String ???
					//"receiver_address" 	=> (object)array(
						//String
						//"zip_code"		=> "",
						//String
						//"street_name"	=> "",
						//Integer
						//"street_number"	=> 0,
						//String
						//"floor"			=> "",
						//String
						//"apartment"		=> ""
					//)
				//)
			//),
		);
	}

	/**
	 * The value for Public Key
	 * @return string the pure value
	 */
	protected function getPublicKey()
	{
		// return 'TEST-8fc0d9f7-7819-4928-86d4-e6412944a27b';
		return MP_PUBLIC_KEY;
	}

	/**
	 * The value for Access Token
	 * @return string the pure value
	 */
	protected function getAccessToken()
	{
		// return 'TEST-1215281093521349-103013-984eafd64e757a4b01812e497fe1e700__LB_LD__-226346703';
		return MP_ACESS_TOKEN;
	}

	/**
	 * Create a new MP instance.
	 * for more information, access "mercadopago.php" file
	 * @return object MP the MP instance
	 */
	protected function getMP()
	{
		return new MP( $this->getAccessToken() );
	}

	/**
	 * Create a custom messages for errors in TransparentCheckout class
	 * @param  string $error the key of error type
	 * @return string        the message for key error past.
	 */
	private function errorMessages( $error = null )
	{
		if( is_null( $error ) )
		{
			trigger_error($this->errorMessages('No error message selected.'), E_USER_ERROR);
			return null;
		}

		switch ($error)
		{
			case 'VARTYPE':
				$errorMessage = 'The type of variable is incorrect.';
				break;
			
			default:
				$errorMessage = 'OOps! The type error selected is not configured yet.';
				break;
		}

		return $errorMessage;
	}

	/**
	 * Create a VAR_DUMP for any variable into class.
	 * @param  any  $content any content possible.
	 * @return html          description for variable past.
	 */
	public function pre( $content = null )
	{
		if( is_null( $content ) ) return false;

		echo "<pre>\n";
		var_dump( $content );
		echo "\n</pre>\n";
	}
}
