<?php
session_start();
require_once "../controllers/reservation.php";

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MaBagnole | Mes Réservations</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50 min-h-screen">

    <!-- Nav -->
    <nav class="bg-white shadow-md px-6 py-4 flex justify-between items-center sticky top-0 z-50">
        <h1 class="text-2xl font-black text-emerald-700 italic">MA<span class="text-gray-800">BAGNOLE</span></h1>
        <div class="flex items-center gap-6">
            <span class="text-gray-600 hidden md:block">Bienvenue, <strong class="text-emerald-600"><?= $_SESSION['nom'] ?? 'Client'; ?></strong></span>

            <!-- Bouton Categories -->
            <a href="categoriesClient.php" class="flex items-center gap-2 bg-gray-100 text-gray-800 px-4 py-2 rounded-lg font-bold hover:bg-gray-200 transition-colors">
                <i class="fa-solid fa-arrow-left"></i> Catégories
            </a>

            <!-- Déconnexion -->
            <a href="../controllers/logout.php" class="flex items-center gap-2 bg-red-50 text-red-600 px-4 py-2 rounded-lg font-bold hover:bg-red-100 transition-colors">
                <i class="fa-solid fa-right-from-bracket"></i> Déconnexion
            </a>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-6 py-12">
        <header class="mb-8">
            <h2 class="text-3xl font-extrabold text-gray-900">Mes Réservations</h2>
            <p class="text-gray-500">Toutes vos réservations passées et en cours.</p>
        </header>

        <?php if(empty($mesReservations)): ?>
            <div class="bg-white p-6 rounded-2xl shadow text-gray-500">
                Vous n'avez aucune réservation pour le moment.
            </div>
        <?php else: ?>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <?php foreach($mesReservations as $res): ?>
                    <div class="group bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-md border border-gray-100 transition-all">
                        <div class="h-48 overflow-hidden relative">
                            <img src="<?= $res['image'] ?>" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            <div class="absolute top-4 right-4 bg-white/90 backdrop-blur px-3 py-1 rounded-lg shadow-sm">
                                <span class="text-emerald-700 font-bold"><?= $res['prix_jour'] ?>DH</span><span class="text-gray-500 text-xs">/jour</span>
                            </div>
                        </div>
                        <div class="p-4 text-center">
                            <h3 class="font-bold text-gray-800"><?= $res['marque']." ".$res['modele'] ?></h3>
                            <p class="text-gray-600 text-sm mt-1">
                                <?= date('d/m/Y H:i', strtotime($res['date_debut'])) ?> - <?= date('d/m/Y H:i', strtotime($res['date_fin'])) ?>
                            </p>
                            <p class="text-gray-600 text-sm mt-1">Lieu : <?= $res['lieu_prise'] ?> → <?= $res['lieu_retour'] ?></p>

                            <?php
                                $statutColor = "gray";
                                if($res['statut'] == "En Attente") $statutColor = "amber";
                                if($res['statut'] == "Approuvee") $statutColor = "emerald";
                                if($res['statut'] == "Refusee") $statutColor = "red";
                            ?>
                            <span class="mt-2 inline-block px-3 py-1 rounded-full bg-<?= $statutColor ?>-100 text-<?= $statutColor ?>-700 text-sm font-bold uppercase">
                                <?= $res['statut'] ?>
                            </span>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </main>
</body>
</html>
