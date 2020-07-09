$(document).ready(function(){
    var page = $('meta[name="page"]').attr('content');
});
function stoppedForm(form) {
    $('.' + form).submit(function(e)
    {
        e.preventDefault();
        t=$(this);
        $.confirm({
            title: '',
            theme: 'supervan',
            content: 'Do you want to delete?',
            buttons: {
                Yes: {
                    btnClass: 'btn-primary',
                    action: function () {
                        $.when().then(function(){
                            $(t).off("submit").submit()
                        })
                    }
                },
                No: {
                    btnClass: 'btn-danger',
                },
            }
        });
    });
}
var searchTimer2; var deleteTimerShowInfo;
function showInfo(order_id) {
    deleteTimerShowInfo = true;
    clearTimeout(searchTimer2);
    function showInfo2(order_id)
    {
        $.ajax({
            cache: false,
            url: '../ajax/getInfo.php',
            data: {order_id:order_id},
            dataType:'JSON',
            method:'POST',
            success:function (response)
            {
                if (response)
                {
                    var html = '<p><b>Name and surname:</b> ' + response['name'] + ' ' + response['surname'] + '</p>';
                    html += '<p><b>Customer mail:</b> ' + response['customerMail'] + '</p>';
                }
                $('.infoDivShow-'+order_id).html(html);
                showInfoDiv(order_id, 1);
            }
        });
    }
    searchTimer2 = setTimeout(function () {
        if (deleteTimerShowInfo)
            showInfo2(order_id);
    }, 600);
}
function showInfoDiv(order_id, type) {
    deleteTimerShowInfo = type == 1 ? true : false;
    var allDivs = $('.infoAll');
    var oneDiv = $('.infoDivShow-' + order_id);
    type == 1 ? oneDiv.css('display', 'block') : allDivs.css('display', 'none');
}
function alertMsg(msg) {
    $.confirm({
        title: '',
        theme: 'supervan',
        content: msg,
        buttons: {
            OK: {
                btnClass: 'btn-primary',
            }
        }
    });
}
function generateQueryParameters() {
    var page     = $('meta[name="page"]').attr('content');

    var query = 'page=' + page;
    window.history.replaceState({query : query}, '', '?'+query);
}