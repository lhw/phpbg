<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?=$lang;?>" lang="<?=$lang;?>">
<head>
    <title><?=$title;?></title>
    <meta http-equiv="content-type" content="text/xhtml+xml charset=UTF-8" />
    <link rel="stylesheet" media="screen, projection" type="text/css" href="styles/default/stylesheet.css" />
</head>
<body>
    <div id="header">
        <h1><?=$headline;?></h1>
        <h2><?=$subtitle;?></h2>
    </div>
    <div id="navigation">
        <?=$navigation;?>
    </div>
    <?=$error;?>
    <div id="content">
        <?=$content;?>
    </div>
    <div id="options">
        <?=$options;?>
    </div>
    <div id="footer">
        &copy; by phpBG Team
    </div>
</body>
</html>