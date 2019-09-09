<?
$magazine_list = $output->get('magazine_list');
?>
<style media="screen">

</style>
<section class="bg-white d-lg-none">
    <div class="p-3 mt-4 pt-5 mb-0 pb-2">
        <a href="#" onclick="history.back();" class="mb-3"><img src="/oPage/images/imgicons/arrow_left.png" height="25" /></a>
        <h4 class="weight_normal">취업정보</h4>
    </div>
</section>
<div class="container pt-3 pt-lg-5 mt-lg-3">
    <div class="d-block d-lg-none">
        <span class="xxs_content pull-right">전체 <?=count($magazine_list)?></span>
        <h6>취업정보 살펴보기</h6>
    </div>
    <div class="d-none d-lg-block">
        <span class="xs_content btn btn-xs btn-round border-secondary pull-right">전체 <?=count($magazine_list)?></span>
        <h4 class="mb-4">취업정보 살펴보기</h4>
    </div>


    <div class="row">
      <?php foreach ($magazine_list as $key => $val) {?>
        <div class="col-12 col-md-6 col-lg-4 mb-4">
          <div class="magazine tech_card mb-3 bg-white text-left shadow">
              <div class="row">
                  <div class="thumbnail mx-0 px-0 col-5 py-0 col-md-12" style="background-image:url('https://gsjsoop.com/TF/admin/thumbnail_img/<?=$val['image']?>'); min-height:130px;">
                  </div>
                  <div class="col-7 pl-0 col-md-12 px-md-2">
                      <div class="py-3 px-3">
                          <h6 class="red" style="float:left;">[<?=$val['category']?>]</h6>
                          <p class="xxs_content text-secondary my-0 px-0 pt-1" style="float:right;"><?=substr($val['reg_date'],0,10)?></p>
                          <h6 class="weight_normal py-1 cut1" style="clear:both;"><?=$val['title']?></h6>
                      </div>
                      <a class="btn btn-block btn-danger rounded-0" href="<?=$val['link']?>" target="_blank">자세히 보기</a>
                  </div>
              </div>
          </div>
        </div>
      <?}?>

    </div>

<!-- <div class="row">
  <div class="col-12 col-md-6 col-lg-4 mb-4">
    <div class="magazine tech_card mb-3 bg-white text-left shadow">
        <div class="row">
            <div class="col-5 pr-0 col-md-12" style="background-color:#EEE; min-height:170px;">

            </div>
            <div class="col-7 pl-0 col-md-12 px-md-2">
                <div class="py-2 px-3">
                    <h6 class="red">[취업정보]</h6>
                    <h6 class="weight_normal">2019년 7월 전국...</h6>
                    <p class="xs_content px-0">
                        발빠르게 찾아온 7월 전국 취업 박람회! 놓치지 않도록 미리미리 ...
                    </p>
                    <p class="xxs_content text-secondary my-0 py-0 px-0">2019.05.30</p>
                </div>
                <a class="btn btn-block btn-danger rounded-0" href="">자세히 보기</a>
            </div>
        </div>
    </div>
  </div>
</div> -->

<!--    롤백에서 복원-->
    <!-- <div class="search_box col-sm-10 col-md-8 col-lg-6 mx-sm-auto">
        <div class="input-group">
            <div class="input-group-prepend">
                <select class="form-control">
                    <option value="">전체</option>
                    <option value="">제목 + 내용</option>
                </select>
            </div>
            <input type="text" class="form-control" />
            <input type="submit" class="rounded-0 btn btn-primary btn-sm rounded-right" value="검색" />
        </div>
    </div> -->

    <div class="page_navigation text-center pt-3 pb-5">
        <a class="px-1 text-secondary" href="#"><i class="xi-angle-left"></i></a>
        <a class="px-1 text-dark weight_bold" href="#">1</a>
        <!-- <a class="px-1 text-secondary" href="#">2</a>
        <a class="px-1 text-secondary" href="#">3</a>
        <a class="px-1 text-secondary" href="#">4</a>
        <a class="px-1 text-secondary" href="#">5</a> -->
        <a class="px-1 text-secondary" href="#"><i class="xi-angle-right"></i></a>
    </div>

</div>


<?php
$footer_false = true;
?>
