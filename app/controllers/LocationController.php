<?php

class LocationController extends ControllerBase {
    public function getstatesAction($idCountry) {
        $states = array();
        
        $statesObj = State::findByIdCountry($idCountry);        
        
        
        foreach ($statesObj as $state) {
            $st = new stdClass();
            $st->id = $state->idState;
            $st->name = $state->name;
            
            $states[] = $st;
        }
        
        return $this->setJsonResponse($states, 200);
    }
    
    public function getcitiesAction($idState) {
        $cities = array();
        
        $citiesObj = City::findByIdState($idState);        
        
        
        foreach ($citiesObj as $city) {
            $ct = new stdClass();
            $ct->id = $city->idState;
            $ct->name = $city->name;
            
            $cities[] = $ct;
        }
        
        return $this->setJsonResponse($cities, 200);
    }
}

