<div class="row text-center">
    <span id="error">{error}</span>
    <span id="message">{message}</span>
</div>
<form action="assembly/handle" method="POST">
<div class="row">
    <h1 class="text-center customTopBorder">Top Pieces</h1>
    <table class="table table-bordered">
        <div class="row noMargin customTopBorder customTopPadding noBottomMargin">
        {topParts}
        <div class="col-xs-4 text-center">
                <a href="manageparts/{id}"><img class="img-responsive" src="/img/{partCode}.jpeg" /></a><br/>
                <span><strong>Line:</strong> {line}</span><br/>
                <span><strong>Model:</strong> {model}</span><br/>
                <input type="checkbox" value="{id}" id="checkbox" name="top" />
        </div>
        {/topParts}
        </div>
    </table>



    <h1 class="text-center customTopBorder">Torso Pieces</h1>
    <table class="table table-bordered">
        <div class="row noMargin customTopBorder customTopPadding noBottomMargin">
            {torsoParts}
            <div class="col-xs-4 text-center">
                    <a href="manageparts/{id}"><img class="img-responsive" src="/img/{partCode}.jpeg" /></a><br/>
                    <span><strong>Line:</strong> {line}</span><br/>
                    <span><strong>Model:</strong> {model}</span><br/>
                    <input type="checkbox" value="{id}" id="checkbox" name="torso" />
            </div>
            {/torsoParts}
        </div>
    </table>



    <h1 class="text-center customTopBorder">Bottom Pieces</h1>
    <table class="table table-bordered">
        <div class="row noMargin customTopBorder customTopPadding noBottomMargin">
        {bottomParts}
        <div class="col-xs-4 text-center">
                <a href="manageparts/{id}"><img class="img-responsive" src="/img/{partCode}.jpeg" /></a><br/>
                <span><strong>Line:</strong> {line}</span><br/>
                <span><strong>Model:</strong> {model}</span><br/>
                <input type="checkbox" value="{id}" id="checkbox" name="bottom" />
        </div>
        {/bottomParts}
        </div>
    </table>

    <div class="text-center">
        <input class="btn btn-primary" type="submit" value="Assemble" name="submitType" />
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
        <h1 class="text-center" id="robots">Assembled Robots</h1>
    {robots}
    <div class="col-xs-6 space">
        <img src="/img/{image1}.jpeg"/>
        <img src="/img/{image2}.jpeg"/>
        <img src="/img/{image3}.jpeg"/>
        <h1>${amount}</h1>
    <input type="checkbox" value="{id}" id="checkbox" name="robot" />
    </div>
    {/robots}
    </div>
</div>
</form>