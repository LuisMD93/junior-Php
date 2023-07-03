<?php 
     require_once 'includes/functions.php';
     require_once 'includes/conf/functions.php';
     require_once 'Util/util.php';
     includeTemplate("header");

     $errors = [];
     
     if ($_SERVER['REQUEST_METHOD']=='POST') {

        $email = filter_var($_POST['email'],FILTER_VALIDATE_EMAIL);
        $password = $_POST['password'];

       
         if (!$_POST['email']) {
             $errors[] = "<div class='alert error'>Debe ingresar el correo</div>";
         }

         if (!$password){
             $errors[] = "<div class='alert error'>Debe ingresar la contraseña</div>";
         }

         if (!$errors) {

           
            $consult = Functions::if_Exists($email,$password); 
           
          
            if($consult){
           
              session_start();
              $_SESSION['login']=true;
              $_SESSION['rol_id']= $consult['rol_id'];
              $_SESSION['photo'] = $consult['photo'];
              $_SESSION['id_users'] = $consult['id_users'];
              $_SESSION['car'] =[];

                
              Util::requestPage($_SESSION['rol_id'],$_SESSION['login'], $_SESSION['rol_id'], $_SESSION['photo'], $_SESSION['id_users']);

                   
            }else{
              $errors[]  = "<div class='alert error'>Error, usuario no existe <br/>revise su usuario o contraseña</di>";
            }
         }
     }
?>
   <main class="container seccion center-container">
        <h1>Iniciar Sèsion</h1>
        <form action="" method="post" class="form">
           <fieldset>
                <legend>
                        Informacion Acceso
                </legend>
                <?php foreach ($errors as $message) : ?>
                 <div class="">
                     <?php echo $message;?>
                 </div>
                <?php endforeach;?>
                    <label for="email">Correo:</label>
                    <input type="email" name="email" id="email" placeholder="Correo..." value="">

                    <label for="password">Contraseña:</label>
                    <input type="password" name="password" id="password" placeholder="Contraseña..." value="">
            </fieldset>
            <input type="submit" value="Iniciar Sesion" class="btn-bg-green-block">
        </form>
    </main>

<?php 
    includeTemplate("footer");         
?> 