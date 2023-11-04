@extends('layouts.admin')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
   

    <!-- Content Row -->
        <div class="card">
            <div class="card-header py-3 d-flex">
                <h2 class="m-0 font-weight-bold text-primary">
                    {{ __('ประวัติการขาย') }}
                </h2>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover datatable datatable-transaction" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th width="10">

                                </th>
                                <th>#</th>
                                <th>วันที่</th>
                                <th>รหัส</th>
                                <th>ชื่อ</th>
                                <th>ราคารวม</th>
                                <th>ตัวเลือก</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($transactions as $transaction)
                            <tr data-entry-id="{{ $transaction->id }}">
                                <td>

                                </td>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $transaction->created_at }}</td>
                                <td>{{ $transaction->transaction_code }}</td>
                                <td>{{ $transaction->name }}</td>
                                <td>{{ $transaction->total_price }} บาท</td>
                                <td>
                                    <div class="btn-group-sm" style="border-top-left-radius: 0;border-bottom-left-radius: 0;">
                                        <a href="{{ route('admin.transactions.show', $transaction->id)}}" class="btn btn-info">
                                            <span class="icon text-white">
                                                <i class="fa fa-eye"></i>
                                            </span>
                                        </a>
                                        <form onclick="return confirm('Are you sure to delete this data? ')" class="d-inline" action="{{ route('admin.transactions.destroy', $transaction->id) }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-danger btn-sm" >
                                            <span class="icon text-white">
                                                <i class="fa fa-trash"></i>
                                            </span>
                                            </button>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center">{{ __('ไม่มีข้อมูล') }}</td>
                            </tr>
                            @endforelse      
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    <!-- Content Row -->

</div>
@endsection

@push('script-alt')
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
  let deleteButtonTrans = 'ลบรายการที่เลือก'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });
      if (ids.length === 0) {
        alert('zero selected')
        return
      }
      if (confirm('are you sure ?')) {
        $.ajax({
          headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
  $.extend(true, $.fn.dataTable.defaults, {
    order: [[ 1, 'asc' ]],
    pageLength: 50,
  });
  $('.datatable-transaction:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})
</script>
@endpush