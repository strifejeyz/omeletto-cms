<?php extend('/layouts/backend', [
    'title' => 'Make an article',
    'subtitle' => 'Create and publish an article.',
    'scripts' => <<<EOF
        <script src="/assets/plugins/tinymce/tinymce.min.js"></script>
        <script>
            tinymce.init({
              selector: 'textarea#editor',
              height: 400,
              menubar: true,
              plugins: [
                'advlist autolink lists link image charmap print preview anchor',
                'searchreplace visualblocks code fullscreen',
                'insertdatetime media table paste code help wordcount'
              ],
              toolbar: 'undo redo | formatselect | ' +
              ' bold italic backcolor | alignleft aligncenter ' +
              ' alignright alignjustify | bullist numlist outdent indent |' +
              ' removeformat | help',
              content_css: [
                '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
                '//www.tiny.cloud/css/codepen.min.css'
              ]
            });
        </script>
EOF
]); ?>

{!Form::open(r('cms.articles.store'))!}

<div class="row">
    <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">
        <!-- form start -->
        <div role="form" class="border bg-white">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group{{!empty(form_error('title'))?' has-error':''}}">
                            <label>Title *</label>
                            {!Form::text('title',null,['class'=>'form-control'])!}
                            <i class="text-danger">{{form_error('title')}}</i>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group{{!empty(form_error('keywords'))?' has-error':''}}">
                                    <label>Keywords</label>
                                    {!Form::textarea('keywords',null,['class'=>'form-control'])!}
                                    <i class="text-danger">{{form_error('keywords')}}</i>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group{{!empty(form_error('description'))?' has-error':''}}">
                                    <label>Description</label>
                                    {!Form::textarea('description',null,['class'=>'form-control'])!}
                                    <i class="text-danger">{{form_error('description')}}</i>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group{{!empty(form_error('tags'))?' has-error':''}}">
                                    <label>Tags</label>
                                    {!Form::textarea('tags',null,['class'=>'form-control'])!}
                                    <i class="text-danger">{{form_error('tags')}}</i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!--row-->

                <div class="form-group{{!empty(form_error('content'))?' has-error':''}}">
                    <label>Content</label>
                    {!Form::textarea('content',null,['class'=>'form-control','id'=>'editor'])!}
                    <i class="text-danger">{{form_error('content')}}</i>
                </div>

            </div><!--card-body-->
            <div class="card-footer">
                <button type="submit" class="btn btn-lg btn-primary float-left">Save and Publish</button>
                <div class="float-right">{!getflash('message')!}</div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12"></div>
</div>
<br>
<br>
<br>
{!Form::close()!}


@stop()