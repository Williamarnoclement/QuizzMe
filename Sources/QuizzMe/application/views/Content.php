<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php //echo "bonjour"; ?>



<div class="mdl-grid">
  <div class="mdl-cell mdl-cell--6-col">
    <div class="demo-card-wide mdl-card mdl-shadow--2dp">
      <div class="mdl-card__title">
        <h2 class="mdl-card__title-text">Espace Enseignant</h2>
      </div>
      <div class="mdl-card__supporting-text">
        Bienvenue dans QuizzMe. Le gestionnaire de Quiz ! Vous êtes professeur. Construisez des questionnaires en lignes pour vos élèves.
      </div>
      <div class="mdl-card__actions mdl-card--border">
        <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" href="<?php echo site_url('MySpace') ?>">
          Acceder à mon espace
        </a>
      </div>
    </div>
  </div>
  <div class="mdl-cell mdl-cell--4-col">
    <div class="demo-card-square mdl-card mdl-shadow--2dp">
      <div class="mdl-card__title mdl-card--expand">
        <h2 class="mdl-card__title-text">Espace élève</h2>
      </div>
      <div class="mdl-card__supporting-text">
        En tant qu'élève, vous pouvez résoudre des questionnaires en ligne. Pour commencer, entrez le code du Quiz.
      </div>
      <?php if (isset($cle_correction)) {
        echo "<div style='color: red;'>";
        echo "Votre clé d'accès à la correction est : ";
        echo $cle_correction;
        echo "</div>";
      } ?>
      <div class="mdl-card__actions mdl-card--border">
        <?php $this->load->helper('form');?>
        <?php echo form_open_multipart('Student');?>
          <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            <input class="mdl-textfield__input" type="text" pattern="-?[0-9]*(\.[0-9]+)?" name="codeQuizz" value="<?php set_value('codeQuizz'); ?>">
            <label class="mdl-textfield__label" for="codeQuizz">Code Quizz</label>
            <span class="mdl-textfield__error">Veuillez entrer le numero du quizz!</span>
          </div>

          <div class="mdl-textfield mdl-js-textfield">
            <input class="mdl-textfield__input" type="text" name="nomPrenom" value="<?php set_value('nomPrenom'); ?>">
            <label class="mdl-textfield__label" for="nomPrenom">Prenom NOM</label>
          </div>

          <button class="mdl-button mdl-js-button mdl-button--accent">
            Acceder au Questionnaire
          </button>
        </form>
        <div class="mdl-card__actions mdl-card--border">
        </div>
      <div class="mdl-card__supporting-text">
        Chaque élève peut accèder à son score une fois le Questionnaire expiré. Entrez Votre code pour voir votre note !
      </div>
      <div class="mdl-card__actions mdl-card--border">
        <?php $this->load->helper('form');?>
        <?php echo form_open_multipart('Scoring');?>
          <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            <input class="mdl-textfield__input" type="text" pattern="-?[0-9]*(\.[0-9]+)?" name="codeScore" value="<?php set_value('codeScore'); ?>">
            <label class="mdl-textfield__label" for="codeScore">Code Score</label>
            <span class="mdl-textfield__error">Veuillez entrer votre numéro élève!</span>
          </div>

          <button class="mdl-button mdl-js-button mdl-button--accent">
            Acceder au Score
          </button>
        </form>
      </div>
    </div>
  </div>
  </div>
</div>
