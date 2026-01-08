<?php
session_start();
require_once "../controllers/categorie.php";

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
    <title>MaBagnole | Gestion Catégories</title>
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
            <a href="categories.php" class="flex items-center p-3 bg-emerald-700 text-white rounded-xl shadow-inner">
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
                <h2 class="text-3xl font-bold text-gray-800">Gestion des Catégories</h2>
                <p class="text-gray-500">Organisez votre flotte par types de véhicules.</p>
            </div>
            <div class="flex gap-4">
                <div class="bg-white px-6 py-3 rounded-2xl shadow-sm border border-gray-100 text-center">
                    <span class="block text-2xl font-black text-emerald-600"><?= $nbCategorie ?></span>
                    <span class="text-[10px] uppercase font-bold text-gray-400 tracking-widest">Total Catégories</span>
                </div>
            </div>
        </div>

        <div class="flex gap-4 mb-6">
            <button onclick="openSingleModal()" class="bg-white border-2 border-emerald-600 text-emerald-600 px-5 py-2.5 rounded-xl font-bold hover:bg-emerald-50 transition-all text-sm">
                + Ajouter une catégorie
            </button>
            <button onclick="openModal()" class="bg-emerald-600 text-white px-5 py-2.5 rounded-xl font-bold hover:bg-emerald-700 shadow-lg shadow-emerald-200 transition-all text-sm">
                <i class="fas fa-layer-group mr-2"></i> Ajout en masse
            </button>
        </div>

        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
            <table class="w-full text-left">
                <thead class="bg-gray-50 border-b border-gray-100">
                    <tr>
                        <th class="px-8 py-5 text-[11px] font-black text-gray-400 uppercase tracking-wider">Nom de la catégorie</th>
                        <th class="px-8 py-5 text-[11px] font-black text-gray-400 uppercase tracking-wider text-center">Véhicules liés</th>
                        <th class="px-8 py-5 text-[11px] font-black text-gray-400 uppercase tracking-wider text-right">Actions</th>
                    </tr>
                </thead>
                
                    <tbody class="divide-y divide-gray-50">
                        <?php foreach($listeCategories as $cat){ ?>
                            <tr class="hover:bg-emerald-50/30 transition-colors">
                                <td class="px-8 py-5">
                                    <span class="font-bold text-gray-700 block"><?= $cat['nom'] ?></span>
                                    <span class="text-xs text-gray-400 italic"><?= $cat['description']?></span>
                                </td>
                                <td class="px-8 py-5 text-center">
                                    <?php
                                        $nb = $categorie->nbVehiCat($cat['id_categorie']);

                                        if ($nb == 0) {
                                            $texte = "Aucune voiture";
                                        } elseif ($nb == 1) {
                                            $texte = "1 voiture";
                                        } else {
                                            $texte = $nb . " voitures";
                                        }
                                    ?>
                                    <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs font-bold">
                                        <?= $texte ?>
                                    </span>
                                </td>
                                <form method="POST">
                                    <td class="px-8 py-5 text-right space-x-3">
                                        <button type="submit" value="<?= $cat['id_categorie']?>" name="id_a_modifier" class="text-gray-400 hover:text-emerald-600 transition-colors"><i class="fas fa-pen"></i></button>
                                        <button name="supprimer_cat" value="<?= $cat['id_categorie']?>" class="text-gray-400 hover:text-red-600 transition-colors"><i class="fas fa-trash-can"></i></button>
                                    </td>
                                </form>
                            </tr>
                            
                        <?php } ?>
                    </tbody>
                
            </table>
        </div>
    </main>

    <div id="massModal" class="hidden fixed inset-0 bg-emerald-950/40 backdrop-blur-sm z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-3xl shadow-2xl w-full max-w-lg overflow-hidden transform transition-all">
            <div class="p-8">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-2xl font-bold text-gray-800">Ajout en masse</h3>
                    <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600"><i class="fas fa-times"></i></button>
                </div>
                <form action="../controllers/categorie.php" method="POST">
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Liste des catégories (une par ligne)</label>
                    <textarea name="categories_list" rows="6" 
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-2xl focus:ring-2 focus:ring-emerald-500 outline-none transition-all placeholder:text-gray-300"
                        placeholder="Luxe;Voitures haut de gamme; image(URL)&#10;Utilitaire;Véhicules professionnels; image(URL)&#10;SUV;4x4 et SUV familiaux; image(URL)..."></textarea>
                    
                    <div class="mt-6 flex gap-3">
                        <button type="button" onclick="closeModal()" class="flex-1 py-3 bg-gray-100 text-gray-600 font-bold rounded-xl hover:bg-gray-200 transition-all">Annuler</button>
                        <button type="submit" name="ajouter_mass" class="flex-1 py-3 bg-emerald-600 text-white font-bold rounded-xl hover:bg-emerald-700 shadow-lg shadow-emerald-200 transition-all">
                            Enregistrer la liste
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="singleModal" class="hidden fixed inset-0 bg-black/50 backdrop-blur-sm z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-3xl shadow-2xl w-full max-w-md overflow-hidden transform transition-all">
            <div class="p-8">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-2xl font-bold text-gray-800">Nouvelle Catégorie</h3>
                    <button onclick="closeSingleModal()" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times"></i>
                    </button>
                </div>

                <form action="../controllers/categorie.php" method="POST" class="space-y-4">
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Nom de la catégorie</label>
                        <input type="text" name="nom" required 
                            class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 outline-none transition-all"
                            placeholder="Ex: Sportive, Luxe...">
                    </div>
                    
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Description</label>
                        <textarea name="description" rows="3" 
                            class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 outline-none transition-all"
                            placeholder="Brève description..."></textarea>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Image</label>
                        <input type="text" name="image" required 
                            class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 outline-none transition-all"
                            placeholder="URL">
                    </div>

                    <div class="pt-4 flex gap-3">
                        <button type="button" onclick="closeSingleModal()" class="flex-1 py-3 bg-gray-100 text-gray-600 font-bold rounded-xl hover:bg-gray-200 transition-all">
                            Annuler
                        </button>
                        <button type="submit" name="ajouter_seul" class="flex-1 py-3 bg-emerald-600 text-white font-bold rounded-xl hover:bg-emerald-700 shadow-lg shadow-emerald-200 transition-all">
                            Enregistrer
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="editModal" class="hidden fixed inset-0 bg-black/50 backdrop-blur-sm z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-3xl shadow-2xl w-full max-w-md overflow-hidden transform transition-all">
            <div class="p-8">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-2xl font-bold text-gray-800">Modifier Catégorie</h3>
                    <button onclick="closeEditModal()" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times"></i>
                    </button>
                </div>

                <form method="POST" class="space-y-4">
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Nom de la catégorie</label>
                        <?php if($cat_a_modifier){ ?>
                            <input type="text" name="nom" required 
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 outline-none transition-all"
                                value ="<?=$cat_a_modifier['nom'] ?>">
                        <?php }else{?>
                            <input type="text" name="nom" required 
                            class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 outline-none transition-all"
                            placeholder="Ex: Sportive, Luxe...">
                        <?php } ?>
                    </div>
                    
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Description</label>
                        <?php if($cat_a_modifier){ ?>
                            <textarea name="description" rows="3" 
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 outline-none transition-all"
                                ><?=$cat_a_modifier['description'] ?></textarea>
                        <?php }else{?>        
                            <textarea name="description" rows="3" 
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 outline-none transition-all"
                                placeholder="Brève description..."></textarea>
                        <?php } ?>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Image</label>
                        <?php if($cat_a_modifier){ ?>
                            <input type="text" name="image" required 
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 outline-none transition-all"
                                value ="<?=$cat_a_modifier['image'] ?>">
                        <?php }else{?>
                            <input type="text" name="image" required 
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 outline-none transition-all"
                                placeholder="URL">
                        <?php } ?>
                    </div>

                    <div class="pt-4 flex gap-3">
                        <button onclick="closeEditModal()" class="flex-1 py-3 bg-gray-100 text-gray-600 font-bold rounded-xl hover:bg-gray-200 transition-all">
                            Annuler
                        </button>
                        <button type="submit" value="<?= $cat_a_modifier['id_categorie']?>" name="modifier" class="flex-1 py-3 bg-emerald-600 text-white font-bold rounded-xl hover:bg-emerald-700 shadow-lg shadow-emerald-200 transition-all">
                            Metre à jour
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>    

    <script>
        function openModal() {
            document.getElementById('massModal').classList.remove('hidden');
        }
        function closeModal() {
            document.getElementById('massModal').classList.add('hidden');
        }

        function openSingleModal() {
            document.getElementById('singleModal').classList.remove('hidden');
        }
        function closeSingleModal() {
            document.getElementById('singleModal').classList.add('hidden');
        }   

        function closeEditModal() {
            document.getElementById('editModal').classList.add('hidden');
        } 
    </script>
    <?php if ($cat_a_modifier){ ?>
        <script>
            document.getElementById('editModal').classList.remove('hidden');
        </script>
    <?php } ?>
</body>
</html>