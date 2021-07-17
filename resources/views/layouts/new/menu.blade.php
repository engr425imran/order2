     
<?php 
//hinalilaram
$role = auth()->user()->roles[0]->name;  //dd($role);
?>
    
     
     <div class="container">
        <div class="nav-bottom">
          <ul class="navbar-nav">
            <li class="nav-item dropdown active">
              <a href="{{ route('home') }}" class="nav-link count-indicator dropdown-toggle" id="dashboard-dropdown">
                <span class="badge badge-success ml-1">Ctrl.</span>Center
              </a> 
            </li>
            
            <!--<li class="nav-item dropdown">
              <a class="nav-link count-indicator dropdown-toggle" id="finance-dropdown" href="#" data-toggle="dropdown">
                Sales
              </a>
              <div class="dropdown-menu dropdown-left navbar-dropdown" aria-labelledby="finance-dropdown">
                <ul>
                  <li class="dropdown-item"><a href="{{route('products')}}" class="dropdown-link">Product</a></li>
                  <li class="dropdown-item"><a href="{{route('invoices')}}" class="dropdown-link">Invoice</a></li>
                  <li class="dropdown-item"><a href="{{route('customers')}}" class="dropdown-link">Customers</a></li>
                </ul>
              </div>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link count-indicator dropdown-toggle" id="project-dropdown" href="#" data-toggle="dropdown">
                Expenses
              </a>
              <div class="dropdown-menu dropdown-left navbar-dropdown" aria-labelledby="project-dropdown">
                <ul>
                  <li class="dropdown-item"><a href="{{ route('suppliers') }}" class="dropdown-link">Suppliers</a></li>
                  <li class="dropdown-item"><a href="{{ route('expenses') }}" class="dropdown-link">Expense</a></li>
                </ul>
              </div>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link count-indicator dropdown-toggle" id="hr-dropdown" href="#" data-toggle="dropdown">
                Accounting
              </a>
              <div class="dropdown-menu dropdown-left navbar-dropdown" aria-labelledby="hr-dropdown">
                <ul>
                  <li class="dropdown-item"><a href="{{ route('account') }}" class="dropdown-link">Accounts</a></li>
                  <li class="dropdown-item"><a href="{{ route('general.ledger')}}" class="dropdown-link">General Ledger Report</a></li>
                </ul>
              </div>
            </li>
            <li class="nav-item dropdown">
				<a class="nav-link count-indicator dropdown-toggle" id="hr-dropdown" href="#" data-toggle="dropdown">
					Banking
				</a>
				<div class="dropdown-menu dropdown-left navbar-dropdown" aria-labelledby="hr-dropdown">
					<ul>
						<li class="dropdown-item">
							<a href="{{ route('bankCat')}}" class="dropdown-link">Bank Category</a>
							
						</li>
						<li class="dropdown-item"><a href="{{ route('bankList')}}" class="dropdown-link">List of Bank</a></li>
						<li class="dropdown-item"><a href="{{ route('bank_transaction')}}" class="dropdown-link">Transactions</a></li>
					</ul>
				</div>
            </li> -->
          
            <li class="nav-item dropdown">
              <a class="nav-link count-indicator dropdown-toggle" id="revenue-dropdown" href="#" data-toggle="dropdown">
                Employees
              </a>
              <div class="dropdown-menu dropdown-left navbar-dropdown" aria-labelledby="revenue-dropdown">
                <ul>
                  <li class="dropdown-item"><a href="{{ route('employee')}}" class="dropdown-link">View Employees</a></li>
                  <li class="dropdown-item"><a href="{{ route('details')}}" class="dropdown-link">Employee Details</a></li>
                  <li class="dropdown-item"><a href="{{ route('pays')}}" class="dropdown-link">Pay period</a></li>
                       
               @if($role == "Employee")
                  <li class="dropdown-item"><a href="{{ route('leaves')}}" class="dropdown-link">Leave Form</a></li>
              @endif
                </ul>
              </div>
            </li>
            <!--<li class="nav-item dropdown">
              <a class="nav-link count-indicator dropdown-toggle" id="revenue-dropdown" href="#" data-toggle="dropdown">
                Collections
              </a>
              <div class="dropdown-menu dropdown-left navbar-dropdown" aria-labelledby="revenue-dropdown">
                <ul>
                  <li class="dropdown-item"><a href="{{route('emailtemplate.index')}}" class="dropdown-link">Email Templates</a></li>
                  <li class="dropdown-item"><a href="{{route('emailschedules.index')}}" class="dropdown-link">Email Schedules</a></li>
                  
                </ul>
              </div>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link count-indicator dropdown-toggle" id="revenue-dropdown" href="#" data-toggle="dropdown">
                Insights
              </a>
              <div class="dropdown-menu dropdown-left navbar-dropdown" aria-labelledby="revenue-dropdown">
                <ul>
                  <li class="dropdown-item"><a href="{{route('budget.variance')}}" class="dropdown-link">Budget variance</a></li>
                </ul>
              </div>
            </li> -->
            <li class="nav-item dropdown">
              <a class="nav-link count-indicator dropdown-toggle" id="revenue-dropdown" href="#" data-toggle="dropdown">
                Settings
              </a>
              <div class="dropdown-menu dropdown-left navbar-dropdown" aria-labelledby="revenue-dropdown">
                <ul>
                  <!--<li class="dropdown-item"><a href="{{route('tax.setup')}}" class="dropdown-link">Tax Setup</a></li>
                  <li class="dropdown-item"><a href="{{route('invoice.setup')}}" class="dropdown-link">Invoice Setup</a></li> -->
                  <li class="dropdown-item"><a href="{{route('company.setup')}}" class="dropdown-link">Company Setup</a></li>
                 <!-- <li class="dropdown-item"><a href="{{route('smtp.setup')}}" class="dropdown-link">SMTP Setup</a></li> -->
                </ul>
              </div>
            </li>
          </ul>
          
        </div>
      </div>
  