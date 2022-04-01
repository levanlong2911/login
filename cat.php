<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/templates/aboutme/inc/header.php'; ?>
<?php
  $id_cat = $_GET['id'];
  $query1 = "SELECT * FROM cat where id_cat = $id_cat";
  $ketqua1 = $mysqli->query($query1);
  $ar_cat = mysqli_fetch_assoc($ketqua1);
?> 
<?php
  $query3 = "SELECT count(*) AS TSD FROM story where id_cat = $id_cat AND active > 0";
  $ketqua3 = $mysqli->query($query3);
  $ar_storypt = mysqli_fetch_assoc($ketqua3);
  $tongsd = $ar_storypt['TSD'];
  // số bài viết trên trang
  $row_count = ROW_COUNT;
  //tổng số trang
  $tongst = ceil($tongsd/$row_count);
  //trang hiện tại
  $current_page = 1;
  if(isset($_GET['page'])){
    $current_page = $_GET['page'];
  }
  //off set
  $offset = ($current_page-1)*$row_count;

?>
<script type="text/javascript">
  document.title = 'Tin tức';
</script>   
<div class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                  <div class="content-left-cat">
                    <h3><?php echo $ar_cat['ten_danhmuc']; ?></h3>
                    <hr />
                    <ul class="list-unstyled">
                      <?php
                        $id_cat = $_GET['id'];
                        $query = "SELECT * FROM story where id_cat = $id_cat AND active > 0 order by id_story desc limit $offset, $row_count";
                        $ketqua = $mysqli->query($query);
                        while($ar_story = mysqli_fetch_assoc($ketqua)){
                          $id_story = $ar_story['id_story'];
                          $name = $ar_story['name'];
                          $active = $ar_story['active'];
                          $nameRepalace_story = utf8ToLatin($name);
                          $url_story = '/' . $nameRepalace_story . '-' . $id_story . '.html';
                      ?>
                      <li class="media">
                        <div class="row">
                          <div class="col-md-4">
                            <div class="img">
                              <?php
                                if($ar_story['picture'] != ''){
                              ?>
                              <a href="<?php echo $url_story; ?>"><img class="mr-3" src="/files/<?php echo $ar_story['picture']; ?>" alt="Generic placeholder image" width="185px" height="150px"></a>
                              <?php } ?>
                            </div>
                          </div>
                          <div class="col-md-8">
                            <div class="media-body">
                              <h5 class="mt-0 mb-1"><a href="<?php echo $url_story; ?>"><?php echo $ar_story['name']; ?></a></h5>
                              <p class="describe"><?php echo $ar_story['preview']; ?></p>
                            </div>
                          </div>
                        </div>
                      </li>
                      <hr />
                      <?php } ?>
                    </ul>
                  </div>
                  <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center">
                      <li class="page-item">
                        <a class="page-link" href="#" aria-label="Previous">
                          <span aria-hidden="true">&laquo;</span>
                          <span class="sr-only">Previous</span>
                        </a>
                      </li>
                      <?php
                        for($i=1; $i <= $tongst; $i++){
                          $nameRepalace = utf8ToLatin($ar_cat['ten_danhmuc']);
                          $url = '/' . $nameRepalace . '-' . $id_cat . '/page/' . $i;
                      ?>
                        <?php
                          if($i == $current_page){
                        ?>
                          <li class="page-item"><a class="page-link"><?php echo $current_page; ?></a></li> 
                        <?php
                          }else{
                        ?>
                          <li class="page-item"><a class="page-link" href="<?php echo $url;?>"><?php echo $i; ?></a></li> 
                        <?php
                          }
                        ?>
                      <?php
                        }
                      ?>
                      <li class="page-item">
                        <a class="page-link" href="#" aria-label="Next">
                          <span aria-hidden="true">&raquo;</span>
                          <span class="sr-only">Next</span>
                        </a>
                      </li>
                    </ul>
                  </nav>
                </div>
                <!--right bar-->
                <?php include_once $_SERVER['DOCUMENT_ROOT'] . '/templates/aboutme/inc/right-bar.php'; ?>
                <!--right bar-->
            </div>
        </div>
    </div>
    <?php include_once $_SERVER['DOCUMENT_ROOT'] . '/templates/aboutme/inc/footer.php'; ?>
    