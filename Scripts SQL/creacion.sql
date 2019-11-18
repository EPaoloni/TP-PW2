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
    mail varchar(100) UNIQUE,
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
    codigoDeViajeroRequerido INT,
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
    idCabina INT AUTO_INCREMENT,
    nombreCabina NVARCHAR(20) UNIQUE,
    PRIMARY KEY(idCabina)
)ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE modeloNave_cabinas(
    id INT AUTO_INCREMENT,
    modeloNave INT,
    tipoCabina INT,
    capacidad INT,
    PRIMARY KEY(id),
    UNIQUE KEY (modeloNave,tipoCabina),
    FOREIGN KEY(modeloNave) REFERENCES modeloNave(id),
    FOREIGN KEY(tipoCabina) REFERENCES cabinas(idCabina)    
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
    id_nave int NOT NULL,
    circuitoVuelo INT NOT NULL,
    PRIMARY KEY(idVuelo),
    FOREIGN KEY(circuitoVuelo) REFERENCES circuito(idCircuito),
    FOREIGN KEY(id_nave) REFERENCES naves(id)
)ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE reserva(
    idReserva INT AUTO_INCREMENT,
    idTitular INT NOT NULL,
    idVuelo INT NOT NULL,
    idOrigenReserva INT NOT NULL,
    idDestinoReserva INT NOT NULL,
    montoReserva DECIMAL NOT NULL,
    reservaPaga BOOLEAN NOT NULL,
    lugaresSeleccionados NVARCHAR(50) NOT NULL,
    idCabina INT NOT NULL,
    reservaCaida BOOLEAN NOT NULL,
    PRIMARY KEY (idReserva),
    FOREIGN KEY (idVuelo) REFERENCES vuelo(idVuelo),
    FOREIGN KEY (idOrigenReserva) REFERENCES estacion(idEstacion),
    FOREIGN KEY (idDestinoReserva) REFERENCES estacion(idEstacion)
)ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE acompaniante_reserva(
    idReserva INT NOT NULL,
    idUsuario INT NOT NULL,
    PRIMARY KEY (idReserva, idUsuario),
    FOREIGN KEY (idReserva) REFERENCES reserva(idReserva),
    FOREIGN KEY (idUsuario) REFERENCES usuario(idUsuario)
)ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE centroMedico(
    idCentroMedico INT NOT NULL,
    nombreCentroMedico varchar(50) NOT NULL,
    PRIMARY KEY(idCentroMedico)
)ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE horario(
    idHorario INT NOT NULL,
    hora TIME NOT NULL,
    PRIMARY KEY(idHorario)
)ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE turno(
    idTurno INT AUTO_INCREMENT NOT NULL,
	fecha DATE NOT NULL,
    idCentroMedico INT,
    idUsuario INT,
    idHorario int,
    PRIMARY KEY(idTurno),
    FOREIGN KEY(idCentroMedico) REFERENCES centroMedico(idCentroMedico),
    FOREIGN KEY(idUsuario) REFERENCES Usuario(idUsuario),
    FOREIGN KEY(idHorario) REFERENCES horario(idHorario)
)ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE precioCabina(
    idCabina INT,
    precio DECIMAL NOT NULL,
    PRIMARY KEY (idCabina, precio),
    FOREIGN KEY (idCabina) REFERENCES cabinas(idCabina)
)ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE pago(
    idPago INT AUTO_INCREMENT NOT NULL,
    numeroUsuario INT NOT NULL,
    fechaPago DATE NOT NULL,
    numeroReserva INT NOT NULL,    
    PRIMARY KEY (idPago),
    FOREIGN KEY(numeroUsuario) REFERENCES Usuario(idUsuario),
    FOREIGN KEY(numeroReserva) REFERENCES Reserva(idReserva)
)ENGINE=InnoDB DEFAULT CHARSET=latin1;