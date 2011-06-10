<?php

echo "<title>Music Ministry Delete File</title>";
echo "<center><img width='250px' src='/assets/images/mzLogo.gif'></center>";
echo "<form method='POST' action='delete.php'>";
echo "<h1>Delete File</h1>";
echo "<p><p>Select a file from drop-down menu</p></p>";
echo "<select size='1' name='file'>";

$Directories = array('Everready','JALewis','PraiseEnsemble','Youth','MaleChoir','SeniorChoir','FineArts','Musicians');
$size = count($Directories);

// This is the directory to list files for.
$rootDirectory            = "../files";
// Do you want to show directories? change to false to hide directories.
$listDirectories    = false;

for ($i = 0; $i < $size; $i++)
{
  $theDirectory = $rootDirectory . "/" .$Directories[$i];
  if(is_dir($theDirectory))
  {
    $dir = opendir($theDirectory);
    while(false !== ($file = readdir($dir)))
    {
        $type    = filetype($theDirectory ."/". $file);
        $filename = rawurlencode($Directories[$i] ."/". $file);
        if($listDirectories || $type != "dir")
        {
            echo "<option>" . $filename . "</option>";
        }
    }
    closedir($dir);
   }
}
echo "</select></p>";
echo "<p><input type='submit' value='Delete' name='B1'></p>";
echo "</form>";

php?>