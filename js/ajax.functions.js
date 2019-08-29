//ajax function 

function ajax(obj = '', method = '', url = '', res = '') {
    $.ajax({
        url: url,
        method: method,
        data: obj,
        success: function (resp) {
            $(res).html(resp);
        }
    })
}