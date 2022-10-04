-- Database: AMERICAN_EXP

-- DROP DATABASE IF EXISTS "AMERICAN_EXP";

CREATE DATABASE "AMERICAN_EXP"
    WITH 
    OWNER = postgres
    ENCODING = 'UTF8'
    LC_COLLATE = 'Spanish_Guatemala.1252'
    LC_CTYPE = 'Spanish_Guatemala.1252'
    TABLESPACE = pg_default
    CONNECTION LIMIT = -1;


-- Table: public.usuario
CREATE TABLE IF NOT EXISTS public.usuario
(
    nombre character(50) COLLATE pg_catalog."default",
    usuario character(20) COLLATE pg_catalog."default" NOT NULL,
    "contraseña" character(15) COLLATE pg_catalog."default",
    id integer NOT NULL DEFAULT nextval('usuario_id_seq'::regclass),
    CONSTRAINT usuario_pkey PRIMARY KEY (usuario)
)

TABLESPACE pg_default;

ALTER TABLE IF EXISTS public.usuario
    OWNER to postgres;

-- Table: public.tienda

-- DROP TABLE IF EXISTS public.tienda;

CREATE TABLE IF NOT EXISTS public.tienda
(
    nombre character(20) COLLATE pg_catalog."default",
    id integer NOT NULL,
    CONSTRAINT tienda_pkey PRIMARY KEY (id)
)

TABLESPACE pg_default;

ALTER TABLE IF EXISTS public.tienda
    OWNER to postgres;

-- Table: public.empleado

-- DROP TABLE IF EXISTS public.empleado;

CREATE TABLE IF NOT EXISTS public.empleado
(
    nombre character(50) COLLATE pg_catalog."default",
    "contraseña" character(50) COLLATE pg_catalog."default",
    id integer NOT NULL,
    CONSTRAINT empleado_pkey PRIMARY KEY (id)
)

TABLESPACE pg_default;

ALTER TABLE IF EXISTS public.empleado
    OWNER to postgres;


-- Table: public.tarjeta

-- DROP TABLE IF EXISTS public.tarjeta;

CREATE TABLE IF NOT EXISTS public.tarjeta
(
    usuario character(50) COLLATE pg_catalog."default" NOT NULL,
    numero character(16) COLLATE pg_catalog."default" NOT NULL,
    num_seg character(3) COLLATE pg_catalog."default",
    vencimiento date,
    m_autorizado numeric(8,2),
    m_disponible numeric(8,2),
    CONSTRAINT tarjeta_pkey PRIMARY KEY (numero),
    CONSTRAINT tarjeta_num_seg_key UNIQUE (num_seg),
    CONSTRAINT tarjeta_usuario_fkey FOREIGN KEY (usuario)
        REFERENCES public.usuario (usuario) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
)

TABLESPACE pg_default;

ALTER TABLE IF EXISTS public.tarjeta
    OWNER to postgres;


-- Table: public.abono

-- DROP TABLE IF EXISTS public.abono;

CREATE TABLE IF NOT EXISTS public.abono
(
    id integer NOT NULL,
    empleado_id integer NOT NULL,
    numero_tarjeta character(16) COLLATE pg_catalog."default" NOT NULL,
    fecha timestamp without time zone,
    monto numeric(8,2),
    CONSTRAINT abono_pkey PRIMARY KEY (id, empleado_id, numero_tarjeta),
    CONSTRAINT abono_empleado_id_fkey FOREIGN KEY (empleado_id)
        REFERENCES public.empleado (id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION,
    CONSTRAINT abono_numero_tarjeta_fkey FOREIGN KEY (numero_tarjeta)
        REFERENCES public.tarjeta (numero) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
)

TABLESPACE pg_default;

ALTER TABLE IF EXISTS public.abono
    OWNER to postgres;


-- Table: public.consumo

-- DROP TABLE IF EXISTS public.consumo;

CREATE TABLE IF NOT EXISTS public.consumo
(
    autorizacion integer NOT NULL,
    tienda_id integer NOT NULL,
    numero_tarjeta character(16) COLLATE pg_catalog."default" NOT NULL,
    fecha timestamp without time zone,
    monto numeric(8,2),
    CONSTRAINT consumo_pkey PRIMARY KEY (autorizacion, tienda_id, numero_tarjeta),
    CONSTRAINT consumo_numero_tarjeta_fkey FOREIGN KEY (numero_tarjeta)
        REFERENCES public.tarjeta (numero) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION,
    CONSTRAINT consumo_tienda_id_fkey FOREIGN KEY (tienda_id)
        REFERENCES public.tienda (id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
)

TABLESPACE pg_default;

ALTER TABLE IF EXISTS public.consumo
    OWNER to postgres;



INSERT INTO public.empleado(
	nombre, "contraseña", id)
	VALUES ('Admin', 'Admin', 0);