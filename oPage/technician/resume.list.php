<?php

//이력서완성도(경력 개수)
$count_career_row = $output->get('count_career_row');
//이력서완성도(경력 직무상세내용 개수)
$count_c_content_row = $output->get('count_c_content_row');
//이력서완성도(기본정보+희망4종 입력 여부)
$count_myinfo_row = $output->get('count_myinfo_row');
//이력서 정보
$myinfo_row = $output->get('myinfo_row');
//파일 리스트
$file_list = $output->get('file_list');

?>

<section class="bg-white d-lg-none">
    <div class="p-3 mt-4 pt-5 mb-0 pb-2">
        <a href="#" onclick="history.back();" class="mb-3"><img src="/oPage/images/imgicons/arrow_left.png" height="25" /></a>
        <h4 class="weight_normal">이력서 등록</h4>
    </div>
</section>
<div class="container pt-4">
    <div class="row mb-4">
        <div class="col-12 col-sm-10 col-md-9 col-lg-8 mx-md-auto mx-0 pt-md-4">
            <h5>내 이력서 관리</h5>
            <div class="tech_card bg-white mb-4 shadow-sm mx-md-5">
                <div class="xxs_content py-3 weight_lighter position-relative">
                    <span class="position-absolute weight_normal" style="right:10px; top:7px;">
                        이력서 완성도
                        <span class="btn btn-round btn-danger btn-xxs py-2 px-2 weight_lighter m-0" style="vertical-align:0px;">
                          <?php if($count_career_row[0]['count_career'] == $count_c_content_row[0]['count_c_content'] && $count_myinfo_row[0]['count_myinfo']){
                            echo '높음';
                          }else if($count_career_row[0]['count_career'] > $count_c_content_row[0]['count_c_content'] && $count_myinfo_row[0]['count_myinfo']){
                            echo '중간';
                          }else{
                            echo '낮음';
                          }
                          ?>
                        </span>
                    </span>

                </div>
                <div class="px-2">
                    <div class="row">
                        <div class="d-none d-lg-block col-lg-1"></div>
                        <div class="d-none d-lg-block col-lg-3 pb-lg-3">
                            <div class="avatar square" style="background-image:url('/layout/none/assets/images/no_avatar.png');"></div>
                        </div>
                        <div class="d-none d-lg-block col-lg-1"></div>
                        <div class="col-12 col-lg-7 text-center text-lg-left pt-lg-3">
                            <div class="d-block d-lg-none text-center">
                                <img src="/oPage/images/imgicons/attachment_gray.png" height="40" />
                            </div>
                            <h5 class="p-0 m-0">
                                <img src="/oPage/images/imgicons/attachment_gray.png" height="25" class="d-none d-lg-inline-block pt-0" />
                                일반 이력서 <span class="red">작성중</span>
                            </h5>
                            <p class="d-none d-lg-block">
                                최종 수정일 : <?=substr($myinfo_row[0]['edit_date'],0,10)?>
                            </p>
                        </div>
                        <p class="d-block d-lg-none" style="margin:5px auto;">
                        <i class="xi-clock-o"></i> 최종 수정일 : <?=substr($myinfo_row[0]['edit_date'],0,10)?>
                        </p>
                    </div>

                </div>

                <div class="row m-0 p-0 pt-0 mt-0">
                    <div class="col-6 mx-0 px-0 border-right">
                        <a href="<?=getUrl('technician','resume',$m_idx)?>" target="_blank" class="btn btn-light text-secondary btn-block rounded-0">전체보기</a>
                    </div>
                    <div class="col-6 mx-0 px-0">
                        <a href="<?=getUrl('technician','resumeWrite')?>" class="btn btn-light btn-block rounded-0 red">수정하기</a>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="row mb-4">
        <div class="col-12 col-sm-10 col-md-9 col-lg-8 mx-lg-auto mx-0 pt-md-4">
            <button class="d-none d-lg-block pull-right btn btn-primary btn-round py-1 px-3 mr-1" data-toggle="modal" data-target="#fileUpload"><i class="xi-attachment"></i> 첨부파일 등록</button>
            <!-- <a href="#" class="d-block d-lg-none pull-right btn btn-primary btn-xxs btn-round py-2 px-2 mr-1">더보기+</a> -->
            <h5>첨부파일 관리 <span class="xxs_content px-0">(* 최대 10개 등록 가능)</span></h5>
            <div class="d-none d-lg-block">
                <table class="table table-light table-bordered mt-4" width="100%">
                    <thead class="bg-light">
                        <tr><th class="weight_bold">등록일</th><th class="weight_bold">파일구분</th><th class="weight_bold">파일명</th><th class="weight_bold">관리</th></tr>
                    </thead>
                    <tbody>
                      <?foreach ($file_list as $val) {?>
                        <tr>
                          <td>
                            <?=substr($val['reg_date'],0,10)?>
                          </td>
                          <td>
                            [<?=$val['file_type']?>]
                          </td>
                          <td>
                            <?=$val['file_name']?>
                          </td>
                          <td>
                            <button class="btn btn-light border rounded btn-sm btn-block" onclick="file_delete('<?=$val['reg_date']?>','<?=$val['file_name']?>');">삭제하기</button>
                          </td>
                        </tr>
                      <?}?>

<!--                        <tr><td>2019.08.14</td><td>[자격증명서]</td><td>전기기사 2급 자격 증명서.png</td><td>-->
<!--                                <a href="#" class="btn btn-light border rounded btn-sm"><i class="xi-trash"></i> 삭제</a>-->
<!--                                <a href="#" class="btn btn-primary border rounded btn-sm"><i class="xi-download"></i> 저장</a>-->
<!--                            </td></tr>-->
                    </tbody>
                </table>
            </div>

            <div class="d-block d-lg-none">
              <?foreach ($file_list as $val2) {?>
                <div class="tech_card text-left bg-white mb-4">
                    <div class="xxs_content text-left py-2 weight_lighter position-relative">
                        <i class="xi-clock-o"></i> 첨부일 : <?=substr($val['reg_date'],0,10)?>
                    </div>
                    <div class="px-2 text-center pb-3">
                        <h6 class="red">[<?=$val2['file_type']?>]</h6>
                        <h6><?=$val['file_name']?></h6>
                    </div>

                    <button class="btn btn-light btn-block rounded-0 text-secondary" onclick="file_delete('<?=$val['reg_date']?>','<?=$val['file_name']?>');">삭제하기</button>
                </div>
              <? } ?>
            </div>
        </div>
    </div>
</div>

<div class="fixed-bottom d-lg-none">
    <button class="btn btn-warning btn-block rounded-0 py-2" data-toggle="modal" data-target="#fileUpload">
        <img src="/oPage/images/imgicons/Clip.png" height="16" /> 첨부파일 등록
    </button>
</div>

<div class="modal fade" id="fileUpload" tabindex="-1" role="dialog" aria-labelledby="tech_forest_modal_window" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content text-center" style="border-radius:10px" id="file_modal">
            <a href="#" class="text-white pull-right text-right" style="margin-top:-40px;" onclick="jQuery('#fileUpload').modal('hide');" ><i class="xi-close xi-2x"></i></a>

					<form id="theuploadform">

							<div class="mt-4 mb-3">
								<h5 class="weight_bold pb-3">관련 서류 등록</h5>
								구분
								<select class="red border-danger" style="background:white" name="fileUpload_select">
									<option value="이력서">이력서</option>
									<option value="자기소개서">자기소개서</option>
									<option value="학력증명서">학력증명서</option>
									<option value="경력증명서">경력증명서</option>
									<option value="자격증">자격증</option>
									<option value="어학">어학</option>
								</select>
							</div>
							<div class="mt-4 mb-3">
								<input type="file" id="userfile" name="userfile" value="">
							</div>

						<div class="row px-3 py-3">
								<div class="col-sm-2"></div>
								<div class="col-6 col-sm-4">
									<input type="submit" id="formsubmit" class="btn btn-block btn-danger btn-round mt-3" value="저장" />
								</div>
								<div class="col-6 col-sm-4">
									<input type="button" class="btn btn-block border-danger text-danger btn-round mt-3" onclick="jQuery('#fileUpload').modal('hide');" value="취소" />
								</div>
						</div>
					</form>
					<div id="textarea"></div>
        </div>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function(){
  $("#formsubmit").click(function () {
  var iframe = $('<iframe name="postiframe" id="postiframe" width=0 height=0 style="display:none"></iframe>');

  $("#file_modal").append(iframe);

  var form = $('#theuploadform');
  form.attr("action", "/proc.php?act=technician.procFileUpload");
  form.attr("method", "post");

  form.attr("encoding", "multipart/form-data");
  form.attr("enctype", "multipart/form-data");

  form.attr("target", "postiframe");
  form.attr("file", $('#userfile').val());
  form.submit();

  $("#postiframe").on('load',function () {
      alert("파일이 업로드 되었습니다.");
      $('#fileUpload').modal('hide');
      location.reload();
  });

  return false;

  });
});

function file_delete(date,name){

  var params = {
    "file_name" : name,
    "reg_date" : date
  }

  exec_json("technician.FileDelete",params,function(ret_obj){
    toastr.success(ret_obj.message);
    location.reload();
  });
}
</script>
