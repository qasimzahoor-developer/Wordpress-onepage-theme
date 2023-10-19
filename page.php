<?php get_header(); ?>
<?php 
	// Get Custom Logo URL
	$custom_logo_id = get_theme_mod( 'custom_logo' );
	$custom_logo_data = wp_get_attachment_image_src( $custom_logo_id , 'thumb' );
	$custom_logo_url = $custom_logo_data[0];

	$HomePageID = get_option('page_on_front'); 
	$homeVideo = get_post_custom_values('home-video', $HomePageID ); 

?>
<div id="page" class="site">
	<section id="section<?php echo $HomePageID; ?>" class="header">
		<?php $video_url = wp_get_attachment_url(get_theme_mod( 'home_video_setting')); ?>
		<?php 
			if($video_url):
				$video_cover_url = wp_get_attachment_url(get_theme_mod( 'home_video_cover_setting'));
		?>
		<div class="play-video rounded mx-auto pe-2 play-button" id="PlayHeroVideo">
			<div class="play-video-icon d-inline-block ps-2">
				<svg class="bg-play" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
					<path d="M-838-2232H562v3600H-838z" fill="none"/><path d="M16 10v28l22-14z"/><path d="M0 0h48v48H0z" fill="none"/>
				</svg>
			</div><br/>
			Play Trailer
		</div>
		<div class="d-none rounded mx-auto pe-2 play-button" id="PauseHeroVideo">
			<div class="play-video-icon d-inline-block ps-2">
				<svg class="bg-pause" enable-background="new 0 0 40 40" id="Слой_1" version="1.1" viewBox="0 0 40 40" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g>
				    <path d="M20,40C9,40,0,31,0,20S9,0,20,0c4.5,0,8.7,1.5,12.3,4.2c0.4,0.3,0.5,1,0.2,1.4c-0.3,0.4-1,0.5-1.4,0.2C27.9,3.3,24,2,20,2   C10.1,2,2,10.1,2,20s8.1,18,18,18s18-8.1,18-18c0-3.2-0.9-6.4-2.5-9.2c-0.3-0.5-0.1-1.1,0.3-1.4c0.5-0.3,1.1-0.1,1.4,0.3   C39,12.9,40,16.4,40,20C40,31,31,40,20,40z"/></g>
				    <g><path d="M23,29c-0.6,0-1-0.4-1-1V12c0-0.6,0.4-1,1-1s1,0.4,1,1v16C24,28.6,23.6,29,23,29z"/></g><g><path d="M17,29c-0.6,0-1-0.4-1-1V12c0-0.6,0.4-1,1-1s1,0.4,1,1v16C18,28.6,17.6,29,17,29z"/></g>
				    </svg>
			</div><br/>
			Pause Trailer
		</div>
		<div class="video-container">
			<video loop poster="<?php echo $video_cover_url; ?>" id="HeroVideo">
				<source src="<?php echo $video_url; ?>" type="video/mp4" />
			</video>
		</div>
		<?php endif; ?>
		<div class="header-area">
			<nav class="navbar navbar-dark">
				<div class="container-fluid">
				<a href="<?php echo get_home_url(); ?>" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
						<img class="custom-logo mx-3" src="<?php echo $custom_logo_url; ?>" />
				</a>
				<button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#mainMenu" aria-controls="mainMenu">
					<span class="navbar-toggler-icon"></span>
					</button>
				</div>
			</nav>
			<div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="mainMenu" aria-labelledby="mainMenuLabel">
              <div class="offcanvas-header">
                <h3 class="offcanvas-title" id="offcanvasLabel">Menu</h3>
                <button type="button" class="btn-close text-reset btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
              </div>
              <div class="offcanvas-body d-flex align-items-center">
                <?php wp_nav_menu( array('theme_location' => 'primary', 'menu_class'=>'nav flex-column', 'walker'=>new WPDocs_Walker_Nav_Menu()) ); ?>
              </div>
            </div>
		</div> <!-- .header-area -->
		

		<div class="social-icons-area">
		<?php
		if ( is_active_sidebar( 'header-social-icons' ) ) : ?>
			<div id="header-social-icons" class="social-icons" role="complementary">
				<?php dynamic_sidebar( 'header-social-icons' ); ?>
			</div>
		
		<?php endif; ?>
		</div> <!-- .social-icons -->
	</section> <!-- .header -->
	<?php 
		$front_page_id = get_option('page_on_front');
		$pages = get_pages("exclude=$front_page_id&sort_column=menu_order");
		foreach($pages as $page) { 
		$titleShow = (boolean) get_post_meta( $page->ID , '_mexmedia_view_title_show', true );
		$pageClasses = get_post_meta( $page->ID , '_mexmedia_page_classes', true );
	?>
	<section 
		id="section<?php echo $page->ID; ?>" 
		<?php if(has_post_thumbnail($page->ID)): ?>
			style="background:url('<?php echo get_the_post_thumbnail_url($page->ID) ?>') no-repeat center center; background-size:cover" 
		<?php endif;?> 
		class="pages my-5 <?php echo $pageClasses ; ?>"
	>	
		<div class="container">
			<?php if($titleShow): ?>
			<h1 class="page-tile fs-1 text-uppercase fw-bold"><?php echo  $page->post_title; ?></h1>
			<?php endif; ?>
			<div class="page-content">
			<?php echo apply_filters('the_content', $page->post_content) ?>
			</div>
		</div>
	</section>
	<?php  } ?>
</div><!-- #page -->
<div class="btnScrollToTop">
	<div class="arrow-up"></div>
	Top
</div><!-- btnScrollToTop	 -->
<?php
get_footer();
