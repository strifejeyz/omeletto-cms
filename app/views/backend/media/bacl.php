@extend('/layouts/backend', ['title'=>'Media Library','subtitle'=>'List of all Files'])
@import(App\Models\User)

<div class="omeletto-box">
    <div class="card-header">
        <a href="{{r('cms.media.upload')}}" class="btn btn-primary btn-sm float-left"><i class="fa fa-upload"></i> Upload a file</a>
        <form action="{{r('cms.media.search')}}" class="float-right">
            <input type="search" name="search" placeholder="Search...">
            <button><i class="fa fa-search"></i></button>
        </form>
        <div class="clearfix"></div>
    </div>
    <div class="card-body p-0">
        <table class="table table-sm table-dark">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Type</th>
                <th>Size</th>
                <th>Upload Date</th>
                <th>Uploaded by</th>
                <th>Actions</th>
            </tr>

            {foreach $media as $file}
            <?php $uploaded_by = User::find($file->user_id); ?>
            <tr>
                <td>{{$file->id}}</td>
                <td>{{$file->name}}</td>
                <td>{{$file->extension}}</td>
                <td>{{to_megabytes($file->size)}}Mb</td>
                <td>{{date('F j, Y', $file->created)}}</td>
                <td>{{$uploaded_by->firstname}} {{$uploaded_by->lastname}}</td>
                <td>
                    <button class="btn btn-xs btn-warning" onclick='prompt("Hard link for [{{$file->name}}]", "{{BASE_URL}}assets/media/{{$file->name}}")'>Hard link</button> |
                    <a class="btn btn-xs btn-info" href="{{r('cms.media.download')}}/{{$file->id}}">Download</a>
                </td>
            </tr>
            {endforeach}
        </table>
    </div>
</div>


@stop()