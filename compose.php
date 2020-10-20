<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Mini Blog</title>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />

    <link
      href="https://fonts.googleapis.com/css?family=Muli:300,400,700|Playfair+Display:400,700,900"
      rel="stylesheet"
    />

    <link rel="stylesheet" href="fonts/icomoon/style.css" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/magnific-popup.css" />
    <link rel="stylesheet" href="css/jquery-ui.css" />
    <link rel="stylesheet" href="css/owl.carousel.min.css" />
    <link rel="stylesheet" href="css/owl.theme.default.min.css" />
    <link rel="stylesheet" href="css/bootstrap-datepicker.css" />
    <link rel="stylesheet" href="css/bootstrap-tagsinput.css" />
    <link rel="stylesheet" href="fonts/flaticon/font/flaticon.css" />
    <link rel="stylesheet" href="css/aos.css" />

    <link rel="stylesheet" href="css/style.css" />
  </head>
  <body>
  //TODO add author to the blog using session
  <?php
        error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING) ;
        $title = trim($_POST['title']);
        $subtitle = trim($_POST['subtitle']);
        $intro = trim($_POST['intro']);
        $main = trim($_POST['main']);
        $conclusion = trim($_POST['conclusion']);
        $additionalReadings = trim($_POST['additionalReadings']);
        $tags = trim($_POST['tags']);
        $categories = $_POST['categories'];
        $errTitle = $errSubtitle = $errIntro = $errMain = $errConclusion = $errAdditionalReadings = $errTags = $errCategories = '';
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty(trim($_POST['title']))){
                $errTitle = 'Title is required!';
            }

            if (empty(trim($_POST['subtitle']))){
              $errSubtitle = 'Subtitle is required!';
            }

            if (empty(trim($_POST['intro']))){
              $errIntro = 'Intro is required!';
            }else {
              if(strlen($_POST['intro']) > 100){
                $errIntro = 'Intro can be maximum 100 characters!';
              }
            }

            if (empty(trim($_POST['main']))){
              $errMain = 'Main is required!';
            }

            if (empty(trim($_POST['conclusion']))){
              $errConclusion = 'Conclusion is required!';
            }else {
              if(strlen($_POST['conclusion']) > 100){
                $errConclusion = 'Conclusion can be maximum 100 characters!';
              }
            }

            if (empty(trim($_POST['additionalReadings']))){
              $errAdditionalReadings = 'AdditionalReadings is required!';
            }else {
              if(!filter_var($_POST['additionalReadings'], FILTER_VALIDATE_URL)){
                $errAdditionalReadings = 'please provide a valid url!';
              }
            }

            if (empty(trim($_POST['tags']))){
              $errTags = 'Tags are required!';
            }

            if (!isset($_POST['categories'])){
              $errCategories = 'Categories are required!';
            }else {
              if(count($_POST['categories']) < 2){
                $errCategories = "please select atleast 2 categories";
              }
            }

            
            if(($errTitle == '') && ($errSubtitle == '') && ($errIntro == '') && ($errMain == '') && ($errConclusion == '') && ($errAdditionalReadings == '') && ($errTags == '') && ($errCategories == '')){
              include_once('creds.php');
                if(!$conn){
                    die("<br>Error in creating a connection: " . mysqli_connect_error());
                }else{
                  $final = '';
                    foreach($categories as $select){
                          $final .= $select;
                          $final .= ' ';
                    }

                    if(isset($_POST['submit'])){

                        $query = "INSERT INTO blogs (title, subtitle, intro, main, conclusion, additionalReadings, tags, categories) VALUES('$title','$subtitle','$intro','$main','$conclusion','$additionalReadings','$tags','$categories')";
                        if(mysqli_query($conn,$query)){
                              echo "Record inserted successfully.<br><br><a href=\"blog.php\">Show Data</a>";

                        }else{
                            echo "<script>
                                alert('A problem occurred while posting blog ');
                                </script>";
                        }
                    }  
            }
        }  
      }    
    ?>

    <div class="site-wrap">
      <div class="site-mobile-menu">
        <div class="site-mobile-menu-header">
          <div class="site-mobile-menu-close mt-3">
            <span class="icon-close2 js-menu-toggle"></span>
          </div>
        </div>
        <div class="site-mobile-menu-body"></div>
      </div>

      <header class="site-navbar" role="banner">
        <div class="container-fluid">
          <div class="row align-items-center">
            <div class="col-12 search-form-wrap js-search-form">
              <form method="get" action="#">
                <input
                  type="text"
                  id="s"
                  class="form-control"
                  placeholder="Search..."
                />
                <button class="search-btn" type="submit">
                  <span class="icon-search"></span>
                </button>
              </form>
            </div>

            <div class="col-4 site-logo">
              <a href="index.html" class="text-black h2 mb-0">Mini Blog</a>
            </div>

            <div class="col-8 text-right">
              <nav class="site-navigation" role="navigation">
                <ul
                  class="site-menu js-clone-nav mr-auto d-none d-lg-block mb-0"
                >
                  <li><a href="category.html">Home</a></li>
                  <li><a href="category.html">Politics</a></li>
                  <li><a href="category.html">Tech</a></li>
                  <li><a href="category.html">Entertainment</a></li>
                  <li><a href="category.html">Travel</a></li>
                  <li><a href="category.html">Sports</a></li>
                  <li><a href="blog.html">Create Blog</a></li>
                  <li class="d-none d-lg-inline-block">
                    <a href="#" class="js-search-toggle"
                      ><span class="icon-search"></span
                    ></a>
                  </li>
                </ul>
              </nav>
              <a
                href="#"
                class="site-menu-toggle js-menu-toggle text-black d-inline-block d-lg-none"
                ><span class="icon-menu h3"></span
              ></a>
            </div>
          </div>
        </div>
      </header>
      <div class="site-section bg-light">
        <div class="container">
          <div class="container">
            <div class="row same-height justify-content-center">
              <div class="col-md-12 col-lg-10">
                <div class="post-entry text-center">
                  <h1 class="">Publish A Blog</h1>
                </div>
              </div>
            </div>
          </div>
          <form method='POST' action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" >
            <h3>Header</h3>
            <div class="form-group">
              <label for="inputTitle">Title</label>
              <input
                type="text"
                name="title"
                class="form-control"
                id="inputTitle"
                placeholder="Your Title goes here..."
                value='<?php echo isset($_POST['title']) ? $_POST['title'] : ''; ?>'
              />
              <span class="text-danger"><?php echo $errTitle;?></span>
            </div>
            <div class="form-group">
              <label for="inputSubtitle">Subtitle</label>
              <input
                type="text"
                name="subtitle"
                class="form-control"
                id="inputSubtitle"
                placeholder="your subtitle goes here ..."
                value='<?php echo isset($_POST['subtitle']) ? $_POST['subtitle'] : ''; ?>'
              />
              <span class="text-danger"><?php echo $errSubtitle;?></span>
            </div>
            <h3>Body</h3>
            <div class="form-group">
              <label for="intro">Introductory Paragraph</label>
              <textarea
                class="form-control"
                id="intro"
                name="intro"
                rows="3"
                placeholder="Please keep it short. max limit: 100 char"
                value='<?php echo isset($_POST['intro']) ? $_POST['intro'] : ''; ?>'
              ></textarea>
              <span class="text-danger"><?php echo $errIntro;?></span>
              <label for="main">Main Body</label>
              <textarea
                class="form-control"
                name="main"
                id="main"
                rows="6"
                placeholder="put your blog body here"
                value='<?php echo isset($_POST['main']) ? $_POST['main'] : ''; ?>'
              ></textarea>
              <span class="text-danger"><?php echo $errMain;?></span>
              <label for="conclusion">Conclusions</label>
              <textarea
                class="form-control"
                id="conclusion"
                name="conclusion"
                rows="3"
                placeholder="Your conclusions go here. max limit: 100 char"
                value='<?php echo isset($_POST['conclusion']) ? $_POST['conclusion'] : ''; ?>'
              ></textarea>
              <span class="text-danger"><?php echo $errConclusion;?></span>
            </div>
            <h3>Footer</h3>
            <div class="form-row">
              <label for="basic-url">Additional Readings: </label>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon3"
                    >https://example.com/</span
                  >
                </div>
                <input
                  name="additionalReadings"
                  type="text"
                  class="form-control"
                  id="basic-url"
                  aria-describedby="basic-addon3"
                  value='<?php echo isset($_POST['additionalReadings']) ? $_POST['additionalReadings'] : ''; ?>'
                />
                <span class="text-danger"><?php echo $errAdditionalReadings;?></span>
              </div>
            </div>
            <br /><br />
            <h3>Tags and categories</h3>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="tags">Tags</label>
                <input
                  name="tags"
                  type="text"
                  value=""
                  data-role="tagsinput"
                  placeholder="Add tags by putting ,"
                  value='<?php echo isset($_POST['tags']) ? $_POST['tags'] : ''; ?>'
                />
                <span class="text-danger"><?php echo $errTags;?></span>
              </div>
              <div class="form-group col-md-6">
                <label for="categories">Categories</label>
                <select class="form-control multipicker" id="categories" name="categories[]" type="text" multiple>
                  <option value='nature'>Nature</option>
                  <option value='travel'>Travel</option>
                  <option value='politics'>Politics</option>
                  <option value='sports'>Sports</option>
                  <option value='tech'>Tech</option>
                </select>
                <span class="text-danger"><?php echo $errCategories;?></span>
              </div>
            </div>
            <div class="form-group">
              <div class="form-check">
                <input
                  class="form-check-input"
                  type="checkbox"
                  id="gridCheck"
                />
                <label class="form-check-label" for="gridCheck">
                  Agree to terms and conditions
                </label>
              </div>
            </div>
            <button name="submit" type="submit" class="btn btn-primary" value='Submit'>publish</button>
          </form>
        </div>
      </div>
    </div>

    <div class="site-footer">
        <div class="container">
          <div class="row mb-5">
            <div class="col-md-4">
              <h3 class="footer-heading mb-4">About Us</h3>
              <p>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                Placeat reprehenderit magnam deleniti quasi saepe, consequatur
                atque sequi delectus dolore veritatis obcaecati quae, repellat
                eveniet omnis, voluptatem in. Soluta, eligendi, architecto.
              </p>
            </div>
            <div class="col-md-3 ml-auto">
              <!-- <h3 class="footer-heading mb-4">Navigation</h3> -->
              <ul class="list-unstyled float-left mr-5">
                <li><a href="#">About Us</a></li>
                <li><a href="#">Advertise</a></li>
                <li><a href="#">Careers</a></li>
                <li><a href="#">Subscribes</a></li>
              </ul>
              <ul class="list-unstyled float-left">
                <li><a href="#">Travel</a></li>
                <li><a href="#">Lifestyle</a></li>
                <li><a href="#">Sports</a></li>
                <li><a href="#">Nature</a></li>
              </ul>
            </div>
            <div class="col-md-4">
              <div>
                <h3 class="footer-heading mb-4">Connect With Us</h3>
                <p>
                  <a href="#"
                    ><span class="icon-facebook pt-2 pr-2 pb-2 pl-0"></span
                  ></a>
                  <a href="#"><span class="icon-twitter p-2"></span></a>
                  <a href="#"><span class="icon-instagram p-2"></span></a>
                  <a href="#"><span class="icon-rss p-2"></span></a>
                  <a href="#"><span class="icon-envelope p-2"></span></a>
                </p>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12 text-center">
              <p>
                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                Copyright &copy;
                <script>
                  document.write(new Date().getFullYear());
                </script>
                All rights reserved | This template is made with
                <i class="icon-heart text-danger" aria-hidden="true"></i> by
                <a href="https://colorlib.com" target="_blank">Colorlib</a>
                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
              </p>
            </div>
          </div>
        </div>
    </div>
    
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/jquery-migrate-3.0.1.min.js"></script>
    <script src="js/jquery-ui.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.stellar.min.js"></script>
    <script src="js/jquery.countdown.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/bootstrap-datepicker.min.js"></script>
    <script src="js/bootstrap-tagsinput.js"></script>
    <script src="js/aos.js"></script>

    <script src="js/main.js"></script>
  </body>
</html>
