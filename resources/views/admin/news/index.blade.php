@extends('admin.layouts.app')

@section('title', 'Upravljanje vestima')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Lista vesti</h5>
        <a href="{{ route('admin.news.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Dodaj novu vest
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Naslov</th>
                        <th>Datum</th>
                        <th>Status</th>
                        <th>Slike</th>
                        <th>Akcije</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($news as $item)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    @if($item->is_featured)
                                        <i class="fas fa-star text-warning me-2" title="Istaknuta vest"></i>
                                    @endif
                                    {{ $item->title }}
                                </div>
                            </td>
                            <td>{{ $item->created_at->format('d.m.Y.') }}</td>
                            <td>
                                @if($item->is_featured)
                                    <span class="badge bg-warning">Istaknuta</span>
                                @else
                                    <span class="badge bg-secondary">Standardna</span>
                                @endif
                            </td>
                            <td>
                                <span class="badge bg-info">{{ $item->images->count() }}</span>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('news.show', $item->slug) }}" 
                                       class="btn btn-sm btn-outline-primary" 
                                       target="_blank">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.news.edit', $item) }}" 
                                       class="btn btn-sm btn-outline-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button type="button" 
                                            class="btn btn-sm btn-outline-danger" 
                                            onclick="confirmDelete({{ $item->id }})">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                                <form id="delete-form-{{ $item->id }}" 
                                      action="{{ route('admin.news.destroy', $item) }}" 
                                      method="POST" 
                                      class="d-none">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4">
                                <div class="text-muted">
                                    <i class="fas fa-newspaper fa-2x mb-3"></i>
                                    <p class="mb-0">Nema dodatih vesti</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $news->links() }}
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function confirmDelete(id) {
    if (confirm('Da li ste sigurni da želite da obrišete ovu vest?')) {
        document.getElementById('delete-form-' + id).submit();
    }
}
</script>
@endpush
