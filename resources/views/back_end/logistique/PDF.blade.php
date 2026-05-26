<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Bon de transport</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #2d2d2d;
            line-height: 1.5;
        }

        .container {
            padding: 20px;
        }

        .header {
            text-align: center;
            border-bottom: 2px solid #1f2937;
            padding-bottom: 15px;
            margin-bottom: 25px;
        }

        .header h1 {
            margin: 0;
            font-size: 22px;
        }

        .header p {
            margin: 5px 0 0;
            color: #6b7280;
        }

        .info table {
            width: 100%;
            border-collapse: collapse;
        }

        .info td {
            padding: 6px 4px;
        }

        .label {
            font-weight: bold;
        }

        .section-title {
            margin-top: 25px;
            margin-bottom: 10px;
            font-weight: bold;
            font-size: 13px;
        }

        table.data {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table.data th {
            background: #f3f4f6;
            border: 1px solid #000;
            padding: 8px;
        }

        table.data td {
            border: 1px solid #000;
            padding: 8px;
            text-align: center;
        }

        .footer {
            margin-top: 30px;
            font-size: 11px;
        }
    </style>
</head>

<body>

<div class="container">

    <!-- HEADER -->
    <div class="header">
        <h1>BON DE TRANSPORT</h1>
        <p>Vercorium Extraction & Modélisation (VEM)</p>
        <p><strong>N° :</strong> {{ $transport->id_transport }}</p>
    </div>

    <!-- INFOS -->
    <div class="info">
        <table>
            <tr>
                <td><span class="label">Date départ :</span> {{ $transport->date_depart }}</td>
                <td><span class="label">Date arrivée :</span> {{ $transport->date_arrivee ?? '—' }}</td>
            </tr>
            <tr>
                <td><span class="label">Destination :</span> {{ $transport->destination }}</td>
                <td><span class="label">Statut :</span> {{ $transport->statut_transport }}</td>
            </tr>
        </table>
    </div>

    <!-- CARGAISON -->
    <div class="section-title">Cargaisons</div>

    <table class="data">
        <thead>
        <tr>
            <th>ID</th>
            <th>Volume</th>
            <th>Statut</th>
        </tr>
        </thead>

        <tbody>
        @forelse($transport->cargaisons as $cargaison)
            <tr>
                <td>{{ $cargaison->id_cargaison }}</td>
                <td>{{ $cargaison->volume }}</td>
                <td>{{ $cargaison->statut }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="3">Aucune cargaison</td>
            </tr>
        @endforelse
        </tbody>
    </table>

    <!-- FOOTER -->
    <div class="footer">
        <p><strong>Date d’édition :</strong> {{ now()->format('d/m/Y H:i') }}</p>
        <p>Document généré automatiquement</p>
    </div>

    <!-- SIGNATURES (VERSION DOMPDF SAFE) -->
    <table width="100%" style="margin-top:50px;">
        <tr>
            <td align="center">
                <p>Signature Expéditeur</p>
                __________________________
            </td>

            <td align="center">
                <p>Signature Réception</p>
                __________________________
            </td>
        </tr>
    </table>

</div>

</body>
</html>
