## Sistema para la administración de lugares de comida

La idea básica del proyecto es ofrecer un sistema donde una o varias personas puedan administrar un lugar de comidas pudiendo manejar los productos que venden (stock, recetas de preparación, precio, etc.) pero ademas también pudiendo manejar la materia prima que componen esos productos que venden. 
Un elemento Materia Prima (MP) va a tener varios atributos de los cuales los mas importantes van a ser la unidad de medida y el stock actual. 
Un elemento Producto va a estar conformado por una o varias MP. En el momento de querer seleccionar un producto para vender es importante que haya stock del producto ya almacenado y si no existiera el producto almacenado, que exista stock de las MP’s para poder armarlo. 

El sistema básicamente va a tener:

- ABM de una empresa (lugar de comida: restaurante, rotiserías, etc)
- ABM de usuarios (los usuarios que van a manejar el sistema, el que se registra es el administrador)
- ABM de materias primas
- ABM de productos (combinación de materias primas) 

Puntos a tener en cuenta: 

- Registro de un usuario administrador: este usuario es el que va a tener todos los permisos en el sistema. Inicialmente es el encargado de configurar los datos de la empresa y cargar el resto de las personas que van a manejar el sistema para la empresa generada. 
- Los usuarios que no son administradores van a poder realizar diferentes acciones dentro del sistema como por ejemplo ABM de materias primas o productos. 
- Como se mencionó inicialmente, el sistema debería contar con un manejo de stock de materias primas y productos.

Entidades Básicas: 
- usuario
- empresa
- producto
- materia_prima

