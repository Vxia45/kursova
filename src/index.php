<?php

require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);

    if (!empty($title) && !empty($content)) {

        $stmt = $pdo->prepare("
            INSERT INTO discussions (title, content)
            VALUES (?, ?)
        ");
        $stmt->execute([$title, $content]);
    }

    header("Location: index.php");
    exit;
}

try {
    $discussions = $pdo->query("
        SELECT *
        FROM discussions
        ORDER BY created_at DESC
    ")->fetchAll();
} catch (PDOException $e) {
    $discussions = [];
    $error_msg = "Неуспешно извличане на темите.";
}
?>

<!DOCTYPE html>
<html lang="bg">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Студентски форум за курсови работи</title>
    <link rel="stylesheet" href="../styles/style.css">
</head>
<body>

<div class="container">

    <h1>Студентски форум</h1>
    <p class="subtitle">Споделете въпрос или намерете съотборници за вашата курсова работа</p>

    <!-- Forum Topic Submission Form -->
    <form method="POST" action="index.php">
        <input
            type="text"
            name="title"
            placeholder="Заглавие на темата (напр. Въпрос по Програмиране 2)"
            required
        >

        <textarea
            name="content"
            placeholder="Опишете вашия въпрос или идея по-подробно..."
            required
        ></textarea>

        <button type="submit">Публикувай тема</button>
    </form>

    <!-- Discussions Feed -->
    <div class="discussions-feed">
        <?php if (isset($error_msg)): ?>
            <div class="error-msg"><?= htmlspecialchars($error_msg) ?></div>
        <?php endif; ?>

        <?php if (empty($discussions)): ?>
            <p class="no-data">Все още няма създадени теми. Бъдете първият, който ще започне дискусия!</p>
        <?php else: ?>
            <?php foreach($discussions as $topic): ?>
                <div class="topic-card">
                    <h3><?= htmlspecialchars($topic['title']) ?></h3>
                    <p><?= htmlspecialchars($topic['content']) ?></p>
                    <?php if (!empty($topic['created_at'])): ?>
                        <span class="topic-meta">Публикувано на: <?= htmlspecialchars($topic['created_at']) ?></span>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

</div>

</body>
</html>