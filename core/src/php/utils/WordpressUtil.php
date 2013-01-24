<?php

class WordpressUtil
{
	/**
	*	Construct a page title.
	*/
	public static function getPageTitle()
	{
		global $page, $paged;

		wp_title( '|', true, 'right' );

		// Add the blog name.
		$title = get_bloginfo( 'name' );

		// Add the blog description for the home/front page.
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) )
			$title .= " | $site_description";

		// Add a page number if necessary:
		if ( $paged >= 2 || $page >= 2 )
			$title .= ' | ' . sprintf( __( 'Page %s', 'twentyten' ), max( $paged, $page ) );

		return $title;
	}
	
	/**
	*	Get URL of asset within theme.
	*/
	public static function getThemeAssetURL($assetName)
	{
		return get_bloginfo("template_url")."/".$assetName;
	}
	
	/**
	*	Get the excerpt of post.
	*/
	public static function getPostPreviewContent($post, $words = 55, $more = " [...]")
	{
		$content = StringUtil::stripLinks( apply_filters( "the_content", StringUtil::stripBrackets( $post->post_content ) ) );

		$trimmedContent = StringUtil::stripBrackets( wp_trim_words( $post->post_content, $words, "") );

		
		$trimmedContentArray = explode( " ", $trimmedContent );
		
		$lastWordsCount = 10;
		
		$lastWords = implode( " ", array_slice( $trimmedContentArray, count($trimmedContentArray) - $lastWordsCount, $lastWordsCount ) );
		
		if(strlen($lastWords) > 0)
		{
			while(($pos = strpos( $content, $lastWords )) == 0 && $lastWordsCount > 0)
			{
				$lastWordsCount--;
			
				$lastWords = implode( " ", array_slice( $trimmedContentArray, count($trimmedContentArray) - $lastWordsCount, $lastWordsCount ) );
			}
		}
		
		if(isset($pos) && $pos)
		{
			$pos += strlen($lastWords);
			
			$content = StringUtil::stripLinks( apply_filters( "the_content", substr( $content, 0, $pos ).$more ) );
			
			return $content;
		}
		else
		{
			return $trimmedContent.$more;
		}
	}

	/**
	* Get all img tags.
	*/
	public static function getPostImages($post)
	{
		// $html = str_get_html( apply_filters( "the_content", $post->post_content ) );

		$regexp = '/(<img[^>]*src=".*?(?:pre\.gif|next\.gif)"[^>]*>)/i';
		preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
		
		return $matches[1];
	}
	
	/**
	*	Get the content of post.
	*/
	public static function getPostContent($post)
	{
		return apply_filters("the_content", $post->post_content);
	}
	
	/**
	*	Get the date of post.
	*/
	public static function getPostDate($post)
	{
		return apply_filters('get_the_date',  mysql2date( get_option("date_format"), $post->post_date ) );
	}
	
	/**
	*	Get a list / "cloud" of categories.
	*/
	public static function getPostCategoryCloud($post)
	{
		$list = "<ul class='category-cloud'>";
		
		$categories = wp_get_post_categories( $post->ID );
		
		foreach($categories as $categoryID)
		{
			$category = get_category( $categoryID );
			
			$list .= "<li class='category-cloud-item' data-id='".$categoryID."' data-name='".$category->name."'>";
			$list .= "<a href='".get_category_link($categoryID)."'>";
			$list .= "<span class='category-cloud-item-name'>";
			$list .= $category->name;
			$list .= "</span>";
			$list .= "<span class='category-cloud-item-count'>";
			$list .= $category->count;
			$list .= "</span>";
			$list .= "</a>";
			$list .= "</li>";
		}
		
		$list .= "</ul>";
		
		return $list;
	}
}

?>