<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>


    <div class="demo-card-square mdl-card mdl-shadow--2dp">
  <div class="mdl-card__title mdl-card--expand">
    <h2 class="mdl-card__title-text">Informations sur le Quizz <?php
    echo $nomQuizz;
     ?></h2>
  </div>
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
  </div>
  </form>
</div>
