</div>
      </main>
    </div>


	<!--<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
-->

</body>
<script>
  Array.prototype.forEach.call(document.querySelectorAll('.mdl-card__media'), function(el) {
    var link = el.querySelector('a');
    if(!link) {
      return;
    }
    var target = link.getAttribute('href');
    if(!target) {
      return;
    }
    el.addEventListener('click', function() {
      location.href = target;
    });
  });
</script>
</html>
