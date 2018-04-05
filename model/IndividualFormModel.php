<?php
require_once __DIR__."/BaseFormModel.php";
require_once __DIR__."/CsvModel.php";

class IndividualFormModel extends BaseFormModel {
	
	public function validateUnique() {

		if ( $this->form["name"] == "" ){
			$this->createErrorObj("validate","name","氏名を入力してください");
		}
	}

	public function saveData() {
		// CSVを保存
		// 現在日時,名前,メールアドレス,問い合わせ種別,問い合わせ内容
		$file = __DIR__."/../csv/individual.csv";
		$ds = new CsvModel();
		$args = [ 
			"dist" => $file,
			"data" => array(
				date("Y/m/d H:i:s"),
				$this->form["name"],
				$this->form["email"],
				$this->form["inquiryType"],
				$this->form["inquiryBody"]
			)
		];
		$result = $ds->save($args);

		if ( isset($result) ){
			$this->createErrorObj("save","","ファイルへの書き込みでエラーが発生しました。");
		}
	}
}

?>
