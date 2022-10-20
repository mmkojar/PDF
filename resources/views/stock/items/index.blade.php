@extends('layouts.app')

@section('title', 'Salves')

@section('content')

<div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">            
          @can('all-access')
            <a href="{{route('stock.items.form')}}" class="btn btn-primary">Add Items</a>
          @endcan
        </div>
        <div class="card-body">
          <?php $count=1 ?>
        {{-- @if(count($salves) > 0) --}}
          
          {{-- @endif --}}
        </div><!-- end content-->
      </div><!--  end card  -->
    
    </div> <!-- end col-md-12 -->
  </div> <!-- end row -->

@endsection