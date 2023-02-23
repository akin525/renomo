@include('layouts.sidebar')
<link rel="stylesheet" href="{{asset('Buy Data _ MobileNig_files/w3(1).css')}}">
<link rel="stylesheet" href="{{asset('prism.css')}}">
<script src="{{asset('prism.js')}}"></script>

<link rel="stylesheet" href="{{asset('Buy Data _ MobileNig_files/w3(2).css')}}">
<link rel="stylesheet" href="{{asset('Buy Data _ MobileNig_files/font-awesome.min.css')}}">
<link href="{{asset('Buy Data _ MobileNig_files/icon" rel="stylesheet')}}">


<div class="" id="buy_data" style="margin-top:50px">
    <h1 class="w3-xxxlarge " style="color: #28a745"><b>API Access</b></h1>
    <hr style="width:50px;border:5px #28a745" class="w3-round">
<style>
    .code-frame {
        border: 1px solid #ddd;
        border-radius: 3px;
        overflow: auto;
        margin-bottom: 1em;
    }

    pre {
        margin: 0;
        padding: 1em;
        font-size: 14px;
        font-family: Consolas, monospace;
        line-height: 1.5;
    }
</style>
    <br>
    <div class="code-frame">
{{--    <pre class="language-javascript">--}}
{{--    <code >--}}

{{--        $curl = curl_init();--}}

{{--        curl_setopt_array($curl, array(--}}
{{--        CURLOPT_URL => 'https://renomobilemoney.com/api/run',--}}
{{--        CURLOPT_RETURNTRANSFER => true,--}}
{{--        CURLOPT_ENCODING => '',--}}
{{--        CURLOPT_MAXREDIRS => 10,--}}
{{--        CURLOPT_TIMEOUT => 0,--}}
{{--        CURLOPT_FOLLOWLOCATION => true,--}}
{{--        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,--}}
{{--        CURLOPT_CUSTOMREQUEST => 'POST',--}}
{{--        CURLOPT_POSTFIELDS =>'{--}}
{{--        "account_number": "7694929336",--}}
{{--        "account_reference": "myplatformu1425675289",--}}
{{--        "amount": 500,--}}
{{--        "fees": "45",--}}
{{--        "narration": "NIP:TEST INT\'L FIN.SERVICES LTD-0005000603/7694 2",--}}
{{--        "ref": "00000022012314155906660501995933156200000",--}}
{{--        "from_account_name": "TEST INT\'L BANK LTD",--}}
{{--        "from_account_number": "XXXXXX0603",--}}
{{--        "paid_at": "2022-01-23T21:13:11.078198Z"--}}
{{--        }',--}}
{{--        CURLOPT_HTTPHEADER => array(--}}
{{--        'Content-Type: application/json'--}}
{{--        ),--}}
{{--        ));--}}

{{--        $response = curl_exec($curl);--}}

{{--        curl_close($curl);--}}
{{--        echo $response;--}}

{{--    </code>--}}
{{--    </pre>--}}
    </div>
    <style>
        img {
            max-width: 100%;
            height: auto;
        }
    </style>
    <div class="card-body">
        <div class="center">
            <img    src="{{asset('images/re.jpeg')}}" alt="#" />
        </div>
    </div>

    <br>

    <p>Before you access our API, Kindly note the conditions below:</p>
    <ul class="w3-ul w3-card" style="">
        <li>1. You have successfully requested for Api Key ({{ Auth::user()->apikey}})</li>
        <li>2. You can access our api documentation via <a href="https://documenter.getpostman.com/view/16410443/UzXPwG8p#b00323c6-d738-46fc-8feb-3a484ebe3d00" target="_blank"><b>renomobilemoney.com/API/docs/index</b></a></li>
        <li>3. API service is available for DATA, AIRTIME VTU and BILLS PAYMENT(Dstv, Gotv, Startimes, Smile Bundle, Smile Recharge, Spectranet, Waec Result Checker)</li>
        <li>4. You can generate a new API key free of charge, note that the formal key will no longer be functional once you generate a new key</li>
        <li>5. Do not disclose your API key to anyone, Primedata staffs will never request for it</li>
        <li>6. Updates about API service will be sent via mail to <b>{{ \App\Console\encription::decryptdata(Auth:: user()->email) }}</b></li>
        <li>7. For any issue about this API service kindly mail our technical department via <b>info@renomobilemoney.com</b></li>
    </ul>
    <br>
<center>
    <div class="w3-container w3-card-4 w3-light-grey">
        <br>
        <p class="w3-hide-small"><b class="w3-xlarge"><span class="w3-round w3-button w3-hover-black w3-border w3-black w3-text-white">Api Key:</span>{{ Auth::user()->apikey}}</b></p><br>
        <p class="w3-hide-medium w3-hide-large"><b class="w3-large"><span class="w3-round w3-button w3-hover-black w3-border w3-black w3-text-white">Api Key:</span>{{ Auth::user()->apikey}}</b></p><br>

        <a href="#" data-confirm="You want to generate new api key?" class="access w3-green w3-btn w3-round">Generate New Api Key</a>

                    </div>




</center>
                </div>
            </div>
        </div>
        <br><br>

    </div>


</div>


{{--<script>--}}
{{--    var deleteLinks = document.querySelectorAll('.access');--}}

{{--    for (var i = 0; i < deleteLinks.length; i++) {--}}
{{--        deleteLinks[i].addEventListener('click', function(event) {--}}
{{--            event.preventDefault();--}}

{{--            var choice = confirm(this.getAttribute('data-confirm'));--}}

{{--            if (choice) {--}}
{{--                window.location.href = this.getAttribute('href');--}}
{{--            }--}}
{{--        });--}}
{{--    }--}}
{{--</script>--}}
<style>
    .tooltip {
        position: relative;
        display: inline-block;
    }

    .tooltip .tooltiptext {
        visibility: hidden;
        width: 380px;
        background-color: #555;
        color: #fff;
        text-align: center;
        border-radius: 6px;
        padding: 5px;
        position: absolute;
        z-index: 1;
        bottom: 150%;
        left: 50%;
        margin-left: -75px;
        opacity: 0;
        transition: opacity 0.3s;
    }

    .tooltip .tooltiptext::after {
        content: "";
        position: absolute;
        top: 100%;
        left: 50%;
        margin-left: -5px;
        border-width: 5px;
        border-style: solid;
        border-color: #555 transparent transparent transparent;
    }

    .tooltip:hover .tooltiptext {
        visibility: visible;
        opacity: 1;
    }
</style>
<script>
    function myFunction() {
        var copyText = document.getElementById("myInput");
        copyText.select();
        document.execCommand("copy");

        var tooltip = document.getElementById("myTooltip");
        tooltip.innerHTML = "Copied: " + copyText.value;
    }

    function outFunc() {
        var tooltip = document.getElementById("myTooltip");
        tooltip.innerHTML = "Copy to clipboard";
    }
</script>
