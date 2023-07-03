<?php 
     require_once '../../includes/functions.php';
     require_once '../../includes/conf/functions.php';
     require_once '../../Util/util.php';

     includeTemplate("header"); 
     if(!is_Authenticated()){
        header("location:/familybasket/");
      }

      $id_users = $_GET['id'];
      $id_users = filter_var($id_users,FILTER_VALIDATE_INT);//validar que sea un entero
         if(!$id_users){
            header("location:/familybasket/");
      }
        
      $consult = Functions::getCustomerOrders();
    
      if ($_SERVER['REQUEST_METHOD']=='POST') {
           
           $cod = $_POST['cod'];
           $id = filter_var($cod,FILTER_VALIDATE_INT);        
           Functions::changeStattus($cod,$id_users);                  
      }   
 
?>
   <main class="container seccion">
        <h1>Panel Administrador de Productos</h1>
        <a href="/Familybasket/admin/" class="btn btn-bg-yellow" >Volver</a>
        <a href='/Familybasket/admin/property/historial.php' class="btn btn-bg-green" > mi Historial</a>
        <table class="properties">
           <thead>  
			<tr>
				<th>Nombre Cliente</th>
				<th>Producto</th>
                <th>Cantidad</th>
                <th>Precio</th>
                <th>Estado del pedido</th>
                <th>Actions</th>
			</tr>
           </thead>     
           <tbody>
           <?php foreach ($consult  as $key => $val) { ?>  
			<tr>                     
                    <td><?php echo $val[2];?></td>
				    <td><?php echo $val[1];?></td>
                    <td><?php echo $val[3];?></td>
                    <td><?php echo "$".$val[4]?></td>
                    <td><?php echo $val[5]?></td>
                    
                    <td> 
                       
                         <form action="" method="post">
                         <input type="hidden" name="cod" value="<?php echo $val[0];?>">
                         <input type='submit' class='btn-bg-red-block' value='Despachar'>";
                         
                         </form>
                        
                   </td>
                
			</tr>
           <?php } ?>  
            </tbody>     
		</table>
   </main>

<?php 
    includeTemplate("footer");         
?> 