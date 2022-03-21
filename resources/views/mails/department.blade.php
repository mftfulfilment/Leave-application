@component('mail::message')
# Introduction

The body of your message.



<ul class="list-group">
    <li class="list-group-item">Name <b style="float: right"> {{ $user->name }}</b></li>
    <li class="list-group-item">Email <b style="float: right">{{ $user->email }}</b></li>
    <li class="list-group-item">Leave type <b style="float: right">{{ $application->leave_type->type }}</b></li>
    <li class="list-group-item">Person to take charge <b style="float: right">{{ $application->take_charge }}</b></li>
    <li class="list-group-item">Leave Start Date <b style="float: right">{{ $application->start_date }}</b></li>
    <li class="list-group-item">Leave End Date <b style="float: right">{{ $application->end_date }}</b></li>
    @if ($application->attachment->path )
    <li class="list-group-item">Attachment <b style="float: right"><a href="{{ env('APP_URL') . '/' .  $application->attachment->path }}" target="_blank">Attachment</a></b></li>
    @endif
</ul>
@component('mail::button', ['url' => $url . '/approved'])
Approve
@endcomponent
@component('mail::button', ['url' => $url . '/rejected'])
Reject
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
