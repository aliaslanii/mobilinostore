@extends('Home.Layout.Home')
@section('Content')
<!--product-comment---------------------------->
<div class="container-main">
	<div class="col-12">
		<div class="breadcrumb-container">
			<ul class="js-breadcrumb">
				<li class="breadcrumb-item">
					<a href="#" class="breadcrumb-link">خانه</a>
				</li>
				<li class="breadcrumb-item">
					<a href="#" class="breadcrumb-link">موبایل</a>
				</li>
				<li class="breadcrumb-item">
					<a href="#" class="breadcrumb-link active-breadcrumb">{{ $Product->title }}</a>
				</li>
			</ul>
		</div>
		
	</div>
</div>
<!--product-comment---------------------------->
@endsection
@section('script')
<script>
	$(function() {
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		$('#Saherbtn').click(function(){
			$('#ShearModal').modal('show');
		});
		$("#copyButton").click(function () {
			var text = $("#textToCopy").text();
			var tempInput = $("<input>");
			$("body").append(tempInput);
			tempInput.val(text).select();
			document.execCommand("copy");
			tempInput.remove();
		});

		$('#addBasket').click(function() {
            $('.loader-div').show();
			$.ajax({
                data: $('#ProductColor').serialize(),
				url: "{{ route('AddProduct') }}",
				type: "POST",
				dataType: 'json',
				success: function (data) {
					$('.dropdownBasket').remove();
                    $('.ProductsBasket').append(data.BasketProducts);
					$('#PM-basket-btn').removeAttr('hidden');
					$('#add-baket-btn').attr("hidden", "true");
					$('#countP').text(data.count);
                    $('.loader-div').hide();
				},
				error: function (data) {
					console.log('Error:', data);
				}
			});
		});
		$('#Pluscount').click(function() {
            $('.loader-div').show();
			var color_id = $(this).data("c-id");
			$.ajax({
                data: $('#ProductColor').serialize(),
				url: "{{ route('Pluscount') }}",
				type: "POST",
				dataType: 'json',
				success: function (data) {
                    $('.dropdownBasket').remove();
                    $('.ProductsBasket').append(data.BasketProducts);
					$('#countP').text(data.count);
                    $('.loader-div').hide();
				},
				error: function (data) {
					console.log('Error:', data);
				}
			});
		});
		$('#Minuscount').click(function(e) {
            $('.loader-div').show();
			var color_id = $(this).data("c-id");
			$.ajax({
                data: $('#ProductColor').serialize(),
				url: "{{ route('Minuscount') }}",
				type: "POST",
				dataType: 'json',
				success: function (data) {
					$('.dropdownBasket').remove();
                    $('.ProductsBasket').append(data.BasketProducts);
					if(data.count === 0){
						$('#PM-basket-btn').attr("hidden","true");
						$('#add-baket-btn').removeAttr('hidden');
					}else{
						$('#countP').text(data.count);
					}
                    $('.loader-div').hide();
				},
				error: function (data) {
					console.log('Error:', data);
				}
			});
		});  
		$('.setColor').click( function () {
			var product_id = $(this).data("p-id");
			var color_id = $(this).data("c-id");
            $('.loader-div').show();
			$.ajax({
				data: {'Product': product_id,'Color': color_id },
				url: '{{ route("SelectColor") }}',
				type: "POST",
				dataType: 'json',
				success: function (data) {
					$('#Price').text(addCommas(data.Price));
					$('#countP').text(data.count);
                    $('#Color').val(color_id);
					if(data.count === 0){
						$('#PM-basket-btn').attr("hidden","true");
						$('#add-baket-btn').removeAttr('hidden');
                    }else{
						$('#add-baket-btn').attr("hidden","true");
						$('#PM-basket-btn').removeAttr('hidden');
					}
					if(data.PriceDiscount !== null){
						$('#Price-Discount').text(addCommas(data.PriceDiscount));  
					}
                    $('.loader-div').hide();
				},
				error: function (data) {
					console.error(data);
				},
			});
		});
		$('.Likebtn').click(function() {
			var product_id = $(this).data("product_id");
			$.ajax({
				data: {'product_id': product_id},
				url: "{{ route('AddFavirate') }}",
				type: "POST",
				dataType: 'json',
				success: function (data) {
					$('.Like').attr('hidden','true');
					$('.DisLike').removeAttr('hidden');
				}
			});
		});
		$('.DisLikebtn').click(function() {
			var product_id = $(this).data("product_id");
			$.ajax({
				data: {'product_id': product_id},
				url: "{{ route('removeFavirate') }}",
				type: "POST",
				dataType: 'json',
				success: function (data) {
					$('.DisLike').attr('hidden','true');
					$('.Like').removeAttr('hidden');
				}
			});
		});
	});	
</script>


@endsection