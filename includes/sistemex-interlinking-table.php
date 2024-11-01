
<?php
include "header.php";

?>

<div>

<div class="form-wrap col-10 row" style="display: -webkit-box;" >
 <div class="col-3">
     <img src="<?php echo plugins_url('imagenes/sistemexlogo2.png', __FILE__) ?>" width="200">

 </div>
 <div class="col-6">
     <h2 style="margin: 0px 0;">INBOUND MARKETING</h2>
 </div>

</div>
<?php 
global $wpdb;

$interlinking = $wpdb->get_results("SELECT * FROM sistemex_interlinking;");

$limite = $wpdb->get_results("SELECT * FROM sistemex_interlinking_configuracion where id=1;");

?>
<br>

<div class="container kt-portlet kt-portlet--head--noborder kt-portlet--height-fluid">
    
    <div class="kt-portlet__head">
		<div class="kt-portlet__head-label">
			<h3 class="kt-portlet__head-title">
				Listado de Keywords
			</h3>
		</div>
		<div class="kt-portlet__head-toolbar">
	   
<button type="button" style="font-size: small;" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Configuración
</button>
&nbsp;
&nbsp;
<a href="<?php echo 'admin.php?page=sistemex-inbound%2Fincludes%2Fmfp-first-page.php' ?>" class="btn btn-primary fas fa-plus-circle fuente18" style="color:white;"> &nbsp; Keyword</a>


		</div>
			</div>
			
			<div class="kt-portlet__body">
<table id="interlinkingTable" class="display">
        <thead>
            <tr>
                <th>Keyword</th>
                <th>Url</th>
                <th>Tema</th>
                <th>Rel</th>
                <th>Target</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>

                <?php foreach ($interlinking as $interlinking){

                echo '<tr>';  
                echo '<td> <a class="colorsistemex" href="admin.php?page=sistemex-inbound%2Fincludes%2Fsistemex-inbound-interlinking-page-edit.php&keyword='. $interlinking->id .'">' .$interlinking->keyword. '</a></td>';
                echo '<td>' .$interlinking->url. '</td>';
                echo '<td>' .$interlinking->tema. '</td>';
                echo '<td>' .$interlinking->rel. '</td>';
                echo '<td>' .$interlinking->target. '</td>';
                echo '<td><button style="font-size: large;" id="eliminarKeyword'.$interlinking->id.'" class="btn btn_delete btn-primary fas fa-trash-alt" value="'.$interlinking->id.'"></button>
                      <a style="font-size: large;" class="btn btn-primary fas fa-pencil-alt" href="admin.php?page=sistemex-inbound%2Fincludes%2Fsistemex-inbound-interlinking-page-edit.php&keyword='. $interlinking->id .'"></a>
                      </td>';
                echo '</tr>';
                } ?>
  
        </tbody>

    </table>
</div>





<script>
jQuery( document ).ready(function( $ ) {
jQuery('#interlinkingTable').DataTable({
    "oLanguage": {

    "sSearch": "Buscar:"

        },
        columnDefs: [
            {
                targets: [ 0, 1, 2 ],
                className: 'mdl-data-table__cell--non-numeric'
            }
        ]
    });

});
// Code that uses other library's $ can follow here.
</script>

<script>
    jQuery(document).on('click', '.btn_delete', function(event){
    var ps_table = jQuery('#interlinkingTable').DataTable();
    var counter = 1;
	event.preventDefault();
	var tbl_row = jQuery(this).closest('tr');

	var row_id = tbl_row.attr('row_id');
	console.log();
        
        var id_ps = (jQuery(this).attr('value'));
    var data = {
            action: 'sistemex_post_delete_keyword',
            id: id_ps
        };
        
        jQuery.get(ajaxurl, data, function(response) {

            if(response.success === true) {
                console.log(response); 
            ps_table.clear().draw();
            for (var i=0; i<response.data.length; i++) {
               ps_table.row.add( [
                '<a class="colorsistemex"  href="admin.php?page=sistemex-inbound%2Fincludes%2Fsistemex-inbound-interlinking-page-edit.php&keyword='+ response.data[i].id +'">' + response.data[i].keyword +'</a>',
                   response.data[i].url,
                   response.data[i].tema,
                   response.data[i].rel,
                  response.data[i].target,
                  '<button style="font-size: large;" id="eliminarKeyword'+response.data[i].id+'" class="btn btn_delete btn-primary fas fa-trash-alt" value="'+response.data[i].id+'"></button>'
                  + '<a style="font-size: large;" class="btn btn-primary fas fa-pencil-alt" href="admin.php?page=sistemex-inbound%2Fincludes%2Fsistemex-inbound-interlinking-page-edit.php&keyword='+response.data[i].id+'"></a>'

                ] ).draw( false );
                }
            ps_table.draw(); 
            }
            
           
        
        });
    

});
</script>

</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <form id="addbanner" method="post" action="" enctype="multipart/form-data" >

      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Configuración</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            
        <input type="hidden" name="init" value="1">
        
        <div class="form-group">
            
    <label for="Limite">Límite (Sin límite ingresar -1)</label>
    <input type="number" name="limite" style="width:50%"  value="<?php echo $limite[0]->limite ?>" class="form-control" id="limite" min="-1" max="100">
  </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Guardar</button>
      </div>
       </form>
    </div>
  </div>
</div>
<?php

if(isset($_REQUEST['init'])){




global $wpdb;

$limite= sanitize_text_field($_REQUEST['limite']);


 $wpdb->update('sistemex_interlinking_configuracion', array(
                      
                        'limite'=>$limite,
                       
                       ),
                       array( 'id' => "1" )
             );

 echo '<script>window.location="admin.php?page=sistemex-inbound%2Fincludes%2Fsistemex-interlinking-table.php"</script>';    


}




?>

