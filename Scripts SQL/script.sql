drop database if exists pw2;
create database pw2;
ALTER DATABASE pw2 CHARACTER SET utf8 COLLATE utf8_general_ci;
USE pw2;

CREATE TABLE tipo_usuario(
    id int,
    descripcionTipoUsuario NVARCHAR(50),
    PRIMARY KEY (id)
)ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE credencial(
    id INT AUTO_INCREMENT,
    username VARCHAR(30) UNIQUE,
    pass VARCHAR(30),
    PRIMARY KEY (id)
)ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE usuario(
    id INT AUTO_INCREMENT,
    nombre VARCHAR(30),
    apellido VARCHAR(30),
    tipo_usuario INT, -- admin (1) / normal (2)
    codigo_viajero INT,
    credencial INT,
    PRIMARY KEY(id),
    FOREIGN KEY (tipo_usuario) REFERENCES tipo_usuario(id),
    FOREIGN KEY (credencial) REFERENCES Credencial(id)
)ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE tipoVuelo(
    id INT AUTO_INCREMENT,
    nombreTipoVuelo VARCHAR(50) UNIQUE,
    PRIMARY KEY(id)
)ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE origenvuelo(
    id INT AUTO_INCREMENT,
    nombreOrigen NVARCHAR(50) UNIQUE,
    PRIMARY KEY(id)
)ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE destinovuelo(
    id INT AUTO_INCREMENT,
    nombreDestino NVARCHAR(50) UNIQUE,
    PRIMARY KEY(id)
)ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE vuelo(
    id INT AUTO_INCREMENT NOT NULL,
    fechaPartida date NOT NULL,
    fechaLlegada date NOT NULL,
    matricula varchar(10) NOT NULL,
    origenVuelo INT NOT NULL,
    destinoVuelo INT NOT NULL,
    PRIMARY KEY(id),
    FOREIGN KEY(origenVuelo) REFERENCES origenvuelo(id),
    FOREIGN KEY(destinoVuelo) REFERENCES destinovuelo(id)
)ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `tipo_usuario` (`id`, `descripcionTipoUsuario`)
                     VALUES (1, 'admin'),
                            (2, 'normal');

INSERT INTO `credencial` (`id`, `username`, `pass`)
                     VALUES (NULL, 'ezep', '1234'),
                            (NULL, 'iant', '1234'),
                            (NULL, 'alejoz', '1234'),
                            (NULL, 'juanp', '1234');

INSERT INTO `usuario` (`id`,`nombre`, `apellido`, `tipo_usuario`, `codigo_viajero`,`credencial`)
                     VALUES (NULL, 'Ezequiel', 'Paoloni', 1, 0,1),
                            (NULL, 'Ian', 'Tries', 1, 0,2),
                            (NULL, 'Alejo', 'Zonta', 1, 0,3),
                            (NULL, 'Juan', 'Pérez', 2, 1,4);

INSERT INTO `tipovuelo` (`id`, `nombreTipoVuelo`)
                     VALUES (NULL, 'Orbital'),
                            (NULL, 'Baja aceleración'),
                            (NULL, 'Alta aceleración');

INSERT INTO  `origenvuelo` (`id`, `nombreOrigen`)
                     VALUES (NULL, 'Buenos Aires'),
                            (NULL, 'Ankara');                       

INSERT INTO `destinovuelo` (`id`, `nombreDestino`)
                     VALUES (NULL, 'Buenos Aires'),
                            (NULL, 'Ankara'),
                            (NULL, 'Estación Especial Internacional'),
                            (NULL, 'OrbiterHotel'),
                            (NULL, 'Luna'),
                            (NULL, 'Marte'),
                            (NULL, 'Ganimedes'),
                            (NULL, 'Europa'),
                            (NULL, 'lo'),
                            (NULL, 'Encedalo'),
                            (NULL, 'Titán');

INSERT INTO `vuelo`(`id`, `fechaPartida`, `fechaLlegada`, `matricula`, `origenVuelo`, `destinoVuelo`)
                     VALUES (NULL, '20191014', '20191014', 'O1', 1, 2),
                            (NULL, '20191015', '20191015', 'O2', 2, 1),
                            (NULL, '20191015', '20191017', 'AA1', 1, 6),
                            (NULL, '20191015', '20191019', 'BA4', 1, 11);