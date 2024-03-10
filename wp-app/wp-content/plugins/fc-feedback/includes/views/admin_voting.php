<div class="fc-voting-results">
    <div class="fc-chart">
        <div class="fc-bar" style="width: <?php echo  esc_attr($data['yes'])  ?>;"><?php echo  esc_attr($data['yes'])  ?></div>
        <div class="fc-label"><?php echo esc_html__('Yes', 'fc'); ?></div>
    </div>

    <div class="fc-chart">
        <div class="fc-bar" style="width: <?php echo  esc_attr($data['no'])  ?>;"><?php echo  esc_attr($data['no'])  ?></div>
        <div class="fc-label"><?php echo esc_html__('No', 'fc'); ?></div>
    </div>
</div>
