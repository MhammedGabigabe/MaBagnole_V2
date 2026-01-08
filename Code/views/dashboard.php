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
    <title>MaBagnole | Dashboard Admin</title>
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
            <a href="dashboard.php" class="flex items-center p-3 bg-emerald-700 text-white rounded-xl shadow-inner transition-all">
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
        
        <div class="flex justify-between items-center mb-10">
            <div>
                <h2 class="text-3xl font-bold text-gray-800 italic">Vue d'ensemble</h2>
                <p class="text-gray-500">Statistiques de performance pour 2026.</p>
            </div>
            <div class="flex items-center gap-4">
                <div class="text-right">
                    <p class="text-sm font-bold text-gray-800">Admin Principal</p>
                    <p class="text-[10px] text-emerald-600 font-bold uppercase">En ligne</p>
                </div>
                <div class="w-12 h-12 bg-emerald-100 border-2 border-emerald-500 rounded-2xl flex items-center justify-center text-emerald-700 font-black">
                    AD
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
            
            <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100">
                <div class="w-12 h-12 bg-emerald-50 text-emerald-600 rounded-2xl flex items-center justify-center text-xl mb-4">
                    <i class="fas fa-wallet"></i>
                </div>
                <p class="text-gray-400 text-xs font-bold uppercase tracking-widest">Revenus (Janvier)</p>
                <h3 class="text-2xl font-black text-gray-800">12,450 DH</h3>
                <p class="text-emerald-500 text-xs font-bold mt-2"><i class="fas fa-arrow-up"></i> +8.2% vs déc.</p>
            </div>

            <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100">
                <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center text-xl mb-4">
                    <i class="fas fa-key"></i>
                </div>
                <p class="text-gray-400 text-xs font-bold uppercase tracking-widest">Réservations</p>
                <h3 class="text-2xl font-black text-gray-800">48</h3>
                <p class="text-blue-500 text-xs font-bold mt-2">12 en attente de validation</p>
            </div>

            <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100">
                <div class="w-12 h-12 bg-purple-50 text-purple-600 rounded-2xl flex items-center justify-center text-xl mb-4">
                    <i class="fas fa-car-side"></i>
                </div>
                <p class="text-gray-400 text-xs font-bold uppercase tracking-widest">Véhicules Total</p>
                <h3 class="text-2xl font-black text-gray-800">26</h3>
                <p class="text-gray-500 text-xs font-bold mt-2">92% de disponibilité</p>
            </div>

            <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100">
                <div class="w-12 h-12 bg-amber-50 text-amber-600 rounded-2xl flex items-center justify-center text-xl mb-4">
                    <i class="fas fa-smile"></i>
                </div>
                <p class="text-gray-400 text-xs font-bold uppercase tracking-widest">Note Moyenne</p>
                <h3 class="text-2xl font-black text-gray-800">4.7 / 5</h3>
                <p class="text-amber-500 text-xs font-bold mt-2">Basé sur 150 avis</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <div class="lg:col-span-2 bg-white rounded-3xl shadow-sm border border-gray-100 p-8">
                <div class="flex justify-between items-center mb-8">
                    <h3 class="text-xl font-bold text-gray-800">Activités Récentes</h3>
                    <span class="text-xs bg-gray-100 text-gray-500 px-3 py-1 rounded-full font-bold">Aujourd'hui</span>
                </div>
                <div class="space-y-6">
                    <div class="flex items-center justify-between group">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 bg-emerald-50 text-emerald-600 rounded-full flex items-center justify-center font-black">Y</div>
                            <div>
                                <p class="text-sm font-bold text-gray-800">Yassine Mansouri</p>
                                <p class="text-[10px] text-gray-400 uppercase font-black">A réservé une <span class="text-emerald-600 italic">Golf 8</span></p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-sm font-black text-gray-800">450 DH</p>
                            <p class="text-[10px] text-gray-400 italic">Il y a 15 min</p>
                        </div>
                    </div>
                    <hr class="border-gray-50">
                    <div class="flex items-center justify-between group">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 bg-blue-50 text-blue-600 rounded-full flex items-center justify-center font-black">S</div>
                            <div>
                                <p class="text-sm font-bold text-gray-800">Sara Bennani</p>
                                <p class="text-[10px] text-gray-400 uppercase font-black">Nouvel avis <span class="text-amber-500">★★★★★</span></p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-sm font-black text-gray-800">Avis</p>
                            <p class="text-[10px] text-gray-400 italic">Il y a 1 heure</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8">
                <h3 class="text-xl font-bold text-gray-800 mb-8 text-center italic">Performance Flotte</h3>
                <div class="space-y-8">
                    <div>
                        <div class="flex justify-between items-center mb-3">
                            <span class="text-xs font-black text-gray-500 uppercase tracking-widest">Économique</span>
                            <span class="text-sm font-black text-emerald-600">60%</span>
                        </div>
                        <div class="w-full bg-gray-100 h-3 rounded-full overflow-hidden">
                            <div class="bg-emerald-500 h-full w-[60%] rounded-full"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between items-center mb-3">
                            <span class="text-xs font-black text-gray-500 uppercase tracking-widest">Luxe & SUV</span>
                            <span class="text-sm font-black text-blue-600">30%</span>
                        </div>
                        <div class="w-full bg-gray-100 h-3 rounded-full overflow-hidden">
                            <div class="bg-blue-500 h-full w-[30%] rounded-full"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between items-center mb-3">
                            <span class="text-xs font-black text-gray-500 uppercase tracking-widest">Utilitaire</span>
                            <span class="text-sm font-black text-purple-600">10%</span>
                        </div>
                        <div class="w-full bg-gray-100 h-3 rounded-full overflow-hidden">
                            <div class="bg-purple-500 h-full w-[10%] rounded-full"></div>
                        </div>
                    </div>
                </div>
                
                <div class="mt-12 p-4 bg-emerald-900 rounded-2xl text-center">
                    <p class="text-emerald-400 text-[10px] font-bold uppercase tracking-widest mb-1">Objectif Mensuel</p>
                    <p class="text-white font-black text-xl italic">85% Atteint</p>
                </div>
            </div>

        </div>
    </main>
</body>
</html>