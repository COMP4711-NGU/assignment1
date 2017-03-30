<div class="row text-center">
    <span id="error">{error}</span>
    <span id="message">{message}</span>
</div>
<div class="row">
    <!-- TODO add images -->
    <div class="row noMargin noBottomMargin">
        <div class="col-xs-12 text-center noBottomMargin">
            <a href="manageparts/build"><button class="btn btn-success">Build More Parts</button></a>
            <a href="manageparts/buy"><button class="btn btn-success">Buy Parts</button></a>
        </div>
    </div>
    <table class="table table-bordered">
        <div class="row noMargin topPadding">
        {parts}
            <div class="col-xs-4">

                    <a href="manageparts/{id}"><img class="img-responsive" src="/img/{partCode}.jpeg" /></a><br/>
                    <span><strong>Line:</strong> {line}</span><br/>
                    <span><strong>Model:</strong> {model}</span>
            </div>
            {/parts} 
        </div>
    </table>
</div>