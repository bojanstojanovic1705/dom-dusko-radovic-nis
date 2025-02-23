@extends('admin.layouts.app')

@section('title', 'Zaposleni')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0">Lista zaposlenih</h1>
    <a href="{{ route('admin.employees.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Dodaj zaposlenog
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th width="80">Slika</th>
                        <th>Ime</th>
                        <th>Pozicija</th>
                        <th>Email</th>
                        <th>Telefon</th>
                        <th width="100">Redosled</th>
                        <th width="100">Status</th>
                        <th width="150">Akcije</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($employees as $employee)
                        <tr>
                            <td>
                                @if($employee->image)
                                    <img src="{{ asset('storage/' . $employee->image) }}" 
                                         alt="{{ $employee->name }}" 
                                         class="img-thumbnail"
                                         style="width: 50px; height: 50px; object-fit: cover;">
                                @else
                                    <div class="bg-secondary text-white d-flex align-items-center justify-content-center" 
                                         style="width: 50px; height: 50px;">
                                        <i class="fas fa-user"></i>
                                    </div>
                                @endif
                            </td>
                            <td>{{ $employee->name }}</td>
                            <td>{{ $employee->position }}</td>
                            <td>{{ $employee->email ?: '-' }}</td>
                            <td>{{ $employee->phone ?: '-' }}</td>
                            <td>{{ $employee->sort_order }}</td>
                            <td>
                                @if($employee->is_active)
                                    <span class="badge bg-success">Aktivan</span>
                                @else
                                    <span class="badge bg-danger">Neaktivan</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('admin.employees.edit', $employee) }}" 
                                       class="btn btn-primary"
                                       title="Izmeni">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button type="button" 
                                            class="btn btn-danger" 
                                            onclick="deleteEmployee({{ $employee->id }})"
                                            title="Obriši">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                                <form id="delete-form-{{ $employee->id }}" 
                                      action="{{ route('admin.employees.destroy', $employee) }}" 
                                      method="POST" 
                                      style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-4">
                                <div class="text-muted">
                                    <i class="fas fa-info-circle me-1"></i>
                                    Nema dodatih zaposlenih
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $employees->links() }}
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function deleteEmployee(id) {
    if (confirm('Da li ste sigurni da želite da obrišete ovog zaposlenog?')) {
        document.getElementById('delete-form-' + id).submit();
    }
}
</script>
@endpush
