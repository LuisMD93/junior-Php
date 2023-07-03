<?php 
     require_once './includes/functions.php';
     require_once './includes/conf/functions.php';
     includeTemplate("header"); 
     require_once 'Util/util.php';

     $name = ''; 
     $password = '';
     $email = ''; 
     $phone = ''; 
     $pictures = '';

     //$error=[];

      if ($_SERVER['REQUEST_METHOD']=='POST') {
             
            $name = $_POST['name']; 
            $password = $_POST['password'];
            $email = $_POST['email']; 
            $phone = $_POST['phone']; 
            $pictures = $_FILES['pictures'];

            Util::pictureSave($pictures,"./pictures/");
            Functions::addUsers($name,$password,$email,$phone,$pictures);
            header('location:/familybasket?message=1');
      }
          

?>
   <main class="container seccion">
        <h1>Registrar Usuario</h1>
        <a href="/Front-end-Real_estate/admin" class="btn btn-bg-green" >Volver</a>
        <!--?php foreach ($error as $message) : ?>
                <div class="alert error">
                    <!-?php echo $message;?>
                </div>
        <!-?php endforeach;?-->
        <form class="form" action="" method="post"  enctype="multipart/form-data">
            <fieldset>
                <legend>
                    Informacion General
                </legend>
                <label for="name">Nombre:</label>
                <input type="text" name="name" id="name" placeholder="nombre usuario..." value="<?php echo $name;?>">

                <label for="name">Celular:</label>
                <input type="text" name="phone" id="phone" placeholder="nombre usuario..." value="<?php echo $phone;?>">

                <label for="email">Correo:</label>
                <input type="email" name="email" id="email" placeholder="correo..." value="<?php echo $email;?>">

                <label for="password">Conrtaseña:</label>
                <input type="password" name="password" id="password" placeholder="contraseña..." value="<?php echo $password;?>">

                <label for="pictures">Imagen:</label>
                <input type="file" name="pictures" id="pictures" accept="img/jpg">


            </fieldset>
            <input type="submit" value="Crear cuenta" class="btn btn-bg-green">
        </form>
    </main>

<?php 
    includeTemplate("footer");         
?> 