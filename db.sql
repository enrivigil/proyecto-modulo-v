create table roles(
    id int primary key auto_increment,
    nombre varchar(50)
);

create table areas(
    id int primary key auto_increment,
    nombre varchar(50)
);

create table empleados(
    id int primary key auto_increment,
    nombre varchar(50),
    apellido varchar(50),
    profesion varchar(50),
    activo bit,
    rol_id int,
    area_id int,
    foreign key(rol_id) references roles(id),
    foreign key(area_id) references areas(id)
);

create table usuarios(
    id int primary key auto_increment,
    nom_usuario varchar(50),
    contrasenia varchar(255),
    activo bit,
    empleado_id int,
    foreign key(empleado_id) references empleados(id)
);

/* capacitaciones */

create table capacitaciones(
    id int primary key auto_increment,
    nombre varchar(50),
    descripcion varchar(255),
    institucion varchar(50),
    modalidad enum('Presencial', 'Semipresencial', 'Virtual'),
    fecha_inicio date,
    fecha_final date,
    cantidad_horas int,
    estado enum('En espera', 'En curso', 'Finalizado', 'Suspendido'),
    area_id int,
    foreign key(area_id) references areas(id)
);

create table patrocinadores(
    id int primary key auto_increment,
    institucion varchar(50),
    descripcion varchar(255),
    capacitacion_id int,
    foreign key(capacitacion_id) references capacitaciones(id)
);

create table inscripciones(
    id int primary key auto_increment,
    estado enum('Cursando', 'Finalizado', 'Retirado'),
    empleado_id int,
    capacitacion_id int,
    foreign key(empleado_id) references empleados(id),
    foreign key(capacitacion_id) references capacitaciones(id)
);

create table sesiones(
    id int primary key auto_increment,
    nombre varchar(50),
    fecha_hora_inicio datetime,
    fecha_hora_final datetime,
    activo bit,
    capacitacion_id int,
    foreign key(capacitacion_id) references capacitaciones(id)
);

create table asistencias(
    id int primary key auto_increment,
    estado enum('Presente', 'Permiso', 'Falta'),
    empleado_id int,
    sesion_id int,
    foreign key(empleado_id) references empleados(id),
    foreign key(sesion_id) references sesiones(id)
);

/* misiones */

create table misiones(
    id int primary key auto_increment,
    nombre varchar(50),
    descripcion varchar(255),
    estimacion varchar(255),
    institucion varchar(50),
    fecha_hora_inicio datetime,
    fecha_hora_final datetime,
    area_id int,
    foreign key(area_id) references areas(id)
);

create table participantes(
    id int primary key auto_increment,
    estado enum('Oyente', 'Ponente'),
    empleado_id int,
    mision_id int,
    foreign key(empleado_id) references empleados(id),
    foreign key(mision_id) references misiones(id)
);

create table comentarios(
    id int primary key auto_increment,
    texto varchar(255),
    empleado_id int,
    mision_id int,
    foreign key(empleado_id) references empleados(id),
    foreign key(mision_id) references misiones(id)
);

/* archivos de capacitaciones y misiones */

create table archivos_cap(
    id int primary key auto_increment,
    url varchar(255),
    empleado_id int,
    capacitacion_id int,
    foreign key(empleado_id) references empleados(id),
    foreign key(capacitacion_id) references capacitaciones(id)
);

create table archivos_mis(
    id int primary key auto_increment,
    url varchar(255),
    empleado_id int,
    mision_id int,
    foreign key(empleado_id) references empleados(id),
    foreign key(mision_id) references misiones(id)
);

/* datos */

insert into roles(nombre) values ('Administrador');
insert into roles(nombre) values ('Jefe de area');
insert into roles(nombre) values ('Empleado');

insert into areas(nombre) values ('Gerencia');
insert into areas(nombre) values ('Recursos humanos');
insert into areas(nombre) values ('TI');
insert into areas(nombre) values ('Marketing');

insert into empleados(nombre, apellido, profesion, activo, rol_id, area_id) values ('John', 'Smit', 'Lic. en gerencia', 1, 1, 1);
insert into empleados(nombre, apellido, profesion, activo, rol_id, area_id) values ('Mark', 'Johnson', 'Ing. en sistemas', 1, 2, 3);
insert into empleados(nombre, apellido, profesion, activo, rol_id, area_id) values ('Mary', 'Carter', 'Ing. en sistemas', 1, 3, 3);
insert into empleados(nombre, apellido, profesion, activo, rol_id, area_id) values ('Elena', 'Wilson', 'Ing. en sistemas', 1, 3, 3);
insert into empleados(nombre, apellido, profesion, activo, rol_id, area_id) values ('Mateo', 'Dalh', 'Ing. en computacion', 1, 3, 3);
insert into empleados(nombre, apellido, profesion, activo, rol_id, area_id) values ('Wendy', 'Taylor', 'Lic. en mercadeo', 1, 2, 4);
insert into empleados(nombre, apellido, profesion, activo, rol_id, area_id) values ('Pablo', 'Bocelli', 'Tec. en diseño grafico', 1, 3, 4);
insert into empleados(nombre, apellido, profesion, activo, rol_id, area_id) values ('Hernan', 'Cortez', 'Tec. en diseño grafico', 1, 3, 4);

-- contrasenia 'helloworld' para todos
insert into usuarios(nom_usuario, contrasenia, activo, empleado_id) values ('John', '$2y$10$pF/jL4v0cc2OyfXjQBiPeOdWWOgF.ksgUF/sd21G.JZi0YI.Rs27y', 1, 1);
insert into usuarios(nom_usuario, contrasenia, activo, empleado_id) values ('Mark', '$2y$10$pF/jL4v0cc2OyfXjQBiPeOdWWOgF.ksgUF/sd21G.JZi0YI.Rs27y', 1, 2);
insert into usuarios(nom_usuario, contrasenia, activo, empleado_id) values ('Mary', '$2y$10$pF/jL4v0cc2OyfXjQBiPeOdWWOgF.ksgUF/sd21G.JZi0YI.Rs27y', 1, 3);
insert into usuarios(nom_usuario, contrasenia, activo, empleado_id) values ('Elena', '$2y$10$pF/jL4v0cc2OyfXjQBiPeOdWWOgF.ksgUF/sd21G.JZi0YI.Rs27y', 1, 4);
insert into usuarios(nom_usuario, contrasenia, activo, empleado_id) values ('Mateo', '$2y$10$pF/jL4v0cc2OyfXjQBiPeOdWWOgF.ksgUF/sd21G.JZi0YI.Rs27y', 1, 5);
insert into usuarios(nom_usuario, contrasenia, activo, empleado_id) values ('Wendy', '$2y$10$pF/jL4v0cc2OyfXjQBiPeOdWWOgF.ksgUF/sd21G.JZi0YI.Rs27y', 1, 6);
insert into usuarios(nom_usuario, contrasenia, activo, empleado_id) values ('Pablo', '$2y$10$pF/jL4v0cc2OyfXjQBiPeOdWWOgF.ksgUF/sd21G.JZi0YI.Rs27y', 1, 7);
insert into usuarios(nom_usuario, contrasenia, activo, empleado_id) values ('Hernan', '$2y$10$pF/jL4v0cc2OyfXjQBiPeOdWWOgF.ksgUF/sd21G.JZi0YI.Rs27y', 1, 8);

/* capacitaciones */

-- capacitacion de enero del area de TI
insert into capacitaciones(nombre, descripcion, institucion, modalidad, fecha_inicio, fecha_final, cantidad_horas, estado, area_id) values ('Cloud computing', 'Hello world', 'UNIVO', 'Presencial', '2022-01-01', '2022-01-30', 20, 'Finalizado', 3);

insert into patrocinadores(institucion, descripcion, capacitacion_id) values ('UNIVO', 'Financia el 50%', 1);
insert into patrocinadores(institucion, descripcion, capacitacion_id) values ('USAID', 'Financia el 50%', 1);

insert into inscripciones(estado, empleado_id, capacitacion_id) values ('Finalizado', 3, 1);
insert into inscripciones(estado, empleado_id, capacitacion_id) values ('Finalizado', 4, 1);
insert into inscripciones(estado, empleado_id, capacitacion_id) values ('Finalizado', 5, 1);

insert into sesiones(nombre, fecha_hora_inicio, fecha_hora_final, activo, capacitacion_id) values ('Sesion #1', '2022-01-07 07:00', '2022-01-07 12:00', 0, 1);
insert into sesiones(nombre, fecha_hora_inicio, fecha_hora_final, activo, capacitacion_id) values ('Sesion #2', '2022-01-14 07:00', '2022-01-14 12:00', 0, 1);
insert into sesiones(nombre, fecha_hora_inicio, fecha_hora_final, activo, capacitacion_id) values ('Sesion #3', '2022-01-21 07:00', '2022-01-21 12:00', 0, 1);
insert into sesiones(nombre, fecha_hora_inicio, fecha_hora_final, activo, capacitacion_id) values ('Sesion #4', '2022-01-28 07:00', '2022-01-28 12:00', 0, 1);

insert into asistencias(estado, empleado_id, sesion_id) values ('Presente', 3, 1);
insert into asistencias(estado, empleado_id, sesion_id) values ('Presente', 4, 1);
insert into asistencias(estado, empleado_id, sesion_id) values ('Presente', 5, 1);

insert into asistencias(estado, empleado_id, sesion_id) values ('Presente', 3, 2);
insert into asistencias(estado, empleado_id, sesion_id) values ('Presente', 4, 2);
insert into asistencias(estado, empleado_id, sesion_id) values ('Presente', 5, 2);

insert into asistencias(estado, empleado_id, sesion_id) values ('Presente', 3, 3);
insert into asistencias(estado, empleado_id, sesion_id) values ('Presente', 4, 3);
insert into asistencias(estado, empleado_id, sesion_id) values ('Permiso', 5, 3);

insert into asistencias(estado, empleado_id, sesion_id) values ('Presente', 3, 4);
insert into asistencias(estado, empleado_id, sesion_id) values ('Presente', 4, 4);
insert into asistencias(estado, empleado_id, sesion_id) values ('Presente', 5, 4);

-- capacitacion de mayo del area de TI
insert into capacitaciones(nombre, descripcion, institucion, modalidad, fecha_inicio, fecha_final, cantidad_horas, estado, area_id) values ('Azure fundamentals', 'Hello world', 'UNIVO', 'Presencial', '2022-05-01', '2022-05-30', 20, 'Finalizado', 3);

insert into patrocinadores(institucion, descripcion, capacitacion_id) values ('UNIVO', 'Financia el 20%', 2);
insert into patrocinadores(institucion, descripcion, capacitacion_id) values ('USAID', 'Financia el 40%', 2);
insert into patrocinadores(institucion, descripcion, capacitacion_id) values ('MICROSOFT', 'Financia el 40%', 2);

insert into inscripciones(estado, empleado_id, capacitacion_id) values ('Finalizado', 3, 2);
insert into inscripciones(estado, empleado_id, capacitacion_id) values ('Finalizado', 4, 2);
insert into inscripciones(estado, empleado_id, capacitacion_id) values ('Finalizado', 5, 2);

insert into sesiones(nombre, fecha_hora_inicio, fecha_hora_final, activo, capacitacion_id) values ('Sesion #1', '2022-05-07 07:00', '2022-05-07 12:00', 0, 2);
insert into sesiones(nombre, fecha_hora_inicio, fecha_hora_final, activo, capacitacion_id) values ('Sesion #2', '2022-05-14 07:00', '2022-05-14 12:00', 0, 2);
insert into sesiones(nombre, fecha_hora_inicio, fecha_hora_final, activo, capacitacion_id) values ('Sesion #3', '2022-05-21 07:00', '2022-05-21 12:00', 0, 2);
insert into sesiones(nombre, fecha_hora_inicio, fecha_hora_final, activo, capacitacion_id) values ('Sesion #4', '2022-05-28 07:00', '2022-05-28 12:00', 0, 2);

insert into asistencias(estado, empleado_id, sesion_id) values ('Presente', 3, 5);
insert into asistencias(estado, empleado_id, sesion_id) values ('Presente', 4, 5);
insert into asistencias(estado, empleado_id, sesion_id) values ('Presente', 5, 5);

insert into asistencias(estado, empleado_id, sesion_id) values ('Presente', 3, 6);
insert into asistencias(estado, empleado_id, sesion_id) values ('Presente', 4, 6);
insert into asistencias(estado, empleado_id, sesion_id) values ('Presente', 5, 6);

insert into asistencias(estado, empleado_id, sesion_id) values ('Presente', 3, 7);
insert into asistencias(estado, empleado_id, sesion_id) values ('Presente', 4, 7);
insert into asistencias(estado, empleado_id, sesion_id) values ('Presente', 5, 7);

insert into asistencias(estado, empleado_id, sesion_id) values ('Presente', 3, 8);
insert into asistencias(estado, empleado_id, sesion_id) values ('Presente', 4, 8);
insert into asistencias(estado, empleado_id, sesion_id) values ('Presente', 5, 8);

-- capacitacion de julio del area de TI
insert into capacitaciones(nombre, descripcion, institucion, modalidad, fecha_inicio, fecha_final, cantidad_horas, estado, area_id) values ('CI/CD', 'Hello world', 'UNIVO', 'Presencial', '2022-07-15', '2022-07-30', 10, 'Finalizado', 3);

insert into patrocinadores(institucion, descripcion, capacitacion_id) values ('UNIVO', 'Financia el 100%', 3);

insert into inscripciones(estado, empleado_id, capacitacion_id) values ('Finalizado', 3, 3);
insert into inscripciones(estado, empleado_id, capacitacion_id) values ('Retirado', 4, 3);

insert into sesiones(nombre, fecha_hora_inicio, fecha_hora_final, activo, capacitacion_id) values ('Sesion #1', '2022-07-21 07:00', '2022-07-21 12:00', 0, 3);
insert into sesiones(nombre, fecha_hora_inicio, fecha_hora_final, activo, capacitacion_id) values ('Sesion #2', '2022-07-28 07:00', '2022-07-28 12:00', 0, 3);

insert into asistencias(estado, empleado_id, sesion_id) values ('Presente', 3, 9);
insert into asistencias(estado, empleado_id, sesion_id) values ('Presente', 4, 9);

insert into asistencias(estado, empleado_id, sesion_id) values ('Presente', 3, 10);

-- capacitacion de marzo del area de Marketing
insert into capacitaciones(nombre, descripcion, institucion, modalidad, fecha_inicio, fecha_final, cantidad_horas, estado, area_id) values ('Marketing digital', 'Hello world', 'UNIVO', 'Presencial', '2022-03-15', '2022-03-30', 10, 'Finalizado', 4);

insert into patrocinadores(institucion, descripcion, capacitacion_id) values ('UNIVO', 'Financia el 100%', 4);

insert into inscripciones(estado, empleado_id, capacitacion_id) values ('Finalizado', 7, 4);
insert into inscripciones(estado, empleado_id, capacitacion_id) values ('Finalizado', 8, 4);

insert into sesiones(nombre, fecha_hora_inicio, fecha_hora_final, activo, capacitacion_id) values ('Sesion #1', '2022-03-21 07:00', '2022-03-21 12:00', 0, 4);
insert into sesiones(nombre, fecha_hora_inicio, fecha_hora_final, activo, capacitacion_id) values ('Sesion #2', '2022-03-28 07:00', '2022-03-28 12:00', 0, 4);

insert into asistencias(estado, empleado_id, sesion_id) values ('Presente', 7, 11);
insert into asistencias(estado, empleado_id, sesion_id) values ('Presente', 8, 11);

insert into asistencias(estado, empleado_id, sesion_id) values ('Presente', 7, 12);
insert into asistencias(estado, empleado_id, sesion_id) values ('Presente', 8, 12);

-- capacitacion de mayo del area de Marketing
insert into capacitaciones(nombre, descripcion, institucion, modalidad, fecha_inicio, fecha_final, cantidad_horas, estado, area_id) values ('Teoria del diseño', 'Hello world', 'UNIVO', 'Presencial', '2022-05-01', '2022-05-30', 20, 'Finalizado', 4);

insert into patrocinadores(institucion, descripcion, capacitacion_id) values ('UNIVO', 'Financia el 100%', 5);

insert into inscripciones(estado, empleado_id, capacitacion_id) values ('Finalizado', 7, 5);
insert into inscripciones(estado, empleado_id, capacitacion_id) values ('Finalizado', 8, 5);

insert into sesiones(nombre, fecha_hora_inicio, fecha_hora_final, activo, capacitacion_id) values ('Sesion #1', '2022-05-01 07:00', '2022-05-01 12:00', 0, 5);
insert into sesiones(nombre, fecha_hora_inicio, fecha_hora_final, activo, capacitacion_id) values ('Sesion #2', '2022-05-14 07:00', '2022-05-14 12:00', 0, 5);
insert into sesiones(nombre, fecha_hora_inicio, fecha_hora_final, activo, capacitacion_id) values ('Sesion #3', '2022-05-21 07:00', '2022-05-21 12:00', 0, 5);
insert into sesiones(nombre, fecha_hora_inicio, fecha_hora_final, activo, capacitacion_id) values ('Sesion #4', '2022-05-28 07:00', '2022-05-28 12:00', 0, 5);

insert into asistencias(estado, empleado_id, sesion_id) values ('Presente', 7, 13);
insert into asistencias(estado, empleado_id, sesion_id) values ('Presente', 8, 13);

insert into asistencias(estado, empleado_id, sesion_id) values ('Presente', 7, 14);
insert into asistencias(estado, empleado_id, sesion_id) values ('Presente', 8, 14);

insert into asistencias(estado, empleado_id, sesion_id) values ('Presente', 7, 15);
insert into asistencias(estado, empleado_id, sesion_id) values ('Presente', 8, 15);

insert into asistencias(estado, empleado_id, sesion_id) values ('Presente', 7, 16);
insert into asistencias(estado, empleado_id, sesion_id) values ('Presente', 8, 16);


/* misiones */

-- misiones del mes de mayo del area de TI

insert into misiones(nombre, descripcion, estimacion, institucion, fecha_hora_inicio, fecha_hora_final, area_id) values ('Taller de normalizacion de base de datos', 'Hello world', 'Aprox', 'INGO', '2022-05-12 9:00', '2022-05-12 12:00', 3);

insert into participantes(estado, empleado_id, mision_id) values ('Ponente', 3, 1);
insert into participantes(estado, empleado_id, mision_id) values ('Oyente', 5, 1);

insert into comentarios(texto, empleado_id, mision_id) values ('Hello world', 3, 1);
insert into comentarios(texto, empleado_id, mision_id) values ('Hello world', 5, 1);

-- misiones del mes de julio del area de TI

insert into misiones(nombre, descripcion, estimacion, institucion, fecha_hora_inicio, fecha_hora_final, area_id) values ('Charla sobre las TICs', 'Hello world', 'Aprox', 'INJO', '2022-07-21 13:00', '2022-07-21 16:00', 3);

insert into participantes(estado, empleado_id, mision_id) values ('Ponente', 3, 2);

insert into comentarios(texto, empleado_id, mision_id) values ('Hello world', 3, 2);

-- misiones del mes de mayo del area de Marketin

insert into misiones(nombre, descripcion, estimacion, institucion, fecha_hora_inicio, fecha_hora_final, area_id) values ('Taller sobre marketing digital', 'Hello world', 'Aprox', 'UNIVO', '2022-05-21 13:00', '2022-05-21 16:00', 4);

insert into participantes(estado, empleado_id, mision_id) values ('Ponente', 7, 3);
insert into participantes(estado, empleado_id, mision_id) values ('Ponente', 8, 3);

insert into comentarios(texto, empleado_id, mision_id) values ('Hello world', 7, 3);
insert into comentarios(texto, empleado_id, mision_id) values ('Hello world', 8, 3);
