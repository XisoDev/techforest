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

	}
	else if(obj.value > 8 && obj.value < 18){
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

	}
	else {
		$("#city_select").prop('disabled', true);
		$("#city_select").empty();
		$("#district_select").prop('disabled', true);
		$("#district_select").empty();
	}
}

// 우편번호 찾기 찾기 화면을 넣을 element
 var element_wrap = document.getElementById('wrap');

 function foldDaumPostcode() {
		 // iframe을 넣은 element를 안보이게 한다.
		 element_wrap.style.display = 'none';
 }

 function search_address() {
		 // 현재 scroll 위치를 저장해놓는다.
		 var currentScroll = Math.max(document.body.scrollTop, document.documentElement.scrollTop);
		 new daum.Postcode({
				 oncomplete: function(data) {
						 // 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.

						 // 각 주소의 노출 규칙에 따라 주소를 조합한다.
						 // 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
						 var addr = ''; // 주소 변수
						 var extraAddr = ''; // 참고항목 변수

						 //사용자가 선택한 주소 타입에 따라 해당 주소 값을 가져온다.
						 if (data.userSelectedType === 'R') { // 사용자가 도로명 주소를 선택했을 경우
								 addr = data.roadAddress;
						 } else { // 사용자가 지번 주소를 선택했을 경우(J)
								 addr = data.jibunAddress;
						 }

						 // 사용자가 선택한 주소가 도로명 타입일때 참고항목을 조합한다.
						 if(data.userSelectedType === 'R'){
								 // 법정동명이 있을 경우 추가한다. (법정리는 제외)
								 // 법정동의 경우 마지막 문자가 "동/로/가"로 끝난다.
								 if(data.bname !== '' && /[동|로|가]$/g.test(data.bname)){
										 extraAddr += data.bname;
								 }
								 // 건물명이 있고, 공동주택일 경우 추가한다.
								 if(data.buildingName !== '' && data.apartment === 'Y'){
										 extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
								 }
								 // 표시할 참고항목이 있을 경우, 괄호까지 추가한 최종 문자열을 만든다.
								 if(extraAddr !== ''){
										 extraAddr = ' (' + extraAddr + ')';
								 }
								 // 조합된 참고항목을 해당 필드에 넣는다.


						 } else {

						 }

						 // 우편번호와 주소 정보를 해당 필드에 넣는다.
						 document.getElementById("address").value = addr + " "+ extraAddr;
						 // 커서를 상세주소 필드로 이동한다.
						 document.getElementById("address2").focus();

						 // iframe을 넣은 element를 안보이게 한다.
						 // (autoClose:false 기능을 이용한다면, 아래 코드를 제거해야 화면에서 사라지지 않는다.)
						 element_wrap.style.display = 'none';

						 // 우편번호 찾기 화면이 보이기 이전으로 scroll 위치를 되돌린다.
						 document.body.scrollTop = currentScroll;
				 },
				 // 우편번호 찾기 화면 크기가 조정되었을때 실행할 코드를 작성하는 부분. iframe을 넣은 element의 높이값을 조정한다.
				 onresize : function(size) {
						 element_wrap.style.height = size.height+'px';
				 },
				 width : '100%',
				 height : '100%'
		 }).embed(element_wrap);

		 // iframe을 넣은 element를 보이게 한다.
		 element_wrap.style.display = 'block';
 }

 function interest_add(h_idx){
	 var add_confirm = confirm("관심공고로 등록하시겠습니까?");
	 var m_idx = $('#hidden_m_idx').val();
	 if(add_confirm == true){
		 var params = {};
		 params["h_idx"] = h_idx;
		 params["m_idx"] = m_idx;

		 exec_json("technician.interest_add",params,function(ret_obj){
				 toastr.success(ret_obj.message);
				 location.reload();
		 });
	 }
 }

 function interest_remove(h_idx){
	 var remove_confirm = confirm("관심공고를 해지하시겠습니까?");
	 var m_idx = $('#hidden_m_idx').val();
	 if(remove_confirm == true){
		 var params = {};
		 params["h_idx"] = h_idx;
		 params["m_idx"] = m_idx;

		 exec_json("technician.interest_remove",params,function(ret_obj){
				 toastr.success(ret_obj.message);
				 location.reload();
		 });
	 }
 }
