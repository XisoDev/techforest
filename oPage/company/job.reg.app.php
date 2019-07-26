<?php
date_default_timezone_set('Asia/Seoul');
$now_date = date(YmdHis);

$c_idx = $_SESSION['c_idx'];

//이전공고 불러오기
$oDB->where("c_idx",$c_idx);
$oDB->where("job_end_date",$now_date,"<");
$row = $oDB->get("TF_hire_tb");

//직종리스트
$oDB->orderBy("o_idx","ASC");
$oDB->where("o_idx","1","!=");
$oDB->where("o_is_show","Y");
$occupation_row = $oDB->get("TF_occupation",null,"o_idx,o_name,o_is_show");

//직무리스트
$oDB->orderBy("duty_name","ASC");
$oDB->orderBy("o_idx","ASC");
$duty_row = $oDB->get("TF_duty");
?>

<section class="bg-white">
    <div class="content_padding mt-4 pt-5">
        <a href="#" onclick="history.back();"><i class="xi-arrow-left xi-2x"></i></a>
        <h5 class="weight_normal">공고등록</h5>
    </div>
    <ul class="nav nav-tabs nav-justified mt-0 pt-0 mb-5 mx-0 px-0" role="tablist">
        <li class="nav-item">
            <a class="nav-link weight_bold" href="<?=getUrl('company','job_register')?>">
                1단계<br />기업정보 등록
            </a>
        </li>
        <li class="nav-item active">
            <a class="nav-link weight_bold" href="<?=getUrl('company','job_appRegister')?>" >
                2단계<br />공고등록
            </a>
        </li>
    </ul>
    <div class="content_padding mt-0 pt-0">
        <form action="" method="post">
            <div class="container">
                <div class="row">
                    <div class="col-12 mx-0 px-0 mb-2">
                        <select class="form-control">
                            <option value="">이전 채용공고 불러오기</option>
                              <?php foreach($row as $val){ ?>
                                <option value="<?=$val['h_idx']?>">[마감] <?=$val['h_title']?></option>
                              <?php } ?>
                        </select>
                    </div>
                    <div class="col-12 mt-3 mx-0 px-0">
                        <h6>공고제목</h6>
                    </div>
                    <div class="col-12 mx-0 px-0 mb-2">
                        <input type="text" class="form-control" placeholder="공고제목" required>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="customCheck2">
                            <label class="custom-control-label xs_content" for="customCheck2">단기일자리 (3개월이내)</label>
                        </div>
                    </div>

                    <div class="col-12 mt-3 mx-0 px-0">
                        <h6>직종</h6>
                    </div>
                    <div class="col-12 mx-0 px-0 mb-2">
                        <select class="form-control" onchange="occupation(this)">
                          <?php foreach($occupation_row as $val){
                              echo "<option value=\"" . $val["o_idx"] . "\">" . $val["o_name"] . "</option>";
                           } ?>
                        </select>
                    </div>

                    <div class="col-12 mt-3 mx-0 px-0">
                        <h6>직무</h6>
                    </div>
                    <div class="col-12 mx-0 px-0 mb-2">
                        <select class="form-control" id="select_duty">
                            <option value="">현장관리직</option>
                        </select>
                    </div>

                    <div class="col-12 mt-3 mx-0 px-0">
                        <h6>직무 상세내용</h6>
                    </div>
                    <div class="col-12 mx-0 px-0 mb-2">
                        <textarea class="form-control"></textarea>
                    </div>

                    <div class="col-12 mt-3 mx-0 px-0">
                        <h6 class="pull-left pt-1">필요자격증</h6>
                        <a href="#" onclick="" class="btn btn-primary btn-xs ml-2">추가하기</a>
                    </div>


                    <div class="col-12 mt-3 mx-0 px-0">
                        <h6>급여</h6>
                    </div>
                    <div class="col-12 mx-0 px-0 mb-2">
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="customRadioInline1" name="customRadioInline1" checked="checked" class="custom-control-input">
                            <label class="custom-control-label" for="customRadioInline1">연봉</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="customRadioInline2" name="customRadioInline1" class="custom-control-input">
                            <label class="custom-control-label" for="customRadioInline2">월급</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="customRadioInline3" name="customRadioInline1" class="custom-control-input">
                            <label class="custom-control-label" for="customRadioInline3">일급</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="customRadioInline4" name="customRadioInline1" class="custom-control-input">
                            <label class="custom-control-label" for="customRadioInline4">시급</label>
                        </div>
                    </div>


                    <div class="col-12 mt-3 mx-0 px-0">
                        <h6>신입/경력</h6>
                    </div>
                    <div class="col-12 mx-0 px-0 mb-2">
                        <select class="form-control">
                            <option value="">무관</option>
                        </select>
                    </div>

                    <div class="col-12 mt-3 mx-0 px-0">
                        <h6>근무지역</h6>
                    </div>
                    <div class="col-12 mx-0 px-0 pl-1 mb-2">
                        <div class="input-group">
                            <select class="form-control">
                                <option value="0" selected="selected">경남</option>
                            </select>
                            <select class="form-control">
                                <option value="0" selected="selected">김해시</option>
                            </select>
                            <!-- <select class="form-control">
                                <option value="0" selected="selected">삼안동</option>
                            </select> -->
                        </div>
                    </div>

                    <div class="col-12 mt-3 mx-0 px-0">
                        <h6>공고시작</h6>
                    </div>
                    <div class="col-6 mx-0 px-0 mb-2 pr-1 position-relative">
                        <input type="text" class="form-control xiso_date" />
                        <i class="xi-calendar-check right-icon"></i>
                    </div>
                    <!-- <div class="col-6 mx-0 px-0 mb-2 pl-1 position-relative">
                        <select class="form-control">
                            <option value="0" selected="selected">오전 8시</option>
                        </select>
                    </div> -->

                    <div class="col-12 mt-3 mx-0 px-0">
                        <h6>공고종료</h6>
                    </div>
                    <div class="col-6 mx-0 px-0 mb-2 pr-1 position-relative">
                        <input type="text" class="form-control xiso_date" />
                        <i class="xi-calendar-check right-icon"></i>
                    </div>
                    <!-- <div class="col-6 mx-0 px-0 mb-2 pl-1 position-relative">
                        <select class="form-control">
                            <option value="0" selected="selected">오후 10시 30분</option>
                        </select>
                    </div> -->

                    <div class="col-12 mt-3 mx-0 px-0">
                        <h6>기타정보</h6>
                    </div>
                    <div class="col-12 mx-0 px-0 mb-2">
                        <textarea class="form-control"></textarea>
                    </div>

<!--                    담당자정보-->
                    <div class="col-12 mt-3 mx-0 px-0">
                        <h6>담당자 정보</h6>
                    </div>
                    <div class="col-12 mx-0 px-0 pl-1 mb-2">
                        <div class="input-group">
                            <select class="form-control">
                                <option value="010" selected="selected">010</option>
                                <option value="011">011</option>
                                <option value="017">017</option>
                                <option value="051">051</option>
                            </select>
                            <div class="input-group-prepend">
                                <span class="input-group-text">-</span>
                            </div>
                            <input type="text" class="form-control" placeholder="0000">
                            <div class="input-group-prepend">
                                <span class="input-group-text">-</span>
                            </div>
                            <input type="text" class="form-control" placeholder="0000">
                        </div>
                    </div>
                    <div class="col-12 mx-0 px-0 mb-2">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="이메일 주소 입력">

                            <div class="input-group-prepend">
                            <span class="input-group-text">
                                @
                            </span>
                            </div>
                            <select class="form-control" onchange="if(this.value == 99){jQuery(this).hide(); jQuery(this).next().show();}">
                                <option value="" selected="selected">메일 호스트 선택</option>
                                <option value="1">naver.com</option>
                                <option value="2">gmail.com</option>
                                <option value="99">직접입력</option>
                            </select>
                            <input type="text" class="form-control" placeholder="직접입력" style="display:none;">
                        </div>

                    </div>


                    <div class="col-12 mt-3 mx-0 px-0">
                        <h6>사업자등록번호</h6>
                    </div>
                    <div class="col-12 mx-0 px-0 mb-2">
                        <input type="text" class="form-control" placeholder="871-81-00755" readonly="readonly" />
                    </div>

                    <!-- <div class="col-12 text-left mt-0 mx-0 px-0 mt-4">
                        <h6>회사 간단소개</h6>
                        <textarea class="form-control"></textarea>
                    </div> -->

                    <div class="col-6 mt-4 px-0 mx-0 pr-1">
                        <button type="submit" class="btn border-primary btn-block btn-round">임시저장</button>
                    </div>
<!--                    <div class="col-6 mt-4 px-0 mx-0 pl-1">-->
<!--                        <button type="submit" class="btn btn-primary btn-block btn-round">등록완료</button>-->
<!--                    </div>-->
<!--                    submit 대신 일단 등록완료 화면으로 보냄-->
                    <div class="col-6 mt-4 px-0 mx-0 pl-1">
                        <a href="<?=getUrl('company','job_appRegisterComplete')?>" class="btn btn-primary btn-block btn-round">등록완료</a>
                    </div>

                </div>
            </div>
        </form>
    </div>
</section>

<script type="text/javascript">
var duty_arr = <? echo json_encode($duty_row); ?>;

function occupation(obj){
  $("#select_duty").empty();

  for(var i = 0; i < duty_arr.length; i++){
    if(obj.value == duty_arr[i]["o_idx"]){
      var option = $('<option value="' +duty_arr[i]["duty_name"]+ '">' +duty_arr[i]["duty_name"]+ '</option>');
      $("#select_duty").append(option);
    }
  }
}

</script>

<?php
$footer_false = true;
?>
