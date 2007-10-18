<?php

/**
 * cc_signup actions.
 *
 * @package    keystone-symfony
 * @subpackage cc_signup
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class sfESISearchComponents extends sfComponents
{
  public function executeEsiTable()
  {
		$esiRetriever = new esiRetriever;
    $result = $esiRetriever->getByAddress( $this->address, $this->zip );

		if ( $result['error_message'] == "" )
		{
			$this->results = $result['row'];
		}
		else
		{
			$this->results = array( 'error_message' => $result['error_message'] );
		}
  }
}
?>