<?php
/**
 * Wizard
 *
 * @package Trendy_Storefront_Whizzie
 * @author Catapult Themes
 * @since 1.0.0
 */

class Trendy_Storefront_Whizzie {
	
	protected $version = '1.1.0';
	
	/** @var string Current theme name, used as namespace in actions. */
	protected $trendy_storefront_theme_name = '';
	protected $trendy_storefront_theme_title = '';
	
	/** @var string Wizard page slug and title. */
	protected $trendy_storefront_page_slug = '';
	protected $trendy_storefront_page_title = '';
	
	/** @var array Wizard steps set by user. */
	protected $config_steps = array();
	
	/**
	 * Relative plugin url for this plugin folder
	 * @since 1.0.0
	 * @var string
	 */
	protected $trendy_storefront_plugin_url = '';

	public $trendy_storefront_plugin_path;
	public $parent_slug;
	
	/**
	 * TGMPA instance storage
	 *
	 * @var object
	 */
	protected $tgmpa_instance;
	
	/**
	 * TGMPA Menu slug
	 *
	 * @var string
	 */
	protected $tgmpa_menu_slug = 'tgmpa-install-plugins';
	
	/**
	 * TGMPA Menu url
	 *
	 * @var string
	 */
	protected $tgmpa_url = 'themes.php?page=tgmpa-install-plugins';
	
	/**
	 * Constructor
	 *
	 * @param $config	Our config parameters
	 */
	public function __construct( $config ) {
		$this->set_vars( $config );
		$this->init();
	}
	
	/**
	 * Set some settings
	 * @since 1.0.0
	 * @param $config	Our config parameters
	 */
	public function set_vars( $config ) {
	
		require_once trailingslashit( WHIZZIE_DIR ) . 'tgm/class-tgm-plugin-activation.php';
		require_once trailingslashit( WHIZZIE_DIR ) . 'tgm/tgm.php';

		if( isset( $config['trendy_storefront_page_slug'] ) ) {
			$this->trendy_storefront_page_slug = esc_attr( $config['trendy_storefront_page_slug'] );
		}
		if( isset( $config['trendy_storefront_page_title'] ) ) {
			$this->trendy_storefront_page_title = esc_attr( $config['trendy_storefront_page_title'] );
		}
		if( isset( $config['steps'] ) ) {
			$this->config_steps = $config['steps'];
		}
		
		$this->trendy_storefront_plugin_path = trailingslashit( dirname( __FILE__ ) );
		$relative_url = str_replace( get_template_directory(), '', $this->trendy_storefront_plugin_path );
		$this->trendy_storefront_plugin_url = trailingslashit( get_template_directory_uri() . $relative_url );

		$trendy_storefront_current_theme = wp_get_theme();

		$this->trendy_storefront_theme_title = $trendy_storefront_current_theme->get( 'Name' );
		$this->trendy_storefront_theme_name = strtolower( preg_replace( '#[^a-zA-Z]#', '', $trendy_storefront_current_theme->get( 'Name' ) ) );
		
		$this->trendy_storefront_page_slug = apply_filters( $this->trendy_storefront_theme_name . '_theme_setup_wizard_trendy_storefront_page_slug', $this->trendy_storefront_theme_name . '-wizard' );
		$this->parent_slug = apply_filters( $this->trendy_storefront_theme_name . '_theme_setup_wizard_parent_slug', '' );

	}
	
	/**
	 * Hooks and filters
	 * @since 1.0.0
	 */	
	public function init() {
		
		if ( class_exists( 'TGM_Plugin_Activation' ) && isset( $GLOBALS['tgmpa'] ) ) {
			add_action( 'init', array( $this, 'get_tgmpa_instance' ), 30 );
			add_action( 'init', array( $this, 'set_tgmpa_url' ), 40 );
		}
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		add_action( 'admin_init', array( $this, 'get_plugins' ), 30 );
		add_filter( 'tgmpa_load', array( $this, 'tgmpa_load' ), 10, 1 );
		add_action( 'wp_ajax_setup_plugins', array( $this, 'setup_plugins' ) );
		add_action( 'wp_ajax_trendy_storefront_setup_widgets', array( $this, 'trendy_storefront_setup_widgets' ) );
		
	}
	
	public function enqueue_scripts() {
		wp_enqueue_style( 'trendy-storefront-dashboard-style', get_template_directory_uri() . '/apex-library/dashboard/assets/css/dashboard.css');
		wp_register_script( 'trendy-storefront-dashboard-script', get_template_directory_uri() . '/apex-library/dashboard/assets/js/dashboard.js', array( 'jquery' ), time() );
		wp_localize_script( 
			'trendy-storefront-dashboard-script',
			'whizzie_params',
			array(
				'ajaxurl' 		=> admin_url( 'admin-ajax.php' ),
				'wpnonce' 		=> wp_create_nonce( 'whizzie_nonce' ),
				'verify_text'	=> esc_html( 'verifying', 'trendy-storefront' )
			)
		);
		wp_enqueue_script( 'trendy-storefront-dashboard-script' );
	}
	
	public static function get_instance() {
		if ( ! self::$instance ) {
			self::$instance = new self;
		}
		return self::$instance;
	}
	
	public function tgmpa_load( $status ) {
		return is_admin() || current_user_can( 'install_themes' );
	}
			
	/**
	 * Get configured TGMPA instance
	 *
	 * @access public
	 * @since 1.1.2
	 */
	public function get_tgmpa_instance() {
		$this->tgmpa_instance = call_user_func( array( get_class( $GLOBALS['tgmpa'] ), 'get_instance' ) );
	}
	
	/**
	 * Update $tgmpa_menu_slug and $tgmpa_parent_slug from TGMPA instance
	 *
	 * @access public
	 * @since 1.1.2
	 */
	public function set_tgmpa_url() {
		$this->tgmpa_menu_slug = ( property_exists( $this->tgmpa_instance, 'menu' ) ) ? $this->tgmpa_instance->menu : $this->tgmpa_menu_slug;
		$this->tgmpa_menu_slug = apply_filters( $this->trendy_storefront_theme_name . '_theme_setup_wizard_tgmpa_menu_slug', $this->tgmpa_menu_slug );
		$tgmpa_parent_slug = ( property_exists( $this->tgmpa_instance, 'parent_slug' ) && $this->tgmpa_instance->parent_slug !== 'themes.php' ) ? 'admin.php' : 'themes.php';
		$this->tgmpa_url = apply_filters( $this->trendy_storefront_theme_name . '_theme_setup_wizard_tgmpa_url', $tgmpa_parent_slug . '?page=' . $this->tgmpa_menu_slug );
	}

	/**
	 * Make an interface for the wizard
	 */
	public function wizard_page() { 
		tgmpa_load_bulk_installer();

		if ( ! class_exists( 'TGM_Plugin_Activation' ) || ! isset( $GLOBALS['tgmpa'] ) ) {
			die( esc_html__( 'Failed to find TGM', 'trendy-storefront' ) );
		}

		$url = wp_nonce_url( add_query_arg( array( 'plugins' => 'go' ) ), 'whizzie-setup' );
		$method = '';
		$fields = array_keys( $_POST );

		if ( false === ( $creds = request_filesystem_credentials( esc_url_raw( $url ), $method, false, false, $fields ) ) ) {
			return true;
		}

		if ( ! WP_Filesystem( $creds ) ) {
			request_filesystem_credentials( esc_url_raw( $url ), $method, true, false, $fields );
			return true;
		}

		$trendy_storefront_theme = wp_get_theme();
		$trendy_storefront_theme_title = $trendy_storefront_theme->get( 'Name' );

		?>

		<div class="import-box">
			<div class="whizzie-wrap">
				<div class="demo_content">
					<?php
					$trendy_storefront_steps = $this->get_steps();
					?>
					<ul class="whizzie-nav">
						<?php
						$step_number = 1;	
						foreach ( $trendy_storefront_steps as $trendy_storefront_step ) {
							echo '<li class="nav-step-' . esc_attr( $trendy_storefront_step['id'] ) . '">';
							echo '<span class="step-number">' . esc_html( $step_number ) . '</span>';
							echo '<h6 class="step-title">' . esc_html( $trendy_storefront_step['title'] ) . '</h6>';
							echo '</li>';
							$step_number++;
						}
						?>
						<div class="blank-border"></div>
					</ul>

					<?php
						echo '<ul class="whizzie-menu">';
						foreach ( $trendy_storefront_steps as $trendy_storefront_step ) {
							$class = 'step step-' . esc_attr( $trendy_storefront_step['id'] );
							echo '<li data-step="' . esc_attr( $trendy_storefront_step['id'] ) . '" class="' . esc_attr( $class ) . '">';

							$content = call_user_func( array( $this, $trendy_storefront_step['view'] ) );
							if ( isset( $content['summary'] ) ) {
								printf(
									'<div class="summary">%s</div>',
									wp_kses_post( $content['summary'] )
								);
							}
							if ( isset( $content['detail'] ) ) {
								printf(
									'<div class="detail">%s</div>',
									wp_kses_post( $content['detail'] )
								);
							}
							if ( isset( $trendy_storefront_step['button_text'] ) && $trendy_storefront_step['button_text'] ) {
								printf( 
									'<div class="button-wrap"><a href="#" class="button button-primary btn-gradient do-it" data-callback="%s" data-step="%s">%s</a></div>',
									esc_attr( $trendy_storefront_step['callback'] ),
									esc_attr( $trendy_storefront_step['id'] ),
									esc_html( $trendy_storefront_step['button_text'] )
								);
							}
							echo '</li>';
						}
						echo '</ul>';
					?>

					<div class="step-loading">
						<div class="ts-progress-wrap">
							<div class="ts-progress-bar"></div>
						</div>
						<span class="ts-progress-text">0%</span>
					</div>
				</div>
			</div>
		</div>
		<?php
	}


	/**
	 * Set options for the steps
	 * Incorporate any options set by the theme dev
	 * Return the array for the steps
	 * @return Array
	 */
	public function get_steps() {
		$trendy_storefront_dev_steps = $this->config_steps;
		$trendy_storefront_steps = array( 
			'plugins' => array(
				'id'			=> 'plugins',
				'title'			=> __( 'Install and Activate Recommended Plugins', 'trendy-storefront' ),
				'icon'			=> 'admin-plugins',
				'view'			=> 'get_step_plugins',
				'callback'		=> 'install_plugins',
				'button_text'	=> __( 'Install Recommended Plugins', 'trendy-storefront' ),
				'can_skip'		=> false
			),
			'widgets' => array(
				'id'			=> 'widgets',
				'title'			=> __( 'Begin With Demo Import', 'trendy-storefront' ),
				'icon'			=> 'welcome-widgets-menus',
				'view'			=> 'get_step_widgets',
				'callback'		=> 'trendy_storefront_install_widgets',
				'button_text'	=> __( 'Begin With Demo Import', 'trendy-storefront' ),
				'can_skip'		=> false
			),
			'done' => array(
				'id'			=> 'done',
				'title'			=> __( 'Customize Your Site', 'trendy-storefront' ),
				'icon'			=> 'yes',
				'view'			=> 'get_step_done',
				'callback'		=> ''
			)
		);
		
		// Iterate through each step and replace with dev config values
		if( $trendy_storefront_dev_steps ) {
			// Configurable elements - these are the only ones the dev can update from dashboard-settings.php
			$can_config = array( 'title', 'icon', 'button_text', 'can_skip' );
			foreach( $trendy_storefront_dev_steps as $trendy_storefront_dev_step ) {
				// We can only proceed if an ID exists and matches one of our IDs
				if( isset( $trendy_storefront_dev_step['id'] ) ) {
					$id = $trendy_storefront_dev_step['id'];
					if( isset( $trendy_storefront_steps[$id] ) ) {
						foreach( $can_config as $element ) {
							if( isset( $trendy_storefront_dev_step[$element] ) ) {
								$trendy_storefront_steps[$id][$element] = $trendy_storefront_dev_step[$element];
							}
						}
					}
				}
			}
		}
		return $trendy_storefront_steps;
	}

	/**
	 * Get the content for the plugins step
	 * @return $content Array
	 */
	public function get_step_plugins() {
		$plugins = $this->get_plugins();
		$content = array(); 
		
		// Add plugin name and type at the top
		$content['detail'] = '<div class="plugin-info">';
		$content['detail'] .= '<p><strong>Plugin</strong></p>';
		$content['detail'] .= '<p><strong>Type</strong></p>';
		$content['detail'] .= '</div>';
		
		// The detail element is initially hidden from the user
		$content['detail'] .= '<ul class="whizzie-do-plugins">';
		
		// Add each plugin into a list
		foreach( $plugins['all'] as $slug=>$plugin ) {
				$content['detail'] .= '<li data-slug="' . esc_attr( $slug ) . '">' . esc_html( $plugin['name'] ) . '<span>';
				$keys = array();
				if ( isset( $plugins['install'][ $slug ] ) ) {
					$keys[] = 'Installation';
				}
				if ( isset( $plugins['update'][ $slug ] ) ) {
					$keys[] = 'Update';
				}
				if ( isset( $plugins['activate'][ $slug ] ) ) {
					$keys[] = 'Activation';
				}
				$content['detail'] .= implode( ' and ', $keys ) . ' required';
				$content['detail'] .= '</span></li>';		}
		
		$content['detail'] .= '</ul>';
		
		return $content;
	}
	
	/**
	 * Print the content for the widgets step
	 * @since 1.1.0
	 */
	public function get_step_widgets() { ?> 
		<p class="note">
		    <?php
		    echo esc_html(
		        sprintf(
		            // Translators: %s refers to the theme or plugin name.
		            __( 'If your website is already live and containing data, please make a backup. This importer will override the %s\'s new customizable values.', 'trendy-storefront' ),
		            $this->trendy_storefront_theme_title
		        )
		    );
		    ?>
		</p>

	<?php }
	
	/**
	 * Print the content for the final step
	 */
	public function get_step_done() { ?>
			<h3><?php echo esc_html( 'Demo Import Successful' ); ?></h3>
			<div class="last_step_btns">
				<a target="_blank" href="<?php echo esc_url( get_home_url() ); ?>" class="button button-primary btn-gradient">
					<?php esc_html_e( 'View Site', 'trendy-storefront' ); ?>
				</a>
				<a target="_blank" href="<?php echo esc_url( admin_url( 'customize.php' ) ); ?>" class="button button-primary btn-gradient">
					<?php esc_html_e( 'Customize Site', 'trendy-storefront' ); ?>
				</a>
				<a href="<?php echo esc_url(admin_url()); ?>" class="button button-primary btn-gradient">
					<?php esc_html_e( 'Done', 'trendy-storefront' ); ?>
				</a>
			</div>
	<?php }

	/**
	 * Get the plugins registered with TGMPA
	 */
	public function get_plugins() {
		$instance = call_user_func( array( get_class( $GLOBALS['tgmpa'] ), 'get_instance' ) );
		$plugins = array(
			'all' 		=> array(),
			'install'	=> array(),
			'update'	=> array(),
			'activate'	=> array()
		);
		foreach( $instance->plugins as $slug=>$plugin ) {
			if( $instance->is_plugin_active( $slug ) && false === $instance->does_plugin_have_update( $slug ) ) {
				// Plugin is installed and up to date
				continue;
			} else {
				$plugins['all'][$slug] = $plugin;
				if( ! $instance->is_plugin_installed( $slug ) ) {
					$plugins['install'][$slug] = $plugin;
				} else {
					if( false !== $instance->does_plugin_have_update( $slug ) ) {
						$plugins['update'][$slug] = $plugin;
					}
					if( $instance->can_plugin_activate( $slug ) ) {
						$plugins['activate'][$slug] = $plugin;
					}
				}
			}
		}
		return $plugins;
	}

	/**
	 * Get the widgets.wie file from the /content folder
	 * @return Mixed	Either the file or false
	 * @since 1.1.0
	 */
	public function has_widget_file() {
		if( file_exists( $this->widget_file_url ) ) {
			return true;
		}
		return false;
	}
	
	public function setup_plugins() {
		if ( ! check_ajax_referer( 'whizzie_nonce', 'wpnonce' ) || empty( $_POST['slug'] ) ) {
			wp_send_json_error( array( 'error' => 1, 'message' => esc_html__( 'No Slug Found','trendy-storefront' ) ) );
		}
		$json = array();
		// send back some json we use to hit up TGM
		$plugins = $this->get_plugins();
		
		// what are we doing with this plugin?
		foreach ( $plugins['activate'] as $slug => $plugin ) {
			if ( $_POST['slug'] == $slug ) {
				$json = array(
					'url'           => admin_url( $this->tgmpa_url ),
					'plugin'        => array( $slug ),
					'tgmpa-page'    => $this->tgmpa_menu_slug,
					'plugin_status' => 'all',
					'_wpnonce'      => wp_create_nonce( 'bulk-plugins' ),
					'action'        => 'tgmpa-bulk-activate',
					'action2'       => - 1,
					'message'       => esc_html__( 'Activating Plugin','trendy-storefront' ),
				);
				break;
			}
		}
		foreach ( $plugins['update'] as $slug => $plugin ) {
			if ( $_POST['slug'] == $slug ) {
				$json = array(
					'url'           => admin_url( $this->tgmpa_url ),
					'plugin'        => array( $slug ),
					'tgmpa-page'    => $this->tgmpa_menu_slug,
					'plugin_status' => 'all',
					'_wpnonce'      => wp_create_nonce( 'bulk-plugins' ),
					'action'        => 'tgmpa-bulk-update',
					'action2'       => - 1,
					'message'       => esc_html__( 'Updating Plugin','trendy-storefront' ),
				);
				break;
			}
		}
		foreach ( $plugins['install'] as $slug => $plugin ) {
			if ( $_POST['slug'] == $slug ) {
				$json = array(
					'url'           => admin_url( $this->tgmpa_url ),
					'plugin'        => array( $slug ),
					'tgmpa-page'    => $this->tgmpa_menu_slug,
					'plugin_status' => 'all',
					'_wpnonce'      => wp_create_nonce( 'bulk-plugins' ),
					'action'        => 'tgmpa-bulk-install',
					'action2'       => - 1,
					'message'       => esc_html__( 'Installing Plugin','trendy-storefront' ),
				);
				break;
			}
		}
		if ( $json ) {
			$json['hash'] = md5( serialize( $json ) ); // used for checking if duplicates happen, move to next plugin
			wp_send_json( $json );
		} else {
			wp_send_json( array( 'done' => 1, 'message' => esc_html__( 'Success','trendy-storefront' ) ) );
		}
		exit;
	}


	
	/**
	 * Imports the Demo Content
	 * @since 1.1.0
	 */
	public function trendy_storefront_setup_widgets(){

		require get_theme_file_path( '/apex-library/dashboard/setup.php' ); 
		update_option( 'trendy_storefront_demo_import_completed', 1 );

	    exit;
	}
}