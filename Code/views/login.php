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
    <title>MaBagnole | Connexion</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>
<body class="h-screen w-full flex overflow-hidden bg-gray-50">

    <div class="hidden md:flex md:w-4/5 bg-cover bg-center relative" 
         style="background-image: url('https://maghreb.simplonline.co/_next/image?url=https%3A%2F%2Fsimplonline-v3-prod.s3.eu-west-3.amazonaws.com%2Fmedia%2Fimage%2Fjpg%2Fmabagnole-694e4b819dc15769016369.jpg&w=1280&q=75');">
        <div class="absolute inset-0 bg-blue-900/20 "></div>
        <div class="relative z-10 m-12 self-end">
            <h1 class="text-5xl font-black text-white italic">MA<span class="text-blue-400">BAGNOLE</span></h1>
            <p class="text-white/80 text-xl mt-2 font-light">La liberté de rouler, en un clic.</p>
        </div>
    </div>

    <div class="w-full md:w-2/5 flex items-center justify-center p-8 bg-white shadow-2xl z-20">
        <div class="w-full max-w-sm">
            <div class="mb-10 text-center md:text-left">
                <h2 class="text-3xl font-bold text-gray-800">Connexion</h2>
                <p class="text-gray-500 mt-2">Heureux de vous revoir parmi nous.</p>
            </div>

            <form action="../controllers/login.php" method="POST" class="space-y-6">
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-2">Email</label>
                    <input type="email" name="email" required class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition-all">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-2">Mot de passe</label>
                    <input type="password" name="password" required class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition-all">
                </div>
                <button type="submit" name="seConnecter" class="w-full py-4 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl shadow-lg transition-transform active:scale-95">
                    SE CONNECTER
                </button>
            </form>

            <div class="mt-8 text-center">
                <p class="text-sm text-gray-600">Pas encore de compte ? 
                    <a href="register.php" class="text-blue-600 font-bold hover:underline italic">S'inscrire ici</a>
                </p>
            </div>
        </div>
    </div>

</body>
</html>