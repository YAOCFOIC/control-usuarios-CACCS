CREATE TABLE empleados (
    id SERIAL PRIMARY KEY,
    nombre VARCHAR(100),
    apellido VARCHAR(100),
    documento_identidad VARCHAR(50) UNIQUE,
    fecha_ingreso DATE,
    salario NUMERIC(10,2),
    fecha_nacimiento DATE,
    estado BOOLEAN DEFAULT true
);

-- Tabla roles
CREATE TABLE roles (
    id SERIAL PRIMARY KEY,
    nombre_rol VARCHAR(100) UNIQUE
);

-- Tabla nomina
CREATE TABLE nomina (
    id SERIAL PRIMARY KEY,
    empleado_id INTEGER REFERENCES empleados(id),
    salario NUMERIC(10,2),
    fecha_pago DATE,
    tipo_pago VARCHAR(20),
    estado_pago VARCHAR(20) DEFAULT 'Pendiente'
);

-- Tabla intermedia empleado_roles
CREATE TABLE empleado_roles (
    id SERIAL PRIMARY KEY,
    empleado_id INTEGER REFERENCES empleados(id),
    rol_id INTEGER REFERENCES roles(id),
    fecha_asignacion DATE
);



-- Tabla users
CREATE TABLE users (
 id SERIAL PRIMARY KEY,
    username VARCHAR(30),
    password VARCHAR(255) 
);
