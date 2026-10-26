CREATE DATABASE IF NOT EXISTS `Vacantes` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `vacantes`;

CREATE TABLE IF NOT EXISTS Rol (
    id_rol INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    descripcion VARCHAR(100) NOT NULL UNIQUE
);

CREATE TABLE IF NOT EXISTS Usuario (
    id_usuario INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NULL,
    paterno VARCHAR(100) NULL,
    materno VARCHAR(100) NULL,
    usuario VARCHAR(100) NOT NULL UNIQUE,
    contrasenia VARCHAR(255) NOT NULL,
    id_rol INT UNSIGNED NOT NULL,
    CONSTRAINT fk_usuario_rol
        FOREIGN KEY (id_rol)
        REFERENCES Rol(id_rol)
        ON UPDATE CASCADE
        ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS Folio (
    id_folio INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    folio INT UNSIGNED NOT NULL UNIQUE,
    qna_captura INT UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS TipoLayout (
    id_tipo_layout INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    descripcion VARCHAR(100) NOT NULL UNIQUE,
    datos_requeridos JSON NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS FirmasLayout (
    id_firma_layout INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    firmas_x_layout VARCHAR(100) NOT NULL,
    id_tipo_layout INT UNSIGNED NOT NULL,
    CONSTRAINT fk_FirmasLayout_TipoLayout
        FOREIGN KEY (id_tipo_layout)
        REFERENCES TipoLayout(id_tipo_layout)
        ON UPDATE CASCADE
        ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS Firma (
    id_firma INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nombre_encargado VARCHAR(100) NOT NULL,
    archivo_firma BLOB NOT NULL,
    qna_ini INT UNSIGNED NOT NULL,
    qna_fin INT UNSIGNED NOT NULL,
    firma_layout INT UNSIGNED NOT NULL,
    CONSTRAINT fk_Firma_FirmasLayout
        FOREIGN KEY (firma_layout)
        REFERENCES FirmasLayout(id_firma_layout)
        ON UPDATE CASCADE
        ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS cat_proceso (
    id_proceso INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    proceso VARCHAR(100) NOT NULL UNIQUE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS cat_tipo_apreciacion (
    id_tipo_apreciacion INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    tipo_apreciacion VARCHAR(255) NOT NULL,
    proceso INT UNSIGNED NOT NULL,
    CONSTRAINT fk_tipo_apreciacion_proceso
        FOREIGN KEY (proceso)
        REFERENCES cat_proceso(id_proceso)
        ON UPDATE CASCADE
        ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS cat_zona_economica (
    id_zona_economica INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    zona_economica VARCHAR(100) NOT NULL UNIQUE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS cat_tipo_vacante (
    id_tipo_vacante INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    tipo_vacante VARCHAR(100) NOT NULL UNIQUE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS cat_tipo_plaza (
    id_tipo_plaza INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    tipo_plaza VARCHAR(100) NOT NULL UNIQUE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS cat_tipo_sostenimiento (
    id_tipo_sostenimiento INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    tipo_sostenimiento VARCHAR(100) NOT NULL UNIQUE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS cat_turno (
    id_turno INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    turno VARCHAR(100) NOT NULL UNIQUE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS cat_tipo_licencia (
    id_tipo_licencia INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    codigo_licencia VARCHAR(10) NOT NULL UNIQUE,
    tipo_licencia VARCHAR(100) NOT NULL UNIQUE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS EstadoVacante (
    id_estado_vacante INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    descripcion VARCHAR(100) NOT NULL UNIQUE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS EstadoValidacion (
    id_estado_validacion INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    descripcion VARCHAR(100) NOT NULL UNIQUE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS Vacante (
    id_vacante INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT UNSIGNED NOT NULL,
    folio INT UNSIGNED NOT NULL,
    tipo_layout INT UNSIGNED NOT NULL,
    fecha_captura DATE NOT NULL,
    estado_vacante INT UNSIGNED NOT NULL,
    entidad VARCHAR(100) NOT NULL,
    municipio VARCHAR(100) NULL,
    institucion VARCHAR(100) NULL,
    region VARCHAR(100) NULL,
    zona_economica INT UNSIGNED NOT NULL,
    proceso INT UNSIGNED NOT NULL,
    tipo_apreciacion INT UNSIGNED NOT NULL,
    tipo_vacante INT UNSIGNED NOT NULL,
    tipo_plaza INT UNSIGNED NOT NULL,
    numero_horas INT UNSIGNED NULL,
    tipo_sostenimiento INT UNSIGNED NOT NULL,
    fecha_inicio_vacancia DATE NOT NULL,
    fecha_fin_vacancia DATE NULL,
    clv_categoria VARCHAR(100) NOT NULL,
    paquete_plaza VARCHAR(100) NULL,
    clave_plaza VARCHAR(100) NULL,
    cctPlazaDondeCobra VARCHAR(100) NULL,
    cctPlazaDondeTrabaja VARCHAR(100) NULL,
    turno INT UNSIGNED NOT NULL,
    tipo_licencia INT UNSIGNED NULL,
    tipo_licencia_2 INT UNSIGNED NULL,
    codigo_licencia VARCHAR(10) NULL,
    inicio_de_licencia DATE NULL,
    observaciones VARCHAR(255) NULL,
    inicio_ocupacion DATE NULL,
    fin_ocupacion DATE NULL,
    ordenamiento VARCHAR(100) NULL,
    curp VARCHAR(18) NULL,
    nombre_docente VARCHAR(100) NULL,
    codigo VARCHAR(100) NULL,

    CONSTRAINT fk_vacante_usuario
        FOREIGN KEY (id_usuario)
        REFERENCES Usuario(id_usuario),
    CONSTRAINT fk_vacante_folio
        FOREIGN KEY (folio)
        REFERENCES Folio(id_folio),
    CONSTRAINT fk_vacante_tipo_layout
        FOREIGN KEY (tipo_layout)
        REFERENCES TipoLayout(id_tipo_layout),
    CONSTRAINT fk_vacante_estado
        FOREIGN KEY (estado_vacante)
        REFERENCES EstadoVacante(id_estado_vacante),
    CONSTRAINT fk_vacante_zona_economica
        FOREIGN KEY (zona_economica)
        REFERENCES cat_zona_economica(id_zona_economica),
    CONSTRAINT fk_vacante_proceso
        FOREIGN KEY (proceso)
        REFERENCES cat_proceso(id_proceso),
    CONSTRAINT fk_vacante_tipo_apreciacion
        FOREIGN KEY (tipo_apreciacion)
        REFERENCES cat_tipo_apreciacion(id_tipo_apreciacion),
    CONSTRAINT fk_vacante_tipo_vacante
        FOREIGN KEY (tipo_vacante)
        REFERENCES cat_tipo_vacante(id_tipo_vacante),
    CONSTRAINT fk_vacante_tipo_plaza
        FOREIGN KEY (tipo_plaza)
        REFERENCES cat_tipo_plaza(id_tipo_plaza),
    CONSTRAINT fk_vacante_tipo_sostenimiento
        FOREIGN KEY (tipo_sostenimiento)
        REFERENCES cat_tipo_sostenimiento(id_tipo_sostenimiento),
    CONSTRAINT fk_vacante_turno
        FOREIGN KEY (turno)
        REFERENCES cat_turno(id_turno),
    CONSTRAINT fk_vacante_tipo_licencia
        FOREIGN KEY (tipo_licencia)
        REFERENCES cat_tipo_licencia(id_tipo_licencia)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS Validacion (
    id_validacion INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    id_vacante INT UNSIGNED NOT NULL,
    id_usuario INT UNSIGNED NOT NULL,
    fecha_validacion DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    estado_vacante INT UNSIGNED NOT NULL,
    estado_validacion INT UNSIGNED NOT NULL,

    CONSTRAINT fk_validacion_vacante
        FOREIGN KEY (id_vacante)
        REFERENCES Vacante(id_vacante),
    CONSTRAINT fk_validacion_usuario
        FOREIGN KEY (id_usuario)
        REFERENCES Usuario(id_usuario),
    CONSTRAINT fk_validacion_estado_vacante
        FOREIGN KEY (estado_vacante)
        REFERENCES EstadoVacante(id_estado_vacante),
    CONSTRAINT fk_validacion_estado_validacion
        FOREIGN KEY (estado_validacion)
        REFERENCES EstadoValidacion(id_estado_validacion)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS Rechazo (
    id_rechazo INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    id_validacion INT UNSIGNED NOT NULL,
    motivo TEXT NOT NULL,
    
    CONSTRAINT fk_rechazo_validacion
        FOREIGN KEY (id_validacion)
        REFERENCES Validacion(id_validacion)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;