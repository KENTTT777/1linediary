function l(e){if(window.confirm("削除してもよろしいですか？")){var t=document.querySelector('.deleteform[name="'+e+'"]');t.submit()}else return window.alert("キャンセルしました"),!1}const i=document.querySelectorAll(".delete-button");i.forEach(function(e){e.addEventListener("click",function(){var t=e.closest(".deleteform").getAttribute("name");l(t)})});const o=document.getElementById("create");o!==null&&o.addEventListener("submit",function(e){if(e.preventDefault(),window.confirm("投稿してもよろしいですか？"))document.createform.submit();else return window.alert("キャンセルしました"),!1});const r=document.getElementById("edit");r!==null&&r.addEventListener("submit",function(e){if(e.preventDefault(),window.confirm("更新してもよろしいですか？"))document.editform.submit();else return window.alert("キャンセルしました"),!1});window.onload=function(){var e=location.href;if(e.indexOf("edit")>-1){var t=document.getElementById("body").value.length;document.querySelector(".length").innerText=t}};const n=document.querySelector("#body"),u=document.querySelector(".length");n!==null&&n.addEventListener("input",()=>{u.textContent=n.value.length},!1);
