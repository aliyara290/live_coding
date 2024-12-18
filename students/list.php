<?php
require_once '../includes/functions.php';
$students = get_all_students();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Étudiants</title>
    <script src="https://kit.fontawesome.com/f01941449c.js" crossorigin="anonymous"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<header class="bg-gray-900 text-white py-4 px-6 flex justify-between items-center">
        <h1 class="text-2xl font-bold text-white">Student Management</h1>
        <nav class="flex gap-6">
            <a href="../index.php" class="text-white font-medium hover:underline">Retour à l'accueil</a>
            <a href="create.php" class="text-white font-medium hover:underline">Ajouter un Étudiant</a>
        </nav>
</header>
    <div class="pt-16">
        <h2 class="pb-10 text-lg font-bold text-center">List des Étudiants</h2> 
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Email</th>
                    <th>Date de Naissance</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($students as $student): ?>
                <tr>
                    <td><?= $student['id'] ?></td>
                    <td><?= htmlspecialchars($student['nom']) ?></td>
                    <td><?= htmlspecialchars($student['prenom']) ?></td>
                    <td><?= htmlspecialchars($student['email']) ?></td>
                    <td><?= $student['date_naissance'] ?></td>
                    <td class='text-left py-3 px-4 flex justify-center gap-3'>
                        <span>
                            <a href="update.php?id=<?= $student['id'] ?>" class="btn-edit"><i
                            class='fa-solid fa-pen-to-square cursor-pointer text-green-600'></i></a>
                        </span>
                        <span>
                            <a href="delete.php?id=<?= $student['id'] ?>" class="btn-delete" onclick="return confirm('Voulez-vous vraiment supprimer cet étudiant ?')"><i
                            class='fa-solid fa-trash-can cursor-pointer text-red-600'></i></a>
                        </span>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>