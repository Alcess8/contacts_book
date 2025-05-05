<?php
require_once __DIR__ . '/../src/ContactManager.php';

$contactManager = new ContactManager();
$contacts = $contactManager->getAllContacts();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Book</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <header>
            <h1>Mes Contacts</h1>
            <a href="add.php" class="btn btn-primary">Ajouter un contact</a>
        </header>

        <div class="contact-list">
            <?php foreach ($contacts as $id => $contact): ?>
                <div class="contact-card">
                    <div class="contact-header">
                        <span class="contact-name"><?= htmlspecialchars($contact['name']) ?></span>
                        <?php if ($contact['favorite']): ?>
                            <span class="contact-favorite">★</span>
                        <?php endif; ?>
                    </div>
                    <div class="contact-email"><?= htmlspecialchars($contact['email']) ?></div>
                    <div class="contact-actions">
                        <a href="edit.php?id=<?= $id ?>" class="btn btn-sm btn-warning">Modifier</a>
                        <a href="delete.php?id=<?= $id ?>" class="btn btn-sm btn-danger" onclick="return confirm('Supprimer ce contact ?')">Supprimer</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>

</html>