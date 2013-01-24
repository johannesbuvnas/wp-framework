<?php
	
	class RSSItem
	{
		
		/* VARS */
		protected $_nodeData;
		
		
		/* PUBLIC VARS */
		public $blogTitle;
		
		public $blogURL;
		
		public $blogID;
		
		public $title;
		
		public $content;
		
		public $date;
		
		public $link;
		
		public $tags;
		
		
		function __construct($nodeData)
		{
			$this->_nodeData = $nodeData;
			
			$this->fetchData();
		}
		
		/* PUBLIC METHODS */
		public function __toString()
		{
			$str = "<item>";
			$str .= "<title><![CDATA[".$this->title."]]></title>";
			$str .= "<description><![CDATA[".$this->content."]]></description>";
			$str .= "<pubDate><![CDATA[".$this->date."]]></pubDate>";
			$str .= "<link><![CDATA[".$this->link."]]></link>";
			foreach($this->tags as $tag)
			{
				$str .= "<category><![CDATA[".$tag."]]></category>";
			}
			$str .= "</item>";
			
			return $str;
		}
		
		public function hasCategory($categoryName)
		{
			foreach($this->tags as $category)
			{
				if(strtolower($category) == strtolower($categoryName)) return true;
			}
			
			return false;
		}
		
		/* PRIVATE METHODS */
		protected function fetchData()
		{
			$this->title = $this->getPropertyValue('title');
			$this->content = $this->getPropertyValue('description');
			$this->date = strftime( "%Y-%m-%d %H:%M:%S", strtotime( $this->getPropertyValue('pubDate') ) );
			$this->link = $this->getPropertyValue('link');
			$this->tags = array();
			
			$categories = $this->_nodeData->getElementsByTagName( 'category' );
			
			foreach($categories as $category)
			{
				$this->tags[] = $category->nodeValue;
			}
		}
		
		protected function getPropertyValue($propertyName)
		{
			return $this->_nodeData->getElementsByTagName( $propertyName )->item(0)->nodeValue;
		}
	}
	
?>