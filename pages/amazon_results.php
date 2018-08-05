<?php
$arrContextOptions=array(
    "ssl"=>array(
        "verify_peer"=>false,
        "verify_peer_name"=>false,
    ),
);
$search=$_POST['p_info'];
$search=urlencode($search);
$html_amazon = file_get_contents('https://www.amazon.in/s/ref=nb_sb_noss?url=search-alias%3Daps&field-keywords='.$search.''); //get the html returned from the following url
$document = new DOMDocument();
libxml_use_internal_errors(TRUE);
$document->loadHTML($html_amazon);
libxml_clear_errors();
class item
{
  function __construct($name,$price,$pic) {
    $this->title=$name;
    $this->price=$price;
    $this->picture=$pic;
  }
}
  function scrap($dom,$main,$name,$price,$pic0)
  {
     $xDom=new DOMXPath($dom);
     $list=$xDom->query("//*[contains(@class, '$main')]");
     $AllObjects=array();
     foreach ($list as $each) {

        $title=$each->getElementsByTagName($name)->item(0)->nodeValue;
        $pric=$xDom->query(".//*[contains(@class, '$price')]",$each)->item(0)->parentNode->nodeValue;
        $pic=$each->getElementsByTagName($pic0)->item(0)->getAttribute('src');
        array_push($AllObjects,new item($title,$pric,$pic));
     }
     return $AllObjects;
  }
  $content='<tr><th>Amazon-Items</th><th>Price</th><th>Image</th> </tr>';
  foreach (scrap($document,'s-result-item','h2','currencyINR','img') as $each) {
          $content.='<tr>
        <td>'.$each->title.'
        </td>
        <td>&#8377;'.$each->price.'
        </td>
        <td>
          <img src='.$each->picture.'  />
        </td>
        </tr>
        ';
  }
  echo '<!DOCTYPE HTML>
              <html lang="en">
                 <head>
                    <title>DM-AI</title>
                    <link rel="stylesheet" type="text/css" href="../css/main.css">
                    <meta charset="utf-8">
                    <meta name="Description" CONTENT="DawnMist">
                    <link href="../css/style.css" rel="stylesheet"/>
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <meta name="keywords" content="HTML,CSS,XML,JavaScript">
                    <meta name="theme-color" content="#2f2f2f">
                    <link href="../css/bootstrap.css" rel="stylesheet"/>
                </head>
                  <body style="background:#fff !important;">

                    <table id="items_returned">'.$content.'</table><br>;
                  </body>
                </html>';
?>
