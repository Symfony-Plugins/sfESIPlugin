<?php
/**
 * This class represents an instance of a drupal site, and provides methods
 * to create the site in cpanel and push an instance of the site from a
 * "gold master" in place, including code and data.
 * @package esiRetriever
 * @version 1.0.0
 * @copyright CentreSource 2007
 * @author Josh Reynolds <jreynolds@centresource.com>
 */
class esiRetriever
{
	/**
	 * The street address for the ESI to be retrieved
	 * 
	 * @access public
	 * @var string
	 */
	public $address;
	
	/**
	 * The zip code for the ESI to be retrieved
	 * 
	 * @access public
	 * @var string
	 */
	public $zip;

	/**
	 * String placeholder for any errors encounted.
	 *
	 * @access public
	 * @var string
	 */
	protected $error;
	
	/**
	 * Holds the URL used to get the esi id
	 *
	 * @access public
	 * @var string
	 */
	protected $requestUrl;

	/**
	 * set the Address to be used in the query
	 *
	 * @param string $address
	 * @access public
	 * @return void
	 */
	public function setAddress( $address )
	{
		$this->address = str_replace( ' ', '+', $address );
	}
	
	/**
	 * set the zip code to be used in the query
	 *
	 * @param string $zip
	 * @access public
	 * @return void
	 */
	public function setZip ( $zip )
	{
		$this->zip = $zip;
	}
	
	/**
	 * get the request URL
	 * returns a string of the request url in use
	 *
	 * @access public
	 * @return string
	 */
	public function getRequestURL ()
	{
		return $this->requestUrl;
	}

	/**
	 * execute the query to find by address
	 * return an aray of the esi ids and addresses found
	 *
	 * @param string $address
	 * @param string $zip
	 * @access public
	 * @return array
	 */
	public function getByAddress ( $address = null, $zip = null )
	{
		if ( $address != null )
		{
			$this->setAddress( $address );
		}
		if ( $zip != null )
		{
			$this->setZip( $zip );
		}
		
		$this->requestUrl = "http://www.esiids.com/cgi-bin/esiids_xml.cgi?address=".$this->address."&zip=".$this->zip."&display=all";
		$ch = curl_init();
		$timeout = 5;
		curl_setopt( $ch, CURLOPT_URL, $this->requestUrl );
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
		curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT, $timeout );
		$data = curl_exec( $ch );
		$xml = new SimpleXMLElement( $data );
		return $this->simplexml2ISOarray($xml, 0);
	}

	/**
	 * generate an associative array that follows the structure of the SimpleXMLElement
	 * returns an array of the elements from the xml element
	 *
	 * @param SimpleXMLElement $xml
	 * @param integer $attribsAsElements
	 * @access public
	 * @return array
	 */
	private function simplexml2ISOarray($xml,$attribsAsElements=0) {
	    if (get_class($xml) == 'SimpleXMLElement') {
	        $attributes = $xml->attributes();
	        foreach($attributes as $k=>$v) {
	            if ($v) $a[$k] = (string) $v;
	        }
	        $x = $xml;
	        $xml = get_object_vars($xml);
	    }
	    if (is_array($xml)) {
	        if (count($xml) == 0) return (string) $x; // for CDATA
	        foreach($xml as $key=>$value) {
	            $r[$key] = $this->simplexml2ISOarray($value,$attribsAsElements);
	            if (!is_array($r[$key])) $r[$key] = utf8_decode($r[$key]);
	        }
	        if (isset($a)) {
	            if($attribsAsElements) {
	                $r = array_merge($a,$r);
	            } else {
	                $r['@'] = $a; // Attributes
	            }
	        }
	        return $r;
	    }
	    return (string) $xml;
	}
}
