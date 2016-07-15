<?php

define('FEATURES_PATH', 'features');
function featureList()
{
    $path = __DIR__.DIRECTORY_SEPARATOR.FEATURES_PATH;
    $lenPath = strlen($path) + 1;
    $iterator = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($path, RecursiveDirectoryIterator::SKIP_DOTS)
    );


    $paths = array_map('strval', iterator_to_array($iterator));
    uasort($paths, 'strnatcasecmp');

    $features = array();

    foreach ($paths as $path) {
        $path = (string)$path;


        if (substr($path, -8) == '.feature') {
            $features[] = substr($path, $lenPath);
        }
    }

    return $features;
}

function displayFeatureList($fmt)
{
    $list = featureList();
    echo '<h1>Behat Features list</h1>';
    echo '<ul>';
    echo '<li><a href="?f=&fmt='.$fmt.'">All features</a></li>';
    foreach ($list as $elem) {
        echo '<li><a href="?f='.$elem.'&fmt='.$fmt.'">'.$elem.'</a></li>';
    }
    echo '</ul>';
}


function displayFormatList() {
   if ( isset($_GET['fmt'])) {
       $format= $_GET['fmt'];
   } else {
       $format= 'pretty';
   }
    ?>

   <form method="get"> format de sortie:<select name="fmt" onchange="document.forms[0].submit();">
        <option value="pretty" <?php echo ($format=='pretty') ?   'selected=selected' : ''?>>pretty</option>
        <option value="progress" <?php echo ($format=='progress') ?   'selected=selected' : ''?>>progress</option>
    </select></form>
<?php
    return $format;
}

$format=displayFormatList();
displayFeatureList($format);




if ( isset($_GET['f'])) {
    $cmd = FEATURES_PATH.'/'.$_GET['f'];
    define('BEHAT_BIN_PATH', __FILE__);
    require __DIR__.'/vendor/autoload.php';
    $factory = new \Behat\Behat\ApplicationFactory();
    $output = null;
    $input = new \Symfony\Component\Console\Input\StringInput($cmd.' -o php://output --format '.$format.'  --no-colors' );
//$output = new \Symfony\Component\Console\Output\StreamOutput(fopen('php://output', 'w'));

    echo '<pre>';
    $app = $factory->createApplication();
    $app->setAutoExit(false);
    set_time_limit(300);
    $app->run($input, $output);
    echo '</pre>';
}


featureList();