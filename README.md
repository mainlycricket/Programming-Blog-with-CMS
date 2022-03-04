# Programming-Blog-with-CMS

<a href = "https://ace-dev-blog.herokuapp.com/" target = "_blank">AceDevBlog</a> is a programming blog with its own content management system. Programs - and not full-fledged articles - because obviously the former is easier to manage, and this is a minor project (plus, I'm still learning).

This is still not a industry-level project. However, I will keep adding new features to it, and make it more robust.

Database has played a huge role in this project.

The common viewers can read the programs, and the authors - the admins and the contributors (differentiated by the permissions) - are responsible for managing the content.

<h3>Common View</h3>

<p>
  The home page is pretty responsive, depending on the screen size.
</p>
<p>
  Subjects in the menu bar and cards are dynamic through the database, and when a new category is added, it will be automatically added here.
</p>

<p>
  Programs are better visible in the desktop mode. For lengthy programs, there is a vertical scroll bar.
</p>

<p>
  Admin and contributors can login from the login page. An error will be displayed on entering invalid credentials. If the user is logged in, he will be redirected to the dashboard, and the 'dashboard' option will be displayed instead of the 'login' in the menu.
</p>

<h3>Admin Panel</h3>

<p>
Admins and Contributors can access the admin panel after logging in. An admin can publish a program directly, while a contributor can't. The contributor needs to submit the post, which will be published by the admin, afterwards. The admin also enjoys the privilige of adding new admins as well as the contributors and new subjects.

The authors can also save drafts and edit them later.

The admin can edit and delete any post, while the contributors can edit and delete only their posts.

The one who deletes a post can retrieve it to its previous state or delete it permanently. Also, the contributors can move their submitted posts to drafts.

The admin panel can be viewed in <a href = "https://twitter.com/mainly_coding/status/1474402482876866563?s=20" target = "_blank">this Twitter thread.</a>
</p>

<h3>Plugin</h3>

<p>
  We have used <b><a href="https://ckeditor.com/ckeditor-4/">CKEditor</a></b> as a plugin for an editor interface to be used while adding a new post or editing an existing one in the admin panel. 
</p>

<h3>Team</h3>

<p>
I have managed and developed the entire admin panel as well as the database part.

As this is a college project, two friends of mine - [Aman Katiyar](https://github.com/AmanKtyr) and [Vinay Kumar Vishwakarma](https://github.com/DarkVinay) - contributed as well. They designed the beautiful home page, including the footer, and the login page.

I'm also thankful to <a href = "https://github.com/anujsahujuly2002-dev" target = "_blank">Mr. Anuj Kumar Sahu</a> for his valuable inputs at times.
</p>
