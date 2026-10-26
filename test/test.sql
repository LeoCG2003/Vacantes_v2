USE test;

CREATE TABLE tipo_layout (
    id_tipo_layout INT UNSIGNED AUTO_INCREMENT,
    descripcion VARCHAR(100) NOT NULL,

    PRIMARY KEY (id_tipo_layout)
);

INSERT INTO tipo_layout(descripcion)
VALUES
    ("Vertical"),
    ("Admision"),
    ("Vacancia Horas"),
    ("Asignacion Horas");


-- Primero crear PROCESO
CREATE TABLE proceso (
    id_proceso INT UNSIGNED AUTO_INCREMENT,
    proceso VARCHAR(100) NOT NULL,

    PRIMARY KEY (id_proceso)
);

INSERT INTO proceso(proceso)
VALUES
    ("Vertical"),
    ("Admision"),
    ("Horas");


-- Después crear TIPO_APRECIACION
CREATE TABLE tipo_apreciacion (
    id_tipo_apreciacion INT UNSIGNED AUTO_INCREMENT,
    apreciacion VARCHAR(100) NOT NULL,
    proceso INT UNSIGNED,

    PRIMARY KEY (id_tipo_apreciacion),

    FOREIGN KEY (proceso)
        REFERENCES proceso(id_proceso)
);


INSERT INTO tipo_apreciacion(apreciacion, proceso)
VALUES
    ("Vertical 1", 1),
    ("Admision 1", 2),
    ("Vacancia 1", 3),
    ("Vertical 2", 1),
    ("Admision 2", 2),
    ("Vacancia 2", 3),
    ("Vertical 3", 1),
    ("Admision 3", 2),
    ("Vacancia 3", 3);


CREATE TABLE turno (
    id_turno INT UNSIGNED AUTO_INCREMENT,
    turno VARCHAR(100) NOT NULL,

    PRIMARY KEY (id_turno)
);

INSERT INTO turno(turno)
VALUES
    ("Matutino"),
    ("Vespertino"),
    ("Nocturno");

USE test;

CREATE TABLE tipo_layout (
    id_tipo_layout INT UNSIGNED AUTO_INCREMENT,
    descripcion VARCHAR(100) NOT NULL,

    PRIMARY KEY (id_tipo_layout)
);

INSERT INTO tipo_layout(descripcion)
VALUES
    ("Vertical"),
    ("Admision"),
    ("Vacancia Horas"),
    ("Asignacion Horas");