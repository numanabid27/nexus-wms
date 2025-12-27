<!-- start page title -->
@if(!empty($title))
<h4>{{ $title }}</h4>

<ol class="breadcrumb m-0">
    <li class="breadcrumb-item"><a href="javascript: void(0);" class="text-reset">{{ $pagetitle }}</a></li>
    <li class="breadcrumb-item active">{{ $title }}</li>
</ol>
@else
<h4>{{ $pagetitle }}</h4>

<ol class="breadcrumb m-0">
    <li class="breadcrumb-item">
        {{ $pagetitle }}
    </li>
</ol>
@endif
<!-- end page title -->