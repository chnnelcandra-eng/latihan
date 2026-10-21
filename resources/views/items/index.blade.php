<!DOCTYPE html> 
<html lang="id"> 
<head> 
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head> 
<body> 
<div class="container mt-3">
  <h2>Items</h2>
  <button type="button" class="btn btn-success btn-sm" 
  data-bs-toggle="modal" data-bs-target="#ModalTambah">Tambah</button>
     <table class="table table-striped"> 
        <thead> 
            <tr> 
                <th>Aksi</th> 
                <th>ID</th> 
                <th>Nama Item</th> 
                <th>Deskripsi</th> 
                <th>Harga</th> 
                <th>Stok</th> 
            </tr> 
        </thead> 
        <tbody id="itemTableBody"> 
            @foreach($items as $item)
            <tr> 
            <td> 
            <button class="btn btn-warning btn-sm btn-edit" data-bs-toggle="modal" 
            data-bs-target="#ModalEdit" data-id="{{$item->id}}"
            data-name="{{$item->name}}" data-description="{{$item->description}}"
            data-price="{{$item->price}}" data-stock="{{$item->stock}}">Edit</button> 
            </td>   
            <td>{{$item->id}}</td> 
            <td>{{$item->name}}</td> 
            <td>{{$item->description}}</td> 
            <td>Rp {{$item->price}}</td> 
            <td>{{$item->stock}}</td>             
            </tr> 
            @endforeach
        </tbody>  
    </table> 
</div>

<div class="modal" id="ModalTambah">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Tambah Item</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">   

    <div class="mt-3">
    <input type="text" class="form-control" id="name" placeholder="Enter Name" name="name">
    </div>

    <div class="mt-3">
    <input type="text" class="form-control" id="description" placeholder="Enter Description" name="description">
    </div>

    <div class="mt-3">
    <input type="number" class="form-control" id="price" placeholder="Enter Price" name="price">
    </div>

    <div class="mt-3">
    <input type="number" class="form-control" id="stock" placeholder="Enter Stock" name="stock">
    </div>

      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-success" data-bs-dismiss="modal" id="save">Save</button>
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>


<div class="modal" id="ModalEdit">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Edit Item</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">   

    <div class="mt-3">
    <input type="text" class="form-control" id="edit_id" placeholder="Enter Id" name="id" readonly>
    </div>

    <div class="mt-3">
    <input type="text" class="form-control" id="edit_name" placeholder="Enter Name" name="name">
    </div>

    <div class="mt-3">
    <input type="text" class="form-control" id="edit_description" placeholder="Enter Description" name="description">
    </div>

    <div class="mt-3">
    <input type="number" class="form-control" id="edit_price" placeholder="Enter Price" name="price">
    </div>

    <div class="mt-3">
    <input type="number" class="form-control" id="edit_stock" placeholder="Enter Stock" name="stock">
    </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="delete">Delete</button>
        <button type="button" class="btn btn-success" data-bs-dismiss="modal" id="update">Update</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
      </div>

    </div>
  </div>
</div>

<script>
          $('#save').click(function(){                               
                let name = $('#name').val(); 
                let description = $('#description').val(); 
                let price = $('#price').val(); 
                let stock = $('#stock').val(); 
                console.log(name);
                console.log(description);
                console.log(price);
                console.log(stock);
                var fd = new FormData();
               
                fd.append('name',name);
                fd.append('description',description);
                fd.append('price',price);
                fd.append('stock',stock);
                fd.append('_token', $('meta[name="csrf-token"]').attr('content'));
                
                $.ajax({ 
                    url: 'items', 
                    type: 'POST', 
                    data: fd, 
                    processData: false,
                    contentType: false,
                    success: function (response) {
                      console.log(response);
                      alert('Data berhasil dikirim!');
                      location.reload();
                    },
                    error: function (xhr) {
                    console.error(xhr.responseText);
                    alert('Data gagal di kirim.');
                     }
                }); 
            }); 
</script>
<script>
  // Isi form modal Edit dari data tombol yang diklik
  $('.btn-edit').click(function(){
      $('#edit_id').val($(this).data('id'));
      $('#edit_name').val($(this).data('name'));
      $('#edit_description').val($(this).data('description'));
      $('#edit_price').val($(this).data('price'));
      $('#edit_stock').val($(this).data('stock'));
  });

  // UPDATE (method PUT)
  $('#update').click(function(){
      $.ajax({
          url: 'items',
          type: 'PUT',
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          data: {
              id: $('#edit_id').val(),
              name: $('#edit_name').val(),
              description: $('#edit_description').val(),
              price: $('#edit_price').val(),
              stock: $('#edit_stock').val()
          },
          success: function (response) {
              console.log(response);
              alert('Data berhasil diupdate!');
              location.reload();
          },
          error: function (xhr) {
              console.error(xhr.responseText);
              alert('Data gagal diupdate.');
          }
      });
  });

  // DELETE (method DELETE)
  $('#delete').click(function(){
      if (!confirm('Yakin ingin menghapus item ini?')) return;

      $.ajax({
          url: 'items',
          type: 'DELETE',
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          data: {
              id: $('#edit_id').val()
          },
          success: function (response) {
              console.log(response);
              alert('Data berhasil dihapus!');
              location.reload();
          },
          error: function (xhr) {
              console.error(xhr.responseText);
              alert('Data gagal dihapus.');
          }
      });
  });
</script>
</body>
</html>