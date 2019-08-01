<header class="header_pc d-none d-lg-block">
    <div class="container py-0 my-0">
        <nav class="navbar navbar-expand-lg navbar-light m-0 p-0">
            <ul class="navbar-nav ml-auto">
                <?php
                $key = true;
                foreach($oMenu->common->list as $item){
                    echo sprintf('<li class="nav-item xs_content weight_normal %s"><a class="nav-link" href="%s" %s>%s</a></li>',$item["active"],$item["link"],$item["new_window"],$item["title"]);
                    if($key){
                        echo "<li class=\"nav-item xs_content weight_normal\"><a class=\"nav-link xs_content\">|</a></li>";
                        $key = false;
                    }
                }
                ?>
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
                    <?php
                    foreach($oMenu->company->list as $item){
                        echo sprintf('<li class="nav-item px-2 weight_normal %s"><a class="nav-link" href="%s" %s>%s',$item["active"],$item["link"],$item["new_window"],$item["title"]);

                        echo "</a></li>";
                    }
                    ?>
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
                        <h5 class="weight_normal mb-1 mt-2"><?=$logged_info['c_name']?> 님</h5>
                        <h5 class="weight_lighter mt-0">환영합니다.</h5>
                    </div>
                <?php } ?>
            </div>
            </div>
            <div class="btn-group rounded-0 btn-block mt-2">
                <?php
                    foreach($oMenu->common->list as $item){
                        echo sprintf('<a href="%s" %s class="btn btn-primary">%s</a>', $item["link"], $item["new_window"],$item["title"]);
                    }
                ?>
            </div>
        </div>
        <aside class="nav flex-column">
            <?php
            foreach($oMenu->company->list as $item){
                echo sprintf('<a class="nav-link %s" href="%s" %s><i class="%s"></i> %s',$item["active"],$item["link"],$item["new_window"],$item["icon"],$item["title"]);
                echo "</a>";
                if(is_array($item["submenu"])){
                    echo "<ul class=\"nav submenu\">";
                    echo "<li class=\"nav-item\">";
                    foreach($item["submenu"] as $sub_item){
                        echo sprintf("<a class=\"nav-link disabled\" href=\"%s\" %s>- %s</a>",$sub_item["link"], $sub_item["new_window"], $sub_item["title"]);
                    }
                    echo "</li>";
                    echo "</ul>";
                }
            }
            ?>
        </aside>
    </div>
    <div id="page-content-wrapper">
        <nav class="navbar navbar-expand-lg bg-primary">
            <a class="navbar-brand text-white mx-auto" href="<?=getUrl('company')?>">기술자숲</a>
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
