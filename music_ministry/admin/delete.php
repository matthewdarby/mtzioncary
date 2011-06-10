<?

echo "<title>File Deletion</title>";

$uploaddir = "../files";


$filename = rawurldecode($_POST['file']);

if (unlink($uploaddir.'/'.$filename))
{
	print "Your file has been deleted successfully!";
}
else
{
	print "Deletion failed.  Contact your system administrator";
}
echo "<p><a href='../index.php'>Return to file listing</a>";

?>