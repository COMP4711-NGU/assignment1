<div class="row">
    <table class="table table-bordered">
        <tr>
            <th>Purchase ID</th>
            <th>Transaction ID</th>
            <th>Transaction Type</th>
            <th>Assemblies Code</th>
            <th>Date</th>
            <th>Time</th>
            <th>Money</th>
        </tr>
        {history}
        <tr>
            <td>{purchaseId}</td>
            <td>{transactionId}</td>
            <td>{transactionType}</td>
            <td>{AssembliesCode}</td>
            <td>{date}</td>
            <td>{time}</td>
            <td>{money}</td>
        </tr>
        {/history} 
    </table>
</div>