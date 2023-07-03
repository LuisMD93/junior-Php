<?php 
     require_once '../../includes/functions.php';
     require_once '../../includes/conf/functions.php';
     require_once '../../Util/util.php';

     includeTemplate("header"); 
     if(!is_Authenticated()){
        header("location:/familybasket/");
      }

      $id_users = $_SESSION['id_users'];
      $id_users = filter_var($id_users,FILTER_VALIDATE_INT);//validar que sea un entero
         if(!$id_users){
            header("location:/familybasket/");
      } 
    
     $consult = Functions::getHistorial($id_users);


  
 
?>
   <main class="container seccion">
        <h1>Tu historial de despachos <?php $consult< 0 ?  '<b> Por el momento no has realizado pedidos</b>' : ''; ?></h1>
        
        <a href="/Familybasket/admin/" class="btn btn-bg-yellow" >Volver</a>

        <table class="properties">
           <thead>  
			<tr>
                <th>Nombre Cliente</th>
				<th>Producto</th>
                <th>Cantidad</th>
                <th>Precio</th>
                <th>Estado del pedido</th>
			</tr>
           </thead>     
           <tbody>
           <?php foreach ($consult  as $key => $val) { ?>  
			<tr>                     
                    <td><?php echo $val[1];?></td>
			     	<td><?php echo $val[2];?></td>
                    <td><?php echo $val[3];?></td>
                    <td><?php echo "$".$val[4]?></td>
                    <td><?php echo $val[5]?></td>
                    
            
                
			</tr>
           <?php } ?>  
            </tbody>     
		</table>
   </main>

<?php 
    includeTemplate("footer");         
?> 