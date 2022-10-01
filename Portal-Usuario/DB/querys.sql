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


---------------------TABLAS--------------------------------------------
-- Table: public.usuario

-- DROP TABLE IF EXISTS public.usuario;

CREATE TABLE IF NOT EXISTS public.usuario
(
    nombre character(50) COLLATE pg_catalog."default",
    usuario character(20) COLLATE pg_catalog."default" NOT NULL,
    "contraseña" character(15) COLLATE pg_catalog."default",
    CONSTRAINT usuario_pkey PRIMARY KEY (usuario)
);

DELETE FROM public.usuario
	WHERE <condition>;

INSERT INTO public.usuario(
	nombre, usuario, "contraseña")
	VALUES (?, ?, ?);

SELECT nombre, usuario, "contraseña"
	FROM public.usuario;

UPDATE public.usuario
	SET nombre=?, usuario=?, "contraseña"=?
	WHERE <condition>;


-- Table: public.tienda

-- DROP TABLE IF EXISTS public.tienda;

CREATE TABLE IF NOT EXISTS public.tienda
(
    nombre character(20) COLLATE pg_catalog."default",
    id integer NOT NULL,
    CONSTRAINT tienda_pkey PRIMARY KEY (id)
)

DELETE FROM public.tienda
	WHERE <condition>;

INSERT INTO public.tienda(
	nombre, id)
	VALUES (?, ?);

SELECT nombre, id
	FROM public.tienda;

UPDATE public.tienda
	SET nombre=?, id=?
	WHERE <condition>;



-- Table: public.empleado

-- DROP TABLE IF EXISTS public.empleado;

CREATE TABLE IF NOT EXISTS public.empleado
(
    nombre character(50) COLLATE pg_catalog."default",
    "contraseña" character(20) COLLATE pg_catalog."default",
    id integer NOT NULL,
    CONSTRAINT empleado_pkey PRIMARY KEY (id)
)

DELETE FROM public.empleado
	WHERE <condition>;

INSERT INTO public.empleado(
	nombre, "contraseña", id)
	VALUES (?, ?, ?);

SELECT nombre, "contraseña", id
	FROM public.empleado;

UPDATE public.empleado
	SET nombre=?, "contraseña"=?, id=?
	WHERE <condition>;

-- Table: public.tarjeta

-- DROP TABLE IF EXISTS public.tarjeta;

CREATE TABLE IF NOT EXISTS public.tarjeta
(
    usuario character(50) COLLATE pg_catalog."default" NOT NULL,
    numero character(15) COLLATE pg_catalog."default" NOT NULL,
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

DELETE FROM public.tarjeta
	WHERE <condition>;

INSERT INTO public.tarjeta(
	usuario, numero, num_seg, vencimiento, m_autorizado, m_disponible)
	VALUES (?, ?, ?, ?, ?, ?);

SELECT usuario, numero, num_seg, vencimiento, m_autorizado, m_disponible
	FROM public.tarjeta;

UPDATE public.tarjeta
	SET usuario=?, numero=?, num_seg=?, vencimiento=?, m_autorizado=?, m_disponible=?
	WHERE <condition>;


-- Table: public.consumo

-- DROP TABLE IF EXISTS public.consumo;

CREATE TABLE IF NOT EXISTS public.consumo
(
    autorizacion integer NOT NULL,
    tienda_id integer NOT NULL,
    numero_tarjeta character(16) COLLATE pg_catalog."default" NOT NULL,
    fecha date,
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

DELETE FROM public.consumo
	WHERE <condition>;

INSERT INTO public.consumo(
	autorizacion, tienda_id, numero_tarjeta, fecha, monto)
	VALUES (?, ?, ?, ?, ?);

SELECT autorizacion, tienda_id, numero_tarjeta, fecha, monto
	FROM public.consumo;

UPDATE public.consumo
	SET autorizacion=?, tienda_id=?, numero_tarjeta=?, fecha=?, monto=?
	WHERE <condition>;


-- Table: public.abono

-- DROP TABLE IF EXISTS public.abono;

CREATE TABLE IF NOT EXISTS public.abono
(
    id integer NOT NULL,
    empleado_id integer NOT NULL,
    numero_tarjeta character(16) COLLATE pg_catalog."default" NOT NULL,
    fecha date,
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

DELETE FROM public.abono
	WHERE <condition>;

INSERT INTO public.abono(
	id, empleado_id, numero_tarjeta, fecha, monto)
	VALUES (?, ?, ?, ?, ?);

SELECT id, empleado_id, numero_tarjeta, fecha, monto
	FROM public.abono;

UPDATE public.abono
	SET id=?, empleado_id=?, numero_tarjeta=?, fecha=?, monto=?
	WHERE <condition>;

