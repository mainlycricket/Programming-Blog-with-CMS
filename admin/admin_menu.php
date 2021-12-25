<div id = "menu">

          <ul>

            <li>
              <a href = "index.php">Dashboard</a>
            </li>

            <li>
              <a href = "published_posts.php">Published</a>
            </li>

            <li>
              <a href = "add_post.php">Add New</a>
            </li>

            <li>
              <a href = "pending_posts.php">Pending</a>
            </li>

            <li>
              <a href = "draft_posts.php">Drafts</a>
            </li>

            <li>
              <a href = "deleted_posts.php">Trash</a>
            </li>

            <?php if($_SESSION['author_role'] == 'admin'): ?>

            <?php echo
              "<li>".
                "<a href = 'add_writer.php'>"."Add Writer"."</a>".
              "</li>"; 
            ?>

            <?php endif; ?>

            <?php if($_SESSION['author_role'] == 'admin'): ?>

            <?php echo
              "<li>".
                "<a href = 'add_category.php'>"."Add Category"."</a>".
              "</li>"; 
            ?>

            <?php endif; ?>

            <li>
              <a href = "logout.php">Logout</a>
            </li>

          </ul>    

        </div>  <!-- end of menu -->
