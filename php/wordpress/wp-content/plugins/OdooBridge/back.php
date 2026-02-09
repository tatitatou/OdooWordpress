<?php

function administration_add_admin_page() {
    add_submenu_page(
       'options-general.php',
       'Options OdooBridge',
       'Options OdooBridge',
       'manage_options',
       'administration',
       'administration_page'
    );
}
function administration_page() {
 
    if (isset($_POST['submit'])) {
        //on enregistre le parametre d'url si il est renseigné
        if (isset($_POST['urlOdoo'])) 
            update_option('urlOdoo', $_POST['urlOdoo']);
        //on enregistre le parametre de base de données si il est renseigné
        if (isset($_POST['dbOdoo'])) 
            update_option('dbOdoo', $_POST['dbOdoo']);                        
     } 
     $db_actuel = get_option('dbOdoo');
     $url_actuel = get_option('urlOdoo');
     ?>
     <div class="wrap OdooBridge OdooBridgeBack">
        <h1>Mes options</h1>
        <form method="post" action="">
            <label for="dbOdoo">Saisissez le nom de la base Odoo (ex: odoo18) : </label>
            <input class="input" id="dbOdoo" name="dbOdoo" value="<?php echo $db_actuel; ?>">
            <br/><label for="urlOdoo">Saisissez l'url d'Odoo (ex: http://web:8069): </label>
            <input id="urlOdoo" name="urlOdoo" value="<?php echo $url_actuel; ?>">
            <br/><input type="submit" name="submit" class="button button-primary" value="Enregistrer" />
        </form>
     </div>
     <?php
}
   add_action('admin_menu', 'administration_add_admin_page');