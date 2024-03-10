<?php
/**
 * Front Init.
 * Php version 8.0.0
 *
 * @category Plugin
 * @package  FC-Feedback
 * @author   Adnan Hyder Pervez <12345adnan@gmail.com>
 * @license  GNU General Public License v3.0
 * @link     #
 */

namespace FCFeedback\Front;

defined('ABSPATH') || exit;

/**
 * Front Init class.
 * Php version 8.0.0
 *
 * @category Plugin
 * @package  FC-Feedback
 * @author   Adnan Hyder Pervez <12345adnan@gmail.com>
 * @license  GNU General Public License v3.0
 * @link     #
 */
class FrontInit
{

    /**
     * The single instance of the class.
     *
     * @var   FrontInit|null $instance.
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
     * @since 1.0.0
     *
     * @return void
     */
    public function hooks()
    {

        add_action('wp_ajax_fc_submit_vote', array( $this, 'submit_vote' ));
        add_action('wp_ajax_nopriv_fc_submit_vote', array( $this, 'submit_vote' ));

        add_action('the_content', array( $this, 'display_voting_feature' ));

    }

    /**
     * Display voting Html.
     *
     * @param $content string
     *
     * @since  1.0.0
     * @return string.
     */
    public function display_voting_feature($content)
    {

        if (is_singular('post')) {
            ob_start();
            include trailingslashit(FC_INCLUDES_DIR) . trailingslashit('views') .'voting.php';
            $voting_html = ob_get_clean();

            $voting_html = apply_filters('fc_feedback_form', $voting_html);

            $content .= $voting_html;
        }

        return $content;
    }

    /**
     * Display submit vote.
     *
     * @since  1.0.0
     * @return void.
     */
    public function submit_vote()
    {
        check_ajax_referer('fc_nonce', 'security');

        $decoded_string = base64_decode($_POST['post_id']);
        $post_id = fc_sanitize_thing($decoded_string);
        $vote_type = fc_sanitize_thing($_POST['vote_type']);
        $user_ip = $_SERVER['REMOTE_ADDR'];
        if ($vote_type === 'positive') {
            $user_answer = 1;
        } else {
            $user_answer = 0;
        }

        if (post_exists($post_id)) {
            wp_send_json_error('Invalid post ID.');
        }
        $user_has_voted = get_post_meta(
            $post_id,
            'fc_feedback_voted_' . $user_ip,
            true
        );

        if ($user_has_voted) {
            wp_send_json_error('You have already voted on this post.');
        }

        $current_count = (int)get_post_meta($post_id, 'fc_feedback_' . $vote_type, true);

        update_post_meta($post_id, 'fc_feedback_' . $vote_type, $current_count + 1);
        update_post_meta($post_id, 'fc_feedback_voted_' . $user_ip, $vote_type);

        $data = $this->get_vote_count_by_postid($post_id);
        wp_send_json_success(
            array(
                'result' => 1,
                'yes' => $data['yes'],
                'no' => $data['no'],
                'total' => $data['total'],
                'user_answer' => $user_answer,
            )
        );

    }

    /**
     * FrontInit Instance.
     * Ensures only one instance of the class is loaded or can be loaded.
     *
     * @return FrontInit instance.
     * @since  1.0.0
     */
    public static function instance(): FrontInit
    {

        if (is_null(self::$instance) ) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * Function get_vote_count_by_postid ().
     * yes and no percenetage string with keys
     *
     * @param $post_id int
     *
     * @return array .
     *
     * @since 1.0.0
     */
    public function get_vote_count_by_postid($post_id)
    {
        $yes_count = (int)get_post_meta($post_id, 'fc_feedback_positive', true);
        $no_count = (int)get_post_meta($post_id, 'fc_feedback_negative', true);
        $total_count = $yes_count + $no_count;

        $yes_percentage = ($total_count > 0) ? round(($yes_count / $total_count) * 100) : 0;
        $no_percentage = 0;
        if ($total_count != 0) {
            $no_percentage = 100 - $yes_percentage;
        }
        return array(
            'yes' => $yes_percentage . '%',
            'no' => $no_percentage . '%',
            'total' => $total_count,
        );
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
