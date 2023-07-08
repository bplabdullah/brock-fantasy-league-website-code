<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// BEGIN ENQUEUE PARENT ACTION
// AUTO GENERATED - Do not modify or remove comment markers above or below:

if ( !function_exists( 'chld_thm_cfg_locale_css' ) ):
    function chld_thm_cfg_locale_css( $uri ){
        if ( empty( $uri ) && is_rtl() && file_exists( get_template_directory() . '/rtl.css' ) )
            $uri = get_template_directory_uri() . '/rtl.css';
        return $uri;
    }
endif;
add_filter( 'locale_stylesheet_uri', 'chld_thm_cfg_locale_css' );

if ( !function_exists( 'chld_thm_cfg_parent_css' ) ):
    function chld_thm_cfg_parent_css() {
        wp_enqueue_style( 'chld_thm_cfg_parent', trailingslashit( get_template_directory_uri() ) . 'style.css', array( 'wp-bootstrap-starter-custom-css' ) );
    }
endif;
add_action( 'wp_enqueue_scripts', 'chld_thm_cfg_parent_css', 10 );

// END ENQUEUE PARENT ACTION







// Custom Code



function wpb_catlist_desc($atts = []) { 
$string = '<div class = "product-cat">';
// $category_link = get_category_link( $category_id ); 
$catlist = get_terms( 'product_cat' );
if ( ! empty( $catlist ) ) {
    foreach ( $catlist as $key => $item ) {
        $down=0;
        $dbDate=get_field('date', 'term_'.$item->term_id);
        $compareDate=date('n/j/Y',strtotime(get_field('date', 'term_'.$item->term_id)));
        $todayDate = date('n/j/Y');

        $datetime1 = new DateTime($dbDate);
        $datetime2 = new DateTime();
        $interval = $datetime2->diff($datetime1);
        $difference=0;
        $todayLabel=get_field('date', 'term_'.$item->term_id);
        if($datetime1>$datetime2 || $compareDate==$todayDate){
            $difference=$interval->format('%a');
            $difference=$difference+1;    
        }
        if($compareDate==$todayDate){
            $todayLabel="Today";
			$whatTime=date("H",strtotime(get_field('time', 'term_'.$item->term_id)));
			if($whatTime>21){
				$todayLabel="At Night";
			}
		}
        $wporg_atts = shortcode_atts(
            array(
                'title' => 'Brock',
            ), $atts, //$tag
        );
        if($difference > 7){ 
            // echo 'if1';
            $down=1; 
        }



        //limited user add class and the jquery start
        global $wpdb;
        $queryTerms = "SELECT * FROM b5Kz3l6Rz_terms WHERE term_id=".$item->term_id;
        $termRow = $wpdb->get_row($queryTerms);
        $toal_user_participated = $termRow->toal_user_participated;

        $total_users = get_term_meta( $item->term_id, 'total_users', true );

        // echo '$total_users-->'.$total_users;
        // echo '$toal_user_participated-->'.$toal_user_participated;

        if (empty($total_users)) {
            $total_users = 0;
        }


        if ($total_users <= $toal_user_participated ) {
            // echo 'if';
            $limit_complete = 'limit_complete';
            
        }else{
            // echo 'else';
            $limit_complete = '';
            
        }
        //limited user add class and the jquery end





        if($down==0 && $wporg_atts['title']=='up' && $difference > 0 && $difference < 8){
            
            // echo 'if2';
            //get database time
            $getdatabaseDate = strtotime(get_field('date', 'term_'.$item->term_id));
            $databaseDate = new DateTime(date('Y-m-d', $getdatabaseDate));
            
            //get cuurent dateTime
            $currentTime= new DateTime(date('Y-m-d H:i:s'));
            $currentTime->modify('+5 hour');

            //date difference
            $date_diff = $currentTime->diff($databaseDate);
            $day = $date_diff->format('%R%d');
            $year = $date_diff->format('%R%Y');
            $month = $date_diff->format('%R%m');
            
            // echo 'day-->'.$day;
            // echo 'month-->'.$month;
            // echo 'year-->'.$year;



            $dbdate = strtotime(get_field('time', 'term_'.$item->term_id));
            $databaseTime = new DateTime(date('H:i:s', $dbdate));

            $time_diff = $currentTime->diff($databaseTime);
            
            $min = $time_diff->format('%R%i');
            $hour = $time_diff->format('%R%h');
            // echo 'hour-->'.$hour;
            // echo 'min-->'.$min;
            // echo '================';

            $event_timeend = '';
            if ($year <= 0) {
                if ($month <= 0) {
                    if ($day <= 0) {
                        if ($hour < 1) {
                            $event_timeend = 'event_time1hourend';
                            if ($min < 1) {
                                $event_timeend = 'event_timeend';
                            }
                        }
                        
                    }
                }
            }



            




            $string .= '<div class = "product-card '.$event_timeend.''.$limit_complete.'">'; 

            if ($year <= 0) {
                if ($month <= 0) {
                    if ($day <= 0) {
                        if ($hour < 1) {
                            // print_r('hour 0');
                        }else{
                               $string .=  '<a href ='. get_category_link($item->term_id) .' >';
                        }
                    }else{
                       $string .=  '<a href ='. get_category_link($item->term_id) .' >';
                    }
                }else{
                    $string .=  '<a href ='. get_category_link($item->term_id) .' >';
                }
            }else{
                $string .=  '<a href ='. get_category_link($item->term_id) .' >';
            }

           


             $thumbnail_id = get_woocommerce_term_meta($item->term_id, 'thumbnail_id', true);
             $cat_image = wp_get_attachment_url($thumbnail_id);
                $string .= "<div class = 'cat-img'><img src='{$cat_image}'/></div>";      
                $string .= '<div class = "cat-btm"><div class = "cat-title"><h3>'. $item->name . '<h3></div>';
             $string .= '<div class = "date-time"><h4>' .$todayLabel. '</h4>' ;
             $string .= '<h4> Time: '  . get_field('time', 'term_'.$item->term_id) .'</h4></div>' ;
                $string .= '<div class = "cat-desc">'. $item->description . '</div></div>';
             $string .= '<div class = "view-more">';



             if ($year <= 0) {
                if ($month <= 0) {
                    if ($day <= 0) {
                        if ($hour < 1) {
                            // print_r('hour 0');
                            $string .= '<a> View More </a>';
                        }else{
                            $string .= '<a href ='. get_category_link($item->term_id) .' > View More </a>';
                        }
                    }else{
                        $string .= '<a href ='. get_category_link($item->term_id) .' > View More </a>';
                    }
                }else{
                    $string .= '<a href ='. get_category_link($item->term_id) .' > View More </a>';
                }
            }else{
                $string .= '<a href ='. get_category_link($item->term_id) .' > View More </a>';
            }
             



            
            $string .= '<img src="'.get_template_directory_uri(). '/inc/assets/images/arrow.svg"/></div>' ;      
             $string .= '</div>';  
        }else{
            if($down==1 && $wporg_atts['title']!='up'){

                $string .= '<div class = "product-card '.$limit_complete.'">';
                    $thumbnail_id = get_woocommerce_term_meta($item->term_id, 'thumbnail_id', true);
                    $cat_image = wp_get_attachment_url($thumbnail_id);
                    $string .= "<div class = 'cat-img'><img src='{$cat_image}'/></div>";      
                    $string .= '<div class = "cat-btm"><div class = "cat-title"><h3>'. $item->name . '<h3></div>';
                    $string .= '<div class = "date-time"><h4>' . get_field('date', 'term_'.$item->term_id)  .'</h4>' ;
                    $string .= '<h4> Time: '  . get_field('time', 'term_'.$item->term_id) .'</h4></div>' ;
                    $string .= '<div class = "cat-desc">'. $item->description . '</div></div>';
                    $string .= '<div class = "view-more"><a href ='. get_category_link($item->term_id) .'> View More </a><img src="'.get_template_directory_uri(). '/inc/assets/images/arrow.svg"/></div>' ;      
                $string .= '</a></div>'; 
            }
        }
    }
}
$string .= '</div>';
  
return $string;

    
}
add_shortcode('wpb_categories', 'wpb_catlist_desc');

/**
* Disbale theme and plugin Auto update
*/

add_filter( 'auto_update_theme', '__return_false' );
    
add_filter( 'auto_update_plugin', '__return_false' );

/**
* Display category image on category archive
*/

// function wpb_catlist_descc() { 

//     $taxonomyName = "product_cat";
// //This gets top layer terms only.  This is done by setting parent to 0.  
//     $parent_terms = get_terms($taxonomyName, array('parent' => 0, 'orderby' => 'slug', 'hide_empty' => false));
//  $parent_terms = get_terms( 'product_cat' );
// if ( ! empty( $catlist ) ) {
//     echo '<ul>';
//     foreach ($parent_terms as $pterm) {

//         //show parent categories
//         echo '<li><a href="' . get_term_link($pterm->name, $taxonomyName) . '">' . $pterm->name . '</a></li>';
//      echo '<li><a href="' . get_term_link($pterm->description, $taxonomyName) . '">' . $pterm->description . '</a></li>';

//         $thumbnail_id = get_woocommerce_term_meta($pterm->term_id, 'thumbnail_id', true);
//         // get the image URL for parent category
//         $image = wp_get_attachment_url($thumbnail_id);
//         // print the IMG HTML for parent category

//     }
//     echo '</ul>';
// }
// }
// add_shortcode('wpb_categoriess', 'wpb_catlist_descc');


function webroom_add_short_description_in_product_categories() {
    global $product;
    if ( ! $product->get_short_description() ) return;
    ?>
    <div itemprop="description">
        <?php echo apply_filters( 'woocommerce_short_description', $product->get_short_description() ) ?>
    </div>
    <?php
}
add_action('woocommerce_after_shop_loop_item_title', 'webroom_add_short_description_in_product_categories', 5);



add_action( 'wp', 'ts_redirect_product_pages', 99 );
 
function ts_redirect_product_pages() {
     
    if ( !is_user_logged_in()  && is_product_category() ) {
        // update_user_meta(1,'reffer_url', 'abc');  //$_SERVER['HTTP_REFERER']
        wp_safe_redirect( home_url('/login') );
        exit;
    }
}

 
// PS. - You can replace home_url() to your specific URL also.





add_filter( 'user_registration_login_redirect', 'ur_redirect_after_login', 10, 2 ); 
function ur_redirect_after_login( $redirect, $user ) { 

    wp_safe_redirect(home_url());
    exit;

    // $currentUserID = get_current_user_id();
    // $reffer_url=get_user_meta($currentUserID,  'reffer_url', true );
    // if($reffer_url==""){
    //     wp_safe_redirect(home_url());    
    // }else{
    //     wp_safe_redirect($reffer_url);
    // }
}


function zpd_remove_wc_loop_add_to_cart_button(){
    remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
}
add_action('init','zpd_remove_wc_loop_add_to_cart_button');

/**
 * Replaces the Add To Cart button with a new button with custom text and a custom URL link
 * This will affect all products site-wide
 * You can change the style of the button by using CSS on p.zpd-wc-reserve-item-button{}
 *
 * @author Wil Brown zeropointdevelopment.com
 */
function zpd_replace_wc_add_to_cart_button() {
    global $product;

    // This adds some URL query variables that may be useful to input into a contact form - remove if not needed
    $product_link_params = sprintf( '?wc_id=%s&wc_price=%s&wc_title=%s&wc_product_link=%s',
        $product->get_id(),
        $product->get_display_price(),
        $product->get_title(),
        $product->get_permalink()
    );
    $button_text = 'Read More';
    $link = get_bloginfo( 'url' ) . '/contact' . $product_link_params;
    $href=$product->add_to_cart_url();
    if(!is_user_logged_in()){
        $href=home_url('/login');
    }

    echo '<p class="zpd-wc-reserve-item-button">';
    echo do_shortcode('<a href="' . $href .'" class="button addtocartbutton">Add to Cart</a>');
    echo '<img src="' .get_template_directory_uri(). '/inc/assets/images/arrow.svg"/>';
    echo '</p>';
}
add_action( 'woocommerce_after_shop_loop_item','zpd_replace_wc_add_to_cart_button' );
add_action( 'woocommerce_single_product_summary','zpd_replace_wc_add_to_cart_button' );


add_action( 'template_redirect', 'bbloomer_add_product_to_cart_automatically' );
   
function bbloomer_add_product_to_cart_automatically() {
           
   // select product ID
   $product_id = 21874;
           
   // if cart empty, add it to cart
   if ( WC()->cart->get_cart_contents_count() == 0 ) {
      WC()->cart->add_to_cart( $product_id );
   }
     
}


function wp_login_profile() { 
if ( is_user_logged_in() ) {
    $current_user = wp_get_current_user();
    if ( ($current_user instanceof WP_User) ) {
        echo esc_html( $current_user->display_name );
        echo get_avatar( $current_user->ID, 32 );
//         echo '<ul class = "logout-drp"><li><a href = "'. home_url() .'/wp-login.php?action=logout">Logout</a></li></ul>';
		echo '<ul class = "logout-drp"><li><a href="'. wp_logout_url( home_url() ) .'">Logout</a></li></ul>';
    }
}
}

add_shortcode('wpb_login', 'wp_login_profile');

// add_action('wp_logout','auto_redirect_after_logout');

// function auto_redirect_after_logout(){
//   wp_safe_redirect( home_url() );
//   exit;
// }


function cptui_register_my_cpts() {

    /**
     * Post Type: Weight Selection.
     */

    $labels = [
        "name" => esc_html__( "Weight Selection", "custom-post-type-ui" ),
        "singular_name" => esc_html__( "Weight Selection", "custom-post-type-ui" ),
    ];

    $args = [
        "label" => esc_html__( "Weight Selections", "custom-post-type-ui" ),
        "labels" => $labels,
        "description" => "",
        "public" => true,
        "publicly_queryable" => true,
        "show_ui" => true,
        "show_in_rest" => true,
        "rest_base" => "",
        "rest_controller_class" => "WP_REST_Posts_Controller",
        "rest_namespace" => "wp/v2",
        "has_archive" => true,
        "show_in_menu" => true,
        "show_in_nav_menus" => true,
        "delete_with_user" => false,
        "exclude_from_search" => false,
        "capability_type" => "post",
        "map_meta_cap" => true,
        "hierarchical" => true,
        "can_export" => false,
        "rewrite" => [ "slug" => "weight", "with_front" => true ],
        "query_var" => true,
        'supports' => ['title', 'editor', 'thumbnail', 'author', 'revisions', 'comments'],
        "show_in_graphql" => false,
    ];

    register_post_type( "weight", $args );
}

add_action( 'init', 'cptui_register_my_cpts' );



function cptui_register_my_taxes() {

    /**
     * Taxonomy: Weight Selection Categories.
     */

    $labels = [
        "name" => esc_html__( "Weight Category", "custom-post-type-ui" ),
        "singular_name" => esc_html__( "Weight Selection", "custom-post-type-ui" ),
    ];

    
    $args = [
        "label" => esc_html__( "Weight Selections", "custom-post-type-ui" ),
        "labels" => $labels,
        "public" => true,
        "publicly_queryable" => true,
        "hierarchical" => true,
        "show_ui" => true,
        "show_in_menu" => true,
        "show_in_nav_menus" => true,
        "query_var" => true,
        "rewrite" => [ 'slug' => 'weight_categories', 'with_front' => true, ],
        "show_admin_column" => true,
        "show_in_rest" => true,
        "show_tagcloud" => true,
        "rest_base" => "weight_categories",
        "rest_controller_class" => "WP_REST_Terms_Controller",
        "rest_namespace" => "wp/v2",
        "show_in_quick_edit" => true,
        "sort" => true,
        "show_in_graphql" => true,
    ];
    register_taxonomy( "weight_categories", [ "weight" ], $args );
}
add_action( 'init', 'cptui_register_my_taxes' );
add_action( 'init', 'my_redirect_nonmembers', 1 );



function my_redirect_nonmembers() {


    $not_allowed = array(
        "/shop/"
    );
    
    $uri = $_SERVER['REQUEST_URI'];
    foreach( $not_allowed as $check ) {
        if( strpos( strtolower( $uri ), strtolower( $check ) ) !== false) {
            wp_safe_redirect(home_url());
            exit;
        }
    }
}
add_action( 'template_redirect', 'my_redirect_nonmembers' );
function prevent_access_to_product_page(){
    global $post;
    if ( is_product() && is_user_logged_in()) {
        wp_safe_redirect( home_url() );
        exit;
    }
}

add_action('wp','prevent_access_to_product_page');

add_action( 'woocommerce_thankyou', 'bbloomer_redirectcustom');
function bbloomer_redirectcustom( $order_id ){
    $order = wc_get_order( $order_id );

    
    foreach ($order->get_items() as $item_id => $item ) {
        $product        = $item->get_product();
    }

    // to find event/ category start

        $currentUserID_event = get_current_user_id();
        $user_get_event = get_user_meta( $currentUserID_event, 'testing_event_by_click' );
        
        $events = wp_get_post_terms( $product->id, 'product_cat' );
        if (!empty($user_get_event)) {
            foreach ($events as $key => $event) {
                if ($event->term_id == $user_get_event[0]) {
                    update_user_meta( $currentUserID_event, 'event_id', $user_get_event[0] );
                }
            }
        }
    // to find event/ category end

    
            // update event toal_user_participated start

                $totalUsers = $event->toal_user_participated;
                $totalUsers++;

                global $wpdb;
                $updateQry = 'UPDATE b5Kz3l6Rz_terms SET toal_user_participated="'.$totalUsers.'" WHERE term_id='.$event->term_id;
                $updateterm = $wpdb->query($wpdb->prepare($updateQry));
                

                // print_r('totalUsers----->'.$totalUsers);
                // print_r('updateQry----->'.$updateQry.'=======');
                // print_r($events);
                // die('=====');

            // update event toal_user_participated end



        $product_salary = get_post_meta( $product->id, 'salary', true );
        $currentUserID = get_current_user_id();
        $user_update = update_user_meta( $currentUserID, 'total_salary', $product_salary );
        $user_update = update_user_meta( $currentUserID, 'left_salary', $product_salary );


    $url = home_url('/weight-selection-category');
    if ( ! $order->has_status( 'failed' ) ) {
        
        wp_safe_redirect($url);
        exit;
    }
}





function wpb_catlist() { 

    $value_exists = [];


    $_terms = get_terms( array('weight_categories') );
                echo '<div class="post-main allPost">';
	echo '<ul>';
    // echo '<pre>';
    // print_r($_terms);
    // echo '</pre>';
    foreach ($_terms as $term) :
    
        $term_slug = $term->slug;
       
            $_posts = new WP_Query( array(
                'post_type'         => 'weight',
                'posts_per_page'    => 10, //important for a PHP memory limit warning
                'tax_query' => array(
                    array(
                        'taxonomy' => 'weight_categories',
                        'field'    => 'slug',
                        'terms'    => $term_slug,
                    ),
                ),
            ));
           
            if( $_posts->have_posts() ) :
                while ( $_posts->have_posts() ) : $_posts->the_post();

                
                if (in_array($term->term_id, $value_exists)) {
                    // print_r('if');
                }else{
                    ?>
                        <li>
                            <div class="image-main">
                                <div class="bg-image">
                                    <img decoding="async" src='<?php echo get_field('image', 'term_'.$term->term_id);?>' alt="">
                                </div>
                                <div class="text-image">
                                    <p>Weight: <span><?php echo get_field('weight', 'term_'.$term->term_id);?></span></p>
                                </div>
                            </div>
                            <div class="text-div">
                                <h3><?php echo $term->name ?></h3>
                                <p><?php echo $term->description ?></p> 
                                <div class="read-more"><a class="read-btn" href ='<?php echo get_site_url().'/weight_categories/'.$term->slug;?> '>Read More <span></span> </a></div>
                            </div>
                        </li>                
                <?php
                }
                array_push($value_exists, $term->term_id);
               
                
                endwhile;
            

            endif;
            wp_reset_postdata();

        
    endforeach;

	 echo '</ul>';
     
	 echo '</div>';

  


    
    //code 2 start

    //code 2 end
}
    add_shortcode('weight_categories', 'wpb_catlist');

    function total_salary() { 
        $currentUserID = get_current_user_id();
        $total_salary = get_user_meta( $currentUserID, 'total_salary', true );
        echo '<div class = "salary_points"> Salary  $' . $total_salary . ' -  ';
        
    }
    add_shortcode('total_salary', 'total_salary');


    function left_salary(){
        $currentUserID = get_current_user_id();
        $UserSalary = get_user_meta( $currentUserID, 'left_salary', true );
        echo ' $' . $UserSalary . ' Left</div>';
    }
    add_shortcode('left_salary', 'left_salary');

    function weight(){

        global $wp;
        $current_url =  home_url( $wp->request );

        //get last value in URL
        $categoryName = basename($current_url);
        //get second last value in URL
        // $categoryName = basename(dirname($current_url));
        

        global $wpdb;
        $query = "SELECT * FROM b5Kz3l6Rz_terms WHERE slug='$categoryName'";
        $categorySlug = $wpdb->get_row($query);
        $categoryID = $categorySlug->term_id;
        
        $categoryWeight = get_term_meta( $categoryID, 'weight', true );

        print_r('Weight: '.$categoryWeight);
    }
    add_shortcode('weight', 'weight');

    function leaderboard(){
        //new page after permission start
        //leader borad all start


        $event_selected = 20;


        $users_exists_d = [];

        $users = get_users( array( 'fields' => array( 'ID' ) ) );
        foreach($users as $user){
            
            $user_evet_d = get_user_meta( $user->ID, 'event_id', true );
            
            if ($user_evet_d == $event_selected) {
                array_push($users_exists_d, $user->ID);
            }
        }

        
        $count_users_d = count($users_exists_d);
        if ($count_users_d > 0) {

            $user_points = [];

            foreach ($users_exists_d as $key => $users_d) {
                
                
                $user_players_d = get_user_meta( $users_d, 'players' , true);
                $user_players_decode_d = json_decode($user_players_d);
                
                $total_points_d = 0;
                

                foreach ($user_players_decode_d as $key2 => $player_d) {

                    $player_points_d = get_post_meta( $player_d->player_id, 'player_points', true );
                    if ($player_points_d) {
                        $player_points_d = $player_points_d;
                    }else{
                        $player_points_d = 0;
                    }
                    

                    $total_points_d = $total_points_d + $player_points_d; 
                    
                    
                }
                // print_r($total_points_d);
                
                $user_points[$key]['userID'] = $users_d;
                $user_points[$key]['totalPoints'] = $total_points_d;

            }   

            
            $user_resluts = [];
            
            foreach ($user_points as $key_point => $user_point) {
                

                $matchedID = 0;

                foreach ($users as $key_user => $user) {
                    
                    if ($matchedID != $user_point['userID']) {   

                        if ($user->id == $user_point['userID']) {
                        
                            $user_QA = get_user_meta( $user_point['userID'], 'user_QA', true );
                            $user_QA_decode = json_decode($user_QA);
                            $user_guess_points = $user_QA_decode->winning_points;

                            if ($user_guess_points) {
                                $user_guess_points = $user_guess_points;
                            }else{
                                $user_guess_points = 0;
                            }                           

                            $diff = abs($user_guess_points - $user_point['totalPoints']);



                            $user_resluts[$key_user]['userID'] = $user_point['userID'];
                            $user_resluts[$key_user]['point_difference'] = $diff;
                            $user_resluts[$key_user]['totalPoints'] = $user_point['totalPoints'];
                            $user_resluts[$key_user]['user_guess_points'] = $user_guess_points;
                            

                            $matchedID = $user_point['userID'];
                        }

                    }
                }
            }


            
            foreach ($user_resluts as $result) {
                $point_difference[] = $result['point_difference'];
            }
        
            array_multisort($point_difference,SORT_ASC,$user_resluts);
            // echo '<pre>',print_r($user_resluts),'</pre>';
            

            ?>
            <table class="tg">
            <colgroup>
                <col style="width: 200px">
                <col style="width: 350px">
                <col style="width: 300px">
            </colgroup>
            <thead>
                <tr>
                    <th class="tg-zv4m">Ranks</th>
                    <th class="tg-zv4m">Users</th>
                    <th class="tg-zv4m">Score points</th>
                    <th class="tg-zv4m">Guess points</th>
                    <th class="tg-zv4m">Difference points</th>
                </tr>
            </thead>
            <tbody>
        <?php
        
        
        foreach ($user_resluts as $key_user_reslut => $user_reslut) {
            
            $username_byID = get_user_meta( $user_reslut['userID'], 'first_name', true );
            
            ?>
                <tr>
                    <td class="tg-zv4m"><?php print_r($key_user_reslut+1); ?></td>
                    <td class="tg-zv4m"><?php print_r($username_byID); ?></td>
                    <td class="tg-zv4m"><?php print_r($user_reslut['totalPoints']); ?></td>
                    <td class="tg-zv4m"><?php print_r($user_reslut['user_guess_points']); ?></td>
                    <td class="tg-zv4m"><?php print_r($user_reslut['point_difference']); ?></td>
                </tr>
            <?php
            
        }
        ?>
                </tbody>
            </table>
        <?php



        }

        //leader borad all end 
    //new page after permission end
    }
    add_shortcode('leaderboard','leaderboard');


    //all events in leaderboard start 
    function events_on_leaderboard(){
        
        ?>
        
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
        <script>
            jQuery( document ).ready(function() {
                
                
                jQuery('.check_result').click(function(){
                    
                    var eventID= jQuery(this).attr('class').split(' ')[0];
                    jQuery('.loader-bg2').css('display','flex');
                    // alert(eventID);

                    var data = {
                        'action': 'leaderboard_ajax',
                        'eventID' : eventID
                    };

                    jQuery.post(ajaxurl, data, function(response){
                        var res = jQuery.parseJSON(response);

                        if (res.status == 'admin_status0') {

                            if (res.count_record == 0) {
                                jQuery('.uploadResult').hide(); 
                                jQuery('.winning_team').hide();   
                                jQuery('.nouser').show(); 
                            }else{
                                jQuery('.uploadResult').show();
                                jQuery('.winning_team').show();
                            }
                            jQuery('.loader-bg2').hide();
                            jQuery('.product-cat').hide();
                            jQuery('.uploadResult').addClass(res.eventID);
                            jQuery('.learderboard_back').show();
                        }else if(res.status == 'admin_status1'){
                            jQuery('.product-cat').hide();
                            getResults(res.eventID);
                        }else if(res.status == 'user_status0'){
                            jQuery('.loader-bg2').hide();
                            jQuery('.product-cat').hide();
                            jQuery('.resultnotupdated').show();
                            jQuery('.learderboard_back').show();
                        }else if(res.status == 'user_status1'){
                            jQuery('.product-cat').hide();
                            getResults(res.eventID);
                            
                        }else{
                            jQuery('.loader-bg2').hide();
                            alert('ajex error');
                        }
                        
                    });
                });


                jQuery('.uploadResult').click(function(){
                    var eventID= jQuery(this).attr('class').split(' ').pop();
                    var winning_team = jQuery('.winning_team').val();
                    
                    if (winning_team == '') {
                        alert('Winning team name is required');
                        return;
                    }

                    var data = {
                        'action': 'uploadResult_ajax',
                        'eventID': eventID,
                        'winning_team': winning_team,
                    };
                    jQuery.post(ajaxurl, data, function(response){
                        var res = jQuery.parseJSON(response);

                        if (res.status == 'result_updated_1') {
                            getResults(res.eventID);
                            jQuery('.uploadResult ').hide();
                            jQuery('.winning_team').hide();
                            alert('Result uploaded successfully');
                        }else if(res.status == 'error_on_update'){
                            alert('Result not updated, due to some error');
                        }
                    });
                });



                function getResults(eventID_history){
                    jQuery('.loader-bg2').css('display','flex');
                    // alert(eventID_history);
                    
                    var data = {
                        'action': 'getResultsajax',
                        'eventID': eventID_history,
                    };
                    jQuery.post(ajaxurl, data, function(response) {
                        var res = jQuery.parseJSON(response);
                        if (res.status == 'recordFetched') {
                        
                                var count = 1;
                                jQuery(".leaderboard-table tbody").empty();
                                jQuery.each( res.record, function( i, val ) {

                                var row = `<tr>
                                            <td class="tg-zv4m">${count}</td>
                                            <td class="tg-zv4m">${val.userName}</td>
                                            <td class="tg-zv4m">${val.totalPoints}</td>
                                        </tr>`
                                
                                        // <td class="tg-zv4m">${val.user_guess_points}</td>
                                        //     <td class="tg-zv4m">${val.point_difference}</td>

                                jQuery(".leaderboard-table tbody").append(row);
                                    
                                count++;

                                });

                                jQuery('.leaderboard-table').show();
                                jQuery('.learderboard_back').show();
                                jQuery('.loader-bg2').hide();
                            // console.log();
                        }
                        else if(res.status == 'no_record'){
                            jQuery('.nouser').show();
                            jQuery('.learderboard_back').show();
                            jQuery('.loader-bg2').hide();
                            
                            
                        }
                    });
                }


                jQuery('.learderboard_back').click(function(){
                    jQuery('.leaderboard-table').hide();
                    jQuery('.learderboard_back').hide();
                    jQuery('.nouser').hide();
                    jQuery('.product-cat').show();
                    jQuery('.uploadResult').hide();   
                    jQuery('.winning_team').hide();
                    jQuery('.resultnotupdated').hide();
                    
                });

            });
        </script>
    <?php





        $string = '<div class = "product-cat">';
    $catlist = get_terms( 'product_cat' );
    if ( ! empty( $catlist ) ) {
        foreach ( $catlist as $key => $item ) {
    
            // echo '<pre>';
            // print_r($item->term_id);
            // echo '</pre>';

            $string .= '<div class = "product-card"><a class="'.$item->term_id.' check_result">';
                 $thumbnail_id = get_woocommerce_term_meta($item->term_id, 'thumbnail_id', true);
                 $cat_image = wp_get_attachment_url($thumbnail_id);
                     $string .= "<div class = 'cat-img'><img src='{$cat_image}'/></div>";      
                    $string .= '<div class = "cat-btm"><div class = "cat-title"><h3>'. $item->name . '<h3></div>';
                    $string .= '<div class = "cat-desc">'. $item->description . '</div></div>';
                 $string .= '<div class = "view-more"><a class="'.$item->term_id.' check_result"> Check Result </a><img src="'.get_template_directory_uri(). '/inc/assets/images/arrow.svg"/></div>' ;      
                $string .= '</div>'; 
        }
    }
    $string .= '</div>';
      
    return $string;




    }
    add_shortcode('events_on_leaderboard','events_on_leaderboard');
    //all events in leaderboard end



// all events on leaderboard show start
    add_action('wp_ajax_leaderboard_ajax','leaderboard_ajax');
    function leaderboard_ajax(){

        $eventID = $_POST['eventID'];
        

        global $wpdb;
        $query = "SELECT * FROM b5Kz3l6Rz_terms WHERE term_id='$eventID'";
        $event_row = $wpdb->get_row($query);
        $eventStatus = $event_row->status;


        $query_history = "SELECT * FROM b5Kz3l6Rz_events_histories WHERE event_id='$eventID'";
        $record_exists = $wpdb->get_results($query_history);
        $count_record = count($record_exists);


        if( current_user_can('editor') || current_user_can('administrator') ) {  

            if ($eventStatus == 0) {
                $res = [
                    'status' => 'admin_status0',
                    'eventID' => $eventID,
                    'count_record' => $count_record
                ];
            }else if($eventStatus == 1){
                $res = [
                    'status' => 'admin_status1',
                    'eventID' => $eventID
                ];
            }
            
            $result = json_encode($res);
            print_r($result);
            wp_die();
        }else{

            if ($eventStatus == 0) {
                $res = [
                    'status' => 'user_status0',
                    'eventID' => $eventID
                ];
            }else if($eventStatus == 1){
                $res = [
                    'status' => 'user_status1',
                    'eventID' => $eventID
                ];
            }

            $result = json_encode($res);
            print_r($result);
            wp_die();
        }

    }
// all events on leaderboard show end


//admin button upload result ajax start
    add_action('wp_ajax_uploadResult_ajax','uploadResult_ajax');
    function uploadResult_ajax(){


        $eventID = $_POST['eventID'];
        $winning_team = strtolower($_POST['winning_team']);


        global $wpdb;
        $updateQueary = 'UPDATE b5Kz3l6Rz_terms SET status="1", winning_team="'.$winning_team.'" WHERE term_id='.$eventID;
        $updatetermStatus = $wpdb->query($wpdb->prepare($updateQueary));
        
        if ($updatetermStatus) {
            $res = [
                'status' => 'result_updated_1',
                'eventID' => $eventID
            ];

        }else{
            $res = [
                'status' => 'error_on_update',
                'eventID' => $eventID
            ];
        }
        $result = json_encode($res);
        print_r($result);
        wp_die();

    }
//admin button upload result ajax end

//after admin upload result ajax start
    add_action('wp_ajax_getResultsajax','getResultsajax');
    function getResultsajax(){
        
        $event_selected = $_POST['eventID'];
                
        global $wpdb;

        $query = "SELECT * FROM b5Kz3l6Rz_events_histories WHERE event_id='$event_selected'";
        $record_exists = $wpdb->get_results($query);

        $query_events = "SELECT * FROM b5Kz3l6Rz_terms WHERE term_id=".$event_selected;
        $winning_team_row = $wpdb->get_row($query_events);
        $winning_team = $winning_team_row->winning_team;
        // print_r($winning_team);
        // die('=');

        $count_record = count($record_exists);
        if ($count_record > 0) {

            $user_points = [];
            foreach ($record_exists as $key_record => $record) {
                
                $userID = $record->user_id;
                $userName = get_user_meta($userID, 'first_name', true);

                $players = $record->players;
                $players_decode = json_decode($players);
                
                $total_points = 0;
                
                

                foreach ($players_decode as $key2 => $player) {

                    $player_points = get_post_meta( $player->player_id, 'player_points', true );
                    if ($player_points) {
                        $player_points = $player_points;
                    }else{
                        $player_points = 0;
                    }
                    
                    $total_points = $total_points + $player_points; 
                    
                }
                $total_points = $total_points;
                
                
                $user_QA_decode = json_decode($record->user_QA);

                $user_guess_points = $user_QA_decode->winning_points;
                $user_guess_team = $user_QA_decode->team_win;
                
    
                if ($user_guess_points) {
                    $user_guess_points = $user_guess_points;
                }else{
                    $user_guess_points = 0;
                }
                $diff = abs($user_guess_points - $total_points);
                             
                
                $user_resluts[$key_record]['userName'] = $userName;
                $user_resluts[$key_record]['point_difference'] = $diff;
                $user_resluts[$key_record]['totalPoints'] = $total_points;
                $user_resluts[$key_record]['user_guess_points'] = $user_guess_points;
                $user_resluts[$key_record]['user_guess_team'] = $user_guess_team;

                if ($user_guess_team == $winning_team) {
                    $user_resluts[$key_record]['user_guess_team_matched'] = 1;
                }else{
                    $user_resluts[$key_record]['user_guess_team_matched'] = 0;
                }
            } 


            foreach ($user_resluts as $result) {
                $totalPoints[] = $result['totalPoints'];
                $point_difference[] = $result['point_difference'];
                $team_matched[] = $result['user_guess_team_matched'];
            }
            // array_multisort($totalPoints,SORT_DESC,$user_resluts);
            // array_multisort($totalPoints, SORT_DESC, $point_difference, SORT_ASC, $user_resluts);
            array_multisort($totalPoints, SORT_DESC, $team_matched, SORT_DESC, $point_difference, SORT_ASC, $user_resluts);

            // print_r($user_resluts);
            // die();
            $res = [
                'status' => 'recordFetched',
                'record' => $user_resluts
            ];

            $result = json_encode($res);
            print_r($result);
            wp_die();

        }else{
            $res = [
                'status' => 'no_record',
                'count_record' => $count_record
            ];
            $result = json_encode($res);
            print_r($result);
            wp_die();
        }

    }
//after admin upload result ajax end


    function getplayersajax(){

        
        $currentUserID = get_current_user_id();
        $players = get_user_meta( $currentUserID, 'players', true );

        if (empty($players)) {
            print_r('[]');
        }else{
            print_r($players);
        }
        wp_die();

        
    }
    add_action('wp_ajax_getplayersajax', 'getplayersajax');



    //main ajax
    add_action( 'wp_ajax_my_action', 'my_action' );
    function my_action() {
        global $wpdb; 

        $player_price = intval( $_POST['player_price'] );
        $player_ID = intval( $_POST['player_ID'] );
        $type = $_POST['type'];
        
        $categorySlug = $_POST['categorySlug'];
        $query = "SELECT * FROM b5Kz3l6Rz_terms WHERE slug='$categorySlug'";
        $categorySlug_row = $wpdb->get_row($query);
        $categoryID = $categorySlug_row->term_id;



        $currentUserID = get_current_user_id();
        $user_leftsalary = get_user_meta( $currentUserID, 'left_salary', true );
        
        

        $existplayers = get_user_meta( $currentUserID, 'players', true );
        

        if ($existplayers) {
            $players = json_decode($existplayers);
            $count_players = count($players);
            // $players_final = [];


            if ($type == 'plus') {
                if ($count_players >= 10) {
                    $res = [
                        'status' => '10_players_completed',
                    ];
                    $result = json_encode($res);
                    print_r($result);
                    wp_die();
                }
            }else if($type == 'minus'){
                
            }

            
        }else{
            $players = [];
        }
        

        if ($count_players <= 10) {
            
            //check category already selected start  
            if ($type == 'plus') {
                foreach ($players as $key => $player) {
                    
                    if ($categoryID == $player->category_id) {
                        $res = [
                            'status' => 'category_alreay_exists'
                        ];
                        $result = json_encode($res);
                        print_r($result);
                        wp_die();
                    }
                }
            }
            //check category already selected end
            

            if ($user_leftsalary >= $player_price) {
                if ($type == 'plus') {
                    $finalsalary = $user_leftsalary - $player_price;    
                }else if($type == 'minus'){
                    $finalsalary = $user_leftsalary + $player_price;
                }

                

                $user_update = update_user_meta( $currentUserID, 'left_salary', $finalsalary);
                if ($user_update) {
                  
                    if ($type == 'plus') {
                        $player = ['player_id' => $player_ID, 'category_id'=>$categoryID];
                        array_push($players, $player);
                        $jsonplayer = json_encode($players);
                        
                        update_user_meta( $currentUserID, 'players', $jsonplayer); 
                    }else if($type == 'minus'){
                        $minus_totalplayers = get_user_meta( $currentUserID, 'players', true );
                        $minus_decodeplayers = json_decode($minus_totalplayers);
                        
                        
                        
                        foreach ($minus_decodeplayers as $key => $minus_players) {
                            
                            
                           

                            if ($player_ID == $minus_players->player_id) {

                                // unset($minus_decodeplayers[$key]);
                                array_splice($minus_decodeplayers, $key, 1);
                                
                            }
                            
                        }
                        


                        $jsonplayer = json_encode($minus_decodeplayers);
                        update_user_meta( $currentUserID, 'players', $jsonplayer); 


                        

                    }
                 
    
                    // check player == 10
                    $checkplayers_forLimit = get_user_meta( $currentUserID, 'players', true );
                    $players_forLimit = json_decode($checkplayers_forLimit);
                    $count_players_forLimit = count($players_forLimit);
                    // $count_players_forLimit = 3;


                    if ($type == 'plus') {
                        if ($count_players_forLimit > 10) {
                            $res = [
                                'status' => 'players_completed',
                            ];
                        }else{
                           
                            $res = [
                                'status' => 'player_added',
                                'count_players' => $count_players_forLimit
                            ];
                        }    
                    }else if($type == 'minus'){
                        $res = [
                            'status' => 'player_remove',
                            'count_players' => $count_players_forLimit
                        ];
                    }

                    
                   
                    $result = json_encode($res);
                    print_r($result);
                    wp_die();
    
                }else{
    
                    $res = [
                        'status' => 'failed'
                    ];
                    $result = json_encode($res);
                    print_r($result);
                    wp_die();
    
    
                }
            }else{
    
                $res = [
                    'status' => 'player_amount_less'
                ];
                $result = json_encode($res);
                print_r($result);
                wp_die();
            }
        }
        
        wp_die(); 
    }

    function footer() {
     
        ?>
        


        <div class="loader-bg2">
                <div class="loader2"></div>
            </div>
        <?php

        
        global $wp;
        $current_url =  home_url( $wp->request );
        $categorySlug = basename($current_url);

        global $wpdb;
         $query = "SELECT * FROM b5Kz3l6Rz_terms WHERE slug='$categorySlug'";
        $categorySlug_row = $wpdb->get_row($query);
        if ($categorySlug_row) {
            $categoryID = $categorySlug_row->term_id;
        }
	

		if(isset($categoryID)){
			
        ?>
        <div class="loader-bg">
            <div class="loader"></div>
        </div>
            <script>
                jQuery( document ).ready(function() {

                


                    jQuery('.plus, .minus').click(function() {


                        jQuery('.loader-bg').css('display','flex');

                        var fullclass = jQuery(this).attr('class');
                        var minusexists = fullclass.includes('minus');
                        var plusexists = fullclass.includes('plus');
                        if (minusexists == true) {
                            var player_price = jQuery(this).prev().text();
                            var type = 'minus';
                        }else if(plusexists == true){
                            var player_price = jQuery(this).next().text();
                            var type = 'plus';
                        }
                        
       
                        
                        var myClass = jQuery(this).attr('class');
                        var player_ID = myClass.split(' ')[0];
                        
                        
                        var categorySlug = '<?php echo $categorySlug; ?>';
                        
       
                        var data = {
                            'action': 'my_action',
                            'player_price': player_price,
                            'player_ID': player_ID,
                            'categorySlug': categorySlug,
                            'type': type,
                        };
                        
                        // since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
                        jQuery.post(ajaxurl, data, function(response) {
                            var res = jQuery.parseJSON(response);
                            // alert(response);
                            // alert(res.players_list[0].Name);
                            if (res.status == 'player_added') {
                                if (res.count_players == 10) {
                                    alert('player added successfully, your total players are '+res.count_players+', please processed by click on View Players List button');
                                    location.reload(); 
                                    setTimeout(() => {
                                        getplayers(); 
                                        jQuery('.loader-bg').hide();
                                    }, 5000);
                               
                                }else{
                                    getplayers(); 
                                    jQuery('.loader-bg').hide();
                                    alert('player added successfully, your total players are '+res.count_players);
                                }
                                

                            }else if(res.status == 'player_amount_less') {
                                jQuery('.loader-bg').hide();
                                alert('Price of your selected player is higher then your remaining salary.');    
                            }
                            else if(res.status == '10_players_completed') {
                                jQuery('.loader-bg').hide();
                                alert('You have successfully completed your team please processed by click on View Players List button.');
                                jQuery('.show_model').show(); 
                            }
                            else if(res.status == 'players_completed') {
                                getplayers();
                                location.reload();
                                jQuery('.loader-bg').hide();
                                jQuery('.show_model').show();
                                // elementorProFrontend.modules.popup.showPopup( { id: 581 } );
                                // alert('your team is completed'); 
                            }else if (res.status == 'player_remove') {
                                getplayers();
                                // location.reload();
                                jQuery('.loader-bg').hide();
                                jQuery('.show_model').hide();
                                alert('player remove successfully, your total players are '+res.count_players);
                            }else if (res.status == 'category_alreay_exists') {
                                getplayers();
                                jQuery('.loader-bg').hide();
                                alert('You have already selected 1 player from this category, kindly choose different category player.');
                            }

                            
                            
                            else{
                                jQuery('.loader-bg').hide();
                                alert('error in ajax');
                            }
                            
                        });
			
                        
                    });

                    
                    getplayers();
                    
                  
                        
                        function getplayers(){

                            var data = {
                                'action': 'getplayersajax',
                            };
                            jQuery.post(ajaxurl, data, function(response) {
                                
                                jQuery('.plus').show();
                                jQuery('.minus').hide();

                                var res = jQuery.parseJSON(response);
                                
                                    
                                jQuery(".plus").each(function() {


                                    var getclass = jQuery(this).attr('class');
                                    var getplayerID = getclass.split(' ')[0];
                                    var getplayerID_int = parseInt(getplayerID, 10);

                                    var player_count  = res.length;
                                    
                                    if (player_count >= 10) {
                                        jQuery('.show_model').show();
                                    }

                                    if (player_count > 0) {
                                        
                                        jQuery.each(res , function(index, val) { 
                                            
                                            var categoryID = '<?php echo $categoryID; ?>';
                                            
                                            var cat  = val['category_id'];
                                            // console.log('cat'+cat+'=========='+categoryID);
                                            if (cat == categoryID ) {

                                                // console.log(getplayerID_int+'=='+val['player_id']);

                                                if (val['player_id'] == getplayerID_int) {
                                                    // console.log('if'+getplayerID_int);
                                                    jQuery('.plus.'+getplayerID_int).next().prop('disabled', false);
                                                    jQuery('.minus.'+getplayerID_int).show();
                                                    jQuery('.plus.'+getplayerID_int).hide();
                                                    
                                                }else{
                                                    // console.log('else'+getplayerID_int);
                                                    jQuery('.plus.'+getplayerID_int).next().prop('disabled', true);
                                                    jQuery('.minus.'+getplayerID_int).hide();
                                                    jQuery('.plus.'+getplayerID_int).hide();
                                                }
                                               
                                            }else{
                                                    // jQuery('.plus.'+getplayerID_int).show();
                                                    // jQuery('.minus.'+getplayerID_int).hide();
                                                

                                            }
                                        });


                                    }else{
                                        jQuery('.plus.'+getplayerID_int).next().prop('disabled', false);
                                        jQuery('.minus.'+getplayerID_int).hide();
                                        jQuery('.plus.'+getplayerID_int).show();
                                    }

                                    
                                }); 
                            });
                        }
                });



            </script>
        <script>
            jQuery(function(){
                jQuery('.elementor-widget.elementor-widget-theme-archive-title h1.elementor-heading-title').each(function(){
                text = jQuery(this).text();
                textSplit = text.split(':');
                jQuery(this).text(textSplit[1]);
            });
            });
        </script>


        <!-- Q/A table hide when step 2 form -->
        <script>
            jQuery(document).on('gform_page_loaded', function(event, form_id, current_page){
                if (current_page == 2) {
                    jQuery('.tg').hide();
                    jQuery('.your-team').hide();
                }
                if (current_page == 1) {
                    jQuery('.tg').show();
                    jQuery('.your-team').show();
                }
                
            });
        </script>



                <?php






    //get event/ category slug from url for product page start 
        global $wp;
        $current_url_event =  home_url( $wp->request );
        if (str_contains($current_url_event, 'current-event')) {

            $event_urlSlug_event = basename($current_url_event);
        
            $query_event = "SELECT * FROM b5Kz3l6Rz_terms WHERE slug='$event_urlSlug_event'";
            $eventSlug = $wpdb->get_row($query_event);
            $eventID = $eventSlug->term_id;

            $currentUserID_event = get_current_user_id();
            $user_update_event = update_user_meta( $currentUserID_event, 'testing_event_by_click', $eventID );
        




            //products hide when user already buy product start
                // GET CURR USER
                $current_user = wp_get_current_user();
                if ( 0 == $current_user->ID ) return;
               
                // GET USER ORDERS (COMPLETED + PROCESSING)
                $customer_orders = get_posts( array(
                    'numberposts' => -1,
                    'meta_key'    => '_customer_user',
                    'meta_value'  => $current_user->ID,
                    'post_type'   => wc_get_order_types(),
                    'post_status' => array_keys( wc_get_is_paid_statuses() ),
                ) );
               
                // LOOP THROUGH ORDERS AND GET PRODUCT IDS
                if ( ! $customer_orders ) return;
                $product_ids = array();
                foreach ( $customer_orders as $customer_order ) {
                    $order = wc_get_order( $customer_order->ID );
                    $items = $order->get_items();
                    foreach ( $items as $item ) {
                        $product_id = $item->get_product_id();
                        $product_ids[] = $product_id;
                    }
                }
                $product_ids = array_unique( $product_ids );
                $product_ids_str = implode( ",", $product_ids );
               
                // PASS PRODUCT IDS TO PRODUCTS SHORTCODE
                // print_r($product_ids_str);

                $terms = get_the_terms ( $product_ids_str, 'product_cat' );
                foreach ( $terms as $term ) {
                    $cat_id = $term->term_id;

                    if ($cat_id == $eventID) {
                        ?>
                            <script>
                                jQuery(window).on('load', function () {
                                        jQuery('.packages_ava').hide();
                                        jQuery('.already_subscribed').show();
                                        jQuery('.click_event').show();
                                    
                                });
                            </script>
                        <?php
                    }
                }
            //products hide when user already buy product end
        }
    //get event/ category slug from url for product page end




		} /* End Term Condition */


            
            global $wp;
            $current_url_category =  home_url( $wp->request );

            if (str_contains($current_url_category, 'weight-selection-category')) {
                $userID = get_current_user_id();
                $user_eventID = get_user_meta($userID, 'event_id', true);
                // print_r($user_eventID);
                // die('=');    
                
                global $wpdb;
    
                $query = "SELECT * FROM b5Kz3l6Rz_events_histories WHERE user_id='$userID' AND event_id='$user_eventID'";
                $record_exists = $wpdb->get_results($query);
                
                if ($record_exists) {
                    ?>
                        <script>
                            jQuery(document).ready(function(){
                                jQuery('.salary_points, .allPost').hide();
                                jQuery('.team_completed').show();
                                jQuery('.btn_leadrbrd').show();
                                
                                
                            })
                        </script>
                    <?php
                    
                }else{
                    ?>
                        <script>
                            jQuery('.salary_points, .allPost').show();
                            jQuery('.team_completed').hide();
                            jQuery('.btn_leadrbrd').hide();
                        </script>
                    <?php
                }


    
            }
    //frontend jquery start
    ?>
    <script>
        jQuery("th.product-name").text("Event");
		jQuery("td.product-name").attr("data-title").text("Event");
        jQuery("a.button.addtocartbutton").text("View More");
    </script>
    <?php
    //frontend jquery end


    //main page jquery if hour < 0 the disabled jquery start
    ?> 
    <script>
        jQuery('.event_time1hourend').click(function(){
            alert('Regrets ! The event is closed, You can not participate now.'); 
        });
        
    </script>
    <?php
    //main page jquery if hour < 0 the disabled jquery end
        

    // main page jquery if event user > participated users jquery start
    ?>
        <script>
            jQuery('.limit_complete').click(function(){
                jQuery(this).children('a').removeAttr("href"); 
                jQuery(this).children('a').next('.view-more').children('a').removeAttr("href"); 
                alert('This event reached its maximum number of users, so you can not participate in this event.');
            });
        </script>
    <?php
    // main page jquery if event user > participated users jquery start
    }



    add_action('wp_footer', 'footer');




  


function players_list(){
    $currentUserID = get_current_user_id();
    $playersAll = get_user_meta( $currentUserID, 'players', true );
    $players = json_decode($playersAll);	
	
	
	if(is_array($players)){
		
		$count_players = count($players);
    if ($count_players <= 10) {
       ?>
            <div class="your-team">
                <h2>Your Team</h2>
            </div>
            <table class="tg">
            <colgroup>
                <col style="width: 200px">
                <col style="width: 350px">
                <col style="width: 300px">
            </colgroup>
            <thead>
                <tr>
                    <th class="tg-zv4m">S.no.</th>
                    <th class="tg-zv4m">Wrestlers</th>
                    <th class="tg-zv4m">Prices</th>
                </tr>
            </thead>
            <tbody>
        <?php
        
        foreach ($players as $key => $player) {
                    
            $player_details = get_post( $player->player_id);
            $player_name = $player_details->post_title;

            $player_price = get_post_meta( $player->player_id, 'cost_price', true );


            ?>
                <tr>
                    <td class="tg-zv4m"><?php print_r($key+1); ?></td>
                    <td class="tg-zv4m"><?php print_r($player_name); ?></td>
                    <td class="tg-zv4m"><?php print_r('$'.$player_price); ?></td>
                </tr>
            <?php
            
        }
        ?>
                </tbody>
            </table>
        <?php
    	}
	}
}
add_shortcode('players_list', 'players_list');



function wpb_player_list() { 
$_terms = get_terms( array('weight_categories') );

// echo '<ul class="main-list" '. $term_slug . '">';

        global $wp;
        $current_url =  home_url( $wp->request );
        $categoryName = basename($current_url);

foreach ($_terms as $term) :

    if ($term->slug == $categoryName) {
    $term_slug = $term->slug;
    $term_id = $term->term_id;
    $_posts = new WP_Query( array(
                'post_type'         => 'weight',
                'posts_per_page'    => 8, //important for a PHP memory limit warning
				'post_status' => 'publish',
				'order' => 'ASC',
                'tax_query' => array(
                    array(
                        'taxonomy' => 'weight_categories',
                        'field'    => 'slug',
                        'terms'    => $term_slug,
                    ),
                ),
            ));

    if( $_posts->have_posts() ) :

        while ( $_posts->have_posts() ) : $_posts->the_post();
        ?>
			  <li class="list-box">
				<div class = "players-lists">
					<div class = "players-name">
					   <p>Name</p>
					   <h2 class="playerName"><?php the_title(); ?></h2>
					</div>
                	<div class = "players-price-bnt">
						<?php $post_id = get_the_ID();?>
						<span  class = "<?php  echo $post_id.' ' .$term_slug;?> plus add" style="display: none">+</span><button class="btnprice"><?php the_field('cost_price');?></button><span class = "<?php  echo $post_id.' ' .$term_slug;?> minus less" style="display:none">-</span>
                        
					</div>
				</div>
            </li>
        <?php
        endwhile;

    endif;
    wp_reset_postdata();

    }

    
endforeach;
	echo '</ul>';
}
add_shortcode('player_list', 'wpb_player_list');

// Disables the block editor from managing widgets in the Gutenberg plugin.
add_filter( 'gutenberg_use_widgets_block_editor', '__return_false', 100 );

// Disables the block editor from managing widgets. renamed from wp_use_widgets_block_editor
add_filter( 'use_widgets_block_editor', '__return_false' );




add_action( 'gform_after_submission', 'set_post_content', 10, 2 );
function set_post_content( $entry, $form ) {

    //gravity form submit Q/A by user start 
        $post = get_post( $entry['post_id'] );
    
        $arr = [
            'team_win' => strtolower(rgar( $entry, '3' )),
            'winning_points' => rgar( $entry, '12' ),
            'description' => rgar( $entry, '5' )
        ];
        $arr_encode = json_encode($arr);

        $currentUserID = get_current_user_id();
        $userUpdate = update_user_meta( $currentUserID, 'user_QA', $arr_encode );
    //gravity form submit Q/A by user end


    if ($userUpdate) {
        
        // $currentUserID = get_current_user_id();
        $eventID = get_user_meta($currentUserID, 'event_id', true);
        $players = get_user_meta($currentUserID, 'players', true);
        $user_QA = $arr_encode;



        global $wpdb;
        $table_name = $wpdb->prefix . 'events_histories';

        $row_inserted = $wpdb->insert( 
            $table_name, 
            array( 
                'user_id' => $currentUserID, 
                'event_id' => $eventID, 
                'players' => $players, 
                'user_QA' => $user_QA, 
            ) 
        );

        if ($row_inserted) {
            
            update_user_meta( $currentUserID, 'players', '' );
            update_user_meta( $currentUserID, 'user_QA', '' );
            update_user_meta( $currentUserID, 'total_salary', '' );
            update_user_meta( $currentUserID, 'left_salary', '' );
        }
    }
    
}


add_filter( 'woocommerce_add_to_cart_validation', 'bbloomer_only_one_in_cart', 9999, 2 );
   
function bbloomer_only_one_in_cart( $passed, $added_product_id ) {
   wc_empty_cart();
   return $passed;
}


add_action( 'init', 'cp_change_post_object' );
// Change dashboard Posts to Events
function cp_change_post_object() {
    $get_post_type = get_post_type_object('product');
    $labels = $get_post_type->labels;
        $labels->name = 'Events';
        $labels->singular_name = 'Events';
        $labels->add_new = 'Add Events';
        $labels->add_new_item = 'Add Events';
        $labels->edit_item = 'Edit Events';
        $labels->new_item = 'Events';
        $labels->view_item = 'View Events';
        $labels->search_items = 'Search Events';
        $labels->not_found = 'No Events found';
        $labels->not_found_in_trash = 'No Events found in Trash';
        $labels->all_items = 'All Events';
        $labels->menu_name = 'Events';
        $labels->name_admin_bar = 'Events';
}
