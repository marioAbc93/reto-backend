<p align="center">Reto de creación de billetera virtual</p>

<p align="center">Creación de servicios Rest y un servicio SOAP que servira de puente entre cliente y sevidor
</p>

## Funciones

La billetera permite:
- El registro de un usuario.
- Recargar el saldo de la billetera.
- Realizar pagos.
- Consultar saldo.

Los servicios Rest fueron desarrollados en Laravel 8.

## La Base de datos

Se crearon dos entidades (Modelos), con sus respectivas migraciones donde se le dan parametros especificos a cada campo para cumplir con lo solicitado en el reto.

Las entidades son <strong> User </strong> donde registramos todos los datos del "usuario final" y la entidad <strong> Wallet</strong>
<img src="/public/base-de-datos.png">

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[Many](https://www.many.co.uk)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- **[Curotec](https://www.curotec.com/)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
