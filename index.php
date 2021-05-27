<?php

  $pageTitle = 'Book Store';

  include './init.php';

  $books = get_data(
    "books",
    "book_id,title,book_cover"
  );

  $categories = get_data(
    "books",
    "DISTINCT category",
    null,
    null,
    null,
    "ORDER BY category ASC"
  );

  $authors = get_data(
    "authors",
    "COUNT(author_id) AS count"
  );

?>

<!-- nav bar -->
<div class="container-fluid b-back">
  <div class="n-container nav-container">
    <div class="a-box"><a class="text-color" href="index.php"><img src="<?php echo $images . 'main/book.jpg' ?>"
          width="30" height="30"></a></div>
    <div class="a-box">
      <a class="text-color" href="book_categories.php"><img src="<?php echo $images . 'main/categories.svg' ?>"> Book
        Categories</a>
    </div>
    <div class="a-box">
      <a class="text-color" href="author.php"><img src="<?php echo $images . 'main/author.svg' ?>"> Authors of
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
  <div class="a-container discription-style2">
    <div class="a-container book-grid">
      <div class="a-box">
        <div class="text-color2"><img src="<?php echo $images . "main/online-education.svg" ?>" width="150"
            height="150">
          <p>600 Visitors monthly<br> More than 6000 visitors who are interested in e-books visit E-Book Library website
            yearly.
          </p>
        </div>
      </div>
      <div class="a-box">
        <div class="text-color2"><img src="<?php echo $images . "main/home_search.svg" ?>" width="150" height="150">
          <p>4000 A daily search<br> More than 40,000 searches for an Arabic book happen monthly
          </p>
        </div>
      </div>
      <div class="a-box">
        <div class="text-color2"><img src="<?php echo $images . "main/digital-library.svg" ?>" width="150"
            height="150">
          <p><?php echo count($books); ?> Book <br> hundreds of books published on E-Book Library was published by the library team
          </p>
        </div>
      </div>
      <div class="a-box">
        <div class="text-color2"><img src="<?php echo $images . "main/mobile-app.svg" ?>" width="150" height="150">
          <p><?php echo $authors[0]['count']; ?> Author<br> E-Book Library aims to create the largest database of e-book throughout history
          </p>
        </div>
      </div>
    </div>
  </div>
</div>

<main class="b-container main-style">
  <div class="a-box above-book-area above-book-style">
    <div class="a-box">
      <div>
        <a class="text-color" href="#trending"> <img src="<?php echo $images . "main/trend_books1.svg" ?>" width="200"
            height="75" alt="#trending">
          <p>Newly added Books</p>
        </a>
      </div>
    </div>
    <div class="a-box">
      <div>
        <a class="text-color" href="#popular"><img src="<?php echo $images . "main/best_books_all_days1.svg" ?>"
            width="200" height="75" alt="#popular">
          <p>Newly added Authors</p>
        </a>
      </div>
    </div>
    <div class="a-box">
      <div>
        <a class="text-color" href="#latest"><img src="<?php echo $images . "main/new_books1.svg" ?>" width="200"
            height="75" alt="#latest">
          <p>Newly added Categories</p>
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

</main>
<footer class="container-fluid f-back">
  <div class="acontainer-fluid footer-style">
    Intellectual property is reserved for the authors mentioned on the books and the library is not responsible for the
    ideas of the authors<br> Old and forgotten books that have become past to preserve Arab and Islamic heritage are
    published,<br> and books that their authors are accepted to published.<br> The Universal Declaration of Human Rights
    states: "Everyone has the right freely to participate in the cultural life of the community,<br> to enjoy the arts
    and to share in scientific
    advancement and its benefits.<br> Everyone has the right to the protection of the moral and material interests
    resulting from any scientific, literary or artistic production of which he is the author".
  </div>
</footer>


<?php
include $layouts . 'footer.php';
?>