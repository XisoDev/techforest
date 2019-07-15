<div class="container-fluid welcome_seciton">
    <div class="container">
    <div class="row">
        <div class="col">
        <h4 class="weight_lighter">안녕하세요</h4>
        <h4 class="weight_bold mb-3">기술자숲 채용담당자님:)</h4>
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link btn btn-warning btn-round btn-xs" href="#">로그인</a>
            </li>
            <li class="nav-item">
                <!--            blank--> &nbsp;
            </li>
            <li class="nav-item">
                <a class="nav-link btn btn-danger btn-round btn-xs" href="#"">회원가입</a>
            </li>
        </ul>
        </div>
    </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-12">
            <h5 class="weight_lighter mt-3">진행중인 <span class="red">채용공고가 0건</span> 이네요!</h5>
            <div class="flex-card-slick">
                <?php for($i=1; $i<=3; $i++){ ?>
                    <div class="tech_card">
                        <i class="xi-plus-circle xi-2x color_primary"></i>
                        <p class="weight_lighter mt-2">공고등록하고<br />맞춤기술자 보기</p>
                    </div>
                <?php } ?>
            </div>
        </div>

        <div class="col-12">
            <h5 class="weight_lighter mt-3">
                <span class="btn btn-round btn-xxs btn-primary">NEW</span>
                새로운 기술자가 등록됐어요!
            </h5>
            <div class="flex-card-slick">
                <?php for($i=1; $i<=4; $i++){ ?>
                    <div class="tech_card bg-white">
                        <div class="thumbnail">
                            <img src="<?=$tpath?>/assets/images/no_avatar.png" />
                        </div>
                        <p class="weight_lighter mt-2">공고등록하고<br />맞춤기술자 보기</p>
                    </div>
                <?php } ?>
            </div>
        </div>
</div>