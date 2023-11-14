
/* 削除ボタン処理 */
function deletepopup(formName) {  
    if(window.confirm('削除してもよろしいですか？')){
        var deleteform = document.querySelector('.deleteform[name="' + formName + '"]');
        deleteform.submit();
	} else {
		window.alert('キャンセルしました');
        return false;
	}
}

const delbtns = document.querySelectorAll('.delete-button');
delbtns.forEach(function(delbtn) {
    delbtn.addEventListener('click', function() {

        // 対応するフォームの name 属性を取得して、フォーム送信前の処理を実行
        var formName = delbtn.closest('.deleteform').getAttribute('name');

        deletepopup(formName);
    });
});


/* 投稿ボタン処理 */
const cform = document.getElementById('create');
if(cform !== null){ 
    cform.addEventListener('submit', function(e) {

        e.preventDefault();

        if(window.confirm('投稿してもよろしいですか？')){
            document.createform.submit();
        } else {
            window.alert('キャンセルしました');
            return false;
        }
    });
}

/* 編集ボタン処理 */
const eform = document.getElementById('edit');
if(eform !== null){ 
    eform.addEventListener('submit', function(e) {

        e.preventDefault();

        if(window.confirm('更新してもよろしいですか？')){
            document.editform.submit();
        } else {
            window.alert('キャンセルしました');
            return false;
        }
    });
}

/* 文字数カウント */
window.onload = function() {
    // 編集画面のみページ読み込み時にも文字数カウントする
    var url = location.href;
    if (url.indexOf('edit') > -1) {
        var len = document.getElementById("body").value.length;
        document.querySelector('.length').innerText = len;
    }
}

function wordCount(val) {
    return {
        charactersNoSpaces: val.replace(/\s+/g, '').length,
        characters: val.length
    };
}
const textArea = document.querySelector('#body');
const length   = document.querySelector('.length');
if(textArea !== null){ 
    textArea.addEventListener('input', () => {
        length.textContent = textArea.value.length;
    }, false);
}
