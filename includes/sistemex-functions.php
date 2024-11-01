<?php
/*
 * Add my new menu to the Admin Control Panel
 */
 
// Add a new top level menu link to the ACP

// Hook the 'admin_menu' action hook, run the function named 'mfp_Add_My_Admin_Link()'
add_action('admin_menu', 'menu_sistemex' );
add_action('init', 'sistemex_createTable' );
add_action('init', 'sistemex_create_table2' );
add_filter( 'the_content', 'add_banner_abajo');
add_filter( 'the_content', 'add_banner_medio');
add_action('init', 'sistemex_create_table' );
add_filter( 'the_content', 'my_the_content_filter_replace_keyword');
add_action( 'add_meta_boxes', 'sistemex_featured_meta' );
add_action( 'save_post', 'sistemex_meta_save' );
add_action('quick_edit_custom_box',  'shiba_add_quick_edit', 10, 2);
add_filter('manage_post_posts_columns', 'shiba_add_post_columns');
// Add to our admin_init function
add_action('manage_posts_custom_column', 'shiba_render_post_columns', 10, 2);
add_action('bulk_edit_custom_box',  'shiba_add_quick_edit2', 10, 2);




function menu_sistemex()
{
 add_menu_page(
 'Sistemex Inbound', // Title of the page
 'Sistemex Inbound', // Text to show on the menu link
 'manage_options', // Capability requirement to see the link
 plugin_dir_path(__FILE__) . '/sistemex-inbound-dashboard.php',
 '',
 plugins_url('imagenes/iconSistemex.png', __FILE__).'"  width="20px"'
 // The 'slug' - file to display when clicking the link
 );
add_submenu_page(null,'Inicio', 'Inicio',  'manage_options',plugin_dir_path(__FILE__) . '/sistemex-inbound-dashboard.php');
add_submenu_page(plugin_dir_path(__FILE__).'/sistemex-inbound-dashboard.php','P/S & BJ', 'P/S & BJ',  'manage_options',plugin_dir_path(__FILE__) . '/sistemex-inbound-table-ps-by.php');
add_submenu_page(plugin_dir_path(__FILE__).'/sistemex-inbound-dashboard.php','Banners', 'Banners',  'manage_options',plugin_dir_path(__FILE__) . '/sistemex-inbound-table-banners.php');
add_submenu_page(plugin_dir_path(__FILE__).'/sistemex-inbound-dashboard.php','CTAs', 'CTAs',  'manage_options',plugin_dir_path(__FILE__) . '/sistemex-inbound-table.php');
add_submenu_page(plugin_dir_path(__FILE__).'/sistemex-inbound-dashboard.php','Keywords', 'Keywords',  'manage_options',plugin_dir_path(__FILE__) . '/sistemex-interlinking-table.php');
add_submenu_page(null,'Insercción de Keyword', 'Insercción de Keyword',  'manage_options',plugin_dir_path(__FILE__) . '/mfp-first-page.php');
add_submenu_page(null,'Editar Keyword', 'Editar Keyword',  'manage_options',plugin_dir_path(__FILE__) . '/sistemex-inbound-interlinking-page-edit.php');

add_submenu_page(plugin_dir_path(__FILE__),'Insercción de CTA', 'Insercción de CTA',  'manage_options',plugin_dir_path(__FILE__) . '/sistemex-inbound-cta-page.php');
add_submenu_page(plugin_dir_path(__FILE__),'Insercción de Banner', 'Insercción de Banner',  'manage_options',plugin_dir_path(__FILE__) . '/sistemex-inbound-banners-page.php');
//add_submenu_page(plugin_dir_path(__FILE__).'/sistemex-inbound-table.php','Editar CTA', 'Editar CTA',  'manage_options',plugin_dir_path(__FILE__) . '/sistemex-inbound-ver-banners.php');
add_submenu_page(null,'Editar CTA', 'Editar CTA',  'manage_options',plugin_dir_path(__FILE__) . '/sistemex-inbound-cta-page-edit.php');
add_submenu_page(null,'Editar Banner', 'Editar Banner',  'manage_options',plugin_dir_path(__FILE__) . '/sistemex-inbound-banners-page-edit.php');
//add_submenu_page(plugin_dir_path(__FILE__).'/sistemex-interlinking-table.php','Keywords', 'Keywords',  'manage_options',plugin_dir_path(__FILE__) . '/sistemex-interlinking-table.php');


}


add_action( 'admin_enqueue_scripts', 'addstyle');

function addstyle($hook){
    
    
    if ($hook == 'sistemex-inbound/includes/sistemex-inbound-dashboard.php' || $hook == 'sistemex-inbound/includes/sistemex-inbound-table-ps-by.php' 
    || $hook == 'sistemex-inbound/includes/sistemex-inbound-table-banners.php' || $hook == 'sistemex-inbound/includes/sistemex-inbound-table.php' 
    || $hook=='sistemex-inbound/includes/sistemex-interlinking-table.php' || $hook == 'sistemex-inbound/includes/sistemex-inbound-banners-page-edit.php'
    || $hook == 'sistemex-inbound/includes/sistemex-inbound-banners-page-edit.php' || $hook == 'sistemex-inbound/includes/sistemex-inbound-cta-page-edit.php'
    || $hook == 'sistemex-inbound/includes/sistemex-inbound-interlinking-page-edit.php' || $hook == 'sistemex-inbound/includes/sistemex-inbound-banners-page.php'
    || $hook == 'sistemex-inbound/includes/sistemex-inbound-cta-page.php' || $hook == 'sistemex-inbound/includes/mfp-first-page.php'
    ) {
        
    wp_register_style('sistemex-inbound', plugins_url('css/sistemexinbound.css', __FILE__));
wp_enqueue_style('sistemex-inbound');

wp_register_style('sistemex-inbound-bootstrap', plugins_url('css/bootstrap.css', __FILE__));
wp_enqueue_style('sistemex-inbound-bootstrap');

wp_register_style('sistemex-inbound-material', plugins_url('css/material.css', __FILE__));
wp_enqueue_style('sistemex-inbound-material');

wp_register_style('sistemex-inbound-select2', plugins_url('css/select2.css', __FILE__));
wp_enqueue_style('sistemex-inbound-select2');

wp_register_style('sistemex-inbound-font-awesome', plugins_url('css/font-awesome.css', __FILE__));
wp_enqueue_style('sistemex-inbound-font-awesome');

wp_register_style('sistemex-inbound-jquery-dataTables', plugins_url('css/jquery.dataTables.css', __FILE__));
wp_enqueue_style('sistemex-inbound-jquery-dataTables');
  } else {
    /** Call regular enqueue */
  }





}


add_action( 'admin_enqueue_scripts', 'addjs');

function addjs($hook){
    if ($hook == 'sistemex-inbound/includes/sistemex-inbound-dashboard.php' || $hook == 'sistemex-inbound/includes/sistemex-inbound-table-ps-by.php' 
    || $hook == 'sistemex-inbound/includes/sistemex-inbound-table-banners.php' || $hook == 'sistemex-inbound/includes/sistemex-inbound-table.php' 
    || $hook=='sistemex-inbound/includes/sistemex-interlinking-table.php' || $hook == 'sistemex-inbound/includes/sistemex-inbound-banners-page-edit.php'
    || $hook == 'sistemex-inbound/includes/sistemex-inbound-banners-page-edit.php' || $hook == 'sistemex-inbound/includes/sistemex-inbound-cta-page-edit.php'
    || $hook == 'sistemex-inbound/includes/sistemex-inbound-interlinking-page-edit.php' || $hook == 'sistemex-inbound/includes/sistemex-inbound-banners-page.php'
    || $hook == 'sistemex-inbound/includes/sistemex-inbound-cta-page.php' || $hook == 'sistemex-inbound/includes/mfp-first-page.php'
    ) {
wp_register_script('sistemex-inbound-js', plugins_url('js/fontawesome.js', __FILE__));
wp_enqueue_script('sistemex-inbound-js');

wp_register_script('sistemex-inbound-jquery-dataTables-js', plugins_url('js/jquery.dataTables.js', __FILE__));
wp_enqueue_script('sistemex-inbound-jquery-dataTables-js');

wp_register_script('sistemex-inbound-dataTables-material-js', plugins_url('js/dataTables.material.js', __FILE__));
wp_enqueue_script('sistemex-inbound-dataTables-material-js');

wp_register_script('sistemex-inbound-select2-js', plugins_url('js/select2.js', __FILE__));
wp_enqueue_script('sistemex-inbound-select2-js');

wp_register_script('sistemex-inbound-bootstrap-js', plugins_url('js/bootstrap.js', __FILE__));
wp_enqueue_script('sistemex-inbound-bootstrap-js');


}
}

function sistemex_featured_meta() {
    add_meta_box( 'prfx_meta', __( 'CTA', 'prfx-textdomain' ), 'prfx_meta_callback', 'post', 'normal', 'high' );
}


function prfx_meta_callback( $post ) {
      
    global $wpdb;
   
    wp_nonce_field( basename( __FILE__ ), 'prfx_nonce' );
    $prfx_stored_meta = get_post_meta( $post->ID );
    ?>

 <p>
    <span class="prfx-row-title"><?php _e( 'Selecciona tu CTA: ', 'prfx-textdomain' )?></span>
    <div class="prfx-row-content">
        <?php  
            
            $banners = $wpdb->get_results("SELECT * FROM sistemex_inbound_cta");
            
            ?>
            
            <label for="featured-checkbox">
            
            <input type="radio" name="featured-checkbox" id="featured-checkbox" value="" />Ninguna
          
            
            
            
        </label>
            <?php 
            foreach($banners as $banners){
            ?>
        <label for="featured-checkbox">
            
            <input type="radio" name="featured-checkbox" id="featured-checkbox" value="<?php echo $banners->id  ?>" <?php if ( isset ( $prfx_stored_meta['featured-checkbox'] ) ) checked( $prfx_stored_meta['featured-checkbox'][0], $banners->id ); ?> />
            <?php echo $banners->nombre ?>
            
            
            
        </label>
        <?php
                
            }
            ?>

    </div>
</p>   

    <?php
}



function sistemex_meta_save( $post_id ) {
 
    // Checks save status - overcome autosave, etc.
    $is_autosave = wp_is_post_autosave( $post_id );
    $is_revision = wp_is_post_revision( $post_id );
    $is_valid_nonce = ( isset( $_POST[ 'prfx_nonce' ] ) && wp_verify_nonce( $_POST[ 'prfx_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';
 
    // Exits script depending on save status
    if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
        return;
    }
 
// Checks for input and saves - save checked as yes and unchecked at no
if( isset( $_POST[ 'featured-checkbox' ] ) ) {
    
    update_post_meta( $post_id, 'featured-checkbox', sanitize_text_field($_POST[ 'featured-checkbox' ]) );
}
 
}

function sistemex_createTable(){
    global $wpdb;

$charset_collate_banner = $wpdb->get_charset_collate();

$sql_banner = "CREATE TABLE sistemex_inbound_banners (
  id integer(11) NOT NULL AUTO_INCREMENT,
  time timestamp DEFAULT '0000-00-00 00:00:00' NOT NULL,
  nombre varchar(255)  NULL,
  producto_servicio varchar(255)  NULL,
  buyer_journey varchar(255)  NULL,
  urlImagen1 varchar(255)  NULL,
  idImagen1 varchar(255)  NULL,
  categoria varchar(255) NULL,
  tipo1 varchar(255)  NULL,
  alt1 varchar(255)  NULL,
  idcategoria integer(11)  NULL,
  url1 varchar(255) NULL,
  nuevotap1 varchar(255) NULL,
  PRIMARY KEY  (id)
) $charset_collate_banner;";

require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
dbDelta( $sql_banner );

$charset_collate_cta = $wpdb->get_charset_collate();



$sql_cta = "CREATE TABLE sistemex_inbound_cta (
  id integer(11) NOT NULL AUTO_INCREMENT,
  time timestamp DEFAULT '0000-00-00 00:00:00' NOT NULL,
  nombre varchar(255)  NULL,
  producto_servicio varchar(255)  NULL,
  buyer_journey varchar(255)  NULL,
  banner_medio varchar(255)  NULL,
  banner_inferior varchar(255)  NULL,
  id_banner_medio varchar(255)  NULL,
  id_banner_inferior varchar(255)  NULL,
  url1 varchar(255)  NULL,
  url2 varchar(255)  NULL,
  alt1 varchar(255)  NULL,
  alt2 varchar(255)  NULL,
  nuevotap1 integer(11)  NULL,
  nuevotap2 integer(11)  NULL,
  PRIMARY KEY  (id)
) $charset_collate_cta;";

require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
dbDelta( $sql_cta );

$charset_collate_ps = $wpdb->get_charset_collate();

$sql_ps = "CREATE TABLE sistemex_productos_servicios (
  id integer(11) NOT NULL AUTO_INCREMENT,
  nombre varchar(255)  NULL,
  time timestamp DEFAULT '0000-00-00 00:00:00' NOT NULL,
  PRIMARY KEY  (id)
) $charset_collate_ps;";

require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
dbDelta( $sql_ps );

$charset_collate_by = $wpdb->get_charset_collate();

$sql_by = "CREATE TABLE sistemex_buyer_journey (
  id integer(11) NOT NULL AUTO_INCREMENT,
  nombre varchar(255)  NULL,
  time timestamp DEFAULT '0000-00-00 00:00:00' NOT NULL,
  PRIMARY KEY  (id)
) $charset_collate_by;";

require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
dbDelta( $sql_by );


$by = $wpdb->get_var("SELECT COUNT(id) FROM sistemex_buyer_journey;");



if((integer)$by == 0){
    $wpdb->insert('sistemex_buyer_journey', array(
                        'id'=>1,
                        'nombre'=>"1-Aprendizaje",
                       )
             );
             
    $wpdb->insert('sistemex_buyer_journey', array(
                        'id'=>2,
                        'nombre'=>"2-Reconocimiento",
                       )
             );
    
    $wpdb->insert('sistemex_buyer_journey', array(
                        'id'=>3,
                        'nombre'=>"3-Consideración",
                       )
             );
             
    $wpdb->insert('sistemex_buyer_journey', array(
                        'id'=>4,
                        'nombre'=>"4-Decisión",
                       )
             );         
}

}

/*función para agregar el baner abajo */
function add_banner_abajo($content) {
if ( is_single() ) {
    global $post;
    global $wpdb;
   
   
       $idcat = get_post_meta($post->ID, 'featured-checkbox');
       
     
        
    $cta = $wpdb->get_results("SELECT * FROM sistemex_inbound_cta where id = ". $idcat[0]); 
     
   
    $banners = $wpdb->get_results("SELECT * FROM sistemex_inbound_banners where id = ". $cta[0]->id_banner_inferior); 
   
        
    if(sizeof($banners)>0){
        $pgLnk=get_post_meta($post->ID, 'Button', true); 
    foreach($banners as $banners){
    if($banners->nuevotap1 == 1){
     $content .= '<div id="button-link"><a href="'.$banners->url1.'" target="_blank">
    <img src="'.$banners->urlImagen1.'" title="'.$banners->alt1.'"  alt="'.$banners->alt1.'" /></a>
    <a href="https://sistemex.com" style="display:none">Sistemex</a>
    </div>';
    
    return $content;
    
    
    }else{
    $content .= '<div id="button-link"><a href="'.$banners->url1.'">
    <img src="'.$banners->urlImagen1.'" title="'.$banners->alt1.'"  alt="'.$banners->alt1.'" /></a>
    <a href="https://sistemex.com" style="display:none">Sistemex</a>
    </div>';
    
    return $content;
    }
    }
    }else{
        return $content;
    }
        
    
   
}else{
    return $content;
} 


}


/*función para agregar el baner arriba */
function add_banner_medio($content){
    if ( is_single() ) {
    global $post;
    global $wpdb;
    
    $idcat = get_post_meta($post->ID, 'featured-checkbox');
       // Paragraphs array without the closing tag
    $paragraphs       = explode( '</p>', $content );
    // Number of paragraphs in $paragraphs
    $paragraphs_count = count( $paragraphs );
    // Middle index of $paragraphs
    $middle_index     = absint( floor( $paragraphs_count / 2 ) );
    // New content string
    $new_content      = '';

    $cta = $wpdb->get_results("SELECT * FROM sistemex_inbound_cta where id = ". $idcat[0]); 
     
   
    $banners = $wpdb->get_results("SELECT * FROM sistemex_inbound_banners where id = ". $cta[0]->id_banner_medio); 
        
    if(sizeof($banners)>0){
    foreach($banners as $banners){
        if($banners->nuevotap1 == 1){
    $content2 ='';        
     $content2 .= '<div id="button-link"><a href="'.$banners->url1.'" target="_blank">
    <img src="'.$banners->urlImagen1.'" title="'.$banners->alt1.'" alt="'.$banners->alt1.'" /></a></div>';
        }else{
    $content2 =''; 
    $content2 .= '<div id="button-link"><a href="'.$banners->url1.'">
    <img src="'.$banners->urlImagen1.'" title="'.$banners->alt1.'" alt="'.$banners->alt1.'" /></a></div>';
        }
    }
    
    for ( $i = 0; $i < $paragraphs_count; $i++ ) {
        if ( $i === $middle_index ) {
            // Add custom content in the middle of post contents
            $new_content .= $content2;
        }
        // Append the missing closing p tag
        $new_content .= $paragraphs[ $i ] . '</p>';
    }
    
    return $new_content;
    } else{
        
        return $content;
    }   
    
    
}else{
    return $content;
}
}

function sistemex_create_table(){
    global $wpdb;

$charset_collate = $wpdb->get_charset_collate();

$sql = "CREATE TABLE sistemex_interlinking  (
  id integer(11) NOT NULL AUTO_INCREMENT,
  keyword varchar(255) NULL,
  url varchar(255)  NULL,
  value integer(11) NULL,
  tema varchar(255) NULL,
  rel varchar(255) NULL,
  target varchar(255) NULL,
  reemplazo varchar(11) NULL,
  PRIMARY KEY  (id)
) $charset_collate;";

require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
dbDelta( $sql );
}

function sistemex_create_table2(){
    global $wpdb;

$charset_collate = $wpdb->get_charset_collate();

$sql = "CREATE TABLE sistemex_interlinking_configuracion  (
  id integer(11) NOT NULL AUTO_INCREMENT,
  limite varchar(255) NULL,
  PRIMARY KEY  (id)
) $charset_collate;";

require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
dbDelta( $sql );

$limite = $wpdb->get_var("SELECT COUNT(id) FROM sistemex_interlinking_configuracion;");



if((integer)$limite == 0){
    $wpdb->insert('sistemex_interlinking_configuracion', array(
                        'id'=>1,
                        'limite'=>"-1",
                       )
             );
             
         
}
}


//función para reemplazar las palabras clave

function my_the_content_filter_replace_keyword($content) {
if ( is_single() ) {
    global $post;
    global $wpdb;
   
    $filterPalabras[]= array();
    $pattern[] = array();
    $replacement[] = array();
   
    
    $palabras = $wpdb->get_results("SELECT * FROM sistemex_interlinking ORDER BY value desc");
    $configuracion = $wpdb->get_results("SELECT * FROM sistemex_interlinking_configuracion where id=1");

    
        
    if(sizeof($palabras)>0){
        
        foreach($palabras as $palabras){
        
            
            $arrayPalabras[] = array('url'=>$palabras->url, 'keyword'=>$palabras->keyword, 'value'=>$palabras->value);

            
           
       }
       
   
    for($i=0; $i<sizeof($arrayPalabras); $i++){
   
    
    
   
    $pattern[$i] = "/".$arrayPalabras[$i]['keyword']."(?!((?i:[^<]*<\s*\/?(?:a|h\d{1}|script|embed)>)|[^<]*>))/umi";
   
    $replacement[$i] = '<a target="_blank" id="button-link" href="'.$arrayPalabras[$i]['url'].'" >'.$arrayPalabras[$i]['keyword'].'</a>';
                
   
    
    }
    
  
   
       $string = $content;
       $content = preg_replace($pattern, $replacement, $string, (integer)$configuracion[0]->limite);

   
    return $content;
    }else{
        return $content;
    }
        
    
   
}else{
    return $content;
} 


}
 
function shiba_add_post_columns($columns) {
    $columns['widget_set'] = 'CTA';
    return $columns;
}


 
function shiba_render_post_columns($column_name, $id) {
    
    
    switch ($column_name) {
    case 'widget_set':
        // show widget set
        
    global $wpdb;
   
   
       $widget_id = get_post_meta( $id, 'featured-checkbox', TRUE);
       $banners = $wpdb->get_results("SELECT * FROM sistemex_inbound_cta where id = $widget_id"); 
      
       
        $widget_set = NULL;
       
       
      
       
        if (sizeof($banners)>0) {
         foreach($banners as $banners){
            echo $banners->nombre;
        }   
        } else{ echo 'Ninguna';}               
        break;
       
    }
}


 
function shiba_add_quick_edit($column_name, $post_type) {
    global $wpdb;
    global $post;
    global $current_screen;
    if ($column_name != 'widget_set') return;
    ?>
    <fieldset class="inline-edit-col-left">
    <div class="inline-edit-col">
        <span class="title">CTA</span>
        <input type="hidden" name="shiba_widget_set_noncename" id="shiba_widget_set_noncename" value="" />
        <?php // Get all widget sets
        $widget_id = get_post_meta($post->ID , 'featured-checkbox', TRUE);
       
       
     
      
       $banners = $wpdb->get_results("SELECT * FROM sistemex_inbound_cta"); 
        ?>
        <select name="featured-checkbox" id="featured-checkbox">
            <option class='widget-option' value='0'>Ninguna</option>
            
            <?php 
            foreach ($banners as $banners) {
                if($banners->id == $widget_id ){
                    $selected='selected';
                    }else{
                    $selected='';
                    }
                echo "<option class='widget-option'  value='{$banners->id}'>{$banners->nombre}</option>\n";
            }
                ?>
        </select>
    </div>
    </fieldset>
    <?php
}

function shiba_add_quick_edit2($column_name, $post_type) {
    global $wpdb;
    if ($column_name != 'widget_set') return;
    ?>
    <fieldset class="inline-edit-col-left">
    <div class="inline-edit-col">
        <span class="title">CTAS</span>
        <input type="hidden" name="shiba_widget_set_noncename" id="shiba_widget_set_noncename" value="" />
        <?php // Get all widget sets
            //$widget_id = get_post_meta($post_type->ID , 'featured-checkbox', TRUE);
       $banners = $wpdb->get_results("SELECT * FROM sistemex_inbound_cta"); 
        ?>
        <select name="featured-checkbox2" id="featured-checkbox2">
            <option class='widget-option' value='0'>Ninguna</option>
            <?php 
            foreach ($banners as $banners) {
                echo "<option class='widget-option' value='{$banners->id}'>{$banners->nombre}</option>\n";
            }
                ?>
        </select>
    </div>
    </fieldset>
    <?php
}

add_action( 'admin_print_scripts-edit.php', 'manage_sistemex_posts_be_qe_enqueue_admin_scripts' );
function manage_sistemex_posts_be_qe_enqueue_admin_scripts() {
	// if code is in theme functions.php file
	//wp_enqueue_script( 'manage-wp-posts-using-bulk-quick-edit', trailingslashit( get_bloginfo( 'stylesheet_directory' ) ) . 'bulk_quick_edit.js', array( 'jquery', 'inline-edit-post' ), '', true );
	
	// if using code as plugin
	wp_enqueue_script( 'sistemex-inbound-banners', trailingslashit( plugin_dir_url( __FILE__ ) ) . 'bulk_quick_edit.js', array( 'jquery', 'inline-edit-post' ), '', true );
	
}


add_action( 'wp_ajax_manage_sistemex_posts_using_bulk_quick_save_bulk_edit2', 'manage_sistemex_posts_using_bulk_quick_save_bulk_edit2' );
function manage_sistemex_posts_using_bulk_quick_save_bulk_edit2() {
	// we need the post IDs
	$post_ids = ( isset( $_REQUEST[ 'post_ids' ] ) && !empty( $_REQUEST[ 'post_ids' ] ) ) ? $_POST[ 'post_ids' ] : NULL;

	
	
			
			// if it has a value, doesn't update if empty on bulk
			if ( isset( $_REQUEST['release_date'] ) && !empty( $_REQUEST[ 'release_date'] ) ) {
			
				// update for each post ID
				foreach( $post_ids as $post_id ) {
					update_post_meta( sanitize_text_field($post_id), 'featured-checkbox', sanitize_text_field($_POST['release_date' ]) );
				}
				
			}
			
		
		
	
	
}

add_action( 'wp_ajax_get_sistemex_post_meta', 'get_sistemex_post_meta' );
function get_sistemex_post_meta() {
	// we need the post IDs
	$widget_id=array();
	$post_ids = ( isset( $_REQUEST[ 'post_ids' ] ) && !empty( $_REQUEST[ 'post_ids' ] ) ) ? $_GET[ 'post_ids' ] : NULL;
    $widget_id['id'] = get_post_meta($post_ids, 'featured-checkbox', TRUE);
    wp_send_json_success($widget_id);
	}



// As you are dealing with plugin settings,
// I assume you are in admin side
add_action( 'admin_enqueue_scripts', 'load_sistemex_media_files_sistemex_inbound_2' );
function load_sistemex_media_files_sistemex_inbound_2( $page ) {
   
  // change to the $page where you want to enqueue the script
  if(  $page == 'sistemex-inbound/includes/sistemex-inbound-banners-page-edit.php' || $page == 'sistemex-inbound/includes/sistemex-inbound-banners-page.php' || $page == 'sistemex-inbound/includes/sistemex-inbound-ver-banners.php' ) {
    // Enqueue WordPress media scripts
    wp_enqueue_media();
    // Enqueue custom script that will interact with wp.media
    	wp_enqueue_script( 'sistemex-inbound-banners2', trailingslashit( plugin_dir_url( __FILE__ ) ) . 'myscript.js', array( 'jquery', 'inline-edit-post' ), '', true );
  }
}

// Ajax para guardar un producto o servicio
add_action( 'wp_ajax_sistemex_post_ps', 'sistemex_post_ps'   );
function sistemex_post_ps() {
    global $wpdb;
  $nombre = sanitize_text_field($_GET['producto_servicio']);

 
  $wpdb->insert('sistemex_productos_servicios', array(
                        'nombre'=>$nombre,
                       )
             );
             
    $ps_nombre = $wpdb->get_results("SELECT id,nombre FROM sistemex_productos_servicios;");
  wp_send_json_success($ps_nombre);


}

// Ajax para guardar un buyer journey
add_action( 'wp_ajax_sistemex_post_by', 'sistemex_post_by'   );
function sistemex_post_by() {
    global $wpdb;
  $nombre = sanitize_text_field($_GET['buyer_journey']);
  $by_nombre = $wpdb->get_results("SELECT id,nombre FROM sistemex_buyer_journey;");
 
  $wpdb->insert('sistemex_buyer_journey', array(
                        'nombre'=>$nombre,
                       )
             );
             
  $by_nombre = $wpdb->get_results("SELECT id,nombre FROM sistemex_buyer_journey;");
  wp_send_json_success($by_nombre);


}

// Ajax para guardar un listado de buyer journey
add_action( 'wp_ajax_sistemex_list_by', 'sistemex_list_by'   );
function sistemex_list_by() {
    global $wpdb;


  $by_nombre = $wpdb->get_results("SELECT id,nombre FROM sistemex_buyer_journey;");
  wp_send_json_success($by_nombre);


}

// Ajax para guardar un listado de productos y servicios
add_action( 'wp_ajax_sistemex_list_ps', 'sistemex_list_ps'   );
function sistemex_list_ps() {
    global $wpdb;


  $by_nombre = $wpdb->get_results("SELECT id,nombre FROM sistemex_productos_servicios;");
  wp_send_json_success($by_nombre);


}


// Ajax para eliminar un producto y servicio
add_action( 'wp_ajax_sistemex_post_delete_ps', 'sistemex_post_delete_ps');
function sistemex_post_delete_ps() {
    global $wpdb;
  $id = sanitize_text_field($_GET['id']);
  
  $wpdb->delete('sistemex_productos_servicios', array( 'id' => $id ) );
             
  $ps_nombre = $wpdb->get_results("SELECT id,nombre FROM sistemex_productos_servicios;");
  
  $wpdb->update('sistemex_inbound_cta', array(
                        'producto_servicio'=>null
                       ),
                       array( 'producto_servicio' => $id )
             );
             
   $wpdb->update('sistemex_inbound_banners', array(
                        'producto_servicio'=>null
                       ),
                       array( 'producto_servicio' => $id )
             );
  wp_send_json_success($ps_nombre);


}

// Ajax para eliminar un buyer journey
add_action( 'wp_ajax_sistemex_post_delete_by', 'sistemex_post_delete_by');
function sistemex_post_delete_by() {
    global $wpdb;
  $id = sanitize_text_field($_GET['id']);
  
  $wpdb->delete('sistemex_buyer_journey', array( 'id' => $id ) );
  
  $wpdb->update('sistemex_inbound_cta', array(
                        'buyer_journey'=>null,
                       ),
                       array( 'buyer_journey' => $id )
             );
             
   $wpdb->update('sistemex_inbound_banners', array(
                        'buyer_journey'=>null
                       ),
                       array( 'buyer_journey' => $id )
             );
             
  $ps_nombre = $wpdb->get_results("SELECT id,nombre FROM sistemex_buyer_journey;");
  wp_send_json_success($ps_nombre);


}


// Ajax para eliminar una keyword
add_action( 'wp_ajax_sistemex_post_delete_keyword', 'sistemex_post_delete_keyword');
function sistemex_post_delete_keyword() {
    global $wpdb;
  $id = sanitize_text_field($_GET['id']);
  
  $wpdb->delete('sistemex_interlinking', array( 'id' => $id ) );
             
  $ps_nombre = $wpdb->get_results("SELECT * FROM sistemex_interlinking;");
  
 
  wp_send_json_success($ps_nombre);


}

// Ajax para eliminar una CTA
add_action( 'wp_ajax_sistemex_post_delete_cta', 'sistemex_post_delete_cta');
function sistemex_post_delete_cta() {
    global $wpdb;
  $id = sanitize_text_field($_GET['id']);
  
  $wpdb->delete('sistemex_inbound_cta', array( 'id' => $id ) );
             

 $ps_nombre = $wpdb->get_results("SELECT cta.*,ps.nombre as nombre_ps, bj.nombre as nombre_bj FROM sistemex_inbound_cta as cta LEFT JOIN sistemex_productos_servicios as ps ON ps.id = cta.producto_servicio LEFT JOIN sistemex_buyer_journey as bj ON bj.id = cta.buyer_journey;");

  wp_send_json_success($ps_nombre);


}

// Ajax para eliminar un banner
add_action( 'wp_ajax_sistemex_post_delete_banner', 'sistemex_post_delete_banner');
function sistemex_post_delete_banner() {
    global $wpdb;
  $id = sanitize_text_field($_GET['id']);
  
  $wpdb->delete('sistemex_inbound_banners', array( 'id' => $id ) );
             

$ps_nombre = $wpdb->get_results("SELECT banner.*,ps.nombre as nombre_ps, bj.nombre as nombre_bj FROM sistemex_inbound_banners as banner LEFT JOIN sistemex_productos_servicios as ps ON ps.id = banner.producto_servicio LEFT JOIN sistemex_buyer_journey as bj ON bj.id = banner.buyer_journey;");

  wp_send_json_success($ps_nombre);


}


// Ajax para actualizar un producto o servicio
add_action( 'wp_ajax_sistemex_post_edit_ps', 'sistemex_post_edit_ps'   );
function sistemex_post_edit_ps() {
    global $wpdb;
  $id = sanitize_text_field($_GET['id']);
  $nombre = sanitize_text_field($_GET['producto_servicio']);
  
  $wpdb->update('sistemex_productos_servicios', array(
                        'nombre'=>$nombre,
                       ),
                       array( 'id' => $id )
             );
             
  $ps_nombre = $wpdb->get_results("SELECT id,nombre FROM sistemex_productos_servicios;");
  wp_send_json_success($ps_nombre);


}

// Ajax para actualizar un buyer journey
add_action( 'wp_ajax_sistemex_post_edit_by', 'sistemex_post_edit_by'   );
function sistemex_post_edit_by() {
    global $wpdb;
  $id = sanitize_text_field($_GET['id']);
  $nombre =  sanitize_text_field($_GET['buyer_journey']);
  
  $wpdb->update('sistemex_buyer_journey', array(
                        'nombre'=>$nombre,
                       ),
                       array( 'id' => $id )
             );
             
  $ps_nombre = $wpdb->get_results("SELECT id,nombre FROM sistemex_buyer_journey;");
  wp_send_json_success($ps_nombre);


}

// Ajax action to refresh the user image
add_action( 'wp_ajax_sistemex_get_image', 'sistemex_get_image'   );
function sistemex_get_image() {
    if(isset($_GET['id']) ){
        $id= sanitize_text_field($_GET['id']);
        $image = wp_get_attachment_image( filter_input( INPUT_GET, 'id', FILTER_VALIDATE_INT ), 'medium', false, array( 'id' => 'sistemex-preview-image' ) );
        $data = array(
            'image'    => $image,
            'id' => $id,
        );
        wp_send_json_success( $data );
    } else {
        wp_send_json_error();
    }
}

//Ajax para obtener un cta
add_action( 'wp_ajax_sistemex_get_cta', 'sistemex_get_cta'   );
function sistemex_get_cta() {
    if(isset($_GET['id']) ){
         global $wpdb;
        $id = sanitize_text_field($_GET['id']);
        $cta = $wpdb->get_results("SELECT * FROM sistemex_inbound_cta where id = ". $id); 
        $data = array(
            'cta'    => $cta[0],
        );
        
        wp_send_json_success( $data );
    } else {
        wp_send_json_error();
    }
}

//Ajax para obtener un banner
add_action( 'wp_ajax_sistemex_get_banners', 'sistemex_get_banners'   );
function sistemex_get_banners() {
    if(isset($_GET['id']) ){
         global $wpdb;
        $id = sanitize_text_field($_GET['id']);
        $banner = $wpdb->get_results("SELECT * FROM sistemex_inbound_banners where id = ". $id); 
        $by = $wpdb->get_results("SELECT * FROM sistemex_buyer_journey where id = ". $banner[0]->buyer_journey); 
        $data = array(
            'banner'    => $banner[0],
            'by'    => $by[0],
        );
        wp_send_json_success($data);
    } else {
        wp_send_json_error();
    }
}

//Ajax para obtener un producto o servicio
add_action( 'wp_ajax_sistemex_get_ps', 'sistemex_get_ps'   );
function sistemex_get_ps() {
    if(isset($_GET['id']) ){
         global $wpdb;
        $id = sanitize_text_field($_GET['id']);
        $ps = $wpdb->get_results("SELECT * FROM sistemex_productos_servicios where id = ". $id); 
        $data = array(
            'ps'    => $ps[0],
        );
        
        wp_send_json_success( $data );
    } else {
        wp_send_json_error();
    }
}

//Ajax para obtener un buyer journey
add_action( 'wp_ajax_sistemex_get_by', 'sistemex_get_by'   );
function sistemex_get_by() {
    if(isset($_GET['id']) ){
         global $wpdb;
        $id = sanitize_text_field($_GET['id']);
        $by = $wpdb->get_results("SELECT * FROM sistemex_buyer_journey where id = ". $id); 
        $data = array(
            'by'    => $by[0],
        );
        
        wp_send_json_success( $data );
    } else {
        wp_send_json_error();
    }
}

//Ajax para obtener un producto o servicio y los banners
add_action( 'wp_ajax_sistemex_get_ps_banner', 'sistemex_get_ps_banner'   );
function sistemex_get_ps_banner() {
    
    
    if(isset($_GET['id']) ){
        if($_GET['idBuyer']==0 && $_GET['idServicio'] ==0 ){
            global $wpdb;
        $id = sanitize_text_field($_GET['id']);
        $ps = $wpdb->get_results("SELECT * FROM sistemex_productos_servicios"); 
        $banner_medio = $wpdb->get_results("SELECT * FROM sistemex_inbound_banners"); 
        $banner_inferior = $wpdb->get_results("SELECT * FROM sistemex_inbound_banners"); 
        $data = array(
            'ps'    => null,
            'banner_medio'    => $banner_medio,
            'banner_inferior'    => $banner_inferior,
        );
        
        wp_send_json_success( $data );
        }else{
        
        if($_GET['idBuyer']==0 && $_GET['idServicio'] <> 0){
            global $wpdb;
        $id = sanitize_text_field($_GET['id']);
        $ps = $wpdb->get_results("SELECT * FROM sistemex_productos_servicios where id = ". $id); 
        $banner_medio = $wpdb->get_results("SELECT * FROM sistemex_inbound_banners where producto_servicio = ". $id); 
        $banner_inferior = $wpdb->get_results("SELECT * FROM sistemex_inbound_banners where producto_servicio = ". $id); 
        $data = array(
            'ps'    => $ps[0],
            'banner_medio'    => $banner_medio,
            'banner_inferior'    => $banner_inferior,
        );
        
        wp_send_json_success( $data );
        }
        
        if($_GET['idBuyer'] <>0 && $_GET['idServicio'] <> 0){
         global $wpdb;
        $id = sanitize_text_field($_GET['id']);
        $idBuyer = sanitize_text_field($_GET['idBuyer']);
        $ps = $wpdb->get_results("SELECT * FROM sistemex_productos_servicios where id = ". $id); 
        $banner_medio = $wpdb->get_results("SELECT * FROM sistemex_inbound_banners where producto_servicio = ". $id ." and buyer_journey =" . $idBuyer ); 
        $banner_inferior = $wpdb->get_results("SELECT * FROM sistemex_inbound_banners where producto_servicio = ". $id ." and buyer_journey =" . $idBuyer ); 
        $data = array(
            'ps'    => $ps[0],
            'banner_medio'    => $banner_medio,
            'banner_inferior'    => $banner_inferior,
        );
        
        wp_send_json_success( $data );
            
        }
        
        if($_GET['idBuyer'] <> 0 && $_GET['idServicio'] == 0){
             global $wpdb;
        $idBuyer = sanitize_text_field($_GET['id']);
        $ps = $wpdb->get_results("SELECT * FROM sistemex_productos_servicios"); 
        $banner_medio = $wpdb->get_results("SELECT * FROM sistemex_inbound_banners where buyer_journey = ". $idBuyer); 
        $banner_inferior = $wpdb->get_results("SELECT * FROM sistemex_inbound_banners where buyer_journey = ". $idBuyer); 
        $data = array(
            'ps'    => null,
            'banner_medio'    => $banner_medio,
            'banner_inferior'    => $banner_inferior,
        );
        
        wp_send_json_success( $data ); 
         }
           
        }
         
    } else {
        wp_send_json_error();
    }
}

//Ajax para obtener un buyer journey y los banners
add_action( 'wp_ajax_sistemex_get_by_banner', 'sistemex_get_by_banner'   );
function sistemex_get_by_banner() {
    
    if(isset($_GET['id']) ){
        
     if($_GET['idServicio']==0 && $_GET['idBuyer']==0 ){
        global $wpdb;
        $id = sanitize_text_field($_GET['id']);
        $by = $wpdb->get_results("SELECT * FROM sistemex_buyer_journey"); 
        $banner_medio = $wpdb->get_results("SELECT * FROM sistemex_inbound_banners"); 
        $banner_inferior = $wpdb->get_results("SELECT * FROM sistemex_inbound_banners"); 
        $data = array(
            'by'    => null,
            'banner_medio'    => $banner_medio,
            'banner_inferior'    => $banner_inferior,
        );
        
        wp_send_json_success( $data ); 
     }else{
         if($_GET['idBuyer'] <> 0 && $_GET['idServicio'] == 0){
             global $wpdb;
        $id = sanitize_text_field($_GET['id']);
        $by = $wpdb->get_results("SELECT * FROM sistemex_buyer_journey where id = ". $id); 
        $banner_medio = $wpdb->get_results("SELECT * FROM sistemex_inbound_banners where buyer_journey = ". $id); 
        $banner_inferior = $wpdb->get_results("SELECT * FROM sistemex_inbound_banners where buyer_journey = ". $id); 
        $data = array(
            'by'    => $by[0],
            'banner_medio'    => $banner_medio,
            'banner_inferior'    => $banner_inferior,
        );
        
        wp_send_json_success( $data ); 
         }
         
          if($_GET['idBuyer'] <>0 && $_GET['idServicio'] <> 0){
              global $wpdb;
        $id = sanitize_text_field($_GET['id']);
        $idServicio = sanitize_text_field($_GET['idServicio']);
        $by = $wpdb->get_results("SELECT * FROM sistemex_buyer_journey where id = ". $id); 
        $banner_medio = $wpdb->get_results("SELECT * FROM sistemex_inbound_banners where buyer_journey = ". $id." and producto_servicio =" . $idServicio ); 
        $banner_inferior = $wpdb->get_results("SELECT * FROM sistemex_inbound_banners where buyer_journey = ". $id." and producto_servicio =" . $idServicio ); 
        $data = array(
            'by'    => $by[0],
            'banner_medio'    => $banner_medio,
            'banner_inferior'    => $banner_inferior,
        );
        
        wp_send_json_success( $data );
          }
          
          if($_GET['idBuyer']==0 && $_GET['idServicio'] <> 0){
            global $wpdb;
        $idServicio = sanitize_text_field($_GET['idServicio']);
        $by = $wpdb->get_results("SELECT * FROM sistemex_buyer_journey"); 
        $banner_medio = $wpdb->get_results("SELECT * FROM sistemex_inbound_banners where producto_servicio = ". $idServicio); 
        $banner_inferior = $wpdb->get_results("SELECT * FROM sistemex_inbound_banners where producto_servicio = ". $idServicio); 
        $data = array(
            'by'    => null,
            'banner_medio'    => $banner_medio,
            'banner_inferior'    => $banner_inferior,
        );
        
        wp_send_json_success( $data );
        }
         
         
     }    
         
    } else {
        wp_send_json_error();
    }
}

//Ajax para obtener un banner medio en editar CTA
add_action( 'wp_ajax_sistemex_get_banners_medio', 'sistemex_get_banners_medio'   );
function sistemex_get_banners_medio() {
    if(isset($_GET['id']) ){
       
         global $wpdb;
        $id = sanitize_text_field($_GET['id']);
        $banner = $wpdb->get_results("SELECT * FROM sistemex_inbound_banners where id = ". $id); 
        $data = array(
            'banner'    => $banner[0],
        );
        
        wp_send_json_success( $data );
    } else {
        wp_send_json_error();
    }
}

//Ajax para obtener un banner inferior en editar CTA
add_action( 'wp_ajax_sistemex_get_banners_inferior', 'sistemex_get_banners_inferior'   );
function sistemex_get_banners_inferior() {
    if(isset($_GET['id']) ){
         global $wpdb;
        $id = sanitize_text_field($_GET['id']);
        $banner = $wpdb->get_results("SELECT * FROM sistemex_inbound_banners where id = ". $id); 
        $data = array(
            'banner'    => $banner[0],
        );
        
        wp_send_json_success( $data );
    } else {
        wp_send_json_error();
    }
}

//Ajax para obtener una keyword
add_action( 'wp_ajax_sistemex_get_keyword', 'sistemex_ajax_sistemex_get_keyword'   );
function sistemex_ajax_sistemex_get_keyword() {
    if(isset($_GET['id']) ){
         global $wpdb;
        $id = sanitize_text_field($_GET['id']);
        $keyword = $wpdb->get_results("SELECT * FROM sistemex_interlinking where id = ". $id); 
        $data = array(
            'keyword'    => $keyword[0],
        );
        
        wp_send_json_success( $data );
    } else {
        wp_send_json_error();
    }
}



add_action( 'admin_enqueue_scripts', 'load_sistemex_media_files_sistemex_inbound' );
function load_sistemex_media_files_sistemex_inbound( $page ) {
    
    
   
  // change to the $page where you want to enqueue the script
  if( $page == 'sistemex-inbound/includes/sistemex-inbound-banners-page.php' || $page == 'sistemex-inbound/includes/sistemex-inbound-ver-banners.php') {
    // Enqueue WordPress media scripts
    wp_enqueue_media();
    // Enqueue custom script that will interact with wp.media
    	wp_enqueue_script( 'sistemex-inbound-banners3', trailingslashit( plugin_dir_url( __FILE__ ) ) . 'myscript2.js', array( 'jquery', 'inline-edit-post' ), '', true );
  }
} 


// Ajax action to refresh the user image
add_action( 'wp_ajax_sistemex_get_image2', 'sistemex_get_image2'   );
function sistemex_get_image2() {
    if(isset($_GET['id']) ){
        $image2 = wp_get_attachment_image( filter_input( INPUT_GET, 'id', FILTER_VALIDATE_INT ), 'medium', false, array( 'id' => 'sistemex-preview-image2' ) );
        $data = array(
            'image'    => $image2,
        );
        wp_send_json_success( $data );
    } else {
        wp_send_json_error();
    }
}



//empieza

add_action('restrict_manage_posts', 'add_extra_tablenav');
function add_extra_tablenav($post_type){

    global $wpdb;
    
    
    
    /** Grab the results from the DB */
    $query = $wpdb->prepare('
        SELECT DISTINCT pm.meta_value FROM %1$s pm
        LEFT JOIN %2$s p ON p.ID = pm.post_id
        WHERE pm.meta_key = "%3$s" 
        AND p.post_status = "%4$s" 
        AND p.post_type = "%5$s"
        ORDER BY "%3$s"',
        $wpdb->postmeta,
        $wpdb->posts,
        'featured-checkbox', // Your meta key - change as required
        'publish',          // Post status - change as required
        $post_type
    );
    $results2 = $wpdb->get_col($query);


    /** Grab the results from the DB */
    $results = $wpdb->get_results("SELECT * FROM sistemex_inbound_cta");
    

    /** Ensure there are options to show */
    if(empty($results))
        return;

    

 
  
  if($_GET['featured-checkbox'] == -1 || $_GET['featured-checkbox'] == "NULL" || $_GET['featured-checkbox'] == ""  ){
                       $selected2='selected';
                    }else{
                       $selected2=''; 
                    }
                    
 
    /*                
    if($_GET['featured-checkbox'] == -2 ){
                         $selected3='selected';
                    }else{
                         $selected3=''; 
                    } 
                     */
                    if($_GET['featured-checkbox'] == '0' ){
                         $selected4='selected';
                    }else{
                         $selected4=''; 
                    } 
 
      echo '<select name="featured-checkbox" id="featured-checkbox">';
echo '<option class="widget-option" '.$selected2.' value="-1">Todas</option>'; 
//echo '<option class="widget-option"'.$selected3.' value="-2">Sin asignación</option>';
echo '<option class="widget-option"'.$selected4.' value="0">Ninguna</option>';  

            foreach ($results as $results) {
                if($_GET['featured-checkbox']==$results->id){
                    $selected='selected';
                }else{
                    $selected='';
                }
                echo "<option class='widget-option' $selected value='{$results->id}'>{$results->nombre}</option>\n";
            }
            
    echo '</select>';

}

add_filter( 'parse_query', 'prefix_parse_filter' );
function  prefix_parse_filter($query) {
   global $pagenow;
   $current_page = isset( $_GET['post_type'] ) ? $_GET['post_type'] : '';
   

   if ( is_admin() && 
     'post' == $current_page &&
      isset( $_GET['featured-checkbox'] ) && 
      $_GET['featured-checkbox'] != '') {
          
    if($_GET['featured-checkbox']== 0){

    $query->query_vars['meta_key'] = 'featured-checkbox';
    $query->query_vars['meta_value'] = '0';
    $query->query_vars['meta_compare'] = '=';
    }  
          
    if($_GET['featured-checkbox']==-2){

    $query->query_vars['meta_key'] = 'featured-checkbox';
    $query->query_vars['meta_compare'] = 'NOT EXISTS';
    }else{
        if($_GET['featured-checkbox'] >0){
         $query->query_vars['meta_key'] = 'featured-checkbox';
    $query->query_vars['meta_value'] = $_GET['featured-checkbox'];
    $query->query_vars['meta_compare'] = '=';   
        }
    
    }     
    
  }
 
}



