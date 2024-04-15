CREATE TABLE "A-M" (
    areas_areaid     VARCHAR(50) NOT NULL,
    meseros_meseroid VARCHAR(50) NOT NULL
);

COMMENT ON TABLE "A-M" IS
    'A-M';

ALTER TABLE "A-M" ADD CONSTRAINT "A-M_PK" PRIMARY KEY ( areas_areaid,
                                                        meseros_meseroid );

CREATE TABLE areas (
    areaid  VARCHAR(50) NOT NULL,
    nombre  VARCHAR(100) NOT NULL,
    fumar   CHAR(1) NOT NULL,
    nomesas INTEGER NOT NULL
);

COMMENT ON TABLE areas IS
    'Areas';

COMMENT ON COLUMN areas.areaid IS
    'Areas';

ALTER TABLE areas ADD CONSTRAINT areas_pk PRIMARY KEY ( areaid );

CREATE TABLE bebidas (
    bebidaid        VARCHAR(50) NOT NULL,
    bebida          VARCHAR(100) NOT NULL,
    preciounitario  INTEGER NOT NULL,
    descripcion     VARCHAR(100) NOT NULL,
    ordenes_ordenid VARCHAR(50) NOT NULL
);

COMMENT ON TABLE bebidas IS
    'Bebidas';

COMMENT ON COLUMN bebidas.bebidaid IS
    'Bebidas';

ALTER TABLE bebidas ADD CONSTRAINT bebidas_pk PRIMARY KEY ( bebidaid );

CREATE TABLE comidas (
    comidaid        VARCHAR(50) NOT NULL,
    comida          VARCHAR(100) NOT NULL,
    preciounitario  INTEGER NOT NULL,
    descripcion     VARCHAR(100) NOT NULL,
    ordenes_ordenid VARCHAR(50) NOT NULL
);

COMMENT ON TABLE comidas IS
    'Comidas';

COMMENT ON COLUMN comidas.comidaid IS
    'Comidas';

ALTER TABLE comidas ADD CONSTRAINT comidas_pk PRIMARY KEY ( comidaid );

CREATE TABLE encuestas (
    encuestaid VARCHAR(50) NOT NULL,
    nit        VARCHAR(60) NOT NULL,
    amabilidad INTEGER NOT NULL,
    servicio   INTEGER NOT NULL,
    fecha      DATE NOT NULL
);

COMMENT ON TABLE encuestas IS
    'Encuestas';

COMMENT ON COLUMN encuestas.encuestaid IS
    'Encuestas';

ALTER TABLE encuestas ADD CONSTRAINT encuestas_pk PRIMARY KEY ( encuestaid );

CREATE TABLE facturas (
    facturaid            VARCHAR(50) NOT NULL,
    ordenid              VARCHAR(50) NOT NULL,
    nit                  VARCHAR(60) NOT NULL,
    cliente              VARCHAR(150) NOT NULL,
    dirección            VARCHAR(150) NOT NULL,
    metodopago           VARCHAR(100) NOT NULL,
    propina              INTEGER NOT NULL,
    pagos_pagosid        VARCHAR(50) NOT NULL,
    encuestas_encuestaid VARCHAR(50) NOT NULL
);

COMMENT ON TABLE facturas IS
    'Facturas';

COMMENT ON COLUMN facturas.facturaid IS
    'Facturas';

CREATE UNIQUE INDEX facturas__idx ON
    facturas (
        encuestas_encuestaid
    ASC );

ALTER TABLE facturas ADD CONSTRAINT facturas_pk PRIMARY KEY ( facturaid );

CREATE TABLE mesas (
    mesaid       VARCHAR(50) NOT NULL,
    areaid       VARCHAR(50) NOT NULL,
    capacidad    INTEGER NOT NULL,
    mover        CHAR(1) NOT NULL,
    areas_areaid VARCHAR(50) NOT NULL
);

COMMENT ON TABLE mesas IS
    'Mesas';

COMMENT ON COLUMN mesas.mesaid IS
    'Mesas';

ALTER TABLE mesas ADD CONSTRAINT mesas_pk PRIMARY KEY ( mesaid );

CREATE TABLE meseros (
    meseroid VARCHAR(50) NOT NULL,
    nombre   VARCHAR(150) NOT NULL,
    areaid   VARCHAR(50) NOT NULL,
    salario  INTEGER NOT NULL
);

COMMENT ON TABLE meseros IS
    'Mesas';

COMMENT ON COLUMN meseros.meseroid IS
    'Meseros';

ALTER TABLE meseros ADD CONSTRAINT meseros_pk PRIMARY KEY ( meseroid );

CREATE TABLE ordenes (
    ordenid            VARCHAR(50) NOT NULL,
    meseroid           VARCHAR(50) NOT NULL,
    comidaid           VARCHAR(50),
    bebidaid           VARCHAR(50),
    unidad             INTEGER NOT NULL,
    estado             CHAR(1) NOT NULL,
    totalorden         INTEGER NOT NULL,
    meseros_meseroid   VARCHAR(50) NOT NULL,
    facturas_facturaid VARCHAR(50) NOT NULL
);

COMMENT ON TABLE ordenes IS
    'Ordenes';

COMMENT ON COLUMN ordenes.ordenid IS
    'Ordenes';

ALTER TABLE ordenes ADD CONSTRAINT ordenes_pk PRIMARY KEY ( ordenid );

CREATE TABLE pagos (
    pagosid    VARCHAR(50) NOT NULL,
    metodopago VARCHAR(100) NOT NULL
);

COMMENT ON TABLE pagos IS
    'Pagos';

COMMENT ON COLUMN pagos.pagosid IS
    'Pagos';

ALTER TABLE pagos ADD CONSTRAINT pagos_pk PRIMARY KEY ( pagosid );

CREATE TABLE quejas (
    quejaid          VARCHAR(50) NOT NULL,
    cliente          VARCHAR(100) NOT NULL,
    fecha            DATE NOT NULL,
    tipo             VARCHAR(50) NOT NULL,
    motivo           VARCHAR(50) NOT NULL,
    nombre           VARCHAR(150) NOT NULL,
    bebidaid         VARCHAR(50),
    comidaid         VARCHAR(50),
    meseros_meseroid VARCHAR(50) NOT NULL
);

COMMENT ON TABLE quejas IS
    'Quejas';

COMMENT ON COLUMN quejas.quejaid IS
    'Quejas';

ALTER TABLE quejas ADD CONSTRAINT quejas_pk PRIMARY KEY ( quejaid );

ALTER TABLE "A-M"
    ADD CONSTRAINT "A-M_Areas_FK" FOREIGN KEY ( areas_areaid )
        REFERENCES areas ( areaid );

ALTER TABLE "A-M"
    ADD CONSTRAINT "A-M_Meseros_FK" FOREIGN KEY ( meseros_meseroid )
        REFERENCES meseros ( meseroid );

ALTER TABLE bebidas
    ADD CONSTRAINT bebidas_ordenes_fk FOREIGN KEY ( ordenes_ordenid )
        REFERENCES ordenes ( ordenid );

ALTER TABLE comidas
    ADD CONSTRAINT comidas_ordenes_fk FOREIGN KEY ( ordenes_ordenid )
        REFERENCES ordenes ( ordenid );

ALTER TABLE facturas
    ADD CONSTRAINT facturas_encuestas_fk FOREIGN KEY ( encuestas_encuestaid )
        REFERENCES encuestas ( encuestaid );

ALTER TABLE facturas
    ADD CONSTRAINT facturas_pagos_fk FOREIGN KEY ( pagos_pagosid )
        REFERENCES pagos ( pagosid );

ALTER TABLE mesas
    ADD CONSTRAINT mesas_areas_fk FOREIGN KEY ( areas_areaid )
        REFERENCES areas ( areaid );

ALTER TABLE ordenes
    ADD CONSTRAINT ordenes_facturas_fk FOREIGN KEY ( facturas_facturaid )
        REFERENCES facturas ( facturaid );

ALTER TABLE ordenes
    ADD CONSTRAINT ordenes_meseros_fk FOREIGN KEY ( meseros_meseroid )
        REFERENCES meseros ( meseroid );

ALTER TABLE quejas
    ADD CONSTRAINT quejas_meseros_fk FOREIGN KEY ( meseros_meseroid )
        REFERENCES meseros ( meseroid );