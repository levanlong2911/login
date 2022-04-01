<div class="col-md-4">
                    <div class="content-right">
                        <div class="content-right-top">
                            <h4>Danh mục tin tức</h4>
                            <ul class="nav flex-column">
                              <?php
                                $query = "SELECT * FROM cat";
                                $ketqua = $mysqli->query($query);
                                while($ar_cat = mysqli_fetch_assoc($ketqua)){
                                  $id_cat = $ar_cat['id_cat'];
                                  $ten_danhmuc = $ar_cat['ten_danhmuc'];
                                  $nameRepalace = utf8ToLatin($ten_danhmuc);
                                  $url = '/' . $nameRepalace . '-' . $id_cat;
                              ?>
                              <li class="nav-item">
                                <a class="nav-link active" href="<?php echo $url; ?>"><?php echo $ar_cat['ten_danhmuc']; ?></a>
                              </li>
                              <?php
                                }
                              ?>
                            </ul>
                        </div>
                        <div class="content-right-bootom">
                            <h4>Bài viết mới nhất</h4>
                            <ul class="nav flex-column">
                              <?php
                                $query2 = "SELECT * FROM story where active > 0 order by id_story desc limit 3";
                                $ketqua2 = $mysqli->query($query2);
                                while($ar_story = mysqli_fetch_assoc($ketqua2)){
                                  $id_story = $ar_story['id_story'];
                                  $name = $ar_story['name'];
                                  $nameRepalace_story1 = utf8ToLatin($name);
                                  $url_story1 = '/' . $nameRepalace_story1 . '-' . $id_story . '.html';
                              ?>
                              <li class="nav-item">
                                <a class="nav-link" href="<?php echo $url_story1; ?>"><?php echo $ar_story['name']; ?></a>
                              </li>
                              <?php
                                }
                              ?>
                            </ul>
                        </div>
                    </div>
                </div>