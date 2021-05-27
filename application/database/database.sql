DROP DATABASE IF EXISTS curso;

CREATE DATABASE curso DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

USE curso;

CREATE TABLE marcas(
    id int primary key auto_increment,
    nombre varchar(50) not null,
    descripcion text not null,
    status tinyint not null
);

CREATE TABLE modelos (
    id int primary key auto_increment,
    marca_id int not null,
    nombre varchar(50) not null,
    descripcion text not null,
    status tinyint not null,
    CONSTRAINT modelo_marcas FOREIGN KEY(marca_id) REFERENCES marcas(id)
);

CREATE TABLE pedidos (
    id int auto_increment not null,
    marca_id int not null,
    modelo_id int not null,
    nombre varchar(100) not null,
    apellido VARCHAR(150) not null,
    domicilio TEXT not null,
    telefono VARCHAR(50) not null,
    fecha datetime not null,
    estado VARCHAR(20) not null,
    monto DOUBLE(10,2) not null,

    CONSTRAINT pk_pedidos PRIMARY KEY(id),
    CONSTRAINT pedido_marcas FOREIGN KEY(marca_id) REFERENCES marcas(id),
    CONSTRAINT pedido_modelos FOREIGN KEY(modelo_id) REFERENCES modelos(id)

);

CREATE TABLE ordenes(
    id int auto_increment not null,
    pedido_id int not null,
    modelo_id int not null,
    cantidad int(255) not null,

    CONSTRAINT pk_ordenes PRIMARY KEY(id),
    CONSTRAINT orden_pedido FOREIGN KEY(pedido_id) REFERENCES pedidos(id),
    CONSTRAINT orden_modelo FOREIGN KEY(modelo_id) REFERENCES modelos(id)
);