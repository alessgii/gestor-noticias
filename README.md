# 📰 Panel de Administración de Noticias — Teleinformática UdeG

> Herramienta de gestión de contenidos (CMS ligero) para simplificar el flujo de publicación de noticias en el portal oficial de la Licenciatura en Ingeniería en Teleinformática.

[![Estado](https://img.shields.io/badge/Estado-En_Desarrollo-orange?style=for-the-badge&logo=git)](https://github.com/)
[![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://www.php.net/)
[![MariaDB/MySQL](https://img.shields.io/badge/MariaDB-003545?style=for-the-badge&logo=mariadb&logoColor=white)](https://mariadb.org/)
[![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)](https://tailwindcss.com/)

---

## 🎯 Motivación y Problema que Resuelve

Actualmente, publicar una nueva noticia o boletín en la página web de la carrera requiere editar archivos manualmente o realizar procedimientos complejos que desmotivan la participación. 

Este proyecto nace como una iniciativa dentro del **Club de Programación de Teleinformática** para automatizar y facilitar esta labor. Con este panel, cualquier integrante autorizado o administrador del sitio podrá:
- Redactar y dar formato a noticias de manera intuitiva.
- Subir imágenes e información relevante sin tocar código.
- Publicar directamente los cambios a la base de datos de la web de la carrera.

---

## 🚀 Estado del Proyecto

Actualmente el proyecto se encuentra en **fase inicial de desarrollo (Layout & UI)**:
- [x] Estructura base de vistas e interfaz de usuario.
- [x] Maquetación responsiva con Tailwind CSS (vía CDN para maquetación rápida).
- [ ] Modelado y conexión con la base de datos MariaDB / MySQL.
- [ ] Módulo de autenticación y sesiones de usuario.
- [ ] CRUD completo de noticias (Crear, Leer, Editar, Eliminar).
- [ ] Subida de archivos multimedia / imágenes de cabecera.

---

## 🛠️ Tecnologías y Herramientas

* **Servidor Web:** Apache (`httpd`)
* **Lenguaje Backend:** PHP (Lógica de negocio y controladores)
* **Base de Datos:** MySQL / MariaDB
* **Estilos & UI:** Tailwind CSS (CDN para prototipado)
* **Control de Versiones:** Git & GitHub

---

## 📂 Estructura del Repositorio

```text
gestor-noticias/
├── assets/          # Hojas de estilo personalizadas, scripts e imágenes públicas
│   └── css/
├── config/          # Configuración de base de datos y parámetros del entorno
├── controllers/     # Procesadores de lógica de negocio (guardar, editar, eliminar)
├── index.php        # Vista principal / Dashboard
└── README.md        # Documentación del repositorio
```

---

## ⚙️ Requisitos e Instalación Local

### Requisitos previos
* Servidor web Apache con PHP habilitado (XAMPP, LAMP o instalación nativa de `httpd`).
* Servidor de base de datos MariaDB o MySQL.

### Pasos de configuración

1. **Clonar el repositorio** dentro de tu directorio raíz de Apache (`htdocs` o `/var/www/html`):
   ```bash
   git clone https://github.com/alessgii/gestor-noticias.git
   ```

2. **Iniciar servicios**:
   Asegúrate de que Apache y MariaDB/MySQL estén activos.

3. **Acceder desde el navegador**:
   Abre tu navegador e ingresa a:
   ```text
   http://localhost/gestor-noticias/
   ```

---

## 🤝 Créditos y Colaboración

Proyecto desarrollado y mantenido como una contribución para la **Licenciatura en Ingeniería en Teleinformática** a través del **Club de Programación**.

* **Desarrollador principal:** Hugo Guzmán