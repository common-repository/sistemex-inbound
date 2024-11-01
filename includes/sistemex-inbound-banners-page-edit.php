
<?php


 global $wpdb;
    $banners =  $wpdb->get_results("SELECT * FROM sistemex_inbound_banners");
    $banners2 =  $wpdb->get_results("SELECT * FROM sistemex_inbound_banners");
    $ps = $wpdb->get_results("SELECT * FROM sistemex_productos_servicios;");
    $by = $wpdb->get_results("SELECT * FROM sistemex_buyer_journey;");
 $cta= sanitize_text_field($_GET['cta']);
 
?>


 <div class="form-wrap col-10 row" style="display: -webkit-box;" >
 <div class="col-3">
     <img src="<?php echo plugins_url('imagenes/sistemexlogo2.png', __FILE__) ?>" width="200">

 </div>
 <div class="col-6">
     <h2 style="margin: 0px 0;">INBOUND MARKETING</h2>
 </div>

</div>
<div class="form-wrap">
    <h2>Información del Banner</h2>

<form id="addtag" method="post" enctype="multipart/form-data" action="" >
    
<div>
  
    
    <input type="hidden" name="linea_negocio" id="linea_negocio"  value="<?php echo $cta ?>">
    
</div>    




	


</div>

<?php

$image_id = get_option( 'sistemex_image_id' );
$urlimagen =  $wpdb->get_results("SELECT urlImagen1 FROM sistemex_inbound_banners where id = $cta");
if(  intval( $image_id ) > 0  ) {
    // Change with the image size you want to use 2
    $image = '<img id="sistemex-preview-image" src="'.esc_url($urlimagen[0]->urlImagen1).'" /> <br><br>';
} else {
    // Some default image
    $image = '<img id="sistemex-preview-image" src="'. plugins_url('imagenes/banner_dummy.png', __FILE__).'"/> <br><br>';
}





?>
 
 
   <div class="container" style="margin-left:0px;">
    <div class="row">
   <div class="kt-portlet kt-portlet--head--noborder kt-portlet--height-fluid">
       
       <div class="kt-portlet__body">
          
    <input type="hidden" name="init" value="1">
    <div class="col col-12 form-field form-required term-name-wrap">
	<!--<label for="nombre"><?php _ex( 'Name', 'term name' ); ?></label>-->
	<input name="nombre" id="nombre" type="text" value="" size="40" style="height:30px; font-size: 16px;" aria-required="true" required placeholder="Nombre del banner" />
</div>  
    <div class="col col-12 row"style="Margin-top:35px">
      

    <div class="col col-4 row">
         
   <div class="col-12">
         <?php echo $image; ?>
 
       
   </div>
   <div class="col-12">
 <input type="hidden" name="sistemex_image_id" id="sistemex_image_id" value="<?php echo esc_attr( $image_id ); ?>" class="regular-text" />
 <input type='button' class="btn btn-primary fuente18" style="position: relative;
    top: -34px;width: 100%;" value="<?php esc_attr_e( 'Seleccionar imagen', 'mytextdomain' ); ?>" id="sistemex_media_manager"/>
       
   </div>

        
    </div>

 
  
  <!-- div style="position: relative;
    top: 20px;">
      <label>Sube tu im��gen:</label>
      <input type="file" name="file" id="file">
  </div -->


  <div class="col col-8 row">
     
     <div class="col-6">
         <i class="fa fa-question-circle justify-content-end" style="font-size:24px; position: absolute; left: 90%;" title="La url que redirecciona la imagen, tiene que llevar http:// o https://"></i>
     <label><strong>URL:</strong></label>
     <input name="url-banner" id="url-banner"  type="text" value="" size="40" style="height:30px; width:65%"/>
         
     </div>
     
      <div class="col-6">
         <i class="fa fa-question-circle"style="font-size:24px;position: absolute; left: 95%;" title="Título de la imagen"></i>
       <label><strong>Etiqueta (alt):</strong></label>
      	<input name="alt" id="alt" type="text" value="" size="40"style="height:30px;width:55%" />
         
     </div>
     
   
     <div class="col-12 row">
         
         <div class="col-4">
        <input type="checkbox" name="nuevotap1" id="nuevotap1" value="1"><span style="display:inline-block;">Nueva Pestaña</span>
 
         </div>
         <div class="col-4">
             <label><strong>Producto o Servicio</strong></label>
     <br>
     <select name="producto_servicio" id="producto_servicio" class="conselect2" required>
     <option value="">Selecciona un P/S </option>
     <?php foreach ($ps as $ps){
     echo '<option value="'.$ps->id.'">'.$ps->nombre.'</option>';  
     } ?>
     </select>
         </div>
         <div class="col-4">
             <label><strong>Buyer Journey </strong></label>
     <select name="buyer_journey" id="buyer_journey" class="conselect2" required>
     <option value="">Selecciona un Buyer Journey</option>
     <?php foreach ($by as $by){
     echo '<option value="'.$by->id.'">'.$by->nombre.'</option>';  
     } ?>
     </select>
         </div>
         
     </div>
  
     
     
    </div>



 



<div class="col-4 row " style="position: relative;
    left: 75%;">
    <div class="col-6">            
    <a href="<?php echo 'admin.php?page=sistemex-inbound%2Fincludes%2Fsistemex-inbound-table-banners.php' ?>" class="btn btn-warning fuente18" style="color:white;">Regresar</a>


    </div>
    <div class="col-6">
            <input type="submit" class="btn btn-primary fuente18" style="color:white;" value="Guardar"/>
        
    </div>
  
 

   </div>
  
</div> 
    
    </div>

    </div> 
    </div>
   
    </div>



</form>




<script>
    jQuery( document ).ready(function() {
        
        var idbanner =  jQuery('#linea_negocio').val();
        
          var data = {
            action: 'sistemex_get_banners',
            id: idbanner
        };

        jQuery.get(ajaxurl, data, function(response) {

            if(response.success === true) {
                console.log(response.data); 
                jQuery('#nombre').val(response.data.banner.nombre);
                jQuery('#url-banner').val(response.data.banner.url1);
                jQuery('#alt').val(response.data.banner.alt1);
                jQuery('#producto_servicio').val(response.data.banner.producto_servicio);
                jQuery('#buyer_journey').val(response.data.banner.buyer_journey);
                if(response.data.banner.nuevotap1 == "" || response.data.banner.nuevotap1 == 0){
                jQuery('#nuevotap1').attr('checked',false);
                }else{
                jQuery('#nuevotap1').attr('checked',true);
                }
                jQuery('#sistemex_image_id').val(response.data.banner.idImagen1);
                if(response.data.banner.urlImagen1 == ""){
                jQuery('#sistemex-preview-image').height(160).width(300); 
                }else{
                jQuery('#sistemex-preview-image').attr("src", response.data.banner.urlImagen1).height(160).width(300);
                }
                
                jQuery('.select2producto').select2().val(response.data.banner.producto_servicio);
                jQuery('.select2buyer').select2().val(response.data.banner.buyer_journey);
  
            }
        });
       
        
    });
    
</script>



<?php

if(isset($_REQUEST['init'])){

require_once( ABSPATH . 'wp-admin/includes/image.php' );
require_once( ABSPATH . 'wp-admin/includes/file.php' );
global $wpdb;

$url= sanitize_text_field($_REQUEST['url-banner']);
$nombre = sanitize_text_field($_REQUEST['nombre']); 
$alt = sanitize_text_field($_REQUEST['alt']); 
$urlImagenBanner1 = sanitize_text_field($_REQUEST['sistemex_image_id']);
$urlImagenB1= wp_get_attachment_url($urlImagenBanner1);
$idlineanegocio = sanitize_text_field($_REQUEST['linea_negocio']);
$idImagen1 = sanitize_text_field($_REQUEST['sistemex_image_id']);
$producto_servicio = sanitize_text_field($_REQUEST['producto_servicio']);
$buyer_journey = sanitize_text_field($_REQUEST['buyer_journey']);
$nuevotap1 = sanitize_text_field($_REQUEST['nuevotap1']);

            if($urlImagenB1 == null || $urlImagenB1 == ''){
                  $tipo=null;
             }else{
                $tipo=1;
             }
             
             $wpdb->update('sistemex_inbound_banners', array(
                        'urlImagen1' => $urlImagenB1,
                        'nombre'=>$nombre,
                        'producto_servicio'=>$producto_servicio,
                        'buyer_journey'=>$buyer_journey,
                        'url1'=>$url,
                        'alt1'=>$alt,
                        'tipo1'=>$tipo,
                        'idImagen1'=>$idImagen1,
                        'nuevotap1'=>$nuevotap1,
                       ), 
                       array( 'id' => $idlineanegocio )
             );

 echo '<script>window.location="admin.php?page=sistemex-inbound%2Fincludes%2Fsistemex-inbound-table-banners.php"</script>';    
             


}



?>
<?php
add_action( 'admin_footer', 'media_selector_print_scripts' );

function media_selector_print_scripts() {

	$my_saved_attachment_post_id = get_option( 'media_selector_attachment_id', 0 );

	?>
	<script type='text/javascript'>
		jQuery( document ).ready( function( $ ) {
			// Uploading files
			var file_frame;
			var wp_media_post_id = wp.media.model.settings.post.id; // Store the old id
			var set_to_post_id = <?php echo $my_saved_attachment_post_id; ?>; // Set this
			jQuery('#upload_image_button').on('click', function( event ){
				event.preventDefault();
				// If the media frame already exists, reopen it.
				if ( file_frame ) {
					// Set the post ID to what we want
					file_frame.uploader.uploader.param( 'post_id', set_to_post_id );
					// Open frame
					file_frame.open();
					return;
				} else {
					// Set the wp.media post id so the uploader grabs the ID we want when initialised
					wp.media.model.settings.post.id = set_to_post_id;
				}
				// Create the media frame.
				file_frame = wp.media.frames.file_frame = wp.media({
					title: 'Select Media',
					button: {
						text: 'Elegir',
					},
					multiple: false	// Set to true to allow multiple files to be selected
				});
				// When an image is selected, run a callback.
				file_frame.on( 'select', function() {
					// We set multiple to false so only get one image from the uploader
					attachment = file_frame.state().get('selection').first().toJSON();
					// Do something with attachment.id and/or attachment.url here
					 jQuery( '#sistemex-preview-image' ).attr( 'src', attachment.url ).css( 'width', '300','height','160' );
					 jQuery( '#sistemex_image_id' ).val( attachment.id );
					// Restore the main post ID
					wp.media.model.settings.post.id = wp_media_post_id;
				});
					// Finally, open the modal
					file_frame.open();
			});
			// Restore the main ID when the add media button is pressed
			jQuery( 'a.add_media' ).on( 'click', function() {
				wp.media.model.settings.post.id = wp_media_post_id;
			});
		});
	</script><?php
}
?>
