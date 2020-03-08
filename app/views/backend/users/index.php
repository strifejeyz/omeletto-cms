@extend('/layouts/backend', ['title'=>'Users','subtitle'=>'List of all Users'])

<div class="omeletto-box">
    <input type="hidden" id="page_fetch_route" value="/=/users/fetch">
    <div class="omeletto-box-header">
        <div class="float-left">
            <a href="{{r('cms.users.create')}}" class="btn btn-success btn-sm"><i class="fa fa-plus-circle"></i> Add a user</a>
            <a href="#" onclick="sync()" class="btn btn-primary btn-sm"><i class="fa fa-circle-notch"></i> Refresh</a>
        </div>

        <div class="float-right table-form">
            <select id="page_limit" onchange="sync()">
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

            <select id="page_sort_by" onchange="sync()">
                <option value="id">ID</option>
                <option value="firstname">First Name</option>
                <option value="lastname">Last Name</option>
                <option value="email">E-mail</option>
                <option value="phone_number">Phone Number</option>
                <option value="username">Username</option>
                <option value="role">Role</option>
                <option value="active">Active</option>
            </select>

            <select id="page_order" onchange="sync()">
                <option value="DESC">Descending</option>
                <option value="ASC">Ascending</option>
            </select>

            <input type="search" onkeyup="sync()" placeholder="Search..." id="page_query">

            <button onclick="sync()">
                <i class="fa fa-search"></i>
            </button>
        </div>
        <div class="clearfix"></div>
    </div>

    <div id="data_container"></div>
</div>

@stop()