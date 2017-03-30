<br/>
<div class="row text-center">
    <span id="error">{error}</span>
    <span id="message">{message}</span>
</div>
<div class="row">
    <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#home">Plant Information</a></li>
        <li><a data-toggle="tab" href="#menu2">Sell Assembled Bot</a></li>
        <li><a data-toggle="tab" href="#menu1">Register with PRC</a></li>
        <li><a data-toggle="tab" href="#menu3">Reboot Plant</a></li>
    </ul>

    <div class="tab-content">
        <div id="home" class="tab-pane fade in active text-center">
            <h3><strong>Plant Information</strong></h3><br/>
            <div class="col-md-4 col-md-offset-4">
                <table class="table customTableWidth autoMargin">
                    <tr>
                        <td class="table-bordered"><strong>Balance</strong></td>
                        <td class="table-bordered">${balance}</td>
                    </tr>
                    <tr>
                        <td class="table-bordered"><strong>Boxes Bought</strong></td>
                        <td class="table-bordered">{boxes_bought}</td>
                    </tr>
                    <tr>
                        <td class="table-bordered"><strong>Parts Returned</strong></td>
                        <td class="table-bordered">{parts_returned}</td>
                    </tr>
                    <tr>
                        <td class="table-bordered"><strong>Parts Made</strong></td>
                        <td class="table-bordered">{parts_made}</td>
                    </tr>
                    <tr>
                        <td class="table-bordered"><strong>Bots Built</strong></td>
                        <td class="table-bordered">{bots_built}</td>
                    </tr>
                    <tr>
                        <td class="table-bordered"><strong>Manufacturing Part</strong></td>
                        <td class="table-bordered">{making}</td>
                    </tr>
                    <tr>
                        <td class="table-bordered"><strong>Last Part Made</strong></td>
                        <td class="table-bordered">{last_made}</td>
                    </tr>
                </table>
            </div>
        </div>
        <div id="menu1" class="tab-pane fade text-center">
            <h3><strong>Register with PRC</strong></h3><br/>
            <form action="/manage/register" method="POST">
                <label for="plant">Plant Name</label>
                <span>kiwi</span><br/>
                <label for="token">Token</label>
                <input class="form-control customFormControl autoMargin" type="text" name="token"/>
                <div class="addTopPadding"></div>
                <input type="submit" class="btn btn-success" value="Register"/>
            </form>

        </div>
        <div id="menu2" class="tab-pane fade text-center">
            <h3><strong>Sell Assembled Bot</strong></h3>
            <div class="row">
                <div class="col-xs-12">
                    <h1 class="text-center"">Assembled Robots</h1>
                    {robots}
                    <div class="col-xs-6 space">
                        <img src="/img/{image1}.jpeg"/>
                        <img src="/img/{image2}.jpeg"/>
                        <img src="/img/{image3}.jpeg"/>
                        <h1>${amount}</h1>
                        <form action="/manage/sell" method="POST">
                            <button class="btn btn-success" type="submit" value="{id}" name="robot" >Sell Robot</button>
                        </form>
                    </div>
                    {/robots}
                </div>
            </div>
        </div>
        <div id="menu3" class="tab-pane fade text-center">
            <h3><strong>Reboot Plant</strong></h3><br/>
            <form action="/manage/reboot" method="POST">
                <input type="submit" class="btn btn-success" value="Reboot Plant"/>
            </form>
        </div>
    </div>
</div>