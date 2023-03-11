<nav class="navbar navbar-expand-lg fixed-top shadow">
    <div class="container-fluid" id="navbar-main">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a href="{{ route('admin.dashboard') }}" class="navbar-brand">OLAISA LAUNDRY</a>
        <div class="collapse navbar-collapse" id="navbar">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <button class="nav-link btn btn-primary offcanvas-btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvas" aria-controls="offcanvas"><i class="fa-solid fa-bars"></i></button>
                </li>
            </ul>
            
            <ul class="navbar-nav">
                <li class="nav-item">
                    <div class="nav-link dropdown">
                        <button class="dropdown-toggle btn btn-secondary" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </button>
                        <ul class="dropdown-menu">
                            <li><a href="{{ route('logout') }}" class="dropdown-item text-danger"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fa-solid fa-arrow-right-from-bracket me-2"></i>Logout</a></li>
                            <form action="{{ route('logout') }}" method="post" id="logout-form" class="d-none">
                                @csrf
                            </form>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="offcanvas" aria-labelledby="offcanvas">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvas-label">Admin Dashboard</h5>
        <button class="btn-close" type="button" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body d-flex flex-column">
        <a href="{{ route('outlets.index') }}" class="btn btn-secondary mb-2">Outlets</a>
        <a href="{{ route('users.index') }}" class="btn btn-secondary mb-2">Users</a>
        <a href="{{ route('members.index') }}" class="btn btn-secondary mb-2">Members</a>
        <a href="{{ route('packages.index') }}" class="btn btn-secondary mb-2">Packages</a>
        <a href="{{ route('transactions.index') }}" class="btn btn-secondary mb-2">Transactions</a>
        <a href="{{ route('transaction.report') }}" class="btn btn-secondary mb-2">Transaction Report</a>
    </div>
</div>