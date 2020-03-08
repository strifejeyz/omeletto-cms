@extend('/layouts/backend', ['title'=>'Media Library','subtitle'=>'List of all Files'])

<div class="omeletto-box">
    <input type="hidden" id="page_fetch_route" value="/=/media-library/fetch">
    <div class="omeletto-box-header">
        <div class="float-left">
            <a href="{{r('cms.media.upload')}}" class="btn btn-primary btn-sm float-left"><i class="fa fa-upload"></i> Upload a file</a> &nbsp;&nbsp;
            <a href="#" onclick="sync()" class="btn btn-success btn-sm"><i class="fa fa-circle-notch"></i> Refresh</a>
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
                <option value="name">File Name</option>
                <option value="extension">Extension</option>
                <option value="type">Type</option>
            </select>

            <select id="page_order" onchange="sync()">
                <option value="DESC">Descending</option>
                <option value="ASC">Ascending</option>
            </select>

            <input type="search" onkeypress="sync()" placeholder="Search..." id="page_query">

            <button onclick="sync()">
                <i class="fa fa-search"></i>
            </button>
        </div>
        <div class="clearfix"></div>
    </div>

    <div id="data_container"></div>
</div>


@stop()