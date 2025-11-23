<?php
if (isset($_REQUEST[session_name()])) session_start();
$auth = $_SESSION['auth'];
$name_user = $_SESSION['name_user'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include 'head.php'; ?>
<title>Архиереи Барышской епархии</title>
</head>
<body>

<div style="box-shadow: 0 0 20px rgba(0,0,0,0.5);">
<?php
include 'golova.php';
$barysh = true;
include 'menu.php';
include 'content.php';
?>

<div id="osnovnoe">
    <h1>Архиереи Барышской епархии</h1>

    <div style="display:flex; gap:20px; margin-top:20px; align-items:flex-start;">

        <!-- Фото слева -->
        <div>
            <a href="IMG/filaret.jpg" rel="example_group">
                <img src="IMG/filaret.jpg" 
                     alt="Епископ Филарет" 
                     title="Епископ Филарет"
                     style="width:180px; border:1px solid #C3D7D4; padding:10px; box-shadow:2px 2px 5px rgba(0,0,0,0.3);">
            </a>
        </div>

        <!-- Заголовок и архив справа -->
        <div style="flex:1; padding-top:10px;">
            <a href="filaret.php" 
               style="font-size:22px; font-weight:bold; text-decoration:none; color:#333;">
               Епископ Филарет (Коньков) 2012–2025 гг.
            </a>

            <!-- Блок архивных ссылок -->
            <div style="margin-top:10px;">
                <h2 style="font-size:18px; color:#333; margin-bottom:8px;">Архив:</h2>
                <ul style="list-style:none; margin:0; padding:0; font-size:15px;">
                    <li style="margin-bottom:5px;">
                        <a href="slovo_filaret.php" style="color:#006699; text-decoration:none;">
                        Слово архипастыря
                        </a>
                    </li>
                    <li>
                        <a href="sluzhenie_filaret.php" style="color:#006699; text-decoration:none;">
                        Архипастырское служенние
                        </a>
                    </li>
                </ul>
            </div>

           </div>

    </div>
</div>

<?php include 'footer.php'; ?>
</div>

</body>
</html>