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
$html_flipkart=file_get_contents('https://www.flipkart.com/search?q='.$search.'');

libxml_use_internal_errors(TRUE); //disable libxml errors
if(!empty($html_amazon)){ //if any html is actually returned
  $finder_title = new DOMDocument();
  $finder_price= new DOMDocument();
	$finder_title->loadHTML($html_amazon);
  $finder_price->loadHTML($html_amazon);
	libxml_clear_errors(); //remove errors for yucky html

	$price_xpath_title = new DOMXPath($finder_title);
  $price_xpath_price = new DOMXPath($finder_price);
/*class item
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
     echo '________________________________________________<br>';
     $AllObjects=array();
     foreach ($list as $each) {

        $title=$each->getElementsByTagName($name)->item(0)->nodeValue;
        $pric=$xDom->query(".//*[contains(@class, '$price')]",$each)->item(0)->parentNode->nodeValue;
        $pic=$each->getElementsByTagName($pic0)->item(0)->getAttribute('src');
        array_push($AllObjects,new item($title,$pric,$pic));
     }
     return $AllObjects;
  }
  $data=scrap($finder_price,'s-result-item','h2','currencyINR','img');
  $content='<tr><th>Name</th><th>Price</th><th>Image</th> </tr>';
  foreach ($data as $each) {
          $content.='<tr>
        <td>'.$each->title.'
        </td>
        <td>'.$each->price.'
        </td>
        <td>
          <img src='.$each->picture.'  />
        </td>
        </tr>
        ';
        echo '______________________<br>';
        echo 'Image:'.$each->picture.'<br>';
        echo 'Price:'.$each->price.'<br>';
        echo 'Title:'.$each->title.'<br>';
  }
  echo '<table>'.$content.'</table><br>';
  */
  $classname_amazon_title= 's-access-title';
  $classname_amazon_price='a-size-base a-color-price s-price a-text-bold';
	//get all the h2's with an id
	$finder_title = $price_xpath_title->query("//*[contains(@class, '$classname_amazon_title')]");
  $finder_price = $price_xpath_price->query("//*[contains(@class, '$classname_amazon_price')]");
  $string_content='<table id="items_returned"><tr><th>Amazon-Items</th><th>Price</th></tr>';
	if($finder_title->length > 0){
		/*foreach($finder_title as $row){
			echo $row->nodeValue . "<br/>";
		}*/
    for ($x=0; $x < $finder_price->length; $x++)
    {
    //  echo $finder_title[$x]->nodeValue .'--------'. $finder_price[$x]->nodeValue.'<br/>';
      $local='<tr><td>'.$finder_title[$x]->nodeValue.'</td><td>'.$finder_price[$x]->nodeValue.'</td></tr>';
      $string_content=$string_content . $local;
    }
    //echo count($finder_price);

    $content = '<!DOCTYPE HTML>
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
                    <div class=row>
                      <div class="col-md-6">
                      '.$string_content.'
                      </table>
                      </div>
                      <div class="col-md-6">
                    </body>
                  </html>
                ';
                echo $content;
	}
  //var_dump($finder_price);
}
$string_content='';
$local='';
$content='';
if(!empty($html_flipkart)){ //if any html is actually returned
  $finder_title = new DOMDocument();
  $finder_price= new DOMDocument();
	$finder_title->loadHTML($html_flipkart);
  $finder_price->loadHTML($html_flipkart);
	libxml_clear_errors(); //remove errors for yucky html

	$price_xpath_title = new DOMXPath($finder_title);
  $price_xpath_price = new DOMXPath($finder_price);
  $classname_flipkart_price= '_1vC4OE _2rQ-NK';
  $classname_flipkart_title= '_3wU53n';
	$finder_title = $price_xpath_title->query("//*[contains(@class, '$classname_flipkart_title')]");
  $finder_price = $price_xpath_price->query("//*[contains(@class, '$classname_flipkart_price')]");
  $string_content='<table id="items_returned"><tr><th>Flipkart-Items</th><th>Price</th></tr>';
	if($finder_title->length > 0){
		/*foreach($finder_title as $row){
			echo $row->nodeValue . "<br/>";
		}*/
    for ($x=0; $x < $finder_price->length; $x++)
    {
    //  echo $finder_title[$x]->nodeValue .'--------'. $finder_price[$x]->nodeValue.'<br/>';
      $local='<tr><td>'.$finder_title[$x]->nodeValue.'</td><td>'.$finder_price[$x]->nodeValue.'</td></tr>';
      $string_content=$string_content . $local;
    }
    //echo count($finder_price);

    $content = '
                      '.$string_content.'
                        </table>
                      </div>
                    </div>
                    </body>
                  </html>
                ';
                echo $content;
	}
  //var_dump($finder_price);
}
?>
