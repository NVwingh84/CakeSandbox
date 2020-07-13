<!-- File: templates/Articles/index.php -->

<h1>Articles</h1>
<table>
    <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Body</th>        
        <th>Created</th>
    </tr>

    <!-- Here is where we iterate through our $articles query object, printing out article info -->
    <!-- Routing is fine, file is read, need to pass variable -->
    
    <tr>
        <td>
            <?php echo ($article['id']) ?>
        </td>
        <td>
            <!-- published & created when through mysql CLI or in system, not directly through database -->
            <?php echo ($article['title']) ?>
        </td>
        <td>
            <!-- target = _blank refers to opening a new page  -->
            <?php echo ($article['body']) ?>
        </td>
        <td>
            <?php echo $article['created'] ?>
        </td>
    </tr>
    
</table>
