<div>


<div class="form-wrap col-10 row" style="display: -webkit-box;" >
 <div class="col-3">
     <img src="<?php echo plugins_url('imagenes/sistemexlogo2.png', __FILE__) ?>" width="200">

 </div>
 <div class="col-6">
     <h2 style="margin: 0px 0;">INBOUND MARKETING</h2>
 </div>
 
<form id="addtag" method="post" enctype="multipart/form-data" action="" >

<input type="hidden" name="init" value="1">
</div>
<br>
<?php 
global $wpdb;

$ps = $wpdb->get_results("SELECT * FROM sistemex_productos_servicios;");
$by = $wpdb->get_results("SELECT * FROM sistemex_buyer_journey;");
$banners =  $wpdb->get_results("SELECT * FROM sistemex_inbound_banners");
$banners2 =  $wpdb->get_results("SELECT * FROM sistemex_inbound_banners");
$cta= sanitize_text_field($_GET['cta']);

?>


<div class="kt-portlet kt-portlet--head--noborder kt-portlet--height-fluid">
    <div class="kt-portlet__body">
        <div class="row">
    <div class="form-wrap" style="border:0px; border-style:solid;width: 100%; background-color:#FFFFFF;border-collapse: separate;
  border-spacing: 15px; height:auto; border-radius:10px;" align="center">
<br>
<div class="col col-12">
    <h2><strong>Editar CTA</strong></h2>
	<!--<label for="tag-name"><?php _ex( 'Name', 'term name' ); ?></label>-->
	<input name="nombre" id="nombre" type="text" value="" size="40" style="height:30px; font-size: 16px;" class="input90" aria-required="true" required placeholder="Nombre del grupo de CTA" />
</div>
<input type="hidden" name="id_cta" id="id_cta" value="<?php echo $cta ?>">
<div class="col col-12 row">
<div class="col col-6">
     
     <label><strong>Producto o Servicio</strong></label>
     <i class="fa fa-tag"style="font-size:24px; vertical-align: middle;"></i>
     <select name="producto_servicio" id="producto_servicio" class="input80 select2producto" required>
     <option value="">Selecciona un P/S </option>
     <?php foreach ($ps as $ps){
     echo '<option value="'.$ps->id.'">'.$ps->nombre.'</option>';  
     } ?>
     </select>
     
</div>

<div class="col col-6">
      
     <label><strong>Buyer Journey</strong></label>
     <i class="fa fa-globe"style="font-size:24px; vertical-align: middle;"></i>
     <select name="buyer_journey" id="buyer_journey" class="input80 select2buyer" required>
     <option value="0">Selecciona un Buyer Journey</option>
     <?php foreach ($by as $by){
     echo '<option value="'.$by->id.'">'.$by->nombre.'</option>';  
     } ?>
     </select>
     
</div>
</div>
<br>
<br>

<div class="col col-12 row">
<div class="col col-6">
    <label><strong>Agregar Banner Medio</strong></label>
    <i class="fa fa-image"style="font-size:24px; vertical-align: middle;"></i>
     <select name="banner_medio" id="banner_medio" class="input80 select2banner_medio">
     <option value="0">Selecciona un Banner</option>
     <?php foreach ($banners as $banners){
     echo '<option value="'.$banners->id.'">'.$banners->nombre.'</option>'; 
     } ?>
     
     </select>
     <br>
     <div class="col">
     <input type="hidden" name="img_banner_medio" id="img_banner_medio" value="">
     <input type="hidden" name="url1" id="url1" value="">
     <input type="hidden" name="alt1" id="alt1" value="">
     <input type="hidden" name="nuevotap1" id="nuevotap1" value="">
     <img id="url_banner_medio" name="url_banner_medio" src="" width="300px" height="160px" /> <br><br>
     <div id="caja_banner_medio">
     <!--p class="enlinea">Buyer Journey: </p>&nbsp;<p class="enlinea" id="by_banner_medio"></p-->
     </div>
    </div>
</div>

<div class="col col-6">
      
      <label><strong>Agregar Banner Inferior</strong></label>
    <i class="fa fa-image"style="font-size:24px; vertical-align: middle;"></i>
     <select name="banner_inferior" id="banner_inferior" class="input80 select2banner_inferior">
     <option value="">Selecciona un Banner</option>
     <?php foreach ($banners2 as $banners2){
     echo '<option value="'.$banners2->id.'">'.$banners2->nombre.'</option>';  
     } ?>
     </select>
     <br>
     <div class="col">
     <input type="hidden" name="img_banner_inferior" id="img_banner_inferior" value="">
     <input type="hidden" name="url2" id="url2" value="">
     <input type="hidden" name="alt2" id="alt2" value="">
     <input type="hidden" name="nuevotap2" id="nuevotap2" value="">
     <img id="url_banner_inferior" name="url_banner_inferior" src="" width="300px" height="160px" /> <br><br>
     <div id="caja_banner_inferior">
     <!--p class="enlinea">Buyer Journey: </p>&nbsp;<p class="enlinea" id="by_banner_inferior"></p-->
     </div>
    </div>
</div>
</div>
</div>
</div>
<div class="col-12" align="right">

<div>
<div class="form-wrap" style="display:table-cell;margin-top:50px;width:10%;height: 10px;">
    <a href="<?php echo 'admin.php?page=sistemex-inbound%2Fincludes%2Fsistemex-inbound-table.php' ?>" class="btn btn-warning fuente18" style="color:white;">Regresar</a>
    <input type="submit" class="btn btn-primary fuente18"  style="color:white;" value="Guardar"/>

  
</div> 
</div>
</div>
        </div>
     
</div>



</form>

<script>
jQuery( document ).ready(function() {
    
var idcta = jQuery('#id_cta').val();
        
          var data = {
            action: 'sistemex_get_cta',
            id: idcta
        };

        jQuery.get(ajaxurl, data, function(response) {

            if(response.success === true) {
                console.log(response.data);
                console.log(response.data.cta.banner_inferior);
                console.log('aqui empieza');
                console.log(response.data.cta.banner_medio);
                jQuery('#nombre').val(response.data.cta.nombre);
                jQuery('#banner_medio ').val(response.data.cta.id_banner_medio).prop('selected', true);;
                jQuery('#banner_inferior').val(response.data.cta.id_banner_inferior).prop('selected', true);;
                jQuery('#producto_servicio').val(response.data.cta.producto_servicio).prop('selected', true);;
                jQuery('#buyer_journey').val(response.data.cta.buyer_journey).prop('selected', true);;
                
                if(response.data.cta.banner_inferior == ""){
                    jQuery('#url_banner_inferior').attr('src'," ");
                }else{
                    jQuery('#url_banner_inferior').attr('src',response.data.cta.banner_inferior);
                }
                
                if(response.data.cta.banner_medio == ""){
                    jQuery('#url_banner_medio').hide();
                    jQuery('#url_banner_medio').attr('src',"");
                }else{
                    jQuery('#url_banner_medio').attr('src',response.data.cta.banner_medio);
                }
                
                jQuery('#url1').val(response.data.cta.url1);
                jQuery('#alt1').val(response.data.cta.alt1);
                jQuery('#nuevotap1').val(response.data.cta.nuevotap1);
                jQuery('#url2').val(response.data.cta.url2);
                jQuery('#alt2').val(response.data.cta.alt2);
                jQuery('#nuevotap2').val(response.data.cta.nuevotap2);
                jQuery('#img_banner_medio').val(response.data.cta.banner_medio);
                jQuery('#img_banner_inferior').val(response.data.cta.banner_inferior);
                
            }
        });

var idbannerMedio = jQuery('#banner_medio').val();
        
          var data = {
            action: 'sistemex_get_banners_medio',
            id: idbannerMedio
        };

        jQuery.get(ajaxurl, data, function(response) {

            if(response.success === true) {
                console.log(response.data); 
                jQuery('#url_banner_medio').attr('src',response.data.banner.urlImagen1);
                jQuery('#img_banner_medio').val(response.data.banner.urlImagen1);
                jQuery('#by_banner_medio').text(response.data.banner.buyer_journey);
                jQuery('#url1').val(response.data.banner.url1);
                jQuery('#alt1').val(response.data.banner.alt1);
                jQuery('#nuevotap1').val(response.data.banner.nuevotap1);
            }
        });
        
var idbanner = jQuery('#banner_inferior').val();
console.log(idbanner);
        
          var data = {
            action: 'sistemex_get_banners_inferior',
            id: idbanner
        };

        jQuery.get(ajaxurl, data, function(response) {

            if(response.success === true) {
                console.log(response.data); 
                jQuery('#url_banner_inferior').attr('src',response.data.banner.urlImagen1);
                jQuery('#img_banner_inferior').val(response.data.banner.urlImagen1);
                jQuery('#by_banner_inferior').text(response.data.banner.buyer_journey);
                jQuery('#url2').val(response.data.banner.url1);
                jQuery('#alt2').val(response.data.banner.alt1);
                jQuery('#nuevotap2').val(response.data.banner.nuevotap1);
            }
        });
        
});
</script>

<script>
jQuery('#producto_servicio').change(function() {

         var id = jQuery(this).val();
         var idServicio = jQuery('#producto_servicio').val();
          var idBuyer = jQuery('#buyer_journey').val();
          if(idServicio == ""){
                idServicio=0;
            }
            if(idBuyer == ""){
                idBuyer=0;
            }
          var data = {
            action: 'sistemex_get_ps_banner',
            id: id,
            idServicio: idServicio,
            idBuyer:idBuyer
        };

        jQuery.get(ajaxurl, data, function(response) {
            
            if(response.success === true) {
            console.log(response);
            var banner_medio = $('#banner_medio');
            banner_medio.empty();
            banner_medio.append('<option value="0">Selecciona un banner</option>');
            for (var i = 0; i < response.data.banner_medio.length; i++) {
                banner_medio.append('<option value='+response.data.banner_medio[i].id+'>'+response.data.banner_medio[i].nombre+'</option>');
            }
            
            var banner_inferior = $('#banner_inferior');
            banner_inferior.empty();
            banner_inferior.append('<option value="0">Selecciona un banner</option>');
            for (var i = 0; i < response.data.banner_inferior.length; i++) {
                
                banner_inferior.append('<option value='+response.data.banner_inferior[i].id+'>'+response.data.banner_medio[i].nombre+'</option>');
            }
            
           banner_medio.change();
            
               
                jQuery('#caja_banner_medio').show();
                jQuery('#caja_banner_inferior').show();
                jQuery('#url_banner_medio').hide();
                jQuery('#url_banner_inferior').hide();
                jQuery('#by_banner_medio').text(response.data.by.nombre);
                jQuery('#by_banner_inferior').text(response.data.by.nombre);
                
     
            }
            
    });    

 });
</script>
<script>
jQuery('#buyer_journey').change(function() {

            var id = jQuery(this).val();
            var idServicio = jQuery('#producto_servicio').val();
            
            if(idServicio == ""){
                idServicio=0;
            }
            if(id == ""){
                id=0;
            }
          var data = {
            action: 'sistemex_get_by_banner',
            id: id,
            idServicio: idServicio,
            idBuyer:id
        };
        
        console.log(data);

        jQuery.get(ajaxurl, data, function(response) {
            
            if(response.success === true) {
            
            var banner_medio = jQuery('#banner_medio');
            banner_medio.empty();
            banner_medio.append('<option value="0">Selecciona un banner</option>');
            for (var i = 0; i < response.data.banner_medio.length; i++) {
                banner_medio.append('<option value='+response.data.banner_medio[i].id+'>'+response.data.banner_medio[i].nombre+'</option>');
            }
            
            var banner_inferior = jQuery('#banner_inferior');
            banner_inferior.empty();
            banner_inferior.append('<option value="0">Selecciona un banner</option>');
            for (var i = 0; i < response.data.banner_inferior.length; i++) {
                banner_inferior.append('<option value='+response.data.banner_inferior[i].id+'>'+response.data.banner_medio[i].nombre+'</option>');
            }
            
           banner_medio.change();
               
                jQuery('#caja_banner_medio').show();
                jQuery('#caja_banner_inferior').show();
                jQuery('#url_banner_medio').hide();
                jQuery('#url_banner_inferior').hide();
                jQuery('#by_banner_medio').text(response.data.by.nombre);
                jQuery('#by_banner_inferior').text(response.data.by.nombre);
                
                
     
            }
            
        
    });    

 });
</script>

<script>
    jQuery('#banner_medio').on('change', function() {
        
        var idbanner = jQuery('#banner_medio').val();
                        console.log(idbanner); 

        
          var data = {
            action: 'sistemex_get_banners',
            id: idbanner
        };
        console.log(idbanner != 0);
        if(idbanner != 0){
                    jQuery.get(ajaxurl, data, function(response) {

            if(response.success === true) {
                url_banner_inferior
                
                jQuery('#url_banner_medio').attr('src',response.data.banner.urlImagen1);
                jQuery('#img_banner_medio').val(response.data.banner.urlImagen1);
                jQuery('#url1').val(response.data.banner.url1);
                jQuery('#alt1').val(response.data.banner.alt1);
                jQuery('#nuevotap1').val(response.data.banner.nuevotap1);
                jQuery('#url_banner_medio').show();
            }
        });

        }else{
            jQuery('#url_banner_medio').attr('src','');
                jQuery('#img_banner_medio').val('');
                jQuery('#url1').val('');
                jQuery('#alt1').val('');
                jQuery('#nuevotap1').val('');
                jQuery('#url_banner_medio').hide();
        }
        
        
        
    });
    
</script>

<script>
    jQuery('#banner_inferior').change(function() {
        
        var idbanner = jQuery('#banner_inferior').val();
        
          var data = {
            action: 'sistemex_get_banners',
            id: idbanner
        };
        if(idbanner != 0){
    jQuery.get(ajaxurl, data, function(response) {

            if(response.success === true) {
                console.log(response.data); 
                jQuery('#url_banner_inferior').attr('src',response.data.banner.urlImagen1);
                jQuery('#img_banner_inferior').val(response.data.banner.urlImagen1);
                jQuery('#url2').val(response.data.banner.url1);
                jQuery('#alt2').val(response.data.banner.alt1);
                jQuery('#nuevotap2').val(response.data.banner.nuevotap1);
                jQuery('#url_banner_inferior').show();
            }
        });
    }else{
        jQuery('#url_banner_inferior').attr('src','');
                jQuery('#img_banner_inferior').val('');
                jQuery('#url2').val('');
                jQuery('#alt2').val('');
                jQuery('#nuevotap2').val('');
                jQuery('#url_banner_inferior').hide();
    }
        
       
        
    });
    
</script>



<?php

if(isset($_REQUEST['init'])){



require_once( ABSPATH . 'wp-admin/includes/image.php' );
require_once( ABSPATH . 'wp-admin/includes/file.php' );
global $wpdb;

$idcta = sanitize_text_field($_REQUEST['id_cta']); 
$nombre = sanitize_text_field($_REQUEST['nombre']); 
$banner_medio = sanitize_text_field($_REQUEST['banner_medio']); 
$banner_inferior = sanitize_text_field($_REQUEST['banner_inferior']);
$img_banner_medio = sanitize_text_field($_REQUEST['img_banner_medio']); 

$img_banner_inferior = sanitize_text_field($_REQUEST['img_banner_inferior']);
$url1 = sanitize_text_field($_REQUEST['url1']); 
$alt1 = sanitize_text_field($_REQUEST['alt1']);
$nuevotap1 = sanitize_text_field($_REQUEST['nuevotap1']);
$url2 = sanitize_text_field($_REQUEST['url2']); 
$alt2 = sanitize_text_field($_REQUEST['alt2']);
$nuevotap2 = sanitize_text_field($_REQUEST['nuevotap2']);
$producto_servicio = sanitize_text_field($_REQUEST['producto_servicio']);
$buyer_journey = sanitize_text_field($_REQUEST['buyer_journey']);

             $wpdb->update('sistemex_inbound_cta', array(
                        'nombre'=>$nombre,
                        'producto_servicio'=>$producto_servicio,
                        'buyer_journey'=>$buyer_journey,
                        'id_banner_medio'=>$banner_medio,
                        'id_banner_inferior'=>$banner_inferior,
                        'banner_medio'=>$img_banner_medio,
                        'banner_inferior'=>$img_banner_inferior,
                        'url1'=>$url1,
                        'alt1'=>$alt1,
                        'nuevotap1'=>$nuevotap1,
                        'url2'=>$url2,
                        'alt2'=>$alt2,
                        'nuevotap2'=>$nuevotap2,
                       ),
                       array( 'id' => $idcta )
             );

 echo '<script>window.location="admin.php?page=sistemex-inbound%2Fincludes%2Fsistemex-inbound-table.php"</script>';    

//header('Location: admin.php?page=sistemex-inbound%2Fincludes%2Fsistemex-inbound-table.php');

}




?>

</div>
<script>
jQuery(document).ready(function() {
    jQuery('.conselect2').select2();
    
    
});
</script>
<footer class="colorblanco foo">&copy; Copyright 2019 <a href="https://sistemex.com/" target="_blank" class="colorblanco">Sistemex</a> &nbsp;&nbsp;</footer>
