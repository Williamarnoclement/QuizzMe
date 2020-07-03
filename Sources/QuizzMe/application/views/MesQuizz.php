<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>




<div class="mdl-grid">
  <div class="mdl-cell mdl-cell--6-col">
    <div class="demo-card-wide mdl-card mdl-shadow--2dp">
      <div class="mdl-card__title">
        <h2 class="mdl-card__title-text">Bienvenue dans votre espace  <?php echo $session_data; ?></h2>
      </div>
      <div class="mdl-card__supporting-text">
        Bienvenue dans votre espace QuizzMe. Le gestionnaire de Quiz ! Vous pouvez construire de nouveaux Quizz ou bien regarder les résultats!
      </div>
      <!--<div class="mdl-card__actions mdl-card--border">-->
        <!--<a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" href="<?php echo site_url('Login') ?>">
          Espace Professeur
        </a> -->
      </div>
    </div>



  <div class="mdl-cell mdl-cell--6-col">
    <div class="demo-card-wide mdl-card mdl-shadow--2dp">
      <div class="mdl-card__title">
        <h2 class="mdl-card__title-text">Quizz</h2>
      </div>

      <?php
      foreach ($quizz_data->result_array() as $row)
      {
         echo "<div class='mdl-card__supporting-text'>";
         echo "<label class='mdl-switch mdl-js-switch mdl-js-ripple-effect' for='".$row['id']."'>
          <input type='checkbox' id='".$row['id']."' class='mdl-switch__input' onchange='check(this);'";
          if ($row['etat'] == 1) {
            echo "checked";
          }
          echo ">
          <span class='mdl-switch__label'>".$row['intitule']."</span>
        </label>";
        echo "<a href='MySpace/quizzManager/".$row['id']."'><div id='".$row['intitule']."_' class='icon material-icons'>cloud_upload</div>
                  <div class='mdl-tooltip' data-mdl-for='".$row['intitule']."_'>
                  <strong>Modifier le Quizz ".$row['intitule']."</strong></a>
                  </div>";

        echo "<div id='".$row['intitule']."__' onclick='window.alert(\"Le code partageable à vos élèves est ".$row['id']."\");' class='icon material-icons'>share</div>
        <div class='mdl-tooltip' for='".$row['intitule']."__'>
        Partager<br>votre Quizz
        </div>";
        echo "</div>";

      }
      ?>
      <div class="mdl-card__actions mdl-card--border">
        <!-- Colored FAB button with ripple -->
        <button class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored dialog-button">
          <i class="material-icons">add</i>
        </button>
        <!--<a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" href="<?php echo site_url('Login') ?>">
          Espace Professeur
        </a> -->
      </div>
    </div>
  </div>
</div>




<dialog id="dialog" class="mdl-dialog">
  <h3 class="mdl-dialog__title">Creer un nouveau Quizz</h3>
  <!--<form action="MySpace/create" method="post">
  <div class="mdl-dialog__content">
    <p>
      veuillez donner un nom à votre Quizz
    </p>
    <div class="mdl-textfield mdl-js-textfield">
      <input class="mdl-textfield__input" type="text" name="nomQuizz"  placeholder="Nom de votre nouveau Questionnaire" value="<?php set_value('nomQuizz'); ?>">
    </div>
  </div>
  <div class="mdl-dialog__actions">
    <button type="button" class="mdl-button">Annuler</button>
    <button type="submit" class="mdl-button" >Creer</button>
  </div>
</form>-->


<div class="mdl-card__supporting-text">
<?php $this->load->helper('form');
?>

<!--<form action="launch" method="post">-->
<?php echo form_open_multipart('MySpace/launch');?>
  <div class="mdl-textfield mdl-js-textfield">
    <input  class="mdl-textfield__input" type="text" name="intitule"  placeholder="intitulé du Quizz" value="<?php set_value('email'); ?>">
  </div>



  <input type="file" name="imageFile"  value="<?php set_value('imageFile'); ?>"/>



</div>
<div class="mdl-card__actions mdl-card--border"  type="submit">
<button class="mdl-button mdl-js-button">
    Valider
</button>
<button type="button" class="mdl-button close-button">Annuler</button>
</div>
</form>
</dialog>
<script type="text/javascript">
(function() {
  'use strict';
  var dialogButton = document.querySelector('.dialog-button');
  var dialog = document.querySelector('#dialog');
  if (! dialog.showModal) {
    dialogPolyfill.registerDialog(dialog);
  }
  dialogButton.addEventListener('click', function() {
     dialog.showModal();
  });
  dialog.querySelector('.close-button')
  .addEventListener('click', function() {
    dialog.close();
  });
}());
</script>
<script>
function check(ch){
  window.location.href = "<?php  echo site_url('MySpace/switchState') ?>/"+ch.id;
}

</script>
