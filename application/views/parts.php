<div class="row">
    <!-- TODO add images -->
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>Part Code</th>
            <th>Creation Plant</th>
            <th>CA Code</th>
            <th>Time Of Creation</th>
        </tr>
        {parts}
        <tr>
            <td>{id}</td>
            <td>{partCode}</td>
            <td>{creationPlant}</td>
            <td>{caCode}</td>
            <td>{creationDateTime}</td>
        </tr>
        {/parts} 
    </table>
</div>