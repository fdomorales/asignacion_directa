@extends('inicio')
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli:300,400,400i,600,700">
    <link rel="stylesheet" id="css-main" href="{{ asset('assets/css/codebase.min.css') }}">

    <!-- You can include a specific file from css/themes/ folder to alter the default color theme of the template. eg: -->
    <!-- <link rel="stylesheet" id="css-theme" href="assets/css/themes/flat.min.css"> -->
    
    
    <link rel="stylesheet" id="css-theme" href="{{ asset('assets/css/themes/corporate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/select2.min.css') }}"/>
</head>

@section('contenido')

    <h2>Postulacion correcta</h2>
    <h4>Su postulación fue aceptada</h4>
    
</html>
@endsection