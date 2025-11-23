<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

require_once 'db.php';
require_once 'logic.php';


/**
 *     
 */
function limitWords($text, $limit = 50)
{
    //  HTML-
    $text = strip_tags($text);

    //   
    $words = preg_split('/\s+/u', $text, -1, PREG_SPLIT_NO_EMPTY);

    if (count($words) <= $limit) {
        return $text;
    }

    $cut = array_slice($words, 0, $limit);
    return implode(' ', $cut) . '';
}

// 
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
    <title> </title>

    
</head>

<body>
    <div class="page-wrapper">

        <?php include 'golova.php'; ?>
        <?php include 'menu.php'; ?>

        <main class="layout">

            <!-- ================================
                (sidebar)
        ================================= -->
            <aside class="sidebar">



                <!--    -->
                <?php if ($hod_today && mysql_num_rows($hod_today) > 0): ?>
                    <div class="card procession-card">
                        <div class="section-title text-center">   </div>

                        <div class="procession-list">
                            <?php
                            $time_now = date("H:i");
                            while ($hod = mysql_fetch_array($hod_today)):
                                if ($hod['pribyv'] == '00:00' && $hod['otbyv'] == '24:00') {
                                    $range = ' ';
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
                            <a href="hod.php?year=<?= date('Y') ?>#<?= date('Y.m.d') ?>">   </a>
                        </div>
                    </div>
                <?php endif; ?>

                <!--   -->
                <?php
                $yesterday = strtotime("-1 day");

                $day = ltrim(date("d", $yesterday), '0');
                $mon = monthRus(date("m", $yesterday));
                ;
                ?>
                <div class="card calendar-card">
                    <div class="section-title text-center"> </div>

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
                            <h2></h2>
                            <?= implode('', $calendar['birthday']) ?>
                            <?= implode('', $calendar['diakon']) ?>
                            <?= implode('', $calendar['ierey']) ?>
                            <?= implode('', $calendar['monah']) ?>
                            <?= implode('', $calendar['angel']) ?>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($prestoly)): ?>
                        <div id="calendar">
                            <h2> </h2>
                            <?= implode('', $prestoly) ?>
                        </div>
                    <?php endif; ?>

                    <?php if (empty($prestoly) && empty($calendar)): ?>
                        <p>  </p>
                    <?php endif; ?>

                    <div class="calendar-footer">
                        <a class="link-muted" href="/kalendar.php?month=<?= date('m') ?>"> </a>
                    </div>
                </div>

                <!--  /   -->
                <div class="card card--centered promo-block">
                    <a href="/prihod.php?id=21">
                        <img src="/IMG/glotovka.png" alt="">
                    </a>
                </div>

                <div class="card card--centered promo-block">
                    <a href="/saints.php">
                        <img src="/IMG/saints.png" alt="">
                    </a>
                </div>

                <div class="card card--centered promo-block">
                    <a href="hod.php">
                        <img src="/IMG/hod.png" alt=" ">
                    </a>
                </div>

                <!--  -->
                <div class="card">
                    <h2 class="section-title">
                        <a href="anons.php">  </a>
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
                                <span class="date"><?= $d ?>     <?= $m ?>     <?= $y ?> . <?= $time ?></span>
                                <span class="meta">
                                    <img src="IMG/views.png" alt="">
                                    <?= $a['views'] ?>
                                </span>
                            </div>
                            <p class="announcement-text"><?= nl2br($a['kratko']) ?></p>
                        </div>
                    <?php endwhile; ?>
                </div>



            </aside>

            <!-- ================================
                (  +  + )
        ================================= -->
            <section class="main-column">

                <!--   -->
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
                        <span class="date"><?= $d ?> <?= $m ?> <?= $y ?> . <?= $time ?></span>
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

                <!--  /  -->
                <div class="card news-list-block">

                    <!-- - -->
                    <div class="tab-head">
                        <a id="newsTab" class="active" onclick="toggleTab('news', 'news.php')">
                             
                        </a>

                        <a id="pubTab" onclick="toggleTab('pub', 'pub.php')">
                            
                        </a>
                    </div>

                    <!-- >>>   <<< -->
                    <div id="newsBlock">

                        <?php while ($row = mysql_fetch_array($mix)): ?>
                            <?php
                            $d = ltrim(substr($row['data'], 8, 2), '0');
                            $m = monthRus(substr($row['data'], 5, 2));
                            $y = substr($row['data'], 0, 4);
                            $time = substr($row['data'], 11, 5);
                            $date = "$d $m $y . $time";
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
                                                (+ )
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


                    <!-- >>>   <<< -->
                    <div id="pubBlock">

                        <?php while ($pub = mysql_fetch_array($publish)): ?>
                            <?php
                            $d = ltrim(substr($pub['data'], 8, 2), '0');
                            $m = monthRus(substr($pub['data'], 5, 2));
                            $y = substr($pub['data'], 0, 4);
                            $time = substr($pub['data'], 11, 5);
                            $date = "$d $m $y . $time";
                            ?>

                            <div class="pub-item">
                                <div class="pub-item-header">
                                    <span class="title">
                                        <a href="pub_show.php?data=<?= $pub['data'] ?>"><?= $pub['tema'] ?></a>
                                    </span><br>
                                    <span class="date"><?= $date ?></span>

                                    <span class="meta">
                                        <img src="IMG/views.png" alt="">
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


                <!--   -->
                <div class="card">
                    <h2 class="section-title">
                        <a href="slovo_padre.php"> </a>
                    </h2>

                    <?php while ($sl = mysql_fetch_array($slovo)): ?>
                        <?php
                        // 
                        $d = ltrim(substr($sl['data'], 8, 2), '0');
                        $m = monthRus(substr($sl['data'], 5, 2));
                        $y = substr($sl['data'], 0, 4);
                        $time = substr($sl['data'], 11, 5);
                        $date = "$d $m $y . $time";
                        ?>

                        <div class="slovo-item">
                            <span class="title">
                                <a href="<?= $sl['link'] ?>" target="_blank"><?= $sl['tema'] ?></a>
                            </span><br>
                            <span class="date"><?= $date ?></span>
                        </div>

                        <div class="slovo-body clearfix">
                            <?php if (!empty($sl['oblozka'])): ?>
                                <img src="<?= $sl['oblozka'] ?>" alt="">
                            <?php endif; ?>

                            <p class="clamp-4">
                                <?= strip_tags($sl['kratko']) ?>
                            </p>
                        </div>

                    <?php endwhile; ?>
                </div>

                <!--  -->
                <div class="card video-section">
                    <h2 class="section-title">
                        <a href="video.php"></a>
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
                window.location = url; //   ?   
                return;
            }

            activeTab = tab;

            //  / 
            document.getElementById('newsBlock').style.display = (tab === 'news') ? 'block' : 'none';
            document.getElementById('pubBlock').style.display = (tab === 'pub') ? 'block' : 'none';

            //   
            document.getElementById('newsTab').classList.toggle('active', tab === 'news');
            document.getElementById('pubTab').classList.toggle('active', tab === 'pub');
        }
    </script>
</body>

</html>