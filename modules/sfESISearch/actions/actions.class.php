<?php

/**
 * esiSearch actions.
 *
 * @package    keystone-symfony
 * @subpackage esiSearch
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class sfESISearchActions extends sfActions
{
  /**
   * Executes index action
   *
   */
  public function executeIndex()
  {
		if ( $this->getRequest()->hasParameter('address') ) 
		{
		  $address = $this->getRequest()->getParameter('address');
		  $zip = $this->getRequest()->getParameter('zip');
		  
			$esiRetriever = new esiRetriever;
	    $result = $esiRetriever->getByAddress( $address, $zip );

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

	public function executeFindByAddress()
  {
    $address = $this->getRequest()->getParameter('address');
    $zip = $this->getRequest()->getParameter('zip');
		$esiRetriever = new esiRetriever;
    $result = $esiRetriever->getByAddress( $address, $zip );
    //echo '<pre>'; print_r($result); echo '</pre>'; exit;
		if ( $result['error_message'] == null )
		{
			$this->results = $result['row'];
		}
		else
		{
			$this->results = array( 'error_message' => $result['error_message'] );
		}
		$this->setLayout(false);
		$this->getResponse()->setHttpHeader('Cache-Control', 'no-store, no-cache, must-revalidate', true);
		$this->getResponse()->setHttpHeader('Cache-Control', 'no-store, no-cache, must-revalidate', true);
    $this->getResponse()->setHttpHeader('Pragma', 'no-cache', true);
  }
}
