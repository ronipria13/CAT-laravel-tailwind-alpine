<div>
    <ol>
        @foreach ($users as $item)
            <li>{{ $item->name }}</li>
        @endforeach
    </ol>
</div>