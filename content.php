<!--noindex-->
<div id="content_right">
    <div class="box">
        <h3></h3>
        <?php
        $connection = mysqli_connect("localhost", "host1409556", "0f7cd928");
        if (!$connection) {
            echo '<p style="color: red;">Не удалось подключиться к базе данных.</p>';
        } else {
            mysqli_set_charset($connection, 'cp1251');

            $news_all = mysqli_query(
                $connection,
                "SELECT data, url, tema, text FROM host1409556_barysh.news ORDER BY data DESC LIMIT 5"
            );

            $months = [
                "01" => "", "02" => "", "03" => "", "04" => "", "05" => "",
                "06" => "", "07" => "", "08" => "", "09" => "", "10" => "",
                "11" => "", "12" => ""
            ];

            if ($news_all) {
                while ($news = mysqli_fetch_assoc($news_all)) {
                    $dtn   = $news['data'];
                    $yyn   = substr($dtn, 0, 4);
                    $mmn   = substr($dtn, 5, 2);
                    $ddn   = substr($dtn, 8, 2);
                    $hours = substr($dtn, 11, 5);

                    if ($ddn[0] === '0') {
                        $ddn = substr($ddn, 1);
                    }

                    $mm1n  = isset($months[$mmn]) ? $months[$mmn] : '';
                    $ddttn = '<span class="date">' . $ddn . ' ' . $mm1n . ' ' . $yyn . ' . ' . $hours . '</span>';

                    $patterns = ['/\n/'];
                    $replace  = ['</p><p>'];
                    $text     = preg_replace($patterns, $replace, $news['text']);

                    echo $ddttn;

                    if (!empty($auth) && $auth == 1) {
                        echo '<a href="delete_news.php?data=' . $news['data'] . '"><img style="display: block;float: right;border: 0; margin: 0 5px 0 0; " src="IMG/delete.png"/></a>';
                    }

                    echo '<p><a href="' . $news['url'] . '.php?data=' . $news['data'] . '">' . $news['tema'] . '</a></p><p>' . $text . '</p><br />';
                }
            }
        }
        ?>
    </div>
    <br />

    <div class="box">
        <h3> </h3>
        <a href="http://www.barysh-eparhia.ru/map.php"><center><img style="border: #BEC7BE 1px solid; width: 75%; margin: 0 auto" src="IMG/map.png" /></center></a>
    </div>

    <br />

    <div style="text-align: center">
        <a href="http://ekzeget.ru/" target="_blank"><img style="width: 75%; margin: 0 auto" src="/IMG/ekzeget.png" border="0" /></a>
    </div>
    <br />
</div>
<!--/noindex-->
