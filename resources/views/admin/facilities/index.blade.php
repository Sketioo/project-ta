@extends('layouts.app')

@section('title', 'Manajemen Fasilitas')

@section('content')
<div class="container-fluid">
    <div class="row">
        @include('components.sidebar')

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Manajemen Fasilitas</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <a href="{{ route('admin.facilities.create') }}" class="btn btn-success">
                        <i class="fas fa-plus"></i> Tambah Fasilitas
                    </a>
                </div>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Foto Utama</th>
                            <th scope="col">Nama Fasilitas</th>
                            <th scope="col">Penanggung Jawab</th>
                            <th scope="col">Jumlah Foto</th>
                            <th scope="col" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($facilities as $facility)
                        <tr>
                            <th scope="row">{{ $loop->iteration + $facilities->firstItem() - 1 }}</th>
                            <td>
                                @if($facility->photos->isNotEmpty())
                                    <img src="{{ asset('storage/' . $facility->photos->first()->photo_path) }}" alt="{{ $facility->name }}" width="100" class="img-thumbnail">
                                @else
                                    <span class="text-muted">Tidak ada foto</span>
                                @endif
                            </td>
                            <td>{{ $facility->name }}</td>
                            <td>{{ $facility->person_in_charge ?? '-' }}</td>
                            <td><span class="badge bg-secondary">{{ $facility->photos->count() }}</span></td>
                            <td class="text-center">
                                <a href="{{ route('admin.facilities.edit', $facility->id) }}" class="btn btn-primary btn-sm" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.facilities.destroy', $facility->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus fasilitas ini? Semua foto yang terkait akan dihapus.');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">Tidak ada data fasilitas.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center">
                {{ $facilities->links() }}
            </div>
        </main>
    </div>
</div>
@endsection
