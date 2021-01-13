<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="{{asset('css/css.css')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>
<body style="background-color: #e9ecefe8;">
    {{View::make('Navbar')}}
    <div class="container">
       <div class="header_container">
           <div class="text_home">
            <p>Hệ: Đại học CQ  NH: 2020-2021  HK: 1</p>
           </div>
           <div class="info_home">
            <p>Trang quản lý tài khoản | Tài khoản:ADMIN
                <a href="/admin">Trang chủ</a>
            </p>
           </div>
       </div>
       <div class="tinhnang" style="overflow-y: auto;">
            <div class="table_users">
                <table class="table table-striped tb_admin_users">
                    <thead class="thead-dark">
                      <tr>
                        <th width="5%" scope="col">STT</th>
                        <th width="12%"  scope="col">Tên</th>
                        <th width="25%" scope="col">Email</th>
                        <th width="25%" scope="col">Tên đăng nhập</th>
                        <th scope="col">Chỉnh sửa</th>
                        <th scope="col">Xóa</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $count = 1; ?>
                        @foreach($data as $data)
                      <tr>
                        <th scope="row">{{$count}}</th>
                        <td>{{$data->name}}</td>
                        <td>{{$data->email}}</td>
                        <td>{{$data->username}}</td>
                        <td><a herf="javascript:void(0)" onclick="edit_Data({{$data->id}})" ><button type="button" class="btn btn-primary">Chỉnh sửa</button></a></td>
                        <td><a herf="javascript:void(0)" onclick="remove_Data({{$data->id}})" ><button type="button" class="btn btn-primary">Xóa</button></td>
                      </tr>
                      <?php $count++ ?>
                      @endforeach
                    </tbody>
                  </table>
            </div>
       </div>
    </div>
    <p></p>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <form class="modal-content" id="form_id" action="quanlytaikhoan" >
            @csrf
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">CẬP NHẬT THÔNG TIN</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div> 
              <div class="modal-body">
                <div class="form-group">
                    <label for="">Họ Tên</label>
                    <input type="text"
                      class="form-control" id="id" name="hoten"  placeholder="Mời nhập email">
                  </div>
              <div class="form-group">
                <label for="">Email</label>
                <input type="text"
                  class="form-control" id="email" name="email"  placeholder="Mời nhập email">
              </div>
              <div class="form-group">
                <label for="">Tên đăng nhập</label>
                <input type="text"
                  class="form-control" id="name" name="tendangnhap"  placeholder="Mời nhập họ tên">
              </div>
              <div class="form-group">
                <label for="">Mật khẩu</label>
                <input type="text"
                  class="form-control" id="username" name="matkhau"  placeholder="Mời nhập mật khẩu">
              </div>
              <div class="form-group">
                <label for="">Mật khẩu</label>
                <input type="password"
                  class="form-control" id="password" name="matkhau"  placeholder="Mời nhập mật khẩu">
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary">CẬP NHẬT</button>
            </div>
           
            </form>
          </div>
        </div>
      </div>
    {{View::make('footer')}}
</body>
</html>
<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
<script type="text/javascript">
  function edit_Data(id){
            $.get('/edit1/'+id,function(edit_data_form){
                $('#id').val(edit_data_form.id);
                $('#name').val(edit_data_form.name);
                $('#email').val(edit_data_form.email);
                $('#username').val(edit_data_form.username);
                $('#password').val(edit_data_form.password);
                $('#exampleModal').modal('show');
            });
        };
    $('#form_id').submit(function(e){

      var id = $('#id').val();
      var name = $('#name').val();
      var email = $('#email').val();
      var username = $('#username').val();
      var password = $('#password').val();
      let _token = $("input[name=_token]").val();
      $.ajax({
        url:"{{route('edit.data')}}",
        type:"PUT",
        data:{
          id: id,
          name:name,
          email:email,
          username:username,
          password:password,
          _token:_token
        },
        success:function(edit_data){
        }
      })
    });

    function remove_Data(id){
            var _token=$('input[name=_token]').val();
            if(confirm("Delete")){
                $.ajax({
                    url:'/delete1/'+id,
                    type:'DELETE',
                    data:{
                        _token : _token
                    },
                });
                window.location="quanlytaikhoan";
            }
        };
</script>
