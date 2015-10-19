<?php

use \Concept;

class SearchController extends ControllerBase{

  public function indexAction(){
    $concept_id = $this->request->getPost("query","int");
    $searchtype = $this->request->getPost("SearchType","string");

    $myconcept = Concept::findFirstByConceptId($concept_id);

    $this->view->myconcept = $myconcept;
    $this->view->SearchType = $searchtype;
    
    
    if($searchtype == 'Drug'){
      $json = file_get_contents("http://api.ohdsi.org/WebAPI/CS1/evidence/drug/".$concept_id);
    }else if($searchtype == 'Event'){
      $json = file_get_contents("http://api.ohdsi.org/WebAPI/CS1/evidence/hoi/".$concept_id);
    }
    $obj = json_decode($json);

    $this->view->results = $obj;
  }

}
