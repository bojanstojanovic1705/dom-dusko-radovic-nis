@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-subtitle mb-2 text-muted">Ukupno dokumenata</h6>
                        <h2 class="card-title mb-0">{{ App\Models\Document::count() }}</h2>
                    </div>
                    <div class="text-primary">
                        <i class="fas fa-file-pdf fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-subtitle mb-2 text-muted">Javne nabavke</h6>
                        <h2 class="card-title mb-0">{{ App\Models\Document::where('category', 'Javne nabavke')->count() }}</h2>
                    </div>
                    <div class="text-success">
                        <i class="fas fa-file-contract fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-subtitle mb-2 text-muted">Godišnji izveštaji</h6>
                        <h2 class="card-title mb-0">{{ App\Models\Document::where('category', 'Godišnji izveštaji')->count() }}</h2>
                    </div>
                    <div class="text-info">
                        <i class="fas fa-chart-line fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Nedavno dodati dokumenti</h5>
            </div>
            <div class="card-body">
                <div class="list-group list-group-flush">
                    @foreach(App\Models\Document::latest()->take(5)->get() as $document)
                        <div class="list-group-item">
                            <div class="d-flex w-100 justify-content-between">
                                <h6 class="mb-1">{{ $document->title }}</h6>
                                <small class="text-muted">{{ $document->created_at->diffForHumans() }}</small>
                            </div>
                            <p class="mb-1">{{ $document->category }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Brze akcije</h5>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="#" class="btn btn-primary">
                        <i class="fas fa-plus-circle me-2"></i>
                        Dodaj novi dokument
                    </a>
                    <a href="#" class="btn btn-outline-primary">
                        <i class="fas fa-cog me-2"></i>
                        Upravljaj dokumentima
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
