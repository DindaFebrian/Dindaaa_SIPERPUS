<<<<<<< HEAD
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Book') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-black/80 p-6 rounded-lg shadow-xl">
                <div class="text-white font-bold">
                    <div class="mb-6">

                    <x-primary-button tag="a" href="{{ route('book.create') }}">Tambah Data Buku</x-primary-button>
                    <x-primary-button tag="a" href="{{ route('book.print') }}">Print Data Buku</x-primary-button>
                    <x-primary-button tag="a" href="{{ route('book.export') }}">Export Data Buku</x-primary-button>

                    <x-table>
                        <x-slot name="header">
                            <tr class="py-10">
                                <th scope="col">#</th>
                                <th scope="col">Judul</th>
                                <th scope="col">Penulis</th>
                                <th scope="col">Tahun</th>
                                <th scope="col">Penerbit</th>
                                <th scope="col">Kota</th>
                                <th scope="col">Cover</th>
                                <th scope="col">Kode Rak</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </x-slot>
                        @foreach ($books as $book)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $book->title }}</td>
                                <td>{{ $book->author }}</td>
                                <td>{{ $book->year }}</td>
                                <td>{{ $book->publisher }}</td>
                                <td>{{ $book->city }}</td>
                                <td>
                                    <img src="{{ asset('storage/cover_buku/' . $book->cover) }}" width="100px" />
                                </td>
                                <td>{{ $book->bookshelf->code }}-{{ $book->bookshelf->name }}</td>
                                <td>
                                    <x-primary-button tag="a"
                                        href="{{ route('book.edit', $book->id) }}">Edit</x-primary-button>
                                    <x-danger-button x-data=""
                                        x-on:click.prevent="$dispatch('open-modal', 'confirm-book-deletion')"
                                        x-on:click="$dispatch('set-action', '{{ route('book.destroy', $book->id) }}')">{{ __('Delete') }}</x-danger-button>
                                </td>
                            </tr>
                        @endforeach
                    </x-table>

                    <x-modal name="confirm-book-deletion" focusable maxWidth="xl">
                        <form method="post" x-bind:action="action" class="p-6">
                            @method('delete')
                            @csrf
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Apakah anda yakin akan menghapus data?') }}
                            </h2>
                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                {{ __('Setelah proses dilaksanakan. Data akan dihilangkan secara permanen.') }}
                            </p>
                            <div class="mt-6 flex justify-end">
                                <x-secondary-button x-on:click="$dispatch('close')">
                                    {{ __('Cancel') }}
                                </x-secondary-button>
                                <x-danger-button class="ml-3">
                                    {{ __('Delete!!!') }}
                                </x-danger-button>
                            </div>
                        </form>
                    </x-modal>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
=======
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Buku</title>
</head>
<body>
    @foreach ($buku as $satuan)
        <span>{{ $loop->iteration }}</span>. 
        <span>{{ $satuan['judul'] }}</span> - 
        <span>{{ $satuan['penerbit'] }}</span>
        <br>
    @endforeach
</body>
</html>
>>>>>>> 91b5aee3c87cbb6316ed269da00321fec7ee8dc2
