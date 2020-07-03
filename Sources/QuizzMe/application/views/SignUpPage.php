<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

    <div class="demo-card-square mdl-card mdl-shadow--2dp">
  <div class="mdl-card__title mdl-card--expand">
    <h2 class="mdl-card__title-text">S'inscrire</h2>
  </div>
  <div class="mdl-card__supporting-text">
    <?php $this->load->helper('form');
    ?>

    <form action="Registration/SignUp" method="post">
      <div class="mdl-textfield mdl-js-textfield">
        <input  class="mdl-textfield__input" type="text" name="email" required type="email"  placeholder="e-mail" value="<?php set_value('email'); ?>">
      </div>

      <div class="mdl-textfield mdl-js-textfield">
        <input class="mdl-textfield__input" type="text" name="name"  placeholder="Votre nom" value="<?php set_value('name'); ?>">
      </div>

      <div class="mdl-textfield mdl-js-textfield">
        <input class="mdl-textfield__input" type="password" name="password"  placeholder="mot de passe" value="<?php set_value('password'); ?>">
      </div>



  </div>
  <div class="mdl-card__actions mdl-card--border"  type="submit">
    <button class="mdl-button mdl-js-button">
        S'inscrire
    </button>
  </div>
  </form>
</div>
