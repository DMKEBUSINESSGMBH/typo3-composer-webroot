<?php
// header setzen, damit google nicht indiziert
header('HTTP/1.1 503 Service Temporarily Unavailable');
header('Retry-After: 3600'); // retry after 1hour seconds

$contents = file_get_contents('unavailable.jpg');
$base64   = base64_encode($contents);
$imgData = ('data:' . 'image/jpg' . ';base64,' . $base64);
?><!DOCTYPE html
     PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
     "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="de-DE" lang="de-DE">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Serverwartung</title>
        <meta name="robots" content="NOINDEX,NOFOLLOW" />
    </head>
    <body style="color:#FFF;background:#333 none;font:normal 68.75%/136.36% arial,sans-serif;margin:0;padding:0;">
        <div style="background:#0063AF none;border-bottom:20px solid #fff;">
            <div style="padding:50px 0 0;margin:0 auto; max-width:750px;">
                <img src="<?php echo $imgData; ?>" style="float:left;border:0px solid black;vertical-align:bottom;margin:0 20px 0 0" />
                <h1 style="font-size:32px;line-height:50px;font-weight:bold;margin:0;">Wartung</h1>
                <p style="font-size:16px;line-height:24px;text-align:left;margin-top:32px;">
                    Sehr geehrte Besucher, <br /><br />
                    die Seite befindet sich im Moment im Wartungsmodus. <br />
                    Sie wird in Kürze wieder erreichbar sein.
                </p>
                <div style="clear:both"></div>
            </div>
        </div>
    </body>
</html>
