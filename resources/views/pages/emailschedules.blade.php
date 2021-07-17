@extends('master')

@section('title')
    {{$title}}
@endsection

@section('stylesheet')
<link rel="stylesheet" type="text/css" href="{{asset('public/css/datatables.min.css')}}">
<link href="{{ asset('public/css/quill/quill.snow.css')}}" rel="stylesheet">
    <style>
        .hide{
            display: none;
        }


        .card-schedule .card-header{
                background: #ccc;
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
    </style>
@endsection

@section('content')
    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
            <h3 class="content-header-title mb-0">Email Schedules</h3>
            <div class="row breadcrumbs-top">
        
            </div>
        </div>
    </div>


    <section id="html5">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Schedules List</h4>
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
                        <div class="card-body card-dashboard pt-0">
                            <div class="row">
                                <div class="col-md-12">
                                    @if(count($schedules) > 0)
                                        <table class="table table-bordered table-striped" id="datatable">
                                            <thead>
                                                <tr>
                                                    <th>Template</th>
                                                    <th>Invoice</th>
                                                    <th>Due Date</th>
                                                    <th>Schedule</th>
                                                    <th>Status</th>
                                                    <th>Options</th>
                                                </tr>
                                            </thead>
                                            <tbody>                                   
                                                @foreach($schedules as $schedule)
                                                @php 
                                                    $title = App\EmailTemplate::find($schedule->template_id)->title;
                                                    $invoice = DB::table('inv_settings')->first()->inv_name.$schedule->invoice_id;
                                                    $due = App\Invoice::find($schedule->invoice_id)->due_date;
                                                @endphp
                                                <tr>
                                                    <td>
                                                        {{ $title }}
                                                    </td>
                                                    <td>
                                                        {{ $invoice }}
                                                    </td>
                                                    <td>{{ $due }}</td>
                                                    <td>
                                                        <span>{{ $schedule->days.' days'}}</span>
                                                        <span>{{ $schedule->condition.' invoice is due'}}</span>
                                                    </td>
                                                    <td>
                                                        <span>{{ $schedule->status}}</span>
                                                    </td>
                                                    <td>
                                                        <a href="#" class="edit_schedule" data-id="{{ $schedule->id }}"><i class="fa fa-fw fa-pencil text-warning"></i></a>
                                                        <a href="#" class="delete_schedule" data-id="{{ $schedule->id }}"><i class="fa fa-fw fa-trash text-danger "></i></a>
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
        </div>
    </section>


    <div class="modal fade edit__modal" role="dialog">
        <div class="modal-dialog modal-lg">

            <div class="modal-content">

                <form action="{{ route('emailschedules.update') }}" method="POST"> 
                    <div class="modal-header"> 
                        <h3 class="title">Update Schedule</h3>
                        <button type="button" class="close text-danger" data-dismiss="modal">&times;</button>
                    </div>

                    @csrf
                    <div class="modal-body bg">
                        <div class="schedules-box">
                            <input type="hidden" name="id">       
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card card-schedule">
                                        <div class="card-header">
                                            <div>
                                                <span>Send Email</span>
                                            </div>
                                            <div>
                                                <input type="text" class="input-days" name="days" value="5">
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
                                        </div>
                                        <div class="card-body">
                                            <div class="template-preview">
                                                <strong>Preview</strong>
                                                <hr>
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
<script src="{{asset('public/dt/datatable/datatables.min.js')}}"></script>
@endsection
@push('script')
<script>
    $(document).ready(function () { 
        $("#datatable").DataTable();
        
        $('.edit_schedule').on('click',async function(){
            const data = $(this).data();
            let edit_modal = $('.edit__modal');
            edit_modal.modal('toggle');

            const {schedule, template} = await $.ajax({
                url: "{{ route('emailschedules.edit') }}",
                type: "POST",
                data: {
                    _token: $("[name=csrf-token]").attr("content"),
                    id: data.id
                }
            });

            $('input[name=id]').val(schedule.id);
            $('input[name=days]').val(schedule.days);
            $(`select[name=condition] option[value=${schedule.condition}]`).prop('selected', true);
            edit_modal.find('.ql-editor').html(template);
        });
        $('.delete_schedule').on('click',function(){
            let id = $(this).data().id;

                Swal.fire({
                    text: 'Are you sure you want to delete this schedule?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!",
                    confirmButtonClass: "btn btn-primary",
                    cancelButtonClass: "btn btn-danger ml-1"
                }).then(async result => {
                    if(result.value){
                        const delete_schedule = await $.ajax({
                            url: "{{ route('emailschedules.delete') }}",
                            type: 'POST',
                            data: {
                                _token: "{{ csrf_token() }}",
                                id
                            }
                        });

                        if(delete_schedule.success){
                            Swal.fire({
                                text: delete_schedule.msg,
                                type: 'success',
                            }).then(()=>{
                                location.reload();
                            });
                        }
                    }
                });
        });


        $('.edit__modal').on('submit', 'form', function(e){
        e.preventDefault();

        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: $(this).serialize(),
            success: function(resp){
                if(resp.success){
                    Swal.fire({
                        text: resp.msg,
                        type: 'success'
                    }).then(() => {
                        location.reload()
                    })
                }
            }
        })
    });
    });

   
</script>
@endpush