<!-- ===========================
      HEAD ()
=========================== -->

<meta charset="UTF-8">

<meta name="keywords" content=" ,   ,  , , , ,  ">

<!--    -->
<link rel="stylesheet" href="/style.css">
<link rel="stylesheet" href="/styles.css">
<link rel="stylesindex" href="/index1.css">

<!-- Preload   -->
<link rel="preload" href="/js/jquery.min.js" as="script">
<link rel="preload" href="/js/baguetteBox.min.js" as="script">
<link rel="preload" href="/css/baguetteBox.min.css" as="style">

<!-- Favicon -->
<link rel="icon" href="/favicon.ico" type="image/x-icon">
<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">

<!-- baguetteBox () -->
<link rel="stylesheet" href="/css/baguetteBox.min.css">

<!-- jQuery () -->
<script src="/js/jquery.min.js" defer></script>

<!-- baguetteBox () -->
<script src="/js/baguetteBox.min.js" defer></script>

<!-- Font Awesome (CDN   webfonts) -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer">

<!-- RSS -->
<link rel="alternate" type="application/rss+xml" title="RSS" href="/rss.php">

<?php list($msec,$sec)=explode(" ",microtime()); $mTimeStart=$sec+$msec; ?>

<!-- ===========================

=========================== -->

<div class="head">

    <div class="head__inner">

        <!--   -->
        <div class="head__top">
            <div class="head__date">

            </div>

            <div class="head__icons">
                <a href="/rss.php" class="head__icon-link"><i class="fa-solid fa-square-rss"></i></a>
                <a href="https://pda.barysh-eparhia.ru/" class="head__icon-link"><i class="fa-solid fa-mobile-screen"></i></a>
                <a href="https://vk.com/barysheparhia" class="head__icon-link"><i class="fa-brands fa-vk"></i></a>

                <!--  -->
                <a href="javascript:void(0);" onclick="openSearch()" class="head__icon-link">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </a>
            </div>
        </div>

        <!--  +  -->
        <div class="head__branding">
            <a href="/"><img class="head__logo" src="/IMG/logo.png" loading="lazy"></a>

            <div class="head__text">
                <div class="head__title">

                </div>

                <div class="head__subtitle">
                          , <br>
                </div>
            </div>
        </div>

        <div class="head__divider"></div>

        <!--  -->
    </div>
</div>

<!-- ===========================

=========================== -->

<div id="search-popup" class="search-popup">
    <div class="search-popup__content">
        <div class="search-popup__title">  </div>

        <form action="/search.php">
            <input type="text" name="q" placeholder=" ..."
                class="search-popup__input">
        </form>

        <button onclick="closeSearch()"
                class="search-popup__button">

        </button>
    </div>
</div>

<!--   (  ) -->

<!-- ===========================
      JS
=========================== -->

<script defer>
function openSearch() {
    document.getElementById("search-popup").style.display = "block";
}
function closeSearch() {
    document.getElementById("search-popup").style.display = "none";
}
document.addEventListener("DOMContentLoaded", function() {
    if (document.querySelector('.gallery')) {
        baguetteBox.run('.gallery');
    }
});
</script>
