<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>
<div class="alert alert-info">
    <h1><span class="badge badge-danger"> {{ __('email/shopRegister.intro') }}</span></h1>
    <h3><span clase ="badge badge-warning"> {{ __('email/shopRegister.body') }}</span></h3>
    <a class="btn btn-outline-success" href="{{ url('/verify/shop/' . $activation_code) }}" >{{ __('email/shopRegister.button') }}</a>
</div>
</body>
</html>