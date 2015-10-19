<?php

use \Concept;

class ConceptLookup extends Phalcon\Mvc\User\Component
{

  public function getName($concept_id){
    $concept = Concept::findFirstByConceptId($concept_id);
    $arr=$concept->toArray();
    return $arr['concept_name'];
  }

}