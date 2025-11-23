<!--noindex-->

<a id="toTop" href="#">?</a>

<div id="footer">
  <div class="footer-shell">
    <div class="footer-inner">

      <div class="footer-grid">

        <div class="footer-col">
          <h3></h3>
          <a href="arhierei.php"></a>
          <a href="slovo_padre.php"> </a>
          <a href="raspisanie.php"></a>
        </div>

        <div class="footer-col">
          <h3></h3>
          <a href="news.php"> </a>
          <a href="anons.php"></a>
          <a href="pub.php"></a>
        </div>

        <div class="footer-col">
          <h3></h3>
          <a href="video.php"></a>
          <a href="sv_vecher.php">  </a>
        </div>

        <div class="footer-col">
          <h3></h3>
          <a href="doks.php?tip=ukaz"></a>
          <a href="doks.php?tip=raspor"></a>
          <a href="doks.php?tip=cirk"></a>
          <a href="doks.php?tip=udostoverenie"></a>
        </div>

        <div class="footer-col">
          <h3></h3>
          <a href="histor.php"></a>
          <a href="upravlenie.php"></a>
          <a href="otdel.php"></a>
        </div>

        <div class="footer-col">
          <h3></h3>
          <a href="mon.php"> </a>
          <a href="prihods.php"> </a>
          <a href="old_prihods.php"> </a>
          <a href="map.php"> </a>
        </div>

        <div class="footer-col">
          <h3><a href="kontakt.php"></a></h3>
        </div>

      </div>

      <div class="footer-banners">


        <a href="http://www.patriarchia.ru/index.html"><img src="http://www.patriarchia.ru/images/patr_banner_88.gif"></a>
        <a href="https://mitropolia-simbirsk.ru/" target="_blank"><img src="IMG/simbmitropolia.png"></a>
        <a href="http://www.ekzeget.ru" target="_blank"><img src="http://www.zeget.ru/IMG/banner.gif"></a>
        <a href="http://-./" target="_blank"><img src="/IMG/386.jpg"></a>
        <a href="http://vsehsvjatyh-glotovka.prihod.ru/" target="_blank"><img src="http://prihod.ru/pravbanners/vsehsvjatyh-glotovka.png"></a>

        <!-- 24LOG block fully removed as requested -->
      </div>

      <div class="footer-bottom">
          <span class="footer-bottom-text">  , 2012  <?php echo date("Y"); ?> .   : <a href="mailto:zhidkoff@list.ru"> </a></span>
        <?php
          list($msec,$sec)=explode(chr(32),microtime());
          $skor_gen=(round(($sec+$msec)-$mTimeStart,4));
          echo '<span class="footer-gen-time">   <b>'.$skor_gen.'</b> .</span>';
        ?>
      </div>

    </div>
  </div>
</div>

<script>
window.addEventListener('scroll', function(){
  const btn = document.getElementById('toTop');
  if(window.scrollY > 300){ btn.style.display = 'flex'; }
  else { btn.style.display = 'none'; }
});
</script>

<!--/noindex-->
