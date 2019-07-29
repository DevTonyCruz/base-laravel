<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

## Proyecto Arca

Proyecto desarrollado por Estrasol para fungir como base inicial de proyectos de software factory,
el desarrollo proporciona herramientas y moódulos iniciales de cualquier desarrollo interno.

Módulos Actuales

- Roles.
- Usuarios.
- Configuraciones.
- Categorías.
- Productos.
- Temas.
- Preguntas frecuentes.
- Páginas.

## Iniciar proyecto

Pasos para iniciar el proyecto:

- Crear fork del proyecto
- Ejecutar los siguientes comandos
~~~~
composer update
npm update
npm run dev
php artisan migrate
php artisan db:seed
~~~~

## Agregar permisos

Al crear un nuevo módulo se tiene que agregar los permisos del mismo, para esto se debe de agregar dentro
de la carpeta database/data/permissions un archivo json que internamente debe de contener la estructura con
los permisos de ese modulo.

Los permisos se tomas del nombre que se le asigana a las rutas de cada módulo. Ejemplo:

~~~~
Route::get('login', 'Web\Admin\Auth\LoginController@showLoginForm')->name('admin.login');  
NOMBRE DE LA RUTA "admin.login"
~~~~

Estructura de permisos

```json
[{
    "modulo": "Admin",
    "data": [{
        "name": "Dashboard",
        "controller": "Admin",
        "slug": "admin.home"
    }]
}]
```

Como se puede apreciar en la estructura el nombre de la ruta se coloca en 
el campos slug.

Después de haber realizado esto se debe ejecutar el siguiente comando:

~~~~
php artisan db:seed --class=PermissionsSeeder
~~~~

## Sepomex

A continuación se muestra como usar el apartado de sepomex en alguna vista.

En cuanto a la seccion de maquetación se tienen que seguir ciertas normas.

Se debe de indicar el nombre del contenedor en donde se encuentra los elementos que intervienen en este proceso.

Ejemplo:
~~~~
<div id="shipping"></div>
~~~~

El proceso se divide en cinco acciones:

1. Buscar mediante código postal
~~~~
<input type="text" class="zip-code" onkeyup="SepomexObject.searchZip('shipping')">
~~~~

2. Buscar mediante selector estados

~~~~
<select class="state-data" onchange="SepomexObject.getLocation('shipping', this.value);">
    <option value="S" selected="">Seleccionar</option>
</select>
~~~~

3. Buscar mediante selector municipios

~~~~
<select class="location-data" onchange="SepomexObject.getColony('shipping', this.value);">
    <option value="S" selected="">Seleccionar</option>
</select>
~~~~

4. Buscar mediante selector colonias

~~~~
<select class="location-data" onchange="SepomexObject.getColony('shipping', this.value);">
    <option value="S" selected="">Seleccionar</option>
</select>
~~~~

Este seria un ejemplo de la integración en una vista

~~~~
<div id="shipping">
    <div>
        <div>
            <h4>Editar registro</h4>

            <div class="">
                <label for="zip_shipping" >C.P.</label>
                <input type="text" placeholder="Ingrese su código postal" name="zip_shipping" id="zip_shipping"
                    class="zip-code" onkeyup="SepomexObject.searchZip('shipping')" require>
                <input type="hidden" class="sepomex-id" name="sepomex_shipping" id="sepomex_shipping" value="">
            </div>
            <div class="">
                <label for="state_shipping">Estado</label>
                <select class="state-data" id="state_shipping" name="state_shipping"
                    onchange="SepomexObject.getLocation('shipping', this.value);" require>
                    <option value="S" selected="">Seleccionar</option>
                </select>
            </div>
            <div class="">
                <label for="city_shipping">Municipio</label>
                <select class="location-data" id="city_shipping" name="city_shipping"
                    onchange="SepomexObject.getColony('shipping', this.value);" disabled require>
                    <option value="S" selected="">Seleccionar</option>
                </select>
            </div>
            <div class="">
                <label for="colony_shipping">Colonia</label>
                <select class="colony-data" id="colony_shipping" name="colony_shipping"
                    onchange="SepomexObject.getZipCode('shipping', this.value);" disabled require>
                    <option value="S" selected="">Seleccionar</option>
                </select>
            </div>

        </div>
    </div>
</div>
~~~~

Y se debe agregar una etiqueta ejecutando el metodo getStates al cargar la página

~~~~
<script type="text/javascript">
    window.onload=function() {        
        SepomexObject.getStates('shipping');        
    };
</script>
~~~~

Para cargar los datos es necesario ejecutar los siguientes comandos.

1. Ejecutar la migración de sepomex y sepomex_all

~~~~
php artisan migrate
~~~~

2 Ejecutar el seeder de sepomex

~~~~
php artisan db:seed --class=SepomesSeeder
~~~~

## Contribución

- Desarrollador: Antonio Tenorio
- Desarrollador: Rufino Santiago
- Desarrollador: David Chavez
- Desarrollador: Oscar García
- Tester: Fernando Chavez
