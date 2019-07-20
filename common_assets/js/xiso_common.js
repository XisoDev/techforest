
Number.prototype.number_format = function(round_decimal) {
    return this.toFixed(round_decimal).replace(/(\d)(?=(\d{3})+$)/g, "$1,");
};

/**
 * @brief exec_json (exec_xml와 같은 용도)
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

        $.extend(data,{module:action[0],act:action[1],xiso_token:_xiso_token});
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
                    $("#preloader").hide().trigger('cancel_confirm');
                    // console.log(ret_obj);
                    if(ret_obj.error != '0') {
                        alert(ret_obj.message);
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
