<?

$c_idx = $logged_info['c_idx'];
$m_idx = $_SESSION['LOGGED_INFO'];

if($logged_info['is_commerce'] == 'Y'){
  $oDB->where("c_idx",$c_idx);
  $oDB->join("TF_member_commerce_tb mc","mc.m_idx = m.m_idx","LEFT");
  $row = $oDB->getOne("TF_member_tb m");

  $api_id = substr($row['m_id'],0,3);
}else{
  $oDB->where("m_idx",$m_idx);
  $row = $oDB->getOne("TF_member_tb");
}
?>



<div class="container pt-lg-5">
    <div class="content_padding px-0 d-lg-none">
        <a href="#" onclick="history.back();"><i class="xi-arrow-left xi-2x"></i></a>
        <h5 class="weight_normal">아이디・비밀번호 관리</h5>
    </div>

    <div class="pt-lg-5 pt-lg-3 position-relative mx-auto col-sm-10 col-md-9 col-lg-8">
        <h4 class="d-none d-lg-block mb-4"><i class="xi-cog text-secondary"></i> 아이디・비밀번호 관리</h4>
    </div>

    <div class="mx-auto col-sm-10 col-md-9 col-lg-8 rounded border p-4 p-md-5 ">
    <form class="tf_underline_form">
        <div class="form-group">
            <label for=""><i class="xi-key"></i> 아이디 </label><br>
            <?if($api_id == 'TF_' && $row['is_commerce'] == 'Y'){?>
               <span class="xs_content red  px-0 mx-0"><i class="xi-error"></i>임시아이디시네요! 아이디를 전환해주세요!</span>
            <?}?>
            <input type="text" class="form-control" id="api_id" placeholder="아이디를 입력해주세요." value="<?=$logged_info['m_id']?>" readonly="readonly">
            <?if($api_id == 'TF_' && $row['is_commerce'] == 'Y'){?>
              <button type="button" id="change_id_btn" onclick="change_id()" class="bg-red btn btn-xs btn-round">전환</button>
              <button type="button" id="change_id_btn_ok" class="bg-red btn btn-xs btn-round" style="display:none;">수정완료</button>
            <?}?>
        </div>
        <div class="form-group">
            <label for=""><i class="xi-lock"></i> 비밀번호</label>
            <div class="form-control" id="panel" style="display:none;height:auto;border:none;">
              현재 비밀번호 <br>
              <input type="password" id="now_pass"><br>
              새 비밀번호 <br>
              <input type="password" id="new_pass"><br>
              새 비밀번호 확인 <br>
              <input type="password" id="new_pass_check">
            </div>
            <button type="button" id="change_pass_btn" class="bg-red btn btn-xs btn-round">변경</button>
            <button type="button" id="change_pass_btn_ok" onclick="password()" class="bg-red btn btn-xs btn-round" style="display:none;">수정완료</button>
        </div>
    </form>

        <div class="row mt-4 col-md-7 col-lg-6 mx-auto">
            <div class="col-6 mx-0 px-0 pr-1">
                <a href="#" class="btn btn-block btn-round border-primary">취소</a>
            </div>
            <div class="col-6 mx-0 px-0 pl-1">
                <a href="#" class="btn btn-block btn-round btn-primary">수정완료</a>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
$("#change_pass_btn").click(function(){
  $('#pass_text').css("display","none");
  $('#change_pass_btn').css("display","none");
  $('#change_pass_btn_ok').css("display","block");
  $("#panel").slideDown();
});

function password(){
  var now_pass	=	$("#now_pass").val();
  var new_pass	=	$("#new_pass").val();
  var new_pass_check = $("#new_pass_check").val();
  var db_pass = "<?=$row['m_pw']?>";

  if(now_pass == ""){
    $('#now_pass').focus();
    return toastr.error("현재 비밀번호를 입력해주세요.");
  }

  if(new_pass == ""){
    $('#new_pass').focus();
    return toastr.error("새로운 비밀번호를 입력해주세요.");
  }

  if(new_pass_check == ""){
    $('#new_pass').focus();
    return toastr.error("새로운 비밀번호를 한번 더 입력해주세요.");
  }

  if(db_pass != now_pass){
    $('#now_pass').focus();
    return toastr.error("현재 비밀번호가 일치하지않습니다.");
  }

  if(new_pass.length < 6 || new_pass.length > 16){
    $('#new_pass').focus();
    return toastr.error("비밀번호는 6 ~ 16자 내로 입력해주세요.");
  }

  if(new_pass != new_pass_check){
    $('#new_pass_check').focus();
    return toastr.error("비밀번호가 일치하지않습니다.");
  }


  var params = {};
  params["new_pass"] = new_pass;
  exec_json("member.edit_pass",params,function(ret_obj){
     //통신에러나 모듈내부에서 에러가있을땐 알아서 처리해주므로 성공시만 처리하면됨.
     // alert(ret_obj.message); // alert 해도되지만 toastr 권장
      toastr.success(ret_obj.message);
      location.reload();
  });
}

function change_id(){
  $('#change_id_btn').css("display","none");
  $('#change_id_btn_ok').css("display","block");
  $("#api_id").val('');
  $('#api_id').prop('readonly', false);
  $("#api_id").focus();

  $('#change_id_btn_ok').click(function(){
    if($("#api_id").val() == ""){
      $('#api_id').focus();
      return toastr.error("아이디를 입력해주세요.");
    }
    if($("#api_id").val().length < 2 || $("#api_id").val().length > 16){
      $('#api_id').focus();
      return toastr.error("아이디는 2 ~ 16자 내로 입력해주세요.");
    }

    var params = {};
    params["m_id"] = $("#api_id").val();
    exec_json("member.edit_id",params,function(ret_obj){
       //통신에러나 모듈내부에서 에러가있을땐 알아서 처리해주므로 성공시만 처리하면됨.
       // alert(ret_obj.message); // alert 해도되지만 toastr 권장
        toastr.success(ret_obj.message);
        location.reload();
    });
  });

}

</script>
