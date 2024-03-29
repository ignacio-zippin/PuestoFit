/*Creacion base de datos*/
create database puestofit
    default character set utf8;

/*Creacion de Tablas*/
use puestofit;

create table inventario (
	cod_prod int not null unique auto_increment,
	nombre varchar(255) null,
	existencia varchar(255) null,
    cantidad_min int null,
    marca varchar(255) null,
    categoria varchar (255) null,
    precio_compra int null,
    precio_venta int,
    contiene_T varchar(2),
    contiene_A varchar(2),
    contiene_L varchar(2),
    descripcion varchar (255),
	fecha_registro datetime null,
	primary key(cod_prod)
);

create table proveedores (
    cod_prov int not null unique auto_increment,
    cuil int null,
    nombre varchar(255) null,
    direccion varchar(255)  null,
    telefono int,
    email varchar(255),
    primary key (cod_prov)
);

create table depositos (
    cod_deposito int not null unique auto_increment,
    nombre varchar(255) null,
    direccion varchar(255)  null,
    primary key (cod_deposito)
);

create table stock_deposito (
    cod_deposito int,
    cod_prod int,
    cantidad int,
    primary key(cod_prod,cod_deposito),
    FOREIGN KEY (cod_deposito) REFERENCES depositos(cod_deposito) ON DELETE CASCADE,
    FOREIGN KEY (cod_prod) REFERENCES inventario(cod_prod) ON DELETE CASCADE
);

create table pedidos_reposicion(
    cod_pedido int unique auto_increment,
    fecha datetime,
    sucursal int,
    estado int,
    primary key(cod_pedido),
    FOREIGN KEY (sucursal) REFERENCES depositos(cod_deposito) ON DELETE CASCADE
);

create table detalle_pedidos_reposicion(
    cod_det_pedido int unique auto_increment,
    cod_pedido int,
    nombre varchar(255),
    marca varchar(255),
    cantidad int,
    observaciones varchar(255),
    primary key (cod_det_pedido),
    FOREIGN key (cod_pedido) REFERENCES pedidos_reposicion(cod_pedido) ON DELETE CASCADE
);

create table cotizaciones(
    cod_cotizacion int unique auto_increment,
    cod_pedido int,
    fecha_emision datetime,
    fecha_presupuesto datetime,
    proveedor varchar(255),
    total int,
    sucursal int,
    estado int,
    primary key(cod_cotizacion),
    FOREIGN key (cod_pedido) REFERENCES pedidos_reposicion(cod_pedido) ON DELETE CASCADE 
);

create table detalle_cotizacion(
    cod_det_cotizacion int unique auto_increment,
    cod_cotizacion int,
    nombre varchar(255),
    marca varchar(255),
    cantidad int,
    precio_unitario int,
    primary key (cod_det_cotizacion),
    FOREIGN key (cod_cotizacion) REFERENCES cotizaciones(cod_cotizacion) on DELETE CASCADE
);

create table ordenes_de_compra(
    cod_orden_de_compra int unique auto_increment,
    fecha_emision datetime,
    fecha_entrega_estimada datetime,
    proveedor varchar(255),
    total int,
    estado varchar(100),
    sucursal int,
    primary key(cod_orden_de_compra),
    cod_cotizacion int,
    FOREIGN key (cod_cotizacion) REFERENCES cotizaciones(cod_cotizacion) ON DELETE CASCADE 
);

create table detalle_ordenes_de_compra(
    cod_det_orden_de_compra int unique auto_increment,
    cod_orden_de_compra int,
    nombre varchar(255),
    marca varchar(255),
    cantidad int,
    precio_unitario int,
    primary key (cod_det_orden_de_compra),
    FOREIGN key (cod_orden_de_compra) REFERENCES ordenes_de_compra(cod_orden_de_compra) on DELETE CASCADE
);

create table facturas_compra(
    cod_factura_compra int unique auto_increment,
    num_factura varchar(255),
    tipo varchar(255),
    sucursal int,
    fecha datetime,
    fecha_entrega_estimada datetime,
    proveedor varchar(255),
    total int,
    estado int,
    primary key(cod_factura_compra),
    cod_oc int,
    FOREIGN key (cod_oc) REFERENCES ordenes_de_compra(cod_orden_de_compra) ON DELETE CASCADE 
);

create table detalle_facturas_compra(
    cod_det_factura_compra int unique auto_increment,
    cod_factura_compra int,
    nombre varchar(255),
    marca varchar(255),
    cantidad int,
    precio_unitario int,
    primary key (cod_det_factura_compra),
    FOREIGN key (cod_factura_compra) REFERENCES facturas_compra(cod_factura_compra) on DELETE CASCADE
);

create table remitos(
    cod_remito int unique auto_increment,
    num_remito int,
    fecha datetime,
    proveedor varchar(255),
    total int,
    estado int,
    sucursal int,
    primary key(cod_remito),
    cod_factura_compra int, 
    FOREIGN key (cod_factura_compra) REFERENCES facturas_compra(cod_factura_compra) ON DELETE CASCADE 
);

create table detalle_remitos(
    cod_det_remito int unique auto_increment,
    cod_remito int,
    nombre varchar(255),
    marca varchar(255),
    cantidad int,
    precio_unitario int,
    primary key (cod_det_remito),
    FOREIGN key (cod_remito) REFERENCES remitos(cod_remito) on DELETE CASCADE
);

create table movimientos_stock(
    cod_mov int unique auto_increment,
    fecha datetime,
    tipo varchar(255),
    motivo varchar(255),
    sucursal int,
    cod_remito int,
    cod_factura_venta int,
    observaciones varchar(255),
    estado int,
    primary key(cod_mov),
    FOREIGN key (cod_remito) REFERENCES remitos(cod_remito) ON DELETE CASCADE 
);

create table detalle_movimientos_stock(
    cod_det_mov_stock int unique auto_increment,
    cod_producto int,
    cantidad int,
    cod_mov int,
    cod_det_remito int,
    cod_det_fac int,
    primary key(cod_det_mov_stock),
    FOREIGN key (cod_producto) REFERENCES inventario(cod_prod) ON DELETE CASCADE,
    FOREIGN key (cod_mov) REFERENCES movimientos_stock(cod_mov) ON DELETE CASCADE,
    FOREIGN key (cod_det_remito) REFERENCES detalle_remitos(cod_det_remito) ON DELETE CASCADE 
);

create table estados(
    cod int unique auto_increment,
    nombre varchar (255)
);

create table pagos(
    cod_pago int UNIQUE auto_increment,
    num_factura int,
    metodo_pago varchar(255),
    observaciones varchar(255),
    sucursal int,
    fecha datetime,
    proveedor varchar(255),
    total int,
    estado int,
    cod_factura_compra int,
    primary key(cod_pago),
    FOREIGN key (cod_factura_compra) REFERENCES facturas_compra(cod_factura_compra) ON DELETE CASCADE 
);

create table detalle_pagos(
    cod_det_pago int unique auto_increment,
    cod_pago int,
    nombre varchar(255),
    marca varchar(255),
    cantidad int,
    precio_unitario int,
    primary key (cod_det_pago),
    FOREIGN key (cod_pago) REFERENCES pagos(cod_pago) on DELETE CASCADE
);

create table egresos(
    cod_egreso int unique auto_increment,
    motivo varchar(255),
    fecha datetime,
    monto varchar (255),
    primary key (cod_egreso)
);

create table clientes (
    cod_cliente int not null unique auto_increment,
    nombre varchar(255) null,
    dni int null,
    fecha_nacimiento date,
    direccion varchar(255)  null,
    telefono varchar(255),
    email varchar(255),
    primary key (cod_cliente)
);

create table ventas (
    cod_venta int not null unique auto_increment,
    fecha date,
    num_factura int,
    tipo_factura varchar(255),
    cod_cliente int,
    sucursal int,
    met_pago varchar(255),
    observaciones varchar(255),
    importe int,
    estado int,
    primary key (cod_venta),
    FOREIGN key (cod_cliente) REFERENCES clientes(cod_cliente) on DELETE CASCADE
);

create table detalle_ventas(
    cod_det_venta int unique auto_increment,
    cod_venta int,
    nombre varchar(255),
    marca varchar(255),
    cantidad int,
    precio_unitario int,
    primary key (cod_det_venta),
    FOREIGN key (cod_venta) REFERENCES ventas(cod_venta) on DELETE CASCADE
);

/* Claves*/

ALTER TABLE stock_deposito ADD CONSTRAINT FK_stock_cod_deposito FOREIGN KEY(cod_deposito) REFERENCES depositos(cod_deposito);
ALTER TABLE stock_deposito ADD CONSTRAINT FK_stock_cod_prod FOREIGN KEY(cod_prod) REFERENCES inventario(cod_prod);
ALTER TABLE inventario ADD CONSTRAINT FK_inventario_proveedor FOREIGN KEY(cod_prov) REFERENCES proveedores(cod_prov);
ALTER TABLE inventario ADD CONSTRAINT FK_inventario_depostios FOREIGN KEY(cod_deposito) REFERENCES depositos(cod_deposito);

/*VISTAS*/


    /*Vista grilla pedidos de reposicion principal*/
    CREATE OR REPLACE VIEW 
    grilla_pedidos_reposicion AS 
    SELECT cod_pedido, fecha, estados.nombre as estado, depositos.nombre as sucursal FROM pedidos_reposicion
    INNER JOIN depositos 
    ON pedidos_reposicion.sucursal = depositos.cod_deposito
    INNER JOIN estados
    ON pedidos_reposicion.estado = estados.cod;

    /*Vista grilla seleccion pedido reposicion(emitir_cotizacion)*/
    CREATE OR REPLACE VIEW 
    grilla_pedidos_reposicion_cot AS 
    SELECT cod_pedido, fecha, estados.nombre as estado, depositos.nombre as sucursal FROM pedidos_reposicion
    INNER JOIN depositos 
    ON pedidos_reposicion.sucursal = depositos.cod_deposito
    INNER JOIN estados
    ON pedidos_reposicion.estado = estados.cod;

    /*Vista grilla cotizaciones principal */
    CREATE OR REPLACE VIEW
    grilla_cotizaciones AS
    SELECT cod_cotizacion, cod_pedido, fecha_emision, fecha_presupuesto, proveedor, total, estados.nombre as estado, depositos.nombre as sucursal
    from cotizaciones
    INNER JOIN depositos
    ON cotizaciones.sucursal = depositos.cod_deposito
    INNER JOIN estados
    ON cotizaciones.estado = estados.cod;

     /*Vista grilla cotizaciones seleccionar */
    CREATE OR REPLACE VIEW
    grilla_cotizaciones_seleccionar AS
    SELECT cod_cotizacion, cod_pedido, estados.nombre as estado, fecha_emision, fecha_presupuesto, depositos.nombre as sucursal, proveedor, total 
    from cotizaciones
    INNER JOIN depositos
    ON cotizaciones.sucursal = depositos.cod_deposito
    INNER JOIN estados
    ON cotizaciones.estado = estados.cod;
    
    /*Vista grilla oc */
    CREATE OR REPLACE VIEW
    grilla_ordenes_de_compra AS
    SELECT cod_orden_de_compra, fecha_emision, proveedor, estados.nombre as estado, depositos.nombre as sucursal
    from ordenes_de_compra 
    INNER JOIN depositos
    ON ordenes_de_compra.sucursal = depositos.cod_deposito
    INNER JOIN estados
    ON ordenes_de_compra.estado = estados.cod;

    /*Vista grilla seleccion orden de compra (factura_registrar) */
    CREATE OR REPLACE VIEW
    grilla_ordenes_de_compra_sel AS
    SELECT cod_orden_de_compra, fecha_emision, proveedor, total, estados.nombre as estado, depositos.nombre as sucursal
    from ordenes_de_compra 
    INNER JOIN depositos
    ON ordenes_de_compra.sucursal = depositos.cod_deposito
    INNER JOIN estados
    ON ordenes_de_compra.estado = estados.cod;

    /*Vista grilla facturas_compra */
        CREATE OR REPLACE VIEW
        grilla_facturas_compra AS
        SELECT cod_factura_compra, num_factura, tipo, total, fecha, fecha_entrega_estimada,proveedor,cod_oc,estados.nombre as estado, depositos.nombre as sucursal
        from facturas_compra
        INNER JOIN depositos
        ON facturas_compra.sucursal = depositos.cod_deposito
        INNER JOIN estados
        ON facturas_compra.estado = estados.cod;

    /*Vista grilla pagos_principal*/
        CREATE OR REPLACE VIEW
        grilla_pagos AS
        SELECT cod_pago, num_factura, metodo_pago, observaciones, depositos.nombre as sucursal, 
                fecha, proveedor, total, estados.nombre as estado
        from pagos
        INNER JOIN depositos
        ON pagos.sucursal = depositos.cod_deposito
        INNER JOIN estados
        ON pagos.estado = estados.cod

    /*Vista grilla movimientos_principal*/
        CREATE OR REPLACE VIEW
        grilla_movimientos AS
        SELECT cod_mov, fecha, tipo, depositos.nombre as sucursal, motivo, estado.nombre as estado,
                observaciones
        from movimientos_stock 
        INNER JOIN depositos
        ON movimientos_stock.sucursal = depositos.cod_deposito 
        INNER JOIN estados
        ON movimientos_stock.estado = estados.cod


    /*Vista grilla remito */
        CREATE OR REPLACE VIEW
        grilla_remito AS
        SELECT cod_remito, num_remito, num_factura, remitos.fecha as fecha, remitos.proveedor as proveedor, depositos.nombre as sucursal, estados.nombre as estado
        from remitos
        INNER JOIN depositos
        ON remitos.sucursal = depositos.cod_deposito
        INNER JOIN estados
        ON remitos.estado = estados.cod
        INNER JOIN facturas_compra
        ON remitos.cod_factura_compra = facturas_compra.cod_factura_compra;

    /*Vista grilla facturas_remito */
        CREATE OR REPLACE VIEW
        grilla_facturas_remito AS
        SELECT cod_factura_compra, num_factura, tipo, depositos.nombre as sucursal, proveedor, 
        fecha, total, estados.nombre as estado
        from facturas_compra
        INNER JOIN depositos
        ON facturas_compra.sucursal = depositos.cod_deposito
        INNER JOIN estados
        ON facturas_compra.estado = estados.cod

    /*Vista grilla inventario*/
        CREATE OR REPLACE VIEW 
        grilla_inventario AS 
        SELECT i.cod_prod, i.nombre as nombre, sd.cantidad, i.marca, i.categoria, i.precio_compra, i.precio_venta
        FROM inventario i
        INNER JOIN stock_deposito sd
        ON sd.cod_prod = i.cod_prod
        where sd.cod_deposito=1

    /*Vista grilla registrar mov_stock*/
        CREATE OR REPLACE VIEW 
        grilla_det_mov_stock AS 
        SELECT cod_det_mov_stock, cod_producto, nombre, cantidad, marca, cod_mov
        FROM detalle_movimientos_stock 
        INNER JOIN inventario 
        ON detalle_movimientos_stock.cod_producto = inventario.cod_prod
        
    /*Vista grilla ventas de ventas principal*/
        CREATE OR REPLACE VIEW 
        grilla_ventas_principal AS 
        SELECT cod_venta,fecha, num_factura, tipo_factura, clientes.nombre as cliente ,
        depositos.nombre as sucursal, met_pago, observaciones , importe, estado FROM ventas
        INNER JOIN depositos 
        ON ventas.sucursal = depositos.cod_deposito
        INNER JOIN clientes
        ON ventas.cod_cliente = clientes.cod_cliente;

    /*Vista grilla informes de ranking de producto*/
        CREATE OR REPLACE VIEW 
        grilla_informes_ranking AS 
        SELECT ROW_NUMBER() Over (Order By sum(dv.cantidad) desc),
        sum(cantidad) as total_unidades,
        sum(cantidad*dv.precio_unitario) as total,
        i.cod_prod, 
        dv.nombre,
        i.marca,
        i.categoria,
        i.precio_compra,
        i.precio_venta
        FROM `detalle_ventas` dv
        INNER JOIN inventario i
        ON i.nombre= dv.nombre
        group by dv.nombre
        order by 'Total Vendidos' desc
    
     /* Vista grilla de ingresos*/
    CREATE OR REPLACE VIEW 
        grilla_informes_ingresos AS
    SELECT MONTH(fecha) as num, MONTHNAME (fecha) as MES, count(cod_venta) as 'CANTIDAD DE VENTAS', SUM(importe) as 'TOTAL INGRESOS'
    FROM ventas
    where num_factura is not null AND estado = 1
    group BY MES DESC
    order by num ASC

    /* Vista grilla de egresos*/ 
    CREATE OR REPLACE VIEW 
        grilla_informes_egresos AS
    SELECT MONTH(fecha) as num, MONTHNAME (fecha) as MES, count(cod_pago) as 'CANTIDAD DE OPERACIONES', SUM(total) as 'TOTAL EGRESOS'
    FROM pagos
    group BY MES
    order by num ASC

/*Carga de elementos*/
    /*Carga de proveedores*/
    insert into proveedores (cuil,nombre,direccion,telefono,email)
    values(1231242,'Arcor','Caseros 1250',4324598,'arcor@gmail.com'),
          (9536478,'Coca-Cola Company','Paraguay 2250',4243017,'coca-cola@gmail.com'),
          (4487951,'Palacio de las golosinas','Pellegrini 742',3874923654,'epdlg@gmail.com');
          
    /*Carga de depositos*/
    insert into depositos (nombre,direccion)
    values('Santa ana','B° Santa Ana Manzana 20 Casa 5'),
    ('Tres Cerritos','Las Acacias 1268'),
    ('Centro','San Martín 788');

    /*Carga de estados*/
    insert into estados (cod,nombre)
    values(1,"Pendiente"),
    (2,"Listo"),
    (3,"Cargada"),
    (4,"Entregado"),
    (5,"Anulada"); 
    
    /*Carga tabla inventario*/
    insert into inventario (nombre,existencia,cantidad_min,marca,categoria,precio_compra,precio_venta,
                        	contiene_T,contiene_A,contiene_L,descripcion,fecha_registro,cod_prov,cod_deposito)
    values('Semillas de chia x 100grs',20,10,'Chiamix','Semillas','5','7','no','no','no','Ricas en proteinas!',NOW(),1,1),
          ('Barra de cereal',30,10,'CerealMix','Barras de cereal','4','7','si','si','no',null,NOW(),3,1),
          ('Galletas dulces',40,15,'Frutigram','Galletas','8','14','si','si','no','Lo mejor del mercado!',NOW(),2,1),
          ('Leche de coco x 1lt',5,10,'Ades','Bebidas','10','20','no','no','no','Muy natural',NOW(),3,2);
    
