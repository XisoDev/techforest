<script type="text/javascript">
function company_id_check(){
    var params = {};
    params["m_id"] = $("#signup_id").val();
    exec_json("company.procCompanyCheckHasID",params,function(ret_obj){
       //통신에러나 모듈내부에서 에러가있을땐 알아서 처리해주므로 성공시만 처리하면됨.
       // alert(ret_obj.message); // alert 해도되지만 toastr 권장
        toastr.success(ret_obj.message);
    });
}
</script>

<form action="/proc.php?act=company.procMemberSignupCompany" method="post">
    <input type="hidden" name="success_return_url" value="<?=getUrl('company')?>" />
<div class="container">
    <div class="row">
        <div class="col-12 mt-3 mx-0 px-0">
            <h6>회원종류 선택</h6>
        </div>

        <div class="col-6 mx-0 px-0 pr-1">
            <a href="<?=getUrl('member','signUp',false,array("user_type" => "technician"))?>" class="btn btn-block btn-round btn-light xs_content">개인 회원가입</a>
        </div>
        <div class="col-6 mx-0 px-0 pl-1">
            <a href="<?=getUrl('member','signUp',false,array("user_type" => "company"))?>" class="btn btn-block btn-round btn-primary xs_content">기업 회원가입</a>
        </div>

        <div class="col-12 mt-3 mx-0 px-0 mt-4">
            <h6>정보입력</h6>

            <div class="input-group mb-2">
                <input type="text" class="form-control" id="signup_id" name="m_id" value="<?=$_SESSION['signup']['m_id']?>" placeholder="아이디" required>
                <button class="btn btn-primary rounded rounded-0-left btn-xs" onclick="company_id_check(); return false;">중복확인</button>
            </div>

            <input type="password" class="form-control mb-2" name="m_pw1" id="m_pw1" value="<?=$_SESSION['signup']['m_pw1']?>" placeholder="비밀번호(6자리 이상)" required>
            <input type="password" class="form-control mb-2" name="m_pw2" id="m_pw2" value="<?=$_SESSION['signup']['m_pw2']?>"placeholder="비밀번호 확인" required>
        </div>

        <div class="col-6 mx-0 px-0 pr-1 mb-2">
            <input type="text" class="form-control" name="c_name" value="<?=$_SESSION['signup']['c_name']?>" placeholder="회사명" required>
        </div>
        <div class="col-6 mx-0 pl-1 px-0 mb-2">
            <div class="input-group">
                <div class="input-group-prepend">
                        <span class="input-group-text xs_content pl-2">
                            직급
                        </span>
                </div>
                <div class="input-group-append">
                    <select class="form-control border-left-0" name="c_position" onchange="if(this.value == 99){jQuery(this).hide(); jQuery(this).next().show();}">
                        <option value="" selected="selected">직급 선택</option>
                        <option value="대표">대표</option>
                        <option value="이사">이사</option>
                        <option value="99">직접입력</option>
                    </select>
                    <input type="text" class="form-control border-left-0" placeholder="직접입력" style="display:none;">
                </div>
            </div>
        </div>
        <div class="col-12 mx-0 px-0 mb-2">
          <input type="text" class="form-control mb-2" name="select7" id="select7" placeholder="담당자 이름" required>
        </div>
        <div class="col-12 mx-0 px-0 mb-2">
            <div class="input-group">
                <select class="form-control" name="phone1">
                    <option value="010" selected="selected">010</option>
                    <option value="011">011</option>
                    <option value="017">017</option>
                    <option value="051">051</option>
                </select>
                <div class="input-group-prepend">
                    <span class="input-group-text">-</span>
                </div>
                <input type="text" class="form-control" value="<?=$_SESSION['signup']['phone2']?>" name="phone2" placeholder="0000">
                <div class="input-group-prepend">
                    <span class="input-group-text">-</span>
                </div>
                <input type="text" class="form-control" value="<?=$_SESSION['signup']['phone3']?>" name="phone3" placeholder="0000">
            </div>
            <p class="xxs_content px-0 mx-0"><span class="red"><i class="xi-error"></i> 휴대전화 권장</span> : 매칭결과 안내문자를 받을 수 있습니다.</p>
        </div>

        <div class="col-12 mx-0 px-0 pl-1 mb-2">
            <div class="input-group">
                <input type="text" class="form-control"  value="<?=$_SESSION['signup']['m_email1']?>" name="m_email1" placeholder="이메일 주소 입력">

                <div class="input-group-prepend">
                        <span class="input-group-text">
                            @
                        </span>
                </div>
                <select class="form-control" name="m_email2" onchange="if(this.value == 99){jQuery(this).hide(); jQuery(this).next().show();}">
                    <option value="" selected="selected">메일 주소 선택</option>
                    <option value="1">naver.com</option>
                    <option value="2">gmail.com</option>
                    <option value="99">직접입력</option>
                </select>
                <input type="text" class="form-control" placeholder="직접입력" style="display:none;">
            </div>

        </div>

        <div class="col-12 text-left mt-0 mx-0 px-0 mt-4">
            <div class="pull-right pr-3">
                <div class="custom-control right-checkbox custom-checkbox mt-1">
                    <input type="checkbox" class="custom-control-input" id="customCheck1" checked>
                    <label class="custom-control-label text-dark xs_content weight_bold m-0 p-0" for="customCheck1">전체동의</label>
                </div>
            </div>
            <h6>약관동의</h6>

            <div class="pull-right pr-3">
                <div class="custom-control right-checkbox custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="agree1" checked>
                    <label class="custom-control-label xs_content" for="customCheck2">동의</label>
                </div>
            </div>
            <p class="xxs_content px-0 mx-0 weight_lighter">기술자숲 이용약관 <button class="badge-light px-2 py-0 border btn-round" data-toggle="modal" data-target="#company_terms">전문보기</button></p>

            <div class="clearfix"></div>
            <div class="pull-right pr-3">
                <div class="custom-control right-checkbox custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="agree1" checked>
                    <label class="custom-control-label xs_content" for="customCheck3">동의</label>
                </div>
            </div>
            <p class="xxs_content px-0 mx-0 weight_lighter">개인정보 수집 및 이용에 대한 안내 <button class="badge-light px-2 py-0 border btn-round" data-toggle="modal" data-target="#privacy_policy">전문보기</button></p>
        </div>
        <div class="col-12 mt-4">
            <button type="submit" class="btn btn-primary btn-block btn-round">회원가입</button>
        </div>
    </div>
</div>
</form>

<div class="modal fade" id="company_terms" tabindex="-1" role="dialog" aria-labelledby="tech_forest_modal_window" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content text-center" style="border-radius:10px">
             <?php include "company_terms.php"; ?>
        </div>
    </div>
</div>

<div class="modal fade" id="privacy_policy" tabindex="-1" role="dialog" aria-labelledby="tech_forest_modal_window" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content text-center" style="border-radius:10px">
             <?php include "privacy_policy.php"; ?>
        </div>
    </div>
</div>
