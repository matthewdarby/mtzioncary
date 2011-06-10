<?


echo "<title>Music Ministry File Listing</title>";

$Directories = array('Everready','JALewis','PraiseEnsemble','Youth','MaleChoir', 'SeniorChoir', 'FineArts','Musicians', 'SignMinistry');
$size = count($Directories);

// This is the directory to list files for.
$rootDirectory            = "files";
// Do you want to show directories? change to false to hide directories.
$listDirectories    = false;

if(is_dir($rootDirectory))
{
    echo "<center><img src='/assets/images/mzLogo.gif' width='250px'></center>";
    echo "<p>";
    echo "<center><h1>Music Ministry File Listing</h1></center>";
    echo "<p>";
    echo "<p>";
    print "To download, you may have to do the following: right click on the filename in the left-hand column; from the popup menu, click on 'Save Link As' (Netscape) or 'Save Target As' (Internet Explorer); and in the 'Save As' window that comes up, designate a location on your computer's hard drive to save the file.";
  for ($i = 0; $i < $size; $i++)
  {
    
    echo "<p><p><center><table border='1'><tr><b>" . $Directories[$i] . "</b></tr>";
    echo "<tr><td>Name</td><td>Type</td><td>Size (KB)</td></tr>";  
    $theDirectory = $rootDirectory . "/" .$Directories[$i];
    $dir = opendir($theDirectory);
    while(false !== ($file = readdir($dir)))
    {
        $type    = filetype($theDirectory ."/". $file);
        if($listDirectories || $type != "dir")
        {
            echo "<tr><td><a href='". $theDirectory ."/". $file . "'>" . $file . "</a></td>";
            echo "<td>" . $type . "</td>";
            echo "<td>";
            if($type == "file")
                echo filesize($theDirectory ."/". $file);
            echo "</td></tr>";
        }
    }
    closedir($dir);
    echo "</table></center>";
  }
}
else
{
    echo $theDirectory . " is not a directory";
}

echo "<p>";
echo "<p>";
echo "<p>";
echo "<bold>Administer:</bold><a href='admin'>Files</a>";

?> 