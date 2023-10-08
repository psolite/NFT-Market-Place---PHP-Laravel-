@extends('admin.layouts.master')
@section('title') Email @endsection
@section('css')
<!--datatable css-->
<link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
<!--datatable responsive css-->
<link href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') Dashboard @endslot
@slot('title') Email @endslot
@endcomponent



<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <div class="row g-2">
                    <div class="col-sm-4">
                        <h5 class="card-title">Email Template</h5>
                        <!--<a class="btn btn-secondary" href="javascript:void(0)"
                            data-bs-toggle="modal" data-bs-target="#create">Create</a>-->
                    </div>
                    <!--end col-->
                </div>
                <!--end row-->
            </div>
            <div class="card-body">
                <table id="example" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                    <thead>
                        <tr>
                            <th data-ordering="false">ID</th>
                            <th data-ordering="false">Description</th>
                            <th data-ordering="false">Subject</th>
                            <th>Action</th>
                             
                        </tr>
                    </thead>
                    <tbody>
                        @php $i=1 @endphp
                        @foreach($email as $emails)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td> <a href="javascript:void(0)"
                                data-bs-toggle="modal" data-bs-target="#edit{{ $emails->id }}"> {{ $emails->description }}</a></td>
                            <td>{{ $emails->subject }}</td>
                            <td>
                                <div class="dropdown d-inline-block">
                                    <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="ri-more-fill align-middle"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li><a href="javascript:void(0)"
                                            data-bs-toggle="modal" data-bs-target="#edit{{ $emails->id }}" class="dropdown-item edit-item-btn"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!--end col-->
</div>
<!--end row-->
<!-- staticBackdrop Modal -->
<div class="modal fade" id="create" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body text-center p-5">
                <div class="mt-4">
                    
                    <form action="{{ route('admin.email.store') }}" method="POST" >
                        @csrf
                        <div class="row g-3">
                            
                            <div class="col-lg-12">
                                <label for="Description" class="form-label">Description</label>
                                <input type="text" class="form-control" id="Description" name="desc" placeholder="Description" required>
                            </div>
                            <!--end col-->
                            <div class="col-lg-12">
                                <label for="subject" class="form-label">Subject</label>
                                <input type="text" class="form-control" id="subject" name="subject" placeholder="subject" required>
                            </div>
                            <!--end col-->
                            <div class="col-lg-12">
                                <label for="msg" class="form-label">Message</label>
                                <input type="text" class="form-control" id="msg" name="content" placeholder="msg" required>
                            </div>
                            <!--end col-->
                            
                            <div class="col-lg-12">
                                <div class="text-end">
                                    <button class="btn btn-primary">Save</button>
                                </div>
                            </div>
                        </div>
                        <!--end row-->
                    </form>
                    <div class="hstack gap-2 justify-content-center">
                        <a href="javascript:void(0);" class="btn btn-link link-success fw-medium"
                            data-bs-dismiss="modal"><i class="ri-close-line me-1 align-middle"></i> Close</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@foreach ($email as $emails)
  <div class="modal fade" id="edit{{ $emails->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body text-center p-5">
                <div class="mt-4">
                    
                    <form action="{{ route('admin.email.update', $emails->id) }}" method="POST" >
                        @csrf
                        @method('PUT')
                        <div class="row g-3">
                            <div class="col-lg-12">
                                <label for="subject" class="form-label">Subject</label>
                                <input type="text" class="form-control" id="subject" value="{{ $emails->subject }}" name="subject" placeholder="subject" required>
                            </div>
                            <!--end col-->
                            <div class="col-lg-12">
                                <label for="msg" class="form-label">Message</label>
                                <textarea class="form-control" cols="30" rows="10" id="msg" name="content" placeholder="msg" required>{{ $emails->content }}</textarea>
                               
                            </div>
                            <!--end col-->
                            
                            <div class="col-lg-12">
                                <div class="text-end">
                                    <button class="btn btn-primary">Save</button>
                                </div>
                            </div>
                        </div>
                        <!--end row-->
                    </form>
                    <div class="hstack gap-2 justify-content-center">
                        <a href="javascript:void(0);" class="btn btn-link link-success fw-medium"
                            data-bs-dismiss="modal"><i class="ri-close-line me-1 align-middle"></i> Close</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>  
@endforeach

@endsection
@section('script')

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

<script src="{{ URL::asset('build/js/pages/datatables.init.js') }}"></script>

<script src="{{ URL::asset('build/js/app.js') }}"></script>

@endsection
