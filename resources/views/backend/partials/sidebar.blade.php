<!-- BEGIN: Main Menu-->
<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item me-auto">
                <a class="navbar-brand"href="{{ route('admin.') }}">
                    <img src="{{ asset('public/logo.png') }}" alt="" style="width: 100%;
                    /* height: 100%; */
                    height: 37px;">
                      
                    {{-- <h2 class="brand-text">SatkaMatka</h2> --}}
                </a></li>
            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pe-0" data-bs-toggle="collapse"><i
                        class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i
                        class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc"
                        data-ticon="disc"></i></a></li>
        </ul>
    </div>
    <!--<div class="shadow-bottom"></div>-->
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            
            
            
            
            <li class=" nav-item {{ Request::routeIs('admin.dashboard') ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{ route('admin.dashboard') }}"><i data-feather="home"></i><span class="menu-title text-truncate" data-i18n="Dashboards">Dashboards</span><span class="badge badge-light-warning rounded-pill ms-auto me-1"></span></a>
                
            </li>
            
            <li class=" nav-item {{ Request::routeIs('admin.users.index','admin.users.create','admin.users.unapproved','admin.users.show') ? 'active' : '' }} ">
                <a class="d-flex align-items-center" href="{{ route('admin.users.index') }}"><i
                        data-feather="users"></i><span class="menu-title text-truncate" data-i18n="User">User
                        Management</span>
                </a>
            </li>
            <li class=" nav-item {{ Request::routeIs('admin.declare-result') ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{ route('admin.declare-result') }}"><i
                        data-feather="message-square"></i><span class="menu-title text-truncate"
                        data-i18n="Chat">Declare Result</span></a>
            </li>
            <li class=" nav-item {{ Request::routeIs('admin.winning-predictions') ? 'active' : '' }}">
                <a class="d-flex align-items-center"
                    href="{{ route('admin.winning-predictions') }}"><i data-feather="check-square"></i><span
                        class="menu-title text-truncate" data-i18n="Todo">Winning Predicition</span>
                </a>
            </li>
            
            <li class=" nav-item  {{ Request::routeIs('admin.user-bid-history','admin.customer_sell_report','admin.winning_report','admin.transfer_point_report','admin.bid_winning_report','admin.withdraw_report','admin.auto_deposite_history') ? 'has-sub open' : '' }}">
                <a class="d-flex align-items-center" href="#"><i
                        data-feather="file-text"></i><span class="menu-title text-truncate"
                        data-i18n="Invoice">Report Management</span></a>
                <ul class="menu-content">
                    <li ><a class="d-flex align-items-center {{ Request::routeIs('admin.user-bid-history') ? 'active' : '' }} " href="{{ route('admin.user-bid-history') }}"><i data-feather="circle"></i><span
                                class="menu-item text-truncate" data-i18n="List">User Bid History </span></a>
                    </li>
                    <li><a class="d-flex align-items-center {{ Request::routeIs('admin.customer_sell_report') ? 'active' : '' }}" href="{{ route('admin.customer_sell_report') }}"><i data-feather="circle"></i><span
                                class="menu-item text-truncate" data-i18n="Preview">Customer Sell Report</span></a>
                    </li>
                    <li><a class="d-flex align-items-center {{ Request::routeIs('admin.winning_report') ? 'active' : '' }}" href="{{ route('admin.winning_report') }}"><i data-feather="circle"></i><span
                                class="menu-item text-truncate" data-i18n="Edit">Winning Report</span></a>
                    </li>
                    <li><a class="d-flex align-items-center {{ Request::routeIs('admin.transfer_point_report') ? 'active' : '' }} " href="{{ route('admin.transfer_point_report') }}"><i data-feather="circle"></i><span
                                class="menu-item text-truncate" data-i18n="Add">Transfer Point Report</span></a>
                    </li>
                    <li><a class="d-flex align-items-center {{ Request::routeIs('admin.bid_winning_report') ? 'active' : '' }}"  href="{{ route('admin.bid_winning_report') }}"><i data-feather="circle"></i><span
                                class="menu-item text-truncate" data-i18n="Add">Bid Win Report</span></a></li>
                    <li><a class="d-flex align-items-center {{ Request::routeIs('admin.withdraw_report') ? 'active' : '' }}" href="{{ route('admin.withdraw_report') }}"><i data-feather="circle"></i><span
                                class="menu-item text-truncate" data-i18n="Add">Withdraw Report</span></a></li>
                    <!--<li><a class="d-flex align-items-center {{ Request::routeIs('admin.auto_deposite_history') ? 'active' : '' }}" href="{{ route('admin.auto_deposite_history') }}"><i data-feather="circle"></i><span-->
                    <!--            class="menu-item text-truncate" data-i18n="Add">Auto Deposit History</span></a></li>-->
                    
                </ul>
            </li>

            <li class=" nav-item {{ Request::routeIs('admin.money-request','admin.money-request-withdrawal','admin.bid-revert') ? 'has-sub open' : '' }}"><a class="d-flex align-items-center" href="#"><i
                        data-feather="shield"></i><span class="menu-title text-truncate"
                        data-i18n="Roles &amp; Permission">Wallet Management</span></a>
                <ul class="menu-content">
                    <li><a class="d-flex align-items-center {{ Request::routeIs('admin.money-request') ? 'active' : '' }}" href="{{ route('admin.money-request') }}"><i data-feather="circle"></i><span
                                class="menu-item text-truncate" data-i18n="Roles">Fund Request</span></a>
                    </li>
                    <li><a class="d-flex align-items-center {{ Request::routeIs('admin.money-request-withdrawal') ? 'active' : '' }}" href="{{ route('admin.money-request-withdrawal') }}"><i data-feather="circle"></i><span
                                class="menu-item text-truncate" data-i18n="Permission">Withdraw Request</span></a>
                    </li>
                    <li><a class="d-flex align-items-center" href="#"><i data-feather="circle"></i><span
                                class="menu-item text-truncate" data-i18n="Permission" data-bs-target="#add_wallet_amount_sidebar" data-bs-toggle="modal">Add Fund (User
                                Wallet)</span></a>
                                </li>
                    <li><a class="d-flex align-items-center {{ Request::routeIs('admin.bid-revert') ? 'active' : '' }}" href="{{ route('admin.bid-revert') }}"><i data-feather="circle"></i><span
                                class="menu-item text-truncate" data-i18n="Permission">Bid Revert</span></a></li>
                </ul>
            </li>
            
            
                <li class=" nav-item {{ Request::routeIs('admin.gamenames.index','admin.game-rates') ? 'has-sub open' : '' }}"><a class="d-flex align-items-center" href="#"><i
                        data-feather="shopping-cart"></i><span class="menu-title text-truncate"
                        data-i18n="eCommerce">Game Management</span></a>
                <ul class="menu-content">
                    <li><a class="d-flex align-items-center {{ Request::routeIs('admin.gamenames.index') ? 'active' : '' }}" href="{{ route('admin.gamenames.index') }}"><i
                                data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Shop">Game
                                Name</span></a>
                    </li>
                    <li><a class="d-flex align-items-center {{ Request::routeIs('admin.game-rates') ? 'active' : '' }}" href="{{ route('admin.game-rates') }}"><i
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
                    <li><a class="d-flex align-items-center" href="#"><i
                                data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">Half
                                Sangam</span></a></li>
                    <li><a class="d-flex align-items-center" href="#"><i
                                data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">Full
                                Sangam</span></a></li>
                </ul>
            </li>
            <li class=" nav-item {{ Request::routeIs('admin.main-setting','admin.contact-setting','admin.slider-list','admin.how-to-play','rules_noticeboard') ? 'has-sub open' : '' }} "><a class="d-flex align-items-center" href="#"><i
                        data-feather="file-text"></i><span class="menu-title text-truncate"
                        data-i18n="Pages">Settings</span></a>
                <ul class="menu-content">
                    <li><a class="d-flex align-items-center {{ Request::routeIs('admin.main-setting') ? 'active' : '' }} " href="{{ route('admin.main-setting') }}"><i data-feather="circle"></i><span
                                class="menu-item text-truncate" data-i18n="Profile">Main Settings</span></a>
                    </li>
                    
                    <li><a class="d-flex align-items-center {{ Request::routeIs('admin.contact-setting') ? 'active' : '' }}" href="{{ route('admin.contact-setting') }}"><i data-feather="circle"></i><span
                                class="menu-item text-truncate" data-i18n="FAQ">Contact Setting</span></a>
                    </li>
                    <li><a class="d-flex align-items-center" href="#"><i data-feather="circle"></i><span
                                class="menu-item text-truncate" data-i18n="Knowledge Base">Clear Data</span></a>
                    </li>
                    <li><a class="d-flex align-items-center {{ Request::routeIs('admin.slider-list') ? 'active' : '' }}" href="{{ route('admin.slider-list') }}"><i data-feather="circle"></i><span
                                class="menu-item text-truncate" data-i18n="Pricing">Slider Images</span></a>
                    </li>
                    <li><a class="d-flex align-items-center {{ Request::routeIs('admin.how-to-play') ? 'active' : '' }}" href="{{ route('admin.how-to-play') }}"><i data-feather="circle"></i><span
                                class="menu-item text-truncate" data-i18n="License">How to Play</span></a>
                    </li>
                    <li><a class="d-flex align-items-center {{ Request::routeIs('admin.rules_noticeboard') ? 'active' : '' }}" href="{{ route('admin.rules_noticeboard') }}"><i data-feather="circle"></i><span
                                class="menu-item text-truncate" data-i18n="License">Rules and notice board</span></a>
                    </li>

                </ul>
            </li>

            <li class=" nav-item {{ Request::routeIs('admin.notice-management') ? 'has-sub open' : '' }}"><a class="d-flex align-items-center" href="#"><i
                        data-feather="shopping-cart"></i><span class="menu-title text-truncate"
                        data-i18n="eCommerce">Notice Management</span></a>
                <ul class="menu-content">
                    <li><a class="d-flex align-items-center {{ Request::routeIs('admin.notice-management') ? 'active' : '' }}" href="{{route('admin.notice-management')}}"><i data-feather="circle"></i><span
                                class="menu-item text-truncate" data-i18n="Shop">Notice Management</span></a>
                    </li>
                </ul>
            </li>

            <li class=" nav-item  {{ Request::routeIs('admin.starline.starline_gamenames.index','admin.starline.game-rates','admin.starline.user-bid-history','admin.starline.declare-result','admin.starline.result-history','admin.starline.sell-report','admin.starline.winning-report','admin.starline.winning-predecting') ? 'has-sub open' : '' }}  "><a class="d-flex align-items-center" href="#"><i
                        data-feather="user-check"></i><span class="menu-title text-truncate"
                        data-i18n="Authentication">Starline Management</span></a>
                <ul class="menu-content">
                    <li><a class="d-flex align-items-center {{ Request::routeIs('admin.starline.starline_gamenames.index') ? 'active' : '' }}" href="{{ route('admin.starline.starline_gamenames.index') }}"><i data-feather="circle"></i><span
                                class="menu-item text-truncate" data-i18n="License">Game Name</span></a></li>
                    <li><a class="d-flex align-items-center {{ Request::routeIs('admin.starline.game-rates') ? 'active' : '' }}" href="{{ route('admin.starline.game-rates') }}"><i data-feather="circle"></i><span
                                class="menu-item text-truncate" data-i18n="License">Game Rates</span></a></li>
                    <li><a class="d-flex align-items-center {{ Request::routeIs('admin.starline.user-bid-history') ? 'active' : '' }}" href="{{ route('admin.starline.user-bid-history') }}"><i data-feather="circle"></i><span
                                class="menu-item text-truncate" data-i18n="License">Bid Hitory</span></a></li>
                    <li><a class="d-flex align-items-center  {{ Request::routeIs('admin.starline.declare-result') ? 'active' : '' }}" href="{{ route('admin.starline.declare-result') }}"><i data-feather="circle"></i><span
                                class="menu-item text-truncate" data-i18n="License">Declare Result</span></a></li>
                    <li><a class="d-flex align-items-center {{ Request::routeIs('admin.starline.result-history') ? 'active' : '' }}" href="{{ route('admin.starline.result-history') }}"><i data-feather="circle"></i><span
                                class="menu-item text-truncate" data-i18n="License">Result History</span></a></li>
                    <li><a class="d-flex align-items-center {{ Request::routeIs('admin.starline.sell-report') ? 'active' : '' }}" href="{{ route('admin.starline.sell-report') }}"><i data-feather="circle"></i><span
                                class="menu-item text-truncate" data-i18n="License">Starline Sell Report</span></a>
                    </li>
                    <li><a class="d-flex align-items-center {{ Request::routeIs('admin.starline.winning-report') ? 'active' : '' }}" href="{{ route('admin.starline.winning-report') }}"><i data-feather="circle"></i><span
                                class="menu-item text-truncate" data-i18n="License">Starline Winning Report</span></a>
                    </li>
                    <li><a class="d-flex align-items-center {{ Request::routeIs('admin.starline.winning-predecting') ? 'active' : '' }}" href="{{ route('admin.starline.winning-predecting') }}"><i data-feather="circle"></i><span
                                class="menu-item text-truncate" data-i18n="License">Starline Winning
                                Predicition</span></a></li>
                </ul>
            </li>
            
            <li class=" nav-item {{ Request::routeIs('admin.top_players.index') ? 'has-sub open' : '' }}"><a class="d-flex align-items-center" href="#"><i
                        data-feather="user-check"></i><span class="menu-title text-truncate"
                        data-i18n="Authentication">Top Players</span></a>
                <ul class="menu-content">
                    <li><a class="d-flex align-items-center {{ Request::routeIs('admin.top_players.index') ? 'active' : '' }}" href="{{ route('admin.top_players.index') }}"><i data-feather="circle"></i><span
                                class="menu-item text-truncate" data-i18n="License">List</span></a></li>
                    
                    
                </ul>
            </li>


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
                                                            <select class=" select2 form-select " name="user_id" id="jgkygkhgjgvh" required>
                                                                <option>(select)</option>
                                                                <?php $users_data = DB::table('users')->where('role_id','2')->get();  ?>
                                                                @foreach($users_data as $key=>$val)
                                                                <option value="{{ $val->id }}" {{ (old("status") == '0' ? "selected":"") }}>{{ $val->name }} [ {{ $val->mobile }} ]</option>
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
