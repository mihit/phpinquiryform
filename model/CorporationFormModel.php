<?php
require_once __DIR__."/BaseFormModel.php";
require_once __DIR__."/CsvModel.php";

class CorporationFormModel extends BaseFormModel {
	
	public function validateUnique() {

		if ( $this->form["companyName"] == "" ){
			$this->createErrorObj("validate","companyName","会社名を入力してください");
		}
		if ( $this->form["dept"] == "" ){
			$this->createErrorObj("validate","dept","部署名を入力してください");
		}
		if ( $this->form["personnelName"] == "" ){
			$this->createErrorObj("validate","personnelName","ご担当者を入力してください");
		}
	}

	public function saveData() {
		// CSVを保存
		// 現在日時,会社名,部署,ご担当者名,メールアドレス,問い合わせ種別,問い合わせ内容
		$file = __DIR__."/../csv/corp.csv";

		//本当はDataSourceクラスにDIしたい
		$ds = new CsvModel();
		$args = [ 
			"dist" => $file,
			"data" => array(
				date("Y/m/d H:i:s"),
				$this->form["companyName"],
				$this->form["dept"],
				$this->form["personnelName"],
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
