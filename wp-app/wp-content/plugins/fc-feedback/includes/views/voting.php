<?php
$post_id = get_the_ID();
$encoded_id = base64_encode($post_id);
$user_ip = $_SERVER['REMOTE_ADDR'];
$user_has_voted = get_post_meta($post_id, 'fc_feedback_voted_' . $user_ip , true);

if($user_has_voted){
    $hide_class = '';
    $fc_vote = '';
}else{
    $hide_class = 'fc-hide';
    $fc_vote = 'fc-vote';
}

if($user_has_voted === 'positive'){
    $yes_class = 'fc-active';
    $no_class = '';
}elseif($user_has_voted === 'negative'){
    $yes_class = '';
    $no_class = 'fc-active';
}else{
    $yes_class = '';
    $no_class = '';
}
//As this is same instance include file.
$data = $this->get_vote_count_by_postid($post_id);

?>
<div class="fc-feedback-form">
    <div class="fc-row">
        <div class="fc-content">
            <?php echo esc_html__( 'WAS THIS ARTICLE HELPFUL?', 'fc' ); ?>
        </div>
        <div class="fc-buttons fc-target-btns">
            <div class="button <?php  echo esc_attr($fc_vote) .' '.  esc_attr($yes_class) ?>" data-vote-type="positive" data-post-id="<?php echo esc_attr($encoded_id); ?>">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                    <path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM164.1 325.5C182 346.2 212.6 368 256 368s74-21.8 91.9-42.5c5.8-6.7 15.9-7.4 22.6-1.6s7.4 15.9 1.6 22.6C349.8 372.1 311.1 400 256 400s-93.8-27.9-116.1-53.5c-5.8-6.7-5.1-16.8 1.6-22.6s16.8-5.1 22.6 1.6zM144.4 208a32 32 0 1 1 64 0 32 32 0 1 1 -64 0zm192-32a32 32 0 1 1 0 64 32 32 0 1 1 0-64z"/>
                </svg>
                <p><?php echo esc_html__( 'Yes', 'fc' ); ?></p>
            </div>
            <div class="button  <?php echo esc_attr($fc_vote) .' '. esc_attr($no_class) ?>" data-vote-type="negative" data-post-id="<?php echo esc_attr($encoded_id); ?>">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                    <path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM176.4 176a32 32 0 1 1 0 64 32 32 0 1 1 0-64zm128 32a32 32 0 1 1 64 0 32 32 0 1 1 -64 0zM160 336H352c8.8 0 16 7.2 16 16s-7.2 16-16 16H160c-8.8 0-16-7.2-16-16s7.2-16 16-16z"/>
                </svg>
                <p><?php echo esc_html__( 'No', 'fc' ); ?></p>
            </div>
        </div>
        <div class="fc-loading-line fc-hide">Loading...</div>
    </div>
    <div class="fc-row <?php echo esc_attr($hide_class) ?>">
        <div class="fc-content">
            <?php echo esc_html__( 'THANK YOU FOR YOUR FEEDBACK', 'fc' ); ?>        </div>
        <div class="fc-buttons">
            <div class="button fc-answer-yes <?php echo esc_attr($yes_class) ?>">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                    <path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM164.1 325.5C182 346.2 212.6 368 256 368s74-21.8 91.9-42.5c5.8-6.7 15.9-7.4 22.6-1.6s7.4 15.9 1.6 22.6C349.8 372.1 311.1 400 256 400s-93.8-27.9-116.1-53.5c-5.8-6.7-5.1-16.8 1.6-22.6s16.8-5.1 22.6 1.6zM144.4 208a32 32 0 1 1 64 0 32 32 0 1 1 -64 0zm192-32a32 32 0 1 1 0 64 32 32 0 1 1 0-64z"/>
                </svg>
                <p id="fc-yes"><?php echo esc_html($data['yes']); ?></p>
            </div>
            <div class="button fc-answer-no <?php echo esc_attr($no_class) ?>">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                    <path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM176.4 176a32 32 0 1 1 0 64 32 32 0 1 1 0-64zm128 32a32 32 0 1 1 64 0 32 32 0 1 1 -64 0zM160 336H352c8.8 0 16 7.2 16 16s-7.2 16-16 16H160c-8.8 0-16-7.2-16-16s7.2-16 16-16z"/>
                </svg>
                <p id="fc-no"><?php echo esc_html($data['no']); ?></p>
            </div>
        </div>
    </div>
</div>
