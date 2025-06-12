<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'My PHP Framework' ?></title>
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
            margin: 0 0.5rem 0.5rem 0.5rem;
        }
        .btn:hover {
            background: #3c5aa6;
        }
        .nav {
            margin: 1rem 0;
            padding: 0.5rem;
            border-bottom: 1px solid #eee;
        }
        .framework-info {
            margin-top: 2rem;
            padding-top: 1rem;
            border-top: 1px solid #eee;
            font-size: 0.9rem;
            color: #666;
        }
        
        /* Additional styles that might be needed by views */
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
        .team-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }
        .team-member {
            padding: 1rem;
            background-color: #f8f9fa;
            border-radius: 4px;
        }
        .contact-info {
            text-align: left;
            max-width: 400px;
            margin: 0 auto;
            padding: 1rem;
            background-color: #f8f9fa;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Navigation -->
        <div class="nav">
            <a href="/" class="btn">Home</a>
            <a href="/about" class="btn">About Us</a>
            <a href="/team" class="btn">Our Team</a>
            <a href="/contact" class="btn">Contact</a>
        </div>
        
        <!-- Content from the view -->
        <?php include(BASE_PATH . '/resources/views/' . $content_view . '.php'); ?>
        
        <!-- Footer -->
        <div class="framework-info">
            <p>Running on our Custom PHP Framework</p>
            <p>Current time: <?= date('Y-m-d H:i:s') ?></p>
        </div>
    </div>
</body>
</html>