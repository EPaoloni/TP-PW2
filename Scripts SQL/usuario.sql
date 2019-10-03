//Creacion de tabla

USE pw2;

CREATE TABLE usuario(
    id INT AUTO_INCREMENT,
    username VARCHAR(30),
    pass VARCHAR(30),
    nombre VARCHAR(30),
    apellido VARCHAR(30),
    tipo_usuario VARCHAR(30),
    PRIMARY KEY(id)
)