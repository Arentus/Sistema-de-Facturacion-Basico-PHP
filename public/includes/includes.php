<?php
class Includes{


	public function __construct(){
	}

	public function get_header($title='factusys'){
		echo '<!DOCTYPE html><html lang="es"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"><title> '.$title.' | '.APP_NAME.' </title><link rel="stylesheet" type="text/css" href="node_modules/bootstrap/dist/css/bootstrap.css"><link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous"></style></head>';
	}

}
