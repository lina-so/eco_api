@extends('layouts.app')

 
@if (Session::get('locale')== "ar")
        <style>
          .container_2{
            direction:rtl;
          }
		  .box .sq:nth-child(5){
			margin-left: -1280px;
		  }
        
		  .box .sq:nth-child(1){
			margin-right: 1318px;
		  }
		  .box .sq:nth-child(2){
			margin-left: -495px;
		  }

		
        </style>  
    @else
        <style>
             .container_2{
            direction:ltr;
            text-align:left;
          }

        </style>
    @endif

@section('content')

<div class="container">
      

    <div class="section_1">
	<div class="color"></div>
		<div class="color"></div>
		<div class="color"></div>
		<div class="box">
			<div class="square sq" style="--i: 0;"></div>
			<div class="square sq" style="--i: 1;"></div>
			<div class="square sq" style="--i: 2;"></div>
			<div class="square sq" style="--i: 3;"></div>
			<div class="square sq" style="--i: 4;"></div>

			<div class="container_2">
				<div class="form">
					<h2 class="h2">@lang('lang.add realestate')</h2>
					<form  action="{{ route('liked.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
						
						<div class="inputBox">
							{{-- <input type="text" placeholder="user_id" name="user_id"> --}}
						</div>
						<div class="inputBox">
							<input type="text"placeholder="sub product id" name="subproducts_id">
						</div>
						


					
						<div class="save save_1">
                            <button type="submit">submit</button>
                        </div>
						
					</form>
				</div>
			</div>
		</div>
	</div>

@endsection


