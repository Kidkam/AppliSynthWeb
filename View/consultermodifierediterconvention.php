<div>
    <form id="rechercheConvention" method="POST" action="../Controller/ModifierediterconventionController.php">
        <input id="numeroConvention" type="number" placeholder="N°">
        <input id="nomConvention" type="text" placeholder="Nom">
        <button type="submit" name="btnRechercher">Rechercher</button>
    </form>
</div>
<?=$daoConvention->afficherTabConvention();?>
<div>
   <form id="retour" method="POST" action="../Controller/MenugestionconventionController.php">
        <button type="submit" name="btnRetour">Retour</button>
    </form>
</div>