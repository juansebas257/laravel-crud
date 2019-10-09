<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>GestionDB - UCC</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>
<body>
<div class="">
    <div class="content">
        <br>
        <h2 class="text-center">
            GestionBD
        </h2>
        <p class="text-center">por: Sebastián Jimenez, Nayiby Silva y Dayana Morales - Universidad Cooperativa de Colombia</p>

        <div class="container">

            <!-- tabla de clientes -->
            <h4 class="text-center">Clientes</h4>
            <a href="{{ route('customer.create') }}" class="btn btn-primary" style="color: #fff">Nuevo cliente</a>
            <table class="table table-striped table-condensed table-bordered">
                <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Documentp</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellido</th>
                    <th scope="col">Teléfono</th>
                    <th scope="col">Celular</th>
                    <th scope="col">Correo</th>
                    <th scope="col">Dirección</th>
                    <th scope="col">Observaciones</th>
                    <th>Opciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach($customers as $customer)
                    <tr>
                        <th scope="row">{{ $customer->id }}</th>
                        <td>{{ $customer->document }}</td>
                        <td>{{ $customer->name }}</td>
                        <td>{{ $customer->lastname }}</td>
                        <td>{{ $customer->phone }}</td>
                        <td>{{ $customer->mobile }}</td>
                        <td>{{ $customer->email }}</td>
                        <td>{{ $customer->address }}</td>
                        <td>{{ $customer->observations }}</td>
                        <td>
                            <form action="{{ route('customer.destroy', $customer->id) }}" method="post">
                                <input name="_method" type="hidden" value="DELETE">
                                @csrf
                                <a href="{{ route('customer.edit', $customer->id) }}" class="btn btn-success btn-sm" style="color:#fff"><i class="fa fa-pencil"></i></a>
                                <button class="btn btn-danger btn-sm" style="color:#fff"><i class="fa fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <br>
            <br>
            <!-- tabla de log -->
            <h4 class="text-center">Log</h4>
            <table class="table table-striped table-condensed table-bordered">
                <thead>
                <tr>
                    <th scope="col">IdCliente</th>
                    <th scope="col">Operación</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Último id</th>
                    <th scope="col">Último documento</th>
                    <th scope="col">Último activo</th>
                    <th scope="col">Nuevo id</th>
                    <th scope="col">Nuevo documento</th>
                    <th scope="col">Nuevo activo</th>
                </tr>
                </thead>
                <tbody>
                @foreach($logs as $log)
                    <tr>
                        <th scope="row">{{ $log->customer }}</th>
                        <td>{{ $log->operation }}</td>
                        <td>{{ $log->operation_date }}</td>
                        <td>{{ $log->last_id }}</td>
                        <td>{{ $log->last_document }}</td>
                        <td>{{ $log->last_active }}</td>
                        <td>{{ $log->new_id }}</td>
                        <td>{{ $log->new_document }}</td>
                        <td>{{ $log->new_active }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>


        </div>
    </div>
</div>
</body>
</html>
