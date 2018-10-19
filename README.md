# nequi-api-client-php #

### Ejemplo para el consumo del API de Nequi en PHP  ###

Forked from [https://github.com/nequibc/nequi-api-client-php](https://github.com/nequibc/nequi-api-client-php "https://github.com/nequibc/nequi-api-client-php")

## TODO: ##

Crear archivo *keys.php* con la siguiente configuración:

```php
<?php	
    $apikey = '';
    $secretKey = '';
    $access_key = '';
    $phoneNumber = '';
?>
```

## Consulta: ##

Por alguna razón siempre que ejecuto el script *index.php* desde la línea de comandos:

`php index.php`

Siempre me trae la siguiente respuesta:

```json
{
    "ResponseMessage": {
        "ResponseHeader": {
            "Channel": "MF-001",
            "ResponseDate": "2018-10-19T17:18:13.888Z",
            "Status": {
                "StatusCode": "20-05A",
                "StatusDesc": "¡Parámetros incorrectos!"
            },
            "MessageID": "153998749",
            "ClientID": "12345"
        },
        "ResponseBody": {
            "any": {}
        }
    }
}
```

No parece error de autenticación porque al validar el cliente con mi celular me dice que está bien, el problema siempre es consumiendo el servicio de código QR, ¿Tienen alguna idea de por qué será?

El ejemplo de su documentación tampoco lo he podido correr, pueden hacer pull request si gustan.

¡Muchas gracias!