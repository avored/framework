<?php 
//dd($dataGrid->columns);
?>

<div class="table-responsive">
<table class="avored-table-grid table table-striped">
    <thead class="thead-">
    <tr>
        @foreach($dataGrid->columns as $column)

        <?php  //dd($column->descUrl());?>
            <th>
                @if($column->sortable() && $dataGrid->desc($column->identifier()))
                    <a href="{{ $column->ascUrl() }}">
                        {{ $column->label() }}
                        <i class="text-primary fa fa-sort-down"></i>
                    </a>
                @elseif($column->sortable() && $dataGrid->asc($column->identifier()))
                        <a href="{{ $column->descUrl() }}">
                            {{ $column->label() }}
                            <i class="text-primary fa fa-sort-up"></i>
                        </a>
                @elseif($column->sortable() )
                    <a href="{{ $column->descUrl() }}">
                        {{ $column->label() }}
                        <i class="text-secondary fa fa-sort"></i>
                    </a>
                @else
                    {{ $column->label() }}

                @endif

            </th>
        @endforeach
    </tr>
    </thead>
    <tbody>
    <tr>
        @foreach($dataGrid->columns as $column)
            <th>
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
                            
                            class="form-control" />
                    </div>
                    <div class="form-group">
                        <button type="submit" class="d-none"></button>
                    </div>
                </form>
                @endif
            </th>
        @endforeach
    </tr>
    @foreach($dataGrid->data as $row)
        <tr>
            @foreach($dataGrid->columns as $column)
                <td>
                    @if($column->type() == "link")
                        {!! $column->executeCallback($row) !!}
                    @else
                        <?php $identifier = $column->identifier() ?>
                        {{ $row->$identifier }}
                    @endif
                </td>
            @endforeach
        </tr>
    @endforeach
    </tbody>
</table>
</div>
{!! $dataGrid->data->appends(Request::except($dataGrid->data->getPageName()))->render('pagination::bootstrap-4') !!}
