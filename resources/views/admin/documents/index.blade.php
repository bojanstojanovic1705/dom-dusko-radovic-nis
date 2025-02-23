@extends('admin.layouts.app')

@section('title', 'Upravljanje dokumentima')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Lista dokumenata</h5>
        <a href="{{ route('admin.documents.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Dodaj novi
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Naslov</th>
                        <th>Kategorija</th>
                        <th>Redosled</th>
                        <th>Status</th>
                        <th>Datum</th>
                        <th>Akcije</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($documents as $document)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <i class="far fa-file-pdf text-danger me-2"></i>
                                    {{ $document->title }}
                                </div>
                            </td>
                            <td>
                                <span class="badge bg-info">{{ $document->category }}</span>
                            </td>
                            <td>{{ $document->display_order }}</td>
                            <td>
                                @if($document->is_public)
                                    <span class="badge bg-success">Javno</span>
                                @else
                                    <span class="badge bg-warning">Skriveno</span>
                                @endif
                            </td>
                            <td>{{ $document->created_at->format('d.m.Y.') }}</td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ asset('storage/' . $document->file_path) }}" 
                                       class="btn btn-sm btn-outline-primary" 
                                       target="_blank">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.documents.edit', $document) }}" 
                                       class="btn btn-sm btn-outline-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button type="button" 
                                            class="btn btn-sm btn-outline-danger" 
                                            onclick="confirmDelete({{ $document->id }})">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                                <form id="delete-form-{{ $document->id }}" 
                                      action="{{ route('admin.documents.destroy', $document) }}" 
                                      method="POST" 
                                      class="d-none">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4">
                                <div class="text-muted">
                                    <i class="fas fa-folder-open fa-2x mb-3"></i>
                                    <p class="mb-0">Nema dodatih dokumenata</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function confirmDelete(id) {
    if (confirm('Da li ste sigurni da želite da obrišete ovaj dokument?')) {
        document.getElementById('delete-form-' + id).submit();
    }
}
</script>
@endpush
