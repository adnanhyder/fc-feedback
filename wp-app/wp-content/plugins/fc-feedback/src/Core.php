<?php
/**
 * FCFeedback Core.
 *
 * @package FC-Feedback
 */

namespace FCFeedback;


use FCFeedback\Admin\AdminInit;
use FCFeedback\Front\FrontInit;

defined( 'ABSPATH' ) || exit;

/**
 * FCFeedback Core class.
 */
class Core {

	/**
	 * The single instance of the class.
	 *
	 * @since 1.0.0
	 * @var null|Core The single instance of the class.
	 */
	protected static $instance = null;

	/**
	 * URL to plugin directory.
	 *
	 * @since 1.0.0
	 * @var string The URL to plugin directory without trailing slash.
	 */
	protected string $plugin_url;

	/**
	 * URL to plugin assets directory.
	 *
	 * @since 1.0.0
	 * @var string The URL to plugin assets directory without trailing slash.
	 */
	protected string $assets_url;

	/**
	 * Path to plugin directory.
	 *
	 * @since 1.0.0
	 * @var string The path to plugin directory without trailing slash.
	 */
	protected string $plugin_path;

	/**
	 * Plugin Slug.
	 *
	 * @since 1.0.0
	 * @var string The plugin slug.
	 */
	protected string $plugin_slug;

	/**
	 * The version of the plugin.
	 *
	 * @since 1.0.0
	 * @var string The version of the plugin.
	 */
	protected string $plugin_version = '1.0.0';
	/**
	 * The single instance of the class.
	 *
	 * @since 1.0.0
	 */
	protected function __construct() {

		$plugin_url       = plugin_dir_url( __DIR__ );
		$this->plugin_url = rtrim( $plugin_url, '/\\' );

		$this->assets_url  = $this->plugin_url . '/assets';
		$this->plugin_path = rtrim( plugin_dir_path( __DIR__ ), '/\\' );
		$this->plugin_slug = 'fc-feedback';


		$this->includes();
		$this->hooks();
        $this->frontend_loader();

		if ( is_admin() ) {
			$this->admin_loader();
		}
	}

	/**
	 * Init hooks.
	 *
	 * @since 1.0.0
	 */
	public function hooks() {

		add_action( 'wp_enqueue_scripts', array( $this, 'frontend_enqueue' ) );

		if ( is_admin() ) {
			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_scripts' ) );
		}
	}


	/**
	 * Main FCFeedback Instance.
	 * Ensures only one instance of FCFeedback is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 * @return Core Main instance.
	 */
	public static function instance(): Core {

		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Cloning is forbidden.
	 *
	 * @since 1.0.0
	 */
	public function __clone() {
		// Override this PHP function to prevent unwanted copies of your instance.
		// Implement your own error or use `wc_doing_it_wrong().
	}

	/**
	 * Unserializing instances of this class is forbidden.
	 *
	 * @since 1.0.0
	 */
	public function __wakeup() {
		// Override this PHP function to prevent unwanted copies of your instance.
		// Implement your own error or use `wc_doing_it_wrong().
	}

	/**
	 * Include the required files.
	 *
	 * @since 1.0.0
	 */
	private function includes() {

		require_once trailingslashit( FC_INCLUDES_DIR ) . 'functions.php';
	}

	/**
	 * Initializing the FrontInit Class.
	 *
	 * @return AdminInit Returns the AdminInit class object.
	 *@since 1.0.0
	 */
	public function admin_loader(): AdminInit
    {

		static $fc_admin_init;

		if ( ! isset( $fc_admin_init ) ) {
			$fc_admin_init = AdminInit::instance();
		}

		return $fc_admin_init;
	}

    /**
     * Initializing the Frontend Class.
     *
     * @return FrontInit Returns the Frontend class object.
     *@since 1.0.0
     */
    public function frontend_loader(): FrontInit
    {

        static $fc_front_init;

        if ( ! isset( $fc_front_init ) ) {
            $fc_front_init = FrontInit::instance();
        }

        return $fc_front_init;
    }

	/**
	 * Enqueue the frontend scripts.
	 *
	 * @since 1.0.0
	 */
	public function frontend_enqueue() {

		wp_enqueue_style( 'fc-frontend', trailingslashit( $this->get_assets_url() ) . 'css/frontend' . self::get_assets_min() . '.css', array(), self::get_assets_version() );
		wp_enqueue_script( 'fc-frontend', trailingslashit( $this->get_assets_url() ) . 'js/frontend' . self::get_assets_min() . '.js', array( 'jquery' ), self::get_assets_version(), true );

		wp_localize_script(
			'fc-frontend',
			'fcFeedback',
			array(
				'ajaxurl' => admin_url( 'admin-ajax.php' ),
                'fc_nonce' => wp_create_nonce('fc_nonce')
            )
		);

	}

	/**
	 * Enqueue the admin scripts.
	 *
	 * @since 1.0.0
	 */
	public function enqueue_admin_scripts() {

		wp_enqueue_style( 'fc-admin', trailingslashit( $this->get_assets_url() ) . 'css/admin' . self::get_assets_min() . '.css', array(), self::get_assets_version() );
		wp_enqueue_script( 'fc-admin', trailingslashit( $this->get_assets_url() ) . 'js/admin' . self::get_assets_min() . '.js', array( 'jquery' ), self::get_assets_version(), true );

		wp_localize_script(
			'fc-admin',
			'fcFeedback_admin',
			array(
				'ajaxurl' => admin_url( 'admin-ajax.php' ),
			)
		);

	}

	/**
	 * Get the plugin assets url.
	 *
	 * @since 1.0.0
	 * @return string The plugin assets URL.
	 */
	public function get_assets_url(): string {

		return $this->assets_url;
	}

	/**
	 * Get the plugin assets min.
	 *
	 * @since 1.0.0
	 * @return string The plugin assets min.
	 */
	public static function get_assets_min(): string {

		if ( defined( 'WP_DEBUG' ) && WP_DEBUG === true ) {
			return '';
		}

		return '.min';
	}

	/**
	 * Get the plugin assets version.
	 * If the WP DEBUG is true then sends the time stamp. So, we will get the latest version of the files.
	 * Else send the current plugin version.
	 *
	 * @since 1.0.0
	 * @return string The plugin asset version.
	 */
	public function get_assets_version(): string {

		if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
			return time();
		}

		return $this->get_version();
	}

	/**
	 * Get the plugin version.
	 *
	 * @since 1.0.0
	 * @return string The plugin version.
	 */
	public function get_version(): string {

		return $this->plugin_version;
	}

}
