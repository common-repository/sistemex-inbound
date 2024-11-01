
<div>

<div class="form-wrap col-10 row" style="display: -webkit-box;" >
 <div class="col-3" style="max-width: 25%;">
     <img src="<?php echo plugins_url('imagenes/sistemexlogo2.png', __FILE__) ?>" width="200">

 </div>
 <div class="col-6">
     <h2 style="margin: 0px 0;">INBOUND MARKETING</h2>
 </div>

</div>
<?php 
global $wpdb;

$ps = $wpdb->get_results("SELECT * FROM sistemex_productos_servicios;");
$by = $wpdb->get_results("SELECT * FROM sistemex_buyer_journey;");
$ps_nombre = $wpdb->get_results("SELECT nombre FROM sistemex_productos_servicios;");

?>
<br>
<div class="col-12 row tipografia">
<div class="col-6 row">


<div class="col-12">



<div class="container kt-portlet kt-portlet--head--noborder kt-portlet--height-fluid">
    
    <div class="kt-portlet__head">
		<div class="kt-portlet__head-label">
			<h3 class="kt-portlet__head-title">
				TUS PRODUCTOS Y SERVICIOS
			</h3>
		</div>
		<div class="kt-portlet__head-toolbar">
		<button class="btn btn-primary fas fa-plus-circle" id="addPS"></button>

		</div>
			</div>
			
			<br>	
<div class="kt-portlet__body">
<table id="PS_Table" class="display">
        <thead>
            <tr>
                <th>Nombre</th>
                
            </tr>
        </thead>
        <tbody>

                <?php foreach ($ps as $ps){
                echo '<tr>';  
                
                echo '<td><div class="col-12 row"> <div  class="col-6 row_data" edit_type="click" col_name="fname">' .$ps->nombre. '</div><div class="col-120"><button class="btn btn-primary fas fa-pencil-alt ocultar editar_ps" value="'.$ps->id.'"></button></div>' 
              .'<div class="col-120"><button id="eliminarPS'.$ps->id.'" class="btn btn_delete btn-primary fas fa-trash-alt alinearderecha ocultar" value="'.$ps->id.'"></button></div>'.'<div class="col-120"><button id="updatePS'.$ps->id.'" class="btn btn_save btn-primary far fa-save alinearderecha""></button></div>'.'<div class="col-120"><button id="cancelarPS'.$ps->id.'" class="btn btn_cancel btn-primary far fa-times-circle alinearderecha" value="'.$ps->id.'"></button></div>'.'</div></td>';
              
                echo '</tr>';
                
 
                } ?>
  
        </tbody>

    </table>
</div>    
    
</div>
</div>
<br>
<div class="col-12" style="text-align: center;display: flex;">
<br>
<i class="fas fa-question-circle" style="display:inline-block;font-size: large;color: #000;"></i>
<p class="tipografia" style="text-align: center;
    display: contents;">
  &nbsp;Tus productos y servicios servirán de referencia para llevar un control de tus estrategias.
</p> 
</i>
<br>
</div>
</div>
<div class="col-6 row">


<div class="col-12">


<div class="container kt-portlet kt-portlet--head--noborder kt-portlet--height-fluid">
    
    <div class="kt-portlet__head">
		<div class="kt-portlet__head-label">
			<h3 class="kt-portlet__head-title">
				
				ETAPAS DE TU BUYER JOURNEY
			</h3>
		</div>
		<div class="kt-portlet__head-toolbar">
        <button class="btn btn-primary fas fa-plus-circle" id="addBY"></button>

		</div>
			</div>
			<br>
			<div class="kt-portlet__body">
			    <table id="BY_Table" class="display">
        <thead>
            <tr>
                <th>Nombre</th>
                
            </tr>
        </thead>
        <tbody>

                <?php foreach ($by as $by){
                echo '<tr>';  
         
                echo '<td> <div class="col-12 row"> <div  class="col-6 row_data2" edit_type="click" col_name="fnameBayer">' .$by->nombre. '</div><div class="col-120"><button class="btn btn-primary fas fa-pencil-alt ocultar editar_by" value="'.$by->id.'"></button></div>'
                .'<div class="col-120"><button id="eliminarBY'.$by->id.'" class="btn btn_delete2 btn-primary fas fa-trash-alt alinearderecha ocultar" value="'.$by->id.'"></button></div>'.'<div class="col-120"><button id="updateBY'.$by->id.'" class="btn btn_save2 btn-primary far fa-save alinearderecha""></button></div>'.'<div class="col-120"><button id="cancelarBy'.$by->id.'" class="btn btn_cancel2 btn-primary far fa-times-circle alinearderecha" value="'.$by->id.'"></button></div>'. '</div></td>' ;

              
                echo '</tr>';
                } ?>
  
        </tbody>

    </table>
			    </div>


</div>
</div>
<br>
<div class="col-12" style="text-align: center;display: flex;">
<br>

<i class="fas fa-question-circle" style="display:inline-block;font-size: large;color: #000;"></i><p class="tipografia" style="text-align: center;
    display: contents;">Las etapas de tu Buyer Journey son esos estados psicológicos de tu cliente durante el ciclo de compra, puedes modificarlas a tus necesidades.
</p> 
</i>
<br>
</div>
</div>
</div>




<script>
    jQuery(document).find('.btn_save').hide();
jQuery(document).find('.btn_cancel').hide(); 
jQuery(document).find('.btn_save2').hide();
jQuery(document).find('.btn_cancel2').hide(); 


</script>




<script>


jQuery( document ).ready(function() {
var ps_table = jQuery('#PS_Table').DataTable({
     "dom": '<"top"f>rt<"bottom"lp><"clear">',
    "bInfo" : false,
    "oLanguage": {

    "sSearch": "Buscar:"

        },
              
        
        
        columnDefs: [
            {
                targets: [0],
                className: 'mdl-data-table__cell--non-numeric'
            }
        ]
    });
    
  
    
    var counter = 1;
    
    
 
    jQuery('#addPS').on( 'click', function () {
        var ps_counter = "producto_servicio"+counter;
        ps_table.row.add( [
        '<div class="col-12 row">'+
        '<div class="col-9">'+
        '<input type="text" name="producto_servicio" id="'+ps_counter+'" class="input85 enterinput" placeholder="Agregar Producto o Servicio"/> </div>' 
        + '<button id="savePS'+counter+'" class="btn btn-primary far fa-save alinearderecha"></button>'+
        '<div class="col-120"><button id="cancelPS'+ps_counter+'"   class="btn btn_cancel4 btn-primary far fa-times-circle" value="'+ps_counter+'"></button></div> </div>'
        ] ).draw( false );
        
        jQuery('#producto_servicio'+counter).keypress(function(event){
        
    var key = event.which;
    if (key == 13) // the enter key code
    {
         var producto_servicio = jQuery('#'+ps_counter).val();
        console.log(producto_servicio);
        
    var data = {
            action: 'sistemex_post_ps',
            producto_servicio: producto_servicio
        };
    
        jQuery.get(ajaxurl, data, function(response) {

            if(response.success === true) {
                console.log(response);  
               
             
            ps_table.clear().draw();
           for (var i=0; i<response.data.length; i++) {
               ps_table.row.add( [
                   '<div class="col-12 row"><div class="col-6 row_data" edit_type="click" col_name="fname">'+  response.data[i].nombre+'</div><div class="col-120"><button class="btn btn-primary fas fa-pencil-alt ocultar editar_ps" value="'+response.data[i].id+'"></button></div>'+'<div class="col-120"><button id="deletePS'+response.data[i].id+'"   class="btn btn_delete btn-primary fas fa-trash-alt ocultar" value="'+response.data[i].id+'"></button></div>'+'<div class="col-120"><button id="updatePS'+response.data[i].id+'" class="btn btn_save btn-primary far fa-save alinearderecha""></button></div>'+
                '<div class="col-120"><button id="cancelPS'+response.data[i].id+'"   class="btn btn_cancel btn-primary far fa-times-circle" value="'+response.data[i].id+'"></button></div>'
                +'</div>'


                ] ).draw( false );
                }
             jQuery('.btn_save').hide();
	        jQuery('.btn_cancel').hide();
	         jQuery('.btn_cancel4').hide();
        
        ps_table.row.add( [
            '<div class="col-12 row"><div class="col-6 row_data" edit_type="click" col_name="fname">'+  response.data[i].nombre+'</div><div class="col-120"><button class="btn btn-primary fas fa-pencil-alt ocultar editar_ps" value="'+response.data[i].id+'"></button></div>'+'<div class="col-120"><button id="deletePS'+response.data[i].id+'"   class="btn btn_delete btn-primary fas fa-trash-alt ocultar" value="'+response.data[i].id+'"></button></div>'+'<div class="col-120"><button id="updatePS'+response.data[i].id+'" class="btn btn_save btn-primary far fa-save alinearderecha""></button></div>'+
                '<div class="col-120"><button id="cancelPS'+response.data[i].id+'"   class="btn btn_cancel btn-primary far fa-times-circle" value="'+response.data[i].id+'"></button></div>'
                +'</div>'

        ] ).draw( false );
        
        ps_table.draw(); 
            }
            
             jQuery('.btn_save').hide();
	        jQuery('.btn_cancel').hide();
	        jQuery('.btn_cancel4').hide();
	         
        
        });
        
      return false;
    }
  });
  
        jQuery('#savePS'+counter).on( 'click', function () {
    var producto_servicio = jQuery('#'+ps_counter).val();
        console.log(producto_servicio);
        
    var data = {
            action: 'sistemex_post_ps',
            producto_servicio: producto_servicio
        };
    
        jQuery.get(ajaxurl, data, function(response) {

            if(response.success === true) {
                console.log(response);  
               
             
            ps_table.clear().draw();
           for (var i=0; i<response.data.length; i++) {
               ps_table.row.add( [
                   '<div class="col-12 row"><div class="col-6 row_data" edit_type="click" col_name="fname">'+  response.data[i].nombre+'</div><div class="col-120"><button class="btn btn-primary fas fa-pencil-alt ocultar editar_ps" value="'+response.data[i].id+'"></button></div>'+'<div class="col-120"><button id="deletePS'+response.data[i].id+'"   class="btn btn_delete btn-primary fas fa-trash-alt ocultar" value="'+response.data[i].id+'"></button></div>'+'<div class="col-120"><button id="updatePS'+response.data[i].id+'" class="btn btn_save btn-primary far fa-save alinearderecha""></button></div>'+
                '<div class="col-120"><button id="cancelPS'+response.data[i].id+'"   class="btn btn_cancel btn-primary far fa-times-circle" value="'+response.data[i].id+'"></button></div>'
                +'</div>'


                ] ).draw( false );
                }
             jQuery('.btn_save').hide();
	        jQuery('.btn_cancel').hide();
	         jQuery('.btn_cancel4').hide();
        
        ps_table.row.add( [
            '<div class="col-12 row"><div class="col-6 row_data" edit_type="click" col_name="fname">'+  response.data[i].nombre+'</div><div class="col-120"><button class="btn btn-primary fas fa-pencil-alt ocultar editar_ps" value="'+response.data[i].id+'"></button></div>'+'<div class="col-120"><button id="deletePS'+response.data[i].id+'"   class="btn btn_delete btn-primary fas fa-trash-alt ocultar" value="'+response.data[i].id+'"></button></div>'+'<div class="col-120"><button id="updatePS'+response.data[i].id+'" class="btn btn_save btn-primary far fa-save alinearderecha""></button></div>'+
                '<div class="col-120"><button id="cancelPS'+response.data[i].id+'"   class="btn btn_cancel btn-primary far fa-times-circle" value="'+response.data[i].id+'"></button></div>'
                +'</div>'

        ] ).draw( false );
        
        ps_table.draw(); 
            }
            
             jQuery('.btn_save').hide();
	        jQuery('.btn_cancel').hide();
	        jQuery('.btn_cancel4').hide();
	         
        
        });
    

    } );
        counter++;
        
        jQuery('.btn_cancel4').on( 'click', function () {
    
    var producto_servicio = jQuery('#'+ps_counter).val();
        
        
        var row_id = jQuery(this).closest('tr').attr('row_id'); 
		
		var row_div = jQuery(this)				
		.removeClass('bg-light') //add bg css
		.css('padding','')
		.css('display','')
	.css('width','')
	.css('height','')
		
	

	
        
    var data = {
            action: 'sistemex_list_ps',
        };
    
        jQuery.get(ajaxurl, data, function(response) {

            if(response.success === true) {
                console.log(response);  
             
            ps_table.clear().draw();
            for (var i=0; i<response.data.length; i++) {
               ps_table.row.add( [
                '<div class="col-12 row"><div class="col-6 row_data" edit_type="click" col_name="fname">'+  response.data[i].nombre+'</div><div class="col-120"><button class="btn btn-primary fas fa-pencil-alt ocultar editar_ps" value="'+response.data[i].id+'"></button></div>'+'<div class="col-120"><button id="deletePS'+response.data[i].id+'"   class="btn btn_delete btn-primary fas fa-trash-alt ocultar" value="'+response.data[i].id+'"></button></div>'+'<div class="col-120"><button id="updatePS'+response.data[i].id+'" class="btn btn_save btn-primary far fa-save alinearderecha""></button></div>'+
                '<div class="col-120"><button id="cancelPS'+response.data[i].id+'"   class="btn btn_cancel btn-primary far fa-times-circle" value="'+response.data[i].id+'"></button></div>'
                +'</div>'

                ] ).draw( false );
                }
            ps_table.draw(); 
            }
            
            jQuery('.btn_save').hide();
	        jQuery('.btn_cancel').hide();
	        jQuery('.btn_cancel4').hide();

        });
    

    });
    
    } );
    
});



</script>
<script>

jQuery( document ).ready(function() {
   
var by_table = jQuery('#BY_Table').DataTable({
    "dom": '<"top"f>rt<"bottom"lp><"clear">',
    "oLanguage": {

    "sSearch": "Buscar:"

        },
    "bInfo" : false,
        columnDefs: [
            {
                targets: [0],
                className: 'mdl-data-table__cell--non-numeric2'
            }
        ]
    });
    var counter = 1;
 
    jQuery('#addBY').on( 'click', function () {
        var by_counter = "buyer_journey"+counter;
        by_table.row.add( [
        '<div class="col-12 row">'+
        '<div class="col-9">'+    
        '<input type="text" name="buyer_journey" id="'+by_counter+'" class="input85" placeholder="Agregar Buyer Journey" /></div>' + '<button id="saveBY'+counter+'" class="btn btn-primary far fa-save alinearderecha"></button>'+
        '<div class="col-120"><button id="cancelBY'+by_counter+'"   class="btn btn_cancel3 btn-primary far fa-times-circle" value="'+by_counter+'"></button></div></div>'
        ] ).draw( false );
        
        
        jQuery("#buyer_journey"+counter).keypress(function(event){
        
    var key = event.which;
    if (key == 13) // the enter key code
    {
         var buyer_journey = jQuery('#'+by_counter).val();
        console.log(buyer_journey);
        
    var data = {
            action: 'sistemex_post_by',
            buyer_journey: buyer_journey
        };
    
        jQuery.get(ajaxurl, data, function(response) {

            if(response.success === true) {
                console.log(response);  
                
                for (var i=0; i<response.data.length; i++) {
                console.log(response.data[i]);
                }
             
            by_table.clear().draw();
           for (var i=0; i<response.data.length; i++) {
               by_table.row.add( [
                    '<div class="col-12 row"><div class="col-6 row_data2" edit_type="click" col_name="fnameBayer">'+  response.data[i].nombre+'</div><div class="col-120"><button class="btn btn-primary fas fa-pencil-alt ocultar editar_by" value="'+response.data[i].id+'"></button></div>'+'<div class="col-120"><button id="deleteBY'+response.data[i].id+'"   class="btn btn_delete2 btn-primary fas fa-trash-alt ocultar" value="'+response.data[i].id+'"></button></div>'+'<div class="col-120"><button id="updateBY'+response.data[i].id+'" class="btn btn_save2 btn-primary far fa-save alinearderecha""></button></div>'+
                '<div class="col-120"><button id="cancelBY'+response.data[i].id+'"   class="btn btn_cancel2 btn-primary far fa-times-circle" value="'+response.data[i].id+'"></button></div>'
                +'</div>'

                ] ).draw( false );
                }
                
                    jQuery('.btn_save2').hide();
	        jQuery('.btn_cancel2').hide();
            
        
        by_table.row.add( [
             '<div class="col-12 row"><div class="col-6 row_data2" edit_type="click" col_name="fnameBayer">'+  response.data[i].nombre+'</div><div class="col-120"><button class="btn btn-primary fas fa-pencil-alt ocultar editar_by" value="'+response.data[i].id+'"></button></div>'+'<div class="col-120"><button id="deleteBY'+response.data[i].id+'"   class="btn btn_delete2 btn-primary fas fa-trash-alt ocultar" value="'+response.data[i].id+'"></button></div>'+'<div class="col-120"><button id="updateBY'+response.data[i].id+'" class="btn btn_save2 btn-primary far fa-save alinearderecha""></button></div>'+
                '<div class="col-120"><button id="cancelBY'+response.data[i].id+'"   class="btn btn_cancel2 btn-primary far fa-times-circle" value="'+response.data[i].id+'"></button></div>'
                +'</div>'

        ] ).draw( false );
        
        by_table.draw(); 
            }
            
                jQuery('.btn_save2').hide();
	        jQuery('.btn_cancel2').hide();
        
        });
        
      return false;
    }
  });
        
        
        jQuery('#saveBY'+counter).on( 'click', function () {
    var buyer_journey = jQuery('#'+by_counter).val();
        console.log(buyer_journey);
        
    var data = {
            action: 'sistemex_post_by',
            buyer_journey: buyer_journey
        };
    
        jQuery.get(ajaxurl, data, function(response) {

            if(response.success === true) {
                console.log(response);  
                
                for (var i=0; i<response.data.length; i++) {
                console.log(response.data[i]);
                }
             
            by_table.clear().draw();
           for (var i=0; i<response.data.length; i++) {
               by_table.row.add( [
                    '<div class="col-12 row"><div class="col-6 row_data2" edit_type="click" col_name="fnameBayer">'+  response.data[i].nombre+'</div><div class="col-120"><button class="btn btn-primary fas fa-pencil-alt ocultar editar_by" value="'+response.data[i].id+'"></button></div>'+'<div class="col-120"><button id="deleteBY'+response.data[i].id+'"   class="btn btn_delete2 btn-primary fas fa-trash-alt ocultar" value="'+response.data[i].id+'"></button></div>'+'<div class="col-120"><button id="updateBY'+response.data[i].id+'" class="btn btn_save2 btn-primary far fa-save alinearderecha""></button></div>'+
                '<div class="col-120"><button id="cancelBY'+response.data[i].id+'"   class="btn btn_cancel2 btn-primary far fa-times-circle" value="'+response.data[i].id+'"></button></div>'
                +'</div>'

                ] ).draw( false );
                }
                
                    jQuery('.btn_save2').hide();
	        jQuery('.btn_cancel2').hide();
            
        
        by_table.row.add( [
             '<div class="col-12 row"><div class="col-6 row_data2" edit_type="click" col_name="fnameBayer">'+  response.data[i].nombre+'</div><div class="col-120"><button class="btn btn-primary fas fa-pencil-alt ocultar editar_by" value="'+response.data[i].id+'"></button></div>'+'<div class="col-120"><button id="deleteBY'+response.data[i].id+'"   class="btn btn_delete2 btn-primary fas fa-trash-alt ocultar" value="'+response.data[i].id+'"></button></div>'+'<div class="col-120"><button id="updateBY'+response.data[i].id+'" class="btn btn_save2 btn-primary far fa-save alinearderecha""></button></div>'+
                '<div class="col-120"><button id="cancelBY'+response.data[i].id+'"   class="btn btn_cancel2 btn-primary far fa-times-circle" value="'+response.data[i].id+'"></button></div>'
                +'</div>'

        ] ).draw( false );
        
        by_table.draw(); 
            }
            
                jQuery('.btn_save2').hide();
	        jQuery('.btn_cancel2').hide();
        
        });
    

    } );
        counter++;
        
         jQuery('.btn_cancel3').on( 'click', function () {
    
        
        var row_id = jQuery(this).closest('tr').attr('row_id'); 
		
		var row_div = jQuery(this)				
		.removeClass('bg-light') //add bg css
		.css('padding','')
		
		
             

	
        
     var data = {
            action: 'sistemex_list_by'
        };
    
        jQuery.get(ajaxurl, data, function(response) {

            if(response.success === true) {
                console.log(response);  
             
            by_table.clear().draw();
            for (var i=0; i<response.data.length; i++) {
               by_table.row.add( [
                '<div class="col-12 row"><div class="col-6 row_data2" edit_type="click" col_name="fnameBayer">'+  response.data[i].nombre+'</div><div class="col-120"><button class="btn btn-primary fas fa-pencil-alt ocultar editar_by" value="'+response.data[i].id+'"></button></div>'+'<div class="col-120"><button id="deleteBY'+response.data[i].id+'"   class="btn btn_delete2 btn-primary fas fa-trash-alt ocultar" value="'+response.data[i].id+'"></button></div>'+'<div class="col-120"><button id="updateBY'+response.data[i].id+'" class="btn btn_save2 btn-primary far fa-save alinearderecha""></button></div>'+
                '<div class="col-120"><button id="cancelBY'+response.data[i].id+'"   class="btn btn_cancel2 btn-primary far fa-times-circle" value="'+response.data[i].id+'"></button></div>'
                +'</div>'

                ] ).draw( false );
                }
            by_table.draw(); 
            }
        	jQuery('.btn_save2').hide();
	        jQuery('.btn_cancel2').hide();
	        jQuery('.btn_cancel3').hide();
        });
    

    });
    
    
    } );
    

});

</script>



<script>
    jQuery(document).on('click', '.editar_ps', function(event) 
{
    console.log('entro');
    
    var ps_table = jQuery('#PS_Table').DataTable();
    var counter = 1;
    var ps_counter = "producto_servicio"+counter;
    var id_ps = (jQuery(this).attr('value'));
       
        
      

	event.preventDefault();
	var tbl_row = jQuery(this).closest('tr');

	var row_id = tbl_row.attr('row_id');
	console.log();

	tbl_row.find('.btn_save').show();
	tbl_row.find('.btn_cancel').show();

	//hide edit button
	tbl_row.find('.editar_ps').hide(); 
	tbl_row.find('.btn_delete').hide();

	//make the whole row editable
	tbl_row.find('.row_data')
	.attr('contenteditable', 'true')
	.attr('edit_type', 'button')
	.addClass('bg-light')
	.css('padding','3px')


	

	//--->add the original entry > start
	tbl_row.find('.row_data').each(function(index, val) 
	{  
		//this will help in case user decided to click on cancel button
		jQuery(this).attr('original_entry', jQuery(this).html());
	}); 		
	//--->add the original entry > end
	
	jQuery('.btn_save').on( 'click', function () {
    
    var producto_servicio = jQuery('#'+ps_counter).val();
        console.log(producto_servicio);
        
        var row_id = jQuery(this).closest('tr').attr('row_id'); 
		
		var row_div = jQuery(this)				
		.removeClass('bg-light') //add bg css
		.css('padding','')
		.css('display','')
	.css('width','')
	.css('height','')
		
		var arr = {}; 
		tbl_row.find('.row_data').each(function(index, val) 
		{   
			var col_name = jQuery(this).attr('col_name');  
			var col_val  =  jQuery(this).html();
			arr[col_name] = col_val;
		});
		

	
        
    var data = {
            action: 'sistemex_post_edit_ps',
            id: id_ps,
            producto_servicio: arr['fname']
        };
    
        jQuery.get(ajaxurl, data, function(response) {

            if(response.success === true) {
                console.log(response);  
             
            ps_table.clear().draw();
            for (var i=0; i<response.data.length; i++) {
               ps_table.row.add( [
                   '<div class="col-12 row"><div class="col-6 row_data" edit_type="click" col_name="fname">'+  response.data[i].nombre+'</div><div class="col-120"><button class="btn btn-primary fas fa-pencil-alt ocultar editar_ps" value="'+response.data[i].id+'"></button></div>'+'<div class="col-120"><button id="deletePS'+response.data[i].id+'"   class="btn btn_delete btn-primary fas fa-trash-alt ocultar" value="'+response.data[i].id+'"></button></div>'+'<div class="col-120"><button id="updatePS'+response.data[i].id+'" class="btn btn_save btn-primary far fa-save alinearderecha""></button></div>'+
                '<div class="col-120"><button id="cancelPS'+response.data[i].id+'"   class="btn btn_cancel btn-primary far fa-times-circle" value="'+response.data[i].id+'"></button></div>'
                +'</div>'

                ] ).draw( false );
                }
            ps_table.draw(); 
            }
            
            jQuery('.btn_save').hide();
	        jQuery('.btn_cancel').hide();

        });
    

    });
    
    jQuery('.btn_cancel').on( 'click', function () {
    
    var producto_servicio = jQuery('#'+ps_counter).val();
        
        
        var row_id = jQuery(this).closest('tr').attr('row_id'); 
		
		var row_div = jQuery(this)				
		.removeClass('bg-light') //add bg css
		.css('padding','')
		.css('display','')
	.css('width','')
	.css('height','')
		
	

	
        
    var data = {
            action: 'sistemex_list_ps',
        };
    
        jQuery.get(ajaxurl, data, function(response) {

            if(response.success === true) {
                console.log(response);  
             
            ps_table.clear().draw();
            for (var i=0; i<response.data.length; i++) {
               ps_table.row.add( [
                '<div class="col-12 row"><div class="col-6 row_data" edit_type="click" col_name="fname">'+  response.data[i].nombre+'</div><div class="col-120"><button class="btn btn-primary fas fa-pencil-alt ocultar editar_ps" value="'+response.data[i].id+'"></button></div>'+'<div class="col-120"><button id="deletePS'+response.data[i].id+'"   class="btn btn_delete btn-primary fas fa-trash-alt ocultar" value="'+response.data[i].id+'"></button></div>'+'<div class="col-120"><button id="updatePS'+response.data[i].id+'" class="btn btn_save btn-primary far fa-save alinearderecha""></button></div>'+
                '<div class="col-120"><button id="cancelPS'+response.data[i].id+'"   class="btn btn_cancel btn-primary far fa-times-circle" value="'+response.data[i].id+'"></button></div>'
                +'</div>'

                ] ).draw( false );
                }
            ps_table.draw(); 
            }
            
            jQuery('.btn_save').hide();
	        jQuery('.btn_cancel').hide();

        });
    

    });
    
    counter++;
    
   

});
jQuery(document).on('click', '.btn_delete', function(event){
 
     
       console.log('entro');
    
    var ps_table = jQuery('#PS_Table').DataTable();
    var counter = 1;
    var ps_counter = "producto_servicio"+counter;
	event.preventDefault();
	var tbl_row = jQuery(this).closest('tr');

	var row_id = tbl_row.attr('row_id');
	console.log();
        
        var id_ps = (jQuery(this).attr('value'));
        var arr = {}; 
        
		tbl_row.find('.row_data').each(function(index, val) 
		{   
			var col_name = jQuery(this).attr('col_name');  
			var col_val  =  jQuery(this).html();
			arr[col_name] = col_val;
		});
		

    
        console.log();
    var data = {
            action: 'sistemex_post_delete_ps',
            id: id_ps
        };
        
        jQuery.get(ajaxurl, data, function(response) {

            if(response.success === true) {
                console.log(response); 
              
             
            ps_table.clear().draw();
            for (var i=0; i<response.data.length; i++) {
               ps_table.row.add( [
                   '<div class="col-12 row"><div class="col-6 row_data" edit_type="click" col_name="fname">'+  response.data[i].nombre+'</div><div class="col-120"><button class="btn btn-primary fas fa-pencil-alt ocultar editar_ps" value="'+response.data[i].id+'"></button></div>'+'<div class="col-120"><button id="deletePS'+response.data[i].id+'"   class="btn btn_delete btn-primary fas fa-trash-alt ocultar" value="'+response.data[i].id+'"></button></div>'+'<div class="col-120"><button id="updatePS'+response.data[i].id+'" class="btn btn_save btn-primary far fa-save alinearderecha""></button></div>'+
                '<div class="col-120"><button id="cancelPS'+response.data[i].id+'"   class="btn btn_cancel btn-primary far fa-times-circle" value="'+response.data[i].id+'"></button></div>'
                +'</div>'
                ] ).draw( false );
                }
            ps_table.draw(); 
            }
            
            jQuery('.btn_save').hide();
	        jQuery('.btn_cancel').hide();
	         
        
        });
    

});


jQuery(document).on('click', '.btn_delete2', function(event){
 
     
       console.log('entro');
    
    var ps_table = jQuery('#BY_Table').DataTable();
    var counter = 1;
    var ps_counter = "producto_servicio"+counter;
	event.preventDefault();
	var tbl_row = jQuery(this).closest('tr');

	var row_id = tbl_row.attr('row_id');
	console.log();
        
        var id_ps = (jQuery(this).attr('value'));
        var arr = {}; 
        
		tbl_row.find('.row_data2').each(function(index, val) 
		{   
			var col_name = jQuery(this).attr('col_name');  
			var col_val  =  jQuery(this).html();
			arr[col_name] = col_val;
		});
		

    
        console.log();
    var data = {
            action: 'sistemex_post_delete_by',
            id: id_ps
        };
        
        jQuery.get(ajaxurl, data, function(response) {

            if(response.success === true) {
                console.log(response); 
              
             
            ps_table.clear().draw();
            for (var i=0; i<response.data.length; i++) {
               ps_table.row.add( [
                   '<div class="col-12 row"><div class="col-6 row_data2" edit_type="click" col_name="fnameBayer">'+  response.data[i].nombre+'</div><div class="col-120"><button class="btn btn-primary fas fa-pencil-alt ocultar editar_by" value="'+response.data[i].id+'"></button></div>'+'<div class="col-120"><button id="deleteBY'+response.data[i].id+'"   class="btn btn_delete2 btn-primary fas fa-trash-alt ocultar" value="'+response.data[i].id+'"></button></div>'+'<div class="col-120"><button id="updateBY'+response.data[i].id+'" class="btn btn_save2 btn-primary far fa-save alinearderecha""></button></div>'+
                '<div class="col-120"><button id="cancelBY'+response.data[i].id+'"   class="btn btn_cancel2 btn-primary far fa-times-circle" value="'+response.data[i].id+'"></button></div>'
                +'</div>'
                ] ).draw( false );
                }
            ps_table.draw(); 
            }
            
            jQuery('.btn_save2').hide();
	        jQuery('.btn_cancel2').hide();
	         
        
        });
    

});




</script>


<script>
    jQuery(document).on('click', '.editar_by', function(event) 
{
    console.log('entro');
    
    var by_table = jQuery('#BY_Table').DataTable();
    var counter = 1;
    var ps_counter = "buyer_journey"+counter;
    var id_by = (jQuery(this).attr('value'));
       
        
      

	event.preventDefault();
	var tbl_row = jQuery(this).closest('tr');

	var row_id = tbl_row.attr('row_id');
	console.log();

	tbl_row.find('.btn_save2').show();
	tbl_row.find('.btn_cancel2').show();

	//hide edit button
	tbl_row.find('.editar_by').hide(); 
	tbl_row.find('.btn_delete2').hide();

	//make the whole row editable
	tbl_row.find('.row_data2')
	.attr('contenteditable', 'true')
	.attr('edit_type', 'button')
	.addClass('bg-light')
	.css('padding','3px')

	//--->add the original entry > start
	tbl_row.find('.row_data2').each(function(index, val) 
	{  
		//this will help in case user decided to click on cancel button
		jQuery(this).attr('original_entry', jQuery(this).html());
	}); 		
	//--->add the original entry > end
	
	jQuery('.btn_save2').on( 'click', function () {
    
    var producto_servicio = jQuery('#'+ps_counter).val();
        console.log(producto_servicio);
        
        var row_id = jQuery(this).closest('tr').attr('row_id'); 
		
		var row_div = jQuery(this)				
		.removeClass('bg-light') //add bg css
		.css('padding','')
		
		var arr = {}; 
		tbl_row.find('.row_data2').each(function(index, val) 
		{   
			var col_name = jQuery(this).attr('col_name');  
			var col_val  =  jQuery(this).html();
			arr[col_name] = col_val;
		});
             

	
        
     var data = {
            action: 'sistemex_post_edit_by',
            id: id_by,
            buyer_journey: arr['fnameBayer']
        };
    
        jQuery.get(ajaxurl, data, function(response) {

            if(response.success === true) {
                console.log(response);  
             
            by_table.clear().draw();
            for (var i=0; i<response.data.length; i++) {
               by_table.row.add( [
                   '<div class="col-12 row"><div class="col-6 row_data2" edit_type="click" col_name="fnameBayer">'+  response.data[i].nombre+'</div><div class="col-120"><button class="btn btn-primary fas fa-pencil-alt ocultar editar_by" value="'+response.data[i].id+'"></button></div>'+'<div class="col-120"><button id="deleteBY'+response.data[i].id+'"   class="btn btn_delete2 btn-primary fas fa-trash-alt ocultar" value="'+response.data[i].id+'"></button></div>'+'<div class="col-120"><button id="updateBY'+response.data[i].id+'" class="btn btn_save2 btn-primary far fa-save alinearderecha""></button></div>'+
                '<div class="col-120"><button id="cancelBY'+response.data[i].id+'"   class="btn btn_cancel2 btn-primary far fa-times-circle" value="'+response.data[i].id+'"></button></div>'
                +'</div>'

                ] ).draw( false );
                }
            by_table.draw(); 
            }
        	jQuery('.btn_save2').hide();
	        jQuery('.btn_cancel2').hide();
        });
    

    });
    
    
    jQuery('.btn_cancel2').on( 'click', function () {
    
        
        var row_id = jQuery(this).closest('tr').attr('row_id'); 
		
		var row_div = jQuery(this)				
		.removeClass('bg-light') //add bg css
		.css('padding','')
		
		
             

	
        
     var data = {
            action: 'sistemex_list_by'
        };
    
        jQuery.get(ajaxurl, data, function(response) {

            if(response.success === true) {
                console.log(response);  
             
            by_table.clear().draw();
            for (var i=0; i<response.data.length; i++) {
               by_table.row.add( [
                '<div class="col-12 row"><div class="col-6 row_data2" edit_type="click" col_name="fnameBayer">'+  response.data[i].nombre+'</div><div class="col-120"><button class="btn btn-primary fas fa-pencil-alt ocultar editar_by" value="'+response.data[i].id+'"></button></div>'+'<div class="col-120"><button id="deleteBY'+response.data[i].id+'"   class="btn btn_delete2 btn-primary fas fa-trash-alt ocultar" value="'+response.data[i].id+'"></button></div>'+'<div class="col-120"><button id="updateBY'+response.data[i].id+'" class="btn btn_save2 btn-primary far fa-save alinearderecha""></button></div>'+
                '<div class="col-120"><button id="cancelBY'+response.data[i].id+'"   class="btn btn_cancel2 btn-primary far fa-times-circle" value="'+response.data[i].id+'"></button></div>'
                +'</div>'

                ] ).draw( false );
                }
            by_table.draw(); 
            }
        	jQuery('.btn_save2').hide();
	        jQuery('.btn_cancel2').hide();
        });
    

    });
    
    counter++;

});




</script>



</div>
