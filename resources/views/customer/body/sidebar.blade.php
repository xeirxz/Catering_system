<div class="deznav">
    <div class="deznav-scroll">
        <ul class="metismenu" id="menu">
            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="flaticon-025-dashboard"></i>
                    <span class="nav-text">Dashboard</span>
                </a>
                <ul aria-expanded="false">

                    <li><a href="{{ route('customer.orders') }}">Orders</a></li>
                    <li><a href="{{route('customer.book')}}">Book</a></li>
                </ul>

            </li>
            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="flaticon-050-info"></i>
                    <span class="nav-text">Apps</span>
                </a>
                <ul aria-expanded="false">
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Transactions</a>
                        <ul aria-expanded="false">
                            <li><a href="{{route('customer.transaction')}}">Book Transactions</a></li>
                            <li><a href="#">History</a></li>
                        </ul>
                    </li>
                  
                </ul>
            </li>
    </div>
</div>