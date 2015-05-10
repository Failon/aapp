

-- tables
-- Table Anuncios
CREATE TABLE Anuncios (
    id_anuncio int    NOT NULL  AUTO_INCREMENT,
    titulo varchar(200)    NOT NULL ,
    descripcion text    NULL ,
    precio double(7,2)    NOT NULL ,
    usuario int    NOT NULL ,
    categoria int    NOT NULL ,
    foto blob    NULL ,
    ciudad int    NOT NULL ,
    activo int    NOT NULL DEFAULT 1 ,
    CHECK (activo<=1 AND activo>0),
    CONSTRAINT Anuncios_pk PRIMARY KEY (id_anuncio)
) ENGINE = InnoDB
;

-- Table Categorias
CREATE TABLE Categorias (
    id_categoria int    NOT NULL  AUTO_INCREMENT,
    nombre varchar(100)    NOT NULL ,
    CONSTRAINT Categorias_pk PRIMARY KEY (id_categoria)
) ENGINE = InnoDB
;

-- Table Ciudades
CREATE TABLE Ciudades (
    id_ciudad int    NOT NULL  AUTO_INCREMENT,
    nombre varchar(100)    NOT NULL ,
    provincia int    NOT NULL ,
    CONSTRAINT Ciudades_pk PRIMARY KEY (id_ciudad)
) ENGINE = InnoDB
;

-- Table Comunidades_Autonomas
CREATE TABLE Comunidades_Autonomas (
    id_comunidad int    NOT NULL  AUTO_INCREMENT,
    nombre varchar(100)    NOT NULL ,
    CONSTRAINT Comunidades_Autonomas_pk PRIMARY KEY (id_comunidad)
) ENGINE = InnoDB
;

-- Table Denuncias
CREATE TABLE Denuncias (
    id_denuncia int    NOT NULL  AUTO_INCREMENT,
    denunciante int    NOT NULL ,
    motivo text    NOT NULL ,
    anuncio int    NOT NULL ,
    CONSTRAINT Denuncias_pk PRIMARY KEY (id_denuncia)
) ENGINE = InnoDB
;

-- Table Provincias
CREATE TABLE Provincias (
    id_provincia int    NOT NULL  AUTO_INCREMENT,
    nombre varchar(100)    NOT NULL ,
    comunidad int    NOT NULL ,
    CONSTRAINT Provincias_pk PRIMARY KEY (id_provincia)
) ENGINE = InnoDB
;

-- Table Usuarios
CREATE TABLE Usuarios (
    id_usuario int    NOT NULL  AUTO_INCREMENT,
    email varchar(100)    NOT NULL ,
    nombre varchar(100)    NOT NULL ,
    password char(32)    NOT NULL ,
    admin bool    NOT NULL ,
    ciudad int    NOT NULL ,
    activo bool    NOT NULL ,
    CONSTRAINT Usuarios_pk PRIMARY KEY (id_usuario)
) ENGINE = InnoDB
;





-- foreign keys
-- Reference:  Anuncios_Categorias (table: Anuncios)


ALTER TABLE Anuncios ADD CONSTRAINT Anuncios_Categorias FOREIGN KEY (categoria)
REFERENCES Categorias (id_categoria)
ON UPDATE CASCADE;
-- Reference:  Anuncios_Ciudades (table: Anuncios)


ALTER TABLE Anuncios ADD CONSTRAINT Anuncios_Ciudades FOREIGN KEY (ciudad)
    REFERENCES Ciudades (id_ciudad)
    ON UPDATE CASCADE;
-- Reference:  Anuncios_Usuarios (table: Anuncios)


ALTER TABLE Anuncios ADD CONSTRAINT Anuncios_Usuarios FOREIGN KEY (usuario)
    REFERENCES Usuarios (id_usuario)
    ON UPDATE CASCADE;
-- Reference:  Ciudades_Provincias (table: Ciudades)


ALTER TABLE Ciudades ADD CONSTRAINT Ciudades_Provincias FOREIGN KEY (provincia)
    REFERENCES Provincias (id_provincia)
    ON UPDATE CASCADE;
-- Reference:  Denuncias_Anuncios (table: Denuncias)


ALTER TABLE Denuncias ADD CONSTRAINT Denuncias_Anuncios FOREIGN KEY (anuncio)
    REFERENCES Anuncios (id_anuncio)
    ON UPDATE CASCADE;
-- Reference:  Denuncias_Usuarios (table: Denuncias)


ALTER TABLE Denuncias ADD CONSTRAINT Denuncias_Usuarios FOREIGN KEY (denunciante)
    REFERENCES Usuarios (id_usuario)
    ON DELETE CASCADE ON UPDATE CASCADE;
-- Reference:  Provincias_Comunidades_Autonomas (table: Provincias)


ALTER TABLE Provincias ADD CONSTRAINT Provincias_Comunidades_Autonomas FOREIGN KEY (comunidad)
    REFERENCES Comunidades_Autonomas (id_comunidad)
    ON UPDATE CASCADE;
-- Reference:  Usuarios_Ciudades (table: Usuarios)


ALTER TABLE Usuarios ADD CONSTRAINT Usuarios_Ciudades FOREIGN KEY (ciudad)
    REFERENCES Ciudades (id_ciudad)
    ON UPDATE CASCADE;



-- End of file.