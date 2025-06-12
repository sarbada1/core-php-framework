<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background-color: #f4f4f4;
            color: #333;
        }
        .container {
            width: 100%;
            max-width: 800px;
            padding: 2rem;
            text-align: center;
        }
        h1 {
            color: #4a69bd;
            margin-bottom: 1rem;
        }
        p {
            margin-bottom: 1.5rem;
            font-size: 1.1rem;
        }
        .btn {
            display: inline-block;
            background: #4a69bd;
            color: white;
            padding: 0.7rem 1.5rem;
            border: none;
            cursor: pointer;
            text-decoration: none;
            font-size: 1rem;
            border-radius: 4px;
            transition: background 0.3s ease;
        }
        .btn:hover {
            background: #3c5aa6;
        }
    </style>
</head>
<body>
    <div class="container">
 <h1><?= $title ?></h1>
<p><?= $message ?></p>
    </div>
</body>
</html>
