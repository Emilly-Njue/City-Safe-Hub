<!-- crime_report_pdf.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Crime Reports</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        h1 {
            color: #333;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #f5f5f5;
        }
    </style>
</head>
<body>

<h1>Crime Reports</h1>

<table>
    <thead>
        <tr>
            <th>REF</th>
            <th>Role</th>
            <th>Crime Type</th>
            <th>Location</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach($reports as $report)
            <tr>
                <td>{{ $report->random_code }}</td>
                <td>{{ $report->role }}</td>
                <td>{{ $report->crime_type }}</td>
                <td>{{ $report->location }}</td>
                <td>{{ $report->status }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>
