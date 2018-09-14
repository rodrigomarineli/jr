<?php

function getBandeira( $cardNumber )
{
	if( is_string( $cardNumber ) )
	{
		$cardNumber = preg_replace("/[^0-9]/", "", $cardNumber);

		if( 13 > strlen($cardNumber) || 19 < strlen($cardNumber) ) return false;

		if( ( 
			  	'36'  == substr( $cardNumber, 0, 2 ) ||
			  	'38'  == substr( $cardNumber, 0, 2 ) ||
			  	'301' == substr( $cardNumber, 0, 3 ) ||
			  	'305' == substr( $cardNumber, 0, 3 ) 
			)
			&&
			(
				14 == strlen( $cardNumber ) ||
				16 == strlen( $cardNumber )
			)
		)
		{
			return 'diners';
		}

		if( (
			  	'4011'   == substr( $cardNumber, 0, 4 ) ||
			  	'4576'   == substr( $cardNumber, 0, 4 ) ||
			  	'5067'   == substr( $cardNumber, 0, 4 ) ||
			  	'438935' == substr( $cardNumber, 0, 6 ) ||
			  	'451416' == substr( $cardNumber, 0, 6 ) ||
			  	'504175' == substr( $cardNumber, 0, 6 ) ||
			  	'506699' == substr( $cardNumber, 0, 6 ) ||
				'636368' == substr( $cardNumber, 0, 6 ) ||
			  	'636369' == substr( $cardNumber, 0, 6 ) ||
			  	'636297' == substr( $cardNumber, 0, 6 ) 
			)
			&&
			(
				14 == strlen( $cardNumber ) ||
				16 == strlen( $cardNumber )
			)
		)
		{
			return 'elo';
		}

		if( (
			  	'64'   == substr( $cardNumber, 0, 2 ) ||
			  	'65'   == substr( $cardNumber, 0, 2 ) ||
			  	'622'  == substr( $cardNumber, 0, 3 ) ||
			  	'6011' == substr( $cardNumber, 0, 4 ) 
			)
			&&
			16 == strlen( $cardNumber )
		)
		{
			return 'discover';
		}

		if( (
			  	'34'   == substr( $cardNumber, 0, 2 ) ||
			  	'37'   == substr( $cardNumber, 0, 2 )
			)
			&&
			15 == strlen( $cardNumber )
		)
		{
			return 'amex';
		}

		if( '50' == substr( $cardNumber, 0, 2 )
			&&
			16 == strlen( $cardNumber )
		)
		{
			return 'aura';
		}

		if( (
			  	'38'   == substr( $cardNumber, 0, 2 ) ||
			  	'60'   == substr( $cardNumber, 0, 2 )
			)
			&&
			( 
				13 == strlen( $cardNumber ) ||
				16 == strlen( $cardNumber ) ||
				19 == strlen( $cardNumber )
			)
		)
		{
			return 'hipercard';
		}

		if( '35' == substr( $cardNumber, 0, 2 )
			&&
			16 == strlen( $cardNumber )
		)
		{
			return 'jcb';
		}

		if( '4' == substr( $cardNumber, 0, 1 )
			&&
			(
				13 == strlen( $cardNumber ) ||
				16 == strlen( $cardNumber )
			)
		)
		{
			return 'visa';
		}

		if( '5' == substr( $cardNumber, 0, 1 )
			&&
			16 == strlen( $cardNumber )
		)
		{
			return 'master';
		}

		return false;
	}
	return false;
}