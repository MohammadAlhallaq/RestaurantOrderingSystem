<!--**********************************
            Nav header start
        ***********************************-->
<div class="deznav">
    <div class="deznav-scroll">
        <ul class="metismenu" id="menu">

            @if(auth()->user()->approved == null && auth()->user()->account_type_id == \App\Models\Account::IS_RESTAURANT)
                <li>
                    <a href="{{route('general-information-step')}}" aria-expanded="false">
                        <i class="{{session()->has('data.general-information-step') == true ? 'flaticon-013-checkmark' : 'flaticon-050-info'}}"></i>
                        <span class="nav-text">General Information</span>
                    </a>
                </li>

                <li>
                    <a href="{{route('owner-details-step')}}" aria-expanded="false"
                       style="{{session()->has('data.general-information-step') != true ? 'cursor: not-allowed' : ''}}"
                       onclick="{{session()->has('data.general-information-step') != true ? 'return false' : ''}}">

                        <i class="{{session()->has('data.owner-details-step') == true ? 'flaticon-013-checkmark' : 'flaticon-050-info'}}"></i>

                        <span class="nav-text">Owner Details</span>
                    </a>
                </li>

                <li>
                    <a href="{{route('bank-address-step')}}" aria-expanded="false"
                       style="{{session()->has('data.owner-details-step') != true ? 'cursor: not-allowed' : ''}}"
                       onclick="{{session()->has('data.owner-details-step') != true ? 'return false' : ''}}">
                        <i class="{{session()->has('data.bank-address-step') == true ? 'flaticon-013-checkmark' : 'flaticon-050-info'}}"></i>

                        <span class="nav-text">Bank And Address</span>
                    </a>
                </li>

                <li>
                    <a href="{{route('select-package-step')}}" aria-expanded="false"
                       style="{{session()->has('data.bank-address-step') != true ? 'cursor: not-allowed' : ''}}"
                       onclick="{{session()->has('data.bank-address-step') != true ? 'return false' : ''}}">
                        <i class="{{session()->has('data.select-package-step') == true ? 'flaticon-013-checkmark' : 'flaticon-050-info'}}"></i>

                        <span class="nav-text">Packages</span>
                    </a>
                </li>

            @elseif(auth()->user()->approved == 1 && auth()->user()->account_type_id == \App\Models\Account::IS_ADMIN)
                @canany(['show-payments', 'show-categories', 'show-customers', 'show-restaurants', 'show-packages'])
                    <li>
                        <a class="ai-icon" href="/" aria-expanded="false">
                            {{--                        <i class="flaticon-043-menu"></i>--}}
                            <i class="ti-dashboard"></i>
                            {{--                        <i class="la la-dashboard"></i>--}}
                            <span class="nav-text">Dashboard</span>
                        </a>
                    </li>
                @endcanany

                @canany(['create-admin', 'show-admins'])
                    <li>
                        <a class="has-arrow ai-icon" href="javascript:void(0)" aria-expanded="false">
                            <i class="flaticon-043-menu"></i>
                            <span class="nav-text">Admins</span>
                        </a>
                        @can('create-admin')
                            <ul aria-expanded="false">
                                <li><a href="{{route('create-admin')}}">Add Admin</a></li>
                            </ul>
                        @endcan
                        @can('show-admins')
                            <ul aria-expanded="false">
                                <li><a href="{{route('show-admins')}}">Show Admins</a></li>
                            </ul>
                        @endcan
                    </li>
                @endcanany


                @canany(['show-offers', 'show-approved-offers', 'show-rejected-offers'])
                    <li>
                        <a class="has-arrow " href="javascript:void(0)" aria-expanded="false">
                            <i class="flaticon-022-copy"></i>

                            <span class="nav-text">Offers</span>
                        </a>
                        <ul aria-expanded="false">
                            @can('show-offers')
                                <li><a href="{{route('show-offers')}}">Show Offer</a></li>
                            @endcan
                            @can('show-approved-offers')
                                <li><a href="{{route('show-approved-offers')}}">Approved Offer</a></li>
                            @endcan
                            @can('show-rejected-offers')
                                <li><a href="{{route('show-rejected-offers')}}">Rejected Offer</a></li>
                            @endcan
                        </ul>
                    </li>
                @endcanany

                @canany(['create-package', 'show-packages'])
                    <li>
                        <a class="has-arrow ai-icon" href="javascript:void(0)" aria-expanded="false">
                            {{--                        <i class="flaticon-025-dashboard"></i>--}}
                            <i class="ti-package"></i>
                            {{--                        <i class="la la-pack"></i>--}}
                            <span class="nav-text">Packages</span>
                        </a>
                        @can('create-package')
                            <ul aria-expanded="false">
                                <li><a href="{{route('add-package')}}">Add Package</a></li>
                            </ul>
                        @endcan

                        @can('show-packages')
                            <ul aria-expanded="false">
                                <li><a href="{{route('all-packages')}}">Show Packages</a></li>
                            </ul>
                        @endcan
                    </li>
                @endcanany

                @can('show-payments')
                    <li>
                        <a class="has-arrow ai-icon" href="javascript:void(0)" aria-expanded="false">
                            <i class="ti-money"></i>
                            <span class="nav-text">Payments</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{route('check-payments')}}">Cash Payments</a></li>
                        </ul>

                    </li>
                @endcan

                @canany(['show-non-approved-restaurants', 'show-restaurants'])
                    <li>
                        <a class="has-arrow ai-icon" href="javascript:void(0)" aria-expanded="false">
                            <i class="la la-cutlery"></i>
                            <span class="nav-text">Restaurants</span>
                        </a>
                        @can('show-non-approved-restaurants')
                            <ul aria-expanded="false">
                                <li><a href="{{route('non-approved-restaurant')}}">Restaurants waiting approval</a></li>
                            </ul>
                        @endcan
                        @can('show-restaurants')
                            <ul aria-expanded="false">
                                <li><a href="{{route('all-restaurants')}}">Show Restaurants</a></li>
                            </ul>
                        @endcan
                    </li>
                @endcanany

                @canany(['show-categories', 'create-category'])
                    <li>
                        <a class="has-arrow ai-icon" href="javascript:void(0)" aria-expanded="false">
                            <i class="flaticon-025-dashboard"></i>
                            <span class="nav-text">Restaurant Category</span>
                        </a>
                        <ul aria-expanded="false">
                            @can('show-categories')
                                <li><a href="{{route('show-category')}}">Show Categories</a></li>
                            @endcan
                            @can('create-category')
                                <li><a href="{{route('add-category')}}">Add Category</a></li>
                            @endcan

                        </ul>
                    </li>
                @endcanany



                @can('manage-tax')
                    <li>
                        <a class="has-arrow ai-icon" href="javascript:void(0)" aria-expanded="false">
                            <i class="ti-money"></i>
                            <span class="nav-text">Tax</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{route('show-tax')}}">Show Taxes</a></li>
                            <li><a href="{{route('add-tax')}}">Add Tax</a></li>
                        </ul>
                    </li>
                @endcan


                @canany(['show-sub-categories', 'create-sub-category'])
                    <li>
                        <a class="has-arrow " href="javascript:void(0)" aria-expanded="false">
                            <i class="flaticon-025-dashboard"></i>
                            <span class="nav-text">Sub Category</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{route('show-sub-category')}}">Show Sub Categories</a></li>
                            <li><a href="{{route('add-sub-category')}}">Add Sub Category</a></li>
                        </ul>
                    </li>
                @endcanany

                @canany(['create-article', 'show-articles'])
                    <li>
                        <a class="has-arrow " href="javascript:void(0)" aria-expanded="false">
                            <i class="ti-archive"></i>

                            <span class="nav-text">Articles</span>
                        </a>
                        <ul aria-expanded="false">
                            @can('create-article')
                                <li><a href="{{route('store.article')}}">Add Article</a></li>
                            @endcan
                            @can('show-articles')
                                <li><a href="{{route('show.articles')}}">Show Articles</a></li>
                            @endcan
                        </ul>
                    </li>

                @endcanany


                @can('manage-privileges')
                    <li>
                        <a class="has-arrow " href="javascript:void(0)" aria-expanded="false">
                            <i class="ti-key"></i>

                            <span class="nav-text">Roles & Permissions</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{route('show-roles')}}">Show Roles</a></li>
                            <li><a href="{{route('show-permissions')}}">Show Permissions</a></li>
                        </ul>
                    </li>
                @endcan


                @can('show-customers')
                    <li>
                        <a class="" href="{{route('show-customers')}}" aria-expanded="false">
                            <i class="ti-user"></i>
                            <span class="nav-text">Customers</span>
                        </a>
                    </li>
                @endcan

            @elseif(auth()->user()->approved == 1 && auth()->user()->account_type_id == \App\Models\Account::IS_RESTAURANT)

                @if(\Carbon\Carbon::now()->toDateTimeString() > Auth::user()->package_expiration_at)
                    <li>
                        <a class="" href="{{route('renew-subscription')}}" aria-expanded="false">
                            <i class="flaticon-022-copy"></i>

                            <span class="nav-text">Renew Subscription</span>
                        </a>
                    </li>

                @elseif(count(auth()->user()->currency) == 0)
                    <li>
                        <a class="" href="{{route('set-currency')}}" aria-expanded="false">
                            <i class="ti-money"></i>
                            <span class="nav-text">Select Currency</span>
                        </a>
                    </li>
                @else

                    <li>
                        <a class="ai-icon" href="{{route('profile', auth()->id())}}" aria-expanded="false">
                            <i class="ti-user"></i>
                            <span class="nav-text">Profile</span>
                        </a>
                    </li>

                    <li>
                        <a class="has-arrow " href="javascript:void(0)" aria-expanded="false">
                            <i class="flaticon-022-copy"></i>

                            <span class="nav-text">Orders</span>
                        </a>
                        <ul aria-expanded="false">

                            <ul aria-expanded="false">
                                <li><a href="{{route('show-orders')}}">Show Orders</a></li>
                                <li><a href="{{route('show-rejected-orders')}}">Show Rejected Orders</a></li>
                                <li><a href="{{route('show-not-finished-orders')}}">Show NF Orders</a></li>
                            </ul>

                        </ul>
                    </li>
                    <li>
                        <a class="has-arrow " href="javascript:void(0)" aria-expanded="false">
                            {{--                        <i class="flaticon-022-copy"></i>--}}
                            {{--                        <i class="la la-ticket"></i>--}}
                            <i class="ti-ticket"></i>

                            <span class="nav-text">Coupon</span>
                        </a>
                        <ul aria-expanded="false">

                            <ul aria-expanded="false">
                                <li><a href="{{route('add-coupon')}}">Add Coupon</a></li>
                                <li><a href="{{route('show-coupon')}}">Show Coupon</a></li>
                            </ul>
                            </li>

                        </ul>
                    </li>
                    <li>
                        <a class="has-arrow " href="javascript:void(0)" aria-expanded="false">
                            <i class="flaticon-043-menu"></i>

                            <span class="nav-text">Components</span>
                        </a>
                        <ul aria-expanded="false">
                            <ul aria-expanded="false">
                                <li><a href="{{route('add-component')}}">Add component</a></li>
                                <li><a href="{{route('show-components')}}">Show component</a></li>
                            </ul>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a class="has-arrow " href="javascript:void(0)" aria-expanded="false">
                            <i class="flaticon-086-star"></i>
                            <span class="nav-text">Items</span>
                        </a>
                        <ul aria-expanded="false">
                            <ul aria-expanded="false">
                                <li><a href="{{route('add-item')}}">Add Item</a></li>
                                {{--                        <li><a  href="{{route('add-sub-categoryController')}}">Add Item</a></li>--}}
                                <li><a href="{{route('show-items')}}">Show Item</a></li>
                            </ul>
                            </li>

                        </ul>
                    </li>



                    <li>
                        <a class="has-arrow " href="javascript:void(0)" aria-expanded="false">
                            <i class="flaticon-022-copy"></i>

                            <span class="nav-text">Comments</span>
                        </a>
                        <ul aria-expanded="false">
                            </li>
                            <ul aria-expanded="false">
                                <li><a href="{{route('show-new-comments')}}">Show New Comments</a></li>
                                <li><a href="{{route('show-comments')}}">Show Comments</a></li>
                            </ul>
                            </li>

                        </ul>
                    </li>

                    <li>
                        <a class="has-arrow " href="javascript:void(0)" aria-expanded="false">
                            <i class="flaticon-022-copy"></i>

                            <span class="nav-text">Offer</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{route('add-offer')}}">Add Offer</a></li>
                            <li><a href="{{route('show-offers')}}">Show Offer</a></li>
                            <li><a href="{{route('show-approved-offers')}}">Approved Offer</a></li>
                            <li><a href="{{route('show-rejected-offers')}}">Rejected Offer</a></li>
                        </ul>
                    </li>
                @endif
            @endif
        </ul>

    </div>
</div>
<!--**********************************
    Sidebar end
***********************************-->

<!--**********************************
    Content body start
***********************************-->
<div class="content-body">
    <!-- row -->
    <div class="container-fluid">
