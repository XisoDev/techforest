<section class="bg-white">
    <div class="content_padding mt-4 pt-5 mb-0 pb-2">
        <a href="#" onclick="history.back();"><i class="xi-arrow-left xi-2x"></i></a>
        <h5 class="weight_normal">이력서 등록</h5>
    </div>
</section>
<div class="content_padding">
    <h6>내 이력서 관리</h6>
    <div class="tech_card text-left bg-white mb-4">
        <div class="xxs_content text-left py-2 weight_lighter position-relative">
            <span class="position-absolute weight_normal" style="right:10px; top:2px;">
                이력서 완성도 <span class="btn btn-round btn-danger btn-xxs py-2 weight_lighter">낮음</span>
            </span>
            <i class="xi-clock-o"></i> 최종 수정일 : 2019.07.17
        </div>
        <div class="content_padding text-center">
            <i class="xi-documents-o xi-3x"></i>
            <h6>일반 이력서 <span class="red">작성중</span></h6>
        </div>

        <div class="row m-0 p-0 pt-0 mt-0">
            <div class="col-6 mx-0 px-0 border-right">
                <a href="<?=getUrl('technician','resume',1)?>" target="_blank" class="btn btn-light btn-block rounded-0">전체보기</a>
            </div>
            <div class="col-6 mx-0 px-0">
                <a href="<?=getUrl('technician','resumeWrite')?>" class="btn btn-light btn-block rounded-0">수정하기</a>
            </div>
        </div>
    </div>


    <a href="#" class="pull-right btn btn-primary btn-xxs btn-round py-2 px-2 mr-1">더보기+</a>
    <h6>첨부파일 관리 <span class="xxs_content">(* 최대 10개 등록 가능)</span></h6>
    <div class="tech_card text-left bg-white mb-4">
        <div class="xxs_content text-left py-2 weight_lighter position-relative">
            <i class="xi-clock-o"></i> 첨부일 : 2019.07.17
        </div>
        <div class="content_padding text-center">
            <h6 class="red">자격증명서</h6>
            <h6>전기기사 2급 자격 증명서.pdf</h6>
        </div>

        <button class="btn btn-light btn-block rounded-0">삭제하기</button>
    </div>
    <div class="tech_card text-left bg-white mb-4">
        <div class="xxs_content text-left py-2 weight_lighter position-relative">
            <i class="xi-clock-o"></i> 첨부일 : 2019.07.17
        </div>
        <div class="content_padding text-center">
            <h6 class="red">자격증명서</h6>
            <h6>전기기사 2급 자격 증명서.pdf</h6>
        </div>

        <button class="btn btn-light btn-block rounded-0">삭제하기</button>
    </div>
</div>

<div class="fixed-bottom">
    <a class="btn btn-warning btn-block rounded-0"><i class="xi-attachment"></i>첨부파일 등록</a>
</div>