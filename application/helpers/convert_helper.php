<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('array_to_csv'))
{
    function array_to_csv($array, $download = "", $path ='')
    
    {
    
        if ($download != "")
        {    
            header('Content-Type: application/csv; charset=SHIFT-JIS');
            header('Content-Disposition: attachement; filename="' . $download . '"');
        }        

        ob_start();
        $f = fopen($path, 'w') or show_error("Can't open $path");
        $n = 0;        
        foreach ($array as $line)
        {
            $n++;
		
            if ( ! fputcsv($f, $line))
            {
                show_error("Can't write line $n: $line");
            }
        }
        fclose($f) or show_error("Can't close php://output");
        $str = ob_get_contents();
        ob_end_clean();

        if ($download == "")
        {
            return $str;    
        }    
    }
}

if ( ! function_exists('convert_rss_array')){

    function convert_rss_array($url){
			$feed = new DOMDocument;
			$feed->load($url);
			$feed_array = array();
	
			foreach($feed->getElementsByTagName('item') as $story){
                $titleOriginal = $story->getElementsByTagName('title')->item(0)->nodeValue;
                $title = strlen($titleOriginal) > 10 ? trim($titleOriginal) : $titleOriginal;

                $descriptionOriginal = $story->getElementsByTagName('description')->item(0)->nodeValue;
                $description = strlen($descriptionOriginal) > 10 ? trim($descriptionOriginal) : $descriptionOriginal;

				$story_array = array (
                    'title' => $title,
                    'desc' => $description,
								
				);
	
				array_push($feed_array, $story_array);
            }
            return $feed_array;
    }
}
?>

