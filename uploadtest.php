<?php

function base64_to_file ($base64_string)
{
    // GET THE DATA FROM THE FILE                   /* $data[ 0 ] == "data:image/png;base64"   */
    $data = explode(',', $base64_string);           /* $data[ 1 ] == <actual base64 string>    */
    $data[1] = str_replace(' ', '+', $data[1]);     /* get rid of whitespace from the chunks   */
    preg_match("/.+?\/(.+?);.+/", $data[0], $type); /* extract the extension from the mimetype */
    $data = base64_decode($data[1]);

    // SET THE FILENAME
    $ext = $type[1];
    if ($ext == 'jpeg') $ext = 'jpg';
    $output_file = time().'.'.$ext;

    // WRITE THE FILE
    $ifp = fopen($output_file, 'wb'); 
    fwrite($ifp, $data);
    fclose($ifp); 

    return $output_file; 
}

if ($_POST['d'])
{
	echo base64_to_file($_POST['d']);
}