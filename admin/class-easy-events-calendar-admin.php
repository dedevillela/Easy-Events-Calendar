<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://dedevillela.com/
 * @since      0.0.1
 *
 * @package    Easy_Events_Calendar
 * @subpackage Easy_Events_Calendar/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Easy_Events_Calendar
 * @subpackage Easy_Events_Calendar/admin
 * @author     André Aguiar Villela <dede.villela@gmail.com>
 */
class Easy_Events_Calendar_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    0.0.1
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    0.0.1
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    0.0.1
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		
		add_action( 'init', array( $this, 'custom_post_type' ) );
		
		add_action( 'cmb2_admin_init', array( $this, 'plugin_metaboxes' ) );

	}
	
	/**
	 * Register the Event custom post type.
	 *
	 * @since    0.0.1
	 * @access   public
	 * @var      string    $version    The current version of this plugin.
	 */
	
	public function custom_post_type() {
		$labels = array(
			'name'                  => _x( 'Events', 'Post type general name', 'easy-events-calendar' ),
			'singular_name'         => _x( 'Event', 'Post type singular name', 'easy-events-calendar' ),
			'menu_name'             => _x( 'Events', 'Admin Menu text', 'easy-events-calendar' ),
			'name_admin_bar'        => _x( 'Event', 'Add New on Toolbar', 'easy-events-calendar' ),
			'add_new'               => __( 'Add new', 'easy-events-calendar' ),
			'add_new_item'          => __( 'Add new event', 'easy-events-calendar' ),
			'new_item'              => __( 'New event', 'easy-events-calendar' ),
			'edit_item'             => __( 'Edit event', 'easy-events-calendar' ),
			'view_item'             => __( 'View event', 'easy-events-calendar' ),
			'all_items'             => __( 'All events', 'easy-events-calendar' ),
			'search_items'          => __( 'Search events', 'easy-events-calendar' ),
			'parent_item_colon'     => __( 'Parent event:', 'easy-events-calendar' ),
			'not_found'             => __( 'Not found.', 'easy-events-calendar' ),
			'not_found_in_trash'    => __( 'Event not found in trash.', 'easy-events-calendar' ),
			'featured_image'        => _x( 'Featured image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'easy-events-calendar' ),
			'set_featured_image'    => _x( 'Set featured image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'easy-events-calendar' ),
			'remove_featured_image' => _x( 'Remove featured image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'easy-events-calendar' ),
			'use_featured_image'    => _x( 'Use featured image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'easy-events-calendar' ),
			'insert_into_item'      => _x( 'Insert into event', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'easy-events-calendar' ),
			'uploaded_to_this_item' => _x( 'Uploaded to this event', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'easy-events-calendar' ),
			'filter_items_list'     => _x( 'Filter events list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'easy-events-calendar' ),
			'items_list_navigation' => _x( 'Events list', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'easy-events-calendar' ),
			'items_list'            => _x( 'List Events', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'easy-events-calendar' ),
		);

		$args = array(
			'labels'               => $labels,
			'public'               => false,
			'publicly_queryable'   => true,
			'show_ui'              => true,
			'show_in_menu'         => true,
			'query_var'            => true,
			'rewrite'              => array( 'slug' => 'event' ),
			'capability_type'      => 'post',
			'has_archive'          => false,
			'hierarchical'         => false,
			'menu_position'        => null,
			'register_meta_box_cb' => 'plugin_metaboxes',
			'menu_icon'            => 'data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIyNCIgaGVpZ2h0PSIyNCIgdmlld0JveD0iMCAwIDI0IDI0Ij48cGF0aCBkPSJNMTcgMTJoLTV2NWg1di01ek0xNiAxdjJIOFYxSDZ2Mkg1Yy0xLjExIDAtMS45OS45LTEuOTkgMkwzIDE5YzAgMS4xLjg5IDIgMiAyaDE0YzEuMSAwIDItLjkgMi0yVjVjMC0xLjEtLjktMi0yLTJoLTFWMWgtMnptMyAxOEg1VjhoMTR2MTF6IiBmaWxsPSIjYTBhNWFhIiAvPjwvc3ZnPg==',
			'supports'             => array( 'title', 'thumbnail', 'excerpt' ),
		);
		register_post_type( 'event', $args );
	}
	
	/**
	 * Register the Event meta boxes.
	 *
	 * @since    0.0.1
	 * @access   public
	 * @var      string    $version    The current version of this plugin.
	 */
	
	public function plugin_metaboxes() {

    	/**
    	 * Initiate the metabox
    	 */
    	$cmb = new_cmb2_box( array(
    		'id'            => 'event_metabox',
    		'title'         => _x( 'Event details', 'easy-events-calendar' ),
    		'object_types'  => array( 'event', ), // Post type
    		'context'       => 'normal',
    		'priority'      => 'high',
    		'show_names'    => true, // Show field names on the left
    		// 'cmb_styles' => false, // false to disable the CMB stylesheet
    		// 'closed'     => true, // Keep the metabox closed by default
    	) );
    
    	// Description text field
    	$cmb->add_field( array(
    		'name'       => __( 'Description', 'easy-events-calendar' ),
    		'desc'       => __( 'field description (optional)', 'easy-events-calendar' ),
    		'id'         => 'event_description',
    		'type'       => 'textarea',
    		'show_on_cb' => 'cmb2_hide_if_no_cats', // function should return a bool value
    		// 'sanitization_cb' => 'my_custom_sanitization', // custom sanitization callback parameter
    		// 'escape_cb'       => 'my_custom_escaping',  // custom escaping callback parameter
    		// 'on_front'        => false, // Optionally designate a field to wp-admin only
    		// 'repeatable'      => true,
    	) );
    
    	// URL text field
    	$cmb->add_field( array(
    		'name' => __( 'Start', 'easy-events-calendar' ),
    		'desc' => __( 'field description (optional)', 'easy-events-calendar' ),
    		'id'   => 'event_datetime_start',
    		'type' => 'text_datetime_timestamp',
    		// 'repeatable' => true,
    	) );
    	
    	// URL text field
    	$cmb->add_field( array(
    		'name' => __( 'End', 'easy-events-calendar' ),
    		'desc' => __( 'field description (optional)', 'easy-events-calendar' ),
    		'id'   => 'event_datetime_end',
    		'type' => 'text_datetime_timestamp',
    		// 'repeatable' => true,
    	) );
    	
    	// Recurrence radio field
    	$cmb->add_field( array(
        	'name'             => 'Recurrence',
        	'desc'             => 'Recurrence rules',
        	'id'               => 'event_recurrence',
        	'type'             => 'radio_inline',
        	'default'          => 'none',
        	'options'          => array(
        		'none'    => __( 'None', 'easy-events-calendar' ),
        		'daily'   => __( 'Daily', 'easy-events-calendar' ),
        		'weekly'  => __( 'Weekly', 'easy-events-calendar' ),
        		'monthly' => __( 'Monthly', 'easy-events-calendar' ),
        		'yearly'  => __( 'Yearly', 'easy-events-calendar' ),
        	),
        ) );
    	
    	// Costs text field
    	$cmb->add_field( array(
    		'name' => __( 'Costs/entrance fees', 'easy-events-calendar' ),
    		'desc' => __( 'field description (optional)', 'easy-events-calendar' ),
    		'id'   => 'event_costs',
    		'type' => 'text_money',
    		'before_field' => '€', // Replaces default '$'
    	) );
    	
    	// URL text field
    	$cmb->add_field( array(
    		'name' => __( 'External Link', 'easy-events-calendar' ),
    		'desc' => __( 'field description (optional)', 'easy-events-calendar' ),
    		'id'   => 'event_url',
    		'type' => 'text_url',
    		'protocols' => array('http', 'https', 'ftp', 'ftps', 'mailto', 'news', 'irc', 'gopher', 'nntp', 'feed', 'telnet'), // Array of allowed protocols
    	) );
    
    	$group_field_id = $cmb->add_field( array(
        	'id'          => 'event_venue',
        	'type'        => 'group',
        	'repeatable'  => false,
        	'options'     => array(
        		'group_title'       => __( 'Venue', 'cmb2' ),
        		'sortable'          => true
        	),
        ) );
        
        // Id's for group's fields only need to be unique for the group. Prefix is not needed.
        $cmb->add_group_field( $group_field_id, array(
        	'name' => 'Venue Name',
        	'id'   => 'venue_name',
        	'type' => 'text'
        ) );
        
        $cmb->add_group_field( $group_field_id, array(
        	'name' => 'Venue Address',
        	'description' => 'Write the full address for this venue.',
        	'id'   => 'venue_address',
        	'type' => 'textarea_small',
        ) );
    
    }

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    0.0.1
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Easy_Events_Calendar_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Easy_Events_Calendar_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/easy-events-calendar-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    0.0.1
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Easy_Events_Calendar_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Easy_Events_Calendar_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/easy-events-calendar-admin.js', array( 'jquery' ), $this->version, false );

	}

}
