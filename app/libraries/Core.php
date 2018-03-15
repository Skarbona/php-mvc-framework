<?php
/*
 *
 * App Core Class
 * Creates URL and loads core controller
 * URL FORMAT - /controller/method/params
 *
 */

class Core {

    protected $currentController = 'Pages';
    protected $currentMethod     = 'index';
    protected $params            =  [];


    public function __construct()
    {

       // print_r($this->getUrl());

        $url = $this->getUrl();

        //Look in controllers for first index

        if(file_exists('../app/controllers/' . ucwords($url[0]) . '.php')) {
            //If exist, set as controller
            $this->currentController = ucwords($url[0]);
            //Unset 0 index
            unset($url[0]);
        }

        //Require the controller
        require_once '../app/controllers/' . $this->currentController .'.php';

        //Instantiate controller class
        $this->currentController = new $this->currentController;

        //Check for Second part of url
        if(isset($url[1])){
            //Check to see if the method exist in controller
            if(method_exists($this->currentController, $url[1])) {

                $this->currentMethod = $url[1];
                unset($url[1]);

            }



        }//End of Check Second part of url



        if($this->params = $url) {
            $this->params = array_values($url);
        } else {
            $this->params = [];
        }
//        $this->params = $url ? array_values($url) : [];
        //call a callback with array of params

        call_user_func_array([$this->currentController,$this->currentMethod],$this->params);



    } //End of Constructor


    public function getUrl()
    {

      if(isset($_GET['url'])) {

          $url = rtrim($_GET['url'], '/');
          $url = filter_var($url, FILTER_SANITIZE_URL);
          $url = explode('/',$url);

          return $url;


      }

    }//End of getUrl function


}//End of class Core