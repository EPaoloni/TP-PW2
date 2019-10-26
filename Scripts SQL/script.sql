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

CREATE TABLE modeloNave(
    id INT AUTO_INCREMENT,
    nombreModelo NVARCHAR(50) UNIQUE,
    tipoVueloRealizado INT,
    PRIMARY KEY(id),
    FOREIGN KEY(tipoVueloRealizado) REFERENCES tipoVuelo(id)
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

CREATE TABLE naves(
    id INT AUTO_INCREMENT,
    matricula NVARCHAR(5) UNIQUE,
    modelo INT,
    PRIMARY KEY(id),
    FOREIGN KEY(modelo) REFERENCES modeloNave(id)
)ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE cabinas(
    id INT AUTO_INCREMENT,
    tipoCabina NVARCHAR(1) UNIQUE,
    PRIMARY KEY(id)
)ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE modeloNave_cabinas(
    id INT AUTO_INCREMENT,
    modeloNave INT,
    tipoCabina INT,
    capacidad INT,
    PRIMARY KEY(id),
    UNIQUE KEY (modeloNave,tipoCabina),
    FOREIGN KEY(modeloNave) REFERENCES modeloNave(id),
    FOREIGN KEY(tipoCabina) REFERENCES cabinas(id)    
)ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE pasajeros(
    id INT AUTO_INCREMENT,
    numeroPasajero INT UNIQUE,
    PRIMARY KEY(id)
)ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE modeloNave_pasajeros(
    id INT AUTO_INCREMENT,
    modeloNave INT,
    numeroPasajero INT,
    PRIMARY KEY(id),
    UNIQUE KEY (modeloNave, numeroPasajero),
    FOREIGN KEY(modeloNave) REFERENCES modeloNave(id),
    FOREIGN KEY(numeroPasajero) REFERENCES pasajeros(id)
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

INSERT INTO `modeloNave` (`id`, `nombreModelo`, `tipoVueloRealizado`)
                     VALUES (NULL, 'Calandria', 1),
                            (NULL, 'Colibri', 1),
                            (NULL, 'Zorzal', 2),
                            (NULL, 'Carancho', 2),
                            (NULL, 'Aguilucho', 2),
                            (NULL, 'Canario', 2),
                            (NULL, 'Aguila', 3),
                            (NULL, 'Condor', 3),
                            (NULL, 'Alcon', 3),
                            (NULL, 'Guanaco', 3);


INSERT INTO `naves` (`id`, `matricula`, `modelo`)
                     VALUES (NULL, 'AA1', 7),
                            (NULL, 'AA5', 7),
                            (NULL, 'AA9', 7),
                            (NULL, 'AA13', 7),
                            (NULL, 'AA17', 7),
                            (NULL, 'BA8', 5),
                            (NULL, 'BA9', 5),
                            (NULL, 'BA10', 5),
                            (NULL, 'BA11', 5),
                            (NULL, 'BA12', 5),
                            (NULL, 'O1', 1),
                            (NULL, 'O2', 1);

INSERT INTO `cabinas` (`id`, `tipoCabina`)
                     VALUES (NULL, 'G'),
                            (NULL, 'F'),
                            (NULL, 'S');

INSERT INTO `modeloNave_cabinas` (`id`, `modeloNave`, `tipoCabina`, `capacidad`)
                     VALUES (NULL, 1, 1, 200),
                            (NULL, 1, 2, 75),
                            (NULL, 1, 3, 25),
                            (NULL, 2, 1, 100),
                            (NULL, 2, 2, 18),
                            (NULL, 2, 3, 2),
                            (NULL, 3, 1, 50),
                            (NULL, 3, 3, 50),
                            (NULL, 4, 1, 110),
                            (NULL, 5, 2, 50),
                            (NULL, 5, 3, 10),
                            (NULL, 6, 2, 70),
                            (NULL, 6, 3, 10),
                            (NULL, 7, 1, 200),
                            (NULL, 7, 2, 75),
                            (NULL, 7, 3, 25),
                            (NULL, 8, 1, 300),
                            (NULL, 8, 2, 10),
                            (NULL, 8, 3, 40),
                            (NULL, 9, 1, 150),
                            (NULL, 9, 2, 25),
                            (NULL, 9, 3, 25),
                            (NULL, 10, 3, 100);

INSERT INTO `pasajeros` (`id`, `numeroPasajero`)
                     VALUES (NULL, 1),
                            (NULL, 2),
                            (NULL, 3);


INSERT INTO `modeloNave_pasajeros` (`id`, `modeloNave`, `numeroPasajero`)
                     VALUES (NULL, 1, 1),
                            (NULL, 1, 2),
                            (NULL, 1, 3),
                            (NULL, 2, 1),
                            (NULL, 2, 2),
                            (NULL, 2, 3),
                            (NULL, 3, 2),
                            (NULL, 3, 3),
                            (NULL, 4, 2),
                            (NULL, 4, 3),
                            (NULL, 5, 2),
                            (NULL, 5, 3),
                            (NULL, 6, 2),
                            (NULL, 6, 3),
                            (NULL, 7, 2),
                            (NULL, 7, 3),
                            (NULL, 8, 2),
                            (NULL, 8, 3),
                            (NULL, 9, 3),
                            (NULL, 10, 3);                                              

INSERT INTO `vuelo`(`id`, `fechaPartida`, `fechaLlegada`, `matricula`, `origenVuelo`, `destinoVuelo`)
                      VALUES (NULL, '20191014', '20191014', 'O1', 1, 2),
                             (NULL, '20191015', '20191015', 'O2', 2, 1),
                             (NULL, '20191015', '20191017', 'AA1', 1, 6),
                             (NULL, '20191015', '20191019', 'BA4', 1, 11);