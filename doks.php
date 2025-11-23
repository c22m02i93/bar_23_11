<?
if (isset($_REQUEST[session_name()])) session_start();
$auth = $_SESSION['auth'];
$name_user = $_SESSION['name_user'];

$tip = isset($_GET['tip']) ? addslashes(strip_tags(trim($_GET['tip']))) : '';
$tip_titles = [
    'ukaz' => 'Указы',
    'raspor' => 'Распоряжения',
    'cirk' => 'Циркуляры',
    'udostoverenie' => 'Удостоверения',
];

$section_title = $tip && isset($tip_titles[$tip]) ? $tip_titles[$tip] : 'Документы';
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <? include 'head.php'; ?>
    <title><?= $section_title ?></title>

    <link rel="stylesheet" href="/Index1.css">
    <link rel="stylesheet" href="/header.css">
    <link rel="stylesheet" href="/all.min.css">
</head>
<body>

<div class="page-wrapper">

    <? include 'golova.php'; ?>
    <? include 'menu.php'; ?>
    <? include 'function.php'; ?>
    <? include 'content.php'; ?>

    <div id="osnovnoe" class="main-column card news-list-block">

        <h1 class="section-title"> <?= $section_title ?> </h1>

        <? if (empty($tip)) { ?>

            <div class="news-item news-entry">
                <div class="news-entry__frame">
                    <div class="news-entry__content">
                        <div class="news-entry__text">
                            <p>Выберите раздел, чтобы просмотреть документы.</p>
                            <div class="news-entry__tags">
                                <a class="btn" href="doks.php?tip=ukaz">Указы</a>
                                <a class="btn" href="doks.php?tip=raspor">Распоряжения</a>
                                <a class="btn" href="doks.php?tip=cirk">Циркуляры</a>
                                <a class="btn" href="doks.php?tip=udostoverenie">Удостоверения</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <? } else { ?>

            <?
            // Номер страницы
            if (!isset($_GET['page'])) {
                $p = 1;
            } else {
                $p = addslashes(strip_tags(trim($_GET['page'])));
                if ($p < 1) $p = 1;
            }

            $num_elements = 10;
            $total = mysql_result(mysql_query("SELECT COUNT(*) FROM host1409556_barysh.doks WHERE tematika LIKE '$tip'"), 0, 0);
            $num_pages = $total > 0 ? ceil($total / $num_elements) : 1;

            if ($p > $num_pages) $p = $num_pages;
            if ($p < 1) $p = 1;

            $start = ($p - 1) * $num_elements;
            if ($start < 0) $start = 0;

            echo '<div class="mb-3">' . GetNavtip($p, $num_pages, "doks", $tip) . '</div>';

            $sel = "SELECT * FROM host1409556_barysh.doks WHERE tematika LIKE '$tip' ORDER BY date DESC LIMIT $start, $num_elements";
            $query = mysql_query($sel);

            if (mysql_num_rows($query) > 0) {
                while ($res = mysql_fetch_assoc($query)) {

                    $dtn = $res['date'];
                    $yyn = substr($dtn, 0, 4);
                    $mmn = substr($dtn, 5, 2);
                    $ddn = (int)substr($dtn, 8, 2);

                    $months = [
                        "01" => "января", "02" => "февраля", "03" => "марта", "04" => "апреля", "05" => "мая", "06" => "июня",
                        "07" => "июля", "08" => "августа", "09" => "сентября", "10" => "октября", "11" => "ноября", "12" => "декабря"
                    ];

                    $mm1n = isset($months[$mmn]) ? $months[$mmn] : "";
                    $date_text = $ddn . ' ' . $mm1n . ' ' . $yyn . ' года';

                    $patterns = [
                        '/(?:\/{3})(.+)(?:\/{3})/U',
                        '/(?:\|{3})(.+)(?:\|{3})/U',
                        '/(?:\{{3})(http:\/\/[^\s\[<\(\)\|]+)(?:\}{3})-(?:\{{3})([^}]+)(?:\}{3})/i',
                        '/(?:\{{3})(http:\/\/[^\s\[<\(\)\|]+)(?:\}{3})/i',
                        '/(?:\{{3})([_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*(?:@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*(\.[a-zA-Z]{2,3})))(?:\}{3})/',
                        '/\n/',
                        '/@R(\d+)[-]?([^@]*)@/',
                        '/@L(\d+)[-]?([^@]*)@/',
                        '/(?:\[{3})(([0-9]*[^\]{3}]*)*)(?:\]{3})/'
                    ];

                    $replace = [
                        '<i>${1}</i>',
                        '<b>${1}</b>',
                        '<a href="${1}" target="_blank">${2}</a>',
                        '<a href="${1}" target="_blank">${1}</a>',
                        '<a href="mailto:${1}">${1}</a>',
                        '</p><p>',
                        '<span class="photos"><a href="FOTO/${1}.jpg" rel="example_group"><img style="border: 1px solid #C3D7D4; margin: 5px 10px 5px 10px;display: block;float: right;box-shadow: 2px 2px 5px rgba(0,0,0,0.3); padding: 10px" src="FOTO_MINI/${1}.jpg" alt="${2}" title="${2}" /></a></span>',
                        '<span class="photos"><a href="FOTO/${1}.jpg" rel="example_group"><img style="border: 1px solid #C3D7D4; margin: 5px 10px 5px 10px;display: block;float: left;box-shadow: 2px 2px 5px rgba(0,0,0,0.3); padding: 10px" src="FOTO_MINI/${1}.jpg" alt="${2}" title="${2}" /></a></span>',
                        '<div style="text-align: center; font-weight: bolder; width:100%; color:#743C00">${1}</div>'
                    ];

                    $text = preg_replace($patterns, $replace, $res['text']);

                    $title_parts = [];
                    if (!empty($res['name'])) $title_parts[] = $res['name'];
                    if (!empty($res['nomer'])) $title_parts[] = '№ ' . $res['nomer'];
                    $title = !empty($title_parts) ? implode(' ', $title_parts) : $section_title;
            ?>

            <div class="news-item news-entry">

                <div class="news-entry__frame">

                    <div class="news-entry__title-row">
                        <span class="news-entry__title"><?= $title ?></span>
                    </div>

                    <div class="news-entry__content">

                        <div class="news-entry__text">
                            <p><?= $text ?></p>

                            <div class="news-entry__meta-item news-entry__views">
                                <i class="fa-regular fa-calendar-days"></i> <?= $date_text ?>
                                <i class="fa-regular fa-folder"></i> <?= $section_title ?>
                            </div>
                        </div>

                    </div>

                </div>

            </div>

            <?
                }
            }
            ?>

            <div class="mb-3">
                <?= GetNavtip($p, $num_pages, "doks", $tip); ?>
            </div>

        <? } ?>

    </div>

    <? include 'footer.php'; ?>

</div>

</body>
</html>
