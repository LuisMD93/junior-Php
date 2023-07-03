<?php 
require_once '../../includes/functions.php';
require_once '../../includes/conf/functions.php';
require_once '../../Util/util.php';
includeTemplate("header"); 


    if(!is_Authenticated()){
      header("location:/familybasket/index.php");
    }

     $id = $_GET['id'];
     $cod = $_GET['cod'];
     $id = filter_var($id,FILTER_VALIDATE_INT);//validar que sea un entero
     $cod = filter_var($cod,FILTER_VALIDATE_INT);//validar que sea un entero
       if(!$id || !$cod){
          header("location:/familybasket/admin");
       }
     

     $questbyIdPerfil = Functions::questByIdPerfil($id);
     
     $name=$questbyIdPerfil['name'];
     $password=$questbyIdPerfil['password'];
     $email=$questbyIdPerfil['email'];
     $phone=$questbyIdPerfil['phone'];
     $pictures=$questbyIdPerfil['photo'];
  


     $error=[];

      if ($_SERVER['REQUEST_METHOD']=='POST') {
      
              
         $name=$_POST['name'];
         $password=$_POST['password'];
         $email=$_POST['email'];
         $phone=$_POST['phone'];
         $pictures=$_FILES['pictures'];

            // echo "<pre>";
            //    var_dump($picture);
            // echo "</pre>";
            // exit;
            if(!$name){ 
                $error [] = "debes ingresar tu nombre"; 
            }
            
            if(!$password){ 
                $error [] = "un password"; 
            }
            
           
            
            if(!$phone){ 
                $error [] = "debes ingresar tu numero telefonico"; 
            }

            if(!$email){ 
                $error [] = "debes ingresar tu correo electronico"; 
            }
          
          
           

            if (empty($error)) {

              
                $generateName ='';
                //Crear directorio
                $imagen = Util::pictureDrop_or_Change($pictures,"../../pictures/",$questbyIdPerfil['photo']);
                        
                Functions::UpdateAcountPerfil($name,$password,$email,$phone,$imagen,$id,$cod);
                $_SESSION['photo'] = $imagen;
                if($cod===1 || $cod===2){

                    header('location:/familybasket/admin/');
                }else {
                    header('location:/familybasket/store.php');
                }

                
            }
          
    }

   
?>
   <main class="container seccion">
        <h1>Actualizar Propiedad</h1>
        <?php if($cod===1 || $cod===2){?>
        <a href="/familybasket/admin/" class="btn btn-bg-green" >Volver panel admin</a>
        <?php }?>

        <?php if($cod===3){?>
         <a href="/familybasket/store.php/" class="btn btn-bg-green" >Volver</a>
        <?php }?>
        <?php foreach ($error as $message) : ?>
                <div class="alert error">
                    <?php echo $message;?>
                </div>
        <?php endforeach;?>
        <form class="form" action="" method="post"  enctype="multipart/form-data">
            <fieldset>
                <legend>
                    Informacion General
                </legend>
                <label for="nombre">Nombre:</label>
                <input type="text" name="name" id="name" placeholder="Ingresa tu nuevo nombre..." value="<?php echo $name;?>">

                <label for="email">correo:</label>
                <input type="email" name="email" id="email" placeholder="Ingresa tu nuevo correo..." value="<?php echo $email;?>">

                <label for="password">Contraseña:</label>
                <input type="password" name="password" id="password" placeholder="Ingresa tu nueva contraseña..." value="<?php echo $password;?>">

                <label for="picutres">Imagen:</label>
                <input type="file" name="pictures" id="pictures" accept="img/jpg">
                <img src="/familybasket/pictures/<?php echo $pictures;?>" alt="" srcset="" class="small-pictures">

                <label for="description">telefono:</label>
                <input type="number" name="phone" id="phone" placeholder="Ingresa tu nuevo numero telofonico..." value="<?php echo $phone;?>">
                

            </fieldset>

            <input type="submit" value="Crear propiedad" class="btn btn-bg-green " >
           
        </form>
    </main>

<?php 
    includeTemplate("footer");         
?>  