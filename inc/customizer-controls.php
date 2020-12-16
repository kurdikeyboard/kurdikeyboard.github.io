<?php
class Glow_Group_Settings_Heading_Control extends WP_Customize_Control {
	public $settings = 'blogname';
	public $description = '';
	public $title = '';
	public $group = '';
	public $type = '';
	/**
	 * Render the description and title for the sections
	 */
	public function render_content() {
		switch ( $this->type ) {
			default:
			case 'group_heading_top':
				echo '<h4 class="customizer-group-heading group-heading-top">' . $this->title . '</h4>';
				if ( $this->description != '' ) {
					echo '<p class="customizer-group-subheading">' . $this->description . '</p>';
				}
				break;
			case 'group_heading':
				echo '<h4 class="customizer-group-heading">' . $this->title . '</h4>';
				if ( $this->description != '' ) {
					echo '<p class="customizer-group-subheading">' . $this->description . '</p>';
				}
				break;
			case 'group_heading_message':
				echo '<h4 class="customizer-group-heading-message">' . $this->title . '</h4>';
				if ( $this->description != '' ) {
					echo '<p class="customizer-group-heading-message">' . $this->description . '</p>';
				}
				break;
			case 'hr' :
				echo '<hr />';
				break;
		}
	}
}