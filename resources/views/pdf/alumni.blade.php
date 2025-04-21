<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Alumni</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            width: 100%;
            margin: 0 auto;
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Laporan Alumni</h2>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>NIM</th>
                    <th>Angkatan</th>
                    <th>Jurusan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $index => $alumni)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $alumni->name }}</td>
                    <td>{{ $alumni->username }}</td>
                    <td>{{ $alumni->angkatan }}</td>
                    <td>{{ $alumni->prodi }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>