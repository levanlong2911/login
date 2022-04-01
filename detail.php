<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/templates/aboutme/inc/header.php'; ?>
<?php
  $id_story = $_GET['id'];
  $query = "SELECT * FROM story AS s INNER JOIN cat AS c ON s.id_cat=c.id_cat where id_story = $id_story ORDER BY s.id_story DESC";
  $ketqua = $mysqli->query($query);
  $ar_story =mysqli_fetch_assoc($ketqua);
  $id_cat = $ar_story['id_cat'];
  $ten_danhmuc = $ar_story['ten_danhmuc'];
  $nameRepalace_story = utf8ToLatin($ten_danhmuc);
  $url_story = '/' . $nameRepalace_story . '-' . $id_cat;
?>
<script type="text/javascript">
  document.title = '<?php echo $ar_story['name']; ?>';
</script>
    <div class="content">
        <div class="container">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item"><a href="<?php echo $url_story; ?>"><?php echo $ar_story['ten_danhmuc']; ?></a></li>
              <li class="breadcrumb-item active" aria-current="page"><?php echo $ar_story['name']; ?></li>
            </ol>
          </nav>
            <div class="row">
                <div class="col-md-8">
                  <div class="content-left-detail">
                    <h1><?php echo $ar_story['name']; ?></h1>
                    <div class="information">
                      <span>Admin</span>
                      <span>Ngày đăng: <?php echo $ar_story['data_time']; ?></span>
                      <!--cập nhật lượt xem-->
                      <?php 
                        $query_view = "UPDATE story SET view = view+1 WHERE id_story = $id_story";
                        $ketqua_view = $mysqli->query($query_view);
                        if($ketqua_view){

                        }
                      ?>
                      <span>Lượt xem: <?php echo $ar_story['view']; ?> views</span>
                    </div>
                    <p><?php echo $ar_story['detail']; ?></p>
                  </div>
                  <div class="fb-like" data-href="<?php echo $url_story; ?>" data-width="" data-layout="standard" data-action="like" data-size="small" data-share="true"></div>
                  <!--Comment-->
                  <h5>Bình luận bài viết:</h5>
                  <div class="container">
                    <form action="" method="post" id="comment_form">
                      <div class="form-group">
                        <input type="text" name="comment_name" id="comment_name" class="form-control" placeholder="Nhập tên của bạn" />
                      </div>
                      <div class="form-group">
                        <textarea name="comment_content" id="comment_content" class="form-control" placeholder="Nhập nội dung bình luận" rows="3"></textarea>
                      </div>
                      <div class="form-group">
                        <input type="hidden" name="comment_lever_id" id="comment_lever_id" value='<?php echo $ar_story['id_story']; ?>' />
                        <input type="submit" name="submit" id="submit" class="btn btn-info" value="Gửi" />
                      </div>
                    </form>
                    <h5>Bình luận</h5>
                    <div id="load_comment">
                      <?php
                        $comment_lever_id = $_GET['id'];
                        $query_comment = "SELECT * FROM comment INNER JOIN story ON comment_lever_id = id_story WHERE comment_lever_id = $comment_lever_id";
                        $ketqua_comment = $mysqli->query($query_comment);
                        while($ar_comment = mysqli_fetch_assoc($ketqua_comment)){
                          $id_comment = $ar_comment['id_comment'];
                          $comment_name = $ar_comment['comment_name'];
                          $comment_content = $ar_comment['comment_content'];
                          $comment_lever_id = $ar_comment['comment_lever_id'];

                        }
                      ?>
                    </div>
                    <script type="text/javascript">
                      $(document).ready(function(){
                        function fetch_data(){
                          $.ajax({
                              url: "ajax_action.php",
                              method: "POST",
                              success: function(data){
                                $('#load_comment').html(data);
                                
                              }
                            });
                        }
                        fetch_data();
                        // insert dữ liệu
                        $('#submit').on('click', function(){
                          var comment_name = $('#comment_name').val();
                          var comment_content = $('#comment_content').val();
                          var comment_lever_id = $('#comment_lever_id').val();
                          if(comment_name == '' || comment_content == ''){
                            alert('Không được để trống các ô');
                          }else{
                            $.ajax({
                              url: "ajax_action.php",
                              method: "POST",
                              data:{comment_name:comment_name, comment_content:comment_content, comment_lever_id:comment_lever_id},
                              success: function(data){
                                alert('Gửi bình luận thành công');
                                $('#comment_form')[0].reset();
                                fetch_data();
                              }
                            });
                          }
                        });
                      });
                    </script>
                  </div>
                  <!--and Comment-->
                  <h2>Bài viết liên quan</h2>
                  <div class="Related-posts">
                    <div class="container">
                      <div class="row">
                        <?php
                          $query1 = "SELECT * FROM story WHERE id_story != $id_story and id_cat = {$ar_story['id_cat']} order by id_story limit 3";
                          $ketqua1 = $mysqli->query($query1);
                          while($arstory = mysqli_fetch_assoc($ketqua1)){
                            $id_story = $arstory['id_story'];
                            $name = $arstory['name'];
                            $nameRepalace_story1 = utf8ToLatin($name);
                            $url_story1 = '/' . $nameRepalace_story1 . '-' . $id_story . '.html';
                        ?>
                        <div class="col-md-4">
                          <a href="<?php echo $url_story1; ?>"><img src="/files/<?php echo $arstory['picture']; ?>" width="210px" height="130px"/></a>
                          <div class="title">
                            <h5><a href="<?php echo $url_story1; ?>"><?php echo $arstory['name']; ?></a></h5>
                          </div>
                        </div>
                        <?php
                          }
                        ?>
                      </div>
                    </div>
                  </div>
                </div>
                <!--right bar-->
                <?php include_once $_SERVER['DOCUMENT_ROOT'] . '/templates/aboutme/inc/right-bar.php'; ?>
                <!--right bar-->
            </div>
        </div>
    </div>
    <?php include_once $_SERVER['DOCUMENT_ROOT'] . '/templates/aboutme/inc/footer.php'; ?>

    