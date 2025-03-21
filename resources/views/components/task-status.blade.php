<span
    @class([
        'px-2 py-1 rounded text-white',
        'bg-green-600' => $status === 'completed',
        'bg-blue-600' => $status === 'in_progress',
        'bg-red-600' => $status === 'to_do',
    ])
>{{ ucwords(str_replace('_', ' ', $status)) }}</span>
