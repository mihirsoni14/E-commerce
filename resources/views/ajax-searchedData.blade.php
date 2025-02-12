@foreach ($products as $product)
    <div class="col-md-6 col-lg-4 col-xl-3">
        <div class="rounded position-relative fruite-item">
            <style>
                .fruite-img {
                    height: 210px;
                    max-height: 300px;
                }

                .description {
                    display: -webkit-box;
                    -webkit-line-clamp: 2;
                    -webkit-box-orient: vertical;
                    overflow: hidden;
                    text-overflow: ellipsis;
                }
            </style>
            <div class="fruite-img border border-secondary border-bottom-0">
                <img src="{{asset($product->images)}}" class="border-secondary img-fluid w-100 rounded-top" alt="">
            </div>
            <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;">
                {{$product->subcategory->name}}
            </div>
            <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                <h4>{{$product->title}}</h4>
                <p class="description">{{$product->description}}</p>
                <div class="d-flex justify-content-between flex-lg-wrap">
                    <p class="text-dark fs-5 fw-bold mb-0"> ${{$product->price}}</p>
                    <a href="{{Auth::user() ? 'javascript:void(0)' : route('admin.login')}}"
                        class="btn border border-secondary rounded-pill px-3 text-primary"><i
                            class="fa fa-shopping-bag me-2 text-primary add_to_cart" data-prod_id="{{$product->id}}"></i>
                        Add to
                        cart</a>
                </div>
            </div>
        </div>
    </div>
@endforeach