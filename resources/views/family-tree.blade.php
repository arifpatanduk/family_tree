@foreach($families as $family)
@if (!$family->parent_id)
<div class="tree my-3">
    <ul>
@endif

<li>
    <a class="text-white {{ $family->gender == 'L' ? 'bg-primary' : 'bg-danger' }}" href="{{ route('family.edit', $family->id) }}">
        {{ $family->name }}
    </a>
    @if (count($family->childs))
    <ul>@include('family-tree', ['families' => $family->childs])</ul>
    @endif
</li>

@if (!$family->parent_id)
</ul>
</div>
@endif
@endforeach




