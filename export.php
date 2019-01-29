
<?php
/*
* Export Mysql Data in excel or CSV format using PHP
* Downloaded from http://DevZone.co.in
*/
 
// Connect to database server and select 
$con=mysql_connect('localhost','root','root');
 mysql_select_db("bond");

// retrive data which you want to export
$query = "SELECT * FROM EC02 ";
$header = '';
$data ='';
 
$export = mysql_query($query ) or die(mysql_error());
 
// extract the field names for header 
 
while ($fieldinfo=mysql_fetch_field($export))
{
	$header .= $fieldinfo->name."\t";
}
 
// export data 
while( $row = mysql_fetch_row( $export ) )
{
    $line = '';
    foreach( $row as $value )
    {                                            
        if ( ( !isset( $value ) ) || ( $value == "" ) )
        {
            $value = "\t";
        }
        else
        {
            $value = str_replace( '"' , '""' , $value );
            $value = '"' . $value . '"' . "\t";
        }
        $line .= $value;
    }
    $data .= trim( $line ) . "\n";
}
$data = str_replace( "\r" , "" , $data );
 
if ( $data == "" )
{
    $data = "\nNo Record(s) Found!\n";                        
}
 
// allow exported file to download forcefully
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=devzone_co_in_export.csv");
header("Pragma: no-cache");
header("Expires: 0");
print "$header\n$data";
 
?>

