<!--이것이 사실 모달창이었다는 사실을 알게되면서 쓰지않게됨.-->
<style>
    body{background:#FFF;}
</style>
<section class="bg-white">
    <div class="p-3 mt-4 pt-5 mb-0 pb-2">
        <a href="#" onclick="history.back();" class="mb-3"><img src="/oPage/images/imgicons/arrow_left.png" height="25" /></a>
        <h4 class="weight_normal">결제수단 선택</h4>
    </div>
    <div class="content_padding">
    <form>
        <div class="custom-control custom-radio border rounded content_padding mb-3 pl-5 bigger_control">
            <input type="radio" id="customRadio1" name="customRadio" class="custom-control-input">
            <label class="custom-control-label weight_lighter" for="customRadio1">
                <i class="ml-3 xi-credit-card xi-2x" style="vertical-align: -7px;"></i>
                신용카드・체크카드
            </label>
        </div>
        <div class="custom-control custom-radio border rounded content_padding mb-3 pl-5 bigger_control">
            <input type="radio" id="customRadio2" name="customRadio" class="custom-control-input">
            <label class="custom-control-label weight_lighter" for="customRadio2">
                <i class="ml-3 xi-bank xi-2x" style="vertical-align: -7px;"></i>
                무통장 입금
            </label>
        </div>
        <input type="button" class="btn btn-block btn-warning" value="결제하기" />
    </form>
    </div>
</section>


<?php
$footer_false = true;
?>