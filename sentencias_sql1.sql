

/////DROP TABLES////
/////NO USAR SI ES PARA INSERTAR//////////
DROP TABLE PalabrasProhibidas;
DROP TABLE Imagenes;
DROP TABLE Comentario;
DROP TABLE Etiqueta;
DROP TABLE Evento;
DROP TABLE Usuario;
////////////////////////////////////







//CREACION TABLAS//////////////////////////////
create table Evento(
	id INT AUTO_INCREMENT PRIMARY KEY,
	nombre VARCHAR(30),
	titulo VARCHAR(30) NOT NULL,
	fecha VARCHAR(15),
	fecha_publicacion DATE,
	texto VARCHAR(1500) NOT NULL,
	autor VARCHAR(20),
	linkEvento VARCHAR(100),
	twitter VARCHAR(100),
	publicado BOOLEAN DEFAULT 0
);
create table Comentario(
	id INT AUTO_INCREMENT PRIMARY KEY,
	id_evento INT,
	usuario VARCHAR(300),
	fecha DATE,
	email VARCHAR(30),
	comentario VARCHAR(400),
	modificado BOOLEAN DEFAULT 0,
	FOREIGN KEY (id_evento) REFERENCES Evento(id)
);

CREATE TABLE Imagenes(
  id_evento INT,
  img VARCHAR(50) PRIMARY KEY,
  descripcion VARCHAR(200),
  FOREIGN KEY (id_evento) REFERENCES Evento(id)

);

create table PalabrasProhibidas(
  id INT AUTO_INCREMENT PRIMARY KEY,
  palabra VARCHAR(30)
);

create table PalabrasProhibidas(
  id INT AUTO_INCREMENT PRIMARY KEY,
  palabra VARCHAR(30)
);

create table Usuario(
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(300) UNIQUE,
  contrasenia VARCHAR(300),
  email VARCHAR(30),
  registrado BOOLEAN DEFAULT 1,
  moderador BOOLEAN DEFAULT 0,
  gestor_sitio BOOLEAN DEFAULT 0,
  super BOOLEAN DEFAULT 0
);

create table Etiqueta(
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(300) UNIQUE,
  id_evento INT NOT NULL,
  FOREIGN KEY (id_evento) REFERENCES Evento(id)
);



//////////////ALGUNOS INSERT/////////////////////////////////////////////////////////////////////////////

INSERT INTO Usuario (nombre, contrasenia,email,registrado,moderador,gestor_sitio,super)
			VALUES ('PabloP','$2y$10$mGwJK76zo6rjkZL3j6YU6uKmjNtV51jmMy8zSUUFt/uuPmzfZeQ0O','pablo@gmail.com',1,1,1,1);

INSERT INTO Usuario (nombre, contrasenia,email,registrado,moderador,gestor_sitio,super)
			VALUES ('PabloP1','$2y$10$mGwJK76zo6rjkZL3j6YU6uKmjNtV51jmMy8zSUUFt/uuPmzfZeQ0O','pablo@gmail.com',1,1,1,1);




/////////////INSERT ///////////////////////////
INSERT INTO Evento (nombre, titulo,fecha,fecha_publicacion,texto,autor,linkEvento,twitter) 

VALUES ('Concierto ESTOPA', 'Gira Fuego-ESTOPA','24 abril 2021',CURDATE(),'Ciudadanos ilustres de Cornellá (junto con La Banda Trapera) los hermanos Muñoz han hecho del Rumba un arte inagotable tras las esencias de Peret y Gato Pérez. Con cinco millones de discos vendidos han conseguido a base de gracejo, cotidianidad y simpatía que la rumba sea global, y ahí siguen, dieciocho años depues,Además de repasar sus canciones que ya son himnos de la historia de la música de este país.','-Corte ingles','https://www.conciertosengranada.es/conciertos/11589-estopa','https://twitter.com/estopaoficial-ref_src=twsrc%5Egoogle%7Ctwcamp%5Eserp%7Ctwgr%5Eauthor');


INSERT INTO Evento (nombre, titulo,fecha,fecha_publicacion,texto,autor,linkEvento,twitter)
 
VALUES ('Feria', 'Feria de Granada','24 abril 2021',CURDATE(),'Como en muchas otras ciudades andaluzas, el recinto ferial en Granada se ubica lejos del centro, ya que se necesita mucho espacio para albergar la gran cantidad de casetas que se instalan en ella y la amplia zona de columpios y ocio que siempre la acompañan. Podríamos decir que el recinto ferial está dividido en tres partes: la zona de las casetas, la de los columpios y atracciones, y las calles de entrada y acceso a estas dos partes, donde se pueden encontrar muchos puestos con golosinas, patatas asadas, bares, etc.\nCada una de estas calles está decorada con miles de bombillas y farolillos, siendo la calle principal la que ostenta la puerta más importante, llamada portada. ','-Corte ingles','https://www.conciertosengranada.es/conciertos/11589-estopa','https://twitter.com/estopaoficial-ref_src=twsrc%5Egoogle%7Ctwcamp%5Eserp%7Ctwgr%5Eauthor');


INSERT INTO Evento (nombre, titulo,fecha,fecha_publicacion,texto,autor,linkEvento,twitter) 

VALUES ('Conciertos', 'Gira Fuego-ESTOPA','24 abril 2021',CURDATE(),'Ciudadanos ilustres de Cornellá (junto con La Banda Trapera) los hermanos Muñoz han hecho del Rumba un arte inagotable tras las esencias de Peret y Gato Pérez. Con cinco millones de discos vendidos han conseguido a base de gracejo, cotidianidad y simpatía que la rumba sea global, y ahí siguen, dieciocho años depues,Además de repasar sus canciones que ya son himnos de la historia de la música de este país.','-Corte ingles','https://www.conciertosengranada.es/conciertos/11589-estopa','https://twitter.com/estopaoficial-ref_src=twsrc%5Egoogle%7Ctwcamp%5Eserp%7Ctwgr%5Eauthor');


INSERT INTO Evento (nombre, titulo,fecha,fecha_publicacion,texto,autor,linkEvento,twitter) 

VALUES ('Fiestas', 'Gira Fuego-ESTOPA','24 abril 2021',CURDATE(),'Ciudadanos ilustres de Cornellá (junto con La Banda Trapera) los hermanos Muñoz han hecho del Rumba un arte inagotable tras las esencias de Peret y Gato Pérez. Con cinco millones de discos vendidos han conseguido a base de gracejo, cotidianidad y simpatía que la rumba sea global, y ahí siguen, dieciocho años depues,Además de repasar sus canciones que ya son himnos de la historia de la música de este país.','-Corte ingles','https://www.conciertosengranada.es/conciertos/11589-estopa','https://twitter.com/estopaoficial-ref_src=twsrc%5Egoogle%7Ctwcamp%5Eserp%7Ctwgr%5Eauthor');



INSERT INTO Evento (nombre, titulo,fecha,fecha_publicacion,texto,autor,linkEvento,twitter) 
VALUES ('Discoteca', 'Gira Fuego-ESTOPA','24 abril 2021',CURDATE(),'Ciudadanos ilustres de Cornellá (junto con La Banda Trapera) los hermanos Muñoz han hecho del Rumba un arte inagotable tras las esencias de Peret y Gato Pérez. Con cinco millones de discos vendidos han conseguido a base de gracejo, cotidianidad y simpatía que la rumba sea global, y ahí siguen, dieciocho años depues,Además de repasar sus canciones que ya son himnos de la historia de la música de este país.','-Corte ingles','https://www.conciertosengranada.es/conciertos/11589-estopa','https://twitter.com/estopaoficial-ref_src=twsrc%5Egoogle%7Ctwcamp%5Eserp%7Ctwgr%5Eauthor');


INSERT INTO Evento (nombre, titulo,fecha,fecha_publicacion,texto,autor,linkEvento,twitter) 

VALUES ('Partido futbol', 'Gira Fuego-ESTOPA','24 abril 2021',CURDATE(),'Ciudadanos ilustres de Cornellá (junto con La Banda Trapera) los hermanos Muñoz han hecho del Rumba un arte inagotable tras las esencias de Peret y Gato Pérez. Con cinco millones de discos vendidos han conseguido a base de gracejo, cotidianidad y simpatía que la rumba sea global, y ahí siguen, dieciocho años depues,Además de repasar sus canciones que ya son himnos de la historia de la música de este país.','-Corte ingles','https://www.conciertosengranada.es/conciertos/11589-estopa','https://twitter.com/estopaoficial-ref_src=twsrc%5Egoogle%7Ctwcamp%5Eserp%7Ctwgr%5Eauthor');


INSERT INTO Evento (nombre, titulo,fecha,fecha_publicacion,texto,autor,linkEvento,twitter)

VALUES ('Concierto ESTOPA', 'Gira Fuego-ESTOPA','24 abril 2021',CURDATE(),'Ciudadanos ilustres de Cornellá (junto con La Banda Trapera) los hermanos Muñoz han hecho del Rumba un arte inagotable tras las esencias de Peret y Gato Pérez. Con cinco millones de discos vendidos han conseguido a base de gracejo, cotidianidad y simpatía que la rumba sea global, y ahí siguen, dieciocho años depues,Además de repasar sus canciones que ya son himnos de la historia de la música de este país.','-Corte ingles','https://www.conciertosengranada.es/conciertos/11589-estopa','https://twitter.com/estopaoficial-ref_src=twsrc%5Egoogle%7Ctwcamp%5Eserp%7Ctwgr%5Eauthor');

INSERT INTO Evento (nombre, titulo,fecha,fecha_publicacion,texto,autor,linkEvento,twitter) 
VALUES ('DVICIO', 'Gira Fuego-ESTOPA','24 abril 2021',CURDATE(),'Ciudadanos ilustres de Cornellá (junto con La Banda Trapera) los hermanos Muñoz han hecho del Rumba un arte inagotable tras las esencias de Peret y Gato Pérez. Con cinco millones de discos vendidos han conseguido a base de gracejo, cotidianidad y simpatía que la rumba sea global, y ahí siguen, dieciocho años depues,Además de repasar sus canciones que ya son himnos de la historia de la música de este país.','-Corte ingles','https://www.conciertosengranada.es/conciertos/11589-estopa','https://twitter.com/estopaoficial-ref_src=twsrc%5Egoogle%7Ctwcamp%5Eserp%7Ctwgr%5Eauthor');


INSERT INTO Evento (nombre, titulo,fecha,fecha_publicacion,texto,autor,linkEvento,twitter) 
VALUES ('Museo', 'Gira Fuego-ESTOPA','24 abril 2021',CURDATE(),'Ciudadanos ilustres de Cornellá (junto con La Banda Trapera) los hermanos Muñoz han hecho del Rumba un arte inagotable tras las esencias de Peret y Gato Pérez. Con cinco millones de discos vendidos han conseguido a base de gracejo, cotidianidad y simpatía que la rumba sea global, y ahí siguen, dieciocho años depues,Además de repasar sus canciones que ya son himnos de la historia de la música de este país.','-Corte ingles','https://www.conciertosengranada.es/conciertos/11589-estopa','https://twitter.com/estopaoficial-ref_src=twsrc%5Egoogle%7Ctwcamp%5Eserp%7Ctwgr%5Eauthor');




INSERT INTO Comentario (id_evento, usuario,fecha,email,comentario) VALUES (1, 'Chema',CURDATE(),'pablopm31@correo.ugr.es','Vaya ***** de web la odio');

INSERT INTO Comentario (id_evento, usuario,fecha,email,comentario) VALUES (1, 'Joselito',CURDATE(),'pablopm31@correo.ugr.es','Esta web es una pasada');



INSERT INTO Imagenes VALUES ('1', 'c_estopa2.jpg','Hermanos Estopa');
INSERT INTO Imagenes VALUES ('1', 'estopa_resistencia.jpg','Hermanos Estopa');
INSERT INTO Imagenes VALUES ('1', 'estopa_cantando.jpg','Hermanos Estopa');
INSERT INTO Imagenes VALUES ('1', 'portada_disco.jpg','Fotografia Disco Estopa');



INSERT INTO Imagenes VALUES ('2', 'casetas-feria-granada.jpg','Feria Granada');
INSERT INTO Imagenes VALUES ('2', 'alumbrao-feria-granada.jpg','Feria de Granada');

INSERT INTO Imagenes VALUES ('3', 'taburete.jpg','Taburete');

INSERT INTO Imagenes VALUES ('4', 'cruces.jpeg','Cruces');
INSERT INTO Imagenes VALUES ('5', 'discoteca.jpg','Feria de Granada');

INSERT INTO Imagenes VALUES ('6', 'Granada_0-1Lega2016.jpg','Futbol Granada');
INSERT INTO Imagenes VALUES ('7', 'estopa_cantando.jpg','Duo Estopa');

INSERT INTO Imagenes VALUES ('8', 'dvicio.jpeg','Dvicio');
INSERT INTO Imagenes VALUES ('9', 'museo.jpg','Museo de granada');





INSERT INTO PalabrasProhibidas VALUES (null,'Caca');
INSERT INTO PalabrasProhibidas VALUES (null,'Culo');
INSERT INTO PalabrasProhibidas VALUES (null,'Pedo');
INSERT INTO PalabrasProhibidas VALUES (null,'Pis');
INSERT INTO PalabrasProhibidas VALUES (null,'Cabron');
INSERT INTO PalabrasProhibidas VALUES (null,'COVID');
INSERT INTO PalabrasProhibidas VALUES (null,'Mierda');
INSERT INTO PalabrasProhibidas VALUES (null,'suspender');
INSERT INTO PalabrasProhibidas VALUES (null,'Morir');
INSERT INTO PalabrasProhibidas VALUES (null,'Suicidarse');



	
