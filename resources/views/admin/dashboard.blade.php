@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>

    <!-- Statistika kartice -->
    <div class="row">
        <!-- Vesti statistika -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Ukupno vesti</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['news']['total'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-newspaper fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Istaknute vesti statistika -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Istaknute vesti</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['news']['featured'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-star fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Zaposleni statistika -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Ukupno zaposlenih</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['employees']['total'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Aktivni zaposleni statistika -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Aktivni zaposleni</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['employees']['active'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-check fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Sadržaj redovi -->
    <div class="row">
        <!-- Najnovije vesti -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Najnovije vesti</h6>
                    <a href="{{ route('admin.news.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> Nova vest
                    </a>
                </div>
                <div class="card-body">
                    <div class="list-group list-group-flush">
                        @forelse($stats['news']['latest'] as $news)
                            <div class="list-group-item px-0">
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-1">{{ $news->title }}</h6>
                                    <small>{{ $news->created_at->format('d.m.Y.') }}</small>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <small class="text-muted">
                                        @if($news->is_featured)
                                            <span class="badge badge-success">Istaknuto</span>
                                        @endif
                                    </small>
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('admin.news.edit', $news) }}" class="btn btn-primary">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-3">
                                <p class="text-muted mb-0">Nema dodatih vesti</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <!-- Najnoviji zaposleni -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Najnoviji zaposleni</h6>
                    <a href="{{ route('admin.employees.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> Novi zaposleni
                    </a>
                </div>
                <div class="card-body">
                    <div class="list-group list-group-flush">
                        @forelse($stats['employees']['latest'] as $employee)
                            <div class="list-group-item px-0">
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-1">{{ $employee->name }}</h6>
                                    <small>{{ $employee->created_at->format('d.m.Y.') }}</small>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <small class="text-muted">
                                        {{ $employee->position }}
                                        @if(!$employee->is_active)
                                            <span class="badge badge-danger">Neaktivan</span>
                                        @endif
                                    </small>
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('admin.employees.edit', $employee) }}" class="btn btn-primary">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-3">
                                <p class="text-muted mb-0">Nema dodatih zaposlenih</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
