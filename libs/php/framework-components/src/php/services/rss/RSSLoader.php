<?php
	
	class RSSLoader
	{
	
		protected $_rawXML;
		
		public $items;
		
		public $categories;
		
		public function __construct()
		{
			$this->items = array();
			$this->categories = array();
		}
		
		public function __toString()
		{
			return isset( $this->_rawXML ) ? $this->_rawXML : null;
		}
		
		/* PUBLIC METHODS */
		public function load($url, $id = null, $maxItems = -1)
		{	
			$rssLoader = new DOMDocument();
			
			if($rssLoader->load( $url ))
			{	
				$this->parse( $rssLoader->saveXML(), $id = null, $maxItems = -1 );
				
				return true;
			}
			
			return false;
		}
		
		function parse($xml, $id = null, $maxItems = -1)
		{
			$this->_rawXML = $xml;
			
			$rssLoader = new DOMDocument();
			$rssLoader->loadXML( $xml );
			
			$id = $id ? $id : "undefined";
				
				$items = $rssLoader->getElementsByTagName( 'item' );
			
				$blogTitle = $rssLoader->getElementsByTagName( "title" )->item(0)->nodeValue;
				$blogURL = $rssLoader->getElementsByTagName( "link" )->item(1)->nodeValue;
				
				$currentItem = 0;
				
				foreach($items as $itemNode)
				{
					$currentItem++;
					
					$item = new RSSItem( $itemNode );
					
					$item->blogTitle = $blogTitle;
					
					$item->blogURL = $blogURL;
					
					$item->blogID = $id;
					
					$this->items[] = $item;
					
					foreach($item->tags as $tag)
					{
						$this->addCategory($tag);
					}
					
					if($maxItems > 0 && $currentItem >= $maxItems) break;
				}
				
				usort( $this->items, array("RSSLoader", "itemsDateComparison") );
				
				sort( $this->categories );
		}
		
		public function getItemsWithinCategory($categoryName)
		{
			$resultArray = array();
			
			foreach($this->items as $item)
			{
				if($item->hasCategory($categoryName)) $resultArray[] = $item;
			}
			
			usort( $resultArray, array("RSSLoader", "itemsDateComparison") );
			
			return $resultArray;
		}
		
		/* PRIVATE METHODS */
		function itemsDateComparison($a,$b,$d="-") 
		{ 				
			if (strtotime( $a->date ) == strtotime( $b->date )) 
			{
		        return 0;
		    }
		    
		    return (strtotime( $a->date ) > strtotime( $b->date )) ? -1 : 1;
		}
		
		protected function addCategory($categoryName)
		{
			if(!$this->hasCategory($categoryName)) $this->categories[] = $categoryName;
		}
		
		protected function hasCategory($categoryName)
		{
			foreach($this->categories as $category)
			{
				if(strtolower($category) == strtolower($categoryName)) return true;
			}
			
			return false;
		}
		
	}

?>