<?php

/* Parent class for all admin menu classes */

if(!defined('ABSPATH')){
    exit;//Exit if accessed directly
}

abstract class AIOWPSecurity_Admin_Menu
{
    /**
	 * Get valid current tab slug.
	 *
	 * @return string current valid tab slug or empty string
	 */
	protected function get_current_tab() {
        if (is_array($this->menu_tabs) && !empty($this->menu_tabs)) {
            $tab_keys = array_keys($this->menu_tabs);
            if (empty($_GET['tab'])) {
                return $tab_keys[0];
            } else {
                $current_tab = sanitize_text_field($_GET['tab']);
                return in_array($current_tab, $tab_keys) ? $current_tab : $tab_keys[0];
            }
        } else {
            return '';
        }
	}

    /**
     * Shows postbox for settings menu
     *
     * @param string $id css ID for postbox
     * @param string $title title of the postbox section
     * @param string $content the content of the postbox
     **/
    function postbox_toggle($id, $title, $content) 
    {
        //Always send string with translation markers in it
        ?>
        <div id="<?php echo $id; ?>" class="postbox">
            <div class="handlediv" title="<?php echo __('Press to toggle'); ?>"><br /></div>
            <h3 class="hndle"><span><?php echo $title; ?></span></h3>
            <div class="inside">
            <?php echo $content; ?>
            </div>
        </div>
        <?php
    }
    
    function postbox($title, $content) 
    {
        //Always send string with translation markers in it
        ?>
        <div class="postbox">
        <h3 class="hndle"><label for="title"><?php echo $title; ?></label></h3>
        <div class="inside">
            <?php echo $content; ?>
        </div>
        </div>
        <?php
    } 
    
    function show_msg_settings_updated()
    {
        echo '<div id="message" class="updated fade"><p><strong>';
        _e('Settings successfully updated.','all-in-one-wp-security-and-firewall');
        echo '</strong></p></div>';
    }

	/**
	 * Renders record(s) successfully deleted message at top of page.
	 *
	 * @return Void
	 */
	public static function show_msg_record_deleted_st() {
		AIOWPSecurity_Admin_Menu::show_msg_updated_st(__('Successfully deleted the selected record(s).', 'all-in-one-wp-security-and-firewall'));
	}

	/**
	 * Renders record(s) unsuccessfully deleted message at top of page.
	 *
	 * @return Void
	 */
	public static function show_msg_record_not_deleted_st() {
		AIOWPSecurity_Admin_Menu::show_msg_error_st(__('Failed to delete the selected record(s).', 'all-in-one-wp-security-and-firewall'));
	}

    function show_msg_updated($msg)
    {
        echo '<div id="message" class="updated fade"><p><strong>';
        echo $msg;
        echo '</strong></p></div>';
    }
    
    static function show_msg_updated_st($msg)
    {
        echo '<div id="message" class="updated fade"><p><strong>';
        echo wp_kses_post($msg);
        echo '</strong></p></div>';
    }
    
    function show_msg_error($error_msg)
    {
        echo '<div id="message" class="error"><p><strong>';
        echo wp_kses_post($error_msg);
        echo '</strong></p></div>';
    }
    
    static function show_msg_error_st($error_msg)
    {
        echo '<div id="message" class="error"><p><strong>';
        echo wp_kses_post($error_msg);
        echo '</strong></p></div>';
    }
    
    function start_buffer()
    {
        ob_start();
    }
    
    function end_buffer_and_collect()
    {
        $output = ob_get_contents();
        ob_end_clean();
        return $output;
    }

}
