<?php 

if ( !function_exists( 'lsx_sass_compiler' ) ):
	function lsx_sass_compiler($options, $css) {

		require "scss.inc.php";
		$scss = new scssc();
		$scss->setImportPaths( array( get_template_directory() . '/assets/sass/', get_template_directory() . '/assets/sass/bootstrap/' ) );

		$bootstrap_variables = bootstrap_variables();

		$filename =  get_template_directory() . '/assets/sass/bootstrap/_variables.scss';

			    global $wp_filesystem;
			    if( empty( $wp_filesystem ) ) {
			        require_once( ABSPATH .'/wp-admin/includes/file.php' );
			        WP_Filesystem();
			    }

			    if( $wp_filesystem ) {
			        $wp_filesystem->put_contents(
			            $filename,
			            $bootstrap_variables,
			            FS_CHMOD_FILE // predefined mode settings for WP files
			        );
			    }

		$css = $scss->compile('@import "app.scss"');

		 //So you can compile the CSS within your own file to cache
	    $filename = get_template_directory() . '/assets/css/main.min.css';

			    global $wp_filesystem;
			    if( empty( $wp_filesystem ) ) {
			        require_once( ABSPATH .'/wp-admin/includes/file.php' );
			        WP_Filesystem();
			    }

			    if( $wp_filesystem ) {
			        $wp_filesystem->put_contents(
			            $filename,
			            $css,
			            FS_CHMOD_FILE // predefined mode settings for WP files
			        );
			    }

	}
	add_filter('redux/options/lsx_options/compiler', 'lsx_sass_compiler', 10, 2);
	// replace redux_demo with your opt_name
endif;