<?php 

     require_once '../includes/functions.php';
     includeTemplate("header");
     require_once '../includes/conf/functions.php';

     if(!is_Authenticated()){
          header("location:/familybasket/");
     }
        
     $consult = Functions::getProducts();


      $result = $_GET['message'] ?? null;

     
     if (isset($_GET['cod'])) {
            
           $cod = $_GET['cod'];
           $id = filter_var($cod,FILTER_VALIDATE_INT);        
           Functions::changeAvailability($cod,);           
           header('location:/familybasket/admin');       
     }

     if(isset($_GET['id'])){

          $cod = $_GET['id'];
          $id = filter_var($cod,FILTER_VALIDATE_INT);       
          Functions::deleteProduct($id);
     }
 
?>
   <main class="container seccion">
        <h1>Panel Administrador de Productos</h1>
           <?php if (intval($result)==1) :?>       
            <p class="alert success">registro almacenado con exito!!</p>
           <?php endif?>

           <?php if (intval($result)==2) :?>       
            <p class="alert error">actualizado con exito con exito!!</p>
           <?php endif?>

        <a href="../admin/property/create.php" class="btn btn-bg-green" >Nuevo producto</a>

        <table class="properties">
           <thead>  
			<tr>
				<th>ID</th>
				<th>Producto</th>
				<th>Precio</th>
                    <th>Disponibilidad</th>
                    <th>Imagen</th>       
                    <th>Actions</th>
			</tr>
           </thead>     
           <tbody>
           <?php foreach ($consult  as $key => $val) { ?>  
			<tr>                     
                    <td><?php echo $val[0];?></td>
				<td><?php echo $val[1];?></td>
                    <td><?php echo "$".$val[3]?></td>
                    <td><?php echo $val[4]?></td>
				<td><img src="/familybasket/pictures/<?php echo $val[2]?>" alt="Loading..." srcset="" class="table-picture"></td>
                    
                    <td> 
                         <form action="" method="get">
                         <input type="hidden" name="id" value="<?php echo $val[0];?>">
                         <input type="submit" class="btn-bg-red-block" value="Eliminar">
                         </form>
                         <form action="" method="get">
                         <input type="hidden" name="cod" value="<?php echo $val[0];?>">
                         <?php if ( $val[4]>0) {
                            echo "<input type='submit' class='btn-bg-green-block' value='Deshabilitar'>";
                         }else {
                              echo "<input type='submit' class='btn-bg-yellow' value='Habilitar'>";
                         }?>
                         
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