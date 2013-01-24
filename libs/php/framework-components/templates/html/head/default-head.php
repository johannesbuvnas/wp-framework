    <head>
    	<title><?php echo WordpressUtil::getPageTitle(); ?></title>

    	<?php if(DEVELOPMENT_MODE): ?>
			<meta name="googlebot" content="index" />
			<meta name="googlebot" content="nosnippet" />
			<meta name="slurp" content="noydir">
			<meta name="robots" content="noimageindex,nomediaindex,noindex,nofollow,noarchive,noodp" />
		<?php endif; ?>

        <meta charset="<?php bloginfo( 'charset' ); ?>" />
        
        <link rel="profile" href="http://gmpg.org/xfn/11" />
        <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
        <?php if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); ?>
        
        <link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>" type="text/css" media="screen" />

        <script type="text/javascript">

            // Global variables
            FRAMEWORK_URL = "<?php echo FRAMEWORK_URL; ?>";

            APPLICATION_TEMPLATES_URL = FRAMEWORK_URL + "/application/templates/";

            WP_URL = "<?php bloginfo('wpurl'); ?>";

            WP_NONCE_ID = "<?php echo wp_create_nonce("ajax-nonce"); ?>";
        </script>

        <?php wp_head(); ?>

        <?php 

        	if($scripts) $scripts->render();

        ?>

        <?php

			if($googleAnalytics) $googleAnalytics->render();

		?>
    </head>