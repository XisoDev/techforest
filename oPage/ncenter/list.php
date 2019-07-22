<div class="container">
    <div class="content_padding px-0">
        <a href="#" onclick="history.back();"><i class="xi-arrow-left xi-2x"></i></a>
        <h5 class="pull-right pt-2"><a href="<?=getUrl('member','settingAlert')?>">설정 <i class="xi-cog"></i></a></h5>
        <h5 class="weight_normal">알림센터</h5>
    </div>
    <div class="col-12 mt-2">
        <?php for($i=1; $i<=5; $i++){ ?>
        <div class="alert_card">
            <a href="#" class="btn btn-block btn-danger mt-0 rounded-0"><i class="xi-volume-mute"></i> 알림 도착</a>
            <div class="content_padding pt-2 pb-2">
                <div>
                    <span class="btn btn-danger btn-xxs btn-round">오늘</span>
                    <span class="pull-right xxs_content"><i class="xi-clock-o"></i> 오전 11:30</span>
                </div>
                <div class="mt-2">
                <p class="my-0 py-0 xs_content weight_bold">구민지 님</p>
                <p class="my-0 py-0 xs_content"><span class="red">사진이력서 등록</span>이 완료되었습니다.</p>
                </div>
                <a href="#" class="mt-2 btn btn-block btn-light">자세히 보기</a>
            </div>
        </div>
        <?php } ?>
    </div>
</div>

<div class="fixed-bottom pb-2 bg-light content_padding pt-3">
    <span class="btn-round btn btn-warning btn-xxs mb-2">주의사항</span>
    <p class="xs_content content_padding py-0">알림메세지는 7일동안 보관되며 확인 여부와 상관없이 리스트엣 자동으로 삭제됩니다.</p>
</div>
<div style="height:120px;">&nbsp;</div>