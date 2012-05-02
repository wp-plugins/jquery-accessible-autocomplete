<?php
/*
Plugin Name: JQuery Accessible Autocomplete
Plugin URI: http://wordpress.org/extend/plugins/jquery-accessible-autocomplete/
Description: WAI-ARIA Enabled Autocomplete Plugin for Wordpress
Author: Kontotasiou Dionysia
Version: 3.0
Author URI: http://www.iti.gr/iti/people/Dionisia_Kontotasiou.html
*/

add_action("plugins_loaded", "JQueryAccessibleAutocomplete_init");
function JQueryAccessibleAutocomplete_init() {
    register_sidebar_widget(__('JQuery Accessible Autocomplete'), 'widget_JQueryAccessibleAutocomplete');
    register_widget_control(   'JQuery Accessible Autocomplete', 'JQueryAccessibleAutocomplete_control', 200, 200 );
    if ( !is_admin() && is_active_widget('widget_JQueryAccessibleAutocomplete') ) {
        wp_register_style('jquery.ui.all', ( get_bloginfo('wpurl') . '/wp-content/plugins/jquery-accessible-autocomplete/lib/jquery-ui/themes/base/jquery.ui.all.css'));
        wp_enqueue_style('jquery.ui.all');

        wp_deregister_script('jquery');

        // add your own script
        wp_register_script('jquery-1.6.4', ( get_bloginfo('wpurl') . '/wp-content/plugins/jquery-accessible-autocomplete/lib/jquery-ui/jquery-1.6.4.js'));
        wp_enqueue_script('jquery-1.6.4');

        wp_register_script('jquery.ui.core.js', ( get_bloginfo('wpurl') . '/wp-content/plugins/jquery-accessible-autocomplete/lib/jquery-ui/ui/jquery.ui.core.js'));
        wp_enqueue_script('jquery.ui.core.js');

        wp_register_script('jquery.ui.widget', ( get_bloginfo('wpurl') . '/wp-content/plugins/jquery-accessible-autocomplete/lib/jquery-ui/ui/jquery.ui.widget.js'));
        wp_enqueue_script('jquery.ui.widget');

        wp_register_script('jquery.ui.position', ( get_bloginfo('wpurl') . '/wp-content/plugins/jquery-accessible-autocomplete/lib/jquery-ui/ui/jquery.ui.position.js'));
        wp_enqueue_script('jquery.ui.position');

        wp_register_script('jquery.ui.menu', ( get_bloginfo('wpurl') . '/wp-content/plugins/jquery-accessible-autocomplete/lib/jquery-ui/ui/jquery.ui.menu.js'));
        wp_enqueue_script('jquery.ui.menu');

        wp_register_script('jquery.ui.autocomplete', ( get_bloginfo('wpurl') . '/wp-content/plugins/jquery-accessible-autocomplete/lib/jquery-ui/ui/jquery.ui.autocomplete.js'));
        wp_enqueue_script('jquery.ui.autocomplete');

        wp_register_style('demos', ( get_bloginfo('wpurl') . '/wp-content/plugins/jquery-accessible-autocomplete/lib/jquery-ui/demos.css'));
        wp_enqueue_style('demos');

        wp_register_style('demo', ( get_bloginfo('wpurl') . '/wp-content/plugins/jquery-accessible-autocomplete/lib/demo.css'));
        wp_enqueue_style('demo');

        wp_register_script('JQueryAccessibleAutocomplete', ( get_bloginfo('wpurl') . '/wp-content/plugins/jquery-accessible-autocomplete/lib/JQueryAccessibleAutocomplete.js'));
        wp_enqueue_script('JQueryAccessibleAutocomplete');
    }
}

function widget_JQueryAccessibleAutocomplete($args) {
    extract($args);

    $options = get_option("widget_JQueryAccessibleAutocomplete");
    if (!is_array( $options )) {
        $options = array(
            'title' => 'JQuery Accessible Autocomplete'
        );
    }

    echo $before_widget;
    echo $before_title;
    echo $options['title'];
    echo $after_title;

    //Our Widget Content
    JQueryAccessibleAutocompleteContent();
    echo $after_widget;
}

function JQueryAccessibleAutocompleteContent() {
    // $recentPosts = get_recent_posts();
    // $recentComments = get_recent_comments();
    // $archives = get_my_archives();

    $options = get_option("widget_JQueryAccessibleAutocomplete");
    if (!is_array( $options )) {
        $options = array(
            'title' => 'JQuery Accessible Autocomplete'
        );
    }

    echo '<form action="" id="searchform" method="get" role="search">
		<div class="widget_search ui-widget">
			<label for="searchformJQueryAccessibleAutocomplete" class="screen-reader-text">Search for:</label>
			<input type="text" id="searchformJQueryAccessibleAutocomplete" name="s" value="">
			<input type="submit" value="Search" id="searchsubmit">
		</div>
	</form>
';
}

function JQueryAccessibleAutocomplete_control() {
    $options = get_option("widget_JQueryAccessibleAutocomplete");
    if (!is_array( $options )) {
        $options = array(
            'title' => 'JQuery Accessible Autocomplete'
        );
    }

    if ($_POST['JQueryAccessibleAutocomplete-SubmitTitle']) {
        $options['title'] = htmlspecialchars($_POST['JQueryAccessibleAutocomplete-WidgetTitle']);
        update_option("widget_JQueryAccessibleAutocomplete", $options);
    }
    ?>
    <p>
        <label for="JQueryAccessibleAutocomplete-WidgetTitle">Widget Title: </label>
        <input type="text" id="JQueryAccessibleAutocomplete-WidgetTitle" name="JQueryAccessibleAutocomplete-WidgetTitle" value="<?php echo $options['title'];?>" />
        <input type="hidden" id="JQueryAccessibleAutocomplete-SubmitTitle" name="JQueryAccessibleAutocomplete-SubmitTitle" value="1" />
    </p>
    
    <?php
}

?>
