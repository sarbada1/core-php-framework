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
        p {
            margin-bottom: 1.5rem;
            font-size: 1.1rem;
        }
        .features {
            text-align: left;
            max-width: 400px;
            margin: 0 auto 2rem auto;
        }
        .feature-item {
            margin-bottom: 0.5rem;
            padding-left: 1.5rem;
            position: relative;
        }
        .feature-item:before {
            content: "✓";
            color: #4a69bd;
            position: absolute;
            left: 0;
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
            margin: 0 0.5rem;
        }
        .btn:hover {
            background: #3c5aa6;
        }
        .nav {
            margin-top: 2rem;
        }
    </style>
</head>
<body>
    <div class="container">
  <h1><?= $title ?></h1>
<p><?= $content ?></p>

<div class="features">
    <h2>Features:</h2>
    <?php foreach ($features as $feature): ?>
        <div class="feature-item"><?= $feature ?></div>
    <?php endforeach; ?>
</div>
    </div>
</body>
</html>