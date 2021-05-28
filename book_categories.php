<?php

  
  $pageTitle = 'Book Store';

  include './init.php';

  if(isset($_GET["category"])){
    $get_category = $_GET["category"];
    $books = get_data(
      "books",
      "book_id,title,book_cover",
      "category=$get_category",
      "WHERE category=:category"
    );
  }
  else {
    $books = get_data(
      "books",
      "book_id,title,book_cover"
    );
  }

  $categories = get_data(
    "books",
    "DISTINCT category",
    null,
    null,
    null,
    "ORDER BY category ASC"
  );

?>

<!-- nav bar -->
<div class="container-fluid b-back">
  <div class="n-container nav-container">
    <div class="a-box"><a class="text-color" href="index.php"><img src="<?php echo $images . "main/book.jpg" ?>"
          width="30" height="30"></a></div>
    <div class="a-box">
      <a class="text-color" href="book_categories.php"><img src="<?php echo $images . "main/categories.svg" ?>"> Book
        Categories</a>
    </div>
    <div class="a-box">
      <a class="text-color" href="author.php"><img src="<?php echo $images . "main/author.svg" ?>"> Authors of
        books</a>
    </div>
    <div class="a-box"><input type="search" id="form1" class="form-control" style=" border-radius: 20px;"
        placeholder="Search" aria-label="Search" aria-describedby="search-addon" /></div>
  </div>
</div>
<div class="a-container">
  <div class="a-container discription-style1">
    <div class="a-container text-color1 h4" style="padding: 10px;margin-top: 120px;">
      <div style="margin-top: 20px ;">
        <p style="font-family:Georgia, 'Times New Roman', Times, serif; font-weight: 500;font-size: 40px;">E-Book
          Library</p>
      </div>
      <div style="font-size: 30px; font-weight: 200; color:white ;">
        <p style="margin-top: 10px;"> An electronic library open for books</p>
      </div>
    </div>
  </div>
</div>

<div style="padding: 5px; margin: 10px 120px ">
  <p style="font-size: xx-large; color: black; font-weight: 500; margin-bottom: 5px;">Book Categories</p>
  <p style="padding: 5px; color:#3baf9f; font-size: large;">
    <?php echo count($categories) ?> Categories
  </p>
</div>

<div style="margin-left: 110px; margin-right: 65px;"><input type="search" id="form1" class="form-control"
    style=" border-radius: 20px; width: 80%; " placeholder="Search for category" aria-label="Search"
    aria-describedby="search-addon" />
</div>


<main class="b-container main-style">
<div class="above-book-area a-box above-book-style">

    <div class="a-box">
      <div>
        <a class="text-color" href="#popular"><img src="<?php echo $images . "main/mf.svg" ?>" width="300" height="75"
            alt="#popular">
          <p>Newly added</p>
        </a>
      </div>
    </div>
    <div class="a-box">
      <div>
        <a class="text-color" href="#latest"><img src="<?php echo $images . "main/mft.svg" ?>" width="300" height="75"
            alt="#latest">
          <p>Most famous</p>
        </a>
      </div>
    </div>
  </div>
  
  <div class="book-category-area a-box book-category-style">
    <div>
      <a class="text-color book-category-text" href="book_categories.php">
        <p> Book Categories </p>
      </a>
    </div>
    <?php

    foreach($categories as $category){
      echo "<div>";
        echo "<a class='text-color' href='?category=". $category["category"] ."'>";
          echo "<p>". $category["category"] ."</p>";
        echo "</a>";
      echo "</div>";
    }
    ?>
  </div>

  <div class="book-area a-box book-grid">
    <?php

      foreach ($books as $book){
        $book_id = $book["book_id"];
        $author_id = get_data(
          "book_auth",
          "author_id",
          "book_id=$book_id",
          "WHERE book_id=:book_id",
          "LIMIT 1"
        )[0]["author_id"];
        $author_name = get_data(
          "authors",
          "author_name",
          "author_id=$author_id",
          "WHERE author_id=:author_id",
          "LIMIT 1"
        )[0]["author_name"];
        echo "<div class='a-box book-style1'>";
        echo "<div>";
        echo "<a href='#book1'>";
        echo "<img src='" . $book["book_cover"] . "' width='140vw' 'height='200'
        alt='#book1'>";
        echo "</a>";
        echo "<p>";
        echo "<div>";
        echo "<a class='text-color' href='#book name'>";
        echo "<p>". $book["title"] ."</p>";
        echo "</a>";
        echo "</div>";
        echo "<a class='text-color' href='#book Authors'>";
        echo "<p>". $author_name ."</p>";
        echo "</a>";
        echo "</p>";
        echo "</div>";
        echo "</div>";
      }      
    ?>
  </div>
  </div>
</main>

<footer class="container-fluid f-back">
  <div class="acontainer-fluid footer-style">
    Intellectual property is reserved for the authors mentioned on the books and the library is not responsible for
    the ideas of the authors<br> Old and forgotten books that have become past to preserve Arab and Islamic heritage
    are published,<br> and books that their authors are accepted to published.<br> The Universal Declaration of Human
    Rights states: "Everyone has the right freely to participate in the cultural life of the community,<br> to enjoy
    the arts and to share in scientific
    advancement and its benefits.<br> Everyone has the right to the protection of the moral and material interests
    resulting from any scientific, literary or artistic production of which he is the author".
  </div>
</footer>
</body>

</html>