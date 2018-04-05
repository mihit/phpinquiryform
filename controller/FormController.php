<?php

require_once __DIR__."/../model/CorporationFormModel.php";
require_once __DIR__."/../model/IndividualFormModel.php";

class FormController {

	public function form($form) {

		$result = [
			"errorObjs" => [],
			"usepage" => ""
		];

		// モデル切り替え
		if ( isset($form["userType"]) && "individual" == $form["userType"] ) {
			$model = new IndividualFormModel($form);
		} else {
			$model = new CorporationFormModel($form);
		}

		$transition = "";
		if ( isset($form["transitionId"]) ){
			$transition = $form["transitionId"];
		};
		// 遷移状態による切り替え
		// 完了画面処理
		if ( $transition == "confirm" ) {
			$result = $model->send();
			if ( count($result["errorObjs"]) > 0 ) {
				$result["usepage"] = "tmpl_index.html";
			} else {
				$result["usepage"] = "tmpl_finish.html";
			}
		// 確認画面処理
		} else if ( $transition == "input") {
			$result = $model->confirm();
			if ( count($result["errorObjs"]) > 0 ) {
				$result["usepage"] = "tmpl_index.html";
			} else {
				$result["usepage"] = "tmpl_confirm.html";
			}
		} else {
			$result["usepage"] = "tmpl_index.html";
		}

		return $result;
	}
}


?>