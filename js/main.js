$(document).ready(function(){
    var page = $('meta[name="page"]').attr('content');
    $('#test').on('submit', function (e) {
        e.preventDefault();
        var data = getNamesAndValues('test');
        data['_token'] = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            cache       : false,
            method      : 'POST',
            url         : '../ajax/test.php',
            dataType    : 'JSON',
            data        : data,
            success: function(response)
            {
                console.log(response);
            }
        });
    });
});
function crreateTable(table) {
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
/**
 * Table styling
 * @param table
 */
function styleDatatables(table) {
    $('select[name="'+table+'_length"]').addClass('form-control').css({'margin-left' : '10px', 'margin-right' : '10px'});
    $('#'+table+'_info').addClass('alert').addClass('alert-primary');
    $('#'+table+'_filter label').css('font-weight', '700').addClass('d-flex align-items-center');
    $('#'+table+'_filter label input').attr('Placeholder', 'Enter something...');
    $('input[type="search"]').addClass('form-control');
    $('#'+table+'_length label').addClass('d-flex justify-content-center align-items-center')
    $('#'+table+'_wrapper').addClass('mt-4')
}
/**
 * Turning the loader on and off
 * @param on
 */
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
/**
 * Stop form and display message
 * @param form
 */
function stoppedForm(form) {
    $(form).submit(function(e)
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
/**
 * Display a stylized message
 * @param msg
 */
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
/**
 * Creating query parameters
 */
function getNamesAndValues(idForm) {
    let data = [];
    document.querySelectorAll('#' + idForm).forEach(f => {
        let obj = {};
        let checkbox = [];
        let checkboxLaterName = '';
        f.querySelectorAll("input,select,textarea").forEach(ele => obj[ele.name] = null);
        data.push(obj)
        data = data[0];
        obj = {};
        checkbox = [];
        f.querySelectorAll("input,select,textarea").forEach(function (e) {
            if (e.type == 'checkbox') {
                if (e.checked){
                    if (checkboxLaterName !== e.name) {
                        checkbox = [];
                        checkboxLaterName = e.name;
                    }
                    checkbox.push(e.value)
                    data[e.name] = checkbox;
                }
            } else if (e.type == 'radio') {
                if (e.checked) {
                    data[e.name] = e.value;
                }
            }
            else {
                data[e.name] = e.value
            }
        });

    });
    return data;
}