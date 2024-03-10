<?php
/**
 * Admin Init.
 * Php version 8.0.0
 *
 * @category Plugin
 * @package  FC-Feedback
 * @author   Adnan Hyder Pervez <12345adnan@gmail.com>
 * @license  GNU General Public License v3.0
 * @link     #
 */

namespace FCFeedback\Admin;

use FCFeedback\Front\FrontInit;

defined('ABSPATH') || exit;

/**
 * Class Admin Init.
 * Php version 8.0.0
 *
 * @category Plugin
 * @package  FC-Feedback
 * @author   Adnan Hyder Pervez <12345adnan@gmail.com>
 * @license  GNU General Public License v3.0
 * @link     #
 */
class AdminInit
{

    /**
     * The single instance of the class.
     *
     * @var   AdminInit|null $instance.
     * @since 1.0.0
     */
    protected static $instance = null;

    /**
     * Constructor.
     *
     * @since 1.0.0
     */
    protected function __construct()
    {
        $this->hooks();

    }

    /**
     * Hooks Loaded.
     *
     * @since  1.0.0
     * @return void
     */
    public function hooks()
    {
        add_action('add_meta_boxes', array( $this, 'fc_feedback_meta_box' ), 10);

    }

    /**
     * Registering Meta box.
     *
     * @since  1.0.0
     * @return void.
     */
    public function fc_feedback_meta_box()
    {
        add_meta_box(
            'fc_feedback_meta_box',
            __('Voting Results', 'fc'),
            array($this, 'fc_feedback_meta_box_content'),
            'post',
            'side',
            'default'
        );

    }

    /**
     * Meta box Content to Display.
     *
     * @param $post object
     *
     * @since 1.0.0
     *
     * @return string Html
     */
    public function fc_feedback_meta_box_content($post)
    {
        $data = FrontInit::instance()->get_vote_count_by_postid($post->ID);
        ob_start();
        include trailingslashit(FC_INCLUDES_DIR) . trailingslashit('views') .'admin_voting.php';
        $voting_html = ob_get_clean();
        $voting_html = apply_filters('fc_feedback_results', $voting_html);
        echo $voting_html;
    }


    /**
     * AdminInit Instance.
     * Ensures only one instance of the class is loaded or can be loaded.
     *
     * @return AdminInit instance.
     * @since  1.0.0
     */
    public static function instance(): AdminInit
    {

        if (is_null(self::$instance) ) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * Cloning is forbidden.
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function __clone()
    {
        // Override this PHP function to prevent unwanted copies of your instance.
        // Implement your own error or use `wc_doing_it_wrong().
    }

    /**
     * Unserializing instances of this class is forbidden.
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function __wakeup()
    {
        // Override this PHP function to prevent unwanted copies of your instance.
        // Implement your own error or use `wc_doing_it_wrong().
    }
}
