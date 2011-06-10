<?

echo "<title>File Uploaded</title>";
// ==============
// Configuration
// ==============
$uploaddir = "../files/" .$_POST['Dir']; // Where you want the files to upload to - Important: Make sure this folders permissions is 0777!
// ==============
// Upload Part
// ==============
if(is_uploaded_file($_FILES['file']['tmp_name']))
{
move_uploaded_file($_FILES['file']['tmp_name'],$uploaddir.'/'.$_FILES['file']['name']);
chmod($uploaddir.'/'.$_FILES['file']['name'], 0777);
}
print "Your file has been uploaded successfully!";

echo "<p><a href='../index.php'>Return to file listing</a>";

?>