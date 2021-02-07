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

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
