<?php 
  require_once 'includes/functions.php';
  includeTemplate("header");
  require_once 'includes/conf/functions.php';
  require_once 'Util/util.php';


    if(!is_Authenticated()){
      header("location:/familybasket/");
    }
    $id_users = $_SESSION['id_users'];
    $id_users = filter_var($id_users,FILTER_VALIDATE_INT);//validar que sea un entero
       if(!$id_users){
          header("location:/familybasket/");
       }
    
    $consult = [];
    $remove = [];
    
    if($_SERVER['REQUEST_METHOD']=='GET'){

        $_SESSION['car'] = Util::productRemoveItems($_SESSION['car'],$_GET['productRemove'] ?? null);
       
    }

     

    if($_SERVER['REQUEST_METHOD']=='POST'){

        $amount=$_POST['amount'];
        $idproducts=$_POST['idproducts'];
        $total=$_POST['total'];
        $iduser=$_POST['iduser'];  

        Functions::addBuy($amount,$idproducts,$total,$iduser);
        $_SESSION['car'] = Util::productRemoveItems($_SESSION['car'],$_POST['productRemove'] ?? null);//una vez comprado se remueve del carrito
        
    }
     $consult = $_SESSION['car'];

?>
    <main class="container seccion">
         <a href="/familybasket/store.php/" class="btn btn-bg-yellow" >Volver</a>
    <table class="properties">
           <thead>  
			<tr>
				<th>Producto</th>
				<th>Cantidad</th>
                <th>Precio</th>
                <th>Total</th>       
                <th>Actions</th>
			</tr>
           </thead>     
           <tbody>
           <?php foreach ($consult  as $key => $val) { ?>  
			<tr>    
                  
                    <td><?php echo $val['nameproduct'];?></td>                
				    <td><?php echo $val['amount'];?></td>
                    <td><?php echo "$ ".$val['price'];?></td>
                    <td><?php echo "$ ".$val['price']* $val['amount'];?></td>
                   
                    
                    <td> 
                         <form action="" method="post">
                              <input type="hidden" name="idproducts" value="<?php echo  $val['idproduct'];?>">
                              <input type="hidden" name="total" value="<?php echo  $val['price']* $val['amount'];?>">
                              <input type="hidden" name="amount" value="<?php echo  $val['amount'];?>">
                              <input type="hidden" name="iduser" value="<?php echo  $id_users;?>">
                              <input type="hidden" name="productRemove" value="<?php echo $key;?>">
                              <input type="submit" class="btn-bg-green-block" value="Comprar">
                         </form>
                         <form action="" method="get">
                              <input type="hidden" name="productRemove" value="<?php echo $key;?>">
                              <input type="submit" class="btn-bg-red-block" value="Quitar">
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