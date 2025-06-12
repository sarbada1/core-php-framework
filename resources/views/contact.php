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
            background-color: #f5f9fc;
            color: #333;
        }
        .container {
            width: 100%;
            max-width: 800px;
            padding: 2rem;
            text-align: center;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        h1 {
            color: #4a69bd;
            margin-bottom: 1rem;
        }
        .contact-info {
            text-align: left;
            max-width: 400px;
            margin: 0 auto;
            padding: 1rem;
            background-color: #f8f9fa;
            border-radius: 4px;
        }
        .contact-item {
            margin-bottom: 0.5rem;
        }
        .label {
            font-weight: bold;
            display: inline-block;
            width: 80px;
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
            margin-top: 1rem;
        }
        .btn:hover {
            background: #3c5aa6;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1><?= $title ?></h1>
        
        <div class="contact-info">
            <div class="contact-item">
                <span class="label">Email:</span> <?= $email ?>
            </div>
            <div class="contact-item">
                <span class="label">Phone:</span> <?= $phone ?>
            </div>
            <div class="contact-item">
                <span class="label">Address:</span> Kathmandu, Nepal
            </div>
        </div>
        
    </div>
</body>
</html>