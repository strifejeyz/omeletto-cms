@extend('/layouts/backend', ['title'=>'Create an account'])

{!Form::open('/=/users/store')!}

<div class="row">
    <div class="col-md-8 col-xs-12 col-sm-12 col-lg-8">
        <!-- form start -->
        <div role="form" class="omeletto-box">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group{{!empty(form_error('firstname'))?' has-error':''}}">
                            <label>First Name *</label>
                            {!Form::text('firstname',null,['class'=>'form-control'])!}
                            <i class="text-danger">{{form_error('firstname')}}</i>
                        </div>

                        <div class="form-group{{!empty(form_error('lastname'))?' has-error':''}}">
                            <label>Last Name *</label>
                            {!Form::text('lastname',null,['class'=>'form-control'])!}
                            <i class="text-danger">{{form_error('lastname')}}</i>
                        </div>

                        <div class="form-group{{!empty(form_error('email'))?' has-error':''}}">
                            <label>E-mail *</label>
                            {!Form::email('email',null,['class'=>'form-control'])!}
                            <i class="text-danger">{{form_error('email')}}</i>
                        </div>

                        <div class="form-group{{!empty(form_error('phone_number'))?' has-error':''}}">
                            <label>Phone Number</label>
                            {!Form::text('phone_number',null,['class'=>'form-control'])!}
                            <i class="text-danger">{{form_error('phone_number')}}</i>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group{{!empty(form_error('role'))?' has-error':''}}">
                            <label>Role *</label>
                            {!Form::select('role',null,['' => '-----','admin' =>
                            'Admin','standard'=>'Standard'],['class'=>'form-control'])!}
                            <i class="text-danger">{{form_error('role')}}</i>
                        </div>

                        <div class="form-group{{!empty(form_error('username'))?' has-error':''}}">
                            <label>Username *</label>
                            {!Form::text('username',null,['class'=>'form-control'])!}
                            <i class="text-danger">{{form_error('username')}}</i>
                        </div>

                        <div class="form-group{{!empty(form_error('password'))?' has-error':''}}">
                            <label>Password *</label>
                            {!Form::password('password',null,['class'=>'form-control'])!}
                            <i class="text-danger">{{form_error('password')}}</i>
                        </div>

                        <div class="form-groupform-group{{!empty(form_error('confirm_password'))?' has-error':''}}">
                            <label>Confirm Password *</label>
                            {!Form::password('confirm_password',null,['class'=>'form-control'])!}
                            <i class="text-danger">{{form_error('confirm_password')}}</i>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-lg btn-primary float-left"><i class="fa fa-users"></i> Submit</button>
                <div class="float-right">{!getflash('message')!}</div>
                <div class="clearfix"></div>

            </div><!--card-body-->

        </div>
    </div>
    <div class="col-md-4 col-xs-12 col-sm-12 col-lg-4"></div>
</div>

{!Form::close()!}


@stop()