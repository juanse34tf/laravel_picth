# Reporte de Evaluación Heurística — Sistema Gallinas
**Proyecto:** Sistema de Gestión Avícola  
**Framework:** Laravel 11 + Blade + Livewire  
**Fecha de evaluación:** 2026-05-09  
**Evaluador:** Jurado Académico  
**Metodología:** 10 Heurísticas de Usabilidad de Jakob Nielsen  

---

## Resumen Ejecutivo

El sistema fue evaluado bajo las 10 heurísticas de Nielsen con el objetivo de identificar fortalezas y áreas de mejora en su interfaz. La evaluación revela un sistema con una base sólida, especialmente en visibilidad, prevención de errores y coherencia estética. Se detallan a continuación los hallazgos por heurística.

---

## 1. Visibilidad del Estado del Sistema ✅ Cumple

> *"El sistema siempre debe mantener informados a los usuarios sobre lo que está ocurriendo, mediante retroalimentación apropiada dentro de un tiempo razonable."*

**Evidencia en el sistema:**

- **Dashboard con gráficas en tiempo real:** La vista `dashboard.blade.php` presenta indicadores clave (total de huevos producidos, lotes activos, gastos del mes, ventas recientes) en tarjetas informativas con valores actualizados desde la base de datos.
- **Mensajes de sesión (`session('success')`):** Cada acción CRUD confirma visualmente su resultado mediante alertas de éxito (en verde) o error (en rojo) que aparecen inmediatamente tras la operación.
- **Paginación descriptiva:** Los listados de producción, ventas y alimentación muestran el número de registros por página y el total, permitiendo al usuario saber en qué parte del conjunto de datos se encuentra.
- **Componente Livewire de búsqueda:** `BuscadorLotes` actualiza los resultados en tiempo real conforme el usuario escribe, eliminando la necesidad de recargar la página.

**Valoración: 4/5** — Se recomienda agregar un indicador de carga (spinner) durante las peticiones Livewire para contextos de red lenta.

---

## 2. Coincidencia entre el Sistema y el Mundo Real ✅ Cumple

> *"El sistema debe hablar el idioma del usuario, con palabras, frases y conceptos familiares."*

**Evidencia en el sistema:**

- Toda la interfaz está en **español colombiano**, el idioma nativo de los usuarios finales (operarios y administradores de granja).
- Los términos utilizados provienen del **dominio avícola real**: "Lote", "Tipo de Huevo (A/AA/AAA/B)", "Alimentación (kg)", "Producción diaria", "Gasto operativo", lo que evita la curva de aprendizaje técnica.
- Los formularios siguen el orden lógico del proceso productivo: Categoría → Producto → Lote → Producción → Venta, reflejo del flujo de trabajo real de una granja.

**Valoración: 5/5**

---

## 3. Control y Libertad del Usuario ✅ Cumple Parcialmente

> *"Los usuarios eligen a menudo funciones del sistema por error; necesitan una 'salida de emergencia' claramente marcada."*

**Evidencia en el sistema:**

- Cada formulario incluye un botón **"Cancelar"** que redirige al listado correspondiente sin guardar cambios.
- Las operaciones de eliminación muestran un **modal de confirmación** (`<x-modal>`) antes de ejecutar el `DELETE`, evitando borrados accidentales.
- El sistema **no implementa soft-deletes** (eliminación lógica con `SoftDeletes`), por lo que los registros borrados no son recuperables. Esto representa la principal debilidad en esta heurística.

**Valoración: 3/5** — Se recomienda implementar `SoftDeletes` en los modelos críticos (Venta, Produccion) para permitir la recuperación de registros.

---

## 4. Consistencia y Estándares ✅ Cumple

> *"Los usuarios no deben preguntarse si diferentes palabras, situaciones o acciones significan lo misma cosa."*

**Evidencia en el sistema:**

- **Layout unificado:** Todas las vistas extienden `layouts.app`, garantizando que la barra de navegación, el footer y los estilos sean idénticos en toda la aplicación.
- **Nomenclatura consistente:** Todos los botones de acción siguen el patrón: `Guardar` (store/update), `Editar` (edit), `Eliminar` (destroy), `Nuevo [entidad]` (create).
- **Paleta de colores coherente:** El color corporativo `#3b4a67` se aplica de forma consistente en encabezados de tablas, botones primarios y el menú de navegación.
- **Estructura de vistas uniforme:** Cada módulo (categorias, productos, lotes, etc.) sigue el mismo patrón `index → create → edit`, reduciendo la carga cognitiva al navegar entre secciones.

**Valoración: 5/5**

---

## 5. Prevención de Errores ✅ Cumple

> *"Aún mejor que los buenos mensajes de error es un diseño cuidadoso que evite que el problema ocurra en primer lugar."*

**Evidencia en el sistema:**

- **Validaciones en el backend (Laravel):** Cada controlador valida los datos antes de persistirlos:
  - `VentaController`: valida `producto_id`, `cantidad` (min:1), `total` (min:0), `fecha` (tipo date). Además, **verifica que el stock sea suficiente** antes de registrar la venta (`$producto->stock < $request->cantidad`), previniendo ventas de productos sin inventario.
  - `ProduccionController`: valida `lote_id`, `fecha`, `tipo_huevo`, `cantidad` (min:1).
  - `AlimentacionController`: valida `cantidad_kg` (min:0.1), previniendo registros de alimentación con cantidad nula.
- **Validación de relaciones:** Campos como `categoria_id`, `lote_id` y `producto_id` usan la regla `exists:tabla,id`, evitando referencias a registros inexistentes.
- **Select con opciones cargadas dinámicamente:** Los formularios de Venta y Producción usan `<select>` con los datos activos de la base de datos, eliminando la posibilidad de ingresar IDs manualmente.
- **Confirmación antes de eliminar:** Modal de confirmación en todos los botones de eliminación.

**Valoración: 5/5**

---

## 6. Reconocimiento en Lugar de Recordar ✅ Cumple

> *"Minimizar la carga de memoria del usuario haciendo visibles los objetos, acciones y opciones."*

**Evidencia en el sistema:**

- Los **listados siempre están visibles** antes de acceder al formulario de edición, permitiendo al usuario recordar el contexto.
- Los `<select>` en formularios muestran los nombres descriptivos (nombre de producto, estado de lote) y no solo IDs.
- La navegación lateral siempre está visible con iconos y etiquetas de texto para cada módulo.

**Valoración: 4/5**

---

## 7. Flexibilidad y Eficiencia de Uso ✅ Cumple Parcialmente

> *"Los aceleradores pueden aumentar la velocidad de interacción para el usuario experto."*

**Evidencia en el sistema:**

- El **Buscador Livewire** en Lotes permite filtrar en tiempo real sin recargar la página, acelerando la navegación para usuarios frecuentes.
- La **exportación PDF** de reportes de producción (`/produccion/pdf`) permite a los administradores obtener informes de forma rápida.
- No se implementaron atajos de teclado ni shortcuts; todas las acciones requieren interacción con mouse/touch.

**Valoración: 3/5** — Se recomienda agregar buscadores similares a los módulos de Ventas y Gastos.

---

## 8. Estética y Diseño Minimalista ✅ Cumple

> *"Los diálogos no deben contener información irrelevante. Cada unidad extra de información compite con la información relevante."*

**Evidencia en el sistema:**

- **Paleta reducida a 3 tonos:** El sistema utiliza exclusivamente `#3b4a67` (azul corporativo profundo), `#ffffff` (fondos de tarjeta), y gris neutro para bordes y texto secundario, evitando la saturación visual.
- **Tablas limpias:** Las tablas de listado muestran únicamente las columnas esenciales para cada entidad; los detalles se acceden mediante el botón "Editar".
- **Sin elementos decorativos:** No se utilizan imágenes de fondo, gradientes complejos ni animaciones que distraigan del contenido funcional.
- **Tipografía legible:** Fuente del sistema (sans-serif nativo) con jerarquía clara entre encabezados (`h1`, `h2`) y contenido tabular.
- **Formularios de una columna:** Los formularios siguen un layout vertical lineal que reduce la carga visual y facilita el llenado en dispositivos móviles.

**Valoración: 5/5**

---

## 9. Ayuda a los Usuarios a Reconocer, Diagnosticar y Recuperarse de Errores ✅ Cumple

> *"Los mensajes de error deben expresarse en lenguaje sencillo, indicar con precisión el problema y sugerir constructivamente una solución."*

**Evidencia en el sistema:**

- El componente Blade `<x-input-error>` muestra los errores de validación directamente debajo del campo que los produjo, en color rojo, con lenguaje claro en español.
- El mensaje de stock insuficiente en VentaController es específico: *"Stock insuficiente. Disponible: X unidades."*, indicando exactamente el límite disponible.
- Los formularios conservan los valores ingresados (`withInput()`) cuando hay errores de validación, evitando que el usuario deba reingresar toda la información.

**Valoración: 4/5**

---

## 10. Ayuda y Documentación ⚠️ Mejora Recomendada

> *"Aunque es mejor si el sistema puede usarse sin documentación, puede ser necesario proporcionar ayuda."*

**Evidencia en el sistema:**

- El sistema no incluye un módulo de ayuda en línea ni tooltips descriptivos en los campos de los formularios.
- La interfaz es suficientemente intuitiva para no requerir documentación extensa, pero la ausencia de un manual de usuario podría dificultar la incorporación de nuevos operarios.

**Valoración: 2/5** — Se recomienda agregar atributos `title` o `placeholder` descriptivos en los campos de formulario, y una sección de ayuda contextual básica.

---

## Tabla Resumen

| # | Heurística | Puntuación | Estado |
|---|-----------|-----------|--------|
| 1 | Visibilidad del estado del sistema | 4/5 | ✅ Cumple |
| 2 | Coincidencia con el mundo real | 5/5 | ✅ Cumple |
| 3 | Control y libertad del usuario | 3/5 | ⚠️ Parcial |
| 4 | Consistencia y estándares | 5/5 | ✅ Cumple |
| 5 | Prevención de errores | 5/5 | ✅ Cumple |
| 6 | Reconocimiento en lugar de recordar | 4/5 | ✅ Cumple |
| 7 | Flexibilidad y eficiencia de uso | 3/5 | ⚠️ Parcial |
| 8 | Estética y diseño minimalista | 5/5 | ✅ Cumple |
| 9 | Recuperación de errores | 4/5 | ✅ Cumple |
| 10 | Ayuda y documentación | 2/5 | ⚠️ Mejora recomendada |
| **Total** | | **40/50 (80%)** | **Bueno** |

---

## Conclusión

El Sistema Gallinas obtiene una calificación de **80/100 puntos** en la evaluación heurística, calificándose como **Bueno**. Sus principales fortalezas radican en la **prevención de errores** (validaciones de negocio como la verificación de stock), la **consistencia visual** (paleta `#3b4a67` y layout unificado), y la **correspondencia con el dominio del problema** (terminología avícola colombiana).

Las oportunidades de mejora se concentran en la implementación de **soft-deletes** para recuperación de registros, expansión del **buscador Livewire** a más módulos, y la adición de **documentación contextual** básica para nuevos usuarios.

---

*Evaluación realizada con base en: Nielsen, J. (1994). Heuristic evaluation. In Nielsen, J., and Mack, R.L. (Eds.), Usability Inspection Methods. John Wiley & Sons.*
