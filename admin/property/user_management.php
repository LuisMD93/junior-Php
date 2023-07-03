<?php 
require_once '../../includes/functions.php';
require_once '../../includes/conf/functions.php';
require_once '../../Util/util.php';
includeTemplate("header"); 


    if(!is_Authenticated()){
      header("location:/familybasket/index.php");
    } 
    
    $consult = Functions::getUser();
?>
    <main class="container seccion center-container">
        <h1>Gestion de Usuarios</h1>
        <a href="/familybasket/admin/" class="btn btn-bg-yellow" >Volver</a><br><br>
        <?php foreach ($consult  as $key => $val) { ?>  
        <article class="blog-input">
            <div class="imagen">
                   <picture>
                       <img loading="lazy" src="/familybasket/pictures/<?php echo $val[5];?>" alt="Loading...">
                   </picture>
            </div>
            <div class="input-text">
                 <a href="/Familybasket/admin/property/update_user.php?id=<?php echo $val[0];?>">
                        <h4><?php echo $val[1];?></h4>
                        <p>Correo: <span><?php echo $val[3];?></span><br>
                        contraseña: <span><?php echo $val[2];?></span><br>
                        Telefono: <span><?php echo $val[4];?></span><br>
                        Rol_user : <span><?php echo $val[6];?></span></p>
                 </a>
            </div>
      </article>
      <?php }?>
    </main>

<?php 
    includeTemplate("footer");         
?>