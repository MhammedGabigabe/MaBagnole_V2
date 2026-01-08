<?php
require_once "../models/Vehicule.php";

$vehicule = new Vehicule();

if (isset($_POST['idCategorie']) && is_numeric($_POST['idCategorie'])) {
    $vehicule->idCategorie = $_POST['idCategorie'];
    $vehicules = $vehicule->vehiculesCat();
} else {
    $vehicules = $vehicule->getAll();
}

foreach ($vehicules as $vehicule) {
?>
<button name="deatilsVehicule" value="<?= $vehicule['id_vehicule'] ?>"
    class="group bg-white rounded-3xl overflow-hidden border border-gray-100 shadow-sm hover:shadow-xl transition-all">
    
    <div class="relative h-60">
        <img src="<?= $vehicule['image'] ?>" class="w-full h-full object-cover">
        <div class="absolute top-4 right-4 bg-white/90 px-3 py-1 rounded-lg">
            <span class="text-emerald-700 font-bold"><?= $vehicule['prix_jour'] ?>DH</span>
            <span class="text-xs text-gray-500">/jour</span>
        </div>
    </div>

    <div class="p-6">
        <div class="flex justify-between items-center">
            <h3 class="text-xl font-bold text-gray-800">
                <?= $vehicule['marque'] ?> <?= $vehicule['modele'] ?>
            </h3>

            <?php if ($vehicule['disponibilite']) { ?>
                <span class="text-[10px] bg-emerald-100 text-emerald-700 font-bold px-2 py-1 rounded-md uppercase">
                    Disponible
                </span>
            <?php } else { ?>
                <span class="text-[10px] bg-red-100 text-red-700 font-bold px-2 py-1 rounded-md uppercase">
                    Loué
                </span>
            <?php } ?>
        </div>

        <div class="mt-4 flex items-center text-emerald-600 font-bold text-sm">
            Voir les détails <i class="fa-solid fa-arrow-right ml-2"></i>
        </div>
    </div>
</button>
<?php
}
