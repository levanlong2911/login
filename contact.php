<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/templates/aboutme/inc/header.php'; ?>
<script type="text/javascript">
  document.title = 'Liên hệ';
</script>
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                  <h3>Liên hệ với chúng tôi</h3>
                  <?php
                    if(isset($_GET['msg'])){
                      echo $_GET['msg'];
                    }
                    if(isset($_POST['submit'])){
                      $name = $_POST['name'];
                      $mobile_number = $_POST['mobile_number'];
                      $email = $_POST['email'];
                      $content = $_POST['content'];
                      $query = "INSERT INTO contact(name, mobile_number, email,  content) VALUES ('$name', $mobile_number, '$email', '$content')";
                      $ketqua = $mysqli->query($query);
                      if($ketqua){
                        HEADER('LOCATION: lien-he?msg=Gửi thành công');
                      }else{
                        echo 'Đã có lổi khi gửi';
                      }
                    }
                  ?>
                  <form  action="" method="post" id="sendemail" class="fom_contact" >
                    <div class="form-group">
                      <label for="exampleFormControlInput1">Họ và tên(*)</label>
                      <input type="text" name="name" id="name" class="form-control" id="exampleFormControlInput1" placeholder="Nhập họ và tên" required>
                    </div>
                    <div class="form-group">
                      <label for="exampleFormControlInput1">Số điện thoại</label>
                      <input type="text" name="mobile_number" id="mobile_number" class="form-control" id="exampleFormControlInput1" placeholder="Nhập số di động">
                    </div>
                    <div class="form-group">
                      <label for="exampleFormControlInput1">Email(*)</label>
                      <input type="email" name="email" id="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com" required>
                    </div>
                    <div class="form-group">
                      <label for="exampleFormControlTextarea1">Nội dung(*)</label>
                      <textarea class="form-control" name="content" id="content" id="exampleFormControlTextarea1" rows="3" placeholder="Nhập thông tin" required></textarea>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Gửi thông tin</button>
                  </form>
                  <script type="text/javascript">
                    $(document).ready(function(){
                        $('.fom_contact').validate({
                            rules: {
                              name:{
                                required: true,
                                minlength: 10
                              },
                              mobile_number:{
                                digits: true,
                              },
                              email:{
                                email: true,
                              },
                              content:{
                                required: true,
                              },
                            },
                            messages : {
                              name:{
                                required: "Vui lòng nhập họ và tên",
                                minlength: "Vui lòng nhập ít nhất 10 ký tự",
                              },
                              mobile_number:{
                                digits: "Vui lòng nhập mobile_number",
                              },
                              email:{
                                email: "Vui lòng nhập email",
                              },
                              content:{
                                required: "Vui lòng nhập nội dung",
                              },
                            },

                        });

                    });
                </script>
                <style>
                    .error{color:red}
                </style>
                </div>
                <!--right bar-->
                <?php include_once $_SERVER['DOCUMENT_ROOT'] . '/templates/aboutme/inc/right-bar.php'; ?>
                <!--right bar-->
            </div>
        </div>
    </div>
    <?php include_once $_SERVER['DOCUMENT_ROOT'] . '/templates/aboutme/inc/footer.php'; ?>
    