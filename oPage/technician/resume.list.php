<?php
$m_idx = $_SESSION['LOGGED_INFO'];

?>

<section class="bg-white d-lg-none">
    <div class="p-3 mt-4 pt-5 mb-0 pb-2">
        <a href="#" onclick="history.back();" class="mb-3"><img src="/oPage/images/imgicons/arrow_left.png" height="25" /></a>
        <h4 class="weight_normal">이력서 등록</h4>
    </div>
</section>
<div class="container pt-4">
    <div class="row mb-4">
        <div class="col-12 col-lg-7 mx-lg-auto mx-0">
            <h6>내 이력서 관리</h6>
            <div class="tech_card bg-white mb-4 shadow">
                <div class="xxs_content py-2 weight_lighter position-relative">
                    <span class="position-absolute weight_normal" style="right:10px; top:7px;">
                        이력서 완성도 <span class="btn btn-round btn-danger btn-xxs py-2 px-2 weight_lighter m-0" style="vertical-align:0px;">낮음</span>
                    </span>
                    <p class="d-block d-lg-none text-left">
                    <i class="xi-clock-o"></i> 최종 수정일 : 2019.07.17
                    </p>
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
                                <img src="/oPage/images/imgicons/write_underline.png" height="50" />
                            </div>
                            <h5>
                                <img src="/oPage/images/imgicons/write_underline.png" height="25" class="d-none d-lg-inline-block" />
                                일반 이력서 <span class="red">작성중</span>
                            </h5>
                            <p class="d-none d-lg-block">
                                최종 수정일 : 2019.07.17
                            </p>
                        </div>
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
        <div class="col-12 col-lg-10 mx-lg-auto mx-0">
            <a href="#" class="d-none d-lg-block pull-right btn btn-primary btn-round py-1 px-3 mr-1"><i class="xi-attachment"></i> 첨부파일 등록</a>
            <!-- <a href="#" class="d-block d-lg-none pull-right btn btn-primary btn-xxs btn-round py-2 px-2 mr-1">더보기+</a> -->
            <h6>첨부파일 관리 <span class="xxs_content px-0">(* 최대 10개 등록 가능)</span></h6>
            <div class="d-none d-lg-block">
                <table class="table table-light table-bordered mt-4" width="100%">
                    <thead class="bg-light text-center">
                        <tr><th>등록일</th><th>파일구분</th><th>파일명</th><th>관리</th></tr>
                    </thead>
                    <tbody>
                        <tr><td>2019.08.14</td><td>[자격증명서]</td><td>전기기사 2급 자격 증명서.png</td><td>
                                <a href="#" class="btn btn-light border rounded btn-sm btn-block">삭제하기</a>
                            </td></tr>
                        <tr><td>2019.08.14</td><td>[자격증명서]</td><td>전기기사 2급 자격 증명서.png</td><td>
                                <a href="#" class="btn btn-light border rounded btn-sm btn-block">삭제하기</a>
                            </td></tr>
                        <tr><td>2019.08.14</td><td>[자격증명서]</td><td>전기기사 2급 자격 증명서.png</td><td>
                                <a href="#" class="btn btn-light border rounded btn-sm btn-block">삭제하기</a>
                            </td></tr>
<!--                        <tr><td>2019.08.14</td><td>[자격증명서]</td><td>전기기사 2급 자격 증명서.png</td><td>-->
<!--                                <a href="#" class="btn btn-light border rounded btn-sm"><i class="xi-trash"></i> 삭제</a>-->
<!--                                <a href="#" class="btn btn-primary border rounded btn-sm"><i class="xi-download"></i> 저장</a>-->
<!--                            </td></tr>-->
                    </tbody>
                </table>
            </div>
            <div class="d-block d-lg-none">
                <div class="tech_card text-left bg-white mb-4">
                    <div class="xxs_content text-left py-2 weight_lighter position-relative">
                        <i class="xi-clock-o"></i> 첨부일 : 2019.07.17
                    </div>
                    <div class="px-2 text-center pb-3">
                        <h6 class="red">자격증명서</h6>
                        <h6>전기기사 2급 자격 증명서.pdf</h6>
                    </div>

                    <button class="btn btn-light btn-block rounded-0 text-secondary">삭제하기</button>
                </div>
                <div class="tech_card text-left bg-white mb-4">
                    <div class="xxs_content text-left py-2 weight_lighter position-relative">
                        <i class="xi-clock-o"></i> 첨부일 : 2019.07.17
                    </div>
                    <div class="px-2 text-center pb-3">
                        <h6 class="red">자격증명서</h6>
                        <h6>전기기사 2급 자격 증명서.pdf</h6>
                    </div>

                    <button class="btn btn-light btn-block rounded-0 text-secondary">삭제하기</button>
                </div>
            </div>
        </div>
    </div>

</div>

<div class="fixed-bottom d-lg-none">
    <a class="btn btn-warning btn-block rounded-0"> <img src="/oPage/images/imgicons/Clip.png" height="16" /> 첨부파일 등록</a>
</div>
