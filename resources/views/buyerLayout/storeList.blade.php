@php $storesChunks = $stores->chunk(3); @endphp
@foreach($storesChunks as $chunk)
    <div class="row" style="margin-top: 20px;">
        @foreach($chunk as $store)
        <div class="col-lg-4 col-md-6 text-center">
            <div class="single-product-item" style="background-color: #edebeb;border:2px solid orange;">
                <div class="product-image">
                    <a href="">
                        <img src="{{ asset('storage/' . $store->image_url) }}" alt="">
                    </a>
                </div>
                <h3>{{ $store->store_name }}</h3>
                <p class="product-price"><span>{{ $store->store_category }}</span></p>
                <a href="{{ route('storeProductView', ['id' => $store->id]) }}" class="cart-btn">Shop</a>
                <a href="{{ route('chats_list', ['user_id' => $user->id]) }}">
                    <button class="chat-btn">Chat</button>
                </a>
            </div>
        </div>
        @endforeach
    </div>
@endforeach
<div class="custom-pagination" style="margin: 20px; text-align:center;">
    {{ $stores->links() }}
</div>
