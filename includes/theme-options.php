<?php

//Enable WooSEO on these custom Post types
$seo_post_types = array('post','page');
define("SEOPOSTTYPES", serialize($seo_post_types));

//Global options setup
add_action('init','woo_global_options');
function woo_global_options(){
	// Populate WooThemes option in array for use in theme
	global $woo_options;
	$woo_options = get_option('woo_options');
}

add_action( 'admin_head','woo_options' );  
if (!function_exists('woo_options')) {
function woo_options() {
	
// VARIABLES
$themename = "Simplicity";
$manualurl = 'http://www.woothemes.com/support/theme-documentation/simplicity/';
$shortname = "woo";

//Access the WordPress Categories via an Array
$woo_categories = array();  
$woo_categories_obj = get_categories('hide_empty=0');
foreach ($woo_categories_obj as $woo_cat) {
    $woo_categories[$woo_cat->cat_ID] = $woo_cat->cat_name;}
$categories_tmp = array_unshift($woo_categories, "Select a category:");    
       
//Access the WordPress Pages via an Array
$woo_pages = array();
$woo_pages_obj = get_pages('sort_column=post_parent,menu_order');    
foreach ($woo_pages_obj as $woo_page) {
    $woo_pages[$woo_page->ID] = $woo_page->post_name; }
$woo_pages_tmp = array_unshift($woo_pages, "Select a page:");       

//Stylesheets Reader
$alt_stylesheet_path = TEMPLATEPATH . '/styles/';
$alt_stylesheets = array();
if ( is_dir($alt_stylesheet_path) ) {
    if ($alt_stylesheet_dir = opendir($alt_stylesheet_path) ) { 
        while ( ($alt_stylesheet_file = readdir($alt_stylesheet_dir)) !== false ) {
            if(stristr($alt_stylesheet_file, ".css") !== false) {
                $alt_stylesheets[] = $alt_stylesheet_file;
            }
        }    
    }
}

//More Options
$other_entries = array("Select a number:","1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19");

// THIS IS THE DIFFERENT FIELDS
$options = array();   

  
// General

$options[] = array( "name" => "General Settings",
					"type" => "heading",
					"icon" => "general");
                        
$options[] = array( "name" => "Theme Stylesheet",
					"desc" => "Select your themes alternative color scheme.",
					"id" => $shortname."_alt_stylesheet",
					"std" => "default.css",
					"type" => "select",
					"options" => $alt_stylesheets);

$options[] = array( "name" => "Custom Logo",
					"desc" => "Upload a logo for your theme, or specify an image URL directly.",
					"id" => $shortname."_logo",
					"std" => "",
					"type" => "upload");    
                                                                                     
$options[] = array( "name" => "Text Title",
					"desc" => "Enable text-based Site Title and Tagline. Setup title & tagline in <a href='".home_url()."/wp-admin/options-general.php'>General Settings</a>.",
					"id" => $shortname."_texttitle",
					"std" => "false",
					"class" => "collapsed",
					"type" => "checkbox");

$options[] = array( "name" => "Site Title",
					"desc" => "Change the site title typography.",
					"id" => $shortname."_font_site_title",
					"std" => array('size' => '40','unit' => 'px','face' => 'Georgia','style' => '','color' => '#222222'),
					"class" => "hidden",
					"type" => "typography");  

$options[] = array( "name" => "Site Description",
					"desc" => "Enable the site description/tagline under site title.",
					"id" => $shortname."_tagline",
					"class" => "hidden",
					"std" => "false",
					"type" => "checkbox" );

$options[] = array( "name" => "Site Description",
					"desc" => "Change the site description typography.",
					"id" => $shortname."_font_tagline",
					"std" => array('size' => '14','unit' => 'px','face' => 'Georgia','style' => 'italic','color' => '#999999'),
					"class" => "hidden last",
					"type" => "typography");  
					          
$options[] = array( "name" => "Custom Favicon",
					"desc" => "Upload a 16px x 16px <a href='http://www.faviconr.com/'>ico image</a> that will represent your website's favicon.",
					"id" => $shortname."_custom_favicon",
					"std" => "",
					"type" => "upload"); 
                                               
$options[] = array( "name" => "Tracking Code",
					"desc" => "Paste your Google Analytics (or other) tracking code here. This will be added into the footer template of your theme.",
					"id" => $shortname."_google_analytics",
					"std" => "",
					"type" => "textarea");        

$options[] = array( "name" => "RSS URL",
					"desc" => "Enter your preferred RSS URL. (Feedburner or other)",
					"id" => $shortname."_feed_url",
					"std" => "",
					"type" => "text");
                    
$options[] = array( "name" => "Contact Form E-Mail",
					"desc" => "Enter your E-mail address to use on the Contact Form Page Template. Add the contact form by adding a new page and selecting 'Contact Form' as page template.",
					"id" => $shortname."_contactform_email",
					"std" => "",
					"type" => "text");

$options[] = array( "name" => "Custom CSS",
                    "desc" => "Quickly add some CSS to your theme by adding it to this block.",
                    "id" => $shortname."_custom_css",
                    "std" => "",
                    "type" => "textarea");

$options[] = array( "name" => "Post/Page Comments",
					"desc" => "Select if you want to enable/disable comments on posts and/or pages. ",
					"id" => $shortname."_comments",
					"type" => "select2",
					"options" => array("post" => "Posts Only", "page" => "Pages Only", "both" => "Pages / Posts", "none" => "None") );                                                          
    
$options[] = array( "name" => "Post Content",
					"desc" => "Select if you want to show the full content or the excerpt on posts. ",
					"id" => $shortname."_post_content",
					"type" => "select2",
					"options" => array("excerpt" => "The Excerpt", "content" => "Full Content" ) );                                                          

$options[] = array( "name" => "Post Author Box",
					"desc" => "This will enable the post author box on the single posts page. Edit description in <a href='".home_url()."/wp-admin/profile.php'>Profile</a>.",
					"id" => $shortname."_post_author",
					"std" => "true",
					"type" => "checkbox");
					
$options[] = array( "name" => "Display Breadcrumbs",
					"desc" => "Display dynamic breadcrumbs on each page of your website.",
					"id" => $shortname."_breadcrumbs_show",
					"std" => "false",
					"type" => "checkbox");
				
$options[] = array( "name" => "Pagination Style",
					"desc" => "Select the style of pagination you would like to use on the blog.",
					"id" => $shortname."_pagination_type",
					"type" => "select2",
					"options" => array("paginated_links" => "Numbers", "simple" => "Next/Previous" ) );
// Styling 

$options[] = array( "name" => "Styling Options",
					"type" => "heading",
					"icon" => "styling");   
					
$options[] = array( "name" =>  "Body Background Color",
					"desc" => "Pick a custom color for background color of the theme e.g. #697e09",
					"id" => "woo_body_color",
					"std" => "",
					"type" => "color");
					
$options[] = array( "name" => "Body background image",
					"desc" => "Upload an image for the theme's background",
					"id" => $shortname."_body_img",
					"std" => "",
					"type" => "upload");
					
$options[] = array( "name" => "Background image repeat",
                    "desc" => "Select how you would like to repeat the background-image",
                    "id" => $shortname."_body_repeat",
                    "std" => "no-repeat",
                    "type" => "select",
                    "options" => array("no-repeat","repeat-x","repeat-y","repeat"));

$options[] = array( "name" => "Background image position",
                    "desc" => "Select how you would like to position the background",
                    "id" => $shortname."_body_pos",
                    "std" => "top",
                    "type" => "select",
                    "options" => array("top left","top center","top right","center left","center center","center right","bottom left","bottom center","bottom right"));

$options[] = array( "name" =>  "Link Color",
					"desc" => "Pick a custom color for links or add a hex color code e.g. #697e09",
					"id" => "woo_link_color",
					"std" => "",
					"type" => "color");   

$options[] = array( "name" =>  "Link Hover Color",
					"desc" => "Pick a custom color for links hover or add a hex color code e.g. #697e09",
					"id" => "woo_link_hover_color",
					"std" => "",
					"type" => "color");                    

$options[] = array( "name" =>  "Button Color",
					"desc" => "Pick a custom color for buttons or add a hex color code e.g. #697e09",
					"id" => "woo_button_color",
					"std" => "",
					"type" => "color");          

/* Typography */	
				
$options[] = array( "name" => "Typography",
					"type" => "heading",
					"icon" => "typography");   

$options[] = array( "name" => "Enable Custom Typography",
					"desc" => "Enable the use of custom typography for your site. Custom styling will be output in your sites HEAD.",
					"id" => $shortname."_typography",
					"std" => "false",
					"type" => "checkbox"); 									   

$options[] = array( "name" => "General Typography",
					"desc" => "Change the general font.",
					"id" => $shortname."_font_body",
					"std" => array('size' => '12','unit' => 'px','face' => 'Arial','style' => '','color' => '#555555'),
					"type" => "typography");  

$options[] = array( "name" => "Navigation",
					"desc" => "Change the navigation font.",
					"id" => $shortname."_font_nav",
					"std" => array('size' => '17','unit' => 'px','face' => 'PT Sans','style' => '','color' => '#3E4245'),
					"type" => "typography");  

$options[] = array( "name" => "Post Title",
					"desc" => "Change the post title.",
					"id" => $shortname."_font_post_title",
					"std" => array('size' => '33','unit' => 'px','face' => 'PT Sans','style' => 'normal','color' => '#293F4C'),
					"type" => "typography");  

$options[] = array( "name" => "Post Meta",
					"desc" => "Change the post meta.",
					"id" => $shortname."_font_post_meta",
					"std" => array('size' => '12','unit' => 'px','face' => 'Arial','style' => '','color' => '#999999'),
					"type" => "typography");  
					          
$options[] = array( "name" => "Post Entry",
					"desc" => "Change the post entry.",
					"id" => $shortname."_font_post_entry",
					"std" => array('size' => '14','unit' => 'px','face' => 'Arial','style' => '','color' => '#555555'),
					"type" => "typography");  

$options[] = array( "name" => "Widget Titles",
					"desc" => "Change the widget titles.",
					"id" => $shortname."_font_widget_titles",
					"std" => array('size' => '18','unit' => 'px','face' => 'PT Sans','style' => 'bold','color' => '#555555'),
					"type" => "typography");  

/* Layout */ 

$options[] = array( "name" => "Layout Options",
					"type" => "heading",
					"icon" => "layout");   
					 					                   
$url =  get_bloginfo('template_url') . '/functions/images/';
$options[] = array( "name" => "Main Layout",
					"desc" => "Select which layout you want for your site.",
					"id" => $shortname."_site_layout",
					"std" => "layout-left-content",
					"type" => "images",
					"options" => array(
						'layout-left-content' => $url . '2cl.png',
						'layout-right-content' => $url . '2cr.png')
					);
					
$options[] = array(	"name" => "Use Secondary Navigation?",
					"desc" => "Check this box if you'd like to enable the use of the secondary navigation column for inner pages.",
					"id" => $shortname."_subnav",
					"std" => "false",
					"type" => "checkbox");						
					
$options[] = array(	"name" => "Exclude Pages from Secondary Navigation (inner pages)",
                    "desc" => "Enter a comma-separated list of <a href='http://support.wordpress.com/pages/8/'>ID's</a> that you'd like to exclude from the top navigation. (e.g. 12,23,27,44)", 
					"id" => $shortname."_exclude_pages_subnav",
					"std" => "",
					"type" => "text");															
					 		   
/* Slider */
$options[] = array( "name" => "Homepage Slider",
					"icon" => "slider",
					"type" => "heading");
					
$options[] = array( "name" => "Enable Slider",
                    "desc" => "Enable the slider on the homepage.",
                    "id" => $shortname."_slider",
                    "std" => "true",
                    "type" => "checkbox");

$options[] = array(    "name" => "Slider Entries",
                    "desc" => "Select the number of entries that should appear in the home page slider.",
                    "id" => $shortname."_slider_entries",
                    "std" => "3",
                    "type" => "select",
                    "options" => $other_entries);

$options[] = array( "name" => "Effect",
					"desc" => "Select the animation effect. ",
					"id" => $shortname."_slider_effect",
					"type" => "select2",
					"options" => array("slide" => "Slide", "fade" => "Fade") );     

$options[] = array( "name" => "Hover Pause",
                    "desc" => "Hovering over slideshow will pause it",
                    "id" => $shortname."_slider_hover",
                    "std" => "false",
                    "type" => "checkbox"); 

$options[] = array( "name" => "Randomize",
                    "desc" => "Select to randomize slides.",
                    "id" => $shortname."_slider_random",
                    "std" => "false",
                    "type" => "checkbox"); 
                    
$options[] = array( "name" => "Animation Speed",
                    "desc" => "The time in <b>seconds</b> the animation between frames will take.",
                    "id" => $shortname."_slider_speed",
                    "std" => "0.6",
					"type" => "select",
					"options" => array( '0.0', '0.1', '0.2', '0.3', '0.4', '0.5', '0.6', '0.7', '0.8', '0.9', '1.0', '1.1', '1.2', '1.3', '1.4', '1.5', '1.6', '1.7', '1.8', '1.9', '2.0' ) );
                    
$options[] = array( "name" => "Fade Speed",
                    "desc" => "The time in <b>seconds</b> the fade between frames will take.",
                    "id" => $shortname."_fade_speed",
                    "std" => "0.3",
					"type" => "select",
					"options" => array( '0.0', '0.1', '0.2', '0.3', '0.4', '0.5', '0.6', '0.7', '0.8', '0.9', '1.0', '1.1', '1.2', '1.3', '1.4', '1.5', '1.6', '1.7', '1.8', '1.9', '2.0' ) );

$options[] = array(    "name" => "Auto Start",
                    "desc" => "Set the slider to start sliding automatically.",
                    "id" => $shortname."_slider_auto",
                    "std" => "false",
                    "type" => "checkbox");   
                    
$options[] = array(    "name" => "Auto Slide Interval",
                    "desc" => "The time in <b>seconds</b> each slide pauses for, before sliding to the next.",
                    "id" => $shortname."_slider_interval",
                    "std" => "6",
					"type" => "select",
					"options" => array( '1', '2', '3', '4', '5', '6', '7', '8', '9', '10' ) );
                    
$options[] = array( "name" => __( 'Show Title with Image Background', 'woothemes' ),
					"desc" => __( 'Show the post title when using an image as slider background.', 'woothemes' ),
					"id" => $shortname."_slider_title",
					"std" => "false",
					"type" => "checkbox");  
					
$options[] = array( "name" => __( 'Show Excerpt with Image Background', 'woothemes' ),
					"desc" => __( 'Show the post excerpt when using an image as slider background.', 'woothemes' ),
					"id" => $shortname."_slider_content",
					"std" => "false",
					"type" => "checkbox"); 
					
$options[] = array( "name" => "Next/Previous",
                    "desc" => "Select to display next/previous buttons.",
                    "id" => $shortname."_slider_nextprev",
                    "std" => "false",
                    "type" => "checkbox"); 

$options[] = array( "name" => "Pagination",
                    "desc" => "Select to display pagination.",
                    "id" => $shortname."_slider_pagination",
                    "std" => "true",
                    "type" => "checkbox"); 

/* Homepage */
$options[] = array( "name" => "Homepage Layout",
                    "icon" => "homepage",
					"type" => "heading");   
					
$options[] = array(	"name" => "Display Recent Posts",
					"desc" => "Show recent posts below slider instead of features.",
					"id" => $shortname."_home_posts",
					"std" => "false",
					"type" => "checkbox");					
					
$options[] = array(	"name" => "Homepage Sidebar",
					"desc" => "Show sidebar instead of full-width",
					"id" => $shortname."_home_sidebar",
					"std" => "true",
					"type" => "checkbox");
					
/* Destaque | Notícias */

$options[] = array( "name" => "Área de Destaque das Notícias",
          			"desc" => "Ativar o destaque das notícias.",
          			"id" => $shortname."_mini_features",
          			"std" => "true",
          			"type" => "checkbox");
          			
$options[] = array( "name" => "Título das Notícias",
					"desc" => "Edite o título da seção de destaque das notícias.",
					"id" => $shortname."_sub_featured_title",
					"std" => "",
					"type" => "text");
					
$options[] = array( "name" => "Número de Destaques",
					"id" => $shortname."_mini_features_number",
					"std" => "3",
					"type" => "select",
					"options" => $other_entries);	
					
$options[] = array( "name" => "Custom permalink",
          			"desc" => "This option allows you to change the permalink on the individual mini-features pages. (e.g /infobox/pagename to /features/pagename/). Please update <a href='". admin_url('options-permalink.php')."'>Permalinks</a> after any changes.",
          			"id" => $shortname."_infobox_rewrite",
          			"std" => "infobox",
          			"type" => "text");                          
	
/* Destaque | Apresentações */

$options[] = array( "name" => "Área de Destaque das Apresentações",
          			"desc" => "Ativar o destaque das últimas apresentações.",
          			"id" => $shortname."_apresentacoes",
          			"std" => "true",
          			"type" => "checkbox");
          			
$options[] = array( "name" => "Título das Apresentações",
					"desc" => "Edite o título da seção de destaque das apresentações",
					"id" => $shortname."_titulo_apresentacoes",
					"std" => "",
					"type" => "text");
					
$options[] = array( "name" => "Número de Destaques",
					"id" => $shortname."_numero_apresentacoes",
					"std" => "3",
					"type" => "select",
					"options" => $other_entries);	   

$options[] = array( "name" => "Custom permalink",
          			"desc" => "This option allows you to change the permalink on the individual portfolio pages. (e.g /apresentacoes/pagename to /apres/pagename/). Please update <a href='". admin_url('options-permalink.php')."'>Permalinks</a> after any changes.",
          			"id" => $shortname."_apresentacoes_rewrite",
          			"std" => "apresentacoes",
          			"type" => "text");                        
	

/* Homepage Portfolio */
					

$options[] = array( "name" => "Enable Portfolio",
					"desc" => "Enable the portfolio section below the about section. Add portfolio posts using the 'Portfolio' custom post type.",
					"id" => $shortname."_portfolio",
					"std" => "true",
					"type" => "checkbox");
															
					
$options[] = array( "name" => "Portfolio Title",
					"desc" => "Edit the title of the portfolio section",
					"id" => $shortname."_portfolio_title",
					"std" => "",
					"type" => "text");
					
$options[] = array( "name" => "Number of Portfolio items",
					"id" => $shortname."_portfolio_number",
					"std" => "4",
					"type" => "select",
					"options" => $other_entries);		
					
$options[] = array( "name" => "Custom permalink",
          			"desc" => "This option allows you to change the permalink on the individual portfolio pages. (e.g /portfolio-items/pagename to /artwork/pagename/). Please update <a href='". admin_url('options-permalink.php')."'>Permalinks</a> after any changes.",
          			"id" => $shortname."_portfolioitems_rewrite",
          			"std" => "portfolio-items",
          			"type" => "text");                          
					
/* Testimonials */			
$options[] = array( "name" => "Enable Testimonials",
					"desc" => "Enable the testimonials section below the portfolio section. Add testimonials using the 'Testimonial' custom post type.",
					"id" => $shortname."_testimonials",
					"std" => "true",
					"type" => "checkbox");

					
$options[] = array( "name" => "Testimonials Title",
					"desc" => "Edit the title of the testimonials section",
					"id" => $shortname."_info_quote_title",
					"std" => "",
					"type" => "text");                                                   

$options[] = array( "name" => "Auto-Fade Between Testimonials",
					"desc" => "Enable automatic fading between testimonials.",
					"id" => $shortname."_testimonials_autofade",
					"std" => "true",
					"type" => "checkbox");

$options[] = array( "name" => "Auto Fade Interval",
                    "desc" => "The time in <strong>milliseconds</strong> each testimonial pauses for, before fading to the next.",
                    "id" => $shortname."_testimonials_interval",
                    "std" => "6000",
                    "type" => "text");

/* Portfolio */
$options[] = array( "name" => "Portfolio",
                    "icon" => "portfolio",
					"type" => "heading");    		

$options[] = array( "name" => "Portfolio Tags",
					"desc" => "Enter comma seperated tags for portfolio sorting (e.g. web, print, icons). You must add these tags to the portfolio items you want to sort.",
					"id" => $shortname."_portfolio_tags",
					"std" => "",
					"type" => "text");
					
$options[] = array( "name" => "Enable Single Portfolio Gallery",
					"desc" => "Enable the gallery feature in the single portfolio page layout.",
					"id" => $shortname."_portfolio_gallery",
					"std" => "true",
					"type" => "checkbox");
					
$options[] = array( "name" => "Single Portfolio Title",
					"desc" => "Edit the title of the single portfolio section",
					"id" => $shortname."_single_portfolio_title",
					"std" => "",
					"type" => "text");
					

/* Dynamic Images */
$options[] = array( "name" => "Dynamic Images",
					"type" => "heading",
					"icon" => "image");    
				    				   
$options[] = array( "name" => "WP Post Thumbnail",
					"desc" => "Use WordPress post thumbnail to assign a post thumbnail.",
					"id" => $shortname."_post_image_support",
					"std" => "true",
					"class" => "collapsed",
					"type" => "checkbox"); 

$options[] = array( "name" => "WP Post Thumbnail - Dynamically Resize",
					"desc" => "The post thumbnail will be dynamically resized using native WP resize functionality. <em>(Requires PHP 5.2+)</em>",
					"id" => $shortname."_pis_resize",
					"std" => "true",
					"class" => "hidden",
					"type" => "checkbox"); 									   
					
$options[] = array( "name" => "WP Post Thumbnail - Hard Crop",
					"desc" => "The image will be cropped to match the target aspect ratio.",
					"id" => $shortname."_pis_hard_crop",
					"std" => "true",
					"class" => "hidden last",
					"type" => "checkbox"); 									   

$options[] = array( "name" => "Enable Dynamic Image Resizer",
					"desc" => "This will enable the thumb.php script which dynamically resizes images added through post custom field.",
					"id" => $shortname."_resize",
					"std" => "true",
					"type" => "checkbox");    
                    
$options[] = array( "name" => "Automatic Image Thumbs",
					"desc" => "If no image is specified in the 'image' custom field or WP post thumbnail then the first uploaded post image is used.",
					"id" => $shortname."_auto_img",
					"std" => "false",
					"type" => "checkbox");    

$options[] = array( "name" => "Thumbnail Image Dimensions",
					"desc" => "Enter an integer value i.e. 250 for the desired size which will be used when dynamically creating the images.",
					"id" => $shortname."_image_dimensions",
					"std" => "",
					"type" => array( 
									array(  'id' => $shortname. '_thumb_w',
											'type' => 'text',
											'std' => 100,
											'meta' => 'Width'),
									array(  'id' => $shortname. '_thumb_h',
											'type' => 'text',
											'std' => 100,
											'meta' => 'Height')
								  ));
                                                                                                
$options[] = array( "name" => "Thumbnail Image alignment",
					"desc" => "Select how to align your thumbnails with posts.",
					"id" => $shortname."_thumb_align",
					"std" => "alignleft",
					"type" => "radio",
					"options" => array("alignleft" => "Left","alignright" => "Right","aligncenter" => "Center")); 

$options[] = array( "name" => "Show thumbnail in Single Posts",
					"desc" => "Show the attached image in the single post page.",
					"id" => $shortname."_thumb_single",
					"class" => "collapsed",
					"std" => "false",
					"type" => "checkbox");    

$options[] = array( "name" => "Single Image Dimensions",
					"desc" => "Enter an integer value i.e. 250 for the image size. Max width is 576.",
					"id" => $shortname."_image_dimensions",
					"std" => "",
					"class" => "hidden last",
					"type" => array( 
									array(  'id' => $shortname. '_single_w',
											'type' => 'text',
											'std' => 618,
											'meta' => 'Width'),
									array(  'id' => $shortname. '_single_h',
											'type' => 'text',
											'std' => 142,
											'meta' => 'Height')
								  ));

$options[] = array( "name" => "Single Post Image alignment",
					"desc" => "Select how to align your thumbnail with single posts.",
					"id" => $shortname."_thumb_single_align",
					"std" => "alignright",
					"type" => "radio",
					"class" => "hidden",
					"options" => array("alignleft" => "Left","alignright" => "Right","aligncenter" => "Center")); 

$options[] = array( "name" => "Add thumbnail to RSS feed",
					"desc" => "Add the the image uploaded via your Custom Settings to your RSS feed",
					"id" => $shortname."_rss_thumb",
					"std" => "false",
					"type" => "checkbox");  
					
/* Footer */
$options[] = array( "name" => "Footer Customization",
					"type" => "heading",
					"icon" => "footer");    
					

$url =  get_bloginfo('template_url') . '/functions/images/';
$options[] = array( "name" => "Footer Widget Areas",
					"desc" => "Select how many footer widget areas you want to display.",
					"id" => $shortname."_footer_sidebars",
					"std" => "4",
					"type" => "images",
					"options" => array(
						'0' => $url . 'layout-off.png',
						'1' => $url . 'footer-widgets-1.png',
						'2' => $url . 'footer-widgets-2.png',
						'3' => $url . 'footer-widgets-3.png',
						'4' => $url . 'footer-widgets-4.png')
					); 		   
										
$options[] = array( "name" => "Custom Affiliate Link",
					"desc" => "Add an affiliate link to the WooThemes logo in the footer of the theme.",
					"id" => $shortname."_footer_aff_link",
					"std" => "",
					"type" => "text");	
									
$options[] = array( "name" => "Enable Custom Footer (Left)",
					"desc" => "Activate to add the custom text below to the theme footer.",
					"id" => $shortname."_footer_left",
					"std" => "false",
					"type" => "checkbox");    

$options[] = array( "name" => "Custom Text (Left)",
					"desc" => "Custom HTML and Text that will appear in the footer of your theme.",
					"id" => $shortname."_footer_left_text",
					"std" => "",
					"type" => "textarea");
						
$options[] = array( "name" => "Enable Custom Footer (Right)",
					"desc" => "Activate to add the custom text below to the theme footer.",
					"id" => $shortname."_footer_right",
					"std" => "false",
					"type" => "checkbox");    

$options[] = array( "name" => "Custom Text (Right)",
					"desc" => "Custom HTML and Text that will appear in the footer of your theme.",
					"id" => $shortname."_footer_right_text",
					"std" => "",
					"type" => "textarea");

/* Subscribe & Connect */
$options[] = array( "name" => "Subscribe & Connect",
					"type" => "heading",
					"icon" => "connect"); 

$options[] = array( "name" => "Enable Subscribe & Connect - Single Post",
					"desc" => "Enable the subscribe & connect area on single posts. You can also add this as a <a href='".home_url()."/wp-admin/widgets.php'>widget</a> in your sidebar.",
					"id" => $shortname."_connect",
					"std" => 'true',
					"type" => "checkbox"); 

$options[] = array( "name" => "Subscribe Title",
					"desc" => "Enter the title to show in your subscribe & connect area.",
					"id" => $shortname."_connect_title",
					"std" => '',
					"type" => "text"); 

$options[] = array( "name" => "Text",
					"desc" => "Change the default text in this area.",
					"id" => $shortname."_connect_content",
					"std" => '',
					"type" => "textarea"); 

$options[] = array( "name" => "Subscribe By E-mail ID (Feedburner)",
					"desc" => "Enter your <a href='http://www.google.com/support/feedburner/bin/answer.py?hl=en&answer=78982'>Feedburner ID</a> for the e-mail subscription form.",
					"id" => $shortname."_connect_newsletter_id",
					"std" => '',
					"type" => "text"); 					

$options[] = array( "name" => 'Subscribe By E-mail to MailChimp', 'woothemes',
					"desc" => 'If you have a MailChimp account you can enter the <a href="http://woochimp.heroku.com" target="_blank">MailChimp List Subscribe URL</a> to allow your users to subscribe to a MailChimp List.',
					"id" => $shortname."_connect_mailchimp_list_url",
					"std" => '',
					"type" => "text");

$options[] = array( "name" => "Enable RSS",
					"desc" => "Enable the subscribe and RSS icon.",
					"id" => $shortname."_connect_rss",
					"std" => 'true',
					"type" => "checkbox"); 

$options[] = array( "name" => "Twitter URL",
					"desc" => "Enter your  <a href='http://www.twitter.com/'>Twitter</a> URL e.g. http://www.twitter.com/woothemes",
					"id" => $shortname."_connect_twitter",
					"std" => '',
					"type" => "text"); 

$options[] = array( "name" => "Facebook URL",
					"desc" => "Enter your  <a href='http://www.facebook.com/'>Facebook</a> URL e.g. http://www.facebook.com/woothemes",
					"id" => $shortname."_connect_facebook",
					"std" => '',
					"type" => "text"); 
					
$options[] = array( "name" => "YouTube URL",
					"desc" => "Enter your  <a href='http://www.youtube.com/'>YouTube</a> URL e.g. http://www.youtube.com/woothemes",
					"id" => $shortname."_connect_youtube",
					"std" => '',
					"type" => "text"); 

$options[] = array( "name" => "Flickr URL",
					"desc" => "Enter your  <a href='http://www.flickr.com/'>Flickr</a> URL e.g. http://www.flickr.com/woothemes",
					"id" => $shortname."_connect_flickr",
					"std" => '',
					"type" => "text"); 

$options[] = array( "name" => "LinkedIn URL",
					"desc" => "Enter your  <a href='http://www.www.linkedin.com.com/'>LinkedIn</a> URL e.g. http://www.linkedin.com/in/woothemes",
					"id" => $shortname."_connect_linkedin",
					"std" => '',
					"type" => "text"); 

$options[] = array( "name" => "Delicious URL",
					"desc" => "Enter your <a href='http://www.delicious.com/'>Delicious</a> URL e.g. http://www.delicious.com/woothemes",
					"id" => $shortname."_connect_delicious",
					"std" => '',
					"type" => "text"); 

$options[] = array( "name" => "Google+ URL",
					"desc" => "Enter your <a href='http://plus.google.com/'>Google+</a> URL e.g. https://plus.google.com/104560124403688998123/",
					"id" => $shortname."_connect_googleplus",
					"std" => '',
					"type" => "text" );

$options[] = array( "name" => "Enable Related Posts",
					"desc" => "Enable related posts in the subscribe area. Uses posts with the same <strong>tags</strong> to find related posts. Note: Will not show in the Subscribe widget.",
					"id" => $shortname."_connect_related",
					"std" => 'true',
					"type" => "checkbox"); 
							
                                              
// Add extra options through function
if ( function_exists("woo_options_add") )
	$options = woo_options_add($options);

if ( get_option('woo_template') != $options) update_option('woo_template',$options);      
if ( get_option('woo_themename') != $themename) update_option('woo_themename',$themename);   
if ( get_option('woo_shortname') != $shortname) update_option('woo_shortname',$shortname);
if ( get_option('woo_manual') != $manualurl) update_option('woo_manual',$manualurl);

// Woo Metabox Options
// Start name with underscore to hide custom key from the user
$woo_metaboxes = array();

global $post;

if ( ( get_post_type() == 'post') || ( !get_post_type() ) ) {

	$woo_metaboxes[] = array (	"name" => "image",
								"label" => "Image",
								"type" => "upload",
								"desc" => "Upload an image or enter an URL.");
	
	if ( get_option('woo_resize') == "true" ) {						
		$woo_metaboxes[] = array (	"name" => "_image_alignment",
									"std" => "Center",
									"label" => "Image Crop Alignment",
									"type" => "select2",
									"desc" => "Select crop alignment for resized image",
									"options" => array(	"c" => "Center",
														"t" => "Top",
														"b" => "Bottom",
														"l" => "Left",
														"r" => "Right"));
	}

	$woo_metaboxes[] = array (  "name"  => "embed",
					            "std"  => "",
					            "label" => "Embed Code",
					            "type" => "textarea",
					            "desc" => "Enter the video embed code for your video (YouTube, Vimeo or similar)");
					            
										
} // End post

if ( get_post_type() == 'slide' || !get_post_type() ) {

	$woo_metaboxes[] = array (	"name" => "image",
								"label" => "Slide Image",
								"type" => "upload",
								"desc" => "Upload an image or enter an URL to your slide image");

	$woo_metaboxes[] = array (  "name"  => "embed",
					            "std"  => "",
					            "label" => "Video Embed Code",
					            "type" => "textarea",
					            "desc" => "Enter the video embed code for your video (YouTube, Vimeo or similar). Will show instead of your image.");
					            
	$woo_metaboxes[] = array (	"name" => "url",
								"label" => "URL",
								"type" => "text",
								"desc" => "Enter URL if you want to add a link to the uploaded image and title. (optional) ");
					          
} //End slide

if( get_post_type() == 'infobox' || !get_post_type()){	

$woo_metaboxes[] = array (		"name" => "mini-image",
								"label" => "Mini-features Image",
								"type" => "upload",
								"desc" => "Upload image for use with the Mini-Feature on the homepage (optional)");
 
$woo_metaboxes[] = array (		"name" => "mini_excerpt",
								"label" => "Mini-features Excerpt",
								"type" => "textarea",
								"desc" => "Enter the text to show in your Mini-Feature. ");

$woo_metaboxes[] = array (		"name" => "mini_readmore",
								"std" => "",
								"label" => "Mini-features URL",
								"type" => "text",
								"desc" => "Add an URL for your Mini-Feature image and title (optional)");

} // End mini

if( get_post_type() == 'apresentacoes' || !get_post_type()){	

$woo_metaboxes[] = array (		"name" => "imagem-apresentacoes",
								"label" => "Imagem das Apresentações",
								"type" => "upload",
								"desc" => "Subir imagem para o Destaque das Apresentações na página principal. (optional)");
 
$woo_metaboxes[] = array (		"name" => "resumo_apresentacoes",
								"label" => "Resumo do Destaque das Apresentações",
								"type" => "textarea",
								"desc" => "Coloque o texto que aparecerá abaixo da imagem do Destaque das Apresentações. ");

$woo_metaboxes[] = array (		"name" => "link_apresentacoes",
								"std" => "",
								"label" => "URL da apresentação",
								"type" => "text",
								"desc" => "Adicione um link para a apresentação. ");

} // Fim do Destaque das Apresentações

if ( get_post_type() == 'portfolio' || !get_post_type() ) {

	$woo_metaboxes[] = array (	"name" => "portfolio-image",
								"label" => "Portfolio Image",
								"type" => "upload",
								"desc" => "Upload an image or enter an URL to your portfolio image");
								
	if ( get_option('woo_resize') == "true" ) {						
		$woo_metaboxes[] = array (	"name" => "_image_alignment",
									"std" => "Center",
									"label" => "Image Crop Alignment",
									"type" => "select2",
									"desc" => "Select crop alignment for resized image",
									"options" => array(	"c" => "Center",
														"t" => "Top",
														"b" => "Bottom",
														"l" => "Left",
														"r" => "Right"));
	}

	$woo_metaboxes[] = array (  "name"  => "embed",
					            "std"  => "",
					            "label" => "Video Embed Code",
					            "type" => "textarea",
					            "desc" => "Enter the video embed code for your video (YouTube, Vimeo or similar). Will show instead of your image.");
					            
	$woo_metaboxes['lightbox-url'] = array (	
								"name" => "lightbox-url",
								"label" => "Lightbox URL",
								"type" => "text",
								"desc" => "Enter an optional URL to show in the <a href='http://www.no-margin-for-errors.com/projects/prettyphoto-jquery-lightbox-clone/'>PrettyPhoto lightbox</a> for this portfolio item.");

	$woo_metaboxes['testimonial'] = array (	
								"name" => "testimonial",
								"label" => "Testimonial",
								"type" => "textarea",
								"desc" => "Enter a testimonial from your client to be displayed on the single portfolio page");

	$woo_metaboxes['testimonial_author'] = array (	
								"name" => "testimonial_author",
								"label" => "Testimonial Author",
								"type" => "text",
								"desc" => "Enter the name of the author of the testimonial e.g. Joe Bloggs");
								
	$woo_metaboxes[] = array (	"name" => "url",
								"label" => "URL",
								"type" => "text",
								"desc" => "Enter URL of your clients site. (optional) ");
					            
} //End portfolio

if( get_post_type() == 'testimonial' || !get_post_type()){	

	$woo_metaboxes['testimonial_author'] = array (	
								"name" => "testimonial_author",
								"label" => "Testimonial Author",
								"type" => "text",
								"desc" => "Enter the name of the author of the testimonial e.g. Joe Bloggs"
			);
 
	$woo_metaboxes['testimonial_url'] = array (	
								"name" => "testimonial_url",
								"label" => "Testimonial URL",
								"type" => "text",
								"desc" => "(optional) Enter the URL to the testimonial author e.g. http://www.woothemes.com"
			);

} // End testimonial

if ( get_post_type() == 'page' || get_post_type() == 'post' || !get_post_type() ) {

	$woo_metaboxes[] = array (	"name" => "_layout",
								"std" => "normal",
								"label" => "Layout",
								"type" => "images",
								"desc" => "Select the layout you want on this specific post/page.",
								"options" => array(
										'layout-default' => $url . 'layout-off.png',
										'layout-full' => get_bloginfo( 'template_url') . '/functions/images/' . '1c.png',
										'layout-left-content' => get_bloginfo( 'template_url') . '/functions/images/' . '2cl.png',
										'layout-right-content' => get_bloginfo( 'template_url') . '/functions/images/' . '2cr.png'));

}

// Add extra metaboxes through function
if ( function_exists("woo_metaboxes_add") )
	$woo_metaboxes = woo_metaboxes_add($woo_metaboxes);
    
if ( get_option('woo_custom_template') != $woo_metaboxes) update_option('woo_custom_template',$woo_metaboxes);      

}
}



?>
