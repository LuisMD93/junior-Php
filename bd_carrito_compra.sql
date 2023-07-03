
create database familybasket;

use familybasket;

create table rol(

   id_rol int primary key auto_increment,
   rol varchar(20) not null
);


insert into rol values (0,'Supervisor');
insert into rol values (0,'Administrador');
insert into rol values (0,'Cliente');


create table users(

   id_user int primary key auto_increment,
   name varchar(45) not null, 
   password varchar(60) not null,
   email varchar(30) not null,
   phone varchar(15) not null,
   photo  varchar(45) not null,
   rol_id int not null,
   foreign key(rol_id) references rol(id_rol)
  ON DELETE CASCADE ON UPDATE CASCADE
   
);

insert into users values(0,'Miguel Morales','10020','mm@persona.com','24739039','free-avatar-apertura.jpg',3);
insert into users values(0,'Karens Rodriguez','10030','karensro@persona.com','31737472','karens.jpg',2);
insert into users values(0,'Romario Solis','10040','romario@persona.com','24739039','romario.jgp',2);
insert into users values(0,'Luis Solis','10050','luis@persona.com','3124568821','free-avatar-apertura.jpg',1);
insert into users values(0,'Matias Sarasti','10060','matias@persona.com','5395948','free-avatar-apertura.jpg',3);
insert into users values(0,'Damarias Estupiñan','10070','dama@persona.com','20121224','free-avatar-apertura.jpg',3);
insert into users values(0,'Camila Sol','10080','sol@persona.com','202138328','free-avatar-apertura.jpg',3);
insert into users values(0,'Bee Gees - Stayin Alive','10090','beegees@persona.com','19751919','free-avatar-apertura.jpg',3);



create table product(


  id_product int primary key auto_increment,
  nombre varchar(45) not null,
  photo varchar(45) not null,
  price double not null,
  availability int not null
);


insert into product values(0,'Arroz','arroz.jpg',3000,1);
insert into product values(0,'Huevos','huevos.jpg',12000,1);
insert into product values(0,'Harina','harina.jpg',2000,1);
insert into product values(0,'crema','crema.jpg',4100,1);
insert into product values(0,'leche','papel.jpg',5000,1);


create table car(

  id_pedido int primary key auto_increment,
  amount int not null,
  idproducts int not null,
  total int not null,
  iduser int not null,
  idsuper int not null,
  stattus varchar(20) not null,
  foreign key (idproducts) references product(id_product),
  foreign key (iduser) references users(id_user)
);





drop procedure if exists changex;
delimiter //

CREATE PROCEDURE changex (IN id int)
     BEGIN  
                declare vlr int;    
                select  availability into vlr from product where  id_product=id;  
                
               if(vlr<1) then

                  update product set availability=1 where id_product=id;
               else
                  update product set availability=0 where id_product=id;
               end if ;

            
                   
     END //

delimiter ;


