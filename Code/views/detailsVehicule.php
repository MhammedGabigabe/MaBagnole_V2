<?php
session_start();
require_once "../controllers/vehicule.php";
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
    <title>Détails du véhicule</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50">
    <div class="max-w-5xl mx-auto px-6 py-12">
        <a href="categoriesClient.php" class="text-gray-500 hover:text-emerald-600 mb-6 inline-block">
            <i class="fa-solid fa-arrow-left"></i> Retour au catalogue
        </a>

        <div class="bg-white rounded-3xl shadow-xl overflow-hidden grid grid-cols-1 md:grid-cols-2">
            <div class="h-[400px]">
                <img src="<?= $deatilsVehi['image'] ?>" class="w-full h-full object-cover">
            </div>
            <div class="p-10 flex flex-col justify-center">
                <span class="text-emerald-600 font-bold uppercase tracking-widest text-xs mb-2">Détails du véhicule</span>
                <h1 class="text-4xl font-black text-gray-900 mb-4"><?= $deatilsVehi['marque']." ".$deatilsVehi['modele'] ?></h1>
                
                <p class="text-gray-600 mb-6">Description détaillée du véhicule (<?= $deatilsVehi['boite_vitesse'].",".$deatilsVehi['motorisation'] ?>).</p>
                
                <div class="grid grid-cols-2 gap-4 mb-8">
                    <div class="bg-gray-50 p-3 rounded-xl">
                        <span class="block text-gray-400 text-xs">Prix par jour</span>
                        <span class="text-xl font-bold text-emerald-700"><?= $deatilsVehi['prix_jour']?>DH</span>
                    </div>
                    <div class="bg-gray-50 p-3 rounded-xl">
                        <span class="block text-gray-400 text-xs">Status</span>
                        <?php if($deatilsVehi['disponibilite'] == 1){ ?>
                            <span class="text-xl font-bold text-gray-800">Disponible</span>
                        <?php }else{ ?>
                            <span class="text-xl font-bold text-gray-800">Disponible</span>
                        <?php } ?>
                    </div>
                </div>

                <button 
                    onclick="openModal()"
                    class="w-full py-4 bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-xl shadow-lg transition-all active:scale-95">
                    RÉSERVER MAINTENANT
                </button>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div id="reservationModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50">
        <div class="bg-white rounded-2xl w-full max-w-lg p-8 relative">

            <button onclick="closeModal()" class="absolute top-4 right-4 text-gray-400 hover:text-red-500">
                <i class="fa-solid fa-xmark text-xl"></i>
            </button>

            <h2 class="text-2xl font-bold mb-6 text-gray-800">Réserver ce véhicule</h2>

            <form method="POST" class="space-y-4">

                <!-- hidden -->
                <input type="hidden" name="id_vehi" value="<?= $deatilsVehi['id_vehicule'] ?>">
                <input type="hidden" name="id_client" value="<?= $_SESSION['user_id'] ?>">

                <div>
                    <label class="text-sm text-gray-600">Date de début</label>
                    <input type="datetime-local" name="date_debut" required
                        class="w-full border rounded-xl px-4 py-2">
                </div>

                <div>
                    <label class="text-sm text-gray-600">Date de fin</label>
                    <input type="datetime-local" name="date_fin" required
                        class="w-full border rounded-xl px-4 py-2">
                </div>

                <div>
                    <label class="text-sm text-gray-600">Lieu de prise</label>
                    <input type="text" name="lieu_prise" required
                        class="w-full border rounded-xl px-4 py-2">
                </div>

                <div>
                    <label class="text-sm text-gray-600">Lieu de retour</label>
                    <input type="text" name="lieu_retour" required
                        class="w-full border rounded-xl px-4 py-2">
                </div>

                <button type="submit" name="confirmeReservation"
                    class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-3 rounded-xl">
                    Confirmer la réservation
                </button>

            </form>
        </div>
    </div>
    <script>
    function openModal() {
        document.getElementById('reservationModal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('reservationModal').classList.add('hidden');
    }
    </script>

</body>
</html>