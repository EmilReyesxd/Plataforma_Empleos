CREATE DATABASE plataforma_empleos;
USE plataforma_empleos;

CREATE TABLE candidatos (
  id_candidato INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(100),
  apellido VARCHAR(100),
  correo VARCHAR(150) UNIQUE,
  contraseña VARCHAR(255),
  telefono VARCHAR(20),
  direccion VARCHAR(255),
  ciudad VARCHAR(100),
  foto VARCHAR(255),
  cv_pdf VARCHAR(255)
);
CREATE TABLE curriculum (
  id_curriculum INT AUTO_INCREMENT PRIMARY KEY,
  id_candidato INT,
  objetivo_profesional TEXT,
  disponibilidad VARCHAR(50),
  FOREIGN KEY (id_candidato) REFERENCES candidatos(id_candidato)
);
CREATE TABLE formaciones (
  id_formacion INT AUTO_INCREMENT PRIMARY KEY,
  id_curriculum INT,
  institucion VARCHAR(255),
  titulo VARCHAR(255),
  fecha_inicio DATE,
  fecha_fin DATE,
  FOREIGN KEY (id_curriculum) REFERENCES curriculum(id_curriculum)
);
CREATE TABLE experiencias (
  id_experiencia INT AUTO_INCREMENT PRIMARY KEY,
  id_curriculum INT,
  empresa VARCHAR(255),
  puesto VARCHAR(255),
  fecha_inicio DATE,
  fecha_fin DATE,
  FOREIGN KEY (id_curriculum) REFERENCES curriculum(id_curriculum)
);
CREATE TABLE habilidades (
  id_habilidad INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(100)
);
CREATE TABLE curriculum_habilidad (
  id_curriculum INT,
  id_habilidad INT,
  PRIMARY KEY (id_curriculum, id_habilidad),
  FOREIGN KEY (id_curriculum) REFERENCES curriculum(id_curriculum),
  FOREIGN KEY (id_habilidad) REFERENCES habilidades(id_habilidad)
);
CREATE TABLE idiomas (
  id_idioma INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(100)
);
CREATE TABLE curriculum_idioma (
  id_curriculum INT,
  id_idioma INT,
  PRIMARY KEY (id_curriculum, id_idioma),
  FOREIGN KEY (id_curriculum) REFERENCES curriculum(id_curriculum),
  FOREIGN KEY (id_idioma) REFERENCES idiomas(id_idioma)
);
CREATE TABLE referencias (
  id_referencia INT AUTO_INCREMENT PRIMARY KEY,
  id_curriculum INT,
  nombre VARCHAR(100),
  descripcion TEXT,
  FOREIGN KEY (id_curriculum) REFERENCES curriculum(id_curriculum)
);
CREATE TABLE redes (
  id_red INT AUTO_INCREMENT PRIMARY KEY,
  id_curriculum INT,
  tipo VARCHAR(50),
  url VARCHAR(255),
  FOREIGN KEY (id_curriculum) REFERENCES curriculum(id_curriculum)
);
CREATE TABLE empresas (
  id_empresa INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(150),
  correo VARCHAR(150) UNIQUE,
  contraseña VARCHAR(255),
  direccion VARCHAR(255)
);
CREATE TABLE ofertas (
  id_oferta INT AUTO_INCREMENT PRIMARY KEY,
  id_empresa INT,
  titulo VARCHAR(255),
  descripcion TEXT,
  requisitos TEXT,
  FOREIGN KEY (id_empresa) REFERENCES empresas(id_empresa)
);
CREATE TABLE aplicaciones (
  id_aplicacion INT AUTO_INCREMENT PRIMARY KEY,
  id_oferta INT,
  id_candidato INT,
  fecha_aplicacion DATETIME DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (id_oferta) REFERENCES ofertas(id_oferta),
  FOREIGN KEY (id_candidato) REFERENCES candidatos(id_candidato)
);
