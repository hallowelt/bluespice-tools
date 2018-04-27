<?php

require __DIR__ . '/vendor/autoload.php';

use GitWrapper\GitWrapper;

$wrapper = new GitWrapper();

$destBasePath = "/media/build/tests";

$branches = ["REL1_27", "master"];

$mysqlHost = "localhost";
$mysqlDB = "mediawiki";
$mysqlUser = "root";
$mysqlPass = "Medienwerkstatt2015";
$wikiName = "BlueSpice";
$wikiAdmin = "WikiSysop";
$wikiAdminPass = "dslkjfhw7i3rzcbinrth1x2";

$repos = [
  "pro" => "git@gitlab.hallowelt.com:BlueSpice/mediawiki.git",
  "free" => "https://github.com/hallowelt/mediawiki.git"
];

foreach($branches as $branch){
  foreach($repos as $key => $repo){
    $destPath = $destBasePath . "/bluespice_" . $key . "_" . $branch;
    echo "\n---------------- Start setup for $destPath ------------------\n";
    if(!file_exists($destPath)){
      //shell_exec("rm -Rf " . $destPath);
      $git = $wrapper->clone($repo, $destPath, ['b' => $branch, 'depth' => 1]);
    }else{
      shell_exec("rm " . $destPath . "/LocalSettings.php");
      $git = $wrapper->workingCopy($destPath);
      $git->pull();
    }

    shell_exec("cd " . $destPath . " && " . "composer update");
    $mysqli = new mysqli($mysqlHost, $mysqlUser, $mysqlPass);
    if ($mysqli->connect_errno) {
        die("Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error);
    }
    $mysqlDB = "bluespice_" . $key . "_" . strtolower($branch);
    if (!$mysqli->query("DROP DATABASE IF EXISTS $mysqlDB") || !$mysqli->query("CREATE DATABASE $mysqlDB")) {
      die("Database creation failed: (" . $mysqli->errno . ") " . $mysqli->error);
    }
    $instCmd = "php maintenance/install.php --dbname $mysqlDB --dbuser $mysqlUser --dbpass $mysqlPass --scriptpath /$mysqlDB --pass $wikiAdminPass $wikiName $wikiAdmin";
    shell_exec("cd " . $destPath . " && " . $instCmd);
    shell_exec("cd " . $destPath . " && php maintenance/update.php --quick");
    shell_exec("cd " . $destPath . " && php tests/phpunit/phpunit.php --group BlueSpice");
    shell_exec("chmod 777 -R " . $destPath . "/cache");
    echo "\n---------------- done $destPath ------------------\n";
  }
}
