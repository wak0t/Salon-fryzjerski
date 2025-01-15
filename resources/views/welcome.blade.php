<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salon Fryzjerski</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container text-center mt-5">
        <h1>Witamy w Systemie Rezerwacji Salon Fryzjerski!</h1>
        <p class="lead">Zarezerwuj swoją wizytę już dziś i ciesz się profesjonalną obsługą!</p>
        <a href="/appointments" class="btn btn-primary mt-3">Zaloguj się aby zobaczyć dostępne wizyty</a>
        <a href="{{ route('register-form') }}" class="btn btn-primary">Zarejestruj się</a>
    </div>
</body>
</html>
