# _Libreria de Viejo_

Es una aplicación web para venta, préstamo e intercambio de libros así como la venta de plantas
Fue elaborado para la Fundación [casacem]

# Características

- Maneja roles de usuario básicos
- Crea Códigos de barras descargables para libros cuyos ISBN's no esten presentes a la hora de registrarlos en la plataforma
- Tiene un modulo para el corte de caja con las ventas realizadas por cada vendedor y los montos a pagarles
- Cada usuario vendedor puede ver las ventas que ha realizado hasta el momento
- Se incluye un modulo para registrar las donaciones que se hacen o que se reciben
- Se incluye un modulo para registrar a los clientes frecuentes


# Tecnologías

<p align="center">
    <a href="https://laravel.com/" target="_blank" rel="noreferrer"> <img src="https://raw.githubusercontent.com/devicons/devicon/master/icons/laravel/laravel-plain-wordmark.svg" alt="laravel" width="40" height="40"/> </a>
    <a href="http://jquery.com" target="_blank" rel="noreferrer"> <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/jquery/jquery-original.svg" alt="jquery" width="40" height="40"/> </a> 
    <a href="https://getbootstrap.com" target="_blank" rel="noreferrer"> <img src="https://raw.githubusercontent.com/devicons/devicon/master/icons/bootstrap/bootstrap-plain-wordmark.svg" alt="bootstrap" width="40" height="40"/> </a>
    <a href="https://mariadb.org/" target="_blank" rel="noreferrer"> <img src="https://www.vectorlogo.zone/logos/mariadb/mariadb-icon.svg" alt="mariadb" width="40" height="40"/> </a> 
</p>

- [Laravel] - Laravel 8 como tecnología principal (Backend)
- [AdminLTE2] - Como plantilla del panel de administración, se utiliza con bootstrap
- [Bootstrap] - Como framework de diseño responsivo css
- [JQuery] - Como tecnología principal para la interacción con el usuario
- [AJAX] - Como tecnología principal para la comunicación asincrona y hacer peticiones entre en frontend y el backend
- [DatatablesJS] - Para algunas tablas de las vistas
- [MySQL] - Como base de datos relacional


# Instalación y Requerimientos

## _requerimientos_

- php ^7.3
- composer ^2.2.4 

## _instalación_

```
1. Clona este repositorio con el comando `git clone repo`
2. Corre el comando `composer install`
3. Copia el archivo `.env.example` a `.env` y actualiza las variables de configuración como la base de datos
4. Corre `php artisan key:generate` para generar la app key
5. Corre `php artisan migrate --seed` para generar las migraciones y datos de prueba
```


[Laravel]: <https://laravel.com/docs/8.x>
[AdminLTE2]: <https://adminlte.io/themes/AdminLTE/index2.html>
[Bootstrap]: <https://getbootstrap.com/docs/4.1/getting-started/introduction/>
[JQuery]: <https://jquery.com/>
[AJAX]: <https://api.jquery.com/jquery.ajax/>
[DatatablesJS]: <https://datatables.net/>
[MySQL]: <https://dev.mysql.com/doc/>
[casacem]: <https://casacem.com/>