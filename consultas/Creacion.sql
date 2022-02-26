use blog
go
create table usuarios (
id_usuario numeric identity not null,
nombre nvarchar (20) not null,
correo nvarchar (40) not null,
contraseña nvarchar (20) not null,
registro datetime not null,
baneado bit not null,
primary key (id_usuario)
);