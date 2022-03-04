<div id = "menu">

          <ul>

            <li>
              <a href = "dashboard">Dashboard</a>
            </li>

            <li>
              <a href = "published">Published</a>
            </li>

            <li>
              <a href = "add_post">Add New</a>
            </li>

            <li>
              <a href = "pending">Pending</a>
            </li>

            <li>
              <a href = "drafts">Drafts</a>
            </li>

            <li>
              <a href = "trash">Trash</a>
            </li>

            <?php if($_SESSION['author_role'] == 'admin'): ?>

            <?php echo
              "<li>".
                "<a href = 'add_author'>"."Add Writer"."</a>".
              "</li>"; 
           
              echo "<li>".
                "<a href = 'add_subject'>"."Add Category"."</a>".
              "</li>"; 
            ?>

            <?php endif; ?>

            <li>
              <a href = "logout">Logout</a>
            </li>

          </ul>    

        </div>  <!-- end of menu -->
