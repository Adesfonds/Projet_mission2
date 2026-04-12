<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Bon de transport</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #333;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h1 {
            margin: 0;
            font-size: 22px;
        }

        .info {
            margin-bottom: 20px;
        }

        .info table {
            width: 100%;
        }

        .info td {
            padding: 5px;
        }

        .section-title {
            margin-top: 20px;
            margin-bottom: 10px;
            font-weight: bold;
            font-size: 14px;
            border-bottom: 1px solid #000;
        }

        table.data {
            width: 100%;
            border-collapse: collapse;
        }

        table.data th, table.data td {
            border: 1px solid #000;
            padding: 8px;
            text-align: center;
        }

        .footer {
            margin-top: 40px;
        }

        .signature {
            margin-top: 60px;
            display: flex;
            justify-content: space-between;
        }

        .signature div {
            width: 40%;
            text-align: center;
        }
    </style>
</head>
<body>

<!-- HEADER -->
<div class="header">
    <h1>BON DE TRANSPORT</h1>
    <p>N° : {{ $transport->id_transport }}</p>
</div>

<!-- INFOS GENERALES -->
<div class="info">
    <table>
        <tr>
            <td><strong>Date départ :</strong> {{ $transport->date_depart }}</td>
            <td><strong>Date arrivée :</strong> {{ $transport->date_arrivee ?? '—' }}</td>
        </tr>
        <tr>
            <td><strong>Destination :</strong> {{ $transport->destination }}</td>
            <td><strong>Statut :</strong> {{ $transport->statut_transport }}</td>
        </tr>
    </table>
</div>

<!-- CARGAISON -->
<div class="section-title"> Informations de la cargaison</div>

<table class="data">
    <thead>
    <tr>
        <th>ID Cargaison</th>
        <th>Volume</th>
        <th>Statut</th>
    </tr>
    </thead>
    @foreach($transport->cargaisons as $cargaison)
        <tr>
            <td>{{ $cargaison->id_cargaison }}</td>
            <td>{{ $cargaison->volume }}</td>
            <td>{{ $cargaison->statut }}</td>
        </tr>
    @endforeach
</table>

<!-- FOOTER -->
<div class="footer">
    <p><strong>Date d’édition :</strong> {{ now()->format('d/m/Y H:i') }}</p>
</div>

<!-- SIGNATURE -->
<div class="signature">
    <div>
        <p>Signature Expéditeur</p>
        <br><br>
        ______________________
    </div>

    <div>
        <p>Signature Réception</p>
        <br><br>
        ______________________
    </div>
</div>

</body>
</html>
