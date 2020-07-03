<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="mdl-grid">
  <div class="mdl-cell mdl-cell--6-col">
    <div class="demo-card-wide mdl-card mdl-shadow--2dp">
      <div class="mdl-card__title">
        <h2 class="mdl-card__title-text">Informations sur le Quizz <?php
        echo $nomQuizz;
        ?></h2>
      </div>
      <div class="mdl-card__supporting-text">
        Ceci est l'espace de creation de quizz. Vous pouvez gerer les questions/réponses à vos questionnaires.
      </div>
      <div class="mdl-card__title">
      <h2 class="mdl-card__title-text">Statistiques sur le Quizz <?php
      echo $nomQuizz;
      ?></h2>
      </div>
      <div class="mdl-card__supporting-text">
        Moyenne des notes : <?php echo $moyenne; ?>
      </div>
      <br>
      <a href="<?php echo site_url('MySpace') ?>">
      <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
        < Revenir à la liste des Quizz
      </button>
      </a>
      <!--<div class="mdl-card__actions mdl-card--border">-->
        <!--<a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" href="<?php echo site_url('Login') ?>">
          Espace Professeur
        </a> -->
      </div>
    </div>



  <div class="mdl-cell mdl-cell--6-col">
    <div class="demo-card-wide mdl-card mdl-shadow--2dp">
      <div class="mdl-card__title">
        <h2 class="mdl-card__title-text">Questions</h2>
      </div>
      <?php if (isset($mega)): ?>


      <div class="mdl-card__supporting-text">
        <?php
        /**foreach ($valeurs as $key => $go) {
          echo $go['taco'];
          echo $go['r1'];
          echo $go['r2'];
          echo $go['r3'];
          echo $go['r4'];
        }**/

        foreach ($mega as $key) {
          echo $key->question;
          echo "(";
          if (isset($key->rep1)) {
            echo $key->rep1;
          }
          echo ",";
          if (isset($key->rep2)) {
            echo $key->rep2;
          }
          echo ",";
          if (isset($key->rep3)) {
            echo $key->rep3;
          }
          echo ",";
          if (isset($key->rep4)) {
            echo $key->rep4;
          }
          echo ")";
          echo "<br>";
        }
        ?>
      </div>
      <?php endif; ?>

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
  <h3 class="mdl-dialog__title">Creer une nouvelle question</h3>



<div class="mdl-card__supporting-text">
<?php $this->load->helper('form');


?>

<?php echo form_open_multipart('MySpace/AddQA/'.$currentId.'');?>
<div class="mdl-textfield mdl-js-textfield">
  <input  class="mdl-textfield__input" type="text" name="question"  placeholder="Votre question.." value="<?php set_value('question'); ?>">
</div>


<!-- Ceci est l'entrée des réponses-->
<div class="mdl-textfield mdl-js-textfield">
  <input  class="mdl-textfield__input" type="text" name="reponse1"  placeholder="Première réponse" value="<?php set_value('reponse'); ?>">
</div>
<label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-1deux">
  <input type="radio" id="option-1deux" class="mdl-radio__button" name="options1" value="1" checked value="<?php set_value('options1'); ?>">
  <span class="mdl-radio__label">Vrai</span>
</label>
<label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-2deux">
  <input type="radio" id="option-2deux" class="mdl-radio__button" name="options1" value="0" value="<?php set_value('options1'); ?>">
  <span class="mdl-radio__label">Faux</span>
</label>

<div class="mdl-textfield mdl-js-textfield">
  <input  class="mdl-textfield__input" type="text" name="reponse2"  placeholder="Deuxième réponse" value="<?php set_value('reponse'); ?>">
</div>
<label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-1trois">
  <input type="radio" id="option-1trois" class="mdl-radio__button" name="options2" value="1" checked>
  <span class="mdl-radio__label">Vrai</span>
</label>
<label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-2trois">
  <input type="radio" id="option-2trois" class="mdl-radio__button" name="options2" value="0">
  <span class="mdl-radio__label">Faux</span>
</label>

<div class="mdl-textfield mdl-js-textfield">
  <input  class="mdl-textfield__input" type="text" name="reponse3"  placeholder="Troisième réponse" value="<?php set_value('reponse'); ?>">
</div>
<label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-1quatre">
  <input type="radio" id="option-1quatre" class="mdl-radio__button" name="options3" value="1" checked>
  <span class="mdl-radio__label">Vrai</span>
</label>
<label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-2quatre">
  <input type="radio" id="option-2quatre" class="mdl-radio__button" name="options3" value="0">
  <span class="mdl-radio__label">Faux</span>
</label>

<div class="mdl-textfield mdl-js-textfield">
  <input  class="mdl-textfield__input" type="text" name="reponse4"  placeholder="Quatrième réponse" value="<?php set_value('reponse'); ?>">
</div>
<label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-1">
  <input type="radio" id="option-1" class="mdl-radio__button" name="options4" value="1" checked>
  <span class="mdl-radio__label">Vrai</span>
</label>
<label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-2">
  <input type="radio" id="option-2" class="mdl-radio__button" name="options4" value="0">
  <span class="mdl-radio__label">Faux</span>
</label>


<div class="mdl-card__actions mdl-card--border"  type="submit">
<button class="mdl-button mdl-js-button">
    Valider
</button>
<button type="button" class="mdl-button close-button">Annuler</button>
</div>
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
