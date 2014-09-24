<?php

  define('ACCESS_TOKEN',  'xxxxxxxxxxxxxxxxxxxxxxx');
  
  define('SUBDIR',        './db/');
  define('DB_SHELL',      'dbup.sh');

  if(!isset($_GET['token']) || $_GET['token'] !== ACCESS_TOKEN)
  {
    header('HTTP/1.0 403 Forbidden'); 
  }
  else
  {
    if(isset($_GET['git']) && $_GET['git'] === 'true')
    {
      exec('git reset --hard');
      exec('git pull');
    }
    if(isset($_GET['sql']) && $_GET['sql'] === 'true')
    {
      if(file_exists(SUBDIR . DB_SHELL)) {
        $cmd = file_get_contents(SUBDIR . DB_SHELL);
        try
        {
          $output = shell_exec($cmd);
        }
        catch(Exception $e)
        {
          echo $e;
        }
        die('<pre>' . $output . '</pre>');
      }
    }
  }
  
?>