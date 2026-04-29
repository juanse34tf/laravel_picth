<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Producción</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; color: #1f2937; margin: 30px; }
        h1 { font-size: 20px; color: #1e40af; margin-bottom: 4px; }
        .subtitle { color: #6b7280; font-size: 11px; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        thead { background-color: #1e40af; color: #ffffff; }
        thead th { padding: 8px 10px; text-align: left; font-size: 11px; text-transform: uppercase; letter-spacing: 0.05em; }
        tbody tr:nth-child(even) { background-color: #f3f4f6; }
        tbody td { padding: 7px 10px; border-bottom: 1px solid #e5e7eb; }
        .footer { margin-top: 24px; font-size: 10px; color: #9ca3af; text-align: right; }
        .total-row td { font-weight: bold; background-color: #dbeafe; }
    </style>
</head>
<body>
    <h1>Sistema de Gestión Avícola</h1>
    <p class="subtitle">Reporte de Producción — Generado el {{ now()->format('d/m/Y H:i') }}</p>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Lote</th>
                <th>Fecha</th>
                <th>Tipo Huevo</th>
                <th>Cantidad</th>
                <th>Observaciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($producciones as $prod)
            <tr>
                <td>{{ $prod->id }}</td>
                <td>Lote #{{ $prod->lote->id }}</td>
                <td>{{ \Carbon\Carbon::parse($prod->fecha)->format('d/m/Y') }}</td>
                <td>{{ $prod->tipo_huevo }}</td>
                <td>{{ number_format($prod->cantidad) }}</td>
                <td>{{ $prod->observaciones ?? '—' }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align:center; color:#6b7280; padding:20px;">
                    No hay registros de producción.
                </td>
            </tr>
            @endforelse
            @if($producciones->count() > 0)
            <tr class="total-row">
                <td colspan="4">Total de unidades producidas</td>
                <td>{{ number_format($producciones->sum('cantidad')) }}</td>
                <td></td>
            </tr>
            @endif
        </tbody>
    </table>

    <p class="footer">Sistema de Gestión Avícola &mdash; Documento generado automáticamente</p>
</body>
</html>
