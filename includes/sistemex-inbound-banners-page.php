<div>
    
    <div class="form-wrap col-10 row" style="display: -webkit-box;" >
 <div class="col-3">
     <img src="<?php echo plugins_url('imagenes/sistemexlogo2.png', __FILE__)
     ?>" width="200">

 </div>
 <div class="col-6">
     <h2 style="margin: 0px 0;">INBOUND MARKETING</h2>
 </div>

</div>



<div class="form-wrap" >
<h2>Información del Banner</h2>

<form id="addtag" method="post" enctype="multipart/form-data" action="" >





	


</div>
<?php 
global $wpdb;

$ps = $wpdb->get_results("SELECT * FROM sistemex_productos_servicios;");
$by = $wpdb->get_results("SELECT * FROM sistemex_buyer_journey;");

$image_id = get_option( 'sistemex_image_id' );
if( intval( $image_id ) > 0 ) {
    // Change with the image size you want to use
    $image = wp_get_attachment_image( $image_id, 'medium', false, array( 'id' => 'sistemex-preview-image' ) );
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
    <div class=" col col-12 form-field form-required term-name-wrap">
	<!--<label for="tag-name"><?php _ex( 'Name', 'term name' ); ?></label>-->
	<input name="nombre" id="nombre" type="text" value="" size="40" style="height:30px; font-size: 16px;" aria-required="true" required placeholder="Nombre del banner" />
</div>
    <div class="col col-12 row"style="Margin-top:35px">
    <div class="col col-4 row">
   <div class="col-12">
<?php echo $image;?>
 
       
   </div>
   <div class="col-12">
 <input type="hidden" name="sistemex_image_id" id="sistemex_image_id" value="<?php echo esc_attr( $image_id ); ?>" class="regular-text" />
 <input type='button' class="btn btn-primary fuente18" style="position: relative;
    top: -34px;width: 100%;" value="<?php esc_attr_e( 'Seleccionar imagen', 'mytextdomain' ); ?>" id="sistemex_media_manager"/>
       
   </div>

        
    </div>

 


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
        <input type="checkbox" name="nuevotap1" value="1"><span style="display:inline-block;">Nueva Pestaña</span>
 
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
     echo '<option value="'.$by->id.'">'.$by->nombre.'</option>';}?>
     </select>
         </div>
         
     </div>
  
     
     
    </div>



 



<div class="col-4 row " style="position: relative;
    left: 75%;">
    <div class="col-6">            
    <a href="<?php echo 'admin.php?page=sistemex-inbound%2Fincludes%2Fsistemex-inbound-table-banners.php'?>" class="btn btn-warning fuente18" style="color:white;">Regresar</a>


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
<?php
if(isset($_REQUEST['init'])){
require_once(ABSPATH.'wp-admin/includes/image.php');
require_once(ABSPATH.'wp-admin/includes/file.php');
global $wpdb;
$url= sanitize_text_field($_REQUEST['url-banner']);
$nombre = sanitize_text_field($_REQUEST['nombre']); 
$alt = sanitize_text_field($_REQUEST['alt']); 
$urlImagenBanner1 = sanitize_text_field($_REQUEST['sistemex_image_id']);
$urlImagenB1= wp_get_attachment_url($urlImagenBanner1);
$idImagen1 = sanitize_text_field($_REQUEST['sistemex_image_id']);
$producto_servicio = sanitize_text_field($_REQUEST['producto_servicio']);
$buyer_journey = sanitize_text_field($_REQUEST['buyer_journey']);
if(isset($_REQUEST['nuevotap1'])){
   $nuevotap1 = sanitize_text_field($_REQUEST['nuevotap1']); 
}else{
    $nuevotap1 =0;
}

if($urlImagenB1 == null || $urlImagenB1 == ''){
                  $tipo=null;
             }else{
                $tipo=1;
             }
$insertar=$wpdb->insert('sistemex_inbound_banners',array(
                        'urlImagen1' =>$urlImagenB1,
                        'nombre'=>$nombre,
                        'producto_servicio'=>$producto_servicio,
                        'buyer_journey'=>$buyer_journey,
                        'url1'=>$url,
                        'alt1'=>$alt,
                        'tipo1'=>$tipo,
                        'idImagen1'=>$idImagen1,
                        'nuevotap1'=>$nuevotap1,
                       ));
if($insertar){
 echo '<script>window.location="admin.php?page=sistemex-inbound%2Fincludes%2Fsistemex-inbound-table-banners.php"</script>';    
 //header('Location:admin.php?page=sistemex-inbound%2Fincludes%2Fsistemex-inbound-table-banners.php');
 //exit();
}                       
  
}?>
</div>
<script>
jQuery(document).ready(function() {
    $('.conselect2').select2();
    
});
</script>
