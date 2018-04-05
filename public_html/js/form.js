(function() {
	// ラジオボタン よく使うので
	var d;

	var switchFormUserType = function(){
		var selected;
		var unselected;
		// 法人と個人のどちらが選択されているか探す
		for ( var i = 0; d.length > i; i++ ) {
			if ( d[i].checked ) {
				selected = d[i].value;
			} else {
				unselected = d[i].value;
			}
		}
		// 選択されている項目を表示、そうでない項目を隠す
		var sd = document.getElementsByClassName(selected);
		var ud = document.getElementsByClassName(unselected);
		for ( var j = 0; sd.length > j; j++ ) {
			sd[j].style.display = "block";
		}
		for ( var k = 0; ud.length > k; k++ ) {
			ud[k].style.display = "none";
		}
	};

	var init = function(){
		d = document.getElementsByName("userType");
		
		document.body.style.display = "none";
		// イベント追加
		for ( var i = 0; d.length > i; i++ ) {
			d[i].onclick = switchFormUserType;
		}

		// 初期実行
		switchFormUserType();

		// カックン対策
		setTimeout(function(){ document.body.style.display = "block";}, 300);
	};

	window.onload = init;
})();
