<?php
require_once __DIR__.'/bootstrap.php';
require_once __DIR__.'/../controller/FormController.php';

$FormController = new FormController();

$result = $FormController->form($_POST);

// レンダリング
echo $twig->render($result["usepage"], [
	"post" => $_POST,
	"errorObjs" => $result["errorObjs"]
	]);
?>

