<!--noindex-->
<style>
  :root {
    --footer-bg: linear-gradient(180deg, #5e2a2a 0%, #3a1818 100%);
    --footer-text: #eee;
    --footer-link: #4ea3ff;
    --footer-link-hover: #82c0ff;
    --footer-border: rgba(255,255,255,0.08);
  }

  /* КНОПКА "ВВЕРХ" — компактная, круглая */
  #toTop {
    position: fixed;
    right: 24px;
    bottom: 24px;
    width: 44px;
    height: 44px;
    display: none;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    background: #4a0f1f;
    background: linear-gradient(180deg, #5a1626 0%, #380a15 100%);
    color: #fff;
    font-size: 18px;
    border: 1px solid rgba(255,255,255,0.15);
    box-shadow: 0 4px 14px rgba(0,0,0,0.4);
    text-decoration: none;
    z-index: 2000;
    transition: 0.2s ease;
  }
  #toTop svg {
    width: 20px;
    height: 20px;
    fill: #fff;
  }
  #toTop:hover {
    background: #6c1a2f;
    transform: scale(1.08);
  }
  #toTop:hover {
    background: #333;
    transform: translateY(-50%) scale(1.05);
  }

  /* ФУТЕР */
  #footer {
    font-family: "Arial Narrow", sans-serif;
    color: var(--footer-text);
    margin-top: 40px;
  }

  .footer-shell {
    background: var(--footer-bg);
    border-top: 1px solid var(--footer-border);
    box-shadow: 0 -8px 24px rgba(0,0,0,0.4);
  }

  .footer-inner {
    max-width: 1280px;
    margin: 0 auto;
    padding: 48px 20px 24px;
  }

  /* Сетка */
  .footer-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
    gap: 28px;
  }
  .footer-col h3 {
    font-size: 18px;
    margin-bottom: 10px;
    font-weight: bold;
    color: var(--footer-text);
  }
  .footer-col a {
    display: block;
    font-size: 15px;
    line-height: 1.7;
    color: var(--footer-link);
    text-decoration: none;
  }
  .footer-col a:hover { text-decoration: underline; color: var(--footer-link-hover); }

  /* Баннеры */
  .footer-banners {
    margin: 36px 0;
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    gap: 14px;
  }
  .footer-banners img {
    width: 88px;
    height: 31px;
    border-radius: 4px;
    box-shadow: 0 2px 6px rgba(0,0,0,0.4);
    background: #fff;
    padding: 2px;
  }

  /* Нижняя строка */
  .footer-bottom {
    font-size: 14px;
    text-align: center;
    border-top: 1px solid var(--footer-border);
    padding: 22px 10px 30px;
    line-height: 1.7;
    color: #ccc;
  }

  /* СБРОС старых float */
  #footer [style*="float"] { float: none !important; }
  /* Убираем br в верхней части футера, но НЕ в нижней */
#footer .footer-inner br { display: none; }
#footer .footer-bottom br { display: inline; }

  @media(max-width: 600px) {
    #toTop { right: 12px; width: 38px; height: 38px; }
    .footer-inner { padding: 36px 16px; }
  }
/* Show button only on scroll */
  window.addEventListener('scroll', function(){
    const btn = document.getElementById('toTop');
    if(window.scrollY > 300){ btn.style.display = 'flex'; }
    else { btn.style.display = 'none'; }
  });

</style>

<a id="toTop" href="#">?</a>

<div id="footer">
  <div class="footer-shell">
    <div class="footer-inner">

      <div class="footer-grid">

        <div class="footer-col">
          <h3>Архиерей</h3>
          <a href="arhierei.php">Биография</a>
          <a href="slovo_padre.php">Слово архипастыря</a>
          <a href="raspisanie.php">Служение</a>
        </div>

        <div class="footer-col">
          <h3>Новости</h3>
          <a href="news.php">Новости епархии</a>
          <a href="anons.php">Анонсы</a>
          <a href="pub.php">Публикации</a>
        </div>

        <div class="footer-col">
          <h3>Медиа</h3>
          <a href="video.php">Видео</a>
          <a href="sv_vecher.php">Радиопередача «Светлый вечер»</a>
        </div>

        <div class="footer-col">
          <h3>Документы</h3>
          <a href="doks.php?tip=ukaz">Указы</a>
          <a href="doks.php?tip=raspor">Распоряжения</a>
          <a href="doks.php?tip=cirk">Циркуляры</a>
          <a href="doks.php?tip=udostoverenie">Удостоверения</a>
        </div>

        <div class="footer-col">
          <h3>Епархия</h3>
          <a href="histor.php">История</a>
          <a href="upravlenie.php">Управление</a>
          <a href="otdel.php">Отделы</a>
        </div>

        <div class="footer-col">
          <h3>Приходы</h3>
          <a href="mon.php">Жадовский монастырь</a>
          <a href="prihods.php">Действующие приходы</a>
          <a href="old_prihods.php">Разрушенные храмы</a>
          <a href="map.php">Карта приходов</a>
        </div>

        <div class="footer-col">
          <h3><a href="kontakt.php">Контакты</a></h3>
        </div>

      </div>

      <div class="footer-banners">
        

        <a href="http://www.patriarchia.ru/index.html"><img src="http://www.patriarchia.ru/images/patr_banner_88.gif"></a>
        <a href="https://mitropolia-simbirsk.ru/" target="_blank"><img src="IMG/simbmitropolia.png"></a>
        <a href="http://www.ekzeget.ru" target="_blank"><img src="http://www.екzeget.ru/IMG/banner.gif"></a>
        <a href="http://лука-крымский.рф/" target="_blank"><img src="/IMG/386.jpg"></a>
        <a href="http://vsehsvjatyh-glotovka.prihod.ru/" target="_blank"><img src="http://prihod.ru/pravbanners/vsehsvjatyh-glotovka.png"></a>

        <!-- 24LOG block fully removed as requested -->
      </div>

      <div class="footer-bottom">
          <span style="color:#eee; font-size:14px; align-self:center; margin-right:12px;">© Барышская епархия, 2012 – <?php echo date("Y"); ?> гг. · Создание сайта: <a href="mailto:zhidkoff@list.ru" style="color:#4ea3ff;">Сергей Жидков</a></span>
        <?php
          list($msec,$sec)=explode(chr(32),microtime());
          $skor_gen=(round(($sec+$msec)-$mTimeStart,4));
          echo '<span style="font-family: \'Arial Narrow\'; font-weight: normal;">Страница сгенерирована за <b>'.$skor_gen.'</b> сек.</span>';
        ?>
      </div>

    </div>
  </div>
</div>
<!--/noindex-->