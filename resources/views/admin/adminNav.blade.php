<!-- =============== Navigation ================ -->
<div class="container">
    <div class="navigation">
        <ul>
            <li>
                <a href="#">
                    <span class="icon">
                        <ion-icon name="globe-outline"></ion-icon>
                    </span>
                    <span class="title">CRACK E-Commerce</span>
                </a>
            </li>

            <li>
                <a href="{{route('home')}}">
                    <span class="icon">
                        <ion-icon name="home-outline"></ion-icon>
                    </span>
                    <span class="title">Dashboard</span>
                </a>
            </li>

            <li>
                <a href="{{route('admin.users')}}">
                    <span class="icon">
                        <ion-icon name="people-outline"></ion-icon>
                    </span>
                    <span class="title">Users</span>
                </a>
            </li>


            <li>
                <a href="#">
                    <span class="icon">
                        <ion-icon name="storefront-outline"></ion-icon>
                    </span>
                    <span class="title">Stores</span>
                </a>
            </li>
            <li>
                <a href="{{route('admin.orders')}}">
                    <span class="icon">
                        <ion-icon name="cash-outline"></ion-icon>
                    </span>
                    <span class="title">Orders</span>
                </a>
            </li>
            <li>
                <a href="{{route('admin.categories')}}">
                    <span class="icon">
                        <ion-icon name="list-outline"></ion-icon>
                    </span>
                    <span class="title">Categories</span>
                </a>
            </li>
            <li>
                <a href="{{route('admin.super_search_view')}}">
                    <span class="icon">
                        <ion-icon name="search-outline"></ion-icon>
                    </span>
                    <span class="title">Super Search</span>
                </a>
            </li>

            <li>
                <a href="{{ route('edit-profile') }}">
                    <span class="icon">
                        <ion-icon name="lock-closed-outline"></ion-icon>
                    </span>
                    <span class="title">Edit Profile</span>
                </a>
            </li>

            <li>
                <a href="#">
                    <span class="icon">
                        <ion-icon name="log-out-outline"></ion-icon>
                    </span>
                   
                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="logout-button">
                            <span class="title">Sign Out</span>
                        </button>
                    </form>
                </a>
            </li>
           
        </ul>
    </div>
