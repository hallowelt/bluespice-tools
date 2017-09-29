<?php

require __DIR__ . '/vendor/autoload.php';

use GitWrapper\GitWrapper;

$wrapper = new GitWrapper();

$destBasePath = "/tmp";

$branches = ["REL1_27", "master"];

$mysqlHost = "localhost";
$mysqlDB = "mediawiki";
$mysqlUser = "root";
$mysqlPass = "";
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
    if (!$mysqli->query("DROP DATABASE IF EXISTS $mysqlDB") || !$mysqli->query("CREATE DATABASE $mysqlDB")) {
      die("Database creation failed: (" . $mysqli->errno . ") " . $mysqli->error);
    }
    $instCmd = "php maintenance/install.php --dbname $mysqlDB --dbuser $mysqlUser --dbpass $mysqlPass --pass $wikiAdminPass $wikiName $wikiAdmin";
    shell_exec("cd " . $destPath . " && " . $instCmd);
    shell_exec("cd " . $destPath . " && php maintenance/update.php --quick");
    echo "\n---------------- done $destPath ------------------\n";
  }
}
