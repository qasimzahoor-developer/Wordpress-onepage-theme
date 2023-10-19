<?php
@ini_set( 'max_execution_time', '300' );
include('menu-walker.php');

//Theme setup
function maxmedia_theme_setup() {
    add_theme_support( 'title-tag' );  
    add_theme_support( 'custom-logo' );
    add_theme_support( 'post-thumbnails' );
}
add_action( 'after_setup_theme', 'maxmedia_theme_setup');
//add js
function maxmedia_avascript() {
    wp_enqueue_script( 'maxmedia-script', get_template_directory_uri() . '/js/maxmedia-main.js?v=1.1'.time());
}
add_action('wp_enqueue_scripts', 'maxmedia_avascript');
function maxmedia_defer_scripts( $tag, $handle, $src ) {
    $defer = array( 
      'maxmedia-script'
    );
    if ( in_array( $handle, $defer ) ) {
       return '<script src="' . $src . '" defer="defer" type="text/javascript"></script>' . "\n";
    }
      
      return $tag;
  } 
  add_filter( 'script_loader_tag', 'maxmedia_defer_scripts', 10, 3 );
    
//Menu
function maxmedia_menu_option() {
    register_nav_menu( 'primary', 'Primary Menu');
    register_nav_menu('footer','Footer Menu');
}
add_action( 'after_setup_theme', 'maxmedia_menu_option');

//Widget Areas
function maxmedia_widgets_init() {
    register_sidebar( array(
        'name'          => 'Header Social Icons',
        'id'            => 'header-social-icons',
        'before_widget' => '<div class="chw-widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="chw-title">',
        'after_title'   => '</h2>',
    ) );
}
add_action( 'widgets_init', 'maxmedia_widgets_init' );

//Home Video
function maxmedia_options_hero_video( $wp_customize ) {

    $wp_customize->add_setting('home_video_setting',array(
            'default'=>'',
    ));
    $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'video_control', array(
        'label' => _( 'Hero Video'),
        'section' => 'static_front_page',
        'mime_type' => 'video',
        'settings'=>'home_video_setting',
      ) ) );

}
add_action('customize_register','maxmedia_options_hero_video');

//Home Video Cover
function maxmedia_options_hero_video_cover( $wp_customize ) {

    $wp_customize->add_setting('home_video_cover_setting',array(
            'default'=>'',
    ));
    $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'video_cover_control', array(
        'label' => _( 'Hero Video Cover'),
        'section' => 'static_front_page',
        'mime_type' => 'image',
        'settings'=>'home_video_cover_setting',
    ) ) );

}
add_action('customize_register','maxmedia_options_hero_video_cover');

//Page Title Show/Hide
function mexmedia_add_show_hid_title() {
		add_meta_box(
			'mexmedia_showhide_title_id', 
			'Section Title', 
			'mexmedia_view_title_metabox_html', 
			'page'
		);
}
add_action( 'add_meta_boxes', 'mexmedia_add_show_hid_title' );
function mexmedia_view_title_metabox_html( $post ) {
    $titleShow = (boolean) get_post_meta( $post->ID , '_mexmedia_view_title_show', true );
	?>
	<!-- <label for="mexmedia_view_title_show">Section Title</label> -->
	<select name="mexmedia_view_title_show" id="mexmedia_view_title_show" class="postbox">
		<option value="0" <?php echo $titleShow?'':'selected'; ?>>Hide Title on Section</option>
		<option value="1"<?php echo $titleShow?'selected':''; ?>>Show Tite on Section</option>
	</select>
	<?php
}

//Page Classes
function mexmedia_add_page_classes() {
		add_meta_box(
			'mexmedia_page_classes_id', 
			'Page Classes', 
			'mexmedia_page_classes', 
			'page'
		);
}
add_action( 'add_meta_boxes', 'mexmedia_add_page_classes' );
function mexmedia_page_classes( $post ) {
    $pageClasses = get_post_meta( $post->ID , '_mexmedia_page_classes', true );
	?>
	<input name="_mexmedia_page_classes" value="<?php echo $pageClasses ?>" class="widefat">
	<?php
}

//Save Custom Data
function maxmedia_save_postdata( $post_id ) {
	if ( array_key_exists( 'mexmedia_view_title_show', $_POST ) ) {
		update_post_meta(
			$post_id,
			'_mexmedia_view_title_show',
			$_POST['mexmedia_view_title_show']
		);
	}
	
	if ( array_key_exists( '_mexmedia_page_classes', $_POST ) ) {
		update_post_meta(
			$post_id,
			'_mexmedia_page_classes',
			$_POST['_mexmedia_page_classes']
		);
	}
}
add_action( 'save_post', 'maxmedia_save_postdata' );





