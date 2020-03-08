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
    let resource_order = $('#resource_order').val();
    let resource_limit = $('#resource_limit').val();
    let resource_query = $('#resource_query').val();
    let base_route_url = $('#base_route_url').val();
    let data_container = $('#data_container');

    if (resource_query == '')
        resource_query = '__EMPTY__';

    if (resource_order == null)
        resource_order = 'DESC';
    if (resource_limit == null)
        resource_limit = 10;

    let resource_route = base_route_url + resource_limit + '/' + resource_order + '/' + resource_query;

    localStorage.setItem('resource_order', resource_order);
    localStorage.setItem('resource_limit', resource_limit);

    $.ajax(resource_route, {
        success: function (data, status, xhr) {
            data_container.html(data);
            $('#table').DataTable({
                stateSave: true
            });
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