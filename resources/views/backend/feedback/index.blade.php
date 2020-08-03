@extends('backend.master')
@section('title','Đánh giá sản phẩm')
@section('namepage','Đánh giá sản phẩm')
@section('main')

<div class="row">
	<div class="col-12">
		<div class="card">
			@if(Session::has('success'))
			<div class="alert alert-success alert-dismissible fade show" role="alert">
				{{Session::get('success')}}
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			@endif
			<div class="card-body">
				<div class="row">
					<div class="col-sm-12">
						<div class="text-sm-left">
							<a href="" class="btn btn-success btn-rounded waves-effect waves-light mb-2 mr-2"><i class="mdi mdi-plus mr-1"></i>Thêm mới danh mục</a>
						</div>
					</div>
					<div class="col-sm-12">
						<table id="datatable-buttons" class="table table-bordered dt-responsive  dataTable  dtr-inline table-hover" role="grid" aria-describedby="datatable-buttons_info">
							<thead>
								<tr role="row">
									<th class="sorting">STT</th>
									<th class="sorting">Tên sản phẩm</th>
									<th class="sorting">Người đánh giá</th>
									<th class="sorting">Star</th>
									<th class="sorting" style="width:5px">Nội dung</th>
									<th class="sorting">Trạng thái</th>
									<th class="sorting">Hành động</th>
								</tr>
							</thead>
							<tbody>
								@foreach($feedback as $value)
								<tr role="row" class="odd">
									<td class="dtr-control" tabindex="0">{{$loop->index+1}}</td>
									<td class="sorting_1">{{$value->products->name}}</td>
									<td class="sorting_1">{{$value->users->name}}</td>									
									<td class="sorting_1">								
											@for ($i = 0; $i < $value->star; $i++)
													{{-- <label for="rate1"></label> --}}
													<i class="fa fa-star color"></i>
												@endfor										
									</td>
									<td class="sorting_1" style="width:5px">{{$value->content}}</td>
									<td>{!!($value->status==1)?'<span class="badge badge-pill badge-soft-success font-size-12">Hiện</span>':'<span class="badge badge-pill badge-soft-danger font-size-12">Ẩn</span>'!!}</td>
									
									<td>
										
										<div class="row">
											<div class="col">
												<!-- Ẩn -->
												<form action="{{route('feedback.update',$value->id)}}" method="POST">
													@csrf
													@method('UPDATE')
													<button class="btn btn-primary mdi mdi-eye" onclick="return confirm('Bạn có muốn ẩn feedback')" type="submit" title="" data-original-title="Ẩn feedback" data-toggle="tooltip">
													</button>

												</form>
											</div>
											<div class="col">
												<!-- Xóa -->
												<form action="{{route('feedback.destroy',$value->id)}}" method="POST">
													@csrf
													@method('DELETE')
													<button class="btn btn-danger mdi mdi-close" onclick="return confirm('Xóa danh mục -{{$value->name}}- không?')" type="submit" title="" data-original-title="Xóa" data-toggle="tooltip">
													</button>

												</form>
											</div>
										</div>
										
										
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>

			</div>
		</div>
	</div>
</div> <!-- end col -->
<script>

	function greetme(message){

		 alert(message);

	 }

 </script>
@stop