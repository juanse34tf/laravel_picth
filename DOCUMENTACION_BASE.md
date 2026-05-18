# DOCUMENTACION BASE - Sistema de Gestion Avicola

## SCE1.1 Planteamiento del problema
En muchas granjas avicolas tradicionales, el control de informacion se realiza de forma manual (cuadernos, hojas sueltas o archivos dispersos), lo que provoca errores de registro, duplicidad de datos, perdida de historial y retraso en la toma de decisiones. Esta situacion impacta de forma directa la trazabilidad de la produccion, el control de inventario, el seguimiento de alimentacion por lote y la medicion real de costos e ingresos. Como consecuencia, la administracion operativa y financiera se vuelve menos precisa, menos oportuna y mas vulnerable a inconsistencias.

## SCE1.2 Objetivos
### Objetivo general
Desarrollar e implementar un sistema web de gestion avicola que centralice y automatice el registro, consulta y analisis de la informacion operativa y financiera de la granja.

### Objetivos especificos
1. Disenar y desplegar modulos CRUD para categorias, productos, lotes, produccion, alimentacion, gastos y ventas, garantizando integridad de los datos.
2. Establecer una base de datos relacional con reglas de integridad referencial que asegure trazabilidad entre inventario, produccion y comercializacion.
3. Incorporar controles de acceso por roles y reportes operativos para mejorar el seguimiento y la toma de decisiones.

## SCE1.3 Justificacion
La digitalizacion del proceso avicola permite pasar de un esquema manual a un esquema estructurado, auditable y escalable. Esto reduce errores humanos, mejora la disponibilidad de informacion historica y fortalece la calidad de las decisiones tecnicas y administrativas.

Desde la perspectiva de datos, el modelo relacional implementa de forma explicita 8 tablas: **users, categorias, productos, lotes, produccions, alimentacions, gastos y ventas**. Cuatro tablas son independientes (users, gastos, categorias y lotes), mientras que las otras cuatro materializan relaciones 1:N mediante llaves foraneas: **productos.categoria_id -> categorias.id**, **ventas.producto_id -> productos.id**, **produccions.lote_id -> lotes.id** y **alimentacions.lote_id -> lotes.id**. Esta estructura garantiza consistencia, evita registros huerfanos y soporta trazabilidad de extremo a extremo entre clasificacion de productos, lotes productivos, alimentacion y ventas.

## SCE2.1 Priorizacion de requerimientos (Historias de Usuario)
1. Como administrador, quiero gestionar categorias para clasificar los productos y mantener organizado el inventario.
2. Como operario, quiero registrar lotes con su cantidad y fecha de inicio para controlar su ciclo productivo.
3. Como operario, quiero registrar produccion diaria por lote para monitorear rendimiento y detectar variaciones.
4. Como operario, quiero registrar alimentacion por lote para relacionar consumo con niveles de produccion.
5. Como administrador, quiero registrar ventas y gastos para obtener control financiero y evaluar rentabilidad.

## SCE2.2 Requerimientos no funcionales
- **Seguridad:** autenticacion de usuarios, autorizacion por rol, validacion de entradas y proteccion de rutas.
- **Rendimiento:** consultas optimizadas sobre relaciones clave, tiempos de respuesta adecuados para operaciones CRUD y generacion eficiente de reportes.
- **Usabilidad:** interfaz web clara, navegacion consistente, formularios comprensibles y flujo de trabajo orientado a tareas operativas diarias.

## SCE2.3 Casos de uso principales (descripcion breve)
1. **Gestion de inventario:** el usuario crea categorias y productos, actualiza precios/stock y consulta disponibilidad para soporte de ventas.
2. **Control de produccion y alimentacion:** el usuario registra lotes, captura produccion diaria y alimentacion asociada para seguimiento tecnico del rendimiento.
3. **Control economico:** el usuario registra gastos y ventas para consolidar informacion financiera y apoyar decisiones de administracion.

## SCE2.5 Arquitectura seleccionada
El sistema adopta una arquitectura **MVC** sobre **Laravel 11**, separando responsabilidades en:
- **Modelo:** entidades y logica de acceso a datos (Eloquent ORM) para representar tablas y relaciones.
- **Vista:** plantillas Blade y componentes Livewire para interfaz dinamica y mantenible.
- **Controlador:** coordinacion de reglas de negocio, validaciones, operaciones CRUD y flujo HTTP.

Se utiliza **SQLite** durante pruebas y desarrollo rapido por su simplicidad de despliegue, y **MySQL** en produccion para mayor robustez operativa, concurrencia y administracion en entornos reales.
