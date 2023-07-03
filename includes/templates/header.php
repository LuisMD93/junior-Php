<?php
     if (!isset($_SESSION)) {
        session_start();
     }

     $auth = $_SESSION['login'] ?? false;
     $cod = $_SESSION['rol_id'] ?? '';
     $photo = $_SESSION['photo'] ?? 'logo.png';
     $id = $_SESSION['id_users'] ??  0;
     $class = $auth ? 'avatar' : '';
    
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Canasta Familiar</title>
    <link rel="stylesheet" href="/Familybasket/build/css/app.css">
</head>
<body>

    <header class="header <?php echo $start ? 'start' : '';?>">
        <div class="container header-content">
            <div class="bar">
                <a href="/Familybasket/index.php"><img src="/Familybasket/pictures/<?php echo $photo?>" alt="Loading..." srcset="" class="<?php echo $class?>"></a>

                <nav class="mobile-menu">
                    <!--img src="/Familybasket/build/img/barras.svg" alt="Loading" -->
                 </nav>
                 
                <div class="derecha">
                    <!--img class="dark-mode-button" src="/Familybasket/build/img/dark-mode.svg"-->
                    <nav class="navegation">
                    <?php if (!$auth) {
                            echo "<a href='register_me.php'>Registrar me!</a>";
                        }?>                    
                        <?php if ($auth && $cod===1) {
                           
                            echo '<a href="/Familybasket/admin/property/update.php?id='.$id.'&cod='.$cod.'">Administrar mi cuenta</a>';
                            echo '<a href="/Familybasket/admin/property/user_management.php">Gestion usuarios</a>';
                            echo "<a href='/Familybasket/session_close.php'>Cerrar Sesion</a>";
                        } if($auth && $cod===3){
                              
                            echo '<a href="/Familybasket/admin/property/update.php?id='.$id.'&cod='.$cod.'">Administrar mi cuenta</a>';  
                            echo "<a href='/Familybasket/session_close.php'>Cerrar Sesion</a>";
                        }?>

                        <?php if ($cod===2) {
                            echo '<a href="/Familybasket/admin/property/update.php?id='.$id.'&cod='.$cod.'">Administrar mi cuenta</a>';  
                            echo '<a href="/Familybasket/admin/property/customer_orders.php?id='.$id.'&cod='.$cod.'">Ver pedidos</a>';
                            echo "<a href='/Familybasket/session_close.php'>Cerrar Sesion</a>";  
                        }?>
                    </nav>
                </div>
              
            </div>
            <?php if ($start) {?>
              <h1>Texto<br>Texto</h1>
            <?php }?>

       </div>
       
    </header>