<section class="content container">
    <h1 class="content__title"> Affiliate Program </h1>
    <h2 class="content__subtitle"> Check out all the features of the affiliate program </h2>
    <div class="affilate__img">
        <img src="{{asset('/img/affilate-bg.png')}}" alt="bg">
    </div>
    
    <div class="d-flex justify-content-between">
        <a href="{{route('affiliate.dashboard')}}" class="btn btn-primary">Affiliate dashboard</a>
    </div>

    <div class="plans affiliate">
        <div>
            <div class="commission-rate" style="margin-bottom: 40px;">
                <h2 class="page-title">Highest Paying Affiliate Commission Rates</h2>
                <div class="d-flex justify-content-between progressbars">
                    <div class="circle-chart">
                        <div class="circle-chart__content">
                            <div role="progressbar"  aria-valuemin="0" aria-valuemax="100" style="--value:20"></div>
                            <div class="circle-chart__text">Referral Commission</div>
                            <div class="circle-chart__text">1-10 sales</div>
                        </div>
                    </div>

                    <div class="circle-chart" data-percent="30">
                        <div class="circle-chart__content">
                            <div role="progressbar"  aria-valuemin="0" aria-valuemax="100" style="--value:30"></div>
                            <div class="circle-chart__text">Referral Commission</div>
                            <div class="circle-chart__text">11-20 sales</div>
                        </div>
                    </div>

                    <div class="circle-chart" data-percent="40">
                        <div class="circle-chart__content">
                            <div role="progressbar"  aria-valuemin="0" aria-valuemax="100" style="--value:40"></div>
                            <div class="circle-chart__text">Referral Commission</div>
                            <div class="circle-chart__text">20+ sales</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="conds-wrapper">
                <h2 class="page-title">Affiliate Terms & Conditions</h2>
                <ul class="conds">
                    <li class="conds__item">You are eligible for the commission only when you refer to new clients.</li>
                    <li class="conds__item">We pay commission only when the order is processed; if the customer cancels the order it is considered canceled and you will not get the commission.</li>
                    <li class="conds__item">You are responsible for ensuring that the payout information is correct.</li>
                    <li class="conds__item">We are not responsible for lost/stolen payments.</li>
                    <li class="conds__item">You can check the commission status in the affiliate dashboard.</li>
                    <li class="conds__item">False or misleading advertising or suspected fraudulent activity associated with your affiliate account will result in immediate deactivation.</li>
                    <li class="conds__item">If you want to close your affiliate account, simply remove your affiliate links and do not promote them. Your account and personal information will not be removed from our systems for accounting purposes.</li>
                    <li class="conds__item">If you use affiliate link for your own account, our system will ban both of your accounts.</li>
                    <li class="conds__item">You must have an active subscription to receive affiliate payments. If you do not have an active subscription contact the support team and inform them of your referral program otherwise there will be no payment.</li>
                    
                </ul>
            </div>
        </div>
    </div>
</section>