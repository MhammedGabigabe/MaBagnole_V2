<?php

session_start();
require_once "../controllers/reservation.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MaBagnole | Gestion Réservations</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50 flex h-screen font-sans">

    <aside class="w-64 bg-emerald-900 text-white flex flex-col shadow-xl">
        <div class="p-8 text-center">
            <h1 class="text-2xl font-black italic tracking-tighter">MA<span class="text-emerald-400">BAGNOLE</span></h1>
            <p class="text-[10px] text-emerald-400 uppercase tracking-[0.2em] font-bold mt-1">Admin Panel</p>
        </div>
        <nav class="flex-1 px-4 space-y-1">
            <a href="dashboard.php" class="flex items-center p-3 text-emerald-100 hover:bg-emerald-800 rounded-xl transition-all">
                <i class="fas fa-chart-pie mr-3 w-5"></i> Dashboard
            </a>
            <a href="vehicules.php" class="flex items-center p-3 text-emerald-100 hover:bg-emerald-800 rounded-xl transition-all">
                <i class="fas fa-car mr-3 w-5"></i> Véhicules
            </a>
            <a href="categories.php" class="flex items-center p-3 text-emerald-100 hover:bg-emerald-800 rounded-xl transition-all">
                <i class="fas fa-tags mr-3 w-5"></i> Catégories
            </a>
            <a href="reservations.php" class="flex items-center p-3 bg-emerald-700 text-white rounded-xl shadow-inner transition-all">
                <i class="fas fa-calendar-check mr-3 w-5"></i> Réservations
            </a>
            <a href="avis.php" class="flex items-center p-3 text-emerald-100 hover:bg-emerald-800 rounded-xl transition-all">
                <i class="fas fa-comment-slash mr-3 w-5"></i> Avis
            </a>
        </nav>
        <div class="p-6 border-t border-emerald-800">
            <a href="../controllers/logout.php" class="flex items-center text-emerald-300 hover:text-white transition-colors font-bold text-sm">
                <i class="fas fa-sign-out-alt mr-2"></i> Se déconnecter
            </a>
        </div>
    </aside>

    <main class="flex-1 overflow-y-auto p-10">
        
        <div class="flex justify-between items-end mb-8">
            <div>
                <h2 class="text-3xl font-bold text-gray-800">Suivi des Réservations</h2>
                <p class="text-gray-500">Approuvez ou refusez les demandes de location en temps réel.</p>
            </div>
            
            <div class="flex gap-4">
                <div class="bg-white px-6 py-3 rounded-2xl shadow-sm border border-gray-100 text-center">
                    <span class="block text-2xl font-black text-amber-500"><?=$nbReserEnAtt ?></span>
                    <span class="text-[10px] uppercase font-bold text-gray-400 tracking-widest">En Attente</span>
                </div>
                <div class="bg-white px-6 py-3 rounded-2xl shadow-sm border border-gray-100 text-center">
                    <span class="block text-2xl font-black text-blue-500"><?= $nbResCeMois ?></span>
                    <span class="text-[10px] uppercase font-bold text-gray-400 tracking-widest">Ce mois-ci</span>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead class="bg-gray-50 border-b border-gray-100">
                    <tr>
                        <th class="px-8 py-5 text-[11px] font-black text-gray-400 uppercase tracking-wider">Client & Véhicule</th>
                        <th class="px-8 py-5 text-[11px] font-black text-gray-400 uppercase tracking-wider">Dates</th>
                        <th class="px-8 py-5 text-[11px] font-black text-gray-400 uppercase tracking-wider text-center">Statut</th>
                        <th class="px-8 py-5 text-[11px] font-black text-gray-400 uppercase tracking-wider">Total</th>
                        <th class="px-8 py-5 text-[11px] font-black text-gray-400 uppercase tracking-wider text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    <?php foreach($listeReservs as $reserv){ ?>
                            <?php
                                $statut = null;
                                $color = null;
                                if($reserv['statut'] == 'En Attente'){
                                    $statut = 'En Attente';
                                    $color = 'amber';
                                }elseif($reserv['statut'] == 'Approuvee'){
                                    $statut = 'Comfirmée';
                                    $color = 'emerald';
                                }else{
                                    $statut = 'Refusée';
                                    $color = 'red';
                                }
                            ?>
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-8 py-5">
                                <span class="font-bold text-gray-800 block"><?= $reserv['nom'] ?></span>
                                <span class="text-xs text-emerald-600 font-medium"><?= $reserv['marque'] ." ". $reserv['modele']?></span>
                            </td>
                        <?php if($reserv['statut'] == 'Approuvee'){ ?>    
                            <td class="px-8 py-5">
                                <div class="text-xs text-gray-600">
                                    <p><i class="far fa-calendar-check mr-1 text-emerald-400"></i> <?= date('d M Y', strtotime($reserv['date_fin'])) ?></p>
                                    <p><i class="far fa-calendar-minus mr-1 text-gray-400"></i> <?= date('d M Y', strtotime($reserv['date_fin'])) ?></p>
                                </div>
                            </td>
                        <?php }else{ ?>
                            <td class="px-8 py-5">
                                <div class="text-xs text-gray-600">
                                    <p><i class="far fa-calendar-plus mr-1 text-gray-400"></i> <?= date('d M Y', strtotime($reserv['date_debut'])) ?></p>
                                    <p><i class="far fa-calendar-minus mr-1 text-gray-400"></i> <?= date('d M Y', strtotime($reserv['date_fin'])) ?></p>
                                </div>
                            </td>
                        <?php } ?>
                            <td class="px-8 py-5 text-center">
                                <span class="bg-<?= $color ?>-100 text-<?= $color ?>-700 px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-tighter"><?= $statut ?></span>
                            </td>
                            <td class="px-8 py-5 font-bold text-gray-700"><?=$reserv['prix_jour'] ?> DH</td>
                            <form method="POST">
                                <?php if($statut == 'En Attente'){ ?>
                                    <td class="px-8 py-5 text-right space-x-2">
                                        <button value="<?= $reserv['id_reservation'] ?>" name="accepter" title="Accepter" class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-600 hover:bg-emerald-600 hover:text-white transition-all">
                                            <i class="fas fa-check"></i>
                                        </button>
                                        <button value="<?= $reserv['id_reservation'] ?>" name="refuser" title="Refuser" class="w-8 h-8 rounded-lg bg-red-50 text-red-600 hover:bg-red-600 hover:text-white transition-all">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </td>
                                <?php }else{ ?>
                                        <td class="px-8 py-5 text-right">
                                        <button class="text-gray-400 hover:text-gray-600 px-2"><i class="fas fa-ellipsis-v"></i></button>
                                <?php } ?>
                            </form>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </main>
</body>
</html>