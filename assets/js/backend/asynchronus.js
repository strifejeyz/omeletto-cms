/*
 * This xhr is meant for any page in Backend
 * at least a page that uses this should have
 * the 5 elements with IDs as follows:
 *  #resource_order (contain either DESC/ASC)
 *  #resource_limit (offset limit e.g. 10-20)
 *  #resource_query (has the search criteria)
 *  #base_route_url (contains the full route)
 *  #data_container (will contain the output)
 */

let sync = function ()
{
    let parameters = {
        limit:     $('#page_limit').val(),
        sort_by:   $('#page_sort_by').val(),
        order:     $('#page_order').val(),
        query:     $('#page_query').val(),
        fetchURL:  $('#page_fetch_route').val(),
        container: $('#data_container')
    }
    localStorage.setItem('page_order', parameters.order);
    localStorage.setItem('page_limit', parameters.limit);
    localStorage.setItem('page_sort_by', parameters.sort_by);

    $.ajax(parameters.fetchURL, {
        type: 'POST',
        data: {
            limit: parameters.limit,
            sort_by: parameters.sort_by,
            order: parameters.order,
            query: parameters.query
        },
        success: function (data) {
            parameters.container.html(data);
            $('#table').DataTable({
                stateSave: true
            });
        },
        error: function (xhr, status, error) {
            console.log(error);
        }
    });
}


/*
 * This will toggle between 2 data.
 * e.g. Yes to No | 1 to 0 | etc
 * it only needs an ID, most helpful
 * for publish, show/hide, yes/no
 */

let toggle = function (resource_route)
{
    $.ajax(resource_route, {
        success: function (data, status, xhr) {
            if (data == 1) {
                return sync();
            } else {
                return alert("An error occured.");
            }
        }
    });
}


/*
 * Set things up upon first load
 * to make sure sorting orders and such
 * are reflected to the container.
 * */
window.onload = function () {

    if (localStorage.getItem('page_order') !== 'null') {
        $('#page_order').val(localStorage.getItem('page_order'))
    }
    if (localStorage.getItem('page_limit') !== 'null') {
        $('#page_limit').val(localStorage.getItem('page_limit'))
    }
    if (localStorage.getItem('page_sort_by') !== 'null') {
        $('#page_sort_by').val(localStorage.getItem('page_sort_by'));

        let select = document.getElementById('page_sort_by');
        let counts = 0;
        for (let i = 0; i < select.children.length; i++) {
            if (select.children[i].value == localStorage.getItem('page_sort_by')) {
                counts++;
                break;
            }
        }
        if (counts > 0) {
            $('#page_sort_by').val(localStorage.getItem('page_sort_by'));
        } else {
            $('#page_sort_by').val('id');
        }
    }
    sync();
}