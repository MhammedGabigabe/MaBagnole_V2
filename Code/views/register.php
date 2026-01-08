<?php
session_start();
if(isset($_SESSION['msg'])){
?>
<script>
    alert("<?=$_SESSION['msg'];?>");
</script>
<?php
unset($_SESSION['msg']);   
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MaBagnole | Inscription</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>
<body class="h-screen w-full flex overflow-hidden bg-gray-50">

    <div class="hidden md:flex md:w-4/5 bg-cover bg-center relative" 
         style="background-image: url('https://maghreb.simplonline.co/_next/image?url=https%3A%2F%2Fsimplonline-v3-prod.s3.eu-west-3.amazonaws.com%2Fmedia%2Fimage%2Fjpg%2Fmabagnole-694e4b819dc15769016369.jpg&w=1280&q=75');">
        <div class="absolute inset-0 bg-emerald-900/20 "></div>
        <div class="relative z-10 m-12 self-end">
            <h1 class="text-5xl font-black text-white italic">MA<span class="text-emerald-400">BAGNOLE</span></h1>
            <p class="text-white/80 text-xl mt-2 font-light">Créez votre profil et réservez en 2 minutes.</p>
        </div>
    </div>

    <div class="w-full md:w-2/5 flex items-center justify-center p-8 bg-white shadow-2xl z-20">
        <div class="w-full max-w-sm">
            <div class="mb-6">
                <h2 class="text-3xl font-bold text-gray-800">Inscription</h2>
                <p class="text-gray-500 mt-1">Rejoignez la communauté MaBagnole.</p>
            </div>

            <form action="../controllers/register.php" method="POST" class="space-y-3">
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-[10px] font-bold text-gray-700 uppercase mb-1">Nom</label>
                        <input type="text" name="nom" required class="w-full px-3 py-2 bg-gray-50 border border-gray-200 rounded-lg focus:border-emerald-500 outline-none text-sm">
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-gray-700 uppercase mb-1">Téléphone</label>
                        <input type="tel" name="telephone" required class="w-full px-3 py-2 bg-gray-50 border border-gray-200 rounded-lg focus:border-emerald-500 outline-none text-sm">
                    </div>
                </div>

                <div>
                    <label class="block text-[10px] font-bold text-gray-700 uppercase mb-1">Numéro CIN</label>
                    <input type="text" name="cin" required class="w-full px-3 py-2 bg-gray-50 border border-gray-200 rounded-lg focus:border-emerald-500 outline-none text-sm">
                </div>

                <div>
                    <label class="block text-[10px] font-bold text-gray-700 uppercase mb-1">Email</label>
                    <input type="email" name="email" required class="w-full px-3 py-2 bg-gray-50 border border-gray-200 rounded-lg focus:border-emerald-500 outline-none text-sm">
                </div>

                <div>
                    <label class="block text-[10px] font-bold text-gray-700 uppercase mb-1">Mot de passe</label>
                    <input type="password" name="password" required class="w-full px-3 py-2 bg-gray-50 border border-gray-200 rounded-lg focus:border-emerald-500 outline-none text-sm">
                </div>

                <button type="submit" name="creerCompte" value="" class="w-full py-3.5 bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-xl shadow-lg transition-transform active:scale-95 text-sm uppercase tracking-wide">
                    Créer mon compte
                </button>
            </form>

            <div class="mt-6 text-center">
                <p class="text-sm text-gray-600">Déjà membre ? 
                    <a href="login.php" class="text-emerald-600 font-bold hover:underline italic">Se connecter</a>
                </p>
            </div>
        </div>
    </div>

</body>
</html>