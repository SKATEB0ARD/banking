<head>
    <title>Credit Card</title>
    <link href="http://localhost/banking/templates/css/card.css" rel="stylesheet">
</head>


<body>
    <div class="credit-card-wrap">
        <div class="mk-icon-world-map"></div>
        <div class="credit-card-inner">
            <header class="header">
                <div class="credit-logo">
                    <span class="text">Bank of Brennan</span>
                </div>
            </header>
            <div class="mk-icon-sim"></div>
            <div class="credit-font credit-card-number" data-text="4716"><?=$card["card_number"] ?></div>
            <footer class="footer">
                <div class="clearfix">
                    <div class="pull-left">
                        <div class="credit-card-date"><span class="title">Expires End</span><span class="credit-font">01/018</span></div>
                        <div class="credit-font credit-author">MOHAN KHADKA</div>
                    </div>
                    <div class="pull-right">
                        <div class="mk-icon-visa"></div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
</body>