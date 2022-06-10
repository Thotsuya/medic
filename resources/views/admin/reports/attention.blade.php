<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <!-- CSS only -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ public_path('/assets/dist/css/alt/adminlte.components.min.css') }}">
    <!-- Theme style -->
    <style>

        @page {
            margin: 30px 25px;
        }

        .wrapper{
            padding-right: 2rem;
        }

        .titulo{
            font-family: Helvetica Neue,Helvetica,Arial,sans-serif;
            margin-top: 95px;
            margin-bottom: 25px;
            font-size: 28px;
        },

        .report_title {
            padding-bottom: 40px;
        }

        header {
            position: fixed;
            top: -20px;
            left: 0px;
            right: 0px;
            height: 2.1cm;

            /** Extra personal styles **/
            color: white;
            text-align: center;
            line-height:19px;
        }

        .image {
            width: 200px;
            height: 200px;
            margin-right: 20px;
            margin-top:20px;
        }

        footer {
            position: fixed;
            bottom: 0cm;
            left: 0cm;
            right: 0cm;
            height: 2cm;

            /** Extra personal styles **/
            background-color: #007bff;
            color: white;
            text-align: center;
            line-height:19px;
        }

    </style>

    <title>Detalles de Atencion - {{ $attention->attention['code'] }}</title>
</head>
<body>
<header>
    <div class="col-12 ">
        <div class="">
            <img class="image" src="{{ public_path('/assets/Logo.png') }}" alt="" srcset="">
        </div>
    </div>
</header>
<footer>
    Managua, Nicaragua. <b>Dirección: </b> Raspados Loli del Zúmen 2 cuadras al Oeste y 1 Cuadra al Norte <b>Teléfonos: </b>2254 3268 - 8465 3772 - 8252 8361
    <br>
    <b>Correos: </b> info@guerreronic.com
    <br>
    <b>Visítanos: </b> guerreronic.com
    </p>
</footer>
<br>
<br>
<main>

    @php
        $currency = new \App\Services\CurrencyService();
    @endphp

    <div class="wrapper">
        <!-- Main content -->
        <p style="page-break-after: never;">
        <section class="invoice">
            <!-- title row -->
            <div class="row align-items-center">

                <div class="col-12 text-center">
                    <div class="titulo">
                        <span class="text-secondary">Detalles del Plan de Tratamiento</span>
                    </div>
                </div>
            </div>

            <!-- title row -->
            <div class="row">
                <div class="col-12">
                    <h5>
                        <small class="float-right"><b>Fecha: </b>{{ $attention->attention['start_date_formatted'] }}</small>
                    </h5>
                </div>
                <!-- /.col -->
            </div>
            <!-- info row -->
            <div class="row invoice-info">
                <div class="col-sm-12 invoice-col">

                    <address>
                        <strong>Paciente:</strong> {{ $attention->attention['patient']['name'] }}<br>
                        <b>Tratamiento</b>:{{ $attention->attention['description'] }}<br>
                    </address>
                </div>

            </div>
            <!-- /.row -->

            <br>
            <br>
            <!-- Table row -->
            <div class="row">
                <div class="col-12 table-responsive">
                    <table class="table table-striped table-sm">
                        <thead>
                        <tr class="table-secondary">
                            <th class="text-center">Procedimiento / Servicio</th>
                            <th class="text-center">Precio</th>
                            <th class="text-center">Descuento</th>
                            <th class="text-center">Cantidad</th>
                            <th class="text-center">Subtotal</th>
                        </tr>
                        </thead>
                        <tbody>

                        @forelse($attention->attention['procedures'] as $procedure)
                            <tr>
                                <td>{{ $procedure['name'] }}</td>
                                <td class="text-center">{{ $currency->getPriceSymbol() }} {{ $procedure['pivot'][$currency->getPriceField()] }}</td>
                                <td class="text-center">{{ $procedure['pivot']['discount'] }}%</td>
                                <td class="text-center">{{ $procedure['pivot']['amount'] }}</td>
                                <td class="text-center">{{ $currency->getPriceSymbol() }} {{ ($procedure['pivot'][$currency->getPriceField()] * $procedure['pivot']['amount']) * ((100 - $procedure['pivot']['discount'])/100) }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-center" colspan="5">No hay procedimientos o servicios registrados</td>
                            </tr>
                        @endforelse ($procedures as $procedure)



                        </tbody>
                    </table>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <br>
            <br>
            <div class="mb-2 row">
                <div class="col-12">
                    <b>Pagos Registrados:</b>
                </div>
            </div>

            <div class="row">
                <div class="col-12 table-responsive">
                    <table class="table table-striped table-sm">
                        <thead>
                        <tr class="table-secondary">
                            <th class="text-center">Monto</th>
                            <th class="text-center">Método</th>
                            <th class="text-center">Tratamiento</th>
                            <th class="text-center">Fecha</th>
                        </tr>
                        </thead>
                        <tbody>

                        @forelse($attention->attention['payments'] as $payment)
                            <tr>
                                <td class="text-center">{{ $currency->getPriceSymbol() }} {{ $payment['unformatted_amount'] }}</td>
                                <td class="text-center">
                                    <span class="badge badge-info mt-1">{{ \App\Models\Payment::METHODS[$payment['payment_method']] }}</span>
                                </td>
                                <td class="text-center">{{ $payment['description'] }}</td>
                                <td class="text-center">{{ \Carbon\Carbon::parse($payment['created_at'])->format('d F Y g:i') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-center" colspan="4">Aún no se han registrado pagos para este plan de tratamiento</td>
                            </tr>
                        @endforelse ()



                        </tbody>
                    </table>
                </div>
            </div>


            <div class="row">
                <!-- /.col -->
                <div class="ml-auto col-6">
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <tr>
                                <th style="width:50%">Precio consulta:</th>
                                <td class="text-right">{{ $attention->attention['price_formatted'] }}</td>
                            </tr>
                            <tr>
                                <th>Precio Servicios</th>
                                <td class="text-right">{{ $currency->getPriceSymbol().' '.$attention->attention['subtotal_unformatted'] }}</td>
                            </tr>
                            <tr>
                                <th>Total:</th>
                                <td class="text-right"><b>{{ $currency->getPriceSymbol() }} {{ $attention->attention['total_unformatted'] }}</b></td>
                            </tr>
                            <tr>
                                <th>Abonado:</th>
                                <td class="text-right">{{ $currency->getPriceSymbol() }} {{ collect($attention->attention['payments'])->reduce(fn($carry,$item) => $carry + $item[$currency->getAmountField()],0) }}</td>
                            </tr>
                            <tr>
                                <th>Saldo:</th>
                                @php
                                    $balance = $attention->attention['total_unformatted'] - collect($attention->attention['payments'])->reduce(fn($carry,$item) => $carry + $item[$currency->getAmountField()],0);
                                    if($balance < 0 || $attention->attention['status'] == \App\Models\Attention::DONE) $balance = 0;
                                @endphp
                                <td class="text-right">{{ $currency->getPriceSymbol() }} {{ $balance }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->


            </p>


            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
</main>
</body>
</html>
