<?php

namespace App\model;
use Illuminate\Database\Eloquent\Model;
use Sunra\PhpSimple\HtmlDomParser;
use Image;

class SimpleHTMLDom extends Model
{
    public function getInnerText($file_name,$elem){
    	$user = new HtmlDomParser();
    	$dom = $user->file_get_html( $file_name );
    	$elem = $dom->find($elem);
    	foreach($elem as $key => $items){
    		$content[$key] = $items->innertext;
    	}
    	return $content;
    }
    public function getHref($file_name,$elem){
    	$user = new HtmlDomParser();
    	$dom = $user->file_get_html( $file_name );
    	$elem = $dom->find($elem);
    	foreach($elem as $key => $items){
    		$content[$key] = $items->href;
    	}
    	return $content;
    }
    public function getSrc($file_name,$elem,$download = false,$folder = ''){
    	$user = new HtmlDomParser();
    	$dom = $user->file_get_html( $file_name );
    	$elem = $dom->find($elem);
    	foreach($elem as $key => $items){
    		$get_img_name = pathinfo($items->src);
    		if($download === true){
    			$src = file_get_contents($items->src);
    			file_put_contents($folder.$get_img_name['basename'],$src);
    		}
    		$content[$key] = $items->src;
    	}
    	return $content;
    }
}
