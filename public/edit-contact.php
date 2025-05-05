<?php
require_once __DIR__ . '/../src/ContactManager.php';

$contactManager = new ContactManager();
$id = $_GET['id'] ?? null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $contactManager->updateContact(
        $id,
        $_POST['name'],
        $_POST['email'],
        isset($_POST['favorite'])
    );
    header('Location: index.php');
    exit;
}

$contact = $contactManager->getContact($id);
if (!$contact) {
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Modifier contact</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <header>
            <h1>Modifier contact</h1>
            <a href="index.php" class="btn btn-primary">Retour</a>
        </header>

        <div class="form-container">
            <form method="post">
                <div class="form-group">
                    <label for="name">Nom</label>
                    <input type="text" id="name" name="name" value="<?= htmlspecialchars($contact['name']) ?>" required>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="<?= htmlspecialchars($contact['email']) ?>" required>
                </div>

                <div class="form-group checkbox-group">
                    <input type="checkbox" id="favorite" name="favorite" <?= $contact['favorite'] ? 'checked' : '' ?>>
                    <label for="favorite">Favori</label>
                </div>

                <button type="submit" class="btn btn-primary">Enregistrer</button>
            </form>
        </div>
    </div>
</body>

</html>