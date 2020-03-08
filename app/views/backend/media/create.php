@extend('/layouts/backend', ['title'=>'Upload a file'])

{!Form::open(r('cms.media.store'),['enctype'=>'multipart/form-data'])!}

<div class="row">
    <div class="col-md-6">
        <div class="form-group{{!(form_error('file'))?' has-error':''}}">
            Choose your file(s) to upload
            <br>you may upload multiple files totalling 20MB(Megabytes)<br><br>
            <input type="file" id="file_upload" name="file_upload[]" required="required"
                   accept=".doc,.docx,.pdf,.png,.jpg,.jpeg,.bmp,.gif,.zip,.rar,.bz,.txt,.pptx,.xlsx" multiple="multiple">
            <i class="text-danger">{{form_error('file')}}</i>

            <button class="btn btn-sm btn-primary">Upload...</button>

            <br>{!getflash('message')!}
        </div>
    </div>
</div>



{!Form::close()!}

@stop()