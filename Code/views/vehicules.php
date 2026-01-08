<?php
require_once "../controllers/vehicule.php";
require_once "../controllers/categorie.php";

session_start();

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
    <title>MaBagnole | Gestion Véhicules</title>
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
            <a href="vehicules.php" class="flex items-center p-3 bg-emerald-700 text-white rounded-xl shadow-inner transition-all">
                <i class="fas fa-car mr-3 w-5"></i> Véhicules
            </a>
            <a href="categories.php" class="flex items-center p-3 text-emerald-100 hover:bg-emerald-800 rounded-xl transition-all">
                <i class="fas fa-tags mr-3 w-5"></i> Catégories
            </a>
            <a href="reservations.php" class="flex items-center p-3 text-emerald-100 hover:bg-emerald-800 rounded-xl transition-all">
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
                <h2 class="text-3xl font-bold text-gray-800">Parc Automobile</h2>
                <p class="text-gray-500">Gérez vos véhicules et leur état de disponibilité.</p>
            </div>
            
            <div class="flex gap-4">
                <div class="bg-white px-6 py-3 rounded-2xl shadow-sm border border-gray-100 text-center">
                    <span class="block text-2xl font-black text-emerald-600"><?= $vehiDisp ?></span>
                    <span class="text-[10px] uppercase font-bold text-gray-400 tracking-widest">Voitures Diponibles</span>
                </div>
                <div class="bg-white px-6 py-3 rounded-2xl shadow-sm border border-gray-100 text-center">
                    <span class="block text-2xl font-black text-amber-500"><?= $vehiLouee ?></span>
                    <span class="text-[10px] uppercase font-bold text-gray-400 tracking-widest">Voitures Louées</span>
                </div>
            </div>
        </div>

        <div class="flex justify-between items-center mb-6">
            <div class="flex gap-4">
                <button onclick="openModal()" class="bg-emerald-600 text-white px-6 py-3 rounded-xl font-bold hover:bg-emerald-700 shadow-lg shadow-emerald-200 transition-all flex items-center">
                    <i class="fas fa-layer-group mr-2"></i> Ajout en masse
                </button>
                <button onclick="openSingleModal()" class="bg-white border border-gray-200 text-gray-700 px-6 py-3 rounded-xl font-bold hover:bg-gray-50 transition-all flex items-center">
                    <i class="fas fa-plus mr-2 text-emerald-600"></i> Nouveau véhicule
                </button>
            </div>

        </div>

        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead class="bg-gray-50 border-b border-gray-100">
                    <tr>
                        <th class="px-8 py-5 text-[11px] font-black text-gray-400 uppercase tracking-wider">Véhicule</th>
                        <th class="px-8 py-5 text-[11px] font-black text-gray-400 uppercase tracking-wider">Catégorie</th>
                        <th class="px-8 py-5 text-[11px] font-black text-gray-400 uppercase tracking-wider">Prix/Jour</th>
                        <th class="px-8 py-5 text-[11px] font-black text-gray-400 uppercase tracking-wider">Statut</th>
                        <th class="px-8 py-5 text-[11px] font-black text-gray-400 uppercase tracking-wider text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    <?php foreach($listeVehicules as $vehi){ ?>
                        <tr class="hover:bg-emerald-50/30 transition-colors group">
                            <td class="px-8 py-5 flex items-center">
                                <div class="w-12 h-12 rounded-lg bg-gray-100 mr-4 flex items-center justify-center overflow-hidden">
                                    <i class="fas fa-car text-gray-400 text-xl"></i>
                                </div>
                                <div>
                                    <span class="font-bold text-gray-800 block"><?= $vehi['marque'] ." ". $vehi['modele'] ?></span>
                                    <span class="text-xs text-gray-400">Immatriculation:<?= " ". $vehi['immatriculation'] ?></span>
                                </div>
                            </td>
                            <td class="px-8 py-5">
                                <span class="text-sm font-medium text-gray-600 bg-gray-100 px-3 py-1 rounded-lg italic"><?= $vehi['nom'] ?></span>
                            </td>
                            <td class="px-8 py-5 font-black text-emerald-700">
                                <?= $vehi['prix_jour'] ?> DH
                            </td>
                            <td class="px-8 py-5">
                                <?php if ($vehi['disponibilite']){ ?>
                                    <span class="flex items-center text-xs font-bold text-emerald-600">
                                        <span class="w-2 h-2 bg-emerald-500 rounded-full mr-2 animate-pulse"></span> 
                                        Disponible
                                    </span>
                                <?php }else{ ?>
                                    <span class="flex items-center text-xs font-bold text-gray-400">
                                        <span class="w-2 h-2 bg-gray-300 rounded-full mr-2"></span> 
                                        Indisponible
                                    </span>
                                <?php } ?>
                            </td>
                            <form method="POST">
                                <td class="px-8 py-5 text-right space-x-2">
                                    <button name="editModal_vehi" value="<?= $vehi['id_vehicule'] ?>" class="p-2 text-gray-400 hover:text-emerald-600 hover:bg-emerald-50 rounded-lg transition-all"><i class="fas fa-edit"></i></button>
                                    <button name="supprimer_vehi" value="<?= $vehi['id_vehicule'] ?>" class="p-2 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-all"><i class="fas fa-trash-can"></i></button>
                                </td>
                            </form>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </main>

    <div id="massVehicleModal" class="hidden fixed inset-0 bg-emerald-950/40 backdrop-blur-sm z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-3xl shadow-2xl w-full max-w-2xl overflow-hidden transform transition-all">
            <div class="p-8">
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h3 class="text-2xl font-bold text-gray-800">Ajout Multiple de Véhicules</h3>
                        <p class="text-sm text-gray-400">Format recommandé : Modèle | Prix | Catégorie | Immatriculation</p>
                    </div>
                    <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600"><i class="fas fa-times"></i></button>
                </div>
                
                <form action="../controllers/vehicule.php" method="POST">
                    <textarea name="vehicles_data" rows="8" 
                        class="w-full px-4 py-4 bg-gray-50 border border-gray-200 rounded-2xl focus:ring-2 focus:ring-emerald-500 outline-none transition-all font-mono text-sm"
                        placeholder="Dacia | Logan | 250 | 1 | 1234-B-7&#10;Golf | 8 | 500 | 5 | 5678-A-15..."></textarea>
                    
                    <div class="mt-6 flex gap-4">
                        <button type="button" onclick="closeModal()" class="flex-1 py-4 bg-gray-100 text-gray-600 font-bold rounded-2xl hover:bg-gray-200 transition-all">
                            Annuler
                        </button>
                        <button type="submit" name="mass_add_vehicles" class="flex-1 py-4 bg-emerald-600 text-white font-bold rounded-2xl hover:bg-emerald-700 shadow-lg shadow-emerald-200 transition-all">
                            Enregistrer la liste
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="singleVehicleModal" class="hidden fixed inset-0 bg-emerald-950/40 backdrop-blur-sm z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-3xl shadow-2xl w-full max-w-2xl overflow-hidden transform transition-all">
            <div class="p-8">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-2xl font-bold text-gray-800">Ajouter un Véhicule</h3>
                    <button onclick="closeSingleModal()" class="text-gray-400 hover:text-gray-600"><i class="fas fa-times"></i></button>
                </div>
                
                <form action="../controllers/vehicule.php" method="POST" enctype="multipart/form-data">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Marque</label>
                            <input type="text" name="marque" required placeholder="Ex: Dacia, Golf..." class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 outline-none">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Modèle</label>
                            <input type="text" name="modele" required placeholder="Ex: Logan, VII..." class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 outline-none">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Immatriculation</label>
                            <input type="text" name="immatriculation" required placeholder="Ex: 12-A-5678" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 outline-none">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Prix par jour (DH)</label>
                            <input type="number" name="prix_jour" required placeholder="Ex: 300" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 outline-none">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Catégorie</label>
                                <select name="id_categ"
                                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl
                                        focus:ring-2 focus:ring-emerald-500 outline-none">

                                    <option value="">-- Choisir une catégorie --</option>

                                    <?php foreach ($listeCategories as $cat){ ?>
                                        <option value="<?= $cat['id_categorie'] ?>">
                                            <?= $cat['nom'] ?>
                                        </option>
                                    <?php } ?>

                                </select>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Boîte de vitesse</label>
                            <select name="boite_vitesse" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 outline-none">
                                <option value="">-- Choisir boite a vitesse --</option>
                                <option value="Manuelle">Manuelle</option>
                                <option value="Automatique">Automatique</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Motorisation</label>
                            <input type="text" name="motorisation" placeholder="Ex: Diesel, Essence, Électrique" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 outline-none">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Photo du véhicule</label>
                            <input type="text" name="image" placeholder="Ex: URL" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 outline-none">
                        </div>
                    </div>

                    <div class="mt-8 flex gap-4">
                        <button type="button" onclick="closeSingleModal()" class="flex-1 py-3 bg-gray-100 text-gray-600 font-bold rounded-2xl hover:bg-gray-200 transition-all">
                            Annuler
                        </button>
                        <button type="submit" name="ajouter_seul" class="flex-1 py-3 bg-emerald-600 text-white font-bold rounded-2xl hover:bg-emerald-700 shadow-lg shadow-emerald-200 transition-all">
                            Enregistrer le véhicule
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="editVehicleModal" class="hidden fixed inset-0 bg-emerald-950/40 backdrop-blur-sm z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-3xl shadow-2xl w-full max-w-2xl overflow-hidden transform transition-all">
            <div class="p-8">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-2xl font-bold text-gray-800">Modifier un Véhicule</h3>
                    <button onclick="closeEditModal()" class="text-gray-400 hover:text-gray-600"><i class="fas fa-times"></i></button>
                </div>
                
                <form action="../controllers/vehicule.php" method="POST" enctype="multipart/form-data">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Marque</label>
                            <input type="text" name="marque" required value="<?= $vehi_a_modifier['marque'] ?>" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 outline-none">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Modèle</label>
                            <input type="text" name="modele" required value="<?= $vehi_a_modifier['modele'] ?>" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 outline-none">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Immatriculation</label>
                            <input type="text" name="immatriculation" required value="<?= $vehi_a_modifier['immatriculation'] ?>" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 outline-none">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Prix par jour (DH)</label>
                            <input type="number" name="prix_jour" required value="<?= $vehi_a_modifier['prix_jour'] ?>" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 outline-none">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Catégorie</label>
                                <select name="id_categ"
                                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl
                                    focus:ring-2 focus:ring-emerald-500 outline-none">

                                    <option value="">-- Choisir une catégorie --</option>

                                    <?php foreach ($listeCategories as $cat){ ?>
                                        <option value="<?= $cat['id_categorie'] ?>"
                                            <?= ($cat['id_categorie'] == $vehi_a_modifier['id_categ']) ? 'selected' : '' ?>>
                                            <?= $cat['nom'] ?>
                                        </option>
                                    <?php } ?>
                                </select>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Boîte de vitesse</label>
                            <select name="boite_vitesse"
                                class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl
                                focus:ring-2 focus:ring-emerald-500 outline-none">
                                <option value="">-- Choisir boite a vitesse --</option>
                                <option value="Manuelle"
                                    <?= ($vehi_a_modifier['boite_vitesse'] == 'Manuelle') ? 'selected' : '' ?>>
                                    Manuelle
                                </option>

                                <option value="Automatique"
                                    <?= ($vehi_a_modifier['boite_vitesse'] == 'Automatique') ? 'selected' : '' ?>>
                                    Automatique
                                </option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Motorisation</label>
                            <input type="text" name="motorisation" value="<?= $vehi_a_modifier['motorisation'] ?>" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 outline-none">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Photo du véhicule</label>
                            <input type="text" name="image" value="<?= $vehi_a_modifier['image'] ?>" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 outline-none">
                        </div>
                    </div>

                    <div class="mt-8 flex gap-4">
                        <button type="button" onclick="closeEditModal()" class="flex-1 py-3 bg-gray-100 text-gray-600 font-bold rounded-2xl hover:bg-gray-200 transition-all">
                            Annuler
                        </button>
                        <button type="submit" name="maj" value="<?= $vehi_a_modifier['id_vehicule']?>" class="flex-1 py-3 bg-emerald-600 text-white font-bold rounded-2xl hover:bg-emerald-700 shadow-lg shadow-emerald-200 transition-all">
                            Metre à jour
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openModal() {
            document.getElementById('massVehicleModal').classList.remove('hidden');
        }
        function closeModal() {
            document.getElementById('massVehicleModal').classList.add('hidden');
        }

        function openSingleModal() {
            document.getElementById('singleVehicleModal').classList.remove('hidden');
        }
        function closeSingleModal() {
            document.getElementById('singleVehicleModal').classList.add('hidden');
        }
        
        function closeEditModal() {
            document.getElementById('editVehicleModal').classList.add('hidden');
        }
    </script>
    <?php if ($vehi_a_modifier){ ?>
        <script>
            document.getElementById('editVehicleModal').classList.remove('hidden');
        </script>
    <?php } ?>
</body>
</html>