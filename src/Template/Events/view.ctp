<!-- File: templates/Events/index.php -->



<h1><?php echo $event['title'] ?> </h1>

<table>
    <tr>
        <th>ID</th>
        <th>Title</th>
        <th>City</th>
        <th>Dates</th>     
    </tr>
    <tr>
        <td>
            <?php echo ($event['id']) ?>
        </td>
        <td>
            <!-- published & created when through mysql CLI or in system, not directly through database -->
            <?php echo ($event['title']) ?>
        </td>
        <td>
            <?php echo ($event['city']) ?>
        </td>       
        <td>
            <?php echo ($event['start_date']) ?> - <?php echo ($event['end_date']) ?>
        </td>     
    </tr>
    
</table>

