<header class="header_pc d-none d-lg-block">
    <div class="container py-0 my-0">
        <nav class="navbar navbar-expand-lg navbar-light m-0 p-0">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item xs_content weight_normal"><a class="nav-link" href="#">내 정보 관리</a></li>
                <li class="nav-item xs_content weight_normal"><a class="nav-link xs_content">|</a></li>
                <li class="nav-item xs_content weight_normal"><a class="nav-link" href="#">로그아웃</a></li>
                <li class="nav-item xs_content active weight_normal"><a class="nav-link" href="#"><i class="xi-bell"></i></a></li>
            </ul>
        </nav>
    </div>
    <hr class="p-0 m-0" />
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="navbar-brand" href="#"><img src="/oPage/images/logo.png" height="40" /></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item px-2 active"><a class="nav-link" href="#">공고등록</a></li>
                    <li class="nav-item px-2 weight_normal"><a class="nav-link" href="#">공고・지원자관리</a></li>
                    <li class="nav-item px-2 weight_normal"><a class="nav-link" href="#">기술자숲 소개</a></li>
                    <li class="nav-item px-2 weight_normal"><a class="nav-link" href="#">서비스 이용현황</a></li>
                    <li class="nav-item px-2 weight_normal"><a class="nav-link" href="#">문의</a></li>
                </ul>
            </div>
        </nav>
    </div>
</header>
<header id="header_mobile" class="d-lg-none">
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
                        <div class="avatar square" style="background-image:url('/layout/none/assets/images/no_avatar.png');"></div>
                    </div>
                    <div class="col-8">
                        <h5 class="weight_normal mb-1 mt-2"><?=$logged_info['m_name']?> 님</h5>
                        <h5 class="weight_lighter mt-0">환영합니다.</h5>
                    </div>
                <?php } ?>
            </div>
            </div>
            <div class="btn-group rounded-0 btn-block mt-2">
                <?php if($logged_info) { ?>
                    <a href="<?=getUrl('member')?>" class="btn btn-primary">내 정보 관리</a>
                    <a href="/proc.php?act=member.procLogout" class="btn btn-primary">로그아웃</a>
                <?php }else{ ?>
                    <a href="<?=getUrl('member','login',false,array('cur' => $current_url))?>" class="btn btn-primary">로그인</a>
                    <a href="#" class="btn btn-primary">회원가입</a>
                <?php } ?>
            </div>
        </div>
        <aside class="nav flex-column">
            <a class="nav-link active" href="<?=getUrl('company','job_register')?>"><i class="xi-pen-o"></i> 공고등록</a>
            <a class="nav-link" href="<?=getUrl('company','job')?>"><i class="xi-documents-o"></i> 공고 지원자관리</a>
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
        <nav class="navbar navbar-expand-lg bg-primary">
            <a class="navbar-brand text-white mx-auto" href="#">기술자숲</a>
        </nav>
        <button type="button" class="hamburger animated fadeInLeft is-closed" data-toggle="offcanvas">
            <span class="hamb-top"></span>
            <span class="hamb-middle"></span>
            <span class="hamb-bottom"></span>
        </button>
        <?php if($logged_info) { ?>
        <a href="<?=getUrl('ncenter')?>" class="toggle_alert">
            <i class="xi-bell-o"></i>
            <span class="badge bg-red">9</span>
        </a>
        <?php } ?>
    </div>
</header>
