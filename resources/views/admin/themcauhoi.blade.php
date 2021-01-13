<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="{{asset('css/css.css')}}">
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <title>Thêm câu hỏi</title>
</head>
<body>
    {{View::make('Navbar')}}
    <div class="container">
        <div class="header_container">
            <div class="text_home">
             <p>Hệ: Đại học CQ  NH: 2020-2021  HK: 1</p>
            </div>
            <div class="info_home">
             <p>Trang thêm câu hỏi | Tài khoản:ADMIN
                 <a href="/admin">Trang chủ</a>
             </p>
            </div>
        </div>
        <h1 style="text-align: center;">DANH SÁCH CÂU HỎI</h1>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
            THÊM CÂU HỎI
          </button>
          <p></p>
          <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form id="bookForm">
                  <div class="form-group">
                    <label for="">Câu hỏi</label>
                    <input type="text"
                      class="form-control" name="" id="question" aria-describedby="helpId" placeholder="">
                  </div> 
                  <div class="form-group">
                    <label for="">Đáp án A</label>
                    <input type="text"
                      class="form-control" name="" id="ansa" aria-describedby="helpId" placeholder="">
                  </div> 
                  <div class="form-group">
                    <label for="">Đáp án B</label>
                    <input type="text"
                      class="form-control" name="" id="ansb" aria-describedby="helpId" placeholder="">
                  </div> 
                  <div class="form-group">
                    <label for="">Đáp án C</label>
                    <input type="text"
                      class="form-control" name="" id="ansc" aria-describedby="helpId" placeholder="">
                  </div> 
                  <div class="form-group">
                    <label for="">Đáp án D</label>
                    <input type="text"
                      class="form-control" name="" id="ansd" aria-describedby="helpId" placeholder="">
                  </div> 
                  <div class="form-group">
                    <label for="">Đáp án đúng</label>
                    <input type="text"
                      class="form-control" name="" id="ansCX" aria-describedby="helpId" placeholder="">
                  </div> 
                  <div class="form-group">
                    <label for="">Phân loại câu hỏi</label>
                    <input type="text"
                      class="form-control" name="" id="ansPL" aria-describedby="helpId" placeholder="">
                  </div> 
                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-primary">Save changes</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        <table class="table table-bordered data-table">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Câu hỏi</th>
                    <th>Chỉnh sửa</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
    
    <div class="modal fade" id="exampleModal_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form id="bookForm_edit">
                <div class="form-group">
                    <label for="">ID</label>
                        <input type="text"
                      class="form-control" name="" id="id" aria-describedby="helpId" placeholder="">
                  </div> 
                <div class="form-group">
                    <label for="">Câu hỏi</label>
                        <input type="text"
                      class="form-control" name="" id="question_edit" aria-describedby="helpId" placeholder="">
                  </div> 
                  <div class="form-group">
                    <label for="">Đáp án A</label>
                    <input type="text"
                      class="form-control" name="" id="ansa_edit" aria-describedby="helpId" placeholder="">
                  </div> 
                  <div class="form-group">
                    <label for="">Đáp án B</label>
                    <input type="text"
                      class="form-control" name="" id="ansb_edit" aria-describedby="helpId" placeholder="">
                  </div> 
                  <div class="form-group">
                    <label for="">Đáp án C</label>
                    <input type="text"
                      class="form-control" name="" id="ansc_edit" aria-describedby="helpId" placeholder="">
                  </div> 
                  <div class="form-group">
                    <label for="">Đáp án D</label>
                    <input type="text"
                      class="form-control" name="" id="ansd_edit" aria-describedby="helpId" placeholder="">
                  </div> 
                  <div class="form-group">
                    <label for="">Đáp án đúng</label>
                    <input type="text"
                      class="form-control" name="" id="ansCX_edit" aria-describedby="helpId" placeholder="">
                  </div> 
                  <div class="form-group">
                    <label for="">Phân loại câu hỏi</label>
                    <input type="text"
                      class="form-control" name="" id="ansPL_edit" aria-describedby="helpId" placeholder="">
                  </div> 
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary">Cập nhật</button>
              </form>
            </div>
          </div>
        </div>
      </div>

</body>
</html>
<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>  
<script type="text/javascript">
    $(document).ready(function () {
    $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
          }
    });
    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('index.index') }}",
        columns: [
            {data:'id', name: 'id'},
            {data:'question', name: 'question'},
            {data:'action', name: 'action', orderable: false, searchable: false},
        ],
    });


    $('#bookForm').submit(function(e){
        e.preventDefault();
        var id = $('#id').val();
        var question = $('#question').val();
        var ansa = $('#ansa').val();
        var ansb = $('#ansb').val();
        var ansc = $('#ansc').val();
        var ansd = $('#ansd').val();
        var ansCX = $('#ansCX').val();
        var ansPL = $('#ansPL').val();

         $.ajax({
         url:"{{route('add.data')}}",
         type:"POST",
         data:{
            id:id,
            question:question,
            ansa:ansa,
            ansb:ansb,
            ansc:ansc,
            ansd:ansd,
            ansCX:ansCX,
            ansPL:ansPL
         },
         success:function(add_data){
             table.draw();      
              $("#bookForm")[0].reset(); 
         }
     })    
    });

    $('body').on('click', '#edit', function () {
        var id = $(this).data('id');// lay id tu trang khac khong cung trong 1 trang
        $.get('/edit/'+id,function(edit_data_form){
            $('#id').val(edit_data_form.id);
            $('#question_edit').val(edit_data_form.question);
            $('#ansa_edit').val(edit_data_form.ansa);
            $('#ansb_edit').val(edit_data_form.ansb);
            $('#ansc_edit').val(edit_data_form.ansc);
            $('#ansd_edit').val(edit_data_form.ansd);
            $('#ansCX_edit').val(edit_data_form.ansCX);
            $('#ansPL_edit').val(edit_data_form.ansPL);
            $('#exampleModal_edit').modal('show');
    });
    });

    $('#bookForm_edit').submit(function(e){
        e.preventDefault();
        var id = $('#id').val();
        var question = $('#question_edit').val();
        var ansa = $('#ansa_edit').val();
        var ansb = $('#ansb_edit').val();
        var ansc = $('#ansc_edit').val();
        var ansd = $('#ansd_edit').val();
        var ansCX = $('#ansCX_edit').val();
        var ansPL = $('#ansPL_edit').val();
    
        $.ajax({
            url:"{{route('edit_data')}}",
            type:"PUT",
            data:{
                id:id,
                question:question,
                ansa:ansa,
                ansb:ansb,
                ansc:ansc,
                ansd:ansd,
                ansCX:ansCX,
                ansPL:ansPL
            },
            success:function(suc){
                table.draw();
                $('#exampleModal_edit').modal('hide');
            }
        })
    });

    $('body').on('click','#remove',function(){
        var id = $(this).data('id');// lay id tu trang khac khong cung trong 1 trang
        $.ajax({
            url:"/delete/"+id,
            type:"DELETE",
            success:function(rem){
                table.draw();
            }
        })
    })

});
</script>
