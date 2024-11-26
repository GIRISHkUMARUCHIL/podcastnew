<script type='text/javascript'>
  jQuery(document).on('ready widget-added widget-updated', function(event, widget) {

    jQuery('.my-color-picker').not('[id*="__i__"]').wpColorPicker({
      change: function(e, ui) {
        jQuery(e.target).val(ui.color.toString());
        jQuery(e.target).trigger('change'); // enable widget "Save" button
      },
    });
  });
</script>

<p>
  <label for="<?php echo $this->get_field_id( 'band_name' ); ?>">
    <?php _e( 'Type your Band Name:' ); ?>
  </label>
  <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'band_name' ); ?>" name="<?php echo $this->get_field_name( 'band_name' ); ?>" value="<?php echo esc_attr( $instance['band_name'] ); ?>" />
</p>
<p>
  <label for="<?php echo $this->get_field_id( 'text_color' ); ?>">
    <?php _e( 'Text Color:' ); ?>
  </label>
  <input class="my-color-picker" type="text" id="<?php echo $this->get_field_id( 'text_color' ); ?>" name="<?php echo $this->get_field_name( 'text_color' ); ?>" value="<?php echo esc_attr( $instance['text_color'] ); ?>" />
</p>
<p>
  <label for="<?php echo $this->get_field_id( 'background_color' ); ?>">
    <?php _e( 'Background Color:' ); ?>
  </label>
  <input class="my-color-picker" type="text" id="<?php echo $this->get_field_id( 'background_color' ); ?>" name="<?php echo $this->get_field_name( 'background_color' ); ?>" value="<?php echo esc_attr( $instance['background_color'] ); ?>" />
</p>
<p>
  <label for="<?php echo $this->get_field_id( 'button_color' ); ?>">
    <?php _e( 'Button and Link Color:' ); ?>
  </label>
  <input class="my-color-picker" type="text" id="<?php echo $this->get_field_id( 'button_color' ); ?>" name="<?php echo $this->get_field_name( 'button_color' ); ?>" value="<?php echo esc_attr( $instance['button_color'] ); ?>" />
</p>
<p>
  <label for="<?php echo $this->get_field_id( 'button_txt_color' ); ?>">
    <?php _e( 'Link Text Color:' ); ?>
  </label>
  <input class="my-color-picker" type="text" id="<?php echo $this->get_field_id( 'button_txt_color' ); ?>" name="<?php echo $this->get_field_name( 'button_txt_color' ); ?>" value="<?php echo esc_attr( $instance['button_txt_color'] ); ?>" />
</p>
<p>
  <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('local_dates'); ?>" name="<?php echo $this->get_field_name('local_dates'); ?>" <?php echo checked( (bool)$instance['local_dates'] ); ?> />
  <label for="<?php echo $this->get_field_id( 'local_dates' ); ?>">
    <?php _e( 'Display Local Dates' ); ?>
  </label>
</p>
<p>
  <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('past_dates'); ?>" name="<?php echo $this->get_field_name('past_dates'); ?>" <?php echo checked( (bool)$instance['past_dates'] ); ?> />
  <label for="<?php echo $this->get_field_id( 'past_dates' ); ?>">
    <?php _e( 'Display Past Dates' ); ?>
  </label>
</p>
<p>
  <label for="<?php echo $this->get_field_id( 'display_limit' ); ?>">
    <?php _e( 'Display events' ); ?>
  </label>
  <select class="widefat" id="<?php echo $this->get_field_id('display_limit'); ?>" name="<?php echo $this->get_field_name('display_limit'); ?>">
    <option value="5" <?php echo ($instance['display_limit'] ==  '5'  ) ? ' selected="selected"' : '' ?>>5</option>
    <option value="10"<?php echo ($instance['display_limit'] == '10' ) ? ' selected="selected"' : '' ?>>10</option>
    <option value="15"<?php echo ($instance['display_limit'] == '15' ) ? ' selected="selected"' : '' ?>>15</option>
    <option value="20"<?php echo ($instance['display_limit'] == '20' ) ? ' selected="selected"' : '' ?>>20</option>
    <option value="25"<?php echo ($instance['display_limit'] == '25' ) ? ' selected="selected"' : '' ?>>25</option>
    <option value="30"<?php echo ($instance['display_limit'] == '30' ) ? ' selected="selected"' : '' ?>>30</option>
    <option value="35"<?php echo ($instance['display_limit'] == '35' ) ? ' selected="selected"' : '' ?>>35</option>
    <option value="40"<?php echo ($instance['display_limit'] == '40' ) ? ' selected="selected"' : '' ?>>40</option>
    <option value="45"<?php echo ($instance['display_limit'] == '45' ) ? ' selected="selected"' : '' ?>>45</option>
    <option value="50"<?php echo ($instance['display_limit'] == '50' ) ? ' selected="selected"' : '' ?>>50</option>
    <option value=""  <?php echo ($instance['display_limit'] == '') ? ' selected="selected"' : '' ?>>All Dates</option>
  </select>
</p>