
<div class="container">
    <div class="content_padding px-0 mb-0 pb-0">
        <a class="pull-right" href="<?=getUrl('member','login')?>"><i class="xi-close xi-2x"></i></a>
        <h3>본인인증</h3>

    </div>

    <div class="content_padding">
        <div class="row mb-4">
            <div class="col-12 mt-3 mx-0 px-0">
                <h6>회원종류 선택</h6>
            </div>
            <div class="col-6 mx-0 px-0 pr-1">
                <a href="<?=getUrl('member','signUp',false,array("user_type" => "technician"))?>" class="btn btn-block btn-round btn-primary">개인 회원가입</a>
            </div>
            <div class="col-6 mx-0 px-0 pl-1">
                <a href="<?=getUrl('member','signUp',false,array("user_type" => "company"))?>" class="btn btn-block btn-round btn-light">기업 회원가입</a>
            </div>
        </div>
        <div class="row">
            <div class="col col-5 mx-auto pt-5 pb-2">
                <img src="/oPage/member/assets/images/auth_icon.png" />
            </div>
        </div>
        <div class="row">
            <div class="col pb-5">
                <p class="text-center">
                    회원님의<br /><span class="weight_bold">개인정보 보호 및 본인확인</span>을<br />위해 인증이 필요합니다.
                </p>
            </div>
        </div>

        <div class="row">
            <div class="col mx-0 px-0">
            <a href="/proc.php?act=member.procMemberNiceAuth" class="btn btn-block btn-primary btn-block btn-round">인증번호 요청</a>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
function
  var IMP = window.IMP; // 생략해도 괜찮습니다.
  IMP.init("imp24082824"); // 발급받은 "가맹점 식별코드"를 사용합니다.

  // IMP.certification(param, callback) 호출
  IMP.certification({ // param
    merchant_uid: "ORD20180131-0000011"
  }, function (rsp) { // callback
    if (rsp.success) {
      ...,
      // 인증 성공 시 로직,
      ...
    } else {
      ...,
      // 인증 실패 시 로직,
      ...
    }
  });

</script>
