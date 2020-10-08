<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="with=device-width, initial-scale=1.0">
        <title>Crear Contraseña</title>
    </head>
    <body>
    Hola <b>{{$person->nombre}}</b>, se te ha otorgado un acceso para el area de: <br>
    <b>{{$role->name}}</b> tendras acceso mediante el correo de <b>{{$username}}</b> <br>
    Ingresa al siguiente link para crear una contraseña para su correo: <br>
    http://localhost:4200/#/nueva-contraseña/{{$token}}
    <a href="http://localhost:4200/#/nueva-contraseña/{{$token}}">Crear Contraseña</a>
    </body>
</html>