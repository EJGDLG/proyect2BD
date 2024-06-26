CREATE TABLE A-M (
    areas_areaid VARCHAR(50) NOT NULL,
    meseros_meseroid VARCHAR(50) NOT NULL
);

CREATE TABLE areas (
    areaid VARCHAR(50) NOT NULL,
    nombre VARCHAR(100) NOT NULL,
    fumar CHAR(1) NOT NULL,
    nomesas INT NOT NULL
);

CREATE TABLE bebidas (
    bebidaid VARCHAR(50) NOT NULL,
    bebida VARCHAR(100) NOT NULL,
    preciounitario INT NOT NULL,
    descripcion VARCHAR(100) NOT NULL,
    ordenes_ordenid VARCHAR(50) NOT NULL
);

CREATE TABLE comidas (
    comidaid VARCHAR(50) NOT NULL,
    comida VARCHAR(100) NOT NULL,
    preciounitario INT NOT NULL,
    descripcion VARCHAR(100) NOT NULL,
    ordenes_ordenid VARCHAR(50) NOT NULL
);

CREATE TABLE encuestas (
    encuestaid VARCHAR(50) NOT NULL,
    nit VARCHAR(60) NOT NULL,
    amabilidad INT NOT NULL,
    servicio INT NOT NULL,
    fecha DATE NOT NULL
);

CREATE TABLE facturas (
    facturaid VARCHAR(50) NOT NULL,
    ordenid VARCHAR(50) NOT NULL,
    nit VARCHAR(60) NOT NULL,
    cliente VARCHAR(150) NOT NULL,
    dirección VARCHAR(150) NOT NULL,
    metodopago VARCHAR(100) NOT NULL,
    propina INT NOT NULL,
    pagos_pagosid VARCHAR(50) NOT NULL,
    encuestas_encuestaid VARCHAR(50) NOT NULL
);

CREATE TABLE mesas (
    mesaid VARCHAR(50) NOT NULL,
    areaid VARCHAR(50) NOT NULL,
    capacidad INT NOT NULL,
    mover CHAR(1) NOT NULL,
    areas_areaid VARCHAR(50) NOT NULL
);

CREATE TABLE meseros (
    meseroid VARCHAR(50) NOT NULL,
    nombre VARCHAR(150) NOT NULL,
    areaid VARCHAR(50) NOT NULL,
    salario INT NOT NULL
);

CREATE TABLE ordenes (
    ordenid VARCHAR(50) NOT NULL,
    meseroid VARCHAR(50) NOT NULL,
    comidaid VARCHAR(50),
    bebidaid VARCHAR(50),
    unidad INT NOT NULL,
    estado CHAR(1) NOT NULL,
    totalorden INT NOT NULL,
    meseros_meseroid VARCHAR(50) NOT NULL,
    facturas_facturaid VARCHAR(50) NOT NULL
);

CREATE TABLE pagos (
    pagosid VARCHAR(50) NOT NULL,
    metodopago VARCHAR(100) NOT NULL
);

CREATE TABLE quejas (
    quejaid VARCHAR(50) NOT NULL,
    cliente VARCHAR(100) NOT NULL,
    fecha DATE NOT NULL,
    tipo VARCHAR(50) NOT NULL,
    motivo VARCHAR(50) NOT NULL,
    nombre VARCHAR(150) NOT NULL,
    bebidaid VARCHAR(50),
    comidaid VARCHAR(50),
    meseros_meseroid VARCHAR(50) NOT NULL
);

ALTER TABLE A-M
    ADD CONSTRAINT A-M_Areas_FK FOREIGN KEY (areas_areaid)
        REFERENCES areas (areaid),
    ADD CONSTRAINT A-M_Meseros_FK FOREIGN KEY (meseros_meseroid)
        REFERENCES meseros (meseroid);