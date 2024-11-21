<div x-data="
    { 
        init() {
            this.syncStateWithUrl();
            window.addEventListener('popstate', () => {
                this.syncStateWithUrl();
            });
        },
        syncStateWithUrl() {
            const urlParams = new URLSearchParams(window.location.search);
            this.showStepOne = !urlParams.has('step-two');
            this.showStepTwo = urlParams.has('step-two');
        },
        showStepOne: !window.location.search.includes('step-two'),
        showStepTwo: window.location.search.includes('step-two'),
        selectedPackages: {{ old('selected_packages') ? old('selected_packages') : 'null' }} || {},
        selectedTools: {{ old('selected_packages') ? old('selected_tools') : 'null' }} || {},

        selectTool(tool) {
            if(this.selectedTools[tool['id']]) {
                delete this.selectedTools[tool['id']];
            } else {
                this.selectedTools[tool['id']] = tool;
            }
        },

        selectPackage(package) {
            if(this.selectedPackages[package['id']]) {
                delete this.selectedPackages[package['id']];
            } else {
                this.selectedPackages[package['id']] = package;
            }
        }
    }
    ">
    <div x-show="showStepOne">
        @livewire('auth.create-account-step-one')
    </div>

    <div x-show="showStepTwo">
        @livewire('auth.create-account-step-two')
    </div>
</div>