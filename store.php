<?php 
           require_once 'includes/functions.php';
           includeTemplate("header");
           require_once 'includes/conf/functions.php';
           require_once 'Util/util.php';

            if(!is_Authenticated()){
                header("location:/familybasket/");
            }
           
            
            $consult = Functions::getProducts();
            $carItems=[];

            if($_SERVER['REQUEST_METHOD']=='POST'){
                    
                $count = Util::Amount($_SESSION['car'],$_POST['idproduct'],$_POST['amount']);
                             
                if($count > 0){
                 $carItems = $_SESSION['car'];
                 for ($i=0; $i < count($carItems); $i++) { 
                     if($carItems[$i]['idproduct']==$_POST['idproduct']) {
                         $carItems[$i]['amount'] = intval($count);
                         $_SESSION['car']=$carItems;
                     }
                 }
                }else{
                     $carItems = $_SESSION['car'];

                     $idp = $_POST['idproduct'];
                     $amount = $count > 0 ? $count : $_POST['amount'];
                     $price = $_POST['price'];
                     $nameproduct = $_POST['nameproduct'];
                     
                     $carItems[] = array('idproduct'=>$idp,'amount'=>$amount,'price'=>$price,"nameproduct"=>$nameproduct);
                     $_SESSION['car']=$carItems;  
                }     
                
             }
                      
                
              

?>
  <main class="container seccion">
        <!--h1>Anuncios</h1-->
        <section class="seccion container">
            <h2>Nuestros productos</h2>
            <?php echo "<div style='width:50%; margin:5%;'><a href='/Familybasket/car.php?id_users=".$_SESSION['id_users']."' class='btn-bg-yellow'>"."Ver mi carrito ". Util::getAmmountCar($_SESSION['car'])."</a></div>"?>
            <div class="advertisements-container">
            <?php foreach ($consult  as $key => $val) { ?>  
                    <div class="advertisement">
                        <picture>
                            <img loading="lazy" src="/familybasket/pictures/<?php echo $val[2]?>" alt="Loading..." srcset="" class="tam">
                        </picture>
                        <div class="advertisement-content">
                                <h3><?php echo $val[1]?></h3>
                                <form action="" method="post">
                                    <p class="price"><?php echo "$".$val[3]?></p>           
                                    <p><input type="number" name="amount" id="amount" placeholder="Cantidad a comprar...."></p>
                                     <input type="hidden" name="idproduct" value="<?php  echo $val[0] ;?>">
                                     <input type="hidden" name="price" value="<?php  echo $val[3] ;?>">
                                     <input type="hidden" name="nameproduct" value="<?php  echo $val[1] ;?>">
                                     <input type="submit" class="btn-bg-yellow-block" value="Comprar">
                                </form>

                        </div><!--advertisement-content-->   
                  </div><!------advertisement------>
            <?php }?>
           </div><!---advertisements-container--->
        </section>   
    </main>


<?php
    include_once './includes/templates/footer.php';
 ?> 