$(document).ready(function(){
    var page = $('meta[name="page"]').attr('content');
});
function crreateTable(table)
{
    loaderFunction();
    $('#'+table).DataTable({
        "processing": false,
        "serverSide": true,
        "bSortCellsTop": true,
        "autoWidth": false,
        "bPaginate": true,
        "pageLength": 10,
        language: {
            paginate: {
                next: '<a class="page-link">Next</a>',
                previous: '<a class="page-link"  tabindex="-1">Previous</a>',
            }
        },
        'ajax': {
            method: "POST",
            dataType: 'JSON',
            url: './ajax/getNews.php',
        },
        "fnDrawCallback": function () {
            $('#'+table).removeClass('dataTable').addClass('table-dark');
            styleDatatables(table);
            loaderFunction(false);
        },
        "columns": [
            {"data": "id"},
            {"data": "title"},
            {"data": "content"},
            {"data": "slug"},
            {"data": "link"},
            {"data": "lang"},
            {"data": "visibility"},
            {"data": "created_at"},
        ]
    });
}
function styleDatatables(table) {
    $('select[name="'+table+'_length"]').addClass('form-control').css({'margin-left' : '10px', 'margin-right' : '10px'});
    $('#'+table+'_info').addClass('alert').addClass('alert-primary');
    $('#'+table+'_filter label').css('font-weight', '700').addClass('d-flex align-items-center');
    $('#'+table+'_filter label input').attr('Placeholder', 'Enter something...');
    $('input[type="search"]').addClass('form-control');
    $('#'+table+'_length label').addClass('d-flex justify-content-center align-items-center')
    $('#'+table+'_wrapper').addClass('mt-4')
}
function loaderFunction(on = true) {
    if ($('#container-main').length === 0) {
        var loader = '<div id="container-main"><div class="loader"></div><p>Please wait!</p></div>';
        $('body').prepend(loader);
    }
    if (on) {
        $('#container-main').css('display', 'flex');
        $('body').css('overflow', 'hidden');
    } else {
        $('#container-main').css('display', 'none');
        $('body').css('overflow', 'unset');
    }
}
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