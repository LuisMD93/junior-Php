<?php

class Util{


  
static function pictureSave($picture,$url) : string { 
     
         //Crear directorio
         $pictureSave = $url;

            if(!is_dir($pictureSave)) {
                 mkdir($pictureSave);
            }

            $generateName = md5(uniqid(rand(),true)).".jpg";
                
            //Subir imagen
            move_uploaded_file($picture["tmp_name"],$pictureSave.$generateName);


            return $generateName;
  }


  static function pictureDrop_or_Change($picture,$url ,$oldName) : string{ 
   
           
           if ($picture['name']) { 
               unlink($url.$oldName);//para eliminar un archivo
      
               $generateName = md5(uniqid(rand(),true)).".jpg";
  
              //Subir imagen
               move_uploaded_file($picture["tmp_name"],$url.$generateName);

               return $generateName;

           }

               return $oldName;

  }

  static function requestPage($rol_id,$start_sesion,$rol,$photo,$id_users)  {
       
         if($rol_id===1 || $rol_id===2){
                         
            header("location:/Familybasket/admin?auth=".$start_sesion."?key=".$rol."?photo=".$photo."?id_users=".$id_users);

         }else{ 
  
             header("location:/Familybasket/store.php?auth=".$start_sesion."?key=".$rol."?photo=".$photo."?id_users=".$id_users);
         }

  }

  static function getAmmountCar($carritoItems): string {
    $amount = 0;
    foreach($carritoItems as $carrito){
      $amount = $amount + $carrito['amount'];
    }  
    return $amount;
  }

  static function product_Exists($carritoItems,$product) {

    foreach($carritoItems as $carrito){
         if($carrito['nameproduct']==$product){
               
             return true;
         }
      } 

      return false;
      
  }


  static  function Amount($carsItems,$product,$amount): int {
    $amounte =0;
    for ($i=0; $i < count($carsItems); $i++) { 
        if($carsItems[$i]['idproduct'] == $product){          
            $amounte = intval($carsItems[$i]['amount']) + $amount;
            break; 
        }
    }
    return $amounte;
  }


  static function productRemoveItems($carsItems,$productRemove) :array {
      
      $remove=[];
      $remove = $carsItems;
      unset($remove[$productRemove]);
      
      return $remove;
  }




}