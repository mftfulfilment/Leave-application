@extends('layouts.app')

@section('content')
    <main class="container">
        <div class="card">
            <div class="card-header">
                <span class="display-5">Pending Applications</span>
            </div>
            <div class="card-body">
                @forelse ($applications as $application)
                    {{-- {{ dd($application) }} --}}
                    {{-- {{ dd(auth()->user()->hasRole('Hr')) }} --}}

                    @if ($application->status == 'pending' && (auth()->user()->hasRole('department head') || auth()->user()->hasRole('admin') ))
                        <x-preview.application :application='$application' />
                        <x-modal.application :application='$application' />
                    @elseif ($application->status == 'Waiting HR Approval' && auth()->user()->hasRole('Hr'))
                        <x-preview.application :application='$application' />
                        <x-modal.application :application='$application' />
                    @elseif ($application->status == 'Waiting final Approval' && auth()->user()->hasRole('Admin'))
                        <x-preview.application :application='$application' />
                        <x-modal.application :application='$application' />
                    @else
                        <p>No Data Available</p>
                    @endif
                @empty
                    <p>No Data Available</p>
                @endforelse
            </div>
        </div>
    </main>
@endsection


@push('css')
    <style>
        .display-5 {
            font-size: 1.5rem !important;
        }

    </style>
@endpush
