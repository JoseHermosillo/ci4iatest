# CI4 with IA - Sistema de Gestión de Productos

Un sistema completo de gestión de productos con autenticación de usuarios, categorías dinámicas, carga de imágenes y administración de inventario. Construido con **CodeIgniter 4**, **AdminLTE**, **Bootstrap 4** y **DataTables**.

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

---

**Desarrollado con ❤️ y mucho café** ☕

Hecho por: **CodeIgniter 4 + IA**
