## Sistema para la administración de lugares de comida

La idea básica del proyecto es ofrecer un sistema donde una o varias personas puedan administrar un lugar de comidas pudiendo manejar los productos que venden (stock, recetas de preparación, precio, etc.) pero ademas también pudiendo manejar la materia prima que componen esos productos que venden. 
Un elemento Materia Prima (MP) va a tener varios atributos de los cuales los mas importantes van a ser la unidad de medida y el stock actual. 
Un elemento Producto va a estar conformado por una o varias MP. En el momento de querer seleccionar un producto para vender es importante que haya stock del producto ya almacenado y si no existiera el producto almacenado, que exista stock de las MP’s para poder armarlo. 

El sistema básicamente va a tener:

- ABM de una empresa (lugar de comida: restaurante, rotiserías, etc)
- ABM de usuarios (los usuarios que van a manejar el sistema, el que se registra es el administrador)
- ABM de materias primas
- ABM de productos (combinación de materias primas) 

Roles y acciones de los usuarios:

Van a existir inicialmente dos tipos de usuarios: administrador y básico. 

Un usuario puede administrar (estar relacionado) a una o varias empresas. 

Todos los usuarios van a ser los encargados de cargar las materias primas nuevas o actualizar las que existen. Ademas van a ser los que puedan cargar nuevos productos cargando las materias primas que lo componen y la receta (descripción de la preparación del producto). 

El usuario administrador va a poder realizar altas de nuevos usuarios (usuarios básicos) del sistemas para la empresa a la que pertenece. 

Una vez cargado un nuevo usuario básico, este deberá registrarse y seleccionar una de las posibles empresas a la que fue dado de alta. Luego, el administrador deberá aceptar o rechazar al usuario para confirmar el alta. 

Puntos a tener en cuenta: 

- Registro de un usuario administrador: este usuario es el que va a tener todos los permisos en el sistema. Inicialmente es el encargado de configurar los datos de la empresa y cargar el resto de las personas que van a manejar el sistema para la empresa generada. 
- Los usuarios básicos van a poder realizar diferentes acciones dentro del sistema como por ejemplo ABM de materias primas o productos, o consultas sobre estos. 
- Como se mencionó inicialmente, el sistema debería contar con un manejo de stock de materias primas y productos.

Entidades Básicas: 
- usuario
- empresa
- producto
- materia_prima

