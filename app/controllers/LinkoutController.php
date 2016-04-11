<?php

class LinkoutController extends ControllerBase{

  public function indexAction(){

    $linkout_type = $this->request->getPost("linkout_type","string");
    $linkout_url = $this->request->getPost("linkout_url","string");
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $linkout_url);
    curl_setopt($ch, CURLOPT_HEADER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
    $a = curl_exec($ch); // $a will contain all headers
    
    $url = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL); // This is what you need, it will return you the last effective URL
    
    $json = file_get_contents($url);

    $obj = json_decode($json);

    //print_r($obj->results->bindings);
    //print_r($obj);

    $this->view->linkout_type = $linkout_type;
    $this->view->results = $obj->results->bindings;

  }

}

?>