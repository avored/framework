<div class="avored-table">
    <div class="avored-table-row header">
        @foreach($dataGrid->columns as $column)
           
            <div class="{{ $column->class() }} avored-table-cell" >
                @if($column->sortable() && $dataGrid->desc($column->identifier()))
                    <a href="{{ $column->ascUrl() }}">
                        {{ $column->label() }}
                        <i class="text-white fa fa-sort-down"></i>
                    </a>
                @elseif($column->sortable() && $dataGrid->asc($column->identifier()))
                        <a href="{{ $column->descUrl() }}">
                            {{ $column->label() }}
                            <i class="text-white fa fa-sort-up"></i>
                        </a>
                @elseif($column->sortable() )
                    <a href="{{ $column->descUrl() }}">
                        {{ $column->label() }}
                        <i class="text-white fa fa-sort"></i>
                    </a>
                @else
                    {{ $column->label() }}

                @endif

            </div>
        @endforeach
           
       
    </div>

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
                            
                            class="form-control" />
                    </div>
                    <div class="form-group">
                        <button type="submit" class="d-none"></button>
                    </div>
                </form>
                @endif
            </div>
       
          
        @endforeach   
        

    </div>

    <div class="avored-table-body">
      
        @foreach($dataGrid->data as $row)
        <div class="avored-table-row ">
            @foreach($dataGrid->columns as $column)
                <div class="{{ $column->class() }} avored-table-cell">
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
                </div>
            @endforeach
        </div>
    @endforeach
        
    </div>

    {!! $dataGrid->data->appends(Request::except($dataGrid->data->getPageName()))->links('pagination::bootstrap-4') !!}

</div>



