<header id="header" class="">
    <div class="overlay" data-toggle="offcanvas" style="display: none;"></div>
    <div id="sidebar-wrapper">
        <div class="sidebar-card">
            <div class="content_padding">
            <div class="row">
                <?php if(!$logged_info) { ?>
                <div class="col-12">
                    <h5 class="weight_normal mb-1 mt-2">로그인 해 주세요 :)</h5>
                </div>
                <?php } ?>

                <?php if($logged_info) { ?>
                    <div class="col-4">
                        <div class="avatar square" style="background-image:url('<?=$tpath?>/assets/images/no_avatar.png');"></div>
                    </div>
                    <div class="col-8">
                        <h5 class="weight_normal mb-1 mt-2"><?=$logged_info->user_name?> 님</h5>
                        <h5 class="weight_lighter mt-0">환영합니다.</h5>
                    </div>
                <?php } ?>
            </div>
            </div>
            <div class="btn-group rounded-0 btn-block mt-2">
                <?php if($logged_info) { ?>
                    <a href="#" class="btn btn-primary">내 정보 관리</a>
                    <a href="/proc.php?act=member.procLogout" class="btn btn-primary">로그아웃</a>
                <?php }else{ ?>
                    <a href="<?=getUrl('member','login',false,array('cur' => $current_url))?>" class="btn btn-primary">로그인</a>
                    <a href="#" class="btn btn-primary">회원가입</a>
                <?php } ?>
            </div>
        </div>
        <aside class="nav flex-column">
            <a class="nav-link active" href="#"><i class="xi-pen-o"></i> 공고등록</a>
            <a class="nav-link" href="#"><i class="xi-documents-o"></i> 공고 지원자관리</a>
            <a class="nav-link" href="#"><i class="xi-documents-o"></i> 공고 지원자관리</a>
                <ul class="nav submenu">
                    <li class="nav-item">
                        <a class="nav-link disabled" href="#">- 공고등록</a>
                    </li>
                </ul>
            <a class="nav-link" href="#"><i class="xi-documents-o"></i> 공고 지원자관리</a>
        </aside>
    </div>
    <div id="page-content-wrapper">
        <nav class="navbar navbar-expand-lg bg-warning">
            <a class="navbar-brand text-primary mx-auto" href="#">기술자숲</a>
        </nav>
        <button type="button" class="hamburger animated fadeInLeft is-closed" data-toggle="offcanvas">
            <span class="hamb-top"></span>
            <span class="hamb-middle"></span>
            <span class="hamb-bottom"></span>
        </button>
        <?php if($logged_info) { ?>
        <button type="button" class="toggle_alert">
            <i class="xi-bell-o"></i>
            <span class="badge bg-red">9</span>
        </button>
        <?php } ?>
    </div>
</header>