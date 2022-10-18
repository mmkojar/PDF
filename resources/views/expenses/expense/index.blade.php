@extends('layouts.app')


@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    @can('all-access')
                        <a href="{{ route('expense.create') }}" class="btn btn-primary">Add Expense</a>
                    @endcan
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>From Date</label>
                                <input name="min" id="min" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>To Date</label>
                                <input name="max" id="max" type="text" class="form-control">
                            </div>
                        </div>
                    </div>
                    <?php $count = 1; ?>
                    <table id="footer_datatable1" class="table table-striped table-bordered" width="100%">
                        <thead>
                            <tr>
                                <th>Sr.No</th>
                                <th>Description</th>
                                <th>Date</th>
                                <th>Amount</th>
                                @can('all-access')
                                    <th class="disabled-sorting text-right">Actions</th>
                                @endcan
                                @can('no-access')
                                    <th></th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($expenses as $expense)
                                <tr>
                                    <td>{{ $count }}</td>
                                    <td>{{ $expense->description }}</td>
                                    <td>{{ $expense->date }}</td>
                                    <td>{{ $expense->amount }}</td>
                                    @can('all-access')
                                        <td class="text-right">
                                            <a id="{{ $expense->id }}" class="btn btn-sm btn-danger delete_all"
                                                url="expense"><i class="fa fa-times"></i></a>
                                            <a href="{{ route('expense.edit', $expense->id) }}"
                                                class="btn btn-sm btn-warning edit"><i class="fa fa-edit"></i></a>
                                        </td>
                                    @endcan
                                    @can('no-access')
                                        <td></td>
                                    @endcan
                                </tr>
                                <?php $count++; ?>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th></th>
                                <th></th>
                                <th>Total:</th>
                                <th></th>
                                <th></th>
                                {{-- <th colspan="4"></th> --}}
                            </tr>
                        </tfoot>
                    </table>
                </div><!-- end content-->
            </div><!--  end card  -->

        </div> <!-- end col-md-12 -->
    </div> <!-- end row -->

@endsection
