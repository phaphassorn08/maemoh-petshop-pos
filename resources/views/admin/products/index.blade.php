@extends('layouts.admin')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
   

    <!-- Content Row -->
        <div class="card">
            <div class="card-header py-3 d-flex">
                <h2 class="m-0 font-weight-bold text-primary">
                    {{ __('รายการสินค้า') }}
                </h2>
                <div class="ml-auto">
                    <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
                        <span class="icon text-white-50">
                            <i class="fa fa-plus"></i>
                        </span>
                        <span class="text">{{ __('เพิ่มสินค้า') }}</span>
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover datatable datatable-product" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th width="10">
                                </th>
                                <th>#</th>
                                <th>บาร์โค้ด</th>
                                <th>ชื่อ</th>
                                <th>ราคา/หน่วย</th>
                                <th>ประเภท</th>
                                <th>จำนวน</th>
                                <th>รูปภาพ</th>
                                <th>ตัวเลือก</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($products as $product)
                            <tr data-entry-id="{{ $product->id }}">
                                <td>

                                </td>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                <img src="data:image/png;base64,{{ DNS1D::getBarcodePNG($product->code, 'C39',1,33,array(1,1,1), true) }}" 
                                alt="{{ $product->code }}"
                                width="80"
                                height="30">
                                </td>
                                
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->price }}</td>
                                <td><span class="badge badge-info">{{ $product->category->name }}</span></td>
                                <td>{{ $product->quantity }}</td>
                                <td>
                                    @if($product->image)
                                    <?php
                                    $string = asset($product->image->getUrl());;
                                    $pattern = '/localhost/';
                                    $replacement = '127.0.0.1:8000';
                                    $image = preg_replace($pattern, $replacement, $string);
                                    //echo $foo;
                                    ?>
                                        <a href="{{$image}}" target="_blank">
                                            <img src="{{$image}}" width="100px" height="100px" />
                                        </a>
                                    @else
                                        <span class="badge badge-warning">no image</span>
                                    @endif
                                </td> 
                                <td>
                                    <div class="btn-group-sm" style="border-top-left-radius: 0;border-bottom-left-radius: 0;">
                                        <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-primary btn-sm">
                                            <span class="icon text-white">
                                                <i class="fa fa-edit"></i>
                                            </span>
                                        </a>
                                        <form onclick="return confirm('Are you sure to delete this data? ')" class="d-inline" action="{{ route('admin.products.destroy', $product->id) }}" method="POST">
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
                                <td colspan="9" class="text-center">{{ __('Data Empty') }}</td>
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
    url: "{{ route('admin.products.mass_destroy') }}",
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
  $('.datatable-product:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})
</script>
@endpush