<?php

require_once '../../includes/Classes/Singleton.class.php';
require_once '../../includes/Classes/Directory.class.php';


$dir = new \Classes\Directory('../../media/uploads');
$files = $dir->getFiles();

for ($i=0, $c=0;$i<count($files);$i++, $c++) {
    if ($c < 3)
        echo '<div class="viertel-box"><img src="../media/uploads/'.$files[$i].'"></div>'."\n";
    else {
        echo '<div class="viertel-box lastbox"><img src="../media/uploads/'.$files[$i].'"></div>'."\n";
        echo '<div style="clear: both;"></div>';
        $c = -1;
    }
}
echo '<div style="clear: both;"></div>';

?>
