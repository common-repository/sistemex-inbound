


<?php
include "header.php";
 global $wpdb;
  $banners =  $wpdb->get_results("SELECT * FROM sistemex_interlinking");
    $banners2 =  $wpdb->get_results("SELECT * FROM sistemex_interlinking");
 $keyword= sanitize_text_field($_GET['keyword']);
 
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
<br>
   

<div style="width: 50%;position:relative;left:30%;">
<form id="addbanner" method="post" action="" enctype="multipart/form-data" >
    <div class="form-field form-required term-name-wrap">
    
    <input type="hidden" name="init" value="1">
    <input type="hidden" name="keyword_id" id="keyword_id" value="<?php echo $keyword; ?>">
    </div>
        

    <div class="container">
    <div class="row">
   <div class="form-wrap" style="border:0px; border-style:solid;width: 50%; background-color:#FFFFFF;border-collapse: separate;border-spacing: 15px; height:auto ; width:auto ;padding:10px; border-radius:10px;">
      <label>Keyword:</label>
      	<input name="keyword" id="keyword"  type="text" value="" size="40" />
      	<div class="col col-12 row">
    <div class="col col-4">

  </div>
  </div>
    
  <div>
      <label>URL:</label>
      	<input name="url" id="url" type="text" value="" size="40" />
        <div class="col col-4">
            
  </div>
  
   
  <div>
      <label>Tema:</label>
      	<input name="tema" id="tema" type="text" value="" size="40" />
        <div class="col col-4">
  </div>
  
  
<div>
    
    
<label>Attr Rel:</label>
<select id="rel" name="rel" class="width100">
<option value="no">no</option>
<option value="alternate">alternate</option>
<option value="author">author</option>
<option value="bookmark">bookmark</option>
<option value="help">help</option>
<option value="license">license</option>
<option value="next">next</option>
<option value="nofollow">nofollow</option>
<option value="noreferrer">noreferrer</option>
<option value="prefetch">prefetch</option>
<option value="prev">prev</option>
<option value="search">search</option>
<option value="tag">tag</option>
</select>
</div>
<div>
<label>Attr Target:</label>
<select id="target" name="target" class="width100"> 
<option value="no">no</option>
<option value="_blank">_blank</option>
<option value="_parent">_parent</option>
<option value="_self">_self</option>
<option value="_top">_top</option>	
</select>
</div>
 <br>
<a href="<?php echo 'admin.php?page=sistemex-inbound%2Fincludes%2Fsistemex-interlinking-table.php' ?>" class="btn btn-warning fuente18" style="color:white;" >Regresar</a>
<input type="submit" class="btn btn-primary fuente18" style="float:right; color:white;" value="Guardar"/>

    

</div>


</form> 
</div>
</div>







<?php

if(isset($_REQUEST['init'])){




global $wpdb;

$idkeyword = sanitize_text_field($_REQUEST['keyword_id']);
$url= sanitize_text_field($_REQUEST['url']);
$keyword= sanitize_text_field($_REQUEST['keyword']);
$tema= sanitize_text_field($_REQUEST['tema']);
$rel= sanitize_text_field($_REQUEST['rel']);
$target= sanitize_text_field($_REQUEST['target']);

 $wpdb->update('sistemex_interlinking', array(
                      
                        'url'=>$url,
                        'keyword'=>$keyword,
                        'tema'=> $tema,
                        'rel'=> $rel,
                        'target'=> $target,
                        'value'=>strlen($keyword),
                       ), 
                       array( 'id' => $idkeyword )
             );
 echo '<script>window.location="admin.php?page=sistemex-inbound%2Fincludes%2Fsistemex-interlinking-table.php"</script>';    

//header('Location: admin.php?page=sistemex-inbound%2Fincludes%2Fsistemex-interlinking-table.php');

}




?>
</div>
</div>

 
      


</form>




<script>
    jQuery( document ).ready(function() {
        
        var idkeyword = jQuery('#keyword_id').val();
        
          var data = {
            action: 'sistemex_get_keyword',
            id: idkeyword
        };

        jQuery.get(ajaxurl, data, function(response) {

            if(response.success === true) {
                console.log(response.data); 
                jQuery('#keyword').val(response.data.keyword.keyword);
                jQuery('#url').val(response.data.keyword.url);
                jQuery('#tema').val(response.data.keyword.tema);
                jQuery('#rel').val(response.data.keyword.rel);
                jQuery('#target').val(response.data.keyword.target);
            }
        });
       
        
    });
    
</script>
<script>
jQuery(document).ready(function() {
    jQuery('.conselect2').select2();
    
});
</script>
<footer class="colorblanco foo">&copy; Copyright 2019 <a href="https://sistemex.com/" target="_blank" class="colorblanco">Sistemex</a> &nbsp;&nbsp;</footer>
