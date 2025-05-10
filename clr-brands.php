<?php
/**
 * Plugin Name: CLR Brands
 * Version: 1.0.0
 */

namespace Clr;

defined( 'ABSPATH' ) || exit;

final class ClrBrands {

	private static ?ClrBrands $instance;

	public function __construct() {
		add_action( 'init', array( $this, 'init' ), -1, 1 );
	}

	public function init(): void {
		$this->define_constants();
		$this->autoload_classes();
		$this->setup_entities();

		/** Enqueue styles and scripts */
		$this->enqueue_assets();
	}

	private function define_constants(): void {
		define( 'CLR_VERSION', get_file_data( __FILE__, array( 'version' => 'Version' ) )['version'] );
		define( 'CLR_PATH', dirname( __FILE__ ) );
		define( 'CLR_URL', plugin_dir_url( __FILE__ ) );
	}

	private function setup_entities(): void {
		ClrEntityManager::init();
	}

	private function autoload_classes(): void {
		require __DIR__ . '/vendor/autoload.php';
	}

	private function enqueue_assets(): void {
		add_action( 'admin_enqueue_scripts', array( $this, 'add_admin_assets' ) );
	}

	public function add_admin_assets(): void {
		$screen = get_current_screen();

		if ( $screen->is_block_editor ) {
			wp_enqueue_style( 'clr-editor', CLR_URL . 'assets/css/editor.css', [], CLR_VERSION );
		}

//		wp_enqueue_script( 'script-name', CLR_URL . '/js/example.js', array(), '1.0.0', true );
	}

	public static function get_instance(): ClrBrands {
		if ( empty( self::$instance ) ) {
			self::$instance = new ClrBrands();

			return self::$instance;
		}

		return self::$instance;
	}
}

ClrBrands::get_instance();