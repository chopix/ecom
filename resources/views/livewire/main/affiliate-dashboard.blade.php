<div>
    <h1 class="text-center">Affiliate Dashboard</h1>
    <p class="text-center">Here is your affiliate link</p>

    <div class="affiliate-link-container d-flex mx-auto" style="max-width: 600px" x-data="{
                copy(elementId) {
                    const inputElement = document.getElementById(elementId);
                    inputElement.select();
                    document.execCommand('copy');

                    alert('Successfully copied');
                }
            }">
        
        <div class="d-flex w-100">
            <input type="text" class="form-control" id="affiliateLink-1" value="{{url("/register?affiliate_key=" . auth()->user()->getAffiliateLink())}}" readonly>
            <button class="btn btn-success copy-btn" @click="copy('affiliateLink-1');">Copy</button>
        </div>
    </div>
</div>