<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bible Verse Searcher — Cloud Activity</title>
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .navbar-brand { font-weight: 700; letter-spacing: 0.05em; }
        .card { border: none; box-shadow: 0 1px 4px rgba(0,0,0,.08); }
        .badge-ot { background-color: #6f42c1; }
        .badge-nt { background-color: #0d6efd; }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
    <div class="container">
        <a class="navbar-brand" href="{{ route('verses.index') }}">✝ Bible Verse Searcher</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('verses.index') ? 'active' : '' }}"
                       href="{{ route('verses.index') }}">📖 Verses</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('verses.create') ? 'active' : '' }}"
                       href="{{ route('verses.create') }}">➕ Add Verse</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container pb-5">

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
