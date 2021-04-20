<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Aloha!</title>

    <style type="text/css">
        * {
            font-family: Verdana, Arial, sans-serif;
        }
        table{
            width: 100%;
            font-size: x-small;
        }
        tfoot tr td{
            font-weight: bold;
            font-size: x-small;
        }

        .gray {
            background-color: lightgray
        }

        .center {
            text-align: center;
        }

        .right {
            text-align: right;
        }
    </style>

</head>
<body>

<h1 class="center">Sudeste Online</h1>

<h3 class="center">Relatório de Dosagens</h3>

<table>
    <thead style="background-color: lightgray;">
    <tr>
        <th class="center">ID</th>
        <th>Produto</th>
        <th>Cultura</th>
        <th>Praga</th>
        <th>Dosagem</th>
    </tr>
    </thead>
    <tbody>
    @forelse($dosages as $dosage)
    <tr>
        <td class="center">{{ $dosage->id }}</td>
        <td>{{ $dosage->product->name }}</td>
        <td>{{ $dosage->culture->name }}</td>
        <td>{{ $dosage->prague->name }}</td>
        <td>{{ $dosage->dosage }}</td>
    </tr>
    @empty
        <tr>
            <td colspan="4" class="center">Nenhum dado encontrado!</td>
        </tr>
    @endforelse
    </tbody>

    @if (sizeof($dosages) > 0)
    <tfoot>
    <tr>
        <td colspan="5" class="right">Total: {{ sizeof($dosages) }}</td>
    </tr>
    </tfoot>
    @endif
</table>

</body>
</html>
