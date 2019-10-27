drop database if exists pw2;
create database pw2;
ALTER DATABASE pw2 CHARACTER SET utf8 COLLATE utf8_general_ci;
USE pw2;

CREATE TABLE tipoUsuario(
    idTipoUsuario int,
    descripcionTipoUsuario NVARCHAR(50),
    PRIMARY KEY (idTipoUsuario)
)ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE credencial(
    idCredencial INT AUTO_INCREMENT,
    username VARCHAR(30) UNIQUE,
    pass VARCHAR(30),
    PRIMARY KEY (idCredencial)
)ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE usuario(
    idUsuario INT AUTO_INCREMENT,
    nombreUsuario VARCHAR(30),
    apellidoUsuario VARCHAR(30),
    tipoUsuario INT, -- admin (1) / normal (2)
    codigoViajero INT,
    numeroCredencialUsuario INT,
    PRIMARY KEY(idUsuario),
    FOREIGN KEY (tipoUsuario) REFERENCES tipoUsuario(idTipoUsuario),
    FOREIGN KEY (numeroCredencialUsuario) REFERENCES Credencial(idCredencial)
)ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE tipoVuelo(
    idTipoVuelo INT AUTO_INCREMENT,
    nombreTipoVuelo VARCHAR(50) UNIQUE,
    PRIMARY KEY(idTipoVuelo)
)ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE estacion(
    idEstacion INT AUTO_INCREMENT,
    nombreEstacion NVARCHAR(50) UNIQUE,
    PRIMARY KEY(idEstacion)
)ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE modeloNave(
    id INT AUTO_INCREMENT,
    nombreModelo NVARCHAR(50) UNIQUE,
    tipoVueloRealizado INT,
    PRIMARY KEY(id),
    FOREIGN KEY(tipoVueloRealizado) REFERENCES tipoVuelo(idTipoVuelo)
)ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE circuito(
    idCircuito INT,
    estacionesCircuito VARCHAR(50),
    PRIMARY KEY(idCircuito)
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
    idVuelo INT AUTO_INCREMENT NOT NULL,
    fechaPartida date NOT NULL,
    fechaLlegada date NOT NULL,
    matricula varchar(10) NOT NULL,
    circuitoVuelo INT NOT NULL,
    PRIMARY KEY(idVuelo),
    FOREIGN KEY(circuitoVuelo) REFERENCES circuito(idCircuito)
)ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `tipoUsuario` (`idTipoUsuario`, `descripcionTipoUsuario`)
                     VALUES (1, 'admin'),
                            (2, 'normal');

INSERT INTO `credencial` (`username`, `pass`)
                     VALUES ('ezep', '1234'),
                            ('iant', '1234'),
                            ('alejoz', '1234'),
                            ('juanp', '1234');

INSERT INTO `usuario` (`nombreUsuario`, `apellidoUsuario`, `tipoUsuario`, `codigoViajero`,`numeroCredencialUsuario`)
                     VALUES ('Ezequiel', 'Paoloni', 1, 0, 1),
                            ('Ian', 'Tries', 1, 0, 2),
                            ('Alejo', 'Zonta', 1, 0, 3),
                            ('Juan', 'Pérez', 2, 1, 4);

INSERT INTO `tipovuelo` (`nombreTipoVuelo`)
                     VALUES ('Orbital'),
                            ('Baja aceleración'),
                            ('Alta aceleración');            

INSERT INTO `estacion` (`nombreEstacion`)
                     VALUES ('Buenos Aires'),
                            ('Ankara'),
                            ('Estación Especial Internacional'),
                            ('OrbiterHotel'),
                            ('Luna'),
                            ('Marte'),
                            ('Ganimedes'),
                            ('Europa'),
                            ('lo'),
                            ('Encedalo'),
                            ('Titán');

INSERT INTO `circuito` (`idCircuito`, `estacionesCircuito`)
                    VALUES  (1, "3,4,5,6"),
                            (2, "6,5,4,3"),
                            (3, "3,5,7,8,9,10,11"),
                            (4, "11,10,9,8,7,5,3"),
                            (5, "1,2"),
                            (6, "2,1");

INSERT INTO `vuelo`(`fechaPartida`, `fechaLlegada`, `matricula`, `circuitoVuelo`)
                     VALUES ('20191014', '20191014', 'O1', 5),
                            ('20191015', '20191015', 'O2', 6),
                            ('20191030', '20191101', 'O2', 6),
                            ('20191015', '20191017', 'AA1', 1),
                            ('20191015', '20191019', 'BA4', 3);

INSERT INTO `modeloNave` (`nombreModelo`, `tipoVueloRealizado`)
                     VALUES ('Calandria', 1),
                            ('Colibri', 1),
                            ('Zorzal', 2),
                            ('Carancho', 2),
                            ('Aguilucho', 2),
                            ('Canario', 2),
                            ('Aguila', 3),
                            ('Condor', 3),
                            ('Alcon', 3),
                            ('Guanaco', 3);


INSERT INTO `naves` (`matricula`, `modelo`)
                     VALUES ('AA1', 7),
                            ('AA5', 7),
                            ('AA9', 7),
                            ('AA13', 7),
                            ('AA17', 7),
                            ('BA8', 5),
                            ('BA9', 5),
                            ('BA10', 5),
                            ('BA11', 5),
                            ('BA12', 5),
                            ('O1', 1),
                            ('O2', 1);

INSERT INTO `cabinas` (`tipoCabina`)
                     VALUES ('G'),
                            ('F'),
                            ('S');

INSERT INTO `modeloNave_cabinas` (`modeloNave`, `tipoCabina`, `capacidad`)
                     VALUES (1, 1, 200),
                            (1, 2, 75),
                            (1, 3, 25),
                            (2, 1, 100),
                            (2, 2, 18),
                            (2, 3, 2),
                            (3, 1, 50),
                            (3, 3, 50),
                            (4, 1, 110),
                            (5, 2, 50),
                            (5, 3, 10),
                            (6, 2, 70),
                            (6, 3, 10),
                            (7, 1, 200),
                            (7, 2, 75),
                            (7, 3, 25),
                            (8, 1, 300),
                            (8, 2, 10),
                            (8, 3, 40),
                            (9, 1, 150),
                            (9, 2, 25),
                            (9, 3, 25),
                            (10, 3, 100);

INSERT INTO `pasajeros` (`numeroPasajero`)
                     VALUES (1),
                            (2),
                            (3);


INSERT INTO `modeloNave_pasajeros` (`modeloNave`, `numeroPasajero`)
                     VALUES (1, 1),
                            (1, 2),
                            (1, 3),
                            (2, 1),
                            (2, 2),
                            (2, 3),
                            (3, 2),
                            (3, 3),
                            (4, 2),
                            (4, 3),
                            (5, 2),
                            (5, 3),
                            (6, 2),
                            (6, 3),
                            (7, 2),
                            (7, 3),
                            (8, 2),
                            (8, 3),
                            (9, 3),
                            (10, 3);                                              
