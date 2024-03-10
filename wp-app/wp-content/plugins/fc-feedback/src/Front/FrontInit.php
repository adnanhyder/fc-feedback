<?php
/**
 * Admin Init.
 *
 * @package FC-Feedback
 */

namespace FCFeedback\Front;

defined( 'ABSPATH' ) || exit;

/**
 * Front Init class.
 */
class FrontInit {

	/**
	 * The single instance of the class.
	 *
	 * @var FrontInit|null $instance.
	 * @since 1.0.0
	 */
	protected static $instance = null;

	/**
	 * Constructor.
	 *
	 * @since 1.0.0
	 */
	protected function __construct() {
        $this->hooks();

	}

    /**
     * Get the options slug.
     *
     * @since 1.0.0
     */
    public function hooks() {

        add_action( 'wp_ajax_fc_submit_vote', array( $this, 'submit_vote' ) );
        add_action( 'wp_ajax_nopriv_fc_submit_vote', array( $this, 'submit_vote' ) );

        add_action( 'the_content', array( $this, 'display_voting_feature' ) );

    }

	/**
	 * Display voting Html.
	 *
	 * @since 1.0.0
	 * @return string.
	 */
	public function display_voting_feature($content) {

        if (is_singular('post')) {
            ob_start();
            include trailingslashit( FC_INCLUDES_DIR ) . trailingslashit( 'views' ) .'voting.php';
            $voting_html = ob_get_clean();

            $voting_html = apply_filters('fc_feedback_form', $voting_html);

            $content .= $voting_html;
        }

        return $content;
	}

    /**
     * Display submit vote.
     *
     * @since 1.0.0
     * @return void.
     */
    public function submit_vote() {
        check_ajax_referer('fc_nonce', 'security');
        $post_id = fc_sanitize_thing($_POST['post_id']);
        $vote_type = fc_sanitize_thing($_POST['vote_type']);
        $user_ip = $_SERVER['REMOTE_ADDR'];

        $voted = get_post_meta($post_id, 'fc_voted_' . $user_ip, true);
        print_r($post_id);
        print_r($user_ip);
        print_r($vote_type);
        print_r($voted);

        wp_send_json_success(1);
    }

	/**
	 * FrontInit Instance.
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @return FrontInit instance.
     * @since 1.0.0
	 */
	public static function instance(): FrontInit
    {

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
}
