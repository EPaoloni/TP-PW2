INSERT INTO `tipovuelo` (`nombreTipoVuelo`)
                     VALUES ('Orbital'),
                            ('Baja aceleración'),
                            ('Alta aceleración');

INSERT INTO `pasajeros` (`numeroPasajero`)
                     VALUES (1),
                            (2),
                            (3);
                            
INSERT INTO `modeloNave` (`nombreModelo`, `tipoVueloRealizado`, `codigoDeViajeroRequerido`)
                     VALUES ('Calandria', 1, 1),
                            ('Colibri', 1, 1),
                            ('Zorzal', 2, 2),
                            ('Carancho', 2, 2),
                            ('Aguilucho', 2, 2),
                            ('Canario', 2, 2),
                            ('Aguila', 3, 2),
                            ('Condor', 3, 2),
                            ('Alcon', 3, 3),
                            ('Guanaco', 3, 3);
                            
INSERT INTO `tipoUsuario` (`idTipoUsuario`, `descripcionTipoUsuario`)
                     VALUES (1, 'admin'),
                            (2, 'normal');

INSERT INTO `credencial` (`username`, `pass`)
                     VALUES ('ezep', '81dc9bdb52d04dc20036dbd8313ed055'), -- 1234
                            ('iant', '81dc9bdb52d04dc20036dbd8313ed055'), -- 1234
                            ('alejoz', '81dc9bdb52d04dc20036dbd8313ed055'), -- 1234
                            ('juanp', '81dc9bdb52d04dc20036dbd8313ed055'); -- 1234

INSERT INTO `usuario` (`nombreUsuario`, `apellidoUsuario`, `tipoUsuario`, `codigoViajero`,`numeroCredencialUsuario`, `mail`)
                     VALUES ('Ezequiel', 'Paoloni', 1, 3, 1, 'ezep@hotmail.com'),
                            ('Ian', 'Tries', 1, 3, 2, 'iant@hotmail.com'),
                            ('Alejo', 'Zonta', 1, 3, 3, 'alez@hotmail.com'),
                            ('Juan', 'Pérez', 2, 1, 4, 'juanp@hotmail.com');            

INSERT INTO `estacion` (`nombreEstacion`)
                     VALUES ('Buenos Aires'),
                            ('Ankara'),
                            ('Estacion Especial Internacional'),
                            ('OrbiterHotel'),
                            ('Luna'),
                            ('Marte'),
                            ('Ganimedes'),
                            ('Europa'),
                            ('lo'),
                            ('Encedalo'),
                            ('Titan');

INSERT INTO `circuito` (`idCircuito`, `estacionesCircuito`)
                    VALUES  (1, "3,4,5,6"),
                            (2, "6,5,4,3"),
                            (3, "3,5,7,8,9,10,11"),
                            (4, "11,10,9,8,7,5,3"),
                            (5, "1,2"),
                            (6, "2,1"),
                            (7, "1,1"); -- Circuito para el tour


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
                            ('O2', 1),
                            ('O6',1),
                            ('07',1),
                            ('BA13',6),
                            ('BA14',6),
                            ('BA15',6),
                            ('BA16',6),
                            ('BA17',6),
                            ('BA4', 4),
                            ('BA5', 4),
                            ('BA6', 4),
                            ('BA7', 4),
                            ('O3', 2),
                            ('O4', 2),
                            ('O5', 2),
                            ('O8', 2),
                            ('O9', 2),
                            ('AA2', 8),
                            ('AA6', 8),
                            ('AA10', 8),
                            ('AA14', 8),
                            ('AA18', 8),
                            ('AA4', 10),
                            ('AA8', 10),
                            ('AA12', 10),
                            ('AA16', 10),
                            ('AA3', 9),
                            ('AA7', 9),
                            ('AA11', 9),
                            ('AA15', 9),
                            ('AA19', 9),
                            ('BA1', 3),
                            ('BA2', 3),
                            ('BA3', 3);                          

INSERT INTO `vuelo`(`fechaPartida`, `fechaLlegada`, `id_nave`, `circuitoVuelo`)
                     VALUES ('20191014', '20191014', 11, 5),
                            ('20191015', '20191015', 12, 6),
                            ('20191030', '20191101', 12, 6),
                            ('20191015', '20191017', 1, 1),
                            ('20191015', '20191019', 13, 3),
                            ('20191215', '20200119',34,7),-- tour
                            ('20191222', '20200126',34,7),-- tour
                            ('20191229', '20200202',37,7), -- tour
                            ('20191204', '20191204', 1, 1);

INSERT INTO `cabinas` (`nombreCabina`)
                     VALUES ('General'),
                            ('Familiar'),
                            ('Suite');

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

INSERT INTO `centroMedico` (`idCentroMedico`,`nombreCentroMedico`)
                VALUES  ('1','Centro Medico de Buenos Aires'),
                        ('2','Centro Medico de Shanghái'),
                        ('3','Centro Medico de Ankara');
                        
INSERT INTO `horario`(`idHorario`,`hora`)
		 VALUES (1,'08:00'),
			(2,'09:00'),
                        (3,'10:00'),
                        (4,'11:00'),
                        (5,'12:00'),
                        (6,'13:00'),
                        (7,'14:00'),
                        (8,'15:00');

INSERT INTO `turno`(`idCentroMedico`, `fecha`, `idUsuario`, `idHorario`) 
                    VALUES  ('1', '2014-05-14', NULL,'1'),
                            ('1', '2014-05-14', NULL,'4'),
                            ('1', '2014-05-14', NULL,'7');

INSERT INTO `reserva`(`idTitular`, `idVuelo`, `idOrigenReserva`, `idDestinoReserva`, `montoReserva`, `reservaPaga`, `lugaresSeleccionados`,`idCabina` ,`reservaCaida`) 
                    VALUES  (1, 4, 5, 9, 300, false, '1,2,3', 2, false),
                            (2, 4, 5, 9, 300, false, '4,5', 2, false),
                            -- (2, 4, 5, 9, 300, false, '4,5', 2, false),
                            -- (2, 4, 5, 9, 300, false, '4,5', 2, false),
                            -- (2, 4, 5, 9, 300, false, '4,5', 2, false),
                            -- (2, 4, 5, 9, 300, false, '4,5', 2, false),
                            -- (2, 4, 5, 9, 300, false, '4,5', 2, false),
                            (1, 9, 1, 2, 300, true, '', 2, false),
                            (3, 4, 5, 9, 300, false, '6', 2, false);

INSERT INTO `acompaniante_reserva`(`idReserva`, `idUsuario`) 
                    VALUES  (1, 2),
                            (1, 3),
                            (2, 3),
                            (2, 4),
                            (3, 4);

INSERT INTO `precioCabina`(`idCabina`, `precio`)
                     VALUES (1, 100),
                            (2, 200),
                            (3, 300);                          