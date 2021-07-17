@extends('master')

@section('title')
    {{$title}}
@endsection

@section('stylesheet')
    <link href="{{ asset('public/css/quill/quill.snow.css')}}" rel="stylesheet">
    <style>
        .ql-toolbar.ql-snow{
            border: 0;
            padding: 0px;

        }
        .ql-toolbar.ql-snow .ql-formats{
            padding: 2px;
            border: 1px solid #d6d6d68a;
            border-radius: 3px;
        }

        .editor{
            margin-top: 10px;
            border: 1px solid #d6d6d68a !important;
            border-radius: 3px;
            height: 300px;
        }

        .modal-input-title{
            height: calc(3rem + 2px);
            border-bottom: 1px solid #babfc7;
            border-top: 0px !important;
            border-left: 0px !important;
            border-right: 0px !important;
            border-radius: 0px !important;
            padding: 0;
            font-size:1.5rem;
        }

        .preview-button{
            text-align: center;
            position: absolute;
            top: -10px;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            width: 100%;
        }

        .hide{
            display: none;
        }
    </style>
@endsection

@section('content')
    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
            <h3 class="content-header-title mb-0">Email Template</h3>
            <div class="row breadcrumbs-top">
        
            </div>
        </div>
        <div class="content-header-right text-md-right col-md-6 col-12">
            <div class="form-group">
                <!--<a class="btn-icon btn btn-secondary btn-round" ><i class="ft-bell"></i> </a>-->
                <a href="#" class="btn-icon btn btn-sm btn-secondary btn-round btn-success add_modal"><i class="fa fa-plus-circle"></i> Create new template</a>
            </div>
        </div>  
    </div>


    <div class="content-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Email Templates List</h4>
                        <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a data-action="collapse"><i class="feather icon-minus"></i></a></li>
                                <li><a data-action="reload"><i class="feather icon-rotate-cw"></i></a></li>
                                <li><a data-action="expand"><i class="feather icon-maximize"></i></a></li>
                                <li><a data-action="close"><i class="feather icon-x"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-content collapse show">

                        <div class="table-responsive">


                            @if(count($templates) > 0)
                            <table class="table mb-0">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Subject</th>
                                        <th>Options</th>
                                    </tr>
                                </thead>
                                <tbody>                                   
                                    @foreach($templates as $template)
                                    <tr>
                                        <td>{{ $template->title }}</td>
                                        <td>{{ $template->subject }}</td>
                                        <td>
                                            <a href="#" class="edit_template" data-id="{{ $template->id }}"><i class="fa fa-fw fa-pencil text-warning"></i></a>
                                            <a href="#" class="view_template" data-id="{{ $template->id }}"><i class="fa fa-fw fa-eye text-primary"></i></a>
                                            <a href="#" class="delete_template" data-id="{{ $template->id }}"><i class="fa fa-fw fa-trash text-danger "></i></a>
                                        </td>
                                    </tr>
                                    @endforeach    
                                </tbody>
                            </table>
                            @else
                            <p class="text-center">No records found!</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade add__modal" role="dialog">
        <div class="modal-dialog modal-lg">

            <div class="modal-content">

                <form action="{{ route('emailtemplate.store') }}" method="POST"> 
                    <div class="modal-header"> 
                        <input type="text" name="title" class="form-control round modal-input-title" value="" required>
                        <button type="button" class="close text-danger" data-dismiss="modal">&times;</button>
                    </div>

                    @csrf
                    <div class="modal-body bg">
                        <div class="preview-button">
                            <button type="button" class="btn btn-primary btn-sm round btn-min-width mr-1 mb-1">Preview</button>
                        </div>
                        <div class="form-body mt-1">
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <fieldset class="form-group">
                                                <label for="subject">Subject</label>
                                                <input type="text" class="form-control" name="subject" required>
                                            </fieldset>
                                        </div>
                                        <div class="col-md-6">
                                            <fieldset class="form-group">
                                                <label for="sender">Sender</label>
                                                <input type="text" name="sender" value="{{ $smtp[0]->from_email ?? ''}}" class="form-control" readonly="readonly">
                                            </fieldset>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <fieldset class="form-group">
                                                <label for="message">Message</label>
                                                
                                                <div id="snow-wrapper">
                                                    <div id="snow-container">
                                                        <div class="editor">
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                            </fieldset>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="row skin skin-flat">
                                                <div class="col-md-6 col-sm-12">
                                                    <fieldset>
                                                        <input type="checkbox" id="input-1" name="word_template">
                                                        <label for="input-1">Include to Word Templates</label>
                                                    </fieldset>
                                                    <fieldset>
                                                        <input type="checkbox" id="input-2" name="attach_invoice">
                                                        <label for="input-2">Attach invoice to the email</label>
                                                    </fieldset>
                                                    <fieldset>
                                                        <input type="checkbox" id="input-3" name="embed_invoice">
                                                        <label for="input-3">Embed invoice within email</label>
                                                    </fieldset>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <h3>Add variable</h3>
                                    <p><i>
                                        <small>Variables are populated with custom information when applied to an invoice.    </small>
                                    </i></p>

                                    <p><i>
                                        <small>Place your cursor in the location where you would like to insert the variable, the <strong>click below to insert</strong></small>
                                    </i></p>

                                    <div class="options">
                                        <button type="button" class="btn btn-outline-secondary btn-sm btn-block" data-variable="customer_name">CUSTOMER NAME <br> <small>[[ customer_name ]]</small></button>
                                        <button type="button" class="btn btn-outline-secondary btn-sm btn-block" data-variable="invoice_number">INVOICE NUMBER <br> <small>[[ invoice_number ]]</small></button>
                                        <button type="button" class="btn btn-outline-secondary btn-sm btn-block" data-variable="signature">SIGNATURE <br> <small>[[ signature ]]</small></button>
                                        <button type="button" class="btn btn-outline-secondary btn-sm btn-block" data-variable="due_date">DUE DATE <br> <small>[[ due_date ]]</small></button>
                                        <button type="button" class="btn btn-outline-secondary btn-sm btn-block" data-variable="invoice_link">INVOICE LINK <br> <small>[[ invoice_link ]]</small></button>
                                        <button type="button" class="btn btn-outline-secondary btn-sm btn-block" data-variable="reminder_number">REMINDER NUMBER <br> <small>[[ reminder_number ]]</small></button>
                                        <button type="button" class="btn btn-outline-secondary btn-sm btn-block" data-variable="invoice_amount">INVOICE AMOUNT <br> <small>[[ invoice_amount ]]</small></button>
                                        <button type="button" class="btn btn-outline-secondary btn-sm btn-block" data-variable="balance_due">BALANCE DUE <br> <small>[[ balance_due ]]</small></button>
                                    </div>

                                    @if(count($words) > 0 || count($words_default) > 0)
                                    <div class="form-group mt-2">
                                        <label>Use word template</label>
                                        <select class="form-control select-word-template">
                                            <option value="">none</option>
                                            @foreach($words as $word)
                                            <option value="{{ $word->id }}" >{{ $word->title }}</option>
                                            @endforeach
                                            @foreach($words_default as $word)
                                            <option value="{{ $word->id }}" >{{ $word->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="template-preview mt-1 hide">
                            
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-outline-success" type="submit"> Save </button>
                        <button type="button" class="btn btn-outline-warning" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script src="{{ asset('public/js/quill/quill.js') }}"></script>
@endsection 
@push('script')
    <script>
         $(document).ready(function () { 
            var toolbarOptions = [
                ['bold', 'italic', 'underline', 'strike'],        // toggled buttons

                [{ 'header': 1 }, { 'header': 2 }],               // custom button values
                [{ 'list': 'ordered'}, { 'list': 'bullet' }, 'blockquote', 'code-block'],

                [{ 'script': 'sub'}, { 'script': 'super' }],      // superscript/subscript

                [{ 'size': ['small', false, 'large', 'huge'] }],  // custom dropdown

                [{ 'header': [1, 2, 3, 4, 5, 6, false] }],

                [{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
                [{ 'font': [] }],

                [{ 'align': [] }],

                ['link', 'image'],

                ['clean']                                         // remove formatting button
            ];

            let quill = new Quill('.editor', {
                modules: {
                    toolbar:{
                        container: toolbarOptions,
                        handlers: {
                            image: imageHandler
                        }
                    }
                },
                    theme: 'snow'
			});
            
            function imageHandler() {
                var range = this.quill.getSelection();
                var value = prompt('What is the image URL');
                if(value){
                    this.quill.insertEmbed(range.index, 'image', value, Quill.sources.USER);
                }
            }

            $(document).on('click', '.add_modal', function() {                
                let add_modal = $('.add__modal');
                let form = add_modal.find('form');
                
                $('.form-body').removeClass('hide');
                $('.template-preview').addClass('hide');
                $('.preview-button button').text('Preview');
                
                
                add_modal.modal();
                form[0].reset();
                quill.root.innerHTML = "";
                form.find('input[name=id]').remove();
                form.attr('action', "{{ route('emailtemplate.store') }}");
                form.find('input[name=title]').val('New Template');
                form.find('input[name=title]').focus();
            });

            $(document).on('click', '.edit_template', async function() {  
                $('.form-body').removeClass('hide');
                $('.template-preview').addClass('hide');
                $('.preview-button button').text('Preview');

                let add_modal = $('.add__modal');
                let form = add_modal.find('form');
                let id = $(this).data().id;
                
                add_modal.modal();
                quill.root.innerHTML = "";
                form[0].reset();
                form.attr('action', "{{ route('emailtemplate.update') }}");
                
                const result = await $.ajax({
                    url: "{{ route('emailtemplate.edit') }}",
                    type: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        id
                    }
                });

                const template = result['data'].template;
                form.find('input[name=id]').remove();
                form.prepend(`<input type="hidden" name="id" value="${template.id}" />`);
                form.find('input[name=title]').val(template.title);
                form.find('input[name=subject]').val(template.subject);
                form.find('input[name=sender]').val(template.sender);
                quill.root.innerHTML = template.body;

                switch(template.attach_invoice){
                    case 0:
                        form.find('input[name=attach_invoice]').prop('checked', false);
                    break;
                    case 1:
                        form.find('input[name=attach_invoice]').prop('checked', true);
                    break;
                }

                switch(template.embed_invoice){
                    case 0:
                        form.find('input[name=embed_invoice]').prop('checked', false);
                    break;
                    case 1:
                        form.find('input[name=embed_invoice]').prop('checked', true);
                    break;
                }

                switch(template.word_template){
                    case 0:
                        form.find('input[name=word_template]').prop('checked', false);
                    break;
                    case 1:
                        form.find('input[name=word_template]').prop('checked', true);
                    break;
                }

                form.find('input[name=title]').focus();

                
                $('.template-preview').html('');

            });

            $(document).on('click', '.view_template', async function() {  
                $('.template-preview').html('');
                $('.form-body').addClass('hide');
                $('.template-preview').removeClass('hide');
                $('.preview-button button').text('Edit');

                let add_modal = $('.add__modal');
                let form = add_modal.find('form');
                let id = $(this).data().id;
                
                add_modal.modal();
                quill.root.innerHTML = "";
                form[0].reset();
                form.attr('action', "{{ route('emailtemplate.update') }}");
                
                const result = await $.ajax({
                    url: "{{ route('emailtemplate.edit') }}",
                    type: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        id
                    }
                });

                const template = result['data'].template;
                form.find('input[name=id]').remove();
                form.prepend(`<input type="hidden" name="id" value="${template.id}" />`);
                form.find('input[name=title]').val(template.title);
                form.find('input[name=subject]').val(template.subject);
                form.find('input[name=sender]').val(template.sender);
                quill.root.innerHTML = template.body;

                switch(template.attach_invoice){
                    case 0:
                        form.find('input[name=attach_invoice]').prop('checked', false);
                    break;
                    case 1:
                        form.find('input[name=attach_invoice]').prop('checked', true);
                    break;
                }

                switch(template.embed_invoice){
                    case 0:
                        form.find('input[name=embed_invoice]').prop('checked', false);
                    break;
                    case 1:
                        form.find('input[name=embed_invoice]').prop('checked', true);
                    break;
                }

                form.find('input[name=title]').focus();

                

                
                $('.template-preview').html('<div class="ql-snow"><div class="ql-editor">'+quill.root.innerHTML+'</div></div>');
            });

            $(document).on('click', '.delete_template', async function() {
                let id = $(this).data().id;

                Swal.fire({
                    text: 'Are you sure you want to delete this template?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!",
                    confirmButtonClass: "btn btn-primary",
                    cancelButtonClass: "btn btn-danger ml-1"
                }).then(async result => {
                    if(result.value){
                        const delete_template = await $.ajax({
                            url: "{{ route('emailtemplate.delete') }}",
                            type: 'POST',
                            data: {
                                _token: "{{ csrf_token() }}",
                                id
                            }
                        });

                        if(delete_template.success){
                            Swal.fire({
                                text: delete_template.msg,
                                type: 'success',
                            }).then(()=>{
                                location.reload();
                            });
                        }
                    }
                });
            });

            $('.options').on('click', 'button', function(){
                quill.focus();
                let data = $(this).data();
                let caretPosition = quill.getSelection(true);
                quill.insertText(caretPosition, '[['+data.variable+']]');
            });
            
            $('.add__modal').on('submit', 'form', function(e){
                e.preventDefault();
                let editor_content = quill.root.innerHTML;

                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: $(this).serialize() + '&body=' + editor_content,
                    success: function(resp){
                        if(resp.success){
                            Swal.fire({
                                text: resp.msg,
                                type: 'success'
                            }).then(() => {
                                location.reload();
                            })
                        }
                    }
                })
            });

            $('.select-word-template').on('change', async function(){

                const id = $(this).val();

                if(id != null && id != ""){
                        const { data } = await $.ajax({
                        url: "{{ route('emailtemplate.edit' )}}",
                        type: 'POST',
                        data: {
                            _token: "{{ csrf_token() }}",
                            id: id
                        }
                    });

                    quill.root.innerHTML = data.template.body;

                
                }else{
                    quill.root.innerHTML = "";
                }
                
                
                
            });
            $(document).on('click','.preview-button button',function(){

                let content = quill.root.innerHTML;

                if($('.form-body').hasClass('hide')){
                    $(this).text('Preview');
                    $('.form-body').removeClass('hide');
                    $('.template-preview').addClass('hide');
                }else{
                    $('.form-body').addClass('hide');
                    $('.template-preview').removeClass('hide');
                    $('.template-preview').html('<div class="ql-snow"><div class="ql-editor">'+content+'</div></div>');
                    $(this).text('Back');
                }
            });

           
         });

        
    </script>
@endpush