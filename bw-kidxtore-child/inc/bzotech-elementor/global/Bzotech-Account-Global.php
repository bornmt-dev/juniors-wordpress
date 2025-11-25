<?php
namespace Elementor;
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
/**
 * Elementor Account manager
 *
 * Elementor widget for Account manager
 *
 * @since 1.0.0
 */
class Bzotech_Account_Global extends Widget_Base {

	/**
	 * Retrieve the widget name.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'bzotech-account-global';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Account manager (Global)', 'bw-kidxtore' );
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-person';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * Note that currently Elementor supports only one category.
	 * When multiple categories passed, Elementor uses the first one.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'aqb-htelement-category' ];
	}

	/**
	 * Retrieve the list of scripts the widget depended on.
	 *
	 * Used to set scripts dependencies required to run the widget.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget scripts dependencies.
	 */
	public function get_script_depends() {
		return [ 'hello-world' ];
	}
	public function get_style_depends() {
		return [ 'bzotech-el-account' ];
	}
	public function get_roles() {
		global $wp_roles;
        $roles = array();
        if(isset($wp_roles->roles)){
            $roles_data = $wp_roles->roles;
            if(is_array($roles_data)){
                foreach ($roles_data as $key => $value) {
                    $roles[$key] = $value['name'];
                }
            }
        }
        return $roles;
	}

	public function login_form($redirect_to = '') {
		if(empty($redirect_to)) $redirect_to =  apply_filters( 'login_redirect',home_url('/'));
        echo '<input type="hidden" name="popup-form-account-ajax-nonce" class="popup-form-account-ajax-nonce" value="' . wp_create_nonce( 'popup-form-account-ajax-nonce' ) . '" />';
        ?>
        <div class="elbzotech-login-form popup-form active">
            <div class="form-header">
                <h2><?php esc_html_e( 'Sign into your Junior\'s account','bw-kidxtore' ); ?></h2>
                
                <div class="message ms-done ms-default"><?php esc_html_e( 'Registration complete. Please check your email.','bw-kidxtore' ); ?></div>
            </div>
            <form name="loginform" id="loginform" action="<?php echo esc_url( home_url( 'wp-login.php', 'login_post' ) ); ?>" method="post">
                <?php do_action( 'woocommerce_login_form_start' ); ?>
                <div class="form-field">
                    <input placeholder="<?php esc_attr_e( 'Username or Email Address','bw-kidxtore' ); ?>" type="text" name="log" id="user_login" class="input" size="20" autocomplete="off"/>
                </div>
                <div class="form-field password-input">
                	<input placeholder="<?php esc_attr_e( 'Password','bw-kidxtore' ); ?>" type="password" name="pwd" id="user_pass" class="input" value="" size="20" autocomplete="off"/>
                	
                </div>
                <div class="extra-field">
                    <?php 
                        if(class_exists("woocommerce")) do_action( 'woocommerce_login_form' );
                        else do_action( 'login_form' );
                    ?>
                </div>
                
                <div class="submit">
                    <input type="submit" name="wp-submit" class="elbzotech-bt-default elbzotech-bt-full" value="<?php esc_attr_e('Sign In','bw-kidxtore'); ?>" />
                    <input type="hidden" name="redirect_to1" value="<?php echo esc_attr($redirect_to); ?>" />
                </div>
                <div class="nav-form flex-wrapper justify_content-space-between align_items-center">
                	<div class="forgetmenot">
	                    <input name="rememberme" type="checkbox" id="remembermep" value="forever" />
	                    <label class="rememberme" for="remembermep"><?php esc_html_e( 'Remember Me','bw-kidxtore' ); ?></label>
	                </div>
	                <div class="registerform-lost-pass">
		                <?php if ( get_option( 'users_can_register' ) ) :
		                    echo '<p class="register-text">No account yet? </p><a href="#registerform" class="popup-redirect register-link">'.esc_html__("Register",'bw-kidxtore').'</a>';
		                endif;
		                //echo '<a href="#lostpasswordform" class="popup-redirect lostpass-link">'.esc_html__("Lost your password?",'bw-kidxtore').'</a>';
		                ?>
		            </div>
	            </div>
                
                <?php 
                
                echo '<div class="nextend-social-login"><h3 class="title20 font-medium text-center"><span>'.esc_html__('Or log in with your Lava Rewards account','bw-kidxtore').'</span></h3>';
				// if (class_exists('NextendSocialLogin')) {
				// 	echo do_shortcode('[nextend_social_login login="1" link="1" unlink="1"]');
				// }				
                echo do_shortcode('[loyale-sso-button route="/my-account/" label="Loyale"]');
                echo'</div>';
           
                	
			do_action( 'woocommerce_login_form_end' ); ?>
            </form>
            
        </div>
        <?php 
	}

	public function register_form($redirect_to = '') {
		if (empty($redirect_to)) {
			$redirect_to = apply_filters('registration_redirect', wc_get_page_permalink('myaccount'));
		}
	
		echo '<input type="hidden" name="popup-form-account-ajax-nonce" class="popup-form-account-ajax-nonce" value="' . esc_attr(wp_create_nonce('popup-form-account-ajax-nonce')) . '" />';
		?>
		<div class="elbzotech-register-form popup-form">
			<div class="form-header">
				<h2><?php esc_html_e('Create an account', 'bw-kidxtore'); ?></h2>
				<div class="message register_error ms-error ms-default" style="display: none;"></div>
			</div>
	
			 
			<form id="registerform" method="post" class="woocommerce-form woocommerce-form-register register">

				<?php do_action( 'woocommerce_register_form_start' ); ?>

				<?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>

					<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
						<input type="text" placeholder="<?php esc_attr_e( 'Username*', 'bw-kidxtore' ); ?>" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="reg_username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
					</p>
 
				<?php endif; ?>
 
				<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide form-field">
					<input type="email" placeholder="<?php esc_attr_e( 'Email address*', 'bw-kidxtore' ); ?>" class="woocommerce-Input woocommerce-Input--text input-text input" name="email" id="reg_email" autocomplete="email" value="<?php echo ( ! empty( $_POST['email'] ) ) ? esc_attr( wp_unslash( $_POST['email'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
				</p>

				<?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>

					<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
						<input type="password" placeholder="<?php esc_attr_e( 'Password*', 'bw-kidxtore' ); ?>" class="woocommerce-Input woocommerce-Input--text input-text" name="password" id="reg_password" autocomplete="new-password" />
					</p>

				<?php else : ?>

					<p><?php esc_html_e( 'A password will be sent to your email address.', 'bw-kidxtore' ); ?></p>

				<?php endif; ?>

				<?php do_action( 'woocommerce_register_form' ); ?>

				<p class="form-row form-row-wide"><label for="newsletter_consent"><input type="checkbox" id="newsletter_consent" name="newsletter_consent" value="1"> Yes, I’d like to receive marketing communications including promotions and exclusive offers.</label></p>
				<!-- <p class="form-row form-row-wide"><label for="marketing_emails_consent"><input type="checkbox" id="marketing_emails_consent" name="marketing_emails_consent" value="1"> I agree to receive marketing emails in accordance with the <a target="_blank" href="/privacy-policy/">Privacy Policy</a>. -->
					</label>
				</p>

				<p class="woocommerce-FormRow form-row">
					<?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
					<button type="submit" class="woocommerce-Button button myacc-bt-register" name="register" value="<?php esc_attr_e( 'Register', 'bw-kidxtore' ); ?>"><?php esc_html_e( 'Register', 'bw-kidxtore' ); ?></button>
				</p>

				<?php do_action( 'woocommerce_register_form_end' ); ?>

			</form>
 
	
			<div class="nav-form">
				<a href="#loginform" class="popup-redirect login-link"><?php esc_html_e('Log in', 'bw-kidxtore'); ?></a>
				<a href="#lostpasswordform" class="popup-redirect lostpass-link"><?php esc_html_e('Lost your password?', 'bw-kidxtore'); ?></a>
			</div>
		</div>
		<?php
	}
	

	
	public function lostpass_form($redirect_to = '') {
		if(empty($redirect_to)) $redirect_to =  apply_filters( 'login_redirect',home_url('/'));
		echo '<input type="hidden" name="popup-form-account-ajax-nonce" class="popup-form-account-ajax-nonce" value="' . wp_create_nonce( 'popup-form-account-ajax-nonce' ) . '" />';
        ?>
        <div class="elbzotech-lostpass-form popup-form">
            <div class="form-header">
                <h2><?php esc_html_e( 'Reset password','bw-kidxtore' ); ?></h2>
                <div class="message ms-default ms-done"><?php esc_html_e( 'Password reset email has been sent.','bw-kidxtore' ); ?></div>
                <div class="message login_error ms-error ms-default"><?php esc_html_e( 'The email could not be sent. Possible reason: your host may have disabled the mail function.','bw-kidxtore' ); ?></div>
            </div>


			<?php		
			do_action( 'woocommerce_before_lost_password_form' );
			?>

			<form method="post" class="woocommerce-ResetPassword lost_reset_password" id="lostpasswordform" >

				<p><?php echo apply_filters( 'woocommerce_lost_password_message', esc_html__( 'Lost your password? Please enter your username or email address. You will receive a link to create a new password via email.', 'woocommerce' ) ); ?></p><?php // @codingStandardsIgnoreLine ?>

				<p class="woocommerce-form-row woocommerce-form-row--first form-row form-row-first form-field">
					<input class="woocommerce-Input woocommerce-Input--text input-text input" type="text" name="user_login" id="user_login" autocomplete="username" required aria-required="true" placeholder="Email Address" />
				</p>

				<div class="clear"></div>

				<?php do_action( 'woocommerce_lostpassword_form' ); ?>

				<p class="woocommerce-form-row form-row">
					<input type="hidden" name="wc_reset_password" value="true" />
					<button type="submit" class="woocommerce-Button button<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>" value="<?php esc_attr_e( 'Reset password', 'woocommerce' ); ?>"><?php esc_html_e( 'Reset password', 'woocommerce' ); ?></button>
				</p>

				<?php wp_nonce_field( 'lost_password', 'woocommerce-lost-password-nonce' ); ?>

			</form>
			<?php
			do_action( 'woocommerce_after_lost_password_form' );
			?>

            <div class="nav-form">
                <a href="#loginform" class="popup-redirect login-link"><?php esc_html_e('Log in','bw-kidxtore') ?></a>
                <?php
                if ( get_option( 'users_can_register' ) ) :
                    echo '<a href="#registerform" class="popup-redirect register-link">'.esc_html__("Register",'bw-kidxtore').'</a>';
                endif;
                ?>
            </div>
        </div>
        <?php
	}

	/**
	 * Register the widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function register_controls() {
		$this->start_controls_section(
			'section_style',
			[
				'label' => esc_html__( 'Style', 'bw-kidxtore' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'style',
			[
				'label' 	=> esc_html__( 'Style', 'bw-kidxtore' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'default',
				'options'   => [
					'default'		=> esc_html__( 'Style 1 (Default)', 'bw-kidxtore' ),
					'style2'		=> esc_html__( 'Style 2', 'bw-kidxtore' ),
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_button',
			[
				'label' => esc_html__( 'Button', 'bw-kidxtore' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'icon',
			[
				'label' => esc_html__( 'Icon', 'bw-kidxtore' ),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-user',
					'library' => 'solid',
				],
			]
		);

		$this->add_control(
			'icon_logged',
			[
				'label' => esc_html__( 'Icon logged', 'bw-kidxtore' ),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-user',
					'library' => 'solid',
				],
			]
		);

		$this->add_responsive_control(
			'align_icon',
			[
				'label' => esc_html__( 'Alignment', 'bw-kidxtore' ),
				'type' => Controls_Manager::CHOOSE,
				'default'	=> '',
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'bw-kidxtore' ),
						'icon' => 'eicon-text-align-left',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'bw-kidxtore' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}}' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'account_bttext',
			[
				'label' => esc_html__( 'Add text', 'bw-kidxtore' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Type your text to add search button', 'bw-kidxtore' ),
			]
		);

		$this->add_control(
			'account_bttext_pos',
			[
				'label' => esc_html__( 'Text position', 'bw-kidxtore' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'after-icon',
				'options' => [
					'after-icon'   => esc_html__( 'After icon', 'bw-kidxtore' ),
					'before-icon'  => esc_html__( 'Before icon', 'bw-kidxtore' ),
				],
				'condition' => [
					'account_bttext!' => '',
					'icon[value]!' => '',
				]
			]
		);
		$this->add_control(
			'account_bt_class_css',
			[
				'label' => esc_html__( 'Add class CSS', 'bw-kidxtore' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_links',
			[
				'label' => esc_html__( 'Sub links dropdown', 'bw-kidxtore' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
		
		$repeater_text = new Repeater();
		$repeater_text->add_control(
			'icon',
			[
				'label' => esc_html__( 'Icon', 'bw-kidxtore' ),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-user',
					'library' => 'solid',
				],
			]
		);
		$repeater_text->add_control(
			'text', 
			[
				'label' => esc_html__( 'Text', 'bw-kidxtore' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Enter text' , 'bw-kidxtore' ),
				'label_block' => true,
			]
		);
		$repeater_text->add_control(
			'link',
			[
				'label' => esc_html__( 'Link', 'bw-kidxtore' ),
				'type' => Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://your-link.com', 'bw-kidxtore' ),
				'show_external' => true,
				'default' => [
					'url' => '',
					'is_external' => false,
					'nofollow' => false,
				],
			]
		);

		$repeater_text->add_control(
			'roles',
			[
				'label' => esc_html__( 'Show with roles', 'bw-kidxtore' ),
				'description' => esc_html__( 'Choose roles to show. Default is show with all roles', 'bw-kidxtore' ),
				'type' => Controls_Manager::SELECT2,
				'multiple' => true,
				'options' => $this->get_roles(),
				'default' => [],
			]
		);

		$this->add_control(
			'list_links',
			[
				'label' => esc_html__( 'Add links', 'bw-kidxtore' ),
				'type' => Controls_Manager::REPEATER,
				'prevent_empty'=>false,
				'fields' => $repeater_text->get_controls(),
				'title_field' => '{{{ text }}}',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_icon',
			[
				'label' => esc_html__( 'Button', 'bw-kidxtore' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'alignment',
			[
				'label' => esc_html__( 'Justify Content', 'bw-kidxtore' ),
				'type' => Controls_Manager::CHOOSE,
				'responsive' => true,
				'label_block' => true,
				'options' => [
					'flex-start' => [
						'title' => esc_html_x( 'Start', 'Flex Container Control', 'bw-kidxtore' ),
						'icon' => 'eicon-flex eicon-justify-start-h',
					],
					'center' => [
						'title' => esc_html_x( 'Center', 'Flex Container Control', 'bw-kidxtore' ),
						'icon' => 'eicon-flex eicon-justify-center-h',
					],
					'flex-end' => [
						'title' => esc_html_x( 'End', 'Flex Container Control', 'bw-kidxtore' ),
						'icon' => 'eicon-flex eicon-justify-end-h',
					],
					'space-between' => [
						'title' => esc_html_x( 'Space Between', 'Flex Container Control', 'bw-kidxtore' ),
						'icon' => 'eicon-flex eicon-justify-space-between-h',
					],
					'space-around' => [
						'title' => esc_html_x( 'Space Around', 'Flex Container Control', 'bw-kidxtore' ),
						'icon' => 'eicon-flex eicon-justify-space-around-h',
					],
					'space-evenly' => [
						'title' => esc_html_x( 'Space Evenly', 'Flex Container Control', 'bw-kidxtore' ),
						'icon' => 'eicon-flex eicon-justify-space-evenly-h',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .button-account-e' => 'justify-content: {{VALUE}};',
				],
				'default' => '',
			]
		);
		$this->add_responsive_control(
			'align_items',
			[
				'label' => esc_html__( 'Align Items', 'bw-kidxtore' ),
				'type' => Controls_Manager::CHOOSE,
				'responsive' => true,
				'options' => [
					'flex-start' => [
						'title' => esc_html_x( 'Start', 'Flex Container Control', 'bw-kidxtore' ),
						'icon' => 'eicon-flex eicon-align-start-v',
					],
					'center' => [
						'title' => esc_html_x( 'Center', 'Flex Container Control', 'bw-kidxtore' ),
						'icon' => 'eicon-flex eicon-align-center-v',
					],
					'flex-end' => [
						'title' => esc_html_x( 'End', 'Flex Container Control', 'bw-kidxtore' ),
						'icon' => 'eicon-flex eicon-align-end-v',
					],
					'stretch' => [
						'title' => esc_html_x( 'Stretch', 'Flex Container Control', 'bw-kidxtore' ),
						'icon' => 'eicon-flex eicon-align-stretch-v',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .button-account-e' => 'align-items: {{VALUE}};',
				],
				'default' => '',
			]
		);
		$this->add_responsive_control(
			'width_icon',
			[
				'label' => esc_html__( 'Width', 'bw-kidxtore' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' , '%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .button-account-e' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'height_icon',
			[
				'label' => esc_html__( 'Height', 'bw-kidxtore' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .button-account-e' => 'line-height: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'size_icon',
			[
				'label' => esc_html__( 'Size icon', 'bw-kidxtore' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .button-account-e i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs( 'icon_account_effects' );

		$this->start_controls_tab( 'icon_account_normal',
			[
				'label' => esc_html__( 'Normal', 'bw-kidxtore' ),
			]
		);

		$this->add_control(
			'color_icon',
			[
				'label' => esc_html__( 'Icon Color', 'bw-kidxtore' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .button-account-e i' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'color_text',
			[
				'label' => esc_html__( 'Text Color', 'bw-kidxtore' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .button-account-e span' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'account_text_button_typography',
				'label' => esc_html__( 'Typography button text', 'bw-kidxtore' ),
				'selector' => '{{WRAPPER}} .button-account-e span',
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'background_icon',
				'label' => esc_html__( 'Background', 'bw-kidxtore' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .button-account-e',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'shadow_icon',
				'exclude' => [
					'box_shadow_position',
				],
				'selector' => '{{WRAPPER}} .button-account-e',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'border_icon',
				'selector' => '{{WRAPPER}} .button-account-e',
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'border_icon',
			[
				'label' => esc_html__( 'Border Radius', 'bw-kidxtore' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .button-account-e' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab( 'icon_account_hover',
			[
				'label' => esc_html__( 'Hover', 'bw-kidxtore' ),
			]
		);

		$this->add_control(
			'color_icon_hover',
			[
				'label' => esc_html__( 'Icon Color', 'bw-kidxtore' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .button-account-e:hover i' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'color_text_hover',
			[
				'label' => esc_html__( 'Text Color', 'bw-kidxtore' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .button-account-e:hover span' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'account_text_button_typography:hover',
				'label' => esc_html__( 'Typography button text', 'bw-kidxtore' ),
				'selector' => '{{WRAPPER}} .button-account-e:hover span',
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'background_icon_hover',
				'label' => esc_html__( 'Background', 'bw-kidxtore' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .button-account-e:hover',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'shadow_icon_hover',
				'exclude' => [
					'box_shadow_position',
				],
				'selector' => '{{WRAPPER}} .button-account-e:hover',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'border_icon_hover',
				'selector' => '{{WRAPPER}} .button-account-e:hover',
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'border_icon_hover',
			[
				'label' => esc_html__( 'Border Radius', 'bw-kidxtore' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .button-account-e:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();	

		$this->add_control(
			'separator_icon_popup',
			[
				'type' => Controls_Manager::DIVIDER,
				'style' => 'thick',
			]
		);

		$this->add_responsive_control(
			'padding_btn_account',
			[
				'label' => esc_html__( 'Padding', 'bw-kidxtore' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .button-account-e' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'padding_btn_account_icon',
			[
				'label' => esc_html__( 'Padding icon', 'bw-kidxtore' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .button-account-e i,{{WRAPPER}} .button-account-e img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'margin_icon',
			[
				'label' => esc_html__( 'Margin', 'bw-kidxtore' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .button-account-e' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_links',
			[
				'label' => esc_html__( 'Links', 'bw-kidxtore' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'width_links',
			[
				'label' => esc_html__( 'Width', 'bw-kidxtore' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' , '%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elbzotech-dropdown-list' => 'width: {{SIZE}}{{UNIT}};max-width: inherit;',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'shadow_links',
				'exclude' => [
					'box_shadow_position',
				],
				'selector' => '{{WRAPPER}} .elbzotech-dropdown-list',
			]
		);

		$this->add_responsive_control(
			'space_links',
			[
				'label' => esc_html__( 'Space', 'bw-kidxtore' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' , '%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elbzotech-dropdown-list li' => 'line-height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Render the widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings();
		$name ='';

        $account_id = get_option('woocommerce_myaccount_page_id');
        if(empty($login_url)){
	        if($account_id) $login_url = get_permalink( $account_id );
	        else $login_url = wp_login_url();
	    }

		if(is_user_logged_in()){
			$current_user = wp_get_current_user();
	        if(!empty($current_user)){
	            $name = $current_user->data->display_name;
	        }
			$title_account = sprintf(wp_kses_post(__( 'Hello %s','bw-kidxtore' )), $name);
			$html_a = '<a title="'.esc_attr($title_account).'" class="button-account-manager button-account-e '.$settings['account_bt_class_css'].'" href="'.esc_url($login_url).'">';

		}else{
			$title_account = $settings['account_bttext'];
			$html_a = '<a title="'.esc_html__('My account','bw-kidxtore').'" class="button-account-manager button-account-e '.$settings['account_bt_class_css'].'" href="#">';
		}
		?>
		<div class="elbzotech-account-manager-global js-account-popup elbzotech-dropdown-box <?php echo 'elbzotech-account-global-'.esc_attr($settings['style'])?>">
			
			<?php echo  apply_filters('bzotech_output_content',$html_a); ?>
				<?php if($title_account && $settings['account_bttext_pos'] == 'before-icon' && $settings['account_bttext']) echo '<span class="title-account">'.$title_account.'</span>'?>
				<?php 
				$icon_stt = '';
				if(is_user_logged_in()) $icon_stt = '_logged';
				if(!empty($settings['icon'.$icon_stt]['value'])){
					Icons_Manager::render_icon( $settings['icon'.$icon_stt], [ 'aria-hidden' => 'true' ] ); 
				}
				
				?>
				<?php if($title_account && $settings['account_bttext_pos'] == 'after-icon' && $settings['account_bttext']) echo '<span class="title-account">'.$title_account.'</span>'?>
			</a>


			<?php if(is_user_logged_in()): ?>
				<?php if(!empty($settings['list_links'])){ ?>
					<ul class="elbzotech-dropdown-list">
				    	<?php 
				    	foreach (  $settings['list_links'] as $item ) {
							$target = $item['link']['is_external'] ? ' target="_blank"' : '';
							$nofollow = $item['link']['nofollow'] ? ' rel="nofollow"' : '';
							echo '<li><a href="'.$item['link']['url'].'"'.$target.$nofollow.' class="elementor-repeater-item-'.$item['_id'].'">';
							Icons_Manager::render_icon( $item['icon'], [ 'aria-hidden' => 'true' ] );
							echo apply_filters('bzotech_output_content',$item['text']);
							echo '</a></li>';
						}
				    	?>
				    </ul>
				<?php } ?>
				
			  <?php else:?>
			  	<div class="login-popup-content-wrap elbzotech-popup-overlay">
			  		
	                <div class="elbzotech-login-popup-content bzotech-scrollbar">
	                	<i class="la la-close elbzotech-close-popup"></i>
	                    <?php
	                    $this->login_form();
	                    $this->register_form();
	                    $this->lostpass_form();
	                    ?>
	                </div>
	                <div class="popup-overlay"></div>
	            </div>
			<?php endif;?>
		</div>
		<?php
	}

	/**
	 * Render the widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function content_template() {
		
	}
}
