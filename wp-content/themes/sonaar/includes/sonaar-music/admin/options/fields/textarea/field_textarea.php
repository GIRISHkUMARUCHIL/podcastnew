<?php
class Redux_Options_textarea {

    /**
     * Field Constructor.
     *
     * Required - must call the parent constructor, then assign field and value to vars, and obviously call the render field function
     *
     * @since Redux_Options 1.0.0
    */
     protected $field;
 public $value;
 protected $args;
    
function __construct($field = array(), $value ='', $parent = array() ) {
        $this->field = $field;
		$this->value = $value;
		$this->args = $parent->args;
    }

    /**
     * Field Render Function.
     *
     * Takes the vars and outputs the HTML for the field in the settings
     *
     * @since Redux_Options 1.0.0
    */
    function render() {
        $name = $this->args['opt_name'] . '[' . $this->field['id'] . ']';
        $id = $this->field['id'];
        $class = (isset($this->field['class'])) ? $this->field['class'] : 'large-text';
        $placeholder = (isset($this->field['placeholder'])) ? ' placeholder="' . esc_attr($this->field['placeholder']) . '" ' : '';
        $rows = (isset($this->field['rows'])) ? $this->field['rows'] : 6;
        ?>

        <textarea name="<?php echo $name; ?>" id="<?php echo $id; ?>" <?php echo $placeholder; ?> class="<?php echo $class; ?>" rows="<?php echo $rows; ?>"><?php echo esc_attr($this->value); ?></textarea>

        <?php if( isset( $this->field['desc'] ) && $this->field['desc'] != '') : ?>
            <br/><span class="description"><?php echo $this->field['desc']; ?></span>
        <?php endif; ?>

        <?php
    }
}