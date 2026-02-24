# CI4 with IA - Sistema de Gestión de Productos

Un sistema completo de gestión de productos con autenticación de usuarios, categorías dinámicas, carga de imágenes y administración de inventario. Construido con **CodeIgniter 4**, **AdminLTE**, **Bootstrap 4** y **DataTables**.

## ⏱️ Estadísticas de Desarrollo

| Métrica | Valor |
|---------|-------|
| **Fecha de Inicio** | 23 de Febrero, 2026 |
| **Fecha de Finalización** | 23 de Febrero, 2026 |
| **Tiempo Total de Desarrollo** | ~4 horas |
| **Iteraciones (Prompts)** | 7 principales |
| **Características Implementadas** | 12+ |
| **Archivos Creados/Modificados** | 20+ |
| **Líneas de Código** | ~2,500+ |

### 📊 Desglose de Tiempo por Característica

- **Instalación y Configuración de CI4** - 20 min
- **Autenticación de Usuarios (Registro/Login)** - 30 min
- **Integración AdminLTE Dashboard** - 25 min
- **CRUD de Productos** - 45 min
- **Carga y Previsualización de Imágenes** - 35 min
- **CRUD Dinámico de Categorías** - 40 min
- **URL Rewriting y Seguridad** - 15 min
- **Documentación y GitHub** - 30 min

**Productividad:** ~625 líneas de código por hora con asistencia de IA

## 📷 Captura de Pantallas

### Autenticación
- **Login**
  ```
  ![Login View](./public/screenshots/01-login.png)
  ```
  
- **Registro**
  ```
  ![Register View](./public/screenshots/02-register.png)
  ```

### Gestión de Productos
- **Listado de Productos - DataTable**
  ```
  ![Products List](./public/screenshots/03-products.png)
  ```
  
- **Modal de Crear/Editar Producto**
  ```
  ![Product Modal](./public/screenshots/05-product-modal.png)
  ```
  
- **Modal de Gestión de Categorías**
  ```
  ![Categories Modal](./public/screenshots/04-categories-modal.png)
  ```

### Dashboard
- **Panel Principal**
  ```
  ![Dashboard](./public/screenshots/06-dashboard.png)
  ```

> **📝 Nota:** Para ver las capturas de pantalla reales, debes capturar las vistas del sistema. Consulta [./public/screenshots/README.md](./public/screenshots/README.md) para instrucciones detalladas sobre cómo capturar y agregar las imágenes.

## 🎯 Características Principales

### 👤 Autenticación de Usuarios
- Registro de nuevos usuarios
- Login con contraseñas hasheadas (password_hash)
- Logout seguro
- Protección de rutas con filtros
- Sesiones de usuario

### 📦 Gestión de Productos
- **CRUD completo** (Crear, Leer, Actualizar, Eliminar)
- Modal de formulario para crear/editar productos
- Validación de datos en el lado del servidor
- Productos filtrados por usuario propietario
- Carga de imágenes de producto
- Previsualizaciones de imágenes en tiempo real

### 🏷️ Gestión de Categorías
- Crear categorías dinámicamente
- Asignar múltiples categorías a productos
- Modal dedicada para gestionar categorías de cada producto
- Crear nuevas categorías sin salir del modal
- Auto-selección de categorías recién creadas
- Relación muchos-a-muchos (many-to-many)

### 📊 Interfaz de Usuario
- Dashboard AdminLTE 3.2.0
- DataTables con búsqueda, ordenamiento y paginación
- Diseño responsivo con Bootstrap 4
- Iconos Font Awesome 6.0
- Interfaz limpia y moderna

### 🔒 Seguridad
- URLs limpias sin `index.php` (URL Rewriting)
- Filtros de autenticación en rutas protegidas
- Validación de CSRF con tokens
- Validación de propiedad de recursos (usuario solo ve sus productos)
- Contraseñas hasheadas con bcrypt

## 📋 Requisitos del Sistema

- **PHP 7.4+** (Tested en 7.4.8)
- **MySQL 5.7+** (Tested en 5.7.33)
- **Composer**
- **Apache 2.4** con módulo `mod_rewrite` habilitado

## 🚀 Instalación

### 1. Clonar el repositorio
```bash
git clone https://github.com/tuusuario/ci4withia.git
cd ci4withia
```

### 2. Instalar dependencias
```bash
composer install
```

### 3. Configurar variables de entorno
Copia el archivo `.env` y configura tu base de datos:
```bash
cp env .env
```

Edita `.env` con tus credenciales:
```env
app.baseURL = 'http://localhost:8082/'

database.default.hostname = localhost
database.default.database = ci4test
database.default.username = root
database.default.password = 
database.default.DBDriver = MySQLi
database.default.port = 3306
```

### 4. Crear la base de datos
```bash
mysql -u root -e "CREATE DATABASE ci4test CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
```

### 5. Ejecutar migraciones
```bash
php spark migrate
```

### 6. Seedear datos iniciales (Opcional)
```bash
php spark db:seed UserSeeder
php spark db:seed CategorySeeder
```

### 7. Iniciar el servidor
```bash
php spark serve --port=8082
```

Accede a `http://localhost:8082`

## 📝 Credenciales de Demo

**Usuario:** admin@example.com  
**Contraseña:** password123

## 📁 Estructura del Proyecto

```
ci4withia/
├── app/
│   ├── Controllers/
│   │   ├── Auth.php              # Autenticación de usuarios
│   │   ├── Dashboard.php         # Dashboard principal
│   │   ├── Product.php           # CRUD de productos
│   │   └── Category.php          # Gestión de categorías
│   ├── Models/
│   │   ├── UserModel.php         # Modelo de usuarios
│   │   ├── ProductModel.php      # Modelo de productos
│   │   └── CategoryModel.php     # Modelo de categorías
│   ├── Views/
│   │   ├── layouts/
│   │   │   ├── admin.php         # Layout principal
│   │   │   └── auth.php          # Layout de autenticación
│   │   ├── auth/
│   │   │   ├── login.php         # Vista de login
│   │   │   └── register.php      # Vista de registro
│   │   ├── products/
│   │   │   └── index.php         # Listado y modales de productos
│   │   └── dashboard.php         # Dashboard view
│   ├── Database/
│   │   ├── Migrations/           # Migraciones de BD
│   │   └── Seeds/                # Seeders de datos
│   ├── Filters/
│   │   └── AuthFilter.php        # Filtro de autenticación
│   └── Config/
│       ├── Routes.php            # Rutas de la aplicación
│       ├── Filters.php           # Configuración de filtros
│       └── App.php               # Configuración general
├── public/
│   ├── uploads/
│   │   └── products/             # Imágenes de productos
│   ├── index.php                 # Punto de entrada
│   └── .htaccess                 # Configuración de reescritura
└── writable/                     # Archivos grabables (logs, cache)
```

## 🛣️ Rutas Disponibles

### Autenticación
- `GET /` - Redirige a login
- `GET /register` - Formulario de registro
- `POST /register` - Procesar registro
- `GET /login` - Formulario de login
- `POST /login` - Procesar login
- `GET /logout` - Cerrar sesión

### Dashboard (Protegido)
- `GET /dashboard` - Panel principal

### Productos (Protegido)
- `GET /products` - Listar productos del usuario
- `GET /products/create` - Formulario crear producto
- `POST /products/store` - Guardar producto
- `GET /products/{id}/edit` - Obtener datos de producto
- `POST /products/{id}/update` - Actualizar producto
- `GET /products/{id}/delete` - Eliminar producto

### Categorías (Protegido)
- `POST /categories/store` - Crear nueva categoría
- `GET /products/{id}/categories` - Obtener categorías del producto
- `POST /products/{id}/categories/update` - Guardar categorías del producto

## 💾 Base de Datos

### Tabla: users
```sql
- id (INT, Primary Key)
- name (VARCHAR)
- email (VARCHAR, Unique)
- password_hash (VARCHAR)
- created_at (TIMESTAMP)
- updated_at (TIMESTAMP)
```

### Tabla: categories
```sql
- id (INT, Primary Key)
- name (VARCHAR, Unique)
- slug (VARCHAR, Unique)
- description (LONGTEXT)
- created_at (TIMESTAMP)
- updated_at (TIMESTAMP)
```

### Tabla: products
```sql
- id (INT, Primary Key)
- user_id (INT, Foreign Key → users)
- name (VARCHAR)
- slug (VARCHAR)
- sku (VARCHAR, Unique)
- description (LONGTEXT)
- price (DECIMAL)
- offer_price (DECIMAL, NULL)
- brand (VARCHAR)
- type (VARCHAR)
- image (VARCHAR, NULL)
- stock (INT)
- status (ENUM: active, inactive)
- created_at (TIMESTAMP)
- updated_at (TIMESTAMP)
```

### Tabla: product_category
```sql
- id (INT, Primary Key)
- product_id (INT, Foreign Key → products)
- category_id (INT, Foreign Key → categories)
- Unique constraint: (product_id, category_id)
```

## 🎨 Tecnologías Utilizadas

- **Backend:** CodeIgniter 4.4.8
- **Frontend:** AdminLTE 3.2.0, Bootstrap 4.6.0
- **DataTables:** 1.13.4
- **jQuery:** 3.6.0
- **Font Awesome:** 6.0.0
- **Base de Datos:** MySQL 5.7+
- **Servidor:** Apache con mod_rewrite

## 📋 Funcionalidades AJAX

Todas las operaciones principales utilizan AJAX para mejor UX:

- ✅ Crear/editar/eliminar productos sin recargar
- ✅ Crear categorías dinámicamente
- ✅ Asignar categorías a productos
- ✅ Previsualización de imágenes en tiempo real
- ✅ Validación del lado del servidor con respuestas JSON

## 🔍 Validaciones

### Productos
- **Nombre:** Requerido, 3-150 caracteres
- **SKU:** Requerido, 3-50 caracteres, único
- **Precio:** Requerido, numérico, mayor a 0
- **Imagen:** JPG, PNG, GIF (máx 5MB)

### Categorías
- **Nombre:** Requerido, 3-100 caracteres, único

### Usuarios
- **Email:** Requerido, válido, único
- **Contraseña:** Requerido, 6+ caracteres

## 🔐 Seguridad

- URLs limpias sin `index.php`
- CSRF protection con tokens
- Password hashing con PHP's password_hash()
- Autenticación basada en sesiones
- Protección de rutas con filtros
- Validación de propiedad de recursos
- Sanitización de entrada de datos

## 📸 Carga de Imágenes

- Ubicación: `public/uploads/products/`
- Nombres de archivo: Aleatorios para evitar conflictos
- Validación: Tipos MIME, tamaño máximo
- Eliminación automática al reemplazar/eliminar producto

## 🤝 Contribuciones

Las contribuciones son bienvenidas. Por favor:

1. Fork el repositorio
2. Crea una rama para tu feature (`git checkout -b feature/AmazingFeature`)
3. Commit tus cambios (`git commit -m 'Add some AmazingFeature'`)
4. Push a la rama (`git push origin feature/AmazingFeature`)
5. Abre un Pull Request

## 📄 Licencia

Este proyecto está bajo la licencia MIT. Ver `LICENSE` para más detalles.

## 👨‍💻 Desarrollo

### Stack de desarrollo
- Visual Studio Code
- Laragon (Servidor local)
- MySQL Workbench (Administración BD)
- Postman (Testing de APIs)

### Próximas mejoras planeadas
- [ ] Roles de usuario (admin, manager, viewer)
- [ ] Filtrado de productos por categoría
- [ ] Operaciones en lote
- [ ] Búsqueda avanzada
- [ ] Exportar a CSV/Excel
- [ ] Sistema de órdenes
- [ ] Notificaciones de inventario
- [ ] Reportes y Analytics

## 📞 Soporte

Para reportar bugs o solicitar features, abre un issue en el repositorio.

## 🤖 Prompts Utilizados en el Desarrollo

Este proyecto fue desarrollado utilizando prompts de IA para guiar la implementación de característica. A continuación se muestran los prompts utilizados (con semántica y gramática corregidas):

### 1. Filtrado de Productos por Usuario
**Prompt Original:**
> "Disculpa, se me olvidó solicitarte que los productos que se muestren solamente sean los del usuario que registró esos productos"

**Resultado:** Implementación de filtrado de productos basado en `user_id`. Ahora cada usuario solo ve y puede gestionar sus propios productos.

---

### 2. Renderización de Imágenes en DataTable y Modal
**Prompt Original:**
> "Ya vienen los rusos, por ti Copilot, ayúdame renderizando la imagen del producto en el DataTable en el campo imagen, y en la ventana modal que se renderice la imagen cuando se carga la ventana"

**Resultado:** 
- Imágenes en miniatura (60x60px) en el DataTable
- Previsualización en tiempo real en el modal (250x250px)
- Carga automática de imagen actual al editar producto

---

### 3. URLs Limpias sin `index.php`
**Prompt Original:**
> "¿Es posible ocultar `index.php` de las solicitudes sin afectar el funcionamiento actual y poner en riesgo la seguridad del sitio?"

**Resultado:** Configuración de URL rewriting con `.htaccess` y actualización de `App.php` para generar URLs limpias y seguras.

---

### 4. Auto-selección de Categoría Creada
**Prompt Original:**
> "Good job baby, excelente implementación, solo falta agregar automáticamente en el select la categoría creada, ¿se puede?"

**Resultado:** Después de crear una categoría, se auto-selecciona automáticamente en el dropdown para facilitar su asignación al producto.

---

### 5. CRUD Dinámico de Categorías
**Prompt Original:**
> "Excelente implementación, crea un flujo CRUD para registrar nuevas categorías de productos para hacer dinámico el flujo de registro de categorías. Activa un enlace de las categorías de los productos en el DataTable que abra una modal y muestre las categorías del producto y que puedas agregar nuevas categorías en el modal que se refleje automáticamente para seleccionar la nueva categoría"

**Resultado:**
- Modal dedicada para gestionar categorías de cada producto
- Crear nuevas categorías sobre la marcha sin salir del modal
- Agregar/remover categorías del producto
- Nuevo controlador `Category.php` con métodos AJAX
- Auto-actualización del dropdown de categorías

---

### 6. Documentación y Publicación en GitHub
**Prompt Original:**
> "Te mando un besito, me estoy enamorando, crea la documentación del sistema en un README, posteriormente conéctate a mi GitHub y pushea el proyecto en un nuevo repositorio llamado ci4withia"

**Resultado:**
- README completo con documentación detallada
- Inicialización de repositorio git
- Commit inicial del proyecto
- Instrucciones para publicar en GitHub

---

### 7. Inclusión de Prompts en la Documentación
**Prompt Original:**
> "Excelente README, ¿es posible agregar los prompts que usamos en este proyecto en el README? Por favor, ¡si se puede realizar! Verifica la semántica y gramática de los prompts utilizados"

**Resultado:** Sección actual que documenta todos los prompts utilizados con correcciones gramaticales y semánticas, demostrando el flujo iterativo de desarrollo con IA.

---

## 💡 Aprendizajes Clave

Este proyecto demuestra cómo:
- **Prompts iterativos** pueden guiar el desarrollo de caractéristicas complejas
- **La IA y el desarrollador en colaboración** pueden crear soluciones robustas
- **La documentación clara de prompts** facilita la reproducibilidad y comprensión del proyecto
- **Las correcciones gramaticales en prompts** mejoran la precisión en la implementación

---

**Desarrollado con ❤️ y mucho café** ☕

Hecho por: **CodeIgniter 4 + IA**
