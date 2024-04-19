<!-- BEGIN: Main Menu-->
<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item me-auto"><a class="navbar-brand"
                    href="{{ route('admin.') }}">
                    <span class="brand-logo">
                        <svg viewbox="0 0 139 95" version="1.1" xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink" height="24">
                            <defs>
                                <lineargradient id="linearGradient-1" x1="100%" y1="10.5120544%" x2="50%"
                                    y2="89.4879456%">
                                    <stop stop-color="#000000" offset="0%"></stop>
                                    <stop stop-color="#FFFFFF" offset="100%"></stop>
                                </lineargradient>
                                <lineargradient id="linearGradient-2" x1="64.0437835%" y1="46.3276743%" x2="37.373316%"
                                    y2="100%">
                                    <stop stop-color="#EEEEEE" stop-opacity="0" offset="0%"></stop>
                                    <stop stop-color="#FFFFFF" offset="100%"></stop>
                                </lineargradient>
                            </defs>
                            <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g id="Artboard" transform="translate(-400.000000, -178.000000)">
                                    <g id="Group" transform="translate(400.000000, 178.000000)">
                                        <path class="text-primary" id="Path"
                                            d="M-5.68434189e-14,2.84217094e-14 L39.1816085,2.84217094e-14 L69.3453773,32.2519224 L101.428699,2.84217094e-14 L138.784583,2.84217094e-14 L138.784199,29.8015838 C137.958931,37.3510206 135.784352,42.5567762 132.260463,45.4188507 C128.736573,48.2809251 112.33867,64.5239941 83.0667527,94.1480575 L56.2750821,94.1480575 L6.71554594,44.4188507 C2.46876683,39.9813776 0.345377275,35.1089553 0.345377275,29.8015838 C0.345377275,24.4942122 0.230251516,14.560351 -5.68434189e-14,2.84217094e-14 Z"
                                            style="fill:currentColor"></path>
                                        <path id="Path1"
                                            d="M69.3453773,32.2519224 L101.428699,1.42108547e-14 L138.784583,1.42108547e-14 L138.784199,29.8015838 C137.958931,37.3510206 135.784352,42.5567762 132.260463,45.4188507 C128.736573,48.2809251 112.33867,64.5239941 83.0667527,94.1480575 L56.2750821,94.1480575 L32.8435758,70.5039241 L69.3453773,32.2519224 Z"
                                            fill="url(#linearGradient-1)" opacity="0.2"></path>
                                        <polygon id="Path-2" fill="#000000" opacity="0.049999997"
                                            points="69.3922914 32.4202615 32.8435758 70.5039241 54.0490008 16.1851325">
                                        </polygon>
                                        <polygon id="Path-21" fill="#000000" opacity="0.099999994"
                                            points="69.3922914 32.4202615 32.8435758 70.5039241 58.3683556 20.7402338">
                                        </polygon>
                                        <polygon id="Path-3" fill="url(#linearGradient-2)" opacity="0.099999994"
                                            points="101.428699 0 83.0667527 94.1480575 130.378721 47.0740288"></polygon>
                                    </g>
                                </g>
                            </g>
                        </svg></span>
                    <h2 class="brand-text">Satta Matka</h2>
                </a></li>
            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pe-0" data-bs-toggle="collapse"><i
                        class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i
                        class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc"
                        data-ticon="disc"></i></a></li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class=" nav-item"><a class="d-flex align-items-center" href="{{ route('admin.dashboard') }}"><i
                        data-feather="home"></i><span class="menu-title text-truncate"
                        data-i18n="Dashboards">Dashboards</span></a>
            </li>
            {{-- <li class=" navigation-header"><span data-i18n="Apps &amp; Pages">Apps &amp; Pages</span><i data-feather="more-horizontal"></i> --}}
            </li>
            <li class=" nav-item"><a class="d-flex align-items-center" href="{{ route('admin.users.index') }}"><i
                        data-feather="users"></i><span class="menu-title text-truncate" data-i18n="User">User
                        Management</span></a>
            </li>
            <li class=" nav-item"><a class="d-flex align-items-center" href="{{ route('admin.declare-result') }}"><i
                        data-feather="message-square"></i><span class="menu-title text-truncate"
                        data-i18n="Chat">Declare Result</span></a>
            </li>
            <li class=" nav-item"><a class="d-flex align-items-center"
                    href="{{ route('admin.winning-predictions') }}"><i data-feather="check-square"></i><span
                        class="menu-title text-truncate" data-i18n="Todo">Winning Predicition</span></a>
            </li>
            {{-- <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="calendar"></i><span class="menu-title text-truncate" data-i18n="Calendar">Report Management</span></a>
            </li> --}}
            {{-- <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="grid"></i><span class="menu-title text-truncate" data-i18n="Kanban">Wallet Management</span></a>
            </li> --}}
            <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i
                        data-feather="file-text"></i><span class="menu-title text-truncate"
                        data-i18n="Invoice">Report Management</span></a>
                <ul class="menu-content">
                    <li><a class="d-flex align-items-center" href="{{ route('admin.user-bid-history') }}"><i data-feather="circle"></i><span
                                class="menu-item text-truncate" data-i18n="List">User Bid History </span></a>
                    </li>
                    <li><a class="d-flex align-items-center" href="{{ route('admin.customer_sell_report') }}"><i data-feather="circle"></i><span
                                class="menu-item text-truncate" data-i18n="Preview">Customer Sell Report</span></a>
                    </li>
                    <li><a class="d-flex align-items-center" href="{{ route('admin.winning_report') }}"><i data-feather="circle"></i><span
                                class="menu-item text-truncate" data-i18n="Edit">Winning Report</span></a>
                    </li>
                    <li><a class="d-flex align-items-center" href="{{ route('admin.transfer_point_report') }}"><i data-feather="circle"></i><span
                                class="menu-item text-truncate" data-i18n="Add">Transfer Point Report</span></a></li>
                    <li><a class="d-flex align-items-center" href="{{ route('admin.bid_winning_report') }}"><i data-feather="circle"></i><span
                                class="menu-item text-truncate" data-i18n="Add">Bid Win Report</span></a></li>
                    <li><a class="d-flex align-items-center" href="{{ route('admin.withdraw_report') }}"><i data-feather="circle"></i><span
                                class="menu-item text-truncate" data-i18n="Add">Withdraw Report</span></a></li>
                    <li><a class="d-flex align-items-center" href="{{ route('admin.auto_deposite_history') }}"><i data-feather="circle"></i><span
                                class="menu-item text-truncate" data-i18n="Add">Auto Deposit History</span></a></li>
                    <li><a class="d-flex align-items-center" href="#"><i data-feather="circle"></i><span
                                class="menu-item text-truncate" data-i18n="Add">Reffral History</span></a></li>
                </ul>
            </li>

            <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i
                        data-feather="shield"></i><span class="menu-title text-truncate"
                        data-i18n="Roles &amp; Permission">Wallet Management</span></a>
                <ul class="menu-content">
                    <li><a class="d-flex align-items-center" href="{{ route('admin.money-request') }}"><i data-feather="circle"></i><span
                                class="menu-item text-truncate" data-i18n="Roles">Fund Request</span></a>
                    </li>
                    <li><a class="d-flex align-items-center" href="{{ route('admin.money-request-withdrawal') }}"><i data-feather="circle"></i><span
                                class="menu-item text-truncate" data-i18n="Permission">Withdraw Request</span></a>
                    </li>
                    <li><a class="d-flex align-items-center" href="#"><i data-feather="circle"></i><span
                                class="menu-item text-truncate" data-i18n="Permission" data-bs-target="#add_wallet_amount_sidebar" data-bs-toggle="modal">Add Fund (User
                                Wallet)</span></a>
                                
                                
                                
                                
                                
                                </li>
                    <li><a class="d-flex align-items-center" href="{{ route('admin.bid-revert') }}"><i data-feather="circle"></i><span
                                class="menu-item text-truncate" data-i18n="Permission">Bid Revert</span></a></li>
                </ul>
            </li>
            <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i
                        data-feather="shopping-cart"></i><span class="menu-title text-truncate"
                        data-i18n="eCommerce">Game Management</span></a>
                <ul class="menu-content">
                    <li><a class="d-flex align-items-center" href="{{ route('admin.gamenames.index') }}"><i
                                data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Shop">Game
                                Name</span></a>
                    </li>
                    <li><a class="d-flex align-items-center" href="{{ route('admin.game-rates') }}"><i
                                data-feather="circle"></i><span class="menu-item text-truncate"
                                data-i18n="Details">Game Rates</span></a>
                    </li>
                </ul>
            </li>
            <li
                class="nav-item {{ Request::routeIs('admin.single-digit', 'admin.jodi-digit', 'admin.single-pana', 'admin.double-pana', 'admin.tripple-pana') ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="#"><i data-feather="user"></i><span
                        class="menu-title text-truncate" data-i18n="User">Game Number</span></a>
                <ul class="menu-content">
                    <li class="{{ Request::routeIs('admin.single-digit') ? 'active' : '' }}"><a
                            class="d-flex align-items-center" href="{{ route('admin.single-digit') }}"><i
                                data-feather="circle"></i><span class="menu-item text-truncate"
                                data-i18n="List">Single Digit</span></a></li>
                    <li class="{{ Request::routeIs('admin.jodi-digit') ? 'active' : '' }}"><a
                            class="d-flex align-items-center" href="{{ route('admin.jodi-digit') }}"><i
                                data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">Jodi
                                Digit</span></a></li>
                    <li class="{{ Request::routeIs('admin.single-pana') ? 'active' : '' }}"><a
                            class="d-flex align-items-center" href="{{ route('admin.single-pana') }}"><i
                                data-feather="circle"></i><span class="menu-item text-truncate"
                                data-i18n="List">Single Panna</span></a></li>
                    <li class="{{ Request::routeIs('admin.double-pana') ? 'active' : '' }}"><a
                            class="d-flex align-items-center" href="{{ route('admin.double-pana') }}"><i
                                data-feather="circle"></i><span class="menu-item text-truncate"
                                data-i18n="List">Double Panna</span></a></li>
                    <li class="{{ Request::routeIs('admin.tripple-pana') ? 'active' : '' }}"><a
                            class="d-flex align-items-center" href="{{ route('admin.tripple-pana') }}"><i
                                data-feather="circle"></i><span class="menu-item text-truncate"
                                data-i18n="List">Tripple Panna</span></a></li>
                    <li><a class="d-flex align-items-center" href="{{ route('admin.single-digit') }}"><i
                                data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">Half
                                Sangam</span></a></li>
                    <li><a class="d-flex align-items-center" href="{{ route('admin.single-digit') }}"><i
                                data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">Full
                                Sangam</span></a></li>
                </ul>
            </li>
            <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i
                        data-feather="file-text"></i><span class="menu-title text-truncate"
                        data-i18n="Pages">Settings</span></a>
                <ul class="menu-content">
                    <li><a class="d-flex align-items-center" href="{{ route('admin.main-setting') }}"><i data-feather="circle"></i><span
                                class="menu-item text-truncate" data-i18n="Profile">Main Settings</span></a>
                    </li>
                    <li><a class="d-flex align-items-center" href="{{ route('admin.contact-setting') }}"><i data-feather="circle"></i><span
                                class="menu-item text-truncate" data-i18n="FAQ">Contact Setting</span></a>
                    </li>
                    <li><a class="d-flex align-items-center" href="#"><i data-feather="circle"></i><span
                                class="menu-item text-truncate" data-i18n="Knowledge Base">Clear Data</span></a>
                    </li>
                    <li><a class="d-flex align-items-center" href="#"><i data-feather="circle"></i><span
                                class="menu-item text-truncate" data-i18n="Pricing">Slider Images</span></a>
                    </li>
                    <li><a class="d-flex align-items-center" href="#"><i data-feather="circle"></i><span
                                class="menu-item text-truncate" data-i18n="License">How to Play</span></a>
                    </li>

                </ul>
            </li>

            <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i
                        data-feather="shopping-cart"></i><span class="menu-title text-truncate"
                        data-i18n="eCommerce">Notice Management</span></a>
                <ul class="menu-content">
                    <li><a class="d-flex align-items-center" href="#"><i data-feather="circle"></i><span
                                class="menu-item text-truncate" data-i18n="Shop">Notice Management</span></a>
                    </li>
                    <li><a class="d-flex align-items-center" href="#"><i data-feather="circle"></i><span
                                class="menu-item text-truncate" data-i18n="Details">Send Notification</span></a>
                    </li>
                </ul>
            </li>

            <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i
                        data-feather="user-check"></i><span class="menu-title text-truncate"
                        data-i18n="Authentication">Starline Management</span></a>
                <ul class="menu-content">
                    <li><a class="d-flex align-items-center" href="{{ route('admin.starline.starline_gamenames.index') }}"><i data-feather="circle"></i><span
                                class="menu-item text-truncate" data-i18n="License">Game Name</span></a></li>
                    <li><a class="d-flex align-items-center" href="{{ route('admin.starline.game-rates') }}"><i data-feather="circle"></i><span
                                class="menu-item text-truncate" data-i18n="License">Game Rates</span></a></li>
                    <li><a class="d-flex align-items-center" href="{{ route('admin.starline.user-bid-history') }}"><i data-feather="circle"></i><span
                                class="menu-item text-truncate" data-i18n="License">Bid Hitory</span></a></li>
                    <li><a class="d-flex align-items-center" href="{{ route('admin.starline.declare-result') }}"><i data-feather="circle"></i><span
                                class="menu-item text-truncate" data-i18n="License">Declare Result</span></a></li>
                    <li><a class="d-flex align-items-center" href="#"><i data-feather="circle"></i><span
                                class="menu-item text-truncate" data-i18n="License">Result History</span></a></li>
                    <li><a class="d-flex align-items-center" href="#"><i data-feather="circle"></i><span
                                class="menu-item text-truncate" data-i18n="License">Starline Sell Report</span></a>
                    </li>
                    <li><a class="d-flex align-items-center" href="#"><i data-feather="circle"></i><span
                                class="menu-item text-truncate" data-i18n="License">Starline Winning Report</span></a>
                    </li>
                    <li><a class="d-flex align-items-center" href="#"><i data-feather="circle"></i><span
                                class="menu-item text-truncate" data-i18n="License">Starline Winning
                                Predicition</span></a></li>
                </ul>
            </li>


            <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i
                        data-feather="type"></i><span class="menu-title text-truncate" data-i18n="Typography">User
                        Query</span></a>
            </li>
            <!--<li class=" nav-item"><a class="d-flex align-items-center" href="#"><i-->
            <!--            data-feather="eye"></i><span class="menu-title text-truncate" data-i18n="Feather">Sub Admin-->
            <!--            Management</span></a>-->
            <!--</li>-->

            <!--<li class=" nav-item"><a class="d-flex align-items-center" href="{{ route('admin.money-request') }}"><i-->
            <!--            data-feather="eye"></i><span class="menu-title text-truncate" data-i18n="Feather">Money Request</span></a>-->
            <!--</li>-->


        </ul>
    </div>
</div>

<div class="modal fade modal-success text-start" id="add_wallet_amount_sidebar" tabindex="-1" aria-labelledby="myModalLabel120" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">

                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="myModalLabel120">Add Wallet Amount</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('admin.users.add-wallet') }}" method="post">
                                                        @csrf
                                                        <div class="mb-1">
                                                            <label class="form-label"  for="last-name-column">Select User<span class="error">*</span></label>
                                                            <select class="form-select" name="user_id" id="basicSelect" required>
                                                                <?php $users_data = DB::table('users')->where('role_id','2')->get();  ?>
                                                                @foreach($users_data as $key=>$val)
                                                                <option value="0" {{ (old("status") == '0' ? "selected":"") }}>{{ $val->name }} [ {{ $val->mobile }} ]</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        
                                                        <div class="md-1">
                                                            <label class="form-label"  for="last-name-column">Amount<span class="error">*</span></label>
                                                            <input type="number" name="amount" value="" placeholder="Add Amount" class="form-control" required>
                                                            <input type="hidden" name="type" value="1">
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-success" >Add Amount</button>
                                                        </div>
                                                    </form>
                                                </div>
                                                
                                            </div>
                                    </div>
                                </div>
<!-- END: Main Menu-->
