
<?php
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
    <title>MaBagnole | Gestion Avis</title>
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
            <a href="reservations.php" class="flex items-center p-3 text-emerald-100 hover:bg-emerald-800 rounded-xl transition-all">
                <i class="fas fa-calendar-check mr-3 w-5"></i> Réservations
            </a>
            <a href="avis.php" class="flex items-center p-3 bg-emerald-700 text-white rounded-xl shadow-inner transition-all">
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
                <h2 class="text-3xl font-bold text-gray-800">Modération des Avis</h2>
                <p class="text-gray-500">Gérez les retours clients et filtrez les contenus inappropriés.</p>
            </div>
            
            <div class="flex gap-4">
                <div class="bg-white px-6 py-3 rounded-2xl shadow-sm border border-gray-100 text-center">
                    <span class="block text-2xl font-black text-amber-400">4.8/5</span>
                    <span class="text-[10px] uppercase font-bold text-gray-400 tracking-widest">Note Moyenne</span>
                </div>
                <div class="bg-white px-6 py-3 rounded-2xl shadow-sm border border-gray-100 text-center">
                    <span class="block text-2xl font-black text-red-500">03</span>
                    <span class="text-[10px] uppercase font-bold text-gray-400 tracking-widest">Signalés</span>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            
            <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow relative overflow-hidden group">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-emerald-100 rounded-full flex items-center justify-center text-emerald-600 font-bold mr-3">
                            JD
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800 text-sm">Jean Dupont</h4>
                            <p class="text-[10px] text-gray-400">Réservation #12345 • Il y a 2h</p>
                        </div>
                    </div>
                    <div class="flex text-amber-400 text-xs">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                    </div>
                </div>
                <p class="text-gray-600 text-sm leading-relaxed italic">
                    "Super expérience ! La voiture était propre et l'accueil à l'agence de Casablanca était parfait. Je recommande vivement."
                </p>
                <div class="mt-4 flex justify-end">
                    <button class="text-xs font-bold text-red-500 hover:text-red-700 opacity-0 group-hover:opacity-100 transition-opacity flex items-center">
                        <i class="fas fa-trash-alt mr-1"></i> Supprimer cet avis
                    </button>
                </div>
            </div>

            <div class="bg-red-50/50 p-6 rounded-3xl shadow-sm border border-red-100 hover:shadow-md transition-shadow relative overflow-hidden group">
                <div class="absolute top-0 right-0 p-2 bg-red-100 text-red-600 text-[10px] font-black uppercase rounded-bl-xl">
                    Inapproprié ?
                </div>
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-gray-200 rounded-full flex items-center justify-center text-gray-500 font-bold mr-3">
                            UK
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800 text-sm">Utilisateur_X</h4>
                            <p class="text-[10px] text-gray-400">Réservation #12389 • Hier</p>
                        </div>
                    </div>
                    <div class="flex text-amber-400 text-xs">
                        <i class="fas fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i>
                    </div>
                </div>
                <p class="text-red-800 text-sm leading-relaxed font-medium">
                    "Service nul !! Le personnel est stupide et les voitures sont des poubelles. Allez ailleurs !!!"
                </p>
                <div class="mt-4 flex justify-end">
                    <button class="px-4 py-2 bg-red-600 text-white rounded-xl text-xs font-bold hover:bg-red-700 transition-all flex items-center shadow-lg shadow-red-200">
                        <i class="fas fa-ban mr-1"></i> Supprimer définitivement
                    </button>
                </div>
            </div>

        </div>

        <div class="mt-8 flex justify-center space-x-2">
            <button class="w-8 h-8 flex items-center justify-center rounded-lg bg-white border border-gray-200 text-gray-400 hover:bg-emerald-600 hover:text-white transition-all"><i class="fas fa-chevron-left"></i></button>
            <button class="w-8 h-8 flex items-center justify-center rounded-lg bg-emerald-600 text-white font-bold text-xs shadow-lg shadow-emerald-200">1</button>
            <button class="w-8 h-8 flex items-center justify-center rounded-lg bg-white border border-gray-200 text-gray-500 hover:bg-emerald-600 hover:text-white transition-all">2</button>
            <button class="w-8 h-8 flex items-center justify-center rounded-lg bg-white border border-gray-200 text-gray-400 hover:bg-emerald-600 hover:text-white transition-all"><i class="fas fa-chevron-right"></i></button>
        </div>

    </main>
</body>
</html>