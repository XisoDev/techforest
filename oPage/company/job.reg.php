<section class="bg-white">
    <div class="content_padding mt-4 pt-5">
        <a href="#" onclick="history.back();"><i class="xi-arrow-left xi-2x"></i></a>
        <h5 class="weight_normal">공고등록</h5>
    </div>
    <ul class="nav nav-tabs nav-justified mt-0 pt-0 mb-5 mx-0 px-0" role="tablist">
        <li class="nav-item active">
            <a class="nav-link weight_bold" href="<?=getUrl('company','job_register')?>">
                1단계<br />기업정보 등록
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link weight_bold" href="<?=getUrl('company','job_appRegister')?>" >
                2단계<br />공고등록
            </a>
        </li>
    </ul>
    <div class="content_padding mt-0 pt-0">
        <div class="row">
            <div class="col-5 mx-auto px-auto">
                <div class="position-relative">
                    <div class="avatar square mb-2" style="background-image:url('/layout/none/assets/images/no_company.png');">
                    </div>
                    <i class="xi-camera position-absolute text-white" style="right:0;bottom:0; font-size:28px;"></i>
                    <i class="xi-camera position-absolute text-secondary" style="right:1px;bottom:1px; font-size:26px;"></i>
                </div>
            </div>
        </div>

        <form action="" method="post">
<!--            성공하면 자동으로 2단계로 보낼수있음.-->
            <input type="hidden" name="success_return_url" value="<?=getUrl('company','job_appRegister')?>" />
            <div class="container">
                <div class="row">
                    <div class="col-12 mt-3 mx-0 px-0">
                        <h6>기업정보</h6>
                    </div>
                    <div class="col-12 mx-0 px-0 mb-2">
                        <input type="text" class="form-control" placeholder="회사명" required>
                    </div>
                    <div class="col-12 mx-0 px-0 mb-2">
                        <input type="text" class="form-control" placeholder="사업자등록번호" required>
                    </div>
                    <div class="col-12 mt-3 mx-0 px-0">
                        <h6>위치정보</h6>
                    </div>
                    <div class="col-12 mx-0 px-0 mb-2">
                        <div class="input-group mb-2">
                            <input type="text" class="form-control" placeholder="주소검색" required>
                            <a href="#" class="btn btn-primary rounded-0">검색</a>
                        </div>
                        <input type="text" class="form-control" placeholder="상세주소" required>
                    </div>

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

                    <div class="col-12 mx-0 px-0 pl-1 mb-2">
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

                    <div class="col-12 text-left mt-0 mx-0 px-0 mt-4">
                        <h6>회사 간단소개</h6>
                        <textarea class="form-control"></textarea>
                    </div>

                    <div class="col-6 mt-4 px-0 mx-0 pr-1">
                        <button type="submit" class="btn border-primary btn-block btn-round">임시저장</button>
                    </div>
                    <div class="col-6 mt-4 px-0 mx-0 pl-1">
                        <button type="submit" class="btn btn-primary btn-block btn-round">등록완료</button>
                    </div>

                </div>
            </div>
        </form>
    </div>


</section>

<?php
$footer_false = true;
?>