@extend('/layouts/backend', ['title'=>'Articles','subtitle'=>'View all articles'])

<div class="omeletto-box">
    <input type="hidden" id="page_fetch_route" value="/=/articles/fetch">
    <div class="omeletto-box-header">
        <div class="float-left">
            <a href="{{r('cms.articles.create')}}" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Make an article</a>
            <a href="#" onclick="sync()" class="btn btn-primary btn-sm"><i class="fa fa-circle-notch"></i> Refresh</a>
        </div>

        <div class="float-right table-form">
            <select id="page_limit" onchange="sync()">
                <option selected>10</option>
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
                <option value="id" selected>ID</option>
                <option value="title">Title</option>
                <option value="content">Content</option>
                <option value="published">Published</option>
                <option value="date_published">Date published</option>
            </select>

            <select id="page_order" onchange="sync()">
                <option value="DESC" selected>Descending</option>
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