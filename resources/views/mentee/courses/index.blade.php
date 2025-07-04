@extends('mentee.layout')

@section('content')
<h1 class="text-3xl font-bold text-slate-800 mb-8">Kursus Saya</h1>

<div class="space-y-10">
    {{-- Loop utama untuk setiap data Pertemuan --}}
    @forelse($meetings as $pertemuan)
        {{-- Hanya tampilkan pertemuan jika memiliki kursus --}}
        @if($pertemuan->courses->isNotEmpty())
            <div>
                {{-- Judul diambil dari nama pertemuan di database --}}
                <h2 class="text-2xl font-semibold text-slate-700 mb-4 border-b-2 border-slate-200 pb-3">
                    {{ $pertemuan->name }}
                </h2>

                {{-- Grid untuk menampilkan kartu kursus di dalam pertemuan ini --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    {{-- Loop untuk setiap course yang dimiliki oleh pertemuan ini --}}
                    @foreach($pertemuan->courses as $course)
                        <a href="{{ route('mentee.courses.show', $course->id) }}"
                            class="bg-white p-6 rounded-xl shadow-lg hover:shadow-xl hover:scale-[1.02] transition-all duration-300 ease-in-out border border-transparent hover:border-indigo-200 h-full flex flex-col">
                            
                            <div class="flex-grow">
                                <h3 class="text-xl font-semibold text-slate-800 mb-2">{{ $course->title }}</h3>
                                <p class="text-sm text-slate-600 line-clamp-3">{{ $course->description ?? 'Tidak ada deskripsi.' }}</p>
                            </div>
                            
                            <div class="mt-4 pt-4 border-t border-slate-100 text-sm font-medium text-indigo-600 hover:text-indigo-700">
                                Lihat Detail Kursus →
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
    @empty
        {{-- Pesan jika tidak ada pertemuan sama sekali --}}
        <div class="col-span-full bg-white p-8 rounded-xl shadow-lg text-center">
            <p class="text-slate-500 text-lg italic">Belum ada kursus yang tersedia saat ini.</p>
            <p class="text-slate-400 text-sm mt-2">Silakan cek kembali nanti atau hubungi administrator.</p>
        </div>
    @endforelse
</div>
@endsection
