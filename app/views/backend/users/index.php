@extend('/layouts/backend', ['title'=>'Users','subtitle'=>'List of all Users'])

<div class="omeletto-box">
    <input type="hidden" id="base_route_url" value="/=/users/fetch/">
    <div class="omeletto-box-header">
        <div class="float-left">
            <a href="{{r('cms.users.create')}}" class="btn btn-success btn-sm"><i class="fa fa-plus-circle"></i> Add a user</a>
            <a href="#" onclick="sync()" class="btn btn-primary btn-sm"><i class="fa fa-circle-notch"></i> Refresh</a>
        </div>

        <div class="float-right table-form">

            <select id="resource_limit" onchange="sync()">
                <option>10</option>
                <option>20</option>
                <option>30</option>
                <option>40</option>
                <option>50</option>
                <option>60</option>
                <option>70</option>
                <option>80</option>
                <option>90</option>
                <option>100</option>
                <option>All</option>
                <option>Custom</option>
            </select>

            <select id="resource_order" onchange="sync()">
                <option value="DESC">Descending</option>
                <option value="ASC">Ascending</option>
            </select>

            <input type="search" onkeypress="sync()" placeholder="Search..." id="resource_query">

            <button onclick="sync()">
                <i class="fa fa-search"></i>
            </button>
        </div>
        <div class="clearfix"></div>
    </div>

    <div id="data_container"></div>
</div>

@stop()