@if(count($product) > 0)
    @foreach($product as $p)
    <div class="col-md-3">
        <div class="card card-user card-stretch gutter-b">
            <div style="cursor: pointer;" onclick="DetailProduct('{{base64_encode($p->id)}}')">
                <div class="div_bg_image">
                    <a href="#" class="img-wrap"> <img src="{{$p->image}}" alt="Product" style="max-height: 200px;width: 100%;object-fit: cover;object-position: center;"> </a>
                </div>
                <div class="info-wrap p-2 pb-40" style="height: 270px;overflow-x: scroll;">
                    <h5 class="card-title mb-0">{{$p->product_name}}</h5>
                    @if($p->variant_color != null || $p->variant_model != null)
                    <span class="mb-0 text-success ml-4" style="font-size: 12px;">varian : {{ $p->variant_color}} -  {{$p->variant_model}}</span>
                    @endif
                    <br>
                    <!-- <span class="text-muted mt-5">{{ LimiterText($p->description,100)}}</span> -->
                    <div class="product-rate-cover">
                        <div class="product-rate d-inline-block">
                            {!! RatingProduct($p->rating) !!}
                        </div>
                        <span class="font-small ml-5 text-muted"> ({{$p->rating}})</span><span class="ml-15">terjual : {{$p->number_of_sale}} / {{$p->stock}}</span>
                    </div>
                    <div class="mt-3 mb-3">
                        <span class="text-muted">By : <span class="text-success font-weight-bolder">{{$p->shop_name}}</span></span>
                    </div>
                    <div class="product-card-bottom">
                        <div>
                            {!! Priceproduct($p->selling_price,$p->discount) !!}
                        </div>
                    </div>
                    <!-- price-wrap.// -->
                </div>
            </div>
            <?php 
            $suspend = null;
            if ($p->suspend_date_active != null) {
                $suspend = date('Y-m-d',strtotime($p->suspend_date_active)).'T'.date('H:i',strtotime($p->suspend_date_active));
            }
            if ($p->status == 0) {
                $status = '<div class="mt-5"><a id="' . $p->id . '" aksi="status" tujuan="' . 'product' . '" data="' . 'data_product' . '" class="btn btn-warning btn-sm aksi_suspend div_bottom" reason="'.$p->reason.'" suspend="'.$suspend.'" status="'.$p->status.'">Tidak Aktif</a></div>';
            } else if ($p->status == 1) {
                $status = '<div class="mt-5"><a id="' . $p->id . '" status="'.$p->status.'" aksi="status" tujuan="' . 'product' . '" data="' . 'data_product' . '" class="btn btn-success btn-sm aksi_suspend div_bottom" suspend="'.$suspend.'" reason="'.$p->reason.'"><i class="fas fa-edit"></i>Aktif</a></div>';
            } else if ($p->status == 2) {
                $status = '<div class="mt-5"><a id="' . $p->id . '" aksi="status" tujuan="' . 'product' . '" data="' . 'data_product' . '" class="btn btn-warning btn-sm aksi_suspend div_bottom" reason="'.$p->reason.'" suspend="'.$suspend.'" status="'.$p->status.'">Suspend Sampai '.date('d-m-Y H:i',strtotime($p->suspend_date_active)).'</a></div>';
            } else {
                $status = '<div class="mt-5"><a id="' . $p->id . '" aksi="status" tujuan="' . 'product' . '" data="' . 'data_product' . '" class="btn btn-danger btn-sm aksi_suspend div_bottom" reason="'.$p->reason.'" suspend="'.$suspend.'" status="'.$p->status.'"><i class="fas fa-edit"></i>Diblokir Selamanya</a></div>';
            }
            ?>
            {!! $status !!}
        </div>
        <!-- card-product  end// -->
    </div>
    @endforeach
@else
    <style type="text/css">
        #btn-next {
            display: none;
        }
    </style>
@endif
<script type="text/javascript">
    function DetailProduct(id){
        location.assign('/product/list-produk/'+id);
    }
</script>