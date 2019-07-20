
<h1>제작중</h1>

<a href="<?=getUrl('company')?>" class="btn btn-block btn-primary">기업용</a>
<a href="<?=getUrl('technician')?>" class="btn btn-block btn-warning">기술자용</a>

<script type="text/javascript">
    console.log("A");
    jQuery(document).ready(function($){
        var params = {};
        params["is_view"] = "Y";

        var ret_obj = exec_json("company.index",params);
        console.log(ret_obj);
    });
</script>