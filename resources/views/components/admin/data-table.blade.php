@props(['columns', 'data', 'showCheckbox' => false])

<div class="overflow-x-auto">
    <table class="table w-full text-xs sm:text-sm">
        <thead>
            <tr>
                @if($showCheckbox)
                    <th><input type="checkbox" class="checkbox" /></th>
                @endif
                @foreach($columns as $column)
                    <th>{{ $column['label'] }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach($data as $row)
                <tr>
                    @if($showCheckbox)
                        <td><input type="checkbox" class="checkbox" /></td>
                    @endif
                    @foreach($columns as $column)
                        <td>
                            @if($column['type'] === 'badge')
                                <span class="badge {{ $row[$column['key']]['class'] }}">
                                    {{ $row[$column['key']]['text'] }}
                                </span>
                            @elseif($column['type'] === 'actions')
                                <div class="flex flex-col gap-1 sm:flex-row sm:gap-2">
                                    @foreach($row[$column['key']] as $action)
                                        @if($action['type'] === 'link')
                                            <a href="{{ $action['url'] }}" class="btn btn-xs {{ $action['class'] }} w-full sm:w-auto">
                                                {{ $action['text'] }}
                                            </a>
                                        @else
                                            <button class="btn btn-xs {{ $action['class'] }} w-full sm:w-auto">
                                                {{ $action['text'] }}
                                            </button>
                                        @endif
                                    @endforeach
                                </div>
                            @else
                                {{ $row[$column['key']] }}
                            @endif
                        </td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
</div>