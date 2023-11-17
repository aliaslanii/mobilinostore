@extends('Home.Layout.Profile')
@section('Content')
<div class="col-lg-9 col-md-9 col-xs-12 pull-left">
    <section class="page-contents">
        <div class="profile-content FaviritProductList">
            <div class="FaviritProduct">
                <div class="headline-profile">
                    <span>لیست علاقه مندی</span>
                </div>
              
                    @if (count($FaveritProducts) > 0)
                    <div class="profile-stats">
                        @foreach ($FaveritProducts as $FaveritProduct)
                            <div class="profile-recent-fav">
                                <a href="{{ route('ShowProduct',['P_id' => $FaveritProduct->Products()->P_id ,'Name' => $FaveritProduct->Products()->Name , 'Color' => Color($FaveritProduct->Products()) ]) }}" class="profile-recent-fav-col">
                                    <img src="{{ asset('images/Products-image/' . $FaveritProduct->Products()->img) }}">
                                </a>
                                <div class="profile-recent-fav-col-title">
                                    <a href="#">
                                        <h3 class="profile-recent-fav-name">{{ $FaveritProduct->Products()->title }}</h3>
                                    </a>
                                </div>
                                <div class="profile-recent-fav-price">
                                    
                                    @if ($FaveritProduct->Products()->Discounts())
                                    <del><span>{{ number_format(CheapestPrice($FaveritProduct->Products())) }}<span>تومان</span></span></del>
                                    {{ number_format(DiscountedPrice($FaveritProduct->Products()->id,Color($FaveritProduct->Products())->id)) }}<span>تومان</span>
                                    @else
                                    <ins><span>{{ number_format(DiscountedPrice($FaveritProduct->Products()->id,Color($FaveritProduct->Products())->id)) }}<span>تومان</span></span></ins>
                                    @endif
                                </div>
                                <div class="profile-recent-fav-col-actions">
                                    <button data-id="{{ $FaveritProduct->Products()->id }}" class="js-remove-favorite-product DisLikebtn"><i class="fa fa-trash"></i></button>
                                </div>
                            </div>
                        @endforeach 
                    </div> 
                    @else
                    <div class="profile-stats">
                        <div class="profile-return-box">
                            <p class="profile-return-message">متاسفانه علاقه مندی های شما خالی است</p>
                        </div>
                    </div>
                    @endif
            </div>
        </div>
    </section>
</div>
</div>
<!--profile------------------------------------>
@endsection
@section('script')
<script>
    $(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('body').on("click",'.DisLikebtn' , function() {
            $('.loader-div').show();
            var product_id = $(this).data("id");
            $.ajax({
                data: {'product_id': product_id},
                url: "{{ route('removeFavirate') }}",
                type: "POST",
                dataType: 'json',
                success: function (data) {
                    $('.FaviritProduct').remove();
                    $('.FaviritProductList').append(data.FPL);
                    $('.loader-div').hide();
                }
            });
        });
    });
</script>
@endsection