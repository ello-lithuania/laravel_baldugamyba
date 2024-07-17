<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nauja užklausa</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

        /* Tailwind CSS */
        @tailwind base;
        @tailwind components;
        @tailwind utilities;

        /* Custom styles */
        body {
            font-family: 'Inter', sans-serif;
            line-height: 1.6;
            background-color: #f3f4f6;
            padding: 20px;
        }

        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .header {
            background-color: #2563eb;
            color: #ffffff;
            padding: 20px;
            text-align: center;
        }

        .content {
            padding: 20px;
        }

        .footer {
            background-color: #f3f4f6;
            padding: 20px;
            text-align: center;
            border-top: 1px solid #e4e4e7;
        }

        .footer p {
            color: #6b7280;
        }
        a {
            color: black;
            text-decoration: none
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <h1 class="text-1xl">Nauja užklausa</h1>
        </div>
        <div class="content">
            <h2>{{$client->title}}</h2>
            <p>{{$client->description}}</p>
            <ul class="list-disc list-inside">
                <li>Kaina numatoma nuo - iki: <br/>{{$client->price}}</li>
                <li>Atlikimo terminas: <br/>{{$client->deadline}}</li>
                <li>Vieta: <br/>{{$client->city}}</li>
                <li>Telefono numeris: <br/>{{$client->phone}}</li>
            </ul>
        </div>
        <div class="footer">
            <a href="https://baldugamyba.lt">Baldugamyba.lt</p>
        </div>
    </div>
</body>
</html>
