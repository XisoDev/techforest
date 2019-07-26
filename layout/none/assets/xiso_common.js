/**
 * @brief php의 number_format 옮김
 * by xiso
 */
Number.prototype.number_format = function(round_decimal) {
    return this.toFixed(round_decimal).replace(/(\d)(?=(\d{3})+$)/g, "$1,");
};

/**
 * @brief 부트스트랩용 datepicker 한글버전
 * by xiso
 */
;(function($){
    $.fn.datepicker.dates['kr'] = {
        days: ["일요일", "월요일", "화요일", "수요일", "목요일", "금요일", "토요일", "일요일"],
        daysShort: ["일", "월", "화", "수", "목", "금", "토", "일"],
        daysMin: ["일", "월", "화", "수", "목", "금", "토", "일"],
        months: ["1월", "2월", "3월", "4월", "5월", "6월", "7월", "8월", "9월", "10월", "11월", "12월"],
        monthsShort: ["1월", "2월", "3월", "4월", "5월", "6월", "7월", "8월", "9월", "10월", "11월", "12월"]
    };
}(jQuery));

jQuery(document).ready(function($){
    /**
     * @brief 카운팅애니메이션 정의
     * by xiso
     */
    $(".auto_counter").each(function(){
        var counter = parseInt($(this).attr('data-counter'));
        var counter_format = counter.number_format();
        var running_time = parseInt($(this).attr('data-duration'));
        var obj_id = $(this).attr("id");
        $({counter: 0}).animate({counter: counter}, {
            duration: running_time,
            easing:'easeOutSine',
            step: function() {
                console.log(Math.ceil(this.counter).number_format());
                $("#" + obj_id).html(Math.ceil(this.counter).number_format());
            },
            complete: function() {
                setTimeout(function(){
                    $("#" + obj_id).html(counter_format);
                    console.log('complete');
                },800);
            }
        });
    });

    $('.xiso_date').datepicker({
        calendarWeeks: false,
        todayHighlight: true,
        autoclose: true,
        format: "yyyy-mm-dd",
        language: "kr",
        showMonthAfterYear:true
    });
});


/**
 * @brief exec_json (ajax용)
 * by xiso
 **/
$.exec_json = window.exec_json = function(action, data, callback_sucess, callback_error){
    if(typeof(data) == 'undefined' || data == false) data = {};

    action = action.split('.');

    if(action.length == 2) {
        // The cover can be disturbing if it consistently blinks (because ajax call usually takes very short time). So make it invisible for the 1st 0.5 sec and then make it visible.
        var timeoutId = $("#preloader").data('timeout_id');

        if(timeoutId) clearTimeout(timeoutId);

        $("#preloader").show();
        $("#preloader").data('timeout_id', setTimeout(function(){
            $("#preloader").css('opacity', '');
        }, 1000));

        $.extend(data,{module:action[0],act:action[1]});
        try {
            $.ajax({
                type: "POST",
                dataType: "json",
                url: "/api.php",
                cache: false,
                contentType: "application/json",
                data: $.param(data),
                // data: data,
                success: function(ret_obj) {
                    // console.log(ret_obj);
                    if(ret_obj.error != '0') {
                        toastr.options = {
                            "progressBar" : true,
                            "timeOut" : 5000,
                            "positionClass" : "toast-bottom-right"
                        }
                        toastr.error(ret_obj.message);
                        if($.isFunction(callback_error)) callback_error(ret_obj);

                        return false;
                    }else{
                        if($.isFunction(callback_sucess)) callback_sucess(ret_obj);

                        return false;
                    }
                },
                error: function(xhr, textStatus) {
                    $("#preloader").hide();

                    var msg = '';

                    if (textStatus == 'parsererror') {
                        msg  = 'The result is not valid JSON :\n-------------------------------------\n';

                        if(xhr.responseText === "") return;

                        msg += xhr.responseText.replace(/<[^>]+>/g, '');
                    } else {
                        msg = textStatus;
                    }

                    try{
                        console.log(msg);
                    } catch(ee){}
                }
            });
        } catch(e) {
            alert(e);
            return;
        }
    }
};
