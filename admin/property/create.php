<?php 
     require_once '../../includes/functions.php';
     require_once '../../includes/conf/functions.php';
     require_once '../../Util/util.php';

     includeTemplate("header"); 
     if(!is_Authenticated()){
        header("location:/familybasket/");
      }

     $name='';
     $price='';
     $pictures ='';
     $availability='';
    

     $error=[];

      if ($_SERVER['REQUEST_METHOD']=='POST') {
      
            $name=$_POST["name"];
            $price=$_POST["price"];
            $pictures =$_FILES["pictures"];
            $availability=$_POST["availability"];

            
            if(!$name){ 
                $error [] = "debes ingresar el nombre del producto"; 
            }
            
            if(!$price){ 
                $error [] = "el precio es obligatorio"; 
            }
            
            if(!$pictures['name']){ 
                $error [] = "debes ingresar imagen!"; 
            }
            
            if(!$availability){ 
                $error [] = "debes elegir el estado del producto"; 
            }
            

            if (empty($error)) {

                 Functions::addProducts($name,$price,Util::pictureSave($pictures,"../../pictures/"),$availability);
                header('location:/familybasket/admin?message=1');
            }
          
    }


?>
   <main class="container seccion">
        <h1>Crear Propiedad</h1>
        <a href="/familybasket/admin" class="btn btn-bg-green" >Volver</a>
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
                <label for="title">Nombre producto:</label>
                <input type="text" name="name" id="name" placeholder="Nombre del producto..." value="<?php echo $name;?>">

                <label for="price">Precio:</label>
                <input type="number" name="price" id="price" placeholder="Precio del producto..." value="<?php echo $price;?>">

                <label for="picutres">Imagen:</label>
                <input type="file" name="pictures" id="pictures" accept="img/jpg">

                <label for="description">Habilitar:</label>
                <select name="availability" id="availability">
                    <option value="">--Select---</option>
                    <option value="1"> habilitado</option> 
                    <option value="0"> desabilitado</option>       
                </select>
            </fieldset>

            <input type="submit" value="Crear propiedad" class="btn btn-bg-green">
        </form>
    </main>

<?php 
    includeTemplate("footer");         
?> 