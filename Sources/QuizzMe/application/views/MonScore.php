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
      <span class="mdl-layout-title">Correction au questionnaire</span>
      <br>
      <?php $this->load->helper('form');
      ?>
              <?php if (isset($mega)): ?>
        <?php

        $i = 0;
        foreach ($mega as $key) {
          echo '<p><b>'.$key->question.'</b></p>';

          if (isset($key->rep1)) {
            if ($key->b1 == true) {
              echo "<p style='color:green;'>";
            }else {
              echo "<p style='color:red;'>";
            }
            echo $key->rep1.'</p>';
          }
          if (isset($key->rep2)) {
            if ($key->b2 == true) {
              echo "<p style='color:green;'>";
            }else {
              echo "<p style='color:red;'>";
            }
            echo $key->rep2.'</p>';
          }
          if (isset($key->rep3)) {
            if ($key->b3 == true) {
              echo "<p style='color:green;'>";
            }else {
              echo "<p style='color:red;'>";
            }
            echo $key->rep3.'</p>';
          }
          if (isset($key->rep4)) {
            if ($key->b4 == true) {
              echo "<p style='color:green;'>";
            }else {
              echo "<p style='color:red;'>";
            }
            echo $key->rep4.'</p>';
          }
          echo "<br><br>";
        }

        ?>
      </div>
      <?php endif; ?>

    </div>


  </div>
  <div class="mdl-cell mdl-cell--6-col">
  <div class="demo-card-square mdl-card mdl-shadow--2dp">
    <div class="mdl-card__title mdl-card--expand">
      <h2 class="mdl-card__title-text">Votre score au Quizz  <?php echo $intitule; ?></h2>
    </div>
    <div class="mdl-card__supporting-text">
      <p>Eleve : <?php echo $eleve; ?></p>
      <p>Note : <?php echo $note; ?></p>
    </div>
  </div>
</div>
</div>





<br>
</div>
