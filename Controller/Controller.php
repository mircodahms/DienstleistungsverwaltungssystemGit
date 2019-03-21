<?php

class Controller extends DatabaseFunction {

    //Erstellung der Ansicht
    public static function CreateView($viewName) {
        require_once("./Views/$viewName.php");
    }
}
