<?php
$vars = array(
    'arhi',
    'slovo_padre',
    'raspisanie',
    'new',
    'anons',
    'pub',
    'histor',
    'barysh',
    'upravlenie',
    'otdel',
    'klir',
    'mon',
    'prihods',
    'old_prihods',
    'map',
    'video',
    'gazeta',
    'radio',
    'kontakt',
    'top',
    'tip'
);

foreach ($vars as $v) {
    if (!isset($$v))
        $$v = '';
}
?>

<div class="main-nav">
    <ul class="nav-level-1">

        <!-- ÀÐÕÈÅÐÅÉ -->
        <li class="has-sub">
            <a class="nav-main-link">Àðõèåðåé</a>
            <ul class="nav-level-2">

                <li <?= $arhi == 'yes' ? 'class="active"' : '' ?>>
                    <a <?= $arhi == 'yes' ? '' : 'href="arhierei.php"' ?>>Áèîãðàôèÿ</a>
                </li>

                <li <?= $slovo_padre == 'yes' ? 'class="active"' : '' ?>>
                    <a <?= $slovo_padre == 'yes' ? '' : 'href="slovo_padre.php"' ?>>Ñëîâî àðõèïàñòûðÿ</a>
                </li>

                <li <?= $raspisanie == 'yes' ? 'class="active"' : '' ?>>
                    <a <?= $raspisanie == 'yes' ? '' : 'href="raspisanie.php"' ?>>Ñëóæåíèå</a>
                </li>

            </ul>
        </li>


        <!-- ÍÎÂÎÑÒÈ -->
        <li class="has-sub">
            <a class="nav-main-link">Íîâîñòè</a>
            <ul class="nav-level-2">

                <li <?= $new == 'yes' ? 'class="active"' : '' ?>>
                    <a <?= $new == 'yes' ? '' : 'href="news.php"' ?>>Íîâîñòè åïàðõèè</a>
                </li>

                <li <?= $anons == 'yes' ? 'class="active"' : '' ?>>
                    <a <?= $anons == 'yes' ? '' : 'href="anons.php"' ?>>Àíîíñû è îáúÿâëåíèÿ</a>
                </li>

                <li <?= $pub == 'yes' ? 'class="active"' : '' ?>>
                    <a <?= $pub == 'yes' ? '' : 'href="pub.php"' ?>>Ïóáëèêàöèè</a>
                </li>

            </ul>
        </li>


        <!-- ÄÎÊÓÌÅÍÒÛ -->
        <li class="has-sub">
            <a class="nav-main-link">Äîêóìåíòû</a>
            <ul class="nav-level-2">

                <li <?= $tip == 'ukaz' ? 'class="active"' : '' ?>>
                    <a <?= $tip == 'ukaz' ? '' : 'href="doks.php?tip=ukaz"' ?>>Óêàçû</a>
                </li>

                <li <?= $tip == 'raspor' ? 'class="active"' : '' ?>>
                    <a <?= $tip == 'raspor' ? '' : 'href="doks.php?tip=raspor"' ?>>Ðàñïîðÿæåíèÿ</a>
                </li>

                <li <?= $tip == 'cirk' ? 'class="active"' : '' ?>>
                    <a <?= $tip == 'cirk' ? '' : 'href="doks.php?tip=cirk"' ?>>Öèðêóëÿðû</a>
                </li>

                <li <?= $tip == 'udostoverenie' ? 'class="active"' : '' ?>>
                    <a <?= $tip == 'udostoverenie' ? '' : 'href="doks.php?tip=udostoverenie"' ?>>Óäîñòîâåðåíèÿ</a>
                </li>

            </ul>
        </li>


        <!-- ÅÏÀÐÕÈß -->
        <li class="has-sub">
            <a class="nav-main-link">Åïàðõèÿ</a>
            <ul class="nav-level-2">

                <li <?= $histor == 'yes' ? 'class="active"' : '' ?>>
                    <a <?= $histor == 'yes' ? '' : 'href="histor.php"' ?>>Èñòîðèÿ</a>
                </li>

                <li <?= $barysh == 'yes' ? 'class="active"' : '' ?>>
                    <a <?= $barysh == 'yes' ? '' : 'href="barysh.php"' ?>>Àðõèåðåè Áàðûøñêîé åïàðõèè</a>
                </li>

                <li <?= $upravlenie == 'yes' ? 'class="active"' : '' ?>>
                    <a <?= $upravlenie == 'yes' ? '' : 'href="upravlenie.php"' ?>>Óïðàâëåíèå</a>
                </li>

                <li <?= $otdel == 'yes' ? 'class="active"' : '' ?>>
                    <a <?= $otdel == 'yes' ? '' : 'href="otdel.php"' ?>>Îòäåëû</a>
                </li>

                <li <?= $klir == 'yes' ? 'class="active"' : '' ?>>
                    <a <?= $klir == 'yes' ? '' : 'href="klir.php"' ?>>Äóõîâåíñòâî</a>
                </li>

            </ul>
        </li>


        <!-- ÏÐÈÕÎÄÛ -->
        <li class="has-sub">
            <a class="nav-main-link">Ïðèõîäû</a>
            <ul class="nav-level-2">

                <li <?= $mon == 'yes' ? 'class="active"' : '' ?>>
                    <a <?= $mon == 'yes' ? '' : 'href="mon.php"' ?>>Æàäîâñêèé ìîíàñòûðü</a>
                </li>

                <li <?= $prihods == 'yes' ? 'class="active"' : '' ?>>
                    <a <?= $prihods == 'yes' ? '' : 'href="prihods.php"' ?>>Äåéñòâóþùèå ïðèõîäû</a>
                </li>

                <li <?= $old_prihods == 'yes' ? 'class="active"' : '' ?>>
                    <a <?= $old_prihods == 'yes' ? '' : 'href="old_prihods.php"' ?>>Ðàçðóøåííûå õðàìû</a>
                </li>

                <li <?= $map == 'yes' ? 'class="active"' : '' ?>>
                    <a <?= $map == 'yes' ? '' : 'href="map.php"' ?>>Êàðòà ïðèõîäîâ</a>
                </li>

            </ul>
        </li>


        <!-- ÌÅÄÈÀ -->
        <li class="has-sub">
            <a class="nav-main-link">Ìåäèà</a>
            <ul class="nav-level-2">

                <li <?= $video == 'yes' ? 'class="active"' : '' ?>>
                    <a <?= $video == 'yes' ? '' : 'href="video.php"' ?>>Âèäåî</a>
                </li>

                <li <?= $gazeta == 'yes' ? 'class="active"' : '' ?>>
<div class="mobile-menu-overlay" id="mobile-menu-overlay"></div>
    position: relative;
    z-index: 1200;
    margin: 0 auto;
    max-width: 1100px;
    width: 100%;
/*  */

/*     */

.mobile-menu-overlay {
    position: fixed;
    inset: 0;
    background: rgba(0, 0, 0, 0.45);
    opacity: 0;
    visibility: hidden;
    transition: opacity 0.3s ease;
    z-index: 1100;
    pointer-events: none;
}

.mobile-menu-overlay.is-visible {
    opacity: 1;
    visibility: visible;
    pointer-events: auto;
}

@media (max-width: 960px) {
    .main-nav {
        position: fixed;
        top: 0;
        left: 0;
        height: 100%;
        width: 80%;
        max-width: 330px;
        padding: 110px 18px 28px;
        box-shadow: 8px 0 26px rgba(0, 0, 0, 0.18);
        border-right: 1px solid #e7d8d0;
        background: linear-gradient(180deg, #fff8f5 0%, #f2e1da 100%);
        transform: translateX(-105%);
        transition: transform 0.3s ease;
        overflow-y: auto;
    }

    .main-nav.is-open {
        transform: translateX(0);
    }

    .nav-level-1 {
        flex-direction: column;
        align-items: flex-start;
        gap: 14px;
        padding: 0;
    }

    .nav-level-1 > li {
        width: 100%;
    }

    .nav-level-1 > li > a.nav-main-link {
        display: block;
        width: 100%;
    }

    .nav-level-2 {
        display: block;
        position: static;
        min-width: auto;
        background: transparent;
        box-shadow: none;
        border: none;
        padding: 6px 0 0 12px;
    }

    .nav-level-2 li a {
        padding: 6px 0;
    }

    .has-sub:hover .nav-level-2 {
        display: block;
    }

    body.menu-open {
        overflow: hidden;
    }
}
</style>
                </li>

            </ul>
        </li>


        <!-- ÊÎÍÒÀÊÒÛ -->
        <li <?= $kontakt == 'yes' ? 'class="active"' : '' ?>>
            <a <?= $kontakt == 'yes' ? '' : 'href="kontakt.php"' ?>>Êîíòàêòû</a>
        </li>

        <!-- ×ÈÒÀÅÌÎÅ -->
        <li <?= $top == 'yes' ? 'class="active"' : '' ?>>
            <a <?= $top == 'yes' ? 'style="color:#b33;opacity:.8"' : 'href="top.php"' ?>>×èòàåìîå</a>
        </li>

    </ul>
</div>

<style>
   .main-nav {
    background: #fff;
    padding: 12px 0;
    border-bottom: 1px solid #eee;
}

.nav-level-1 {
    list-style: none;
    margin: 0;
    padding: 0 20px;
    display: flex;
    gap: 28px;
    align-items: center;
    font-weight: 600;
}

.nav-level-1 > li {
    position: relative;
}

.nav-level-1 > li > a.nav-main-link {
    font-size: 1.05rem;
    color: #5c2f2f;
    cursor: pointer;
    padding: 6px 0;
    display: inline-block;
}

.nav-level-1 > li > a.nav-main-link:hover {
    color: #9b4747;
}

/* Ïîäìåíþ */
.nav-level-2 {
    display: none;
    position: absolute;
    left: 0;
    top: 34px;
    min-width: 220px;
    background: #fff;
    padding: 10px 0;
    list-style: none;
    border-radius: 12px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.15);
    border: 1px solid #f0e8e8;
    z-index: 50;
}

.has-sub:hover .nav-level-2 {
    display: block;
}

.nav-level-2 li a {
    display: block;
    padding: 8px 18px;
    color: #6c2f2f;
    font-size: 0.95rem;
}

.nav-level-2 li a:hover {
    background: #f7f3f3;
    color: #9b4747;
}

.nav-level-2 li.active > a {
    font-weight: 700;
    color: #8f3d3d;
}

/* Àêòèâíûé ïóíêò âåðõíåãî ìåíþ */
.nav-level-1 > li.active > a {
    color: #b04040 !important;
}
</style>