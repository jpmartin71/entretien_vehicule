
<?php       
echo exec('whoami').'</br>';
echo shell_exec("/usr/bin/git pull 2>&1");
