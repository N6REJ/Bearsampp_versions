<HTML>
<HEAD><TITLE>Form Results </TITLE>
<BODY>
<?php
$url = $first = $last = "";

/* This page receives and handles the data generated by "clean.html". */
$url     = $_REQUEST['url'];
$icon    = $_REQUEST['icon'];

/* get radio buttons */
if ( $icon === "Full" )
{
	$icon = ' <i class="fa fa-star fa-lg" aria-hidden="true"></i>';
}
elseif ( $icon == "Half" )
{
	$icon = '<i class="fa fa-star-half-o fa-lg" aria-hidden="true"></i>';
}
else
{
	$icon = "";
}

/* strip .7z so we can add the other file names */
$field = stristr($url, ".7z", true);
if(!$field) {
    $field= stristr($url, ".zip",true);
}
$md5 = $field . ".md5";
$sha1 = $field . ".sha1";
$sha256 = $field . ".sha256";
$sha512 = $field . ".sha512";

/* get date */
$date = stristr(substr(stristr(stristr($field, "download/",false),"/"),1), "/", true);

/* get name */
$name  = substr($url, strrpos($url,"bearsampp-"));

/* Get version # */
$version = stristr(ltrim(stristr(ltrim(stristr($name,"-"),"-"),"-"),"-"),"-",true);

echo "name: " . $name . "<br>";
echo "version: " . $version . "<br/>";

/* ok, now create links */
$md5    = '<a href="' . $md5 . '" aria-label="MD5 File"><em class="highlight black">MD5</em></a>';
$sha1   = '<a href="' . $sha1 . '" aria-label="SHA-1 File"><em class="highlight black">SHA1</em></a>';
$sha256 = '<a href="' . $sha256 . '" aria-label="SHA-256 File"><em class="highlight black">SHA256</em></a>';
$sha512 = '<a href="' . $sha512 . '" aria-label="SHA-512 File"><em class="highlight black">SHA512</em></a>';
$output = "<td>" . $md5 . " " . $sha1 . " " . $sha256 . " " . $sha512 . "</td>";

/* Start output */
print htmlspecialchars( '<table class="table table-striped">' ) . "<br />";
print htmlspecialchars( "<thead>" ) . "<br />";
print htmlspecialchars( "<tr>" ) . "<br />";
print htmlspecialchars( "<th>Version</th>" ) . "<br />";
print htmlspecialchars( "<th>Release date</th>" ) . "<br />";
print htmlspecialchars( "<th>Download</th>" ) . "<br />";
print htmlspecialchars( "<th>Verification</th>" ) . "<br />";
print htmlspecialchars( "</tr>" ) . "<br />";
print htmlspecialchars( "</thead>" ) . "<br />";
print htmlspecialchars( "<tbody>" ) . "<br />";
print htmlspecialchars( "<tr>" ) . "<br />";
print htmlspecialchars( '<td><strong>' . $version . '</strong>' . $icon . '</td>' ) . "<br />";
print htmlspecialchars( '<td>' . $date . '</td>' ) . "<br />";
print htmlspecialchars( '<td><a href="' . $url . '" aria-labelledby="File link">' . $name . '</a></td>' ) . "<br />";;
print htmlspecialchars( $output ) . "<br />";
print htmlspecialchars( "</tr>" ) . "<br />";
print htmlspecialchars( "</tbody>" ) . "<br />";
print htmlspecialchars( "</table>" ) . "<br />";
?>

</BODY>
</HTML>
