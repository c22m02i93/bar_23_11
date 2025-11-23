<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

require_once 'db.php';
require_once 'logic.php';


/**
 * Ограничение текста по количеству слов
 */
function limitWords($text, $limit = 50)
{
    // убираем HTML-теги
    $text = strip_tags($text);

    // разбиваем по пробелам
    $words = preg_split('/\s+/u', $text, -1, PREG_SPLIT_NO_EMPTY);

    if (count($words) <= $limit) {
        return $text;
    }

    $cut = array_slice($words, 0, $limit);
    return implode(' ', $cut) . '…';
}

// Данные
$news_day = getNewsDay();
$dtn_day = $news_day['data'];
$hod_today = getHodToday();

$calendar = getEparchyCalendar();
$prestoly = getPrestolToday();

$anons = getAnons(2, $dtn_day);
$publish = getPublish(3, $dtn_day);

$mix = getMixedNews($dtn_day);
$videosHTML = renderVideoBlock(2);

$slovo = getSlovoPadre();
?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <?php include 'head.php'; ?>
    <title>Барышская епархия</title>

    <style>
        /* БАЗА */

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            /*background: radial-gradient(circle at top, #f2f5ff 0, #e6ecff 30%, #f9fbff 70%, #ffffff 100%);*/
            color: #333;
        }

        a {
            color: #4a4a95;
            text-decoration: none;
        }

        a:hover {
            color: #26266e;
            text-decoration: underline;
        }

        img {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
        }

        /* ГЛОБАЛЬНЫЙ КОНТЕЙНЕР */

        .page-wrapper {
            max-width: 1200px;
            margin: 0 auto 40px auto;
            padding: 0 16px 24px 16px;
            /*box-shadow: 0 18px 40px rgba(0, 0, 0, 0.18);*/
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(18px);
            -webkit-backdrop-filter: blur(18px);
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.7);
        }

        /* ОСНОВНАЯ СЕТКА */

        .layout {
            display: flex;
            gap: 24px;
            margin-top: 16px;
        }

        .sidebar {
            flex: 0 0 32%;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .main-column {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        @media (max-width: 900px) {
            .layout {
                flex-direction: column-reverse;
            }

            .sidebar {
                flex-basis: auto;
            }
        }

        /* КАРТОЧКИ / БЛОКИ */

        .card {
            background: rgba(255, 255, 255, 0.75);
            border-radius: 16px;
            padding: 16px 18px;
            border: 1px solid rgba(255, 255, 255, 0.65);
            box-shadow: 0 8px 26px rgba(0, 0, 0, 0.08);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }

        .card--centered {
            text-align: center;
        }

        .card+.card {
            margin-top: 4px;
        }

        .section-title {
            font-size: 1.2rem;
            font-weight: 700;
            color: #633;
            margin: 0 0 10px 0;
            padding-bottom: 8px;
            border-bottom: 3px solid rgba(240, 208, 200, 0.6);
        }

        .section-title a {
            color: #A35241;
            text-decoration: none;
        }

        .section-title a:hover {
            color: #c66955;
        }

        .block-title {
            margin-bottom: 12px;
        }

        .block-title .title a {
            font-size: 1.3rem;
            font-weight: 700;
            color: #6c2f2f;
        }

        .block-title .title a:hover {
            color: #9b4747;
        }

        .title a {
            color: #6c2f2f;
            font-weight: 600;
        }

        .title a:hover {
            color: #9b4747;
        }

        .date {
            display: inline-block;
            margin-top: 4px;
            font-size: 0.9rem;
            color: #777;
        }

        .meta {
            font-size: 0.85rem;
            color: #777;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            margin-left: 8px;
        }

        .meta img {
            width: 14px;
            height: 14px;
            border-radius: 0;
            box-shadow: none;
        }

        .text-center {
            text-align: center;
        }

        .mb-1 {
            margin-bottom: 4px;
        }

        .mb-2 {
            margin-bottom: 8px;
        }

        .mb-3 {
            margin-bottom: 12px;
        }

        .mb-4 {
            margin-bottom: 16px;
        }

        .mb-5 {
            margin-bottom: 24px;
        }

        /* ВИДЖЕТ ЯНДЕКСА */

        .yandex-widget {
            font-size: 0.95rem;
        }

        .yandex-widget span.y-red {
            color: red;
            font-weight: 700;
        }

        .yandex-widget span.y-black {
            color: #000;
            font-weight: 700;
        }

        /* КРЕСТНЫЙ ХОД */

        .procession-card {
            border-left: 4px solid #F0D0C8;
        }

        .procession-title {
            text-align: center;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .procession-list {
            font-size: 0.95rem;
        }

        .procession-item {
            display: block;
            padding: 4px 6px;
        }

        .procession-item--past {
            color: #aaa;
        }

        .procession-item--future {
            font-weight: 600;
        }

        .procession-item--now {
            background: #F8FCBE;
            border-radius: 6px;
            font-weight: 700;
        }

        .procession-footer {
            margin-top: 10px;
            text-align: center;
        }

        /* КАЛЕНДАРЬ ЕПАРХИИ */

        .calendar-card {
            border-left: 4px solid #cfd7ff;
        }

        .calendar-date-today {
            color: #c0392b;
            font-size: 1.1rem;
            font-weight: 600;
            text-align: center;
            margin-bottom: 6px;
        }

        #calendar h2 {
            font-size: 1rem;
            margin: 8px 0 4px 0;
            padding-left: 5px;
        }

        .calendar-footer {
            text-align: center;
            margin-top: 10px;
        }

        .link-muted {
            color: #666;
        }

        .link-muted:hover {
            color: #333;
        }

        /* РЕКЛАМНЫЕ/ИНФО БЛОКИ */

        .promo-block img {
            width: 80%;
            max-width: 260px;
        }

        .promo-block+.promo-block {
            margin-top: 10px;
        }

        /* АНОНСЫ */

        .announcement-card {
            padding: 14px 14px 10px 14px;
        }

        .announcement-card h3 {
            margin: 0 0 6px 0;
            font-size: 1.05rem;
        }

        .announcement-header {
            margin-left: 10px;
        }

        .announcement-text {
            margin-top: 6px;
            font-size: 0.95rem;
        }

        /* СЛОВО АРХИПАСТЫРЯ */

        .clamp-4 {
            position: relative;
            display: -webkit-box;
            -webkit-line-clamp: 4;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .clamp-4::after {
            content: "…";
            position: absolute;
            bottom: 0;
            right: 0;
            padding-left: 20px;
            background: linear-gradient(to right, transparent, #ffffff 50%);
        }

        .slovo-body img {
            float: left;
            width: 150px;
            height: auto;
            /* авто-высота для естественного обтекания */
            max-height: 220px;
            /* но ограничиваем, чтобы не была слишком высокой */
            object-fit: cover;
            object-position: center;
            margin: 0 12px 8px 0;
            border-radius: 12px;
            border: 1px solid #C3D7D4;
            padding: 5px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.3);
        }

        .slovo-item {
            margin-left: 5px;
            margin-right: 10px;
        }

        .slovo-body {
            display: flex;
            border-bottom: 1px solid #D7D7D7;
            padding-bottom: 8px;
            margin-bottom: 8px;
            gap: 12px;
        }

        .slovo-cover {
            flex: 0 0 auto;
        }

        .slovo-cover img {
            width: 180px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.3);
            border: 1px solid #C3D7D4;
            padding: 5px;
            border-radius: 12px;
        }

        .slovo-text {
            flex: 1;
            font-size: 0.95rem;
        }

        /* ВИДЕО */

       

        /* НОВОСТЬ ДНЯ */

        #new_day {
            padding: 18px;
        }

        #new_day img {
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.25);
            border: 1px solid #C3D7D4;

            border-radius: 14px;
        }

        .news-day-image {
            float: left;
            margin: 0 14px 8px 0;
        }

        .news-day-text {
            font-size: 0.98rem;
            line-height: 1.6;
            overflow: hidden;
        }

        /* СПИСОК НОВОСТЕЙ */

        .news-list-block {
            padding: 18px;
        }

        .news-item {
            margin-bottom: 14px;
            border-bottom: 1px solid #D7D7D7;
            padding-bottom: 10px;
        }

        .news-item:last-child {
            border-bottom: none;
        }

        .news-item-header {
            margin-left: 5px;
        }

        .news-item-meta {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap;
        }

        .news-item-body {
            display: flex;
            margin-top: 6px;
            gap: 12px;
        }

        .news-item-image {
            flex: 0 0 auto;
        }

        .news-item-image img {
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.3);
            border: 1px solid #C3D7D4;
            padding: 10px;
            border-radius: 14px;
        }

        .news-item-text {
            flex: 1;
            font-size: 0.95rem;
        }

        /* ПУБЛИКАЦИИ */

        .pub-list-block {
            padding: 18px;
        }

        .pub-item {
            margin-bottom: 14px;
            border-bottom: 1px solid #D7D7D7;
            padding-bottom: 10px;
        }

        .pub-item-header {
            margin-left: 5px;
        }

        .pub-item-body {
            display: flex;
            margin-top: 6px;
            gap: 12px;
        }

        .pub-item-image {
            flex: 0 0 auto;
        }

        .pub-item-image img {
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.3);
            border: 1px solid #C3D7D4;
            padding: 10px;
            border-radius: 14px;
        }

        .pub-item-text {
            flex: 1;
            font-size: 0.95rem;
        }

        .tabs {
            display: flex;
            gap: 10px;
            margin-bottom: 16px;
        }

        .tab-btn {
            padding: 8px 14px;
            border-radius: 10px;
            background: #f3e9e7;
            border: 1px solid #d8c2be;
            cursor: pointer;
            font-weight: 600;
            color: #8a3e3e;
            transition: 0.2s;
        }

        .tab-btn.active {
            background: #c96d5a;
            color: white;
            border-color: #c96d5a;
        }

        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
        }

        /*новость*/
        .tab-head {
            display: flex;
            gap: 30px;
            margin-bottom: 10px;
            align-items: center;
        }

        .tab-head a {
            font-size: 1.25rem;
            font-weight: 700;
            color: #6c2f2f;
            text-decoration: none;
            padding-bottom: 4px;
            cursor: pointer;
        }

        .tab-head a:hover {
            color: #9b4747;
        }

        .tab-head a.active {
            border-bottom: 3px solid #e5b5ad;
        }

        /* ОЧИСТКА ОБТЕКАНИЯ ДЛЯ СТАРОГО КОНТЕНТА */

        .clearfix::after {
            content: "";
            display: block;
            clear: both;
        }
    </style>
</head>

<body>
    <div class="page-wrapper">

        <?php include 'golova.php'; ?>
        <?php include 'menu.php'; ?>

        <main class="layout">

            <!-- ================================
              ПРАВАЯ КОЛОНКА (sidebar)
        ================================= -->
            <aside class="sidebar">



                <!-- КРЕСТНЫЙ ХОД СЕГОДНЯ -->
                <?php if ($hod_today && mysql_num_rows($hod_today) > 0): ?>
                    <div class="card procession-card">
                        <div class="section-title text-center">Где сейчас крестный ход</div>

                        <div class="procession-list">
                            <?php
                            $time_now = date("H:i");
                            while ($hod = mysql_fetch_array($hod_today)):
                                if ($hod['pribyv'] == '00:00' && $hod['otbyv'] == '24:00') {
                                    $range = 'Весь день';
                                } else {
                                    $range = $hod['pribyv'] . ' - ' . $hod['otbyv'];
                                }

                                if ($time_now > $hod['otbyv']) {
                                    echo '<span class="procession-item procession-item--past"><b>' . $range . '</b> ' . $hod['nas_punkt'] . '</span>';
                                } elseif ($time_now < $hod['pribyv']) {
                                    echo '<span class="procession-item procession-item--future"><b>' . $range . '</b> ' . $hod['nas_punkt'] . '</span>';
                                } else {
                                    echo '<div class="procession-item procession-item--now"><b>' . $range . '</b> ' . $hod['nas_punkt'] . '</div>';
                                }
                            endwhile;
                            ?>
                        </div>

                        <div class="procession-footer">
                            <a href="hod.php?year=<?= date('Y') ?>#<?= date('Y.m.d') ?>">Полное расписание и фотоотчёты</a>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- КАЛЕНДАРЬ ЕПАРХИИ -->
                <?php
                $yesterday = strtotime("-1 day");

                $day = ltrim(date("d", $yesterday), '0');
                $mon = monthRus(date("m", $yesterday));
                ;
                ?>
                <div class="card calendar-card">
                    <div class="section-title text-center">Календарь епархии</div>

                    <div class="calendar-date-today">
                        <?= $day ?> <?= $mon ?>
                    </div>

                    <?php if (
                        !empty($calendar['birthday']) ||
                        !empty($calendar['diakon']) ||
                        !empty($calendar['ierey']) ||
                        !empty($calendar['monah']) ||
                        !empty($calendar['angel'])
                    ): ?>
                        <div id="calendar">
                            <h2>Духовенство</h2>
                            <?= implode('', $calendar['birthday']) ?>
                            <?= implode('', $calendar['diakon']) ?>
                            <?= implode('', $calendar['ierey']) ?>
                            <?= implode('', $calendar['monah']) ?>
                            <?= implode('', $calendar['angel']) ?>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($prestoly)): ?>
                        <div id="calendar">
                            <h2>Престольный праздник</h2>
                            <?= implode('', $prestoly) ?>
                        </div>
                    <?php endif; ?>

                    <?php if (empty($prestoly) && empty($calendar)): ?>
                        <p>Сегодня событий нет</p>
                    <?php endif; ?>

                    <div class="calendar-footer">
                        <a class="link-muted" href="/kalendar.php?month=<?= date('m') ?>">Весь календарь</a>
                    </div>
                </div>

                <!-- РЕКЛАМНЫЕ / ИНФО БЛОКИ -->
                <div class="card card--centered promo-block">
                    <a href="/prihod.php?id=21">
                        <img src="/IMG/glotovka.png" alt="Глотовка">
                    </a>
                </div>

                <div class="card card--centered promo-block">
                    <a href="/saints.php">
                        <img src="/IMG/saints.png" alt="Святые">
                    </a>
                </div>

                <div class="card card--centered promo-block">
                    <a href="hod.php">
                        <img src="/IMG/hod.png" alt="Крестный ход">
                    </a>
                </div>

                <!-- АНОНСЫ -->
                <div class="card">
                    <h2 class="section-title">
                        <a href="anons.php">Анонсы и объявления</a>
                    </h2>

                    <?php while ($a = mysql_fetch_array($anons)): ?>
                        <?php
                        $d = ltrim(substr($a['data'], 8, 2), '0');
                        $m = monthRus(substr($a['data'], 5, 2));
                        $y = substr($a['data'], 0, 4);
                        $time = substr($a['data'], 11, 5);
                        ?>
                        <div class="card announcement-card">
                            <h3><?= $a['when'] ?></h3>
                            <div class="announcement-header">
                                <span class="title">
                                    <a href="anons_show.php?data=<?= $a['data'] ?>"><?= $a['tema'] ?></a>
                                </span><br>
                                <span class="date"><?= $d ?>     <?= $m ?>     <?= $y ?> г. <?= $time ?></span>
                                <span class="meta">
                                    <img src="IMG/views.png" alt="Просмотры">
                                    <?= $a['views'] ?>
                                </span>
                            </div>
                            <p class="announcement-text"><?= nl2br($a['kratko']) ?></p>
                        </div>
                    <?php endwhile; ?>
                </div>



            </aside>

            <!-- ================================
              ЛЕВАЯ КОЛОНКА (НОВОСТЬ ДНЯ + МИКС + ПУБЛИКАЦИИ)
        ================================= -->
            <section class="main-column">

                <!-- НОВОСТЬ ДНЯ -->
                <div id="new_day" class="card clearfix">
                    <?php
                    // NEWS DAY DATE FORMAT
                    $y = substr($dtn_day, 0, 4);
                    $m = monthRus(substr($dtn_day, 5, 2));
                    $d = ltrim(substr($dtn_day, 8, 2), '0');
                    $time = substr($dtn_day, 11, 5);
                    ?>
                    <div class="block-title">
                        <span class="title">
                            <a href="<?= $news_day['page'] ?>_show.php?data=<?= $news_day['data'] ?>">
                                <?= $news_day['tema'] ?>
                            </a>
                        </span><br>
                        <span class="date"><?= $d ?> <?= $m ?> <?= $y ?> г. <?= $time ?></span>
                        <?php if ($news_day['page'] == 'news'): ?>
                            <?php
                            $v = mysql_fetch_array(mysql_query("SELECT views FROM host1409556_barysh.news_eparhia WHERE data='$dtn_day'"));
                            ?>
                            <span class="meta">
                                <i class="fa fa-eye" aria-hidden="true">    </i>
                                
                                <?= $v['views'] ?>
                                </i>
                            </span>
                        <?php endif; ?>
                    </div>

                    <?php if ($news_day['oblozka']): ?>
                        <div class="news-day-image">
                            <a href="<?= $news_day['page'] ?>_show.php?data=<?= $news_day['data'] ?>">
                                <img src="DAY/<?= $news_day['oblozka'] ?>.jpg" alt="">
                            </a>
                        </div>
                    <?php endif; ?>

                    <div class="news-day-text">
                        <p><?= formatNewsText($news_day['text']) ?></p>
                    </div>
                </div>

                <!-- НОВОСТИ / ПУБЛИКАЦИИ -->
                <div class="card news-list-block">

                    <!-- Заголовки-вкладки -->
                    <div class="tab-head">
                        <a id="newsTab" class="active" onclick="toggleTab('news', 'news.php')">
                            Новости епархии
                        </a>

                        <a id="pubTab" onclick="toggleTab('pub', 'pub.php')">
                            Публикации
                        </a>
                    </div>

                    <!-- >>> БЛОК НОВОСТЕЙ <<< -->
                    <div id="newsBlock" style="display:block;">

                        <?php while ($row = mysql_fetch_array($mix)): ?>
                            <?php
                            $d = ltrim(substr($row['data'], 8, 2), '0');
                            $m = monthRus(substr($row['data'], 5, 2));
                            $y = substr($row['data'], 0, 4);
                            $time = substr($row['data'], 11, 5);
                            $date = "$d $m $y г. $time";
                            ?>

                            <div class="news-item">
                                <div class="news-item-header">
                                    <span class="title">
                                        <?php if ($row['source'] == 'local'): ?>
                                            <a href="news_show.php?data=<?= $row['data'] ?>"><?= $row['tema'] ?></a>
                                        <?php else: ?>
                                            <a href="<?= $row['link'] ?>" target="_blank"><?= $row['tema'] ?></a>
                                        <?php endif; ?>
                                    </span><br>

                                    <div class="news-item-meta">
                                        <span class="date"><?= $date ?></span>
                                        <span class="meta">
                                            <?php if ($row['source'] == 'local' && $row['video']): ?>
                                                (+ Видео)
                                            <?php endif; ?>

                                            <?php if ($row['source'] == 'local'): ?>
                                                <i class="fa fa-eye" aria-hidden="true">    </i>
                                                <?= $row['views'] ?>
                                                
                                            <?php endif; ?>
                                        </span>
                                    </div>
                                </div>

                                <div class="news-item-body">
                                    <?php if (!empty($row['oblozka'])): ?>
                                        <?php
                                        if ($row['source'] == 'local') {
                                            $img = 'FOTO_MINI/' . $row['oblozka'] . '.jpg';
                                        } else {
                                            $img = (strpos($row['oblozka'], 'http') === 0)
                                                ? $row['oblozka']
                                                : 'https://mitropolia-simbirsk.ru' . $row['oblozka'];
                                        }

                                        $link = ($row['source'] == 'local'
                                            ? 'news_show.php?data=' . $row['data']
                                            : $row['link']);

                                        $target = ($row['source'] == 'local' ? '_self' : '_blank');
                                        ?>

                                        <div class="news-item-image">
                                            <a href="<?= $link ?>" target="<?= $target ?>">
                                                <img src="<?= $img ?>" alt="">
                                            </a>
                                        </div>
                                    <?php endif; ?>

                                    <div class="news-item-text">
                                        <p><?= nl2br($row['kratko']) ?></p>
                                    </div>
                                </div>
                            </div>

                        <?php endwhile; ?>

                    </div>


                    <!-- >>> БЛОК ПУБЛИКАЦИЙ <<< -->
                    <div id="pubBlock" style="display:none;">

                        <?php while ($pub = mysql_fetch_array($publish)): ?>
                            <?php
                            $d = ltrim(substr($pub['data'], 8, 2), '0');
                            $m = monthRus(substr($pub['data'], 5, 2));
                            $y = substr($pub['data'], 0, 4);
                            $time = substr($pub['data'], 11, 5);
                            $date = "$d $m $y г. $time";
                            ?>

                            <div class="pub-item">
                                <div class="pub-item-header">
                                    <span class="title">
                                        <a href="pub_show.php?data=<?= $pub['data'] ?>"><?= $pub['tema'] ?></a>
                                    </span><br>
                                    <span class="date"><?= $date ?></span>

                                    <span class="meta">
                                        <img src="IMG/views.png" alt="Просмотры">
                                        <?= $pub['views'] ?>
                                    </span>
                                </div>

                                <div class="pub-item-body">
                                    <?php if ($pub['oblozka']): ?>
                                        <div class="pub-item-image">
                                            <a href="pub_show.php?data=<?= $pub['data'] ?>">
                                                <img src="FOTO_MINI/<?= $pub['oblozka'] ?>.jpg" alt="">
                                            </a>
                                        </div>
                                    <?php endif; ?>

                                    <div class="pub-item-text">
                                        <p><?= nl2br($pub['kratko']) ?></p>
                                    </div>
                                </div>
                            </div>

                        <?php endwhile; ?>

                    </div>

                </div>


                <!-- СЛОВО АРХИПАСТЫРЯ -->
                <div class="card">
                    <h2 class="section-title">
                        <a href="slovo_padre.php">Слово архипастыря</a>
                    </h2>

                    <?php while ($sl = mysql_fetch_array($slovo)): ?>
                        <?php
                        // дата
                        $d = ltrim(substr($sl['data'], 8, 2), '0');
                        $m = monthRus(substr($sl['data'], 5, 2));
                        $y = substr($sl['data'], 0, 4);
                        $time = substr($sl['data'], 11, 5);
                        $date = "$d $m $y г. $time";
                        ?>

                        <div class="slovo-item">
                            <span class="title">
                                <a href="<?= $sl['link'] ?>" target="_blank"><?= $sl['tema'] ?></a>
                            </span><br>
                            <span class="date"><?= $date ?></span>
                        </div>

                        <div class="slovo-body clearfix" style="margin-bottom: 12px;">
                            <?php if (!empty($sl['oblozka'])): ?>
                                <img src="<?= $sl['oblozka'] ?>" alt="">
                            <?php endif; ?>

                            <p class="clamp-4" style="font-size:0.95rem; line-height:1.5;">
                                <?= strip_tags($sl['kratko']) ?>
                            </p>
                        </div>

                    <?php endwhile; ?>
                </div>

                <!-- ВИДЕО -->
                <div class="card video-section">
                    <h2 class="section-title">
                        <a href="video.php">Видео</a>
                    </h2>
                    <?= $videosHTML ?>
                </div>

            </section>

        </main>

        <?php include 'footer.php'; ?>

    </div>

    <script>
        let activeTab = 'news';

        function toggleTab(tab, url) {
            if (activeTab === tab) {
                window.location = url; // второй клик ? переход на страницу
                return;
            }

            activeTab = tab;

            // показываем / скрываем
            document.getElementById('newsBlock').style.display = (tab === 'news') ? 'block' : 'none';
            document.getElementById('pubBlock').style.display = (tab === 'pub') ? 'block' : 'none';

            // переключаем активные ссылки
            document.getElementById('newsTab').classList.toggle('active', tab === 'news');
            document.getElementById('pubTab').classList.toggle('active', tab === 'pub');
        }
    </script>
</body>

</html>