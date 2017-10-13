<?

require_once $_SERVER['DOCUMENT_ROOT'] . '/local/php_interface/include/functions.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/local/php_interface/include/handler.php';

// Автозагрузка классов
spl_autoload_register('autoload');
function autoload($name)
{
    $file = __DIR__ . DIRECTORY_SEPARATOR . 'include' . DIRECTORY_SEPARATOR . $name . '.php';
    if (file_exists($file)) {
        require_once($file);
    }
}

function p($mVar = false, $in_file = false)
{
    if ($in_file) {
        $file = fopen($_SERVER['DOCUMENT_ROOT'] . '/p.log', "a");
        if (!$file) {
            print "";
        } else {
            fputs($file, print_r($mVar, true));
            fputs($file, '
        ');
            fclose($file);
        }
    }
    if (!$in_file || $in_file == 2) {
        ?>
        <pre><? print_r($mVar); ?></pre><?
    }
}

