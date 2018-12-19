<?php
include "template/header.php";
require "modele/db.php";
require "modele/empruntsManager.php";
require "modele/materielsManager.php";

?>
<main>
  <div class="container">
    <section class="d-flex flex-row justify-content-between">
      <h1 class="col-4 mt-0">Emprunter du matériel</h1>
<form action="emprunts.php<?php echo (isset($_POST['choix']))?'?tri='.$_POST['choix']:''; ?>" method="post" name="tri">
      <!-- <form action="emprunts.php?tri=" method="post" name="tri"> -->
  <div class="form-row align-items-center">
    <div class="col-auto my-1">
      <label class="mr-sm-2 sr-only" for="inlineFormCustomSelect">Preference</label>
      <select name="choix" class="custom-select mr-sm-2" id="inlineFormCustomSelect">
        <option selected>Options</option>
        <option value="1">noms de A à Z</option>
        <option value="2">noms de Z à A</option>
        <option value="3">dispo ou pas</option>
      </select>
    </div>
    <div class="col-auto my-1">
    </div>
    <div class="col-auto my-1">
      <button type="submit" class="btn btn-primary">OK</button>
    </div>
  </div>
</form>

>>>>>>> master
    </section>
    </div>
    <div class="container">
      <table class="table table-hover">
        <thead class="thead-light">
          <tr>
            <th scope="col-2" >Matériel</th>
            <th scope="col-2" class="d-none d-md-table-cell text-center">Description</th>
            <th scope="col-2" class="d-none d-md-table-cell text-center">Etat</th>
            <th scope="col-2" class="d-none d-md-table-cell text-center">Accessibilité</th>
            <th scope="col-2" >Emprunter</th>
          </tr>
        </thead>
        <?php
        if (isset($_POST['choix'])) {
          switch ($_POST['choix']) {
            case 1:
              $result = orderByAz($db);
              break;
              case 2:
                $result = orderByZa($db);
              break;
              case 3:
                $result = orderByEtat($db);
              break;
      }
    }else{
      $result = getMateriels($db);

    }
        //récupère toutes les entrées de la table materiel
        //affiche les données sur chaque entrée dans le tableau
          foreach ($result as $key => $value) {
         ?>
        <tbody>
          <tr>
            <td scope="row"><?php echo $value['nom'] ?></td>
            <td class="d-none d-md-table-cell text-center"><?php echo $value['description'] ?> </td>
            <td class="d-none d-md-table-cell text-center"><?php echo ($value['etat']== 1)?"En stock":"Indisponible"; ?></td>
            <td class="d-none d-md-table-cell text-center"><?php echo ($value['acces']==1)?"Libre":"Restreint"; ?></td>
            <td>
              <div>
                <a <?php setHref('emprunts/ajout') ?> href="<?php echo 'service/empruntsTraitement.php?id='. $value['id'].'&etat=' . $value['etat']; ?>" class='btn btn-primary btn-xs text-center <?php echo ($value['etat']== 0)?"disabled bts-secondary":""; ?> ' > Emprunter</a>
              </div>

            </td>
          </tr>
        <?php
          }
          ?>
        </tbody>
      </table>
    </div>
</main>
<?php
include "template/footer.php";
?>
