<?php

abstract class BaseFormModel {

	protected $form;
	protected $result =
	[ "errorObjs" => []
	];

	public function __construct($form) {
		$this->form = $form;
	}
	
	/* 共通項目
	・問い合わせ種別
	・メールアドレス
	・問い合わせ内容 */
	public function validateCommon() {

		if ( $this->form["inquiryType"] == "" ){
			$this->createErrorObj("validate","inquiryType","問い合わせ種別を入力してください");
		}
		if ( $this->form["email"] == "" ){
			$this->createErrorObj("validate","email","メールアドレスを入力してください");
		}
		if ( $this->form["inquiryBody"] == "" ){
			$this->createErrorObj("validate","inquiryBody","問い合わせ内容を入力してください");
		}

	}

	// フォーム項目のIDと日本語名を返却できるようにしたかった
	//public function getCommonNames()
	
	public function createErrorObj($errorlevel, $id, $cause) {
		array_push($this->result["errorObjs"], [
			"errorlevel" => $errorlevel,
			"cause" => $cause,
			"id" => $id
		]);
		return;
	}

	public function confirm() {
		$this->validateCommon();
		$this->validateUnique();
		return $this->result;
	}

	public function send() {
		//再チェック
		$result = $this->confirm();

		if ( count($result["errorObjs"]) == 0 ) {
			$this->saveData();			
		}
		return $this->result;
	}

	abstract public function validateUnique();

	abstract public function saveData();
}


?>
