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

$cta = $wpdb->get_results("SELECT cta.*,ps.nombre as nombre_ps, bj.nombre as nombre_bj FROM sistemex_inbound_cta as cta INNER JOIN sistemex_productos_servicios as ps ON ps.id = cta.producto_servicio INNER JOIN sistemex_buyer_journey as bj ON bj.id = cta.buyer_journey;");

?>


<br>


<div>
    <div class="col-6">
          <h6>*Asigna tu CTA a los post para poder visualizar los banner.</h6>

 </div>
    
</div>
<div class="container kt-portlet kt-portlet--head--noborder kt-portlet--height-fluid">
    
    <div class="kt-portlet__head">
		<div class="kt-portlet__head-label">
			<h3 class="kt-portlet__head-title">
				Listado de CTA's
			</h3>
		</div>
		<div class="kt-portlet__head-toolbar">
    <a href="<?php echo 'admin.php?page=sistemex-inbound%2Fincludes%2Fsistemex-inbound-cta-page.php' ?>" class="btn btn-primary fas fa-plus-circle fuente18" style="color:white;"> &nbsp; CTA</a>


		</div>
			</div>
			
			<div class="kt-portlet__body">
			    <table id="dataTable" class="mdl-data-table" width="100%">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>P/S</th>
                <th>Buyer Journey</th>
                <th>Imagen (CTA Medio)</th>
                <th>Imagen (CTA Inferior)</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>

                <?php foreach ($cta as $cta){
                echo '<tr>'; 
                echo '<td> <a class="colorsistemex" href="admin.php?page=sistemex-inbound%2Fincludes%2Fsistemex-inbound-cta-page-edit.php&cta='. $cta->id .'">' .$cta->nombre. '</a></td>';
                echo '<td>' .$cta->nombre_ps. '</td>';
                echo '<td>' .$cta->nombre_bj. '</td>';
                echo '<td><img src="'.esc_url($cta->banner_medio).'" width="220px"></td>';
                echo '<td><img src="'.esc_url($cta->banner_inferior).'" width="220px"></td>';
                echo '<td><button style="font-size: large;" id="eliminarCTA'.$cta->id.'" class="btn btn_delete btn-primary fas fa-trash-alt" value="'.$cta->id.'"></button>
                        <a style="font-size: large;" class="btn btn-primary fas fa-pencil-alt" href="admin.php?page=sistemex-inbound%2Fincludes%2Fsistemex-inbound-cta-page-edit.php&cta='. $cta->id .'"></a>
                      </td>';

                echo '</tr>';
                } ?>
  
        </tbody>

    </table>
			 </div>


</div>







<script>

jQuery(document).ready(function() {
    jQuery('#dataTable').DataTable( {
        "order": [[ 2, "asc" ]],
        "oLanguage": {

    "sSearch": "Buscar:"

        },
        columnDefs: [
            {
                targets: [ 0, 1, 2 ],
                className: 'mdl-data-table__cell--non-numeric'
            }
        ]
    } );
} );

// Code that uses other library's $ can follow here.
</script>

<script>
    jQuery(document).on('click', '.btn_delete', function(event){
    var ps_table = jQuery('#dataTable').DataTable();
    var counter = 1;
	event.preventDefault();
	var tbl_row = jQuery(this).closest('tr');

	var row_id = tbl_row.attr('row_id');
	console.log();
        
        var id_ps = (jQuery(this).attr('value'));
    var data = {
            action: 'sistemex_post_delete_cta',
            id: id_ps
        };
        
        jQuery.get(ajaxurl, data, function(response) {
         
            if(response.success === true) {
                console.log(response); 
            ps_table.clear().draw();
            for (var i=0; i<response.data.length; i++) {
               ps_table.row.add( [
                '<a class="colorsistemex" href="admin.php?page=sistemex-inbound%2Fincludes%2Fsistemex-inbound-cta-page-edit.php&cta='+ response.data[i].id +'">' + response.data[i].nombre +'</a>',
                   response.data[i].nombre_ps,
                   response.data[i].nombre_bj,
                   '<img src="'+response.data[i].banner_medio+'" width="220px">',
                   '<img src="'+response.data[i].banner_inferior+'" width="220px">',
                  '<button style="font-size: large;" id="eliminarCTA'+response.data[i].id+'" class="btn btn_delete btn-primary fas fa-trash-alt" value="'+response.data[i].id+'"></button>'
                  +'<a style="font-size: large;" class="btn btn-primary fas fa-pencil-alt" href="admin.php?page=sistemex-inbound%2Fincludes%2Fsistemex-inbound-cta-page-edit.php&cta='+response.data[i].id +'"></a>'
                ] ).draw( false );
                }
            ps_table.draw(); 
            }
            
           
        
        });
    

});
</script>

</div>
