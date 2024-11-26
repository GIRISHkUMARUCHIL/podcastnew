<p>
    <label for="<?php echo esc_attr($this->get_field_id('albums')); ?>"><?php _ex('Album:', 'Widget', IRON_MUSIC_TEXT_DOMAIN); ?></label>
    <select class="widefat" id="<?php echo esc_attr($this->get_field_id('albums')); ?>" name="<?php echo esc_attr($this->get_field_name('albums')); ?>[]" multiple="multiple">
    <?php foreach($all_albums as $a): ?>
    	<option value="<?php echo esc_attr($a->ID); ?>"<?php echo (in_array($a->ID, $albums) ? ' selected="selected"' : ''); ?>><?php echo esc_html($a->post_title); ?></option>
    <?php endforeach; ?>
    </select>
</p>
<p>
    <label for="<?php echo esc_attr($this->get_field_id( 'artists_filter' )); ?>"><?php esc_html_e('Filter By Artists:', IRON_MUSIC_TEXT_DOMAIN); ?></label>
    <select multiple class="widefat" id="<?php echo esc_attr($this->get_field_id('artists_filter')); ?>" name="<?php echo esc_attr($this->get_field_name('artists_filter')); ?>[]">
    	<?php echo $this->get_object_options($artists_filter, 'artist'); ?>
    </select>
</p>
<p>
    <label for="<?php echo esc_attr($this->get_field_id( 'artists_filter' )); ?>"><?php esc_html_e('Filter By Artists:', IRON_MUSIC_TEXT_DOMAIN); ?></label>
    <select multiple class="widefat" id="<?php echo esc_attr($this->get_field_id('artists_filter')); ?>" name="<?php echo esc_attr($this->get_field_name('artists_filter')); ?>[]">
    	<?php echo $this->get_object_options($artists_filter, 'artist'); ?>
    </select>
</p>
