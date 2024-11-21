<section class="content container">
    <h1 class="content__title"> Support </h1>
    <h2 class="content__subtitle"> Live Chat & Email Help</h2>

    <div class="row">
        <div class="col-md-5">
            <div class="support__block ">
                <img src="{{asset('/img/icons/support1.svg')}}" alt="support">
                <div class="support__block-text">
                    <p class="support__block-title">Live Support</p>
                    <p class="support__block-subtitle">Get instant help through our live chat widget. Our team is available 24/7.</p>
                </div>
            </div>
        </div>

        <div class="col-md-5">
            <a href="{{route('support.tickets.create')}}" class="support__block text-decoration-none">
                <img src="{{asset('/img/icons/support2.svg')}}" alt="support">
                <div class="support__block-text">
                    <p class="support__block-title">Create Ticket</p>
                    <p class="support__block-subtitle">Сreate a ticket and our team will review your problem within 24 hours.</p>
                </div>
            </a>
        </div>
    </div>

    <h2 class="content__title mb-5"><a href="{{route('support.tickets.index')}}" class="btn btn-primary">
        My tickets
        @if (session('unreaded_tickets'))
            <span class="badge rounded-circle bg-danger">{{session('unreaded_tickets')}}</span>
        @endif 
    </a></h2>

    <h2 class="content__title"> Frequently Asked Questions </h2>
    <h2 class="content__subtitle">Need help with something? Here are our most frequently asked questions.</h2>

    <div class="questions">
        <div class="question">
            <p class="question__title">Do you offer a refund policy? 
                <svg class="arrow" width="21" height="20" viewBox="0 0 21 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M2.5 6.7998L10.5 13.1998L18.5 6.7998" stroke="#BBC0C8" stroke-linecap="round"/>
                </svg>
                </p>
            <p class="question__descr">We do offer refunds, but only in the case that the tool is not working for a period of 2 days. If you have any doubts or concerns, please reach out to our live chat for assistance. In all other cases, refunds are not available.</p>
        </div>
        <div class="question">
            <p class="question__title">Is account sharing allowed?
                <svg class="arrow" width="21" height="20" viewBox="0 0 21 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M2.5 6.7998L10.5 13.1998L18.5 6.7998" stroke="#BBC0C8" stroke-linecap="round"/>
                </svg>
                </p>
            <p class="question__descr">We do offer refunds, but only in the case that the tool is not working for a period of 2 days. If you have any doubts or concerns, please reach out to our live chat for assistance. In all other cases, refunds are not available.</p>
        </div>
        <div class="question">
            <p class="question__title">Are the accounts unique?
                <svg class="arrow" width="21" height="20" viewBox="0 0 21 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M2.5 6.7998L10.5 13.1998L18.5 6.7998" stroke="#BBC0C8" stroke-linecap="round"/>
                </svg>
                </p>
            <p class="question__descr">We do offer refunds, but only in the case that the tool is not working for a period of 2 days. If you have any doubts or concerns, please reach out to our live chat for assistance. In all other cases, refunds are not available.</p>
        </div>
        <div class="question">
            <p class="question__title">Can I use proxy or VPN IPs with your service?
                <svg class="arrow" width="21" height="20" viewBox="0 0 21 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M2.5 6.7998L10.5 13.1998L18.5 6.7998" stroke="#BBC0C8" stroke-linecap="round"/>
                </svg>
                </p>
            <p class="question__descr">We do offer refunds, but only in the case that the tool is not working for a period of 2 days. If you have any doubts or concerns, please reach out to our live chat for assistance. In all other cases, refunds are not available.</p>
        </div>
        <div class="question">
            <p class="question__title">Is it possible to use dynamic IPs with your service?
                <svg class="arrow" width="21" height="20" viewBox="0 0 21 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M2.5 6.7998L10.5 13.1998L18.5 6.7998" stroke="#BBC0C8" stroke-linecap="round"/>
                </svg>
                </p>
            <p class="question__descr">We do offer refunds, but only in the case that the tool is not working for a period of 2 days. If you have any doubts or concerns, please reach out to our live chat for assistance. In all other cases, refunds are not available.</p>
        </div>
    </div>
</section>