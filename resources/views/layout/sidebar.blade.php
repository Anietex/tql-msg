<div class="sidebar-wrapper">
    <ul class="nav">
        @can('manage-admins')
            <li>
                <a href="{{route('admins.list')}}">
                    <i class="nc-icon nc-pin-3"></i>
                    <p>Admins</p>
                </a>
            </li>
        @endcan
        @can('manage-companies')
            <li>
                <a href="{{route('companies.list')}}">
                    <i class="nc-icon nc-bank"></i>
                    <p>Companies</p>
                </a>
            </li>
        @endcan
        @can('manage-employees')
            <li>
                <a href="{{route('employees.list')}}">
                    <i class="nc-icon nc-diamond"></i>
                    <p>Employees</p>
                </a>
            </li>
        @endcan

    </ul>
</div>
