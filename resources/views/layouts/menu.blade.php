<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="main-menu-content">
        
        
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <!-- <li class=" navigation-header"><span>General</span><i class=" ft-minus" data-toggle="tooltip" data-placement="right" data-original-title="General"></i>
            </li>-->
            <li class=" nav-item" id="dmenu">
                <a href="{{ route('dashboard') }}">
                    <i class="ft-home"></i><span class="menu-title" data-i18n="">Dashboard</span>
                    <!--<span class="badge badge badge-primary badge-pill float-right mr-2">3</span>-->
                </a>
            </li>
            

            <li class="nav-item" id="pmenu">
                <a href="#">
                <i class="ft-bar-chart"></i><span class="menu-title" data-i18n="">Sales</span></a>
                <ul class="menu-content">
                    <li id="p"><a class="menu-item" href="{{route('products')}}">Product</a></li>
                    <li id="inv"><a class="menu-item" href="{{route('invoices')}}">Invoice</a></li>
                </ul>
            </li>
            
            
            
            <li class="nav-item"><a href="#">
                <i class="ft-users"></i><span class="menu-title" data-i18n="">Customers</span></a>
                <ul class="menu-content">
                    <li id="cst"><a class="menu-item" href="{{route('customers')}}">Active Customers</a></li>
                    <li id="cst"><a class="menu-item" href="{{route('inactiveCustomers')}}">Inactive Customers</a></li>
                </ul>
            </li>
            <li class="nav-item"><a href="#">
                <i class="ft-users"></i><span class="menu-title" data-i18n="">Expenses</span></a>
                <ul class="menu-content">
                    <li id="p"><a class="menu-item" href="{{ route('suppliers') }}">Suppliers</a></li>
                    <li id="inv"><a class="menu-item" href="{{ route('expenses') }}">Expense</a></li>
                </ul>
            </li>
            <li class="nav-item"><a href="#">
                <i class="ft-credit-card"></i><span class="menu-title" data-i18n="">Accounting</span></a>
                <ul class="menu-content">
                    <li><a class="menu-item" href="{{ route('account') }}">Accounts</a></li>
                    <li><a class="menu-item" href="{{ route('general.ledger')}}">General Ledger Report</a></li>
                    {{-- <li><a class="menu-item" href="#">Purchase 3</a></li> --}}
                </ul>
            </li>
            
            {{-- <li class="nav-item">
                <a href="#">
                    <i class="ft-briefcase"></i><span class="menu-title" data-i18n="">Banking</span>
                </a>
                <ul class="menu-content">
                    <li><a class="menu-item" href="#">Purchase 1</a></li>
                    <li><a class="menu-item" href="#">Purchase 2</a></li>
                    <li><a class="menu-item" href="#">Purchase 3</a></li>
                </ul>
            </li> --}}
            
            
            <li class="nav-item" id="pmenu">
                <a href="#"><i class="ft-mail"></i><span class="menu-title" data-i18n="">Collections</span></a>
                <ul class="menu-content">
                    <li><a class="menu-item" href="{{route('emailtemplate.index')}}">Email Templates</a></li>
                </ul>
            </li>


            <li class=" nav-item" id="set">
                {{-- <a href="{{route('setting')}}">
                    <i class="ft-settings"></i><span class="menu-title" data-i18n="">Settings</span>
                    <!--<span class="badge badge badge-primary badge-pill float-right mr-2">3</span>-->
                </a> --}}
                <a href="#">
                    <i class="ft-settings"></i><span class="menu-title" data-i18n="">Settings</span>
                </a>
                <ul class="menu-content">
                    <li><a class="menu-item" href="{{route('tax.setup')}}">Tax Setup</a></li>
                    <li><a class="menu-item" href="{{route('invoice.setup')}}">Invoice setup</a></li>
                    <li><a class="menu-item" href="{{route('company.setup')}}">Company setup</a></li>
                    <li><a class="menu-item" href="{{route('smtp.setup')}}">SMTP setup</a></li>
                </ul>
            </li>

        </ul>
    </div>
</div>