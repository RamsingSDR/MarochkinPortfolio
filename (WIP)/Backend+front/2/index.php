<?php include("app/include/meta.php")?>
    <title>Main page</title>
  </head>
  <body>
<?php include("app/include/header.php")?>
<!-- MAIN_BODY -->
      <div class="container" id="main-body">
        <div class="main-description">
          <h1>Carousel title</h1>
          <img src="images/carousel_plug.png" title="(WIP)Тут планируется виджет-карусель" class="carousel-plug">
        </div>
        <div class="container">
          <div class="content row">
            <div class="main-content col-md-9 col-12" id="publish-row">
              <p class="title-mid">Catching big topic title</p>
                  <div class="post row">
                    <div class="img col-12 col-md-4">
                      <img src="images/product/product1.png" class="img-fluid" id="publish-img" title="This is picture of topic">
                    </div>
                    <div class="post_text col-12 col-md-8">
                      <h3>
                        <a href="topic_page.php">Small topic title 1</a>
                      </h3>
                      <i class="fa fa-user">(WIP)Author's name</i>
                      <i class="fa fa-calendar">Mar 11,2019</i>
                      <p class="preview-text">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        tempor incididunt ut labore
                      </p>
                    </div>
                  </div>
                  <div class="post row">
                    <div class="img col-12 col-md-4">
                      <img src="images/product/product1.png" class="img-fluid" id="publish-img" title="This is picture of topic">
                    </div>
                    <div class="post_text col-12 col-md-8">
                      <h3>
                        <a href="topic_page.php">Small topic title 2</a>
                      </h3>
                      <i class="fa fa-user">(WIP)Author's name</i>
                      <i class="fa fa-calendar">Mar 11,2019</i>
                      <p class="preview-text">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        tempor incididunt ut labore
                      </p>
                    </div>
                  </div>
                  <div class="post row">
                    <div class="img col-12 col-md-4">
                      <img src="images/product/product1.png" class="img-fluid" id="publish-img" title="This is picture of topic">
                    </div>
                    <div class="post_text col-12 col-md-8">
                      <h3>
                        <a href="topic_page.php">Small topic title 3</a>
                      </h3>
                      <i class="fa fa-user">(WIP)Author's name</i>
                      <i class="fa fa-calendar">Mar 11,2019</i>
                      <p class="preview-text">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        tempor incididunt ut labore
                      </p>
                    </div>
                  </div>
                  <div class="post row">
                    <div class="img col-12 col-md-4">
                      <img src="images/product/product1.png" class="img-fluid" id="publish-img" title="This is picture of topic">
                    </div>
                    <div class="post_text col-12 col-md-8">
                      <h3>
                        <a href="topic_page.php">Small topic title 4</a>
                      </h3>
                      <i class="fa fa-user">Author's name</i>
                      <i class="fa fa-calendar">Mar 11,2019</i>
                      <p class="preview-text">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        tempor incididunt ut labore
                      </p>
                    </div>
                  </div>
                  <div class="sidebar col-md-3 col-12">    
                  </div>
            </div>
<!-- SIDEBAR -->
            <div class="sidebar col-md-3">
              <div class="section search">
                <h3>Search</h3>
                <form action="index.html" method="get">
                  <input type="text" name="search-term" class="text-input" placeholder="Let's find something...">
                </form>
              </div>
              <div class="section topics">
                <h3>Topics</h3>
                <ul>
                  <li><a href="#">topic_name1</a></li>
                  <li><a href="#">topic_name2</a></li>
                  <li><a href="#">topic_name3</a></li>
                  <li><a href="#">topic_name4</a></li>
                  <li><a href="#">topic_name5</a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
<?php include("app/include/footer.php")?>
