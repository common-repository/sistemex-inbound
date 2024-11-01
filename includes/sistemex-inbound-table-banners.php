<div>

<div class="form-wrap col-10 row" style="display: -webkit-box;" >
 <div class="col-3">
     <img src="<?php
     echo plugins_url('imagenes/sistemexlogo2.png', __FILE__) ?>" width="200">

 </div>
 <div class="col-6">
     <h2 style="margin: 0px 0;">INBOUND MARKETING</h2>
 </div>

</div>
<br>
<?php 
global $wpdb;

$banners = $wpdb->get_results("SELECT banner.*,ps.nombre as nombre_ps, bj.nombre as nombre_bj FROM sistemex_inbound_banners as banner LEFT JOIN sistemex_productos_servicios as ps ON ps.id = banner.producto_servicio LEFT JOIN sistemex_buyer_journey as bj ON bj.id = banner.buyer_journey;");
?>
<br>


<div class="container kt-portlet kt-portlet--head--noborder kt-portlet--height-fluid">
    
     <div class="kt-portlet__head">
		<div class="kt-portlet__head-label">
			<h3 class="kt-portlet__head-title">
				Listado de Banners
			</h3>
		</div>
		<div class="kt-portlet__head-toolbar">
		<a href="<?php echo 'admin.php?page=sistemex-inbound%2Fincludes%2Fsistemex-inbound-banners-page.php' ?>" class="btn btn-primary fas fa-plus-circle fuente18" style="color:white;"> &nbsp;Banner</a>


		</div>
			</div>
    


<div class="kt-portlet__body">
    <table id="banners_table" class="display">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>P/S</th>
                <th>Buyer Journey</th>
                <th>Imagen</th>
                <th>URL</th>
                <th>Etiqueta (alt)</th>
                <th>Nueva pestaña</th>
                 <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
<?php 
foreach ($banners as $banners){
            

                if($banners->nuevotap1 == 1){
                    $nuevotab = 'Si';
                }else{
                    $nuevotab = 'No';
                }
                
                
                echo '<tr>';
                echo '<td> <a class="colorsistemex" href="admin.php?page=sistemex-inbound%2Fincludes%2Fsistemex-inbound-banners-page-edit.php&cta='. $banners->id .'">' .$banners->nombre. '</a></td>';
                echo '<td>' .$banners->nombre_ps. '</td>';
                echo '<td>' .$banners->nombre_bj. '</td>';
                echo '<td><img src="'.esc_url($banners->urlImagen1).'" width="220px"></td>';
                echo '<td>' .$banners->url1. '</td>';
                echo '<td>' .$banners->alt1. '</td>';
                echo '<td>' .$nuevotab. '</td>';
                echo '<td><button style="font-size: large;" id="eliminarKeyword'.$banners->id.'" class="btn btn_delete btn-primary fas fa-trash-alt" value="'.$banners->id.'"></button>
                      <a style="font-size: large;" class="btn btn-primary fas fa-pencil-alt" href="admin.php?page=sistemex-inbound%2Fincludes%2Fsistemex-inbound-banners-page-edit.php&cta='. $banners->id .'"></a>
                      </td>';
                echo '</tr>';
}?>
  
        </tbody>

    </table>
    </div>



</div>





<script>

jQuery( document ).ready(function( $ ) {
 jQuery('#banners_table').DataTable({
    "bInfo" : false,
    "oLanguage": {

    "sSearch": "Buscar:"

        },
    "scrollY":        400,
"order": [[ 2, "asc" ]],
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
    var ps_table = jQuery('#banners_table').DataTable();
    var counter = 1;
	event.preventDefault();
	var tbl_row = jQuery(this).closest('tr');

	var row_id = tbl_row.attr('row_id');
	console.log();
        
        var id_ps = (jQuery(this).attr('value'));
    var data = {
            action: 'sistemex_post_delete_banner',
            id: id_ps
        };
        
        jQuery.get(ajaxurl, data, function(response) {

            if(response.success === true) {
                
                console.log(response); 
            ps_table.clear().draw();
            for (var i=0; i<response.data.length; i++) {
                if(response.data[i].nuevotap1 == 1){
                    nuevotab = 'Si';
                }else{
                    nuevotab = 'No';
                }
                
               ps_table.row.add( [
                '<a class="colorsistemex" href="admin.php?page=sistemex-inbound%2Fincludes%2Fsistemex-inbound-banners-page-edit.php&cta='+ response.data[i].id +'">' + response.data[i].nombre +'</a>',
                   response.data[i].nombre_ps,
                   response.data[i].nombre_bj,
                  '<img src="'+response.data[i].urlImagen1+'" width="220px">',
                  response.data[i].url1,
                  response.data[i].alt1,
                   nuevotab,
                  '<button style="font-size: large;" id="eliminarKeyword'+response.data[i].id+'" class="btn btn_delete btn-primary fas fa-trash-alt" value="'+response.data[i].id+'"></button>'
                  + '<a style="font-size: large;"  class="btn btn-primary fas fa-pencil-alt" href="admin.php?page=sistemex-inbound%2Fincludes%2Fsistemex-inbound-banners-page-edit.php&cta='+response.data[i].id+'"></a>'

                ] ).draw( false );
                }
            ps_table.draw(); 
            }
            
           
        
        });
    

});
</script>


</div>
