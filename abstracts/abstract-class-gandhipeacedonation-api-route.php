<?php
/**
 * Base class for Gandhipeacedonation API routes.
 *
 * @package   Gandhipeacedonation/Classes/Gandhipeacedonation_API_Route
 * @author    Anukul Sharma
 * @copyright Copyright (c) 2019, James Cook University Brisbane
 * @license   http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since     1.0.0
 * @version   1.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Gandhipeacedonation_API_Route' ) ) :

	/**
	 * Gandhipeacedonation_API_Route
	 *
	 * @since 1.6.0
	 */
	abstract class Gandhipeacedonation_API_Route extends WP_REST_Controller {

		/**
		 * Namespace.
		 *
		 * @since 1.6.0
		 *
		 * @var   string
		 */
		protected $namespace;

		/**
		 * API version.
		 *
		 * @since 1.6.0
		 *
		 * @var   int
		 */
		protected $version;

		/**
		 * Set up API namespace.
		 *
		 * @since 1.6.0
		 */
		public function __construct() {
			$this->version   = 1;
			$this->namespace = 'gandhipeacedonation/v' . $this->version;
		}

		/**
		 * Returns whether the current user can export Gandhipeacedonation reports.
		 *
		 * @since  1.6.0
		 *
		 * @return boolean
		 */
		public function user_can_get_gandhipeacedonation_reports() {
			return current_user_can( 'export_gandhipeacedonation_reports' );
		}
	}

endif;
