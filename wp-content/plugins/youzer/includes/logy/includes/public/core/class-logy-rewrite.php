<?php

class Logy_Rewrite {

	function __construct() {

		// Redirect User to Login Page
		add_action( 'template_redirect', array( &$this, 'redirect_to_login_page' ) );
		
		// Redirect User to Home Page
		add_action( 'template_redirect', array( &$this, 'redirect_to_home_page' ) );

	}

	/**
	 * # Redirect Users to login Page.
	 */
	function redirect_to_login_page() {
		
		if ( ! is_user_logged_in() ) {

			// Get Login Page Url
			$login_page = logy_page_url( 'login' );

			// if the page is register & Registration is disabled, redirect user to the login page.
			$registration_enabled = get_option( 'users_can_register' );

			if ( ! $registration_enabled && logy_is_page( 'register' ) ) {
				wp_safe_redirect( $login_page );
				exit;
			}

			if ( logy_is_page( 'complete-registration' ) && ! is_registration_incomplete() ) {
				wp_safe_redirect( $login_page );
				exit;
			}
		}

	}

	/**
	 * # Redirect Users to Home Page.
	 */
	function redirect_to_home_page() {

		if ( is_front_page() ) {
			return false;
		}

		// Redirect To home if user is logged-in and he/she want to visit one of these pages.
		$forbidden_pages = array(
			logy_page_id( 'login' ),
			logy_page_id( 'lost-password' ),
			logy_page_id( 'complete-registration' ),
		);

		// Redirect User to home page.
		if ( is_user_logged_in() && in_array( get_the_ID() , $forbidden_pages )	) {
			wp_redirect( site_url() , 301 );
			exit;
		}

	}

}