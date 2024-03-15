@extends('admin.admin_app')
@push('styles')
@endpush
@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-lg-12 col-sm-12 col-xs-12">
		<h2>Inquiries</h2>
		<ol class="breadcrumb">
			<li class="breadcrumb-item">
				<a href="#">Contact & Inquiries Dashboard</a>
			</li>
		</ol>
	</div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
	<div class="row">
		<div class="col-lg-12">
			<div class="ibox">
				<div class="ibox-content">
					<form id="search_form" action="{{url('admin/')}}" method="GET" enctype="multipart/form-data">
						<div class="form-group row justify-content-end">
							<div class="col-sm-6">
								<div class="input-group">
									<input type="date" class="form-control" name="search_date" value="{{ old('search_date', $searchParams['search_date'] ?? '') }}">
									<span class="input-group-append">
										<button type="submit" class="btn btn-primary">Search</button>
									</span>
								</div>
							</div>
							<!-- <div class="col-sm-6">
								<div class="input-group">
									<input type="text" class="form-control" name="search_query" placeholder="Search by Email, Phone, or Name" value="{{ old('search_query', $searchParams['search_query'] ?? '') }}">
									<span class="input-group-append">
										<button type="submit" class="btn btn-primary">Search</button>
									</span>
								</div>
							</div> -->

						</div>
					</form>
					<div class="table-responsive">
						<table id="manage_tbl" class="table table-striped table-bordered dt-responsive" style="width:100%">
							<thead>
								<tr>
									<th>Sr #</th>
									<th>Name</th>
									<th>Email</th>
									<th>Phone</th>
									<th>Inquiry Date</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								@php($i = 1)
								@foreach($inquiries as $item)
								<tr class="gradeX">
									<td>{{ $i++ }}</td>
									<td>{{ $item->name }}</td>
									<td>{{ $item->email }}</td>
									<td>{{ $item->phone }}</td>
									<td>{{ date_formated($item->created_at) }}</td>
									<td>
										<a href="{{url('admin/inquiry/' . $item->id)}}" class="btn btn-primary btn-sm" data-placement="top" title="Details">Details </a>
										<button class="btn btn-danger btn-sm btn_inquiry_delete" data-id="{{$item->id}}" data-text="This action will remove this inquiry from database." type="button" data-placement="top" title="Delete">Delete</button>
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
					<div class="row">
						<div class="col-md-8">
							<p>Showing {{ $inquiries->firstItem() }} to {{ $inquiries->lastItem() }} of {{ $inquiries->total() }} entries</p>
						</div>
						<div class="col-md-4 text-right float-right float-end">
							{{ $inquiries->links('pagination::bootstrap-4') }}
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@push('scripts')
<script>
	$('#manage_tbl').dataTable({
		"paging": false,
		"searching": false,
		"bInfo": false,
		"responsive": true,
		"columnDefs": [{
				"responsivePriority": 1,
				"targets": 0
			},
			{
				"responsivePriority": 2,
				"targets": -1
			},
		]
	});
	$(document).on("click", ".btn_inquiry_delete", function() {
		var id = $(this).attr('data-id');
		swal({
				title: "Are you sure?",
				text: "Your action will remove this inquiry from database!",
				type: "warning",
				showCancelButton: true,
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "Yes, please!",
				cancelButtonText: "No, cancel please!",
				closeOnConfirm: false,
				closeOnCancel: true
			},
			function(isConfirm) {
				if (isConfirm) {
					$(".confirm").prop("disabled", true);
					$.ajax({
						url: "{{ url('admin/inquiry/destroy') }}",
						type: 'post',
						data: {
							"_token": "{{ csrf_token() }}",
							'id': id,
						},
						dataType: 'json',
						success: function(status) {
							$(".confirm").prop("disabled", false);
							if (status.msg == 'success') {
								swal({
										title: "Success!",
										text: status.response,
										type: "success"
									},
									function(data) {
										location.reload();
									});
							} else if (status.msg == 'error') {
								swal("Error", status.response, "error");
							}
						}
					});
				} else {
					swal("Cancelled", "", "error");
				}
			});
	});
</script>
@endpush