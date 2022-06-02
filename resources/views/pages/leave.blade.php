@extends('layouts.app')

@section('content')
    <main class="container">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Department</th>
                    <th scope="col">Duration</th>
                    <th scope="col">Type</th>
                    <th scope="col">Period</th>
                    <th scope="col">Status</th>
                    <th scope="col">File</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $key => $item)
                    <tr>
                        <th scope="row"> {{ $key + 1 }} </th>
                        <td>{{ $item['applier']['name'] }}</td>
                        <td>{{ $item['department'] }}</td>
                        <td>{{ $item['duration'] }}</td>
                        <td>{{ $item['leave_type']['type'] }}</td>
                        <td>
                            {{ $item['start_date'] }} @if ($item['end_date'])
                                - {{ $item['end_date'] }}
                            @endif
                        </td>
                        <td> <span class="badge text-bg-success">{{ $item['status'] }}</span></td>
                        <td>
                            @if ($item['attachment'])
                                <a href="{{ $item['attachment']['path'] }}" target="_blank">Attachment</a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>

            <tfoot>
                <th>
                    {{ $data->links() }}</th>
            </tfoot>
        </table>
    </main>
@endsection

@push('css')
    <style>
        .display-5 {
            font-size: 1.5rem !important;
        }

        img,
        svg {
            width: 10px !important;
        }

    </style>
@endpush
