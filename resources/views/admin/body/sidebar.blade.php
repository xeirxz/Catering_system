<div class="deznav">
    <div class="deznav-scroll">
        <ul class="metismenu" id="menu">
            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="flaticon-025-dashboard"></i>
                    <span class="nav-text">Dashboard</span>
                </a>
                <ul aria-expanded="false">

                    <li class="">
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">Booking</a>
                        <ul aria-expanded="false" class="left mm-collapse" style="height: 14px;">
                            <li><a href="{{route('admin.book')}}">Booking List</a></li>
                            <li><a href="{{route('admin.book.approve')}}">Approved Booking</a></li>
                            <li><a href="{{route('admin.book.incoming')}}">Incoming Packages</a></li>
                            <li><a href="{{route('admin.book.cancel')}}">Cancelled Booking</a></li>
                        </ul>
                    </li>
                    <li><a href="order_details_page.html">Order Details</a></li>
                    <li><a href="{{route('admin.customer.customerList')}}">Customers</a></li>
                    <li><a href="{{route('admin.sales')}}">Sales Report</a></li>
                    <li><a href="{{('/category/index')}}">Menu</a></li>
                </ul>

            </li>
            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="flaticon-050-info"></i>
                    <span class="nav-text">Apps</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="app_profile.html">Profile</a></li>
                    <li><a href="post_details.html">Post Details</a></li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Email</a>
                        <ul aria-expanded="false">
                            <li><a href="email_compose.html">Compose</a></li>
                            <li><a href="email_inbox.html">Inbox</a></li>
                            <li><a href="email_read.html">Read</a></li>
                        </ul>
                    </li>
                    <li><a href="app_calender.html">Calendar</a></li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Shop</a>
                        <ul aria-expanded="false">
                            <li><a href="ecom_product_grid.html">Product Grid</a></li>
                            <li><a href="ecom_product_list.html">Product List</a></li>
                            <li><a href="ecom_product_details.html">Product Details</a></li>
                            <li><a href="ecom_product_order.html">Order</a></li>
                            <li><a href="ecom_checkout.html">Checkout</a></li>
                            <li><a href="ecom_invoice.html">Invoice</a></li>
                            <li><a href="ecom_customers.html">Customers</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="flaticon-041-graph"></i>
                    <span class="nav-text">Charts</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="flot.html">Flot</a></li>
                    <li><a href="morris.html">Morris</a></li>
                    <li><a href="chartjs.html">Chartjs</a></li>
                    <li><a href="chartist.html">Chartist</a></li>
                    <li><a href="sparkline.html">Sparkline</a></li>
                    <li><a href="peity.html">Peity</a></li>
                </ul>
            </li>
        </ul>
        <div class="plus-box">
            <img src="{{asset('../assets/images/plus.png')}}" alt="">
            <h5 class="fs-18 font-w700">Add Menus</h5>
            <p class="fs-14 font-w400">Manage your food <br>and beverages menus<i class="fas fa-arrow-right ms-3"></i></p>
        </div>
        <!-- <div class="copyright">
            <p><strong>Lezato Restaurant Admin</strong> © 2023 All Rights Reserved</p>
            <p class="fs-12">Made with <span class="heart"></span> by DexignZone</p>
        </div> -->
    </div>
</div>