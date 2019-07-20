
<h1>제작중</h1>

<a href="<?=getUrl('company')?>" class="btn btn-block btn-primary">기업용</a>
<a href="<?=getUrl('technician')?>" class="btn btn-block btn-warning">기술자용</a>


<?php

/* ajax 예제
<script type="text/javascript">
    jQuery(document).ready(function($){
        var params = {};
        params["is_view"] = "Y";

        exec_json("company.index",params,function(ret_obj){
            console.log(ret_obj);
        });

    });
</script>
*/
