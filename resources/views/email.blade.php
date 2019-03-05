<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card-group">
                @foreach ($vencidos as $item)

                    {{$item->numero}}

                @endforeach
            </div>
        </div>
    </div>
</div>
