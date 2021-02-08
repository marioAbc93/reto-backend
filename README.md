## Reto de creacion de billetera virtual

Creación de servicios Rest y un servicio SOAP que servira de puente entre cliente y sevidor

## Funciones

La billetera permite:
- El registro de un usuario.
- Recargar el saldo de la billetera.
- Realizar pagos.
- Consultar saldo.

Los servicios Rest fueron desarrollados en Laravel 8.

## La Base de datos

- La base de datos es <strong>MySQL</strong>.
- Se utilizó <strong>ELOQUENT ORM</strong>

Se crearon dos entidades (Modelos), con sus respectivas migraciones donde se le dan parametros especificos a cada campo para cumplir con lo solicitado en el reto.

Las entidades son <strong> User </strong> donde registramos todos los datos del "usuario final" y la entidad <strong> Wallet</strong>
<img src="/public/base-de-datos.png">

## Controladores

Se crearon dos controladores: 
 - UserController   : en este se registran los datos del usuario
 - WalletController : en este se recarga dinero, se consulta saldo y se paga desde la billetera

<strong>NOTA:</strong> Cada metodo dentro del controlador tiene dentro la descripción de lo que realiza la logica que lo compone, así mismo, se describe en el archivo <strong>api.php</strong> ubicado en <strong>routes/api.php</strong> que solicitud resuelve cada ruta.

### Cliente web

El cliente web que se utilizó para enviar los parametros fue hecho con postman. La colección se encuentra aquí:


## Envio de correos electronicos

En el servicio REST que hace una compra, luego de guardas los datos la variable $mail, que crea el mailable, recibe como parametro los datos guardados en $wallet y estos son llevados a la plantilla del correo electronico por medio del constructor del mailable. 

Notas: 
- El servicio rest que envia el correo es el mismo que envia el mail.
- El archivo de plantilla de correo electronico puede ser encontrado en /resource/views/email/confirmacion.blade.php
- Para probar esta funcionalidad debe adecuar las variavles del archivo .env cambiando los datos que se encuentran por defecto y colocando los que proporciona mailtrap.io

## Servicio SOAP

http://127.0.0.1:8000/index.php/user/?wsdl

## Cliente web - Postman

Se creó un cliente web para enviar los parametros y probar la funcionalidad de cada servicio rest. 
En el encontrarán el titulo de cada una de las funcionalidades 

Notas: 
- para probar la consulta de saldo es necesario que se ingrese el mismo numero de identificacion (´document') que se ha ingresado para recargar la billetera, de lo contrario, no funcionará.
- para probar la funcionalidad del email se debe estar logueado en mailtrap tal como lo explicamos en la seccion donde documentamos la funcionalidad del envio de emails

link de la coleccion "reto": https://www.getpostman.com/collections/18eaddb066cbebcc4ff1

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
