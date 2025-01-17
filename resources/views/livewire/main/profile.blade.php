<section class="content container">
    <h1 class="content__title"> Profile </h1>
    <h2 class="content__subtitle"> Your personal profile settings </h2>

    <div class="profile-info">
        <div class="profile-info__main">
            <div class="profile-info__main-logo el">
                <img src="../../img/icons/default.svg" alt="default">
            </div>
            <div class="profile-info__main-edit el" x-data="{ 
                editing: false, 
                name: '{{auth()->user()->name}}',
                newName: '{{auth()->user()->name}}',
                loading: false,
                error: '',
                saveName() {
                    
                    if(!this.loading) {
                        this.loading = true;

                        axios.post('/user/update-name', {
                            name: this.newName,
                        })
                        .then(response => {
                            this.editing = false;
                            this.name = this.newName;
                        })
                        .catch(error => {
                            this.error = error.response.data.message;
                            this.newName = this.name;
                        })
                        .finally(() => {
                            this.loading = false;
                        });
                    }
                }
            }">
                <div class="profile-info__main-edit-title">
                    Name
                    <svg @click="editing = !editing;" xmlns="http://www.w3.org/2000/svg" width="12" height="13" viewBox="0 0 12 13" fill="none">
                        <g clip-path="url(#clip0_358_2219)">
                        <path d="M9.72687 5.70323C9.5327 5.70323 9.37529 5.86064 9.37529 6.0548V11.2112C9.37529 11.5343 9.11243 11.7972 8.78934 11.7972H1.2891C0.966007 11.7972 0.703147 11.5343 0.703147 11.2112V3.71098C0.703147 3.38788 0.966007 3.12502 1.2891 3.12502H6.44551C6.63968 3.12502 6.79709 2.96761 6.79709 2.77345C6.79709 2.57929 6.63968 2.42188 6.44551 2.42188H1.2891C0.578292 2.42188 0 3.00017 0 3.71098V11.2112C0 11.922 0.578292 12.5003 1.2891 12.5003H8.78934C9.50015 12.5003 10.0784 11.922 10.0784 11.2112V6.0548C10.0784 5.86064 9.92103 5.70323 9.72687 5.70323Z" fill="#131313"/>
                        <path d="M11.7602 1.40283L11.0973 0.739879C10.7774 0.42004 10.257 0.42004 9.93714 0.739879L4.6337 6.04334C4.58462 6.09242 4.55117 6.15493 4.53753 6.22299L4.20605 7.88034C4.18301 7.99561 4.21908 8.11477 4.30221 8.19788C4.3688 8.26447 4.4585 8.30086 4.5508 8.30086C4.57374 8.30086 4.59681 8.29861 4.61973 8.29404L6.27707 7.96256C6.34514 7.94894 6.40765 7.91547 6.45673 7.86639L11.7602 2.56295C11.7602 2.56295 11.7602 2.56295 11.7602 2.56293C12.0801 2.24311 12.0801 1.72269 11.7602 1.40283ZM6.03481 7.29393L4.99898 7.50113L5.20618 6.4653L9.5228 2.14861L10.3515 2.97729L6.03481 7.29393ZM11.263 2.06576L10.8487 2.4801L10.02 1.65141L10.4343 1.2371C10.48 1.19139 10.5544 1.19137 10.6001 1.23707L11.263 1.90002C11.3087 1.94571 11.3087 2.02007 11.263 2.06576Z" fill="#131313"/>
                        </g>
                        <defs>
                        <clipPath id="clip0_358_2219">
                        <rect width="12" height="12" fill="white" transform="translate(0 0.5)"/>
                        </clipPath>
                        </defs>
                    </svg>
                </div>
                <div class="profile-info__main-edit-name">
                    <span x-show="!editing" x-text="name"></span>
                    <div x-show="editing" class="profile-info__main-edit-wrapper">
                        <div style="margin-bottom: 5px;">
                            <input type="text" x-model="newName" @keydown.enter="saveName()" @input="error = ''">
                            <button @click="saveName();">Save</button>
                        </div>
                        <template x-if="loading">
                            <div class="loader"></div>
                        </template>
                        <template x-if="error.length">
                            <div class="error" x-text="error"></div>
                        </template>
                    </div>
                </div>
            </div>
            <div class="profile-info__main-edit el">
                <div class="profile-info__main-edit-title">
                    Email
                </div>
                <div class="profile-info__main-edit-name">
                    {{auth()->user()->email}}
                </div>
            </div>
            <div class="profile-info__main-edit el" x-data="{ 
                editing: false, 
                phone: '{{auth()->user()->phone_number}}',
                newPhone: '{{auth()->user()->phone_number}}',
                loading: false,
                error: '',
                savePhone() {
                    
                    if(!this.loading) {
                        this.loading = true;

                        axios.post('{{route('user.updatePhone')}}', {
                            phone: this.newPhone,
                        })
                        .then(response => {
                            this.editing = false;
                            this.phone = this.newPhone;
                        })
                        .catch(error => {
                            this.error = error.response.data.message;
                            this.newPhone = this.phone;
                        })
                        .finally(() => {
                            this.loading = false;
                        });
                    }
                }
            }">
                <div class="profile-info__main-edit-title">
                    Phone
                    <svg @click="editing = !editing;" xmlns="http://www.w3.org/2000/svg" width="12" height="13" viewBox="0 0 12 13" fill="none">
                        <g clip-path="url(#clip0_358_2219)">
                        <path d="M9.72687 5.70323C9.5327 5.70323 9.37529 5.86064 9.37529 6.0548V11.2112C9.37529 11.5343 9.11243 11.7972 8.78934 11.7972H1.2891C0.966007 11.7972 0.703147 11.5343 0.703147 11.2112V3.71098C0.703147 3.38788 0.966007 3.12502 1.2891 3.12502H6.44551C6.63968 3.12502 6.79709 2.96761 6.79709 2.77345C6.79709 2.57929 6.63968 2.42188 6.44551 2.42188H1.2891C0.578292 2.42188 0 3.00017 0 3.71098V11.2112C0 11.922 0.578292 12.5003 1.2891 12.5003H8.78934C9.50015 12.5003 10.0784 11.922 10.0784 11.2112V6.0548C10.0784 5.86064 9.92103 5.70323 9.72687 5.70323Z" fill="#131313"/>
                        <path d="M11.7602 1.40283L11.0973 0.739879C10.7774 0.42004 10.257 0.42004 9.93714 0.739879L4.6337 6.04334C4.58462 6.09242 4.55117 6.15493 4.53753 6.22299L4.20605 7.88034C4.18301 7.99561 4.21908 8.11477 4.30221 8.19788C4.3688 8.26447 4.4585 8.30086 4.5508 8.30086C4.57374 8.30086 4.59681 8.29861 4.61973 8.29404L6.27707 7.96256C6.34514 7.94894 6.40765 7.91547 6.45673 7.86639L11.7602 2.56295C11.7602 2.56295 11.7602 2.56295 11.7602 2.56293C12.0801 2.24311 12.0801 1.72269 11.7602 1.40283ZM6.03481 7.29393L4.99898 7.50113L5.20618 6.4653L9.5228 2.14861L10.3515 2.97729L6.03481 7.29393ZM11.263 2.06576L10.8487 2.4801L10.02 1.65141L10.4343 1.2371C10.48 1.19139 10.5544 1.19137 10.6001 1.23707L11.263 1.90002C11.3087 1.94571 11.3087 2.02007 11.263 2.06576Z" fill="#131313"/>
                        </g>
                        <defs>
                        <clipPath id="clip0_358_2219">
                        <rect width="12" height="12" fill="white" transform="translate(0 0.5)"/>
                        </clipPath>
                        </defs>
                    </svg>
                </div>
                <div class="profile-info__main-edit-name">
                    <span x-show="!editing" x-text="'+' + (phone.startsWith('+') ? phone.slice(1) : phone).replace(/\d/g, 'X')"></span>
                    <div x-show="editing" class="profile-info__main-edit-wrapper">
                        <div style="margin-bottom: 5px;">
                            <input type="text" x-model="newPhone" @keydown.enter="savePhone()" @input="newPhone = newPhone.replace(/\D/g, ''); error = ''">
                            <button @click="savePhone(); editing=false">Save</button>
                        </div>
                        <template x-if="loading">
                            <div class="loader"></div>
                        </template>
                        <template x-if="error.length">
                            <div class="error" x-text="error"></div>
                        </template>
                    </div>
                </div>
            </div>
        </div>

        <form action="{{route('auth.logout')}}" method="POST">
            @csrf
            <button type="submit" class="profile-info__btn">
                Logout
                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12" fill="none">
                    <g clip-path="url(#clip0_358_2145)">
                    <path d="M11.6249 5.62498H6.87499C6.66799 5.62498 6.5 5.45698 6.5 5.24999C6.5 5.04299 6.66799 4.875 6.87499 4.875H11.6249C11.8319 4.875 11.9999 5.04299 11.9999 5.24999C11.9999 5.45698 11.8319 5.62498 11.6249 5.62498Z" fill="black"/>
                    <path d="M9.7499 7.49978C9.65386 7.49978 9.55792 7.46325 9.48486 7.38982C9.33838 7.24325 9.33838 7.00577 9.48486 6.85929L11.0949 5.24939L9.48486 3.63939C9.33838 3.49291 9.33838 3.25543 9.48486 3.10895C9.63143 2.96238 9.86891 2.96238 10.0154 3.10895L11.8903 4.98389C12.0368 5.13037 12.0368 5.36785 11.8903 5.51433L10.0154 7.38927C9.94188 7.46325 9.84593 7.49978 9.7499 7.49978Z" fill="black"/>
                    <path d="M3.99991 12.0006C3.89288 12.0006 3.79135 11.9856 3.68992 11.9541L0.680948 10.9516C0.271537 10.8086 0 10.4271 0 10.0007V1.00098C0 0.449479 0.448503 0.000976562 0.999999 0.000976562C1.10693 0.000976562 1.20846 0.0159908 1.30999 0.0474839L4.31886 1.04995C4.72837 1.19296 4.99981 1.57444 4.99981 2.00088V11.0006C4.99981 11.5521 4.5514 12.0006 3.99991 12.0006ZM0.999999 0.750953C0.862491 0.750953 0.749977 0.863468 0.749977 1.00098V10.0007C0.749977 10.1072 0.821477 10.2061 0.923464 10.2417L3.91833 11.2396C3.93985 11.2466 3.96786 11.2506 3.99991 11.2506C4.13741 11.2506 4.24984 11.1381 4.24984 11.0006V2.00088C4.24984 1.89441 4.17834 1.79545 4.07635 1.75992L1.08148 0.761939C1.05996 0.754981 1.03195 0.750953 0.999999 0.750953Z" fill="black"/>
                    <path d="M7.62472 3.99991C7.41773 3.99991 7.24973 3.83191 7.24973 3.62492V1.37499C7.24973 1.03049 6.96931 0.749977 6.62481 0.749977H0.999988C0.792994 0.749977 0.625 0.581983 0.625 0.374988C0.625 0.167994 0.792994 0 0.999988 0H6.62481C7.3833 0 7.99971 0.616497 7.99971 1.37499V3.62492C7.99971 3.83191 7.83171 3.99991 7.62472 3.99991Z" fill="black"/>
                    <path d="M6.62499 10.4999H4.62499C4.41799 10.4999 4.25 10.3319 4.25 10.1249C4.25 9.91792 4.41799 9.74993 4.62499 9.74993H6.62499C6.96949 9.74993 7.24991 9.46942 7.24991 9.12492V6.87499C7.24991 6.66799 7.4179 6.5 7.62489 6.5C7.83189 6.5 7.99988 6.66799 7.99988 6.87499V9.12492C7.99988 9.88341 7.38348 10.4999 6.62499 10.4999Z" fill="black"/>
                    </g>
                    <defs>
                    <clipPath id="clip0_358_2145">
                    <rect width="12" height="12" fill="white"/>
                    </clipPath>
                    </defs>
                </svg>
            </button>    
        </form>
    </div>

    <h3 class="content__block-title">Email verification</h3>
    @if(auth()->user() && !auth()->user()->hasVerifiedEmail())
        @if($submittedVerification)
            <button disabled class="affiliate-link__block">Verify Link Sent</button>
            <p>You can send a verified email link once every 5 minutes.</p>
        @else
            <form wire:submit.prevent="verifyEmail">
                <button type="submit" class="affiliate-link__block">Verify Email</button>
            </form>
        @endif
    @elseif(auth()->user() && auth()->user()->hasVerifiedEmail())
        <button disabled>Verified</button>
    @endif

    {{-- <h3 class="content__block-title">Your Card</h3>

    <div class="row">
        <div class="col-md-4">
            <div class="archive__wrapper">
                <div class="archive__wrapper-logo">
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 40" fill="none">
                        <path d="M34.375 7.5H5.625C3.90188 7.5 2.5 8.90188 2.5 10.625V28.75C2.5 30.4731 3.90188 31.875 5.625 31.875H34.375C36.0981 31.875 37.5 30.4731 37.5 28.75V10.625C37.5 8.90188 36.0981 7.5 34.375 7.5Z" fill="#D8E0EA"/>
                        <path d="M34.375 9.375H5.625C4.9375 9.375 4.375 9.9375 4.375 10.625V12.5H35.625V10.625C35.625 9.9375 35.0625 9.375 34.375 9.375Z" fill="#AAB2BC"/>
                        <path d="M34.375 10.625H5.625C4.9375 10.625 4.375 11.1875 4.375 11.875V12.5391H35.625V11.875C35.625 11.1875 35.0625 10.625 34.375 10.625Z" fill="#F2FAFF"/>
                        <path d="M35.625 28.75C35.625 29.4375 35.0625 30 34.375 30H5.625C4.9375 30 4.375 29.4375 4.375 28.75V12.5C4.375 11.8125 4.9375 11.25 5.625 11.25H34.375C35.0625 11.25 35.625 11.8125 35.625 12.5V28.75Z" fill="#D8E0EA"/>
                        <path d="M23.75 26.875C27.2018 26.875 30 24.0768 30 20.625C30 17.1732 27.2018 14.375 23.75 14.375C20.2982 14.375 17.5 17.1732 17.5 20.625C17.5 24.0768 20.2982 26.875 23.75 26.875Z" fill="#FFA914"/>
                        <path d="M17.5 20.625C17.5 20.4378 17.5084 20.2525 17.5245 20.0695H22.4741C22.4405 19.6881 22.3725 19.3169 22.2736 18.9583H17.7248C17.8316 18.5715 17.9752 18.2001 18.1505 17.8472H21.8488C21.6518 17.451 21.4141 17.079 21.1409 16.7361H18.8573C19.1893 16.319 19.5734 15.9453 20 15.6249C18.9554 14.8402 17.6571 14.375 16.25 14.375C12.7982 14.375 10 17.1732 10 20.625C10 24.0769 12.7982 26.875 16.25 26.875C17.6571 26.875 18.9554 26.4098 20 25.6251C19.5735 25.3047 19.1893 24.931 18.8573 24.5138H21.1409C21.414 24.1709 21.6517 23.799 21.8488 23.4027H18.1505C17.9752 23.0498 17.8316 22.6784 17.7248 22.2916H22.2736C22.3727 21.933 22.4405 21.5617 22.4741 21.1803H17.5245C17.5084 20.9975 17.5 20.8122 17.5 20.625Z" fill="#EF4136"/>
                    </svg>
                </div>
                <div class="archive__wrapper-title">
                    **** **** **** 4586
                    <img src="../../img/icons/delete.svg" alt="info">
                </div>
                <p class="archive__wrapper-price">
                    12/24
                </p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="archive__wrapper">
                <div class="archive__wrapper-logo">
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 40" fill="none">
                        <path d="M15.1877 13.7682L9.95172 26.2624H6.53422L3.95937 16.2923C3.80086 15.6775 3.66539 15.4538 3.19008 15.1927C2.41148 14.7717 1.13078 14.3769 0 14.1309L0.0791406 13.7683H5.5775C6.27875 13.7683 6.90922 14.236 7.06773 15.0423L8.42922 22.2737L11.792 13.7683L15.1877 13.7682ZM28.5741 22.1813C28.5893 18.8855 24.0138 18.7062 24.0466 17.2317C24.0555 16.7816 24.4821 16.3054 25.4163 16.1852C25.8802 16.1234 27.1569 16.0782 28.6038 16.7425L29.1709 14.0942C28.3924 13.8116 27.3917 13.541 26.148 13.541C22.9535 13.541 20.7047 15.2402 20.6857 17.6713C20.6648 19.4691 22.2902 20.4724 23.5162 21.0712C24.7751 21.6838 25.196 22.075 25.1916 22.6245C25.1834 23.463 24.1871 23.8295 23.2579 23.846C21.6325 23.8713 20.6898 23.4068 19.9369 23.0562L19.3517 25.7955C20.1059 26.1417 21.5021 26.4423 22.9471 26.4601C26.3423 26.4599 28.5634 24.7789 28.5741 22.1813ZM37.01 26.2625H40L37.391 13.7683H34.6308C34.0105 13.7683 33.4877 14.13 33.2547 14.6841L28.4077 26.2625H31.8002L32.4737 24.3966H36.6207L37.01 26.2625ZM33.4034 21.8357L35.1055 17.1443L36.0846 21.8357H33.4034ZM19.8066 13.7682L17.1324 26.2624H13.8997L16.5745 13.7682H19.8066Z" fill="#1A2ADF"/>
                    </svg>
                </div>
                <div class="archive__wrapper-title">
                    **** **** **** 4586
                    <img src="../../img/icons/delete.svg" alt="info">
                </div>
                <p class="archive__wrapper-price">
                    12/24
                </p>
            </div>
        </div> --}}
    </div>
</section>

