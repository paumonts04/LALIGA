# ⚽ LaLiga Stats

> Aplicación web de estadísticas de la Liga Española de Fútbol desarrollada como proyecto de fin de ciclo superior.

---

## 📋 Descripción

LaLiga Stats es una aplicación web que permite consultar estadísticas detalladas de la Liga Española de Fútbol (LaLiga). Los usuarios pueden explorar datos de equipos, jugadores, partidos y clasificaciones de forma visual e intuitiva.

---

## 🚀 Funcionalidades

- 📊 Clasificación actualizada de la temporada
- 👟 Estadísticas de jugadores (goles, asistencias, minutos jugados...)
- 🏟️ Información y estadísticas por equipo
- 📅 Resultados y calendario de partidos
- 🔍 Búsqueda de jugadores y equipos

---

## 🛠️ Tecnologías utilizadas

| Tecnología | Uso |
|------------|-----|
| HTML5 | Estructura de la web |
| CSS3 | Estilos y diseño |
| JavaScript | Interactividad y lógica del cliente |
| PHP | Lógica del servidor y gestión de datos |

---

## 📁 Estructura del proyecto

```
laliga-stats/
├── index.php
├── css/
│   └── styles.css
├── js/
│   └── main.js
├── php/
│   ├── conexion.php
│   └── ...
├── img/
└── README.md
```

> ⚠️ Adapta la estructura según cómo tengáis organizado vuestro proyecto.

---

## ⚙️ Instalación y uso

### Requisitos previos

- Servidor local con soporte PHP (XAMPP, WAMP, Laragon...)
- PHP 7.4 o superior
- Navegador web moderno

### Pasos

1. **Clona el repositorio**
   ```bash
   git clone https://github.com/tu-usuario/LALIGA.git
   ```

2. **Mueve el proyecto a la carpeta del servidor**
   ```bash
   # En XAMPP, por ejemplo:
   mv LALIGA/ /xampp/htdocs/
   ```

3. **Importa la base de datos** *(si aplica)*
   - Abre phpMyAdmin
   - Crea una base de datos llamada `liga`
   - Importa el archivo `database/liga.sql`

4. **Configura la conexión** *(si aplica)*
   - Edita `php/conexion.php` con tus credenciales locales

5. **Accede desde el navegador**
   ```
   http://localhost/LALIGA/
   ```

---

## 👥 Equipo

| Nombre | GitHub |
|--------|--------|
| Santiago | [@Santiago](https://github.com/Santiago) |
| Pau | [@Pau](https://github.com/Pau) |
| Nicolas | [@Nicolas](https://github.com/Nicolas) |

---

## 📄 Licencia

Este proyecto ha sido desarrollado con fines educativos como proyecto de fin de ciclo superior.

---

*Proyecto desarrollado como parte del Ciclo Superior de Desarrollo de Aplicaciones Web (DAW) / Desarrollo de Aplicaciones Multiplataforma (DAM).*
