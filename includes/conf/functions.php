<?php

require_once 'database.php';

class Functions{
    


    static function getUser(){
        
        $conexion = new Conexion();
        $query = $conexion->prepare('SELECT id_user , name, password,email,phone, photo , rol  from users join rol where rol_id=id_rol');
        $query->execute();
    
        return  $query->fetchAll();

     }


     static function getRols(){
        
      $conexion = new Conexion();
      $query = $conexion->prepare('SELECT * FROM rol');
      $query ->execute();
  
      return  $query->fetchAll();

   }



    static function getProducts(){
       

      $conexion = new Conexion();
      $query = $conexion->prepare('SELECT * from  product');
      //$consulta->bindParam(':id', $id);
      $query->execute();
  
      return  $query->fetchAll();

   }

   static function getCustomerOrders(){
  
      $conexion = new Conexion();
      $query = $conexion->prepare(' select id_pedido ,  nombre as nombrep , name, amount, total,stattus from car join product join users where idproducts=id_product and iduser=id_user and stattus="pendiente"');
      $query->execute();
  
      return  $query->fetchAll();
      
   }

   
   static function changeAvailability(int $id){
        
      $conexion = new Conexion();
      $query = $conexion->prepare("call changex(?)");
      $query->bindParam(1, $id, PDO::PARAM_INT);
      $query->execute();

   }

   static function changeStattus($idproduct,$idsuper){
      //update car set status='despachado' , idsuper=12  where id_pedido=2;
      $conexion = new Conexion();
      $query = $conexion->prepare(" UPDATE car set  stattus = 'despachado' ,idsuper ='$idsuper' where id_pedido =".$idproduct);
      $query->execute();
   }

   static function getHistorial($idsuper){

      $conexion = new Conexion();
      $query = "SELECT * FROM `CAR` WHERE `idsuper`=:idsuper";
      $query = $conexion-> prepare($query);
      $query -> bindParam(':idsuper', $idsuper, PDO::PARAM_INT);

      $query->execute();
      return $query->fetchAll();
      
   }

   static function questByIdPerfil(int $id){
        
      $conexion = new Conexion();
      //$query = $conexion->prepare('SELECT * from  users where id_user='.$id);
      $query = $conexion->prepare('SELECT id_user , name, password,email,phone, photo , rol  from users join rol where rol_id=id_rol and id_user='.$id);
      $query->execute();
  
      return  $query->fetch();

   }

   static function deleteProduct(int $id) {

        $conexion = new Conexion();
        $query = "DELETE FROM `product` WHERE `id_product`=:id";
        $query = $conexion-> prepare($query);
        $query -> bindParam(':id', $id, PDO::PARAM_INT);

        $query->execute();

      
   }

   static function addUsers($name,$password,$email,$phone,$photo){
      
      //Por defecto todos inicialmente son clientes y despues el admin podra cambiarle el rol asignado
      $rol =3;
      $conexion = new Conexion();
      $query = $conexion->prepare("INSERT INTO users (name,password,email,phone,photo,rol_id) VALUES ('$name','$password','$email', '$phone','$photo' ,'$rol')");
      $query->execute();

   }

   static function addProducts($name,$price,$pictures,$availability){
      
      $conexion = new Conexion();
      $query = $conexion->prepare("INSERT INTO product (nombre,price,photo,availability) VALUES ('$name','$price','$pictures', '$availability')");
      $query->execute();

   }

   static function if_Exists(string $email,string $pass){
        
      $conexion = new Conexion();
      $query = $conexion->prepare('SELECT password as result , rol_id , photo , id_user as id_users from `users` WHERE `email`=:email and `password`=:pass ');
      $query->bindParam(':email', $email,PDO::PARAM_STR);
      $query->bindParam(':pass', $pass,PDO::PARAM_STR);
      $query->execute();
  
      return  $query->fetch();

   }

   static function UpdateAcountPerfil($name,$password,$email,$phone,$pictures,$id,$new_rol) {
          
      $conexion = new Conexion();
      $query = $conexion->prepare(" UPDATE users set  name = '$name' ,password ='$password',email='$email',phone='$phone', photo='$pictures',rol_id='$new_rol'  where id_user =".$id);
      $query->execute();
      
   }

   static function addBuy($amount,$idproducts,$total,$iduser){
      
      //los pedidos deben esperar para ser despachados entonces, por defecto le asignamo ese valor por defecto
      $stattus = 'pendiente';
      $idsuper = 0;
      $conexion = new Conexion();
      $query = $conexion->prepare("INSERT INTO car (amount,idproducts,total,iduser,idsuper,stattus) VALUES ('$amount','$idproducts','$total','$iduser','$idsuper','$stattus')");
      $query->execute();

   }

}