@extends('home.template1.master')
@section('content')
<div class="container">
	<h1 class="text-center">{{ $menu->name }}</h1>
	<div class="categories">
		<div class="row">
			@foreach($menu->category->children as $subCategory)
			<div class="col-lg-6">
				<a href="/cat/{{$subCategory->id}}/">
					<div class="category text-center">
						<div class="category-in">
							<p>{{$subCategory->name}}</p>
						</div>
					</div>
				</a>					
			</div>
			@endforeach
		</div>
	</div>
</div>
@stop

