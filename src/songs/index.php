<?php
session_start();
require __DIR__ . '/../db.php';

$stmt = $pdo->query("SELECT * FROM songs ORDER BY created_at DESC");
$songs = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Songs List</title>
    <style>
        body { 
            font-family: Arial; padding: 20px; 
        }
        table { 
            width: 100%; border-collapse: collapse; 
        }
        th, td { 
            border: 1px solid #ddd; padding: 10px; 
        }
        th { 
            background: #f4f4f4; 
        }
        a.button { 
            display: inline-block;
            padding: 6px 12px;
            background: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
            margin-bottom: 15px;
        }
       .button.delete {
            background: #dc3545;
            border: none;
            color: #fff;
            padding: 7px 14px;
            border-radius: 4px;
            font-size: 14px;
            cursor: pointer;
            transition: background 0.2s ease, transform 0.1s ease;
        }

        .button.delete:hover {
            background: #c82333;
        }

        .button.delete:active {
            transform: scale(0.97);
        }
    </style>
</head>
<body>

<h2>Songs</h2>
<a href="create.php" class="button">+ Add Song</a>

<table>
    <tr>
        <th>Title</th>
        <th>Artist</th>
        <th>Date Created</th>
        <th>Action</th>
    </tr>

    <?php foreach ($songs as $song): ?>
        <tr>
            <td><?= htmlspecialchars($song['title']) ?></td>
            <td><?= htmlspecialchars($song['artist']) ?></td>
            <td><?= $song['created_at'] ?></td>
            <td>
                <a class="button" href="edit.php?id=<?= $song['id'] ?>">Edit</a>
                <form method="POST"
                    action="delete.php"
                    style="display:inline;">
                    <input type="hidden" name="id" value="<?= (int)$song['id'] ?>">
                    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">

                    <button type="submit"
                            class="button delete"
                            onclick="return confirm('Are you sure you want to delete this song?')">
                        Delete
                    </button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

</body>
</html>
