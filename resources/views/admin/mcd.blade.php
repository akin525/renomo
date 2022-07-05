@include('admin.layouts.sidebar')
<div class="midde_cont">
    <div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-12">
                <div class="page_title">
                    <h2>Withdraw From Mcd</h2>
                </div>
            </div>
        </div>

        <div style="padding:90px 15px 20px 15px">
            <h4 class="align-content-center text-center">Withdraw From MCD Wallet </h4>
            <div class="card">
                <div class="card-body">
                    <div class="box w3-card-4"
                    <div class="row page-breadcrumbs">
                        <div class="col-md-12 align-self-center">
                            <!--            <h4 class="theme-cl">Update Profile</h4>-->
                        </div>
                    </div>

                    <?php
                    $curl = curl_init();

                    curl_setopt_array($curl, array(
                        CURLOPT_URL => "https://api.paystack.co/bank",
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => "",
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 30,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_SSL_VERIFYHOST => 0,
                        CURLOPT_SSL_VERIFYPEER => 0,
                        CURLOPT_CUSTOMREQUEST => "GET",
                        CURLOPT_HTTPHEADER => array(
                            "Authorization: Bearer sk_test_280c68e08f76233b476038f04d92896b4749eec3",
                            "Cache-Control: no-cache",
                        ),
                    ));

                    $response = curl_exec($curl);
                    $err = curl_error($curl);
                    curl_close($curl);

                    if ($err) {
                        echo "cURL Error #:" . $err;
                    } else {
//    echo $response;
                    }
                    $data = json_decode($response, true);
                    $success = $data["status"];
                    foreach($data['data'] as $plans){
//    echo $plans['name'];
//    echo $plans['code'];
                    }

                    //echo $networkcode . " ". $number;

                    ?>

                    <div class="change_pass_field float_left">
                        <form action="" method="post">
                            <div class="subscribe-area">
                                <label>Enter Amount</label>
                                <input  type="number" name="amount" class="form-control" required/>
                                <!--                                            <b class="text-success fa-bold" id="vtv1"></b>-->
                            </div>
                            <div class="payment_gateway_wrapper payment_select_wrapper">
                                <label>Select Your Bank :</label>
                                <select data-required="true" class="form-control" id="value" name="value" required>

                                    <option selected>choose Bank Name</option>
                                    @foreach($data['data'] as $plans)
                                    <option value="{{$plans['code']}}" id="<?php echo $plans['name']; ?>">{{$plans['name']}}</option>
                                        @endforeach
                                </select>

                                <!--                                            onchange="document.getElementById('hello').value=this.is"-->
                                <!--                                            <input type="text" id="hello" name="" value="">-->
                            </div>
                            <div class="form-group">
                                <label>Account Number :</label>
                                <input  type="tel" id="tvphone1" name="number"><button id="btnv1" type="button" onclick="shoUser()">Verify</button>
                                <b class="text-success fa-bold" id="vtv1"></b>
                            </div>
                            <div class="form-group">
                                <label>Reselect Bank:</label>
                                <select data-required="true" class="form-control" id="value" name="full" required>

                                    <option selected>choose Bank Name</option>
                                    <?php
                                    foreach($data['data'] as $plans){
                                    ?>
                                    <option value="<?php echo $plans['name']; ?>" id="<?php echo $plans['name']; ?>"><?php echo $plans['name']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Enter Verify Name</label>
                                <input  type="text" name="full" class="form-control" placeholder="Please Enter The Name Display After Very Account No" required/>
                                <!--                                            <b class="text-success fa-bold" id="vtv1"></b>-->
                            </div>
                            <?php
                            $query="SELECT * FROM  admin WHERE username ='" . $_SESSION['username'] . "'";
                            $result = mysqli_query($con,$query);

                            while($row = mysqli_fetch_array($result))
                            {
                                $user="$row[username]";
                            }
                            ?>
                            <div class="change_field">
                                <input type="hidden" name="username" value="<?php echo $user; ?>">
                            </div>
                            <button type="submit" class="btn btn-outline-success"><i class="fa fa-check"></i> Withdraw</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
