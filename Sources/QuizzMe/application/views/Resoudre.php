<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>




<style>
.demo-card-square.mdl-card {
  width: 320px;
}
.demo-card-square > .mdl-card__title {
  color: #fff;
  <?php  if (1/**isset($illustration)**/) {
    echo "background:
      url('";
    echo $illustration;
    echo "') bottom right 15% no-repeat #ff4081;";
  } else {
    echo "background: red;";
  }
  ?>
}
</style>




<div class="mdl-grid">
  <div class="mdl-cell mdl-cell--6-col">
    <div class="demo-card-square mdl-card mdl-shadow--2dp">
    <div class="mdl-card__supporting-text">
      <?php $this->load->helper('form');
      ?>

      <form action="Student/Reponses/<?php echo $code; ?>/<?php echo $eleve; ?>" method="post">
              <?php if (isset($mega)): ?>
        <?php

        $i = 0;
        foreach ($mega as $key) {
          echo $key->question;
          if (isset($key->rep1)) {
            echo '<label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="';
            echo $key->rep1.''.strval($i);
            echo '">
              <input type="checkbox" name="check_list[]" id="';
              echo $key->rep1.''.strval($i);
              echo '" class="mdl-checkbox__input" value="'.$i.'">
              <span class="mdl-checkbox__label">'.$key->rep1.'</span>
            </label>';
            $i++;
          }
          if (isset($key->rep2)) {
            echo '<label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="';
            echo $key->rep2.''.strval($i);
            echo '">
              <input type="checkbox" name="check_list[]" id="';
              echo $key->rep2.''.strval($i);
              echo '" class="mdl-checkbox__input" value="'.$i.'">
              <span class="mdl-checkbox__label">'.$key->rep2.'</span>
            </label>';
            $i++;
          }
          if (isset($key->rep3)) {
            echo '<label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="';
            echo $key->rep3.''.strval($i);
            echo '">
              <input type="checkbox" name="check_list[]" id="';
              echo $key->rep3.''.strval($i);
              echo '" class="mdl-checkbox__input" value="'.$i.'">
              <span class="mdl-checkbox__label">'.$key->rep3.'</span>
            </label>';
            $i++;
          }
          if (isset($key->rep4)) {
            echo '<label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="';
            echo $key->rep4.''.strval($i);
            echo '">
              <input type="checkbox" name="check_list[]" id="';
              echo $key->rep4.''.strval($i);
              echo '" class="mdl-checkbox__input" value="'.$i.'">
              <span class="mdl-checkbox__label">'.$key->rep4.'</span>
            </label>';
            $i++;
          }
          echo "<br><br>";
        }

        ?>
      </div>
      <?php endif; ?>

      <div class="mdl-card__actions mdl-card--border"  >
        <button class="mdl-button mdl-js-button" name="submit" type="submit">
            Envoyer mes réponses
        </button>
      </div>
    </div>

    </form>

  </div>
  <div class="mdl-cell mdl-cell--6-col">
  <div class="demo-card-square mdl-card mdl-shadow--2dp">
    <div class="mdl-card__title mdl-card--expand">
      <h2 class="mdl-card__title-text"><?php echo $intitule; ?></h2>
    </div>
    <div class="mdl-card__supporting-text">
      Bienvenue dans le Quizz !
    </div>
  </div>
</div>
</div>





<br>
</div>
