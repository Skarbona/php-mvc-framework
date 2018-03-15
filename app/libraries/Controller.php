<?php
/*
 * Base Controller
 * Loads the models and views
 *
 */

class Controller {

    //Load model
    public function model($model) {

        //require model file
        require_once '../app/models/' . $model . '.php';

        //Instantiate model
        return new $model();

    }//End of function model

    public function view($view, $data=[]){
        //Check for view file
        if(file_exists('../app/views/' . $view . '.php')) {

            require_once '../app/views/' . $view . '.php';

        } else {

            //view dont exist

            die('View dont exist');

        }


    }

}