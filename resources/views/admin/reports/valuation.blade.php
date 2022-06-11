<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <!-- CSS only -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
          integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <!-- Theme style -->
    <style>

        @page {
            margin: 30px 25px;
        }

        .titulo {
            font-family: Helvetica Neue, Helvetica, Arial, sans-serif;
            margin-top: 0px;
            margin-bottom: 8px;
            font-size: 28px;
        }

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
            line-height: 19px;
        }

        .image {
            width: 200px;
            height: 200px;
            margin-right: 20px;
            margin-top: 20px;
        }

        footer {
            position: fixed;
            bottom: 0cm;
            left: 0cm;
            right: 0cm;
            height: 1.2cm;

            /** Extra personal styles **/
            background-color: #007bff;
            color: white;
            text-align: center;
            line-height: 19px;
        }


        .signature {
            border: 0;
            border-bottom: 1px solid #000;
            margin-left: 20px;
        }

        .signature2 {
            border: 0;
            border-bottom: 1px solid #000;
            margin-left: 40px;
        }

        .info-panel {
            width: 100%;
            padding-top: 100px;
            text-align: left;
        }

        .info-panel p {
            text-align: left;
        }


    </style>

    <title>Detalles de Presupuesto - {{ $valuation['code'] }}</title>
</head>
<body>
{{--<header>--}}
{{--    <div class="col-12 ">--}}
{{--        <div class="">--}}
{{--            <img class="image" src="{{ asset('assets/Logo.png') }}" alt="" srcset="">--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</header>--}}
{{--<footer>--}}
{{--    <b>Correos: </b> info@guerreronic.com--}}
{{--    <br>--}}
{{--    <b>Visítanos: </b> guerreronic.com--}}
{{--    </p>--}}
{{--</footer>--}}

{{--<br>--}}
{{--<br>--}}
<main>

    @php
        $currency = new \App\Services\CurrencyService();
    @endphp

    <div class="wrapper pr-4">
        <!-- Main content -->
        <p style="page-break-after: never;">
        <section class="invoice">
            <!-- title row -->
            <div class="row align-items-center">

                <div class="col-12 text-center">
{{--                    <div class="info-panel">--}}
{{--                        <p><b>Dirección: </b> Raspados Loli del Zúmen 2 cuadras al Oeste y 1 Cuadra al Norte--}}
{{--                            <br> <b>Teléfonos: </b>2254 3268 - 8465 3772 - 8252 8361--}}
{{--                            <br>--}}
{{--                            <b>RUC: </b> 570-221166-0000Y--}}
{{--                        </p>--}}
{{--                    </div>--}}
                    <div class="titulo">
                        <span class="text-secondary">Detalles del Presupuesto</span>
                    </div>
                </div>
            </div>

            <!-- title row -->
            <div class="row">
                <div class="col-12">
                    <h5>
                        <small
                            class="float-right"><b>Fecha: </b>{{ \Illuminate\Support\Carbon::parse($valuation['created_at'])->translatedFormat('d F Y') }}
                        </small>
                    </h5>
                </div>
                <!-- /.col -->
            </div>
            <!-- info row -->
            <div class="mt-2 row invoice-info">
                <div class="col-sm-12 invoice-col">

                    <address>
                        <strong>Paciente:</strong> {{ $valuation->patient->name }}<br>
                        <b>Tratamiento</b>:{{ $valuation->description }}<br>
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
                            <th class="text-center">Cantidad</th>
                            <th class="text-center">Subtotal</th>
                        </tr>
                        </thead>
                        <tbody>

                        @forelse($valuation->procedures as $procedure)
                            <tr>
                                <td>{{ $procedure['name'] }}</td>
                                <td class="text-center">{{ $currency->getPriceSymbol().' '.$procedure[$currency->getPriceField()] }}</td>
                                <td class="text-center">{{ $procedure['pivot']['amount'] }}</td>
                                <td class="text-center">{{ $currency->getPriceSymbol().' '.(($procedure->pivot->{$currency->getPriceField()} * $procedure->pivot->amount) * ((100 - $procedure->pivot->discount) / 100)) }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-center" colspan="5">No hay procedimientos o servicios registrados</td>
                            </tr>
                        @endforelse


                        </tbody>
                    </table>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <br>

            @php
                $total = 0;
                $total = collect($valuation->procedures)->reduce(function ($total, $procedure) use ($currency) {
                                return $total + (($procedure->pivot->{$currency->getPriceField()} * $procedure->pivot->amount) * ((100 - $procedure->pivot->discount) / 100));
                            }, 0) + $valuation->{$currency->getPriceField()};
            @endphp

            <div class="row">
                <div class="col-12">
                    <div class="mt-2 mb-5 row">
                        <!-- /.col -->
                        <div class="ml-auto col-6">
                            <div class="table-responsive">
                                <table class="table table-sm">
                                    <tr>
                                        <th style="width:50%">Precio consulta:</th>
                                        <td class="text-right">{{ $currency->getPriceSymbol().' '.$valuation->{$currency->getPriceField()} }}</td>
                                    </tr>
                                    <tr>
                                        <th>Precio Servicios</th>
                                        <td class="text-right">{{ $currency->getPriceSymbol().' '.$total }}</td>
                                    </tr>
                                    <tr>
                                        <th>Total:</th>
                                        <td class="text-right"><b>{{  $currency->getPriceSymbol().' '.$total + $valuation->{$currency->getPriceField()} }}</b></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->

                </div>
            </div>
            </p>


            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
</main>
</body>
</html>
