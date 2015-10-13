<?php

use \Concept;
use \ConceptLookup;

class IndexController extends ControllerBase
{

  public function eventsuggestionAction($filtercondition)
    {
      $this->view->disable();
      $suggestion = Concept::find(array(
					"conditions" => "vocabulary_id = 'SNOMED' and concept_class_id = 'Clinical Finding' and upper(concept_name) like ?1 and invalid_reason is null and standard_concept = 'S'","order"=>"concept_name",
					"bind"=>array(1=>strtoupper($filtercondition).'%')));
      $results = $suggestion->toArray();
      if(count($results) == 0){
	$empty_arr = array(0=>array('concept_id'=>0,'concept_name'=>'No Matching Results'));
	echo(json_encode($empty_arr));
      }else{
	echo(json_encode($results));
      }
    }

  public function productsuggestionAction($filtercondition)
  {
    $this->view->disable();
    $suggestion = Concept::find(array(
				      "conditions" => "vocabulary_id = 'RxNorm' and upper(concept_name) like ?1 and invalid_reason is null and concept_class_id = 'Clinical Drug'","order"=>"concept_name",
				      "bind"=>array(1=>strtoupper($filtercondition).'%')));
    $results = $suggestion->toArray();
      if(count($results) == 0){
	$empty_arr = array(0=>array('concept_id'=>0,'concept_name'=>'No Matching Results'));
	echo(json_encode($empty_arr));
      }else{
	echo(json_encode($results));
      }

  }

  public function ingredientsuggestionAction($filtercondition)
  {
    $this->view->disable();
    $suggestion = Concept::find(array(
				      "conditions" => "vocabulary_id = 'RxNorm' and upper(concept_name) like ?1 and invalid_reason is null and concept_class_id = 'Ingredient'","order"=>"concept_name",
				      "bind"=>array(1=>strtoupper($filtercondition).'%')));
    $results = $suggestion->toArray();
      if(count($results) == 0){
	$empty_arr = array(0=>array('concept_id'=>0,'concept_name'=>'No Matching Results'));
	echo(json_encode($empty_arr));
      }else{
	echo(json_encode($results));
      }

  }

  public function indexAction()
  {

    $this->view->ispost = false;
    
    //$this->view->lookup = $lookup;
    
    if($this->request->isPost()){

      $this->view->ispost = true;

      $concept_id = $this->request->getPost("query","int");
      $searchtype = $this->request->getPost("SearchType","string");
      
      //echo("concept_id:".$concept_id);
      //echo("searchtype:".$searchtype);
      
      $myconcept = Concept::findFirstByConceptId($concept_id);
      
      $this->view->myconcept = $myconcept;
      $this->view->SearchType = $searchtype;
      
      
      if($searchtype == 'Ingredient' || $searchtype == 'Product'){
	$json = file_get_contents("http://api.ohdsi.org/WebAPI/CS1/evidence/drug/".$concept_id);
      }else if($searchtype == 'Event'){
	$json = file_get_contents("http://api.ohdsi.org/WebAPI/CS1/evidence/hoi/".$concept_id);
      }
      $obj = json_decode($json);

      $return_obj = array();
      foreach($obj as $id=>$item){
	if(!array_key_exists($item->EVIDENCE,$return_obj)){	
	  $return_obj[$item->EVIDENCE] = array();
	}
	$child_arr = $return_obj[$item->EVIDENCE];
	if($item->COUNT){
	  $count = $item->COUNT;
	}else{
	  $count = $item->VALUE;
	}
	if($item->HOI){
	  $result_code = $item->HOI;
	}else{
	  $result_code = $item->DRUG;
	}
	$child_arr[] = array('EVIDENCE'=>$item->EVIDENCE,'RESULT_CODE'=>$result_code,'LINKOUT'=>$item->LINKOUT,'STATISTIC_TYPE'=>$item->STATISTIC_TYPE,'COUNT'=>$count);
	$return_obj[$item->EVIDENCE] = $child_arr;
      }
      asort($return_obj);
      
      $return_obj_sorted = array();
      
      foreach($return_obj as $list){
	//print_r($list);
	usort($list, function($a,$b){
	    //return $a['COUNT'] > $b['COUNT'] ? -1: 1;
	    return $b['COUNT'] - $a['COUNT'];
	});
	//print_r($list);
	$return_obj_sorted[] = $list;
      }
      
      //$this->view->results = $obj;
      $this->view->results = $return_obj_sorted;
    }
  }
  
}

