@extends('master')

@section('title')
    {{$title}}
@endsection

@section('stylesheet')
<link rel="stylesheet" href="{{asset('public/css/wizard.css')}}">
<link href="{{ asset('public/css/quill/quill.snow.css')}}" rel="stylesheet">
<style>

    .card-schedule{
        border-left: 6px solid #5ecd9d;
    }
    .card-schedule .card-header{
        background: #e6e9e6;
        padding: 1rem 1.5rem !important;
    }
    .card-schedule .card-header{
        display: flex;
        flex-direction: row;
        justify-content: flex-start;
        vertical-align: middle;
    }
    .card-schedule .card-header div{
        margin-right: 1rem;
    }
    .card-schedule .card-header div .input-days{
        width: 40px;
        text-align: center;
        padding: 3px 0;
        border-radius: 3px;
        border: 0;
    }
    .card-schedule .card-header div .select-condition{
        width: 80px;
        padding: 3px 2px;
        border-radius: 3px;
        border: 0;
    }
    .card-schedule .card-header div.delete{
        flex: 1;
        text-align: right;
    }

    .card-schedule .card-header .card-counter{
        background: #808682;
        position: absolute;
        left: -48px;
        top: 0;
        color: white;
        padding: 16px;
        font-size: 1.2rem;
        font-weight: 600;
        border-radius: 5px 0 0 5px;
    }
</style>
@endsection

@section('content')
<section id="number-tabs">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Add email schedules</h4>
                </div>
                <div class="card-content collapse show">
                    <div class="card-body">
                        <form action="{{ route('emailschedules.store') }}" class="number-tab-steps wizard-circle" redirect="{{ route('emailschedules.index') }}">
                            <input type="hidden" name="invoice_ids" value="{{ $invoice_ids }}">
                            @csrf
                            <!-- Step 1 -->
                            <h6>Choose template from the template list</h6>
                            <fieldset>
                                <div class="row template-list" data-edit-template-route="{{ route('emailtemplate.edit') }}">
                                    <div class="col-md-12">
                                        <ul class="list-group">
                                            @if(count($templates) > 0)
                                            @php $counter = 0; @endphp
                                                @foreach($templates as $template)
                                                @php $counter++; @endphp
                                                <li class="list-group-item">
                                                    <span class="float-left">
                                                        <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" data-id="{{ $template->id }}" id="checkbox_invoice_{{ $counter }}">
                                                            <label class="custom-control-label" for="checkbox_invoice_{{ $counter }}"></label>
                                                        </div>
                                                    </span>
                                                    {{ $template->title }}
                                                </li>
                                                @endforeach   
                                            @else
                                            <p class="text-center">No records found!</p>
                                            @endif
                                        </ul>
                                        <div class="message-box"></div>
                                    </div>
                                </div>
                            </fieldset>

                            <!-- Step 2 -->
                            <h6>Choose when each template is emailed</h6>
                            <fieldset>
                                
                                <div class="schedules-box">
                                    
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card card-schedule">
                                                <div class="card-header">
                                                    <div class="card-counter">1</div>
                                                    <div>
                                                        <span>Send Email</span>
                                                    </div>
                                                    <div>
                                                        <input type="text" class="input-days" value="5">
                                                    </div>
                                                    <div>
                                                        <span>Days</span>
                                                    </div>
                                                    <div>
                                                        <select class="select-condition" name="condition">
                                                            <option value="before">before</option>
                                                            <option value="after">after</option>
                                                        </select>
                                                    </div>
                                                    <div>
                                                        <span>invoice is due </span>
                                                    </div>
                                                    <div class="delete-schedule">
                                                        <a href="#" ><i class="fa fa-trash"></i></a>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <div class="template-preview">
                                                        <strong>Preview</strong><hr>
                                                        <div class="ql-snow">
                                                            <div class="ql-editor">
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </fieldset>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('script')
    <script src="{{ asset('public/js/wizard-steps.js') }}"></script>

    <script>
        function removeScheduleTemplate(id){
            $(`[data-template-id=${id}]`).fadeOut().remove();
            
        }
    </script>
@endsection