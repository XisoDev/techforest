$(document).ready(function(){
	var userInputId = getCookie("userInputId");//저장된 쿠기값 가져오기
	$("#user_id").val(userInputId);

	if($("#user_id").val() != ""){ // 그 전에 ID를 저장해서 처음 페이지 로딩
																			 // 아이디 저장하기 체크되어있을 시,
		$("#customCheck1").attr("checked", true); // ID 저장하기를 체크 상태로 두기.
	}

$("#customCheck1").change(function(){ // 체크박스에 변화가 발생시
	if($("#customCheck1").is(":checked")){ // ID 저장하기 체크했을 때,
			var userInputId = $("#user_id").val();
			setCookie("userInputId", userInputId, 7); // 7일 동안 쿠키 보관
	}else{ // ID 저장하기 체크 해제 시,
			deleteCookie("userInputId");
	}
});

// ID 저장하기를 체크한 상태에서 ID를 입력하는 경우, 이럴 때도 쿠키 저장.
$("#user_id").keyup(function(){ // ID 입력 칸에 ID를 입력할 때,
		if($("#customCheck1").is(":checked")){ // ID 저장하기를 체크한 상태라면,
				var userInputId = $("#user_id").val();
				setCookie("userInputId", userInputId, 7); // 7일 동안 쿠키 보관
		}
	});
});

function setCookie(cookieName, value, exdays){
	var exdate = new Date();
	exdate.setDate(exdate.getDate() + exdays);
	var cookieValue = escape(value) + ((exdays==null) ? "" : "; expires=" + exdate.toGMTString());
	document.cookie = cookieName + "=" + cookieValue;
}

function deleteCookie(cookieName){
	var expireDate = new Date();
	expireDate.setDate(expireDate.getDate() - 1);
	document.cookie = cookieName + "= " + "; expires=" + expireDate.toGMTString();
}

function getCookie(cookieName) {
	cookieName = cookieName + '=';
	var cookieData = document.cookie;
	var start = cookieData.indexOf(cookieName);
	var cookieValue = '';
	if(start != -1){
		start += cookieName.length;
		var end = cookieData.indexOf(';', start);
		if(end == -1)end = cookieData.length;
		cookieValue = cookieData.substring(start, end);
}
	return unescape(cookieValue);
}

//숫자만 입력가능하게
function onlyNumber(obj){
	regNumber = /^[0-9]*$/;

	if(!regNumber.test(obj.value)) {
		$(obj).val($(obj).val().replace(/[^0-9]/g,""));
		return toastr.error("숫자만 입력해주세요.");
	}
}

//희망급여
function salary_select_change(obj){
  $("#salary_text").show();
  switch (obj.value) {
    case '1':
    case '2':
    document.getElementById('salary_text').innerHTML = "만원 이상";
    break;
    case '3':
    case '4':
    document.getElementById('salary_text').innerHTML = "원 이상";
    break;
    default:
    $("#salary_text").hide();
  }
}

//희망근무지
function workPlace(obj){
  if(obj.value > 0 && obj.value < 8){
    $("#city_select").prop('disabled', true);
    $("#city_select").empty();
    $("#district_select").prop('disabled', false);
    $("#district_select").empty();

    for(var i = 0; i < district_arr.length; i++){
      if(obj.value == district_arr[i]["local_idx"]){
        var option = $('<option value="' +district_arr[i]["district_idx"]+ '">' +district_arr[i]["district_name"]+ '</option>');
        $("#district_select").append(option);
      }
    }

  }else if(obj.value > 8 && obj.value < 18){
    $("#city_select").prop('disabled', false);
    $("#city_select").empty();
    $("#district_select").prop('disabled', true);
    $("#district_select").empty();

    for(var i = 0; i < city_arr.length; i++){
      if(obj.value == city_arr[i]["local_idx"]){
        var option = $('<option value="' +city_arr[i]["city_idx"]+ '">' +city_arr[i]["city_name"]+ '</option>');
        $("#city_select").append(option);
      }
    }
  }else if(obj.value != -1) {
    $("#city_select").prop('disabled', true);
    $("#city_select").empty();
    $("#district_select").prop('disabled', true);
    $("#district_select").empty();

    for(var i = 0; i < local_arr.length; i++){
      if(obj.value == local_arr[i]["local_idx"]){
        var option = $('<option value="' +local_arr[i]["local_idx"]+ '">' +local_arr[i]["local_idx"]+ '</option>');
        $("#local_select").append(option);
      }
    }
  }else if(obj.value == -1 || obj.value == ""){
    $("#city_select").prop('disabled', true);
    $("#city_select").empty();
    $("#district_select").prop('disabled', true);
    $("#district_select").empty();
  }
}
