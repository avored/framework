<table class="table table-striped table-bordered">
    <thead class="thead-light">
    @foreach($dataGrid->columns as $column)
        <th>
            @if($column->sortable() && $dataGrid->desc($column->identifier()))
                <a href="{{ $column->ascUrl() }}" class="">{{ $column->label() }} <i class="fa fa-sort-down"></i>
                </a>
            @elseif($column->sortable() && $dataGrid->asc($column->identifier()))
                <a href="{{ $column->descUrl() }}" class="">
                    {{ $column->label() }}
                    <i class="fa fa-sort-up"></i>
                </a>
            @elseif($column->sortable() )
                <a href="{{ $column->descUrl() }}" class="">
                    {{ $column->label() }}
                    <i class="fa fa-sort"></i>
                </a>
            @else
                {{ $column->label() }}

            @endif

        </th>
    @endforeach
    </thead>

    <div class="avored-table-row filter">
        @foreach($dataGrid->columns as $column)
            <div class="col avored-table-cell">
                @if($column->canFilter())
                    <form method="get" action="{{ URL::full() }}">

                        @if(Request::get('asc'))
                            <input type="hidden" name="asc" value="{{ Request::get('asc') }}">
                        @endif
                        @if(Request::get('desc'))
                            <input type="hidden" name="desc" value="{{ Request::get('desc') }}">
                        @endif

                        <div class="form-group">
                            <input type="text"
                                   name="q[{{ $column->identifier() }}]"
                                   @if(
                                       null !== request()->get('q') &&
                                       isset(request()->get('q')[$column->identifier()])
                                   )
                                   value="{{ request()->get('q')[$column->identifier()] }}"
                                   @endif

                                   class="form-control"/>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="d-none"></button>
                        </div>
                    </form>
                @endif
            </div>
        @endforeach
    </div>

    <tbody>
    @foreach($dataGrid->data as $row)
        <tr>
            @foreach($dataGrid->columns as $column)
                <td>
                    @if($column->type() == "link")
                        {!! $column->executeCallback($row) !!}
                    @else
                        <?php
                        $identifier = $column->identifier();
                        ?>
                        @if(is_array($row))
                            {{ array_get($row, $identifier) }}
                        @else
                            {{ $row->$identifier }}
                        @endif

                    @endif
                </td>
            @endforeach
        </tr>
    @endforeach
    </tbody>
</table>

<div class="row justify-content-end">
    <div class="col-12">
        {!! $dataGrid->data->appends(Request::except($dataGrid->data->getPageName()))->links('pagination::bootstrap-4') !!}
    </div>
</div>
