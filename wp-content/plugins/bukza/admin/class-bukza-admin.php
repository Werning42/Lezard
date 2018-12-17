<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://bukza.com
 * @since      2.0.0
 *
 * @package    Bukza
 * @subpackage Bukza/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and hooks.
 *
 * @package    Bukza
 * @subpackage Bukza/admin
 * @author     Bukza <support@bukza.com>
 */
class Bukza_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    2.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    2.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since 2.00
	 * @param string $plugin_name The name of this plugin.
	 * @param string $version The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version     = $version;

	}

	/**
	 * Adds scripts for the admin area.
	 *
	 * @since    2.0.0
	 * @param string $hook The name of the page.
	 */
	public function enqueue_scripts( $hook ) {

		if ( 'toplevel_page_bukza' !== $hook ) {
			return;
		}

		// Styles.
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/bukza-admin.css', array(), $this->version, 'all' );

		// Scripts.
		wp_register_script( 'bukza-admin', plugin_dir_url( __FILE__ ) . 'js/bukza-admin.js', array(), $this->version, true );

		wp_localize_script(
			'bukza-admin',
			'wpData',
			array(
				'rest_url'  => untrailingslashit( esc_url_raw( rest_url() ) ),
				'nonce'     => wp_create_nonce( 'wp_rest' ),
			)
		);

		wp_enqueue_script( 'bukza-admin' );

	}

	/**
	 * Adds options page.
	 *
	 * @since    2.0.0
	 */
	public function add_menu_item() {

		add_menu_page( 'Bukza', 'Bukza', 'manage_options', 'bukza', 'Bukza_Admin::menu_page', 'data:image/svg+xml;base64,PCFET0NUWVBFIHN2ZyBQVUJMSUMgIi0vL1czQy8vRFREIFNWRyAyMDAxMDkwNC8vRU4iICJodHRwOi8vd3d3LnczLm9yZy9UUi8yMDAxL1JFQy1TVkctMjAwMTA5MDQvRFREL3N2ZzEwLmR0ZCI+PHN2ZyB2ZXJzaW9uPSIxLjAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgd2lkdGg9IjcwNHB4IiBoZWlnaHQ9IjcwNHB4IiB2aWV3Qm94PSIwIDAgNzA0MCA3MDQwIiBwcmVzZXJ2ZUFzcGVjdFJhdGlvPSJ4TWlkWU1pZCBtZWV0Ij48ZyBpZD0ibGF5ZXIxMDEiIGZpbGw9IiNhZWFlYWUiIHN0cm9rZT0ibm9uZSI+IDxwYXRoIGQ9Ik0zMTQzIDcwMjQgYy02NzMgLTczIC0xMjk3IC0zMzEgLTE4MzEgLTc1NiAtMTU2IC0xMjUgLTQxOCAtMzg2IC01MzUgLTUzMyAtNDE3IC01MjUgLTY1OCAtMTA4OSAtNzU0IC0xNzYwIC0yNiAtMTg0IC0yNiAtNzM0IDAgLTkxMCA4NSAtNTc5IDI1NyAtMTAzNSA1NjMgLTE0OTUgMTMyIC0xOTkgMjQ3IC0zNDIgNDA4IC01MDcgNTgyIC02MDAgMTM3NSAtOTc4IDIyMDMgLTEwNTIgMTU2IC0xNCA0OTAgLTE0IDY0NiAwIDgyOCA3NCAxNjIxIDQ1MiAyMjAzIDEwNTIgNDczIDQ4NyA3OTggMTEwMSA5MjggMTc1MiA1NSAyNzcgNjEgMzQ3IDYxIDcwMCAwIDI2OCAtMyAzNTQgLTE4IDQ2MCAtOTYgNjcxIC0zMzcgMTIzNSAtNzU0IDE3NjAgLTExNyAxNDcgLTM3OSA0MDggLTUzNSA1MzMgLTUzOSA0MjkgLTExNjEgNjg1IC0xODQzIDc1NyAtMTczIDE4IC01NzIgMTggLTc0MiAtMXogbTY3MiAtNDg1IGM2MzAgLTU1IDEyNjkgLTMzOSAxNzQ2IC03NzYgNTU5IC01MTQgODk3IC0xMTgyIDk3OSAtMTkzOCAxNCAtMTI5IDE0IC00ODEgMCAtNjEwIC05NiAtODg4IC01NTEgLTE2NjMgLTEyODIgLTIxODEgLTQxMiAtMjkzIC05MjYgLTQ4MyAtMTQ0MyAtNTM0IC0xMzcgLTE0IC00NTkgLTE0IC01ODUgLTEgLTUyIDYgLTEwNCAxMSAtMTE1IDExIC0xMSAwIC0yNiA0IC0zMyA5IC0xMCA2IDE5NSAzODcgODQ4IDE1NzUgNDc0IDg2MiA4NTkgMTU3MCA4NTYgMTU3MyAtMyA0IC0yODQgLTI4IC02MjQgLTcwIC0zMzkgLTQzIC02MjIgLTc3IC02MjkgLTc3IC02IDAgMjM2IDQ1OSA1MzggMTAyMSAzMDMgNTYxIDU1MyAxMDI4IDU1NiAxMDM3IDMgOSAtNjQzIC02MzEgLTE0MzYgLTE0MjMgLTEwMzggLTEwMzcgLTE0MzYgLTE0NDEgLTE0MjMgLTE0NDMgMTEgLTIgMzI4IDMxIDcwNiA3MyAzNzggNDMgNjkwIDc1IDY5MiA3MiAzIC0zIC0yODAgLTQzMyAtNjI5IC05NTYgbC02MzQgLTk1MSAtMTA0IDczIGMtMjk1IDIwNiAtNTQ5IDQ1NSAtNzQ4IDczNSAtMzA4IDQzMyAtNDkwIDkxNCAtNTUxIDE0NTcgLTE0IDEyOCAtMTQgNDgwIDAgNjEwIDk2IDg4OSA1NTEgMTY2MiAxMjgyIDIxODEgNDE2IDI5NSA5NDQgNDg5IDE0NDkgNTM0IDIyNiAxOSAzNDcgMTkgNTg0IC0xeiIvPiA8cGF0aCBkPSJNMTY3MiA1NTgwIGMtNDggLTMwIC03MiAtNzUgLTcyIC0xNDAgMCAtMTAwIDYwIC0xNjAgMTYwIC0xNjAgMTAwIDAgMTYwIDYwIDE2MCAxNjAgMCAxMDAgLTYwIDE2MCAtMTYwIDE2MCAtMzcgMCAtNjYgLTYgLTg4IC0yMHoiLz4gPHBhdGggZD0iTTIzMTIgNTU4MCBjLTQ4IC0zMCAtNzIgLTc1IC03MiAtMTQwIDAgLTEwMCA2MCAtMTYwIDE2MCAtMTYwIDEwMCAwIDE2MCA2MCAxNjAgMTYwIDAgMTAwIC02MCAxNjAgLTE2MCAxNjAgLTM3IDAgLTY2IC02IC04OCAtMjB6Ii8+IDxwYXRoIGQ9Ik0yOTUyIDU1ODAgYy00OCAtMzAgLTcyIC03NSAtNzIgLTE0MCAwIC0xMDAgNjAgLTE2MCAxNjAgLTE2MCA2NSAwIDExMCAyNCAxNDAgNzIgMTQgMjIgMjAgNTEgMjAgODggMCAxMDAgLTYwIDE2MCAtMTYwIDE2MCAtMzcgMCAtNjYgLTYgLTg4IC0yMHoiLz4gPHBhdGggZD0iTTM1OTIgNTU4MCBjLTQ4IC0zMCAtNzIgLTc1IC03MiAtMTQwIDAgLTEwMCA2MCAtMTYwIDE2MCAtMTYwIDY1IDAgMTEwIDI0IDE0MCA3MiAxNCAyMiAyMCA1MSAyMCA4OCAwIDEwMCAtNjAgMTYwIC0xNjAgMTYwIC0zNyAwIC02NiAtNiAtODggLTIweiIvPiA8cGF0aCBkPSJNNTE5MiA1NTgwIGMtNDggLTMwIC03MiAtNzUgLTcyIC0xNDAgMCAtNjUgMjQgLTExMCA3MiAtMTQwIDIyIC0xNCA1MSAtMjAgODggLTIwIDY1IDAgMTEwIDI0IDE0MCA3MiAxNCAyMiAyMCA1MSAyMCA4OCAwIDM3IC02IDY2IC0yMCA4OCAtMzAgNDggLTc1IDcyIC0xNDAgNzIgLTM3IDAgLTY2IC02IC04OCAtMjB6Ii8+IDwvZz48L3N2Zz4=' );

	}

	/**
	 * Adds menu page.
	 *
	 * @since    2.0.0
	 */
	public static function menu_page() {

		$culture = 'en';

		if ( 'ru_RU' === get_locale() ) {
			$culture = 'ru';
		}

		$site_title = get_bloginfo( 'name' );

		if ( ! isset( $site_title ) || trim( $site_title ) === '' ) {
			$site_title = 'WordPress';
		}

		$ticks = number_format( microtime( true ) * 10000000, 0, '.', '' );

		$hash = '';

		$secret = get_option( 'bukza_secret' );

		if ( false !== $secret ) {
			$hash = md5( $secret . $ticks );
		}

		$bukza_url = 'https://public.bukza.com/api/wp/app?culture=' . $culture . '&userId=' . get_option( 'bukza_id' ) . '&wordPressSite=' . $site_title . '&ticks=' . $ticks . '&hash=' . $hash;
		include plugin_dir_path( __FILE__ ) . 'partials/bukza-admin-display.php';

	}

	/**
	 * Resgisters routes.
	 *
	 * @since    2.0.0
	 */
	public function init_rest() {

		require_once plugin_dir_path( __FILE__ ) . 'class-bukza-rest.php';
		register_rest_route(
			'bukza/v1',
			'/update',
			array(
				'methods'             => 'POST',
				'callback'            => 'Bukza_Rest::update',
				'permission_callback' => 'Bukza_Rest::permissions_check',
			)
		);

	}
}
