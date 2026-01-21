<?php
session_start();
require __DIR__ . '/../db.php';

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'] ?? '')) {
        die('Invalid CSRF token');
    }

    
    $title  = trim($_POST['title'] ?? '');
    $artist = trim($_POST['artist'] ?? '');
    $lyrics = trim($_POST['lyrics'] ?? '');

    if ($title === '' || strlen($title) > 255) {
        $errors[] = 'Title is required and must be under 255 characters.';
    }

    if ($artist === '' || strlen($artist) > 255) {
        $errors[] = 'Artist is required and must be under 255 characters.';
    }

    if ($lyrics === '') {
        $errors[] = 'Lyrics are required.';
    }

    
    if (empty($errors)) {
        $stmt = $pdo->prepare(
            "INSERT INTO songs (title, artist, lyrics) VALUES (?, ?, ?)"
        );

        $stmt->execute([$title, $artist, $lyrics]);

        header('Location: index.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Song</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            width: 100%;
            max-width: 500px;
        }

        form {
            background: #fff;
            padding: 50px 50px 35px;
            border-radius: 6px;
            box-shadow: 0 0 10px rgba(0,0,0,0.05);
        }

        h2 {
            text-align: center;
            margin-bottom: 25px;
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 6px;
        }

        input, textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-bottom: 20px;
        }

        button {
            width: 30%;
            padding: 10px;
            background: #007bff;
            border: none;
            color: #fff;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background: #0056b3;
        }

        .error {
            background: #ffe5e5;
            border: 1px solid #ffb3b3;
            color: #a94442;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 4px;
        }

        a {
            display: inline-block;
            margin-bottom: 20px;
            padding: 6px 14px;
            background: #007bff;
            color: #fff;
            border-radius: 4px;
            text-decoration: none;
            font-size: 14px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Create Song</h2>
    <a href="index.php">Back</a>

    <?php if (!empty($errors)): ?>
        <div class="error">
            <?php foreach ($errors as $error): ?>
                <div><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <form method="POST">
        <input type='hidden' name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">

        <label>Title</label>
        <input type="text" name="title" maxlength="255" >

        <label>Artist</label>
        <input type="text" name="artist" maxlength="255" >

        <label>Lyrics</label>
        <textarea name="lyrics" rows="5" ></textarea>

        <button type="submit">Save</button>
    </form>
</div>

</body>
</html>